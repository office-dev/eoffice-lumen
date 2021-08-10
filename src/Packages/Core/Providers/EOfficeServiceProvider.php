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

namespace EOffice\Packages\Core\Providers;

use EOffice\Packages\Resource\Providers\ResourceServiceProvider;
use EOffice\Packages\User\Providers\UserServiceProvider;
use Illuminate\Support\ServiceProvider;

class EOfficeServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->loadViewsFrom(realpath(__DIR__.'/../Resources/views'), 'core');
    }

    public function register()
    {
        $this->app->register(ResourceServiceProvider::class);
        $this->app->register(UserServiceProvider::class);

        if ('local' === env('APP_ENV', 'local')) {
            $this->app->register('Flipbox\LumenGenerator\LumenGeneratorServiceProvider');
        }
    }
}
