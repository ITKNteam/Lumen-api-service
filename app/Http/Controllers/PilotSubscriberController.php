<?php

namespace App\Http\Controllers;

use App\Providers\transport\TechHandler;
use Illuminate\Http\Request;
use Exception;

class PilotSubscriberController extends Controller {

    private $techHandler;

    private $userCntrl;

    /**
     * UserController constructor.
     * @throws Exception
     */
    function __construct() {
        $this->techHandler = new TechHandler(env('tech_uri'), env('tech_lumen_uri'));
        $this->userCntrl = new UserController();
    }

    public function pilotSubscriber(Request $request): array { // ???
        $this->techHandler->pilotSubscriber([])->getResult();
    }
}
