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

namespace Tests\EOffice\Packages\Resource\Providers;

use EOffice\Testing\Concerns\InteractsWithServiceProvider;
use EOffice\Testing\TestCase;
use LaravelDoctrine\Extensions\GedmoExtensionsServiceProvider;
use LaravelDoctrine\ORM\DoctrineServiceProvider;

/**
 * @covers \EOffice\Resource\Providers\ResourceServiceProvider
 */
class ResourceServiceProviderTest extends TestCase
{
    use InteractsWithServiceProvider;

    public function getRequiredProviders(): array
    {
        return [
            GedmoExtensionsServiceProvider::class,
            DoctrineServiceProvider::class,
        ];
    }
}
