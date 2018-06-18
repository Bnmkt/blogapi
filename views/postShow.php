<div>
    <h2>
        <?= $data["data"]["post"] -> title; ?>
    </h2>
    <p class="blog-post-meta">Fait le <?= $data["data"]["post"]->date ?> par
        <b><?= $data["data"]["post"]->username ?></b></p>
    <div class="border-bottom">
        <div>
            <?= preg_replace('/\n/', "<p>$0</p>", $data["data"]["post"]->body) ?>
        </div>
        <p>
            <?php if (isset($_SESSION["user"]) && $data["data"]["post"]->id == $_SESSION["user"]->id): ?>
                <a href="index.php?a=edit&r=post&id=<?= $data["data"]["post"]->id ?>">Modifier le post</a> -
                <a href="index.php?a=destroy&r=post&id=<?= $data["data"]["post"]->id ?>">Supprimer le post</a>
            <?php endif; ?>
        </p>
    </div>
    <div>
        <h2>Commentaires :</h2>
        <?php if(isset($_SESSION["user"])): ?>
            <form action="index.php" method="post">
            <p>Créer un commentaire&nbsp;:</p>
            <label for="content"></label><textarea name="content" id="content" cols="30" rows="10"></textarea>
            <input type="hidden" name="a" value="create">
            <input type="hidden" name="r" value="comment">
            <input type="hidden" name="userid" value="<?= $_SESSION["user"]->id ?>">
            <input type="hidden" name="postid" value="<?= $_GET["id"] ?>">
            <input type="submit" name="submit" value="envoyer">
        </form>
        <?php endif; ?>
        <?php if (!empty($data['data']['comments'])) : ?>
            <?php foreach ($data['data']['comments'] as $comment): ; ?>
                <div>
                    <p>
                        Par <?= $comment->username ?> le <?= $comment->date ?>
                    </p>
                        <?php if(isset($_SESSION["user"]) && $_SESSION["user"]->id===$comment->userId): ?>
                        - <a href="index.php?a=edit&r=comment&id=<?= $comment->id ?>">Modifier</a>
                        - <a href="index.php?a=destroy&r=comment&id=<?= $comment->id ?>">Supprimer</a>
                        <?php endif; ?>
                    <p><?= $comment->content ?></p>
                </div>
            <?php endforeach;
        endif; ?>
    </div>
</div>