<?php

namespace App\Providers\transport;

use App\Models\ResultDto;

class HandbooksHandler extends Handler {

    /**
     * HandbooksHandler constructor.
     * @param string $url
     * @throws \Exception
     */
    function __construct(string $url) {
        parent::__construct($url);
        $this->serviceName = 'biz-handbooks';
        $this->tmpDir = env('TMP_DIR');
    }

    public function getHandbooks(array $input): ResultDto {
        return $this->get('/handbooks', $this->prepareGetParams($input));
    }

    public function setHandbook(array $input): ResultDto {
        return $this->post('/handbooks', [], [
            'multipart' => $this->prepareMultipartForm($input)
        ]);
    }

    public function updateHandbook(array $input): ResultDto {
        return $this->put('/handbooks', $input);
    }

    public function getHandbookData(array $input): ResultDto {
        return $this->get('handbooks/value', $this->prepareGetParams($input));
    }

    public function setHandbookData(array $input): ResultDto {
        return $this->post('/handbooks/value', [], [
            'multipart' => $this->prepareMultipartForm($input)
        ]);
    }

    public function updateHandbookData(array $input): ResultDto {
        return $this->put('/handbooks/value', $input);
    }


    public function dumpHandbooks(array $params): ResultDto {
        if (!isset($params['field'])) {
            return new ResultDto(0, 'NOT FOUND PARAM', ['errorType' => 'notFound']);
        }

        $field = $params['field'];
        $module = $params['module'] ?? 'common';

        $hndb = [
            'common' => [
                'languageId' => [
                    'id' => 1,
                    'description' => 'Справочник языков',
                    'items' => [
                        1 => 'Русский',
                        2 => 'English'
                    ],
                ]
            ],
            'claim' => [
                'typeId' => [
                    'id' => 1,
                    'description' => 'Справочник типов обращений',
                    'items' => [
                        101 => 'Не могу открыть замок велосида',
                        102 => 'Не могу завершить аренду',
                        103 => 'Выключился самокат во время движения',
                        201 => 'Сломан элемент техники',
                        202 => 'Не работает газ/тормоз самоката ',
                        301 => 'Образование задолженности',
                        302 => 'Списана сумма больше, чем должна была быть',
                        303 => 'Списаны деньги, но аренды не было'
                    ],
                ],
                'statusId' => [
                    'id' => 2,
                    'description' => 'Справочник статусов обращений',
                    'items' => [
                        1 => 'Новое',
                        2 => 'В работе',
                        3 => 'Завершенное'
                    ],
                ]
            ]
        ];

        if (!isset($hndb[$module][$field])) {
            return new ResultDto(0, 'NOT FOUND hndb by field', ['errorType' => 'notFound']);
        }

        return new ResultDto(1, 'FOUND', $hndb[$module][$field]);
    }
}