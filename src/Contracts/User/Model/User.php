<?php

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
