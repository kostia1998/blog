<?php

namespace MyProject\Validators;

use MyProject\Exceptions\InvalidArgumentException;

class ArticleValidator
{
    /**
     * @param array $articleRequestsArray
     * @throws InvalidArgumentException
     */
    public static function validate(array $articleRequestsArray): void
    {
        if (empty($articleRequestsArray['name'])) {
            throw new InvalidArgumentException('Article title not submitted');
        }

        if (empty($articleRequestsArray['text'])) {
            throw new InvalidArgumentException('The text of the article has not been submitted');
        }

        if (empty($articleRequestsArray['description'])) {
            throw new InvalidArgumentException('The description of the article has not been submitted');
        }
    }
}