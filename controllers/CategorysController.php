<?php

class CategorysController extends AppController
{
    public function admin_index()
    {
        if (isset($_GET['type']) && !empty($_GET['type']))
            $type = $_GET['type'];
        else
            $type = "success";

        if (isset($_GET['message']) && !empty($_GET['message']))
            $message = $_GET['message'];
        else
            $message = "";

        $categories = $this->Category->getAll();

        return compact('posts', 'categories', 'message', 'type');
    }

    public function admin_create()
    {
        $errors = [];
        $name = "";

        if (isset($_GET['type']) && !empty($_GET['type']))
            $type = $_GET['type'];
        else
            $type = "success";

        if (isset($_GET['message']) && !empty($_GET['message']))
            $message = $_GET['message'];
        else
            $message = "";

        if ($this->request->method === "POST") {
            $validate = $this->Category->validate();
            $errors = $validate[1];
            extract($validate[0]); # output $name

            if (!$errors) {
                $this->Category->create($name);
                header('Location: ' . $_SERVER['PHP_SELF'] . '?a=admin_index&e=category&message=' . urlencode("Catégorie ajoutée !"));
            } else {
                $message = "Veuillez corriger vos erreurs !";
                $type = "error";
            }
        }

        return compact('errors', 'name', 'type', 'message');
    }

    public function admin_delete()
    {
        if (!$this->request->id)
            die('Catégorie introuvable');

        if (isset($_GET['goDelete'])) {
            $this->Category->delete($this->request->id);
            header('Location: ' . $_SERVER['PHP_SELFT'] . '?a=admin_index&e=category&message=' . urlencode("Catégorie supprimée"));
        }

        $cat = $this->Category->getFirst(['fields'=>'name,id'],$this->request->id);

        return compact('cat');
    }

} 