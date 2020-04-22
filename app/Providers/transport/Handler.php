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

    protected $serviceName = 'Unknown';

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

            Sentry\addBreadcrumb(new Sentry\Breadcrumb(
                Sentry\Breadcrumb::LEVEL_ERROR,
                Sentry\Breadcrumb::TYPE_ERROR,
                $this->serviceName,
                json_encode($response)
            ));

            $code = ($response['code'] ?? $response['res']) ?? 500;
            $message = ($response['messages'] ?? $response['message']) ?? 'Not found message';
            $data = $response['data'] ?? ['response' => $response];

            return new ResultDto($code, $message, $data);
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

            Sentry\addBreadcrumb(new Sentry\Breadcrumb(
                Sentry\Breadcrumb::LEVEL_ERROR,
                Sentry\Breadcrumb::TYPE_ERROR,
                $this->serviceName,
                json_encode($response)
            ));

            $code = ($response['code'] ?? $response['res']) ?? 500;
            $message = ($response['messages'] ?? $response['message']) ?? 'Not found message';
            $data = $response['data'] ?? ['response' => $response];

            return new ResultDto($code, $message, $data);
        } catch (Exception $e) {
            Sentry\captureException($e);
            return new ResultDto(400, $e->getMessage());
        }
    }

    /**
     * @param string $method
     * @param array $params
     * @param array $options
     * @return ResultDto
     */
    public function get(string $method, array $params, array $options = []): ResultDto {
        try {
            $query = [
                'query' => $params
            ];

            if (!empty($options)) {
                $query = $options;
            }

            Sentry\addBreadcrumb(new Sentry\Breadcrumb(
                Sentry\Breadcrumb::LEVEL_ERROR,
                Sentry\Breadcrumb::TYPE_ERROR,
                $this->serviceName,
                json_encode([
                    '$method' => $method, '$query' => $query
                ])
            ));

            $res = $this->client->get($method, $query);

            $response = json_decode($res->getBody()->getContents(), true);

            Sentry\addBreadcrumb(new Sentry\Breadcrumb(
                Sentry\Breadcrumb::LEVEL_ERROR,
                Sentry\Breadcrumb::TYPE_ERROR,
                $this->serviceName,
                json_encode($response)
            ));

            $code = ($response['code'] ?? $response['res']) ?? 500;
            $message = ($response['messages'] ?? $response['message']) ?? 'Not found message';
            $data = $response['data'] ?? ['response' => $response];

            return new ResultDto($code, $message, $data);
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
    public function delete(string $method, array $params): ResultDto {
        try {
            $res = $this->client->delete($method, [
                'query' => $params
            ]);

            $response = json_decode($res->getBody()->getContents(), true);

            Sentry\addBreadcrumb(new Sentry\Breadcrumb(
                Sentry\Breadcrumb::LEVEL_ERROR,
                Sentry\Breadcrumb::TYPE_ERROR,
                $this->serviceName,
                json_encode($response)
            ));

            $code = ($response['code'] ?? $response['res']) ?? 500;
            $message = ($response['messages'] ?? $response['message']) ?? 'Not found message';
            $data = $response['data'] ?? ['response' => $response];

            return new ResultDto($code, $message, $data);
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
    public function patch(string $method, array $params): ResultDto {
        try {
            $res = $this->client->patch($method, [
                'query' => $params
            ]);

            $response = json_decode($res->getBody()->getContents(), true);

            Sentry\addBreadcrumb(new Sentry\Breadcrumb(
                Sentry\Breadcrumb::LEVEL_ERROR,
                Sentry\Breadcrumb::TYPE_ERROR,
                $this->serviceName,
                json_encode($response)
            ));

            $code = ($response['code'] ?? $response['res']) ?? 500;
            $message = ($response['messages'] ?? $response['message']) ?? 'Not found message';
            $data = $response['data'] ?? ['response' => $response];

            return new ResultDto($code, $message, $data);
        } catch (Exception $e) {
            Sentry\captureException($e);
            return new ResultDto(400, $e->getMessage());
        }
    }
}