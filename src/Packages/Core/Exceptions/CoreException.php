<?php

namespace EOffice\Packages\Core\Exceptions;

class CoreException extends \Exception
{

    public static function undetectedBasePathDir(): self
    {
        return new self(
            'Gagal deteksi direktori aplikasi.'
        );
    }
}
