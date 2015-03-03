<main class="blog__main">
    <div class="blog__ariane">
        <a class="blog__ariane__item" href="<?= $_SERVER['PHP_SELF']; ?>">Accueil</a> >
        <a class="blog__ariane__item" href="<?= $_SERVER['PHP_SELF']; ?>?a=category&e=post&id=<?= $post->category_id; ?>"><?= $post->categoryName; ?></a> >
        <?= $post->title; ?>
    </div>
    <div class="post">
        <div class="post__header">
            <h2 class="post__title"><?= $post->title; ?></h2>
        </div>
        <h2 class="post__author">
            Rédigé par : <span class="author--name"><?= $post->author; ?></span>
        </h2>
        <div class="post__content content--justify">
            <p><?= $post->content; ?></p>
        </div>
        <footer class="post__footer">
            <p class="post__category"> <?= $post->categoryName; ?></p>
            <p class="post__created"> <?= dateToFr($post->date); ?></p>
        </footer>
    </div>
    <a class="btn btn-delete" href="<?= $_SERVER['PHP_SELF']; ?>?a=admin_delete&e=post&id=<?= $post->post_id; ?>&goDelete=true">Supprimer</a>
    <a class="btn btn-back" href="<?= $_SERVER['PHP_SELF']; ?>?a=admin_index&e=post">Retour</a>
</main>