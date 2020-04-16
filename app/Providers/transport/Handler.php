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
            $response = json_decode($res->getBody()->getContents(), true);

            return new ResultDto($response['code'], $response['message'], $response['data']);
        } catch (Exception $e) {
            Sentry\captureException($e);
            return new ResultDto(400, $e->getMessage());
        }
    }

    /**
     * @param string $method
     * @param array $params
     * @return ResultDto
     */
    public function put(string $method, array $params): ResultDto {
        try {
            $res = $this->client->put($method, [
                'form_params' => $params
            ]);
            $response = json_decode($res->getBody()->getContents(), true);

            return new ResultDto($response['code'], $response['message'], $response['data']);
        } catch (Exception $e) {
            Sentry\captureException($e);
            return new ResultDto(400, $e->getMessage());
        }
    }

    /**
     * @param string $method
     * @param array $params
     * @return ResultDto
     */
    public function get(string $method, array $params): ResultDto {
        try {
            $res = $this->client->get($method, [
                'form_params' => $params
            ]);
            $response = json_decode($res->getBody()->getContents(), true);

            return new ResultDto($response['code'], $response['message'], $response['data']);
        } catch (Exception $e) {
            Sentry\captureException($e);
            return new ResultDto(400, $e->getMessage());
        }
    }
}