<main>
    <form action="<?= $_SERVER['PHP_SELF']; ?>?a=admin_create&e=category" method="POST">
        <div class="<?= isset($errors['name'])?'has-error':''; ?>">
            <label name">Nom de la catégorie</label>
            <input type="text" name="name" id="name"/>
        </div>

        <input class="btn-add" type="submit" value="Ajouter une catégorie"/>
    </form>
</main>