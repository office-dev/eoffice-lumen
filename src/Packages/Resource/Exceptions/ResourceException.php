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

namespace EOffice\Packages\Resource\Exceptions;

class ResourceException extends \Exception
{
    public static function nullModelPath(): self
    {
        return new self(
            'Model direktori tidak boleh bernilai null'
        );
    }

    public static function modelDirNotExists(mixed $dir)
    {
        return new self(sprintf(
            'Model direktori "%s" tidak ditemukan.',
            $dir
        ));
    }
}
