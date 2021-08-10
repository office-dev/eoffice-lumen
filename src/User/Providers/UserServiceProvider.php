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

namespace EOffice\User\Providers;

use EOffice\Resource\Exceptions\ResourceException;
use Illuminate\Support\ServiceProvider;
use function register_model;

class UserServiceProvider extends ServiceProvider
{
    /**
     * @throws ResourceException
     */
    public function register()
    {
        $this->registerModels();
    }

    /**
     * @throws ResourceException
     */
    private function registerModels(): void
    {
        register_model('EOffice\\User\\Model', [
            'path' => realpath(__DIR__.'/../Model'),
            'type' => 'annotation',
        ]);
    }
}
