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
    <div class="comments">
        <?php if (isset($message) && !empty($message)): ?>
            <div class="alert alert-<?= $type; ?>" role="alert">
                <?= $message; ?>
            </div>
        <?php endif; ?>
        <h2 class="comments__title">Les commentaires :</h2>
        <form class="comments__form" action="<?= $_SERVER['PHP_SELF']; ?>?a=create&e=comment" method="post">
            <label class="comment__label" for="author">Votre pseudo :</label>
            <input class="comment__input" type="text" id="author" name="author" value="<?= isset($author)?$author:''; ?>"/>
            <input type="hidden" name="post_id" value="<?= $post->post_id; ?>"/>

            <label class="comment__label comment__label--textarea" for="comment">Votre commentaire :</label>
            <textarea class="comment__input comment__input--textarea" name="comment" id="comment" cols="30" rows="3"><?= isset($comment)?$comment:''; ?></textarea>

            <input class="comment__input comment--submit" type="submit" value="Commenter"/>
        </form>
        <div class="comments__list">
            <?php foreach($comments as $com): ?>
                <div class="comment">
                    Écrit par : <span class="comment__author"><?= $com->author; ?></span>
                    <p class="comment__content">
                        <?= $com->content; ?>
                    </p>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</main>
<?php if(!empty($others)): ?>
    <div class="sidebare sidebare--left">
        <h3 class="sidebare__title">Autres <?= $post->categoryName; ?></h3>
        <div class="categories">
            <?php foreach($others as $other): ?>
                <h4 class="sidebare__list__item"><a href="<?= $_SERVER['PHP_SELF']; ?>?a=view&e=post&id=<?= $other->post_id; ?>"><?= $other->title; ?></a></h4>
            <?php endforeach; ?>
        </div>
    </div>
<?php endif; ?>