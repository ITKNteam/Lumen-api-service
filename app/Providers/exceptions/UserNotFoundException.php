<?php

namespace App\Providers\Exceptions;

/**
 * Class UserNotFoundException
 * @package App\Providers\Exceptions
 */
class UserNotFoundException extends BaseException {
    protected $code = ErrorCode::userNotFound;
    protected $message = 'Пользователь не найден';
    protected $statusCode = 404;
}
