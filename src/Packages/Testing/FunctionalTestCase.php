<?php

namespace EOffice\Packages\Testing;

use EOffice\Packages\Core\Application;
use EOffice\Packages\Core\EOffice;
use Laravel\Lumen\Testing\TestCase;
use Symfony\Component\HttpKernel\HttpKernelInterface;

class FunctionalTestCase extends TestCase
{
    /**
     * @return Application|HttpKernelInterface
     */
    public function createApplication()
    {
        return (new EOffice())->bootstrap()->getApplication();
    }
}
