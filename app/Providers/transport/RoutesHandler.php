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
        $this->serviceName = 'routes';
    }

    public function getHeadings(array $input): ResultDto {
        return $this->get('routes/headings', $this->prepareGetParams($input));
    }

    public function setHeading(array $input): ResultDto {
        return $this->post('routes/headings', [], [
            'multipart' => $this->prepareMultipartForm($input)
        ]);
    }

    public function updateHeading(array $input): ResultDto {
        return $this->put('routes/headings', $input);
    }

    public function deleteHeadings(array $input): ResultDto {
        return $this->delete('routes/headings', $this->prepareGetParams($input));
    }

    public function getRoutesShop(array $input): ResultDto {
        return $this->get('routes/list/shop', $this->prepareGetParams($input));
    }

    public function getRoutesUser(array $input): ResultDto {
        return $this->get('routes/list/user', $this->prepareGetParams($input));
    }

    public function setRoute(array $input, $files = null): ResultDto {
        return $this->post('routes/list', [], [
            'multipart' => $this->prepareMultipartForm($input, $files)
        ]);
    }

    public function updateRoute(array $input): ResultDto {
        return $this->put('routes/list', $input);
    }

    public function deleteRoutes(array $input): ResultDto {
        return $this->delete('routes/list', $this->prepareGetParams($input));
    }

    public function updatePosterRoute(array $input, $files = null): ResultDto {
        return $this->post('routes/list/poster', [], [
            'multipart' => $this->prepareMultipartForm($input, $files)
        ]);
    }

    public function purchaseRoute(array $input): ResultDto {
        return $this->post('routes/purchase', [], [
            'multipart' => $this->prepareMultipartForm($input)
        ]);
    }

    public function deletePurchasesRoutes(array $input): ResultDto {
        return $this->delete('routes/purchase', $this->prepareGetParams($input));
    }

    public function getPoints(array $input): ResultDto {
        return $this->get('routes/points', $this->prepareGetParams($input));
    }

    public function setPoints(array $input): ResultDto {
        return $this->post('routes/points', [], [
            'multipart' => $this->prepareMultipartForm($input)
        ]);
    }

    public function updatePoint(array $input): ResultDto {
        return $this->put('routes/points', $input);
    }

    public function deletePoints(array $input): ResultDto {
        return $this->delete('routes/points', $this->prepareGetParams($input));
    }

    public function getComments(array $input): ResultDto {
        return $this->get('routes/comments', $this->prepareGetParams($input));
    }

    public function setComment(array $input): ResultDto {
        return $this->post('routes/comments', [], [
            'multipart' => $this->prepareMultipartForm($input)
        ]);
    }

    public function updateComment(array $input): ResultDto {
        return $this->put('routes/comments', $input);
    }

    public function deleteComments(array $input): ResultDto {
        return $this->delete('routes/comments', $this->prepareGetParams($input));
    }

    public function getRouteCommentsRatingReviews(array $input): ResultDto {
        return $this->get('routes/comments/rating_reviews', $this->prepareGetParams($input));
    }

    public function getAudit(array $input): ResultDto {
        return $this->get('routes/audit', $this->prepareGetParams($input));
    }

    public function getFilters(array $input): ResultDto {
        return $this->get('routes/filters', $this->prepareGetParams($input));
    }

    public function setFilter(array $input): ResultDto {
        return $this->post('routes/filters', [], [
            'multipart' => $this->prepareMultipartForm($input)
        ]);
    }

    public function updateFilter(array $input): ResultDto {
        return $this->put('routes/filters', $input);
    }

    public function deleteFilters(array $input): ResultDto {
        return $this->delete('routes/filters', $this->prepareGetParams($input));
    }

    public function getStatuses(array $input): ResultDto {
        return $this->get('routes/statuses', $this->prepareGetParams($input));
    }

    public function setStatus(array $input): ResultDto {
        return $this->post('routes/statuses', [], [
            'multipart' => $this->prepareMultipartForm($input)
        ]);
    }

    public function updateStatus(array $input): ResultDto {
        return $this->put('routes/statuses', $input);
    }

    public function deleteStatuses(array $input): ResultDto {
        return $this->delete('routes/statuses', $this->prepareGetParams($input));
    }
}
