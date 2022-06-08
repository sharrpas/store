<?php

namespace App\Http\Controllers;

use App\Constants\Status;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class UserController extends Controller
{
    public function signup(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'phone' => 'required|unique:App\Models\User,phone',
            'password' => [Password::required(), Password::min(4)->numbers()/*->mixedCase()->letters()->symbols()->uncompromised()*/, 'confirmed'],
//            'image' => 'image',
        ]);


        $user = new User();
        $user->name = $request->name;
        $user->phone = $request->phone;
        $user->password = Hash::make($request->password);
        $user->save();

        return $this->success('You have successfully registered, utilize your phone and password to log in');

    }


    public function login(Request $request)
    {
        $request->validate([
            'phone' => 'required',
            'password' => 'required'
        ]);

//      $user = User::query()->where('username', $request->username)->where('password', $request->password)->firstOrFail();

        if (!$user = User::query()->where('phone', $request->phone)->first()) {
            return response()->json([
                "message" => "User not found"
            ]);
        }

        $pass_check = Hash::check($request->password, User::query()->where('phone', $request->phone)->firstOrFail()->password);

        $isAdmin = false;

        if ($user && $pass_check) {
            if ($user->roles()->where('title', 'super_admin')->count())$isAdmin=true;
            return $this->success([
                'user' => $user,
                'isAdmin' => $isAdmin,
                'token' => $user->createToken('token_base_name')->plainTextToken
            ]);
        } else {
            return response()->json(['message' => 'Your phone or password is incorrect']);
        }

    }


    public function logout()
    {
        /** @var User $user */
        $user = auth()->user();

        $user->tokens()->delete();

        return $this->success('logged out');
    }


    public function changePass(Request $request)
    {
        $request->validate([
            'old_pass' => 'required',
            'new_pass' => 'required',
        ]);
        $pass_check = Hash::check($request->old_pass, User::query()->where('id', '=', auth()->id())->firstOrFail()->password);
        if ($pass_check) {
            User::query()->where('id', '=', auth()->id())->update([
                'password' => Hash::make($request->new_pass)
            ]);
            return $this->success('password changed to ' . $request->new_pass);
        } else {
            return $this->error(Status::PASSWORD_IS_WRONG);
        }
    }
}
