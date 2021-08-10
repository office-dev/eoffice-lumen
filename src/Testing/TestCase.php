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

namespace EOffice\Testing;

use EOffice\Core\EOffice;
use EOffice\Core\Exceptions\CoreException;
use Laravel\Lumen\Testing\TestCase as BaseTestCase;
use Mockery as m;

class TestCase extends BaseTestCase
{
    /**
     * {@inheritDoc}
     *
     * @throws CoreException
     */
    public function createApplication()
    {
        return (new EOffice())->bootstrap()->getApplication();
    }

    protected function tearDown(): void
    {
        m::close();
        parent::tearDown();
    }
}
