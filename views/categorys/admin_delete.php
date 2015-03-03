<h2 class="title">Supprimer une catégorie</h2>

<p>Supprimer la catégorie <span class="catName"><?= $cat->name; ?></span></p>
<a class="btn btn-delete" href="<?= $_SERVER['PHP_SELF']; ?>?a=admin_delete&e=category&id=<?= $cat->id; ?>&goDelete=true">Supprimer</a>
<a class="btn btn-back" href="<?= $_SERVER['PHP_SELF']; ?>?a=admin_index&e=category">Retour</a>