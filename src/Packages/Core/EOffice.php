<?php

namespace EOffice\Packages\Core;

use EOffice\Packages\Core\Exceptions\CoreException;
use EOffice\Packages\Core\Exceptions\Handler;
use Illuminate\Contracts\Console\Kernel;
use Illuminate\Contracts\Debug\ExceptionHandler;
use Laravel\Lumen\Bootstrap\LoadEnvironmentVariables;
use Symfony\Component\HttpKernel\HttpKernelInterface;

/**
 * EOffice Bootstrapper
 * @codeCoverageIgnore
 */
class EOffice
{
    /**
     * @var HttpKernelInterface|Application
     */
    private $app;

    public function bootstrap(): EOffice
    {
        $app = $this->createApplication();

        $app->withFacades();

        $app->singleton(ExceptionHandler::class, Handler::class);
        $app->singleton(Kernel::class, Console\Kernel::class);
        $app->configure('app');

        $this->app = $app;

        $this->registerProviders();

        return $this;
    }

    /**
     * @return Application|HttpKernelInterface
     */
    public function getApplication()
    {
        return $this->app;
    }

    /**
     * Create new application
     *
     * @return Application|HttpKernelInterface
     * @throws CoreException
     */
    private function createApplication()
    {
        $basePath = $this->detectPath();
        (new LoadEnvironmentVariables($basePath))->bootstrap();
        date_default_timezone_set((string)env('APP_TIMEZONE', 'UTC'));

        return new Application($basePath);
    }

    /**
     * Detect app path
     *
     * @return string
     * @throws CoreException
     */
    private function detectPath(): string
    {
        if(is_dir($dir = __DIR__.'/../../../vendor')){
            return realpath(dirname($dir));
        }

        throw CoreException::undetectedBasePathDir();
    }

    private function registerProviders(): void
    {
        $app = $this->app;

        $app->register(Providers\EOfficeServiceProvider::class);
        $app->register(Providers\AuthServiceProvider::class);
        $app->register(Providers\EventServiceProvider::class);
        $app->register(Providers\RouteServiceProvider::class);
    }
}
