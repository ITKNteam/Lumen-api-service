<?php

namespace App\Providers\transport;

use App\Models\ResultDto;

class RoutesHandler extends Handler {
    /**
     * NotifierHandler constructor.
     * @param string $url
     * @throws \Exception
     */
    function __construct(string $url) {
        parent::__construct($url);
        $this->serviceName = 'biz-claim';
    }

    public function index($input): ResultDto {
        return $this->get('', $input);
    }

    public function getHeadings(array $input): ResultDto {
        return $this->get('headings', $this->prepareGetParams($input));
    }

    public function setHeading(array $input): ResultDto {
        return $this->post('headings', [], [
            'multipart' => $this->prepareMultipartForm($input)
        ]);
    }

    public function updateHeading(array $input): ResultDto {
        return $this->put('headings', [], [
            'form_params' => $input
        ]);
    }

    public function getRoutes(array $input): ResultDto {
        return $this->get('routes', $this->prepareGetParams($input));
    }

    public function getUserRoutes(array $input): ResultDto {
        return $this->get('routes/user', $this->prepareGetParams($input));
    }

    public function setRoute(array $input, $files = null): ResultDto {
        return $this->post('routes', [], [
            'multipart' => $this->prepareMultipartForm($input, $files)
        ]);
    }

    public function updatePosterRoute(array $input, $files = null): ResultDto {
        return $this->post('routes/poster', [], [
            'multipart' => $this->prepareMultipartForm($input, $files)
        ]);
    }

    public function updateRoute(array $input): ResultDto {
        return $this->put('routes', [], [
            'form_params' => $input
        ]);
    }

    public function deleteRoutes(array $input): ResultDto {
        return $this->delete('routes', $this->prepareGetParams($input));
    }

    public function paidRoute(array $input): ResultDto {
        return $this->post('routes/paid', [], [
            'multipart' => $this->prepareMultipartForm($input)
        ]);
    }

    public function getPoints(array $input): ResultDto {
        return $this->get('points', $this->prepareGetParams($input));
    }

    public function setPoint(array $input): ResultDto {
        return $this->post('points', [], [
            'multipart' => $this->prepareMultipartForm($input)
        ]);
    }

    public function setPointArr(array $input): ResultDto {
        return $this->post('points/arr', [], [
            'multipart' => $this->prepareMultipartForm($input)
        ]);
    }

    public function updatePoint(array $input): ResultDto {
        return $this->put('points', [], [
            'form_params' => $input
        ]);
    }

    public function deletePoints(array $input): ResultDto {
        return $this->delete('points', $this->prepareGetParams($input));
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
        return $this->put('comments', [], [
            'form_params' => $input
        ]);
    }

    public function deleteComments(array $input): ResultDto {
        return $this->delete('comments', $this->prepareGetParams($input));
    }

    public function getAudit(array $input): ResultDto {
        return $this->get('audit', $this->prepareGetParams($input));
    }
}