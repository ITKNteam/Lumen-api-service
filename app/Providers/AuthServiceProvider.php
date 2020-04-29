<?php

namespace App\Providers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;
use App\Models\User;
use App\Providers\transport\AuthHandler;

class AuthServiceProvider extends ServiceProvider {

    private $authHandler;

    function __construct($app) {
        parent::__construct($app);
        $this->authHandler = new AuthHandler(env('auth_uri'));
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
            return new User($this->getAuthUserId($request));
        });
    }

    private function getAuthUserId(Request $request): int {
        $token = $request->header('authorization');

        if (empty($token)) {
            abort(403, 'Invalid token.');
        }

        return (int) $this->authHandler->validateToken([
            'token' => trim(str_replace("Bearer", "", $token))
        ])->getData('user_id');
    }
}
