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

namespace Tests\EOffice\Packages\Resource\Helpers;

use EOffice\Packages\Resource\Exceptions\ResourceException;
use EOffice\Packages\Testing\TestCase;
use LaravelDoctrine\Extensions\Timestamps\TimestampableExtension;

/**
 * @covers \load_doctrine_extension
 * @covers \EOffice\Packages\Resource\Exceptions\ResourceException
 */
class LoadDoctrineExtensionTest extends TestCase
{
    public function test_it_should_load_doctrine_extension(): void
    {
        load_doctrine_extension(TimestampableExtension::class);

        $this->assertContains(
            TimestampableExtension::class,
            (array) config('doctrine.extensions', [])
        );
    }

    public function test_it_throws_exception_when_extension_lass_not_exists(): void
    {
        $this->expectExceptionObject($ob = ResourceException::doctrineExtensionClassNotExists('foo'));
        $this->expectExceptionMessage($ob->getMessage());

        load_doctrine_extension('foo');
    }
}
