<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Laravel\Lumen\Application;

class UserServiceProvider extends ServiceProvider {
    /**
     * @var Application
     */
    protected $app;

    /**
     * MediaServiceProvider constructor.
     * @param Application $app
     */
    function __construct(Application $app) {
        parent::__construct($app);
    }
}
