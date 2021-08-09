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

namespace EOffice\Packages\Core;

use EOffice\Packages\Core\Exceptions\CoreException;
use EOffice\Packages\Core\Exceptions\Handler;
use Illuminate\Contracts\Console\Kernel;
use Illuminate\Contracts\Debug\ExceptionHandler;
use Laravel\Lumen\Bootstrap\LoadEnvironmentVariables;
use Symfony\Component\HttpKernel\HttpKernelInterface;

/**
 * EOffice Bootstrapper.
 *
 * @codeCoverageIgnore
 * @psalm-suppress MissingConstructor
 * @psalm-suppress PossiblyUndefinedMethod
 */
class EOffice
{
    /**
     * @var HttpKernelInterface|Application
     */
    private $app;

    /**
     * @throws CoreException
     *
     * @return $this
     */
    public function bootstrap(): self
    {
        /** @psalm-param Application $app */
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
     * Create new application.
     *
     * @throws CoreException
     *
     * @return Application|HttpKernelInterface
     */
    private function createApplication()
    {
        $basePath = $this->detectPath();
        (new LoadEnvironmentVariables($basePath))->bootstrap();
        date_default_timezone_set((string) env('APP_TIMEZONE', 'UTC'));

        return new Application($basePath);
    }

    /**
     * Detect app path.
     *
     * @throws CoreException
     *
     * @return string
     */
    private function detectPath(): string
    {
        if (is_dir($dir = __DIR__.'/../../../vendor')) {
            return realpath(\dirname($dir));
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
