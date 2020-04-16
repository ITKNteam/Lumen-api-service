<?php

namespace App\Http\Controllers;

use Laravel\Lumen\Routing\Controller as BaseController;

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
}
