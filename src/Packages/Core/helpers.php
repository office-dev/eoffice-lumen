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

use EOffice\Packages\Core\Providers\RouteServiceProvider;

if ( ! function_exists('route_register_web')) {
    /**
     * Register web routes.
     *
     * @param string      $filePath
     * @param string      $prefix
     * @param string|null $namespace
     * @psalm-suppress DuplicateFunction
     */
    function route_register_web(string $filePath, string $prefix = '/', ?string $namespace = null): void
    {
        RouteServiceProvider::addWebRoute($filePath, $prefix, $namespace);
    }
}

if ( ! function_exists('route_register_api')) {
    /**
     * Register api routes.
     *
     * @param string      $filePath
     * @param string|null $namespace
     * @psalm-suppress DuplicateFunction
     */
    function route_register_api(string $filePath, ?string $namespace=null): void
    {
        RouteServiceProvider::addApiRoute($filePath, $namespace);
    }
}
