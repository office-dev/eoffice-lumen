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

namespace Tests\EOffice\Packages\Core;

use EOffice\Core\Application;
use EOffice\Testing\TestCase;

/**
 * @covers \EOffice\Core\Application
 */
class ApplicationTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp(); // TODO: Change the autogenerated stub
    }

    public function test_it_should_detect_base_path(): void
    {
        $app = new Application();
        $this->assertSame(getcwd(), $app->basePath());
    }
}
