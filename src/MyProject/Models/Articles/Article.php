<?php

namespace MyProject\Models\Articles;

use MyProject\Exceptions\InvalidArgumentException;
use MyProject\Models\ActiveRecordEntity;
use MyProject\Models\Users\User;
use MyProject\Validators\ArticleValidator;

class Article extends ActiveRecordEntity
{
    /** @var string */
    protected string $name;

    /** @var string */
    protected string $text;

    /** @var string  */
    protected string $description;

    /** @var int */
    protected int $authorId;

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return Article
     */
    public function setName(string $name): Article
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return string
     */
    public function getText(): string
    {
        return $this->text;
    }

    /**
     * @param string $text
     * @return Article
     */
    public function setText(string $text): Article
    {
        $this->text = $text;
        return $this;
    }

    /**
     * @return User
     */
    public function getAuthor(): User
    {
        return User::getById($this->authorId);
    }

    /**
     * @param User $user
     * @return Article
     */
    public function setAuthor(User $user): Article
    {
        $this->authorId = $user->getId();
        return $this;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @param string $description
     * @return Article
     */
    public function setDescription(string $description): Article
    {
        $this->description = $description;
        return $this;
    }

    /**
     * @param array $fields
     * @param User $author
     * @return Article
     * @throws InvalidArgumentException
     */
    public static function createFromArray(array $fields, User $author): Article
    {
        ArticleValidator::validate($fields);

        $article = (new Article())
            ->setAuthor($author)
            ->setDescription($fields['description'])
            ->setName($fields['name'])
            ->setText($fields['text']);

        $article->save();

        return $article;
    }

    /**
     * @param array $fields
     * @return $this
     * @throws InvalidArgumentException
     */
    public function updateFromArray(array $fields): Article
    {
        ArticleValidator::validate($fields);

        $this->setDescription($fields['description'])
            ->setName($fields['name'])
            ->setText($fields['text']);

        $this->save();

        return $this;
    }

    /**
     * @return string
     */
    protected static function getTableName(): string
    {
        return 'articles';
    }
}