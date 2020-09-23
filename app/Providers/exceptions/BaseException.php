<?php

namespace App\Providers\Exceptions;

use Exception;

class BaseException extends Exception {
    protected $statusCode = 400;
    protected $data = [];

    /**
     * BaseException constructor.
     * @param array $data
     */
    public function __construct(array $data = []) {
        $this->data = $data;
    }

    /**
     * @return array
     */
    public function getData(): array {
        return $this->data;
    }

    /**
     * @return int
     */
    public function getStatusCode(): int {
        return $this->statusCode;
    }
}
