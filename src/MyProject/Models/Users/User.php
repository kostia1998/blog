<?php

namespace MyProject\Models\Users;

use Exception;
use MyProject\Exceptions\InvalidArgumentException;
use MyProject\Models\ActiveRecordEntity;
use MyProject\Validators\UserValidator;

class User extends ActiveRecordEntity
{
    /** @var string */
    protected string $nickname;

    /** @var string */
    protected string $email;

    /** @var int */
    protected int $isConfirmed;

    /** @var string */
    protected string $role;

    /** @var string */
    protected string $passwordHash;

    /** @var string */
    protected string $authToken;

    /**
     * @return string
     */
    public function getNickname(): string
    {
        return $this->nickname;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @return string
     */
    public function getAuthToken(): string
    {
        return $this->authToken;
    }

    /**
     * @return string
     */
    public function getPasswordHash(): string
    {
        return $this->passwordHash;
    }

    /**
     * @return bool
     */
    public function isConfirmed(): bool
    {
        return $this->isConfirmed;
    }

    /**
     * @return bool
     */
    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }

    public function activate(): void
    {
        $this->isConfirmed = true;
        $this->save();
    }

    /**
     * @param array $userData
     * @return User
     * @throws InvalidArgumentException
     * @throws Exception
     */
    public static function signUp(array $userData): User
    {
        UserValidator::validateSignUp($userData);

        $user = new User();
        $user->nickname = $userData['nickname'];
        $user->email = $userData['email'];
        $user->passwordHash = password_hash($userData['password'], PASSWORD_DEFAULT);
        $user->isConfirmed = false;
        $user->role = 'user';
        $user->authToken = sha1(random_bytes(100)) . sha1(random_bytes(100));
        $user->save();

        return $user;
    }

    /**
     * @param array $loginData
     * @return User
     * @throws InvalidArgumentException
     * @throws Exception
     */
    public static function login(array $loginData): User
    {
        $user = User::findOneByColumn('email', $loginData['email']);

        UserValidator::validateLogin($loginData, $user);

        $user->refreshAuthToken();
        $user->save();

        return $user;
    }

    /**
     * @return string
     */
    protected static function getTableName(): string
    {
        return 'users';
    }

    /**
     * @throws Exception
     */
    private function refreshAuthToken()
    {
        $this->authToken = sha1(random_bytes(100)) . sha1(random_bytes(100));
    }
}
