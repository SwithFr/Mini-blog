<form action="<?= $_SERVER['PHP_SELF']; ?>?a=admin_create&e=post" method="POST">
    <div class="<?= isset($errors['title'])?'has-error':''; ?>">
        <label for="title">Titre de l'article</label>
        <input type="text" name="title" id="title" value="<?= isset($title)?$title:''; ?>"/>
    </div>

    <div class="<?= isset($errors['author'])?'has-error':''; ?>">
        <label for="author">Auteur</label>
        <input type="text" name="author" id="author" value="<?= isset($author)?$author:''; ?>"/>
    </div>

    <div class="<?= isset($errors['cat_id'])?'has-error':''; ?>">
        <label for="category">Selectionnez la catégorie</label>
        <select name="cat_id" id="category">
            <?php foreach($categories as $cat): ?>
                <option <?= isset($cat_id) && $cat->id == $cat_id?"selected='selected'":"" ?>" value="<?= $cat->id; ?>"><?= $cat->name; ?></option>
            <?php endforeach; ?>
        </select>
    </div>

    <div class="<?= isset($errors['content'])?'has-error':''; ?>">
        <label for="content">Contenu</label>
        <textarea name="content" id="content" cols="30" rows="10"><?= isset($content)?$content:''; ?></textarea>
    </div>

    <input class="btn-add" type="submit" value="Ajouter un article"/>
</form>
