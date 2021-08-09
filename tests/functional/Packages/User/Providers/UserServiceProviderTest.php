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

namespace Functional\EOffice\Packages\User\Providers;

use Doctrine\ORM\Mapping\ClassMetadata;
use EOffice\Packages\Testing\FunctionalTestCase;
use EOffice\Packages\User\Model\User;
use EOffice\Packages\User\Providers\UserServiceProvider;
use LaravelDoctrine\ORM\Facades\EntityManager;

/**
 * @covers \EOffice\Packages\User\Providers\UserServiceProvider
 */
class UserServiceProviderTest extends FunctionalTestCase
{
    public function test_it_should_be_loaded(): void
    {
        $this->assertTrue(
            $this->app->providerIsLoaded(UserServiceProvider::class)
        );
    }

    public function test_it_should_configure_user_model(): void
    {
        $mappings = (array) config('doctrine.managers.default.mappings', []);
        $this->assertArrayHasKey('EOffice\\Packages\\User\\Model', $mappings);

        $metadata = EntityManager::getClassMetadata(User::class);
        $this->assertInstanceOf(
            ClassMetadata::class,
            $metadata
        );
    }
}
