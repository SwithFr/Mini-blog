<?php

class AppController
{

    protected $request = null; # Objet Request
    public $layout = "default"; # Le layout à utiliser
    public $view = null; # La vue à rendre

    function __construct(Request $request)
    {
        # On inject la requete
        if (!isset($this->request))
            $this->request = $request;

        # On charge le model par defaut
        $this->loadModel();

        # Si on a une fonctin d'administration on charge le layout admin
        if (preg_match("/admin_/",$this->request->action)) {
            $this->layout = "admin";
        }

        # Génération de la vue
        $this->view = $this->request->controller . 's/' . $this->request->action . '.php';
    }

    /**
     * Permet d'injecter le model $name dans le controller
     * @param null $name
     */
    protected function loadModel($name = null)
    {
        # On prévoit le cas où on veut charger un model manuellement
        if (is_null($name)) {
            $name = ucfirst($this->request->controller);
        }
        $this->$name = new $name();
    }

}