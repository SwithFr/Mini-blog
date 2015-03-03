<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="./assets/css/admin.css"/>
    <title>Le blog des patates fraîches</title>
</head>
<body>
<div class="sidebare">
    <nav class="sidebare__nav">
        <h1 class="nav__title">Administration</h1>
        <a class="nav__item" href="<?= $_SERVER['PHP_SELF']; ?>?a=admin_index&e=post" title="Gérer les articles">Articles</a>
        <a class="nav__item" href="<?= $_SERVER['PHP_SELF']; ?>?a=admin_index&e=category" title="Gérer les catégories">Catégories</a>
        <a class="nav__item" style="text-decoration: line-through;"
           href="<?= $_SERVER['PHP_SELF']; ?>?a=admin_index&e=post" title="Gérer les utilisateurs">Utilisateurs</a>
        <a class="nav__item" href="<?= $_SERVER['PHP_SELF']; ?>?a=admin_index&e=comment" title="Gérer les commentaires">Commentaires</a>
        <a class="nav__item" href="<?= $_SERVER['PHP_SELF']; ?>?a=index&e=post" title="Voir le blog">Voir le blog</a>
    </nav>
</div>

<div class="container">
    <?php if (isset($message) && !empty($message)): ?>
        <div class="alert alert-<?= $type; ?>" role="alert">
            <?= $message; ?>
        </div>
    <?php endif; ?>
    <?php include('./views/' . $controller->view); ?>
</div>

</body>
</html>