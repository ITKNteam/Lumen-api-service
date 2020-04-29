<?php

namespace App\Http\Controllers;

use App\Models\ResultDto;
use Illuminate\Http\Request;
use Laravel\Lumen\Routing\Controller as BaseController;
use Sentry;
use Exception;

class Controller extends BaseController {
    /**
     * Check params in request
     * @param Request $request
     * @param $key
     */
    public function requestHas(Request $request, $key) {
        if (!$request->has($key)) {
            if (is_array($key)) {
                abort(400, "Missing parameter one of: " . implode(',', $key));
            } else {
                abort(400, "Missing parameter: $key");
            }
        }
    }

    public function getRequestFields(Request $request, array $fields): array {
        $this->requestHas($request, $fields);
        $requestFields = [];

        foreach ($fields as $field) {
            $requestFields[$field] = $request->get($field);
        }

        return $requestFields;
    }

    public function sentryAbort(Exception $e) {
        Sentry\captureException($e);
        abort(in_array($e->getCode(), [200, 500, 409, 400, 404]) ? $e->getCode() : 500, $e->getMessage());
    }

    public function responseJSON(ResultDto $result) {
        return response()->json($result->getResult());
    }
}
