<?php

namespace Radiate\Passwordless;

use Radiate\Http\Request;
use Radiate\Support\Facades\Auth;
use Radiate\Support\Facades\Response;
use Radiate\Support\Facades\Route;
use Radiate\Support\Facades\URL;
use Radiate\Support\ServiceProvider;

class PasswordlessServiceProvider extends ServiceProvider
{
    /**
     * Register the services
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('passwordless', function ($app) {
            return new LoginUrl($app['url'], $app['config']['passwordless']);
        });
    }

    /**
     * Boot the services
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes(
            [
                __DIR__ . '/resources/config/passwordless.php' => $this->app->basePath('config/passwordless.php'),
            ],
            'passwordless'
        );

        $this->registerRoute();
    }

    /**
     * Register the passwordless route
     *
     * @return void
     */
    public function registerRoute()
    {
        $config = $this->app['config']['passwordless'];
        $namespace = $config['namespace'] ?? 'passwordless';
        $route = $config['route'] ?? 'login';

        Route::namespace($namespace)->group(function () use ($route) {
            Route::get("{$route}/{uid}", function (Request $request) {
                if ($request->hasValidSignature()) {
                    Auth::loginUsingId($request->uid);

                    return Response::redirect($request->redirect_to ?? URL::admin());
                }

                return Response::redirect(URL::login());
            });
        });
    }
}
