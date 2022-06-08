<?php

namespace App\Constants;

class Status
{
    public const OPERATION_SUCCESSFUL = 200;
    public const VALIDATION_FAILED = 400;
    public const AUTHENTICATION_FAILED = 401;
    public const TOO_MANY_ATTEMPTS = 402;
    public const PERMISSION_DENIED = 403;
    public const NOT_FOUND = 404;
    public const ROUTE_NOT_FOUND = 410;
    public const OTHER_EXCEPTION_THROWN = 500;
    public const PHONE_NOT_FOUND = 601;
    public const PASSWORD_IS_WRONG = 602;
    public const USER_ALREADY_EXISTS = 610;

    public static function getMessage($code)
    {
        $messages = [
            self::OPERATION_SUCCESSFUL => "Operation successful",
            self::VALIDATION_FAILED => "Validation failed",
            self::AUTHENTICATION_FAILED => "Authentication failed",
            self::TOO_MANY_ATTEMPTS => "Too many requests",
            self::PERMISSION_DENIED => "Permission denied",
            self::NOT_FOUND => "Not found",
            self::ROUTE_NOT_FOUND => "The selected route is invalid",
            self::OTHER_EXCEPTION_THROWN => "Other exception thrown",
            self::PHONE_NOT_FOUND => "phone number not found",
            self::PASSWORD_IS_WRONG => "Password is wrong",
            self::USER_ALREADY_EXISTS => "User already exists",

        ];

        if(isset($messages[$code]))
            return $messages[$code];

        return $code;


    }
}
