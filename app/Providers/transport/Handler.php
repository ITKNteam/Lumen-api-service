<?php

namespace App\Providers\transport;

use GuzzleHttp\Client;
use Exception;
use Sentry;
use App\Models\ResultDto;
use Illuminate\Http\UploadedFile;

class Handler {
    /**
     * @var Client
     */
    public $client;

    protected $serviceName = 'Unknown';

    protected $tmpDir;

    private $url;

    /**
     * Handler constructor.
     * @param string $url
     * @throws Exception
     */
    function __construct(string $url) {
        if (empty($url)) {
            throw new Exception('Invalid constructor arg url');
        }

        $this->url = $url;

        $this->client = new Client([
            'base_uri' => $url,
            'http_errors' => false
        ]);

        $this->tmpDir = env('TMP_DIR');
    }

    private function createResult($res): ResultDto {
        $response = json_decode($res->getBody()->getContents(), true);

        Sentry\addBreadcrumb(new Sentry\Breadcrumb(
            Sentry\Breadcrumb::LEVEL_ERROR,
            Sentry\Breadcrumb::TYPE_ERROR,
            $this->serviceName,
            json_encode($response)
        ));

        $code = $res->getStatusCode();

        if (isset($response['code']) || isset($response['res'])) {
            $code = ($response['res'] ?? $response['code']);
        }

        $message = 'Not found message';

        if (isset($response['messages']) || isset($response['message'])) {
            $message = ($response['messages'] ?? $response['message']);
        }

        if (!in_array($code, [200, 1])) {
            throw new Exception($message);
        }

        $data = $response['data'] ?? $response;

        return new ResultDto($code, $message, $data ?? []);
    }

    /**
     * @param string $method
     * @param array $params
     * @param array $options
     * @return ResultDto
     */
    public function post(string $method, array $params, array $options = []): ResultDto {
        try {
            $form_params = [
                'form_params' => $params
            ];

            if (!empty($options)) {
                $form_params = $options;
            }

            Sentry\addBreadcrumb(new Sentry\Breadcrumb(
                Sentry\Breadcrumb::LEVEL_ERROR,
                Sentry\Breadcrumb::TYPE_ERROR,
                $this->serviceName,
                json_encode($options)
            ));

            return $this->createResult($this->client->post($method, $form_params));
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
            $options = [
                'form_params' => $params
            ];

            Sentry\addBreadcrumb(new Sentry\Breadcrumb(
                Sentry\Breadcrumb::LEVEL_ERROR,
                Sentry\Breadcrumb::TYPE_ERROR,
                $this->serviceName,
                json_encode($options)
            ));

            return $this->createResult($this->client->put($method, $options));
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
                    'url' => $this->url . $method,
                    'query' => $query
                ])
            ));

            return $this->createResult($this->client->get($method, $query));
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
            $options = [
                'query' => $params
            ];

            Sentry\addBreadcrumb(new Sentry\Breadcrumb(
                Sentry\Breadcrumb::LEVEL_ERROR,
                Sentry\Breadcrumb::TYPE_ERROR,
                $this->serviceName,
                json_encode($options)
            ));

            return $this->createResult($this->client->delete($method, $options));
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
            $options = [
                'query' => $params
            ];

            Sentry\addBreadcrumb(new Sentry\Breadcrumb(
                Sentry\Breadcrumb::LEVEL_ERROR,
                Sentry\Breadcrumb::TYPE_ERROR,
                $this->serviceName,
                json_encode($options)
            ));

            return $this->createResult($this->client->patch($method, $options));
        } catch (Exception $e) {
            Sentry\captureException($e);
            return new ResultDto(400, $e->getMessage());
        }
    }

    public function prepareMultipartForm(array $input = [], $files = null) {
        $prepare = [];

        foreach ($input as $key => $value) {
            if (is_object($value) || is_array($value)) {
                continue;
            }

            $prepare[] = [
                'name' => $key,
                'contents' => $value
            ];
        }

        if (is_array($files)) {
            foreach ($files as $key => $file) {
                if (is_array($file)) {
                    foreach ($file as $item) {
                        $prepare[] = [
                            'name' => $key . '[]',
                            'contents' => $this->getFileContent($item)
                        ];
                    }
                } else {
                    $prepare[] = [
                        'name' => $key,
                        'contents' => $this->getFileContent($file)
                    ];
                }
            }
        }

        return $prepare;
    }

    private function getFileContent(UploadedFile $file) {
        $fileName = time() . '_' . $file->getClientOriginalName();
        $pathFile = $this->tmpDir . $fileName;

        $file->move($this->tmpDir, $fileName);

        $content = fopen($pathFile, 'r');

        if (is_file($pathFile)) {
            unlink($pathFile);
        } else {
            Sentry\addBreadcrumb(new Sentry\Breadcrumb(
                Sentry\Breadcrumb::LEVEL_ERROR,
                Sentry\Breadcrumb::TYPE_ERROR,
                $this->serviceName,
                'Cannot delete path to file: ' . $pathFile
            ));
        }

        return $content;
    }

    /**
     * @param array $input
     * @return array
     */
    public function prepareGetParams(array $input = []): array {
        $prepare = [];

        foreach ($input as $key => $value) {
            if ($key === '_url') {
                continue;
            }

            $prepare[$key] = $value;
        }

        return $prepare;
    }
}
