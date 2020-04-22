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
     * ResultDto constructor.
     * @param int $res
     * @param string $message
     * @param array $data
     */
    function __construct(int $res, string $message, array $data = []) {
        $this->res = $res;
        $this->message = $message;
        $this->data = $data;
    }

    /**
     * @return array
     */
    public function getResult(): array {
        return [
            'res' => $this->res,
            'message' => $this->message,
            'data' => $this->data
        ];
    }

    /**
     * @return bool
     */
    public function isSuccess(): bool {
        return in_array($this->res, [self::OK, self::HTTP_SUCCESS]);
    }

    /**
     * @return string
     */
    public function getMessage():string {
        return $this->message;
    }

    /**
     * @param string $key
     * @return array
     */
    public function getData(string $key = ''): array {
        return empty($key) ? $this->data : $this->data[$key];
    }

    static public function createResult(int $code, string $message, array $data = []): array {
        return [
            'res' => $code,
            'message' => $message,
            'data' => $data
        ];
    }

    /**
     * @return int
     */
    public function getRes(): int {
        return $this->res;
    }
}