<?php

namespace App\Providers\Exceptions;

/**
 * Class IncorrectLoginException
 * @package App\Providers\Exceptions
 */
class IncorrectLoginException extends BaseException {
    protected $code = ErrorCode::loginIncorrect;
    protected $message = 'Неправильный логин';
    protected $statusCode = 400;
}
