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

namespace EOffice\Contracts\User\Model;

interface User
{
    public function getId(): string;

    public function getUsername(): string;

    public function getEmail(): string;

    public function getPassword(): string;

    public function updatePassword(string $password): void;

    public function update(string $username, string $email): void;
}
