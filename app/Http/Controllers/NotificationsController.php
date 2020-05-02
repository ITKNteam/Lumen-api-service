<?php

namespace App\Http\Controllers;

use App\Providers\transport\NotificationsHandler;
use Illuminate\Http\Request;
use Exception;

class NotificationsController extends Controller {

    private $notificationsHandler;

    /**
     * UserController constructor.
     * @throws Exception
     */
    function __construct() {
        $this->notificationsHandler = new NotificationsHandler(env('NOTIFIER_URI'));
    }

    public function sendNotifications(Request $request) {
        $params = $request->all();
        $params['userId'] = $request->user()->getId();
        return $this->responseJSON($this->notificationsHandler->sendNotifications($params));
    }
}
