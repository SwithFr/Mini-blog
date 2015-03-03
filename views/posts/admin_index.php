<table>
    <caption>Les articles du blog</caption>
    <thead>
    <tr>
        <th>ID</th>
        <th>TITRE (cliquez pour voir l'article)</th>
        <th>CATÉGORIE</th>
        <th>ACTIONS</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach($posts as $post): ?>
        <tr>
            <td><?= $post->post_id; ?></td>
            <td>
                <a class="linkTo" href="<?= $_SERVER['PHP_SELF']; ?>?a=view&e=post&id=<?= $post->post_id; ?>"><?= $post->title; ?></a></td>
            <td><?= $post->categoryName; ?></td>
            <td>
                <a class="edit" href="<?= $_SERVER['PHP_SELF']; ?>?a=admin_update&e=post&id=<?= $post->post_id; ?>">Editer</a> /
                <a class="delete" href="<?= $_SERVER['PHP_SELF']; ?>?a=admin_delete&e=post&id=<?= $post->post_id; ?>">Supprimer</a>
            </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>
<a class="btn btn-add" href="<?= $_SERVER['PHP_SELF']; ?>?a=admin_create&e=post">Ajouter un article</a>
