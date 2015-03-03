<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="./assets/css/main.css"/>
    <title>Le blog des patates fraîches</title>
</head>
<body>
<header class="blog__header">
    <h1 class="blog__title">Le blog des patates frâiches !</h1>
</header>
    <?php if(!isset($_SESSION['connected']) && !isset($_COOKIE['email'])): ?>
        <a href="<?= $_SERVER['PHP_SELF']; ?>?a=check&e=user">S'identifier</a>
    <?php else: ?>
        <a href="<?= $_SERVER['PHP_SELF']; ?>?a=disconnect&e=user">Se deconnecter</a>
    <?php endif; ?>

    <?php include('./views/' . $controller->view); ?>
<footer class="blog__footer">
    <p class="blog__footer__content">Tous droits réservés aux kiwis rouge - 2015 | <a class="linkTo" href="<?= $_SERVER['PHP_SELF']; ?>?a=admin_index&e=post">Administration</a></p>
</footer>
</body>
</html>