<?php

namespace Fixtures\EOffice;

class Fixtures
{
    public static function getModelPath(): string
    {
        return realpath(__DIR__.'/Model');
    }
}
