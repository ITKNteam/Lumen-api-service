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
        $fields = $this->getRequestFields($request, ['channels', 'template']);
        $fields['userId'] = $request->user()->getId();
        $fields['message_data'] = $request->get('message_data');
        $fields['email'] = $request->get('email');
        $fields['phone'] = $request->get('phone');
        $fields['android_token'] = $request->get('android_token');
        $fields['ios_token'] = $request->get('ios_token');
        $fields['send_dt'] = $request->get('send_dt');

        return $this->notificationsHandler->sendNotifications($fields)->getResult();
    }
}
