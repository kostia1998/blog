<?php
/**
 * @var \MyProject\Models\Articles\Article $article
 */
include __DIR__ . '/../header.php';
?>
    <h1>Editing an article</h1>
<?php if(!empty($error)): ?>
    <div style="color: red;"><?= $error ?></div>
<?php endif; ?>
    <form action="/articles/<?= $article->getId() ?>/edit" method="post">
        <label for="name">Article title</label><br>
        <input type="text" name="name" id="name" value="<?= $_POST['name'] ?? $article->getName() ?>" size="50"><br>
        <br>
        <label for="description">Article description</label><br>
        <input type="text" name="description" id="description" value="<?= $_POST['description'] ?? $article->getDescription() ?>" size="50"><br>
        <br>
        <label for="text">Article text</label><br>
        <textarea name="text" id="text" rows="10" cols="80"><?= $_POST['text'] ?? $article->getText() ?></textarea><br>
        <br>
        <input type="submit" value="Update">
    </form>
<?php include __DIR__ . '/../footer.php'; ?>

