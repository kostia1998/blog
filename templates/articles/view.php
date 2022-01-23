<?php include __DIR__ . '/../header.php'; ?>
    <h1><?= $article->getName() ?></h1>
    <p><?= $article->getText() ?></p>
    <p>Author: <?= $article->getAuthor()->getNickname() ?></p>

    <? if ($user !== null && $user->isAdmin()): ?>
    <p><a href="/articles/<?= $article->getId() ?>/edit">Edit</a>
        <a href="/articles/<?= $article->getId() ?>/delete">Delete</a></p>

    <? endif ?>
<?php include __DIR__ . '/../footer.php'; ?>

