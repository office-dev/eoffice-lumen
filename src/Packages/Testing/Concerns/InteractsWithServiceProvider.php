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

namespace EOffice\Packages\Testing\Concerns;

trait InteractsWithServiceProvider
{
    public function test_it_should_required_service_providers(): void
    {
        $app       = $this->app;
        $providers = $this->getRequiredProviders();
        foreach ($providers as $provider) {
            $this->assertTrue($app->providerIsLoaded($provider));
        }
    }

    abstract public function getRequiredProviders(): array;
}
