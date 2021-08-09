<?php

namespace EOffice\Packages\Core\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use Laravel\Lumen\Routing\Router;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * @var array<array-key,array<array-key,null|string>>
     */
    private static array $webRoutes = [];

    /**
     * @var array<string|array-key,null|string>
     */
    private static array $apiRoutes = [];

    public function boot()
    {
        $this->loadRoutes();
    }

    public function register()
    {
        route_register_web(__DIR__.'/../Resources/routes/web.php');
        route_register_api(__DIR__.'/../Resources/routes/api.php');
    }


    public static function addWebRoute(string $filePath, string $prefix = '/', ?string $namespace = null): void
    {
        $filePath = realpath($filePath);
        static::$webRoutes[$filePath] = [
            'namespace' => $namespace,
            'prefix' => $prefix,
        ];
    }

    public static function addApiRoute(string $filePath,?string $namespace = null): void
    {
        $filePath = realpath($filePath);
        static::$apiRoutes[$filePath] = $namespace;
    }


    private function loadRoutes(): void
    {
        foreach(static::$webRoutes as $filePath => $namespace){
            Route::group(['prefix' => '/'], function(Router $router) use($filePath){
                assert(is_file($filePath));
                require $filePath;
            });
        }

        foreach(static::$apiRoutes as $filePath => $namespace){
            Route::group(['prefix' => 'api'], function(Router $router) use($filePath){
                assert(is_file($filePath));
                require $filePath;
            });
        }
    }


}
