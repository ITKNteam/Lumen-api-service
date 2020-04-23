<?php

namespace App\Http\Controllers;

use App\Providers\transport\NotificationsHandler;
use App\Providers\transport\MediaHandler;
use Illuminate\Http\Request;
use Exception;

class NotificationsController extends Controller {

    private $notificationsHandler;

    private $userCntrl;

    /**
     * UserController constructor.
     * @throws Exception
     */
    function __construct() {
        $this->notificationsHandler = new NotificationsHandler(env('notifier_uri'));
        $this->userCntrl = new UserController();
    }

    public function sendNotifications(Request $request) {
        $fields = $this->getRequestFields($request, ['channels', 'template']);
        $fields['userId'] = $this->userCntrl->getUserId($request);
        $fields['message_data'] = $request->get('message_data');
        $fields['email'] = $request->get('email');
        $fields['phone'] = $request->get('phone');
        $fields['android_token'] = $request->get('android_token');
        $fields['ios_token'] = $request->get('ios_token');
        $fields['send_dt'] = $request->get('send_dt');

        return $this->notificationsHandler->sendNotifications($fields)->getResult();
    }
}
