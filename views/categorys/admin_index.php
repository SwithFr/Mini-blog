<table>
    <caption>Les catégories</caption>
    <thead>
    <tr>
        <th>ID</th>
        <th>NAME</th>
        <th>ACTIONS</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach($categories as $category): ?>
        <tr>
            <td><?= $category->id; ?></td>
            <td><?= $category->name; ?></td>
            <td>
                <a class="edit" href="<?= $_SERVER['PHP_SELF']; ?>?a=admin_edit&e=category&id=<?= $category->id; ?>">Editer</a> /
                <a class="delete" href="<?= $_SERVER['PHP_SELF']; ?>?a=admin_delete&e=category&id=<?= $category->id; ?>">Supprimer</a>
            </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>
<a class="btn btn-add" href="<?= $_SERVER['PHP_SELF']; ?>?a=admin_create&e=category">Ajouter une catégorie</a>