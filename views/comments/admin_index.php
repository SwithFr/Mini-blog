<table>
    <caption>Les commentaires</caption>
    <thead>
    <tr>
        <th>ID</th>
        <th>AUTEUR</th>
        <th>CONTENU</th>
        <th>ACTION</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach($comments as $comment): ?>
        <tr>
            <td><?= $comment->id; ?></td>
            <td><?= $comment->author; ?></td>
            <td><?= cut($comment->content,100); ?></td>
            <td>
                <a class="delete" href="<?= $_SERVER['PHP_SELF']; ?>?a=admin_delete&e=comment&id=<?= $comment->id; ?>">Supprimer</a>
            </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>