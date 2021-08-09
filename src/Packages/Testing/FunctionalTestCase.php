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

namespace EOffice\Packages\Testing;

use EOffice\Packages\Core\EOffice;
use EOffice\Packages\Core\Exceptions\CoreException;
use Laravel\Lumen\Testing\TestCase;

class FunctionalTestCase extends TestCase
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
}
