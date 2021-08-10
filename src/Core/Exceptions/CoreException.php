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

namespace EOffice\Core\Exceptions;

class CoreException extends \Exception
{
    public static function undetectedBasePathDir(): self
    {
        return new self(
            'Gagal deteksi direktori aplikasi.'
        );
    }
}
