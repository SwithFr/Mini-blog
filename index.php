<?php

# On inclue le fichier de librairie (petites fonctions utiles)
include('./libs/lib.php');

# Ajout des dossier (controller,models) aux chemins d'inclusion
set_include_path('controllers:models:' . get_include_path());

# Chargement automatique des classes
spl_autoload_register(
    function ($className) {
        include($className . '.php');
    }
);

# Initialisation de la requête
$request = new Request();

# Génération du nom du controller
$controllerName = ucfirst($request->controller) . 's' . 'Controller';

# Initialisation du controller
$controller = new $controllerName($request);

# Récupération des données
extract(call_user_func([$controller, $request->action]));

# On inclue le layout
include('./views/layouts/'. $controller->layout .'.php');