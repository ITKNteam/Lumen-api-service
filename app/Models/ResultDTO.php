<?php
namespace App\Models;

/**
 * Стандарт ответа
 * Class ResultDto
 * @package App\Models
 */
class ResultDto {

    /**
     * 0 - success status
     * 1 - failure status
     * @var int
     */
    private $res;

    /**
     * Success status
     */
    const OK = 1;

    /**
     * Failure status
     */
    const FAIL = 0;

    /**
     * Http success status
     */
    const HTTP_SUCCESS = 200;

    /**
     * @var string
     */
    private $message;

    /**
     * @var array
     */
    private $data;

    /**
     *  HTTP code
     * @var int
     */
    private $code;

    /**
     * ResultDto constructor.
     * @param int $res
     * @param string $message
     * @param array $data
     */
    function __construct(int $res, string $message, array $data = [], $code = self::HTTP_SUCCESS) {
        $this->res = $res;
        $this->message = $message;
        $this->data = $data;
        $this->code = $code;
    }

    /**
     * @return array
     */
    public function getResult(): array {
        return [
            'code' => $this->code,
            'res' => $this->res,
            'message' => $this->message,
            'data' => $this->data
        ];
    }

    /**
     * @return bool
     */
    public function isSuccess(): bool {
        return $this->res === self::OK;
    }

    /**
     * @return string
     */
    public function getMessage():string {
        return $this->message;
    }

    /**
     * @param string $key
     * @return array|mixed
     */
    public function getData(string $key = '') {
        return empty($key) ? $this->data : $this->data[$key];
    }


    /**
     * @return int
     */
    public function getRes(): int {
        return $this->res;
    }

    /**
     * @return int
     */
    public function getCode(): int
    {
        return $this->code;
    }


}