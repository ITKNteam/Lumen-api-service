<?php

namespace App\Providers\transport;

use App\Models\ResultDto;

class ObjectsHandler extends Handler {

    function __construct(string $url) {
        parent::__construct($url);
        $this->serviceName = 'objects';
    }

    public function getObjectTypes(array $input): ResultDto {
        return $this->get('objects/types', $this->prepareGetParams($input));
    }

    public function setObjectType(array $input): ResultDto {
        return $this->post('objects/types', [], [
            'multipart' => $this->prepareMultipartForm($input)
        ]);
    }

    public function updateObjectType(array $input): ResultDto {
        return $this->put('objects/types', $input);
    }

    public function deleteObjectTypes(array $input): ResultDto {
        return $this->delete('objects/types', $this->prepareGetParams($input));
    }

    public function getObjectSubtypes(array $input): ResultDto {
        return $this->get('objects/subtypes', $this->prepareGetParams($input));
    }

    public function setObjectSubtype(array $input): ResultDto {
        return $this->post('objects/subtypes', [], [
            'multipart' => $this->prepareMultipartForm($input)
        ]);
    }

    public function updateObjectSubtype(array $input): ResultDto {
        return $this->put('objects/subtypes', $input);
    }

    public function deleteObjectSubtypes(array $input): ResultDto {
        return $this->delete('objects/subtypes', $this->prepareGetParams($input));
    }

    public function getObjects(array $input): ResultDto {
        return $this->get('objects/list', $this->prepareGetParams($input));
    }

    public function setObject(array $input): ResultDto {
        return $this->post('objects/list', [], [
            'multipart' => $this->prepareMultipartForm($input)
        ]);
    }

    public function updateObject(array $input): ResultDto {
        return $this->put('objects/list', $input);
    }

    public function deleteObjects(array $input): ResultDto {
        return $this->delete('objects/list', $this->prepareGetParams($input));
    }

    public function getComments(array $input): ResultDto {
        return $this->get('objects/comments', $this->prepareGetParams($input));
    }

    public function setComment(array $input): ResultDto {
        return $this->post('objects/comments', [], [
            'multipart' => $this->prepareMultipartForm($input)
        ]);
    }

    public function updateComment(array $input): ResultDto {
        return $this->put('objects/comments', $input);
    }

    public function deleteComments(array $input): ResultDto {
        return $this->delete('objects/comments', $this->prepareGetParams($input));
    }

    public function getAudit(array $input): ResultDto {
        return $this->get('objects/audit', $this->prepareGetParams($input));
    }

    public function getFileTypes(array $input): ResultDto {
        return $this->get('objects/file/types', $this->prepareGetParams($input));
    }

    public function setFileType(array $input): ResultDto {
        return $this->post('objects/file/types', [], [
            'multipart' => $this->prepareMultipartForm($input)
        ]);
    }

    public function updateFileType(array $input): ResultDto {
        return $this->put('objects/file/types', $input);
    }

    public function getAttachedFiles(array $input): ResultDto {
        return $this->get('objects/file/attached', $this->prepareGetParams($input));
    }

    public function setAttachedFile(array $input, $files): ResultDto {
        return $this->post('objects/file/attached', [], [
            'multipart' => $this->prepareMultipartForm($input, $files)
        ]);
    }

    public function deleteAttachedFiles(array $input): ResultDto {
        return $this->delete('objects/file/attached', $this->prepareGetParams($input));
    }

    public function updateAttachedFile(array $input): ResultDto {
        return $this->put('objects/file/attached', $input);
    }

    public function linkFileToFile(array $input, $files): ResultDto {
        return $this->post('objects/file/attached/link', [], [
            'multipart' => $this->prepareMultipartForm($input, $files)
        ]);
    }

    public function unlinkFileFromFile(array $input): ResultDto {
        return $this->put('objects/file/attached/link', $input);
    }
}