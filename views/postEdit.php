<div>
    <h1>Hello Edit</h1>
    <form method="post" action="index.php">
        <label for="title">Titre</label>
        <input id="title" name="title" type="text" value="<?= $data["data"]["post"]->title ?>">
        <label for="body">Text</label>
        <textarea id="body" name="body"><?= $data["data"]["post"]->body ?></textarea>
        <input type="submit" value="Mettre à jour cet article">
        <input type="hidden" name="a" value="update">
        <input type="hidden" name="r" value="post">
        <input type="hidden" name="id" value="<?= $data["data"]["post"]->id ?>">
    </form>
</div>