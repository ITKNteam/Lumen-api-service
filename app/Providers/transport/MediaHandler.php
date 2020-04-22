<?php

namespace App\Providers\transport;

use App\Models\ResultDto;
use GuzzleHttp\Client;

class MediaHandler extends Handler {
    private $awsClient;

    /**
     * NotifierHandler constructor.
     * @param string $url
     * @throws \Exception
     */
    function __construct(string $url) {
        parent::__construct($url);
        $this->serviceName = 'media';

        $bucket = env('AWS_S3_BUCKET');
        $region = env('AWS_S3_CLIENT_REGION');

        $this->awsClient = new Client([
            'base_uri' => 'https://' . $bucket . '.s3.' . $region . '.amazonaws.com',
            'http_errors' => false
        ]);
    }

    /**
     * @param array $input
     * @return array
     */
    private function prepareGetParams(array $input = []): array {
        $prepare = [];

        foreach ($input as $key => $value) {
            if ($key === '_url') {
                continue;
            }

            $prepare[$key] = $value;
        }

        return $prepare;
    }

    public function deleteCreditCard(array $input): ResultDto {
        return $this->delete('billing/creditCard', $this->prepareGetParams($input));
    }

    public function uploadBase64(array $options): ResultDto {
        return $this->post('file/uploadBase64', $options);
    }

    public function fileUri(array $options): ResultDto {
        return $this->get('file/fileUri?filehash=' . $options['filehash'], []);
    }

    public function fileContent(array $options) {
        $fileUrl = $this->get('file/fileUri?filehash=' . $options['filehash'], []);

        if (!$fileUrl->isSuccess()) {
            abort(500, 'Not call aws');
        }

        $data = $fileUrl->getData();

        if (empty($data)) {
            abort(400, 'Empty');
        }

        $path = $data['path'];
        $query = $data['query'];
        $link = $path . '?' . $query;

        return $this->awsClient->get($link);
    }
}