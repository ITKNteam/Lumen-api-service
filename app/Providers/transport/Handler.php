<?php

namespace App\Providers\transport;

use GuzzleHttp\Client;
use Exception;
use Sentry;
use App\Models\ResultDto;

class Handler {
    /**
     * @var Client
     */
    public $client;

    /**
     * Handler constructor.
     * @param string $url
     * @throws Exception
     */
    function __construct(string $url) {
        if (empty($url)) {
            throw new Exception('Invalid constructor arg url');
        }

        $this->client = new Client([
            'base_uri' => $url,
            'http_errors' => false
        ]);
    }

    /**
     * @param string $method
     * @param array $params
     * @return ResultDto
     */
    public function post(string $method, array $params): ResultDto {
        try {
            $res = $this->client->post($method, [
                'form_params' => $params
            ]);
            return new ResultDto($res['code'], $res['message'], $res['data']);
        } catch (Exception $e) {
            Sentry\captureException($e);
            return new ResultDto(400, $e->getMessage());
        }
    }
}