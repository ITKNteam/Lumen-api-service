<?php

namespace App\Providers\transport;

use App\Models\ResultDto;

class ObjectsHandler extends Handler {

    function __construct(string $url) {
        parent::__construct($url);
        $this->serviceName = 'objects';
    }

    public function deleteCreditCard(array $input): ResultDto {
        return $this->delete('billing/creditCard', $this->prepareGetParams($input));
    }

    public function index($input) {
        return $this->get('', $this->prepareGetParams($input));

    }

    public function getObjectTypes(array $input): ResultDto {
        return $this->get('object/types', $this->prepareGetParams($input));
    }

    public function setObjectType(array $input): ResultDto {
        return $this->post('object/types', [], [
            'multipart' => $this->prepareMultipartForm($input)
        ]);
    }

    public function updateObjectType(array $input): ResultDto {
        return $this->put('object/types', $input);
    }

    public function getObjectSubtypes(array $input): ResultDto {
        return $this->get('object/subtypes', $this->prepareGetParams($input));
    }

    public function setObjectSubtype(array $input): ResultDto {
        return $this->post('object/subtypes', [], [
            'multipart' => $this->prepareMultipartForm($input)
        ]);
    }

    public function updateObjectSubtype(array $input): ResultDto {
        return $this->put('object/subtypes', $input);
    }

    public function getPublicObjects(array $input): ResultDto {
        return $this->get('objects', $this->prepareGetParams($input));
    }

    public function getListObjects(array $input): ResultDto {
        return $this->get('objects/list', $this->prepareGetParams($input));
    }

    public function getUserObjects(array $input): ResultDto {
        return $this->get('objects/user', $this->prepareGetParams($input));
    }

    public function setObject(array $input): ResultDto {
        return $this->post('objects', [], [
            'multipart' => $this->prepareMultipartForm($input)
        ]);
    }

    public function updateObject(array $input): ResultDto {
        return $this->put('objects', $input);
    }

    public function deleteObjects(array $input): ResultDto {
        return $this->delete('objects', $this->prepareGetParams($input));
    }

    public function getComments(array $input): ResultDto {
        return $this->get('comments', $this->prepareGetParams($input));
    }

    public function setComment(array $input): ResultDto {
        return $this->post('comments', [], [
            'multipart' => $this->prepareMultipartForm($input)
        ]);
    }

    public function updateComment(array $input): ResultDto {
        return $this->put('comments', $input);
    }

    public function deleteComments(array $input): ResultDto {
        return $this->delete('comments', $this->prepareGetParams($input));
    }

    public function getAudit(array $input): ResultDto {
        return $this->get('audit', $this->prepareGetParams($input));
    }

    public function getFileTypes(array $input): ResultDto {
        return $this->get('file/types', $this->prepareGetParams($input));
    }

    public function setFileType(array $input): ResultDto {
        return $this->post('file/types', [], [
            'multipart' => $this->prepareMultipartForm($input)
        ]);
    }

    public function updateFileType(array $input): ResultDto {
        return $this->put('file/types', $input);
    }

    public function getAttachedFiles(array $input): ResultDto {
        return $this->get('file/attached', $this->prepareGetParams($input));
    }

    public function setAttachedFile(array $input, $files): ResultDto {
        return $this->post('file/attached', [], [
            'multipart' => $this->prepareMultipartForm($input, $files)
        ]);
    }

    public function deleteAttachedFiles(array $input): ResultDto {
        return $this->delete('file/attached', $this->prepareGetParams($input));
    }

    public function updateAttachedFile(array $input): ResultDto {
        return $this->put('file/attached', $input);
    }

    public function linkFileToFile(array $input, $files): ResultDto {
        return $this->post('file/attached/link', [], [
            'multipart' => $this->prepareMultipartForm($input, $files)
        ]);
    }

    public function unlinkFileFromFile(array $input): ResultDto {
        return $this->put('file/attached/link', $input);
    }
}