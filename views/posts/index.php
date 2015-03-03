<div class="sidebare">
    <h4 class="sidebare__title">Catégories :</h4>
    <ul class="sidebare__list">
        <?php foreach($categories as $category): ?>
            <li class="sidebare__list__item">
                <a href="<?= $_SERVER['PHP_SELF']; ?>?a=category&e=post&id=<?= $category->id; ?>"><?= $category->name; ?></a>
            </li>
        <?php endforeach; ?>
    </ul>
</div>
<main class="blog__main">
    <div class="posts">
        <?php foreach($posts as $post): ?>
            <div class="post">
                <div class="post__header">
                    <h3 class="post__title">
                        <a href="<?= $_SERVER['PHP_SELF']; ?>?a=view&e=post&id=<?= $post->post_id; ?>"><?= $post->title; ?></a>
                    </h3>
                </div>
                <h2 class="post__author">
                    Rédigé par : <span class="author--name"><?= $post->author; ?></span>
                </h2>
                <div class="post__content">
                    <p><?= cut($post->content,300); ?></p>
                    <a class="post__readMore" href="?page=single&id=<?= $post->post_id; ?>">Lire la suite</a>
                </div>
                <footer class="post__footer">
                    <p class="post__category"> <?= $post->categoryName; ?></p>
                    <p class="post__created"> <?= dateToFr($post->date); ?></p>
                </footer>
            </div>
        <?php endforeach; ?>
    </div>
</main>