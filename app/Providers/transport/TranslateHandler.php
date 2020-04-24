<?php

namespace App\Providers\transport;

use App\Models\ResultDto;

class TranslateHandler extends Handler {
    /**
     * NotifierHandler constructor.
     * @param string $url
     * @throws \Exception
     */
    function __construct(string $url) {
        parent::__construct($url);
        $this->serviceName = 'biz-claim';
    }

    public function getCurrentKey(array $input): ResultDto {
        return $this->get('translations/hash', $input);
    }

    public function getTranslations(array $input): ResultDto {
        return $this->get('translations/hash', $input);
    }

    public function getItems(array $input): ResultDto {
        return $this->get('translations', $input);
    }

    public function setItem(array $input): ResultDto {
        return $this->post('translations', [], [
            'multipart' => $this->prepareMultipartForm($input)
        ]);
    }

    public function updateItem(array $input): ResultDto {
        return $this->put('translations', $input, [], [
            'form_params' => $input
        ]);
    }

    public function deleteItems(array $input): ResultDto {
        return $this->delete('translations', $input);
    }
}