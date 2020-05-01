<?php

namespace App\Providers;

use App\Models\ResultDto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;
use App\Models\User;
use App\Providers\transport\AuthHandler;

class AuthServiceProvider extends ServiceProvider {

    private $authHandler;

    function __construct($app) {
        parent::__construct($app);
        $this->authHandler = new AuthHandler(env('AUTH_URI'));
    }

    /**
     * Boot the authentication services for the application.
     *
     * @return void
     */
    public function boot() {
        // Here you may define how you wish users to be authenticated for your Lumen
        // application. The callback which receives the incoming request instance
        // should return either a User instance or null. You're free to obtain
        // the User instance via an API token or any other method necessary.

        $this->app['auth']->viaRequest('api', function ($request) {
            $resultAuth = $this->getAuthUserId($request);
            if($resultAuth->isSuccess()){
                return new User($resultAuth->getData('user_id'));
            }
        });
        return null;
    }

    private function getAuthUserId(Request $request) {
        $token = $request->header('authorization');

        if (empty($token)) {
            return  (new ResultDto(0, 'Invalid token.', [], 403));
        }

         $resValidateToken = $this->authHandler->validateToken([
            'token' => trim(str_replace("Bearer", "", $token))
        ]);
        if ($resValidateToken->isSuccess()){
            return $resValidateToken;
        } else {
            return  (new ResultDto(0, 'Invalid token.', [], 403));
        }
    }
}
