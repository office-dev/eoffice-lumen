<?php

/*
 * This file is part of the EOffice project.
 *
 * (c) Anthonius Munthi <https://itstoni.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace EOffice\Core\Providers;

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
     * @var array<array-key|string,null|string>
     */
    private static array $apiRoutes = [];

    public function boot(): void
    {
        $this->loadRoutes();
    }

    public function register(): void
    {
        route_register_web(__DIR__.'/../Resources/routes/web.php');
        route_register_api(__DIR__.'/../Resources/routes/api.php');
    }

    public static function addWebRoute(string $filePath, string $prefix = '/', ?string $namespace = null): void
    {
        $filePath                     = realpath($filePath);
        static::$webRoutes[$filePath] = [
            'namespace' => $namespace,
            'prefix' => $prefix,
        ];
    }

    public static function addApiRoute(string $filePath, ?string $namespace = null): void
    {
        $filePath                     = realpath($filePath);
        static::$apiRoutes[$filePath] = $namespace;
    }

    /**
     * @psalm-suppress UnresolvableInclude
     */
    private function loadRoutes(): void
    {
        foreach (static::$webRoutes as $filePath => $namespace) {
            Route::group(['prefix' => '/', 'namespace' => $namespace], function (Router $router) use ($filePath) {
                require $filePath;
            });
        }

        foreach (static::$apiRoutes as $filePath => $namespace) {
            Route::group(['prefix' => 'api', 'namespace' => $namespace], function (Router $router) use ($filePath) {
                require $filePath;
            });
        }
    }
}
