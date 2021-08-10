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

namespace EOffice\Resource\Exceptions;

class ResourceException extends \Exception
{
    public static function nullModelPath(): self
    {
        return new self(
            'Model direktori tidak boleh bernilai null'
        );
    }

    public static function modelDirNotExists(string $dir): self
    {
        return new self(sprintf(
            'Model direktori "%s" tidak ditemukan.',
            $dir
        ));
    }

    public static function doctrineExtensionClassNotExists(string $class): self
    {
        return new self(sprintf(
                'Tidak dapat menambahkan ekstensi doctrine, class "%s" tidak ditemukan.',
                $class
        ));
    }
}
