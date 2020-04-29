<?php

namespace App\Providers\Exceptions;

/**
 * Class UserExistException
 * @package App\Providers\Exceptions
 */
class UserExistException extends BaseException {
    protected $code = ErrorCode::userExist;
    protected $message = 'Пользователь существует';
    protected $statusCode = 409;
}
