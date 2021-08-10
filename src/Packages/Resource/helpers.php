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

use EOffice\Packages\Resource\Exceptions\ResourceException;
use Illuminate\Config\Repository;
use Illuminate\Support\Facades\App;

if ( ! function_exists('register_model')) {
    /**
     * @param string                  $namespace
     * @param array<array-key,string> $options
     */
    function register_model(string $namespace, array $options): void
    {
        /** @var Repository $config */
        $config       = App('config');
        $managerName  = $options['manager_name'] ?? 'default';
        $type         = $options['type'] ?? 'annotation';
        $path         = $options['path'] ?? null;

        if (null === $path) {
            throw ResourceException::nullModelPath();
        }

        if ( ! is_dir($path)) {
            throw ResourceException::modelDirNotExists($path);
        }

        $existing = (array) $config->get('doctrine.managers.default.mappings', []);
        $key      = 'doctrine.managers.'.$managerName.'.mappings';
        $config->set($key, array_merge($existing, [
            $namespace => [
                'dir' => realpath($path),
                'type' => $type,
            ],
        ]));
    }
}

if ( ! function_exists('load_doctrine_extension')) {
    /**
     * @param string|class-string $class
     *
     * @throws ResourceException when class not exists
     */
    function load_doctrine_extension(string $class)
    {
        /** @var Repository $config */
        $config = App('config');

        $extensions   = (array) $config->get('doctrine.extensions', []);
        $extensions[] = $class;

        if ( ! class_exists($class)) {
            throw ResourceException::doctrineExtensionClassNotExists($class);
        }
        $config->set('doctrine.extensions', $extensions);
    }
}

if ( ! function_exists('public_path')) {
    /**
     * Get the path to the public folder.
     *
     * @param string $path
     *
     * @return string
     */
    function public_path($path = '')
    {
        return app()->make('path.public').($path ? \DIRECTORY_SEPARATOR.ltrim($path, \DIRECTORY_SEPARATOR) : $path);
    }
}

if ( ! function_exists('mix')) {
    /**
     * Get the path to a versioned Mix file.
     *
     * @param string $path
     * @param string $manifestDirectory
     *
     * @throws \Exception
     *
     * @return \Illuminate\Support\HtmlString|string
     */
    function mix($path, $manifestDirectory = '')
    {
        return app(\EOffice\Packages\UI\Mix::class)(...func_get_args());
    }
}
