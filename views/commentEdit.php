<div>
    <h1>Hello Edit</h1>
    <p><i>preview</i></p>
    <p><?= $data["data"]["comment"]->content ?></p>
    <form method="post" action="index.php">
        <textarea id="body" name="content"><?= $data["data"]["comment"]->content ?></textarea>
        <input type="submit" value="Mettre à jour votre commentaire">
        <input type="hidden" name="a" value="update">
        <input type="hidden" name="r" value="comment">
        <input type="hidden" name="id" value="<?= $data["data"]["comment"]->id ?>">
        <input type="hidden" name="postid" value="<?= $data["data"]["comment"]->postid ?>">
    </form>
</div>