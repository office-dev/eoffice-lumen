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

namespace Functional\EOffice\Packages\Resource\Providers;

use EOffice\Packages\Testing\Concerns\InteractsWithServiceProvider;
use EOffice\Packages\Testing\FunctionalTestCase;
use LaravelDoctrine\Extensions\GedmoExtensionsServiceProvider;
use LaravelDoctrine\ORM\DoctrineServiceProvider;

/**
 * @covers \EOffice\Packages\Resource\Providers\ResourceServiceProvider
 */
class ResourceServiceProviderTest extends FunctionalTestCase
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
