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

if (is_dir($dir =__DIR__.'/../storage/logs')) {
    try {
        include __DIR__.'/../public/index.php';
    } catch (\Exception $e) {
        echo $e->getMessage();
    }
}
