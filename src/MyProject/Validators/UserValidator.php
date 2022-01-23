<?php

namespace MyProject\Validators;

use MyProject\Exceptions\InvalidArgumentException;
use MyProject\Models\Users\User;

class UserValidator
{
    /**
     * @param array $userData
     * @throws InvalidArgumentException
     */
    static function validateSignUp(array $userData): void
    {
        self::validateEmailNotEmpty($userData['email']);
        self::validatePasswordNotEmpty($userData['password']);

        if (empty($userData['nickname'])) {
            throw new InvalidArgumentException('Enter your nickname');
        }

        if (!preg_match('/^[a-zA-Z0-9]+$/', $userData['nickname'])) {
            throw new InvalidArgumentException('Nickname can only consist of symbols of the Latin alphabet and numbers');
        }

        if (!filter_var($userData['email'], FILTER_VALIDATE_EMAIL)) {
            throw new InvalidArgumentException('Email is incorrect');
        }

        if (mb_strlen($userData['password']) < 8) {
            throw new InvalidArgumentException('Password must be at least 8 characters');
        }

        if (User::findOneByColumn('nickname', $userData['nickname']) !== null) {
            throw new InvalidArgumentException('User with this nickname already exists');
        }

        if (User::findOneByColumn('email', $userData['email']) !== null) {
            throw new InvalidArgumentException('User with this email already exists');
        }
    }

    /**
     * @param array $loginData
     * @param User|null $user
     * @throws InvalidArgumentException
     */
    public static function validateLogin(array $loginData, ?User $user): void
    {
        self::validateEmailNotEmpty($loginData['email']);
        self::validatePasswordNotEmpty($loginData['password']);

        if ($user === null) {
            throw new InvalidArgumentException('No user with this email');
        }

        if (!password_verify($loginData['password'], $user->getPasswordHash())) {
            throw new InvalidArgumentException('Invalid password');
        }

        if (!$user->isConfirmed()) {
            throw new InvalidArgumentException('User not verified');
        }
    }

    /**
     * @param string|null $email
     * @throws InvalidArgumentException
     */
    private static function validateEmailNotEmpty(?string $email): void
    {
        if (empty($email)) {
            throw new InvalidArgumentException('Enter your email');
        }
    }

    /**
     * @param string|null $password
     * @throws InvalidArgumentException
     */
    private static function validatePasswordNotEmpty(?string $password): void
    {
        if (empty($password)) {
            throw new InvalidArgumentException('Enter your password');
        }
    }
}