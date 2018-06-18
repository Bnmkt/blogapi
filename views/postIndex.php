<div>
    <ol class="list-unstyled mb-0">
        <?php if (!empty($data['data']['posts'])):
            foreach ($data['data']['posts'] as $post): ; ?>
                <li class="blog-post">
                    <h2 class="blog-post-title">
                        <?= $post->title ?>
                    </h2>
                    <p class="blog-post-meta">Fait le <?= $post->date ?> par <b><?= $post->username ?></b></p>
                    <div>
                        <?= preg_replace('/\n/', "<p>$0</p>", $post->body) ?>
                        <p>
                            <a href="/api.php?a=show&r=post&id=<?= $post->id; ?>">lire la suite
                                de <?= $post->title ?></a>
                        </p>
                    </div>
                </li>
            <?php endforeach;
        endif; ?>
    </ol>
</div>
