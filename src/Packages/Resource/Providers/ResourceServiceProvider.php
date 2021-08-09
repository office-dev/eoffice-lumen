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

namespace EOffice\Packages\Resource\Providers;

use Illuminate\Support\ServiceProvider;
use LaravelDoctrine\Extensions\GedmoExtensionsServiceProvider;
use LaravelDoctrine\ORM\DoctrineServiceProvider;

class ResourceServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->registerProviders();
        $config = config();
    }

    private function registerProviders(): void
    {
        $this->app->register(GedmoExtensionsServiceProvider::class);
        $this->app->register(DoctrineServiceProvider::class);
    }
}
