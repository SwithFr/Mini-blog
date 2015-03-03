<?php

class PostsController extends AppController
{

    /**
     * Page d'accueil
     * @return array
     */
    public function index()
    {
        $posts = $this->Post->getAll(
            [
                'fields' => 'posts.id as post_id, categories.id as categories_id, title, name as categoryName, date, content, author',
                'join' => 'categories',
                'order' => 'posts.id DESC'
            ]
        );
        $this->loadModel('Category');
        $categories = $this->Category->getAll(['fields' => 'id,name']);

        return compact("posts", "categories");
    }

    /**
     * Page de vue d'un article
     * @return array
     */
    public function view()
    {
        if (!$this->request->id)
            die('Article introuvable');

        if (isset($_GET['message']) && !empty($_GET['message']))
            $message = $_GET['message'];
        else
            $message = "";

        if (isset($_GET['type']) && !empty($_GET['type']))
            $type = $_GET['type'];
        else
            $type = "success";

        $this->loadModel('Category');
        $this->loadModel('Comment');
        $post = $this->Post->getFirst($_GET['id']);
        $comments = $this->Comment->getAllFor($_GET['id']);
        $categories = $this->Category->getAll(['fields' => 'id,name']);
        $others = $this->Post->getAll(
            [
                'fields' => 'posts.id as post_id, title',
                'where' => 'category_id = ' . $post->categories_id . ' AND posts.id != ' . $post->post_id
            ]
        );

        return compact("post", "comments", "others", "categories", "message", 'type');
    }

    /**
     * Page de liste des article appartenant à une catégorie
     * @return array
     */
    public function category()
    {
        if (!$this->request->id)
            die('Catégorie introuvable');
        else
            $id = $this->request->id;

        $posts = $this->Post->getAll(
            [
                'fields' => 'posts.id as post_id, categories.id as categories_id, title, name as categoryName, date, content',
                'join' => 'categories',
                'where' => 'category_id = ' . $id
            ]
        );
        $this->loadModel('Category');
        $categories = $this->Category->getAll(['fields' => 'id,name']);
        $currentCat = $this->Category->getFirst(['fields' => 'name'], $id);

        return compact("posts", "categories", "currentCat");
    }

    /**
     * Page d'accueil de l'administration
     * @return array
     */
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

        $posts = $this->Post->getAll(
            [
                'fields' => 'posts.id as post_id, categories.id as categories_id, title, name as categoryName, date, content, author',
                'join' => 'categories',
                'order' => 'posts.id DESC'
            ]
        );

        return compact('posts', 'message', 'type');
    }

    /**
     * Page d'ajout d'un article
     * @return array
     */
    public function admin_create()
    {
        $this->loadModel('Category');
        $categories = $this->Category->getAll(['fields' => 'id,name']);
        $title = $author = $content = $cat_id = "";
        $errors = [];

        if (isset($_GET['type']) && !empty($_GET['type']))
            $type = $_GET['type'];
        else
            $type = "success";

        if (isset($_GET['message']) && !empty($_GET['message']))
            $message = $_GET['message'];
        else
            $message = "";

        if ($this->request->method === "POST") {
            $validate = $this->Post->validate();
            $errors = $validate[1];
            extract($validate[0]); # output $title, $author, $content, $cat_id

            if (!$errors) {
                $this->Post->create($title, $content, $cat_id, $author, date("Y-m-d H:i:s"));
                header('Location: ' . $_SERVER['PHP_SELFT'] . '?a=admin_index&e=post&message=' . urlencode("Article ajouté !"));
            } else {
                $message = "Veuillez corriger vos erreurs";
                $type = "error";
            }
        }

        return compact('categories', 'title', 'author', 'content', 'cat_id', 'errors', 'message', 'type');
    }

    /**
     * Page d'édition d'un article
     * @return array
     */
    public function admin_update()
    {
        if (!$this->request->id)
            die('Article introuvable');

        if (isset($_GET['message']) && !empty($_GET['message']))
            $message = $_GET['message'];
        else
            $message = "";

        if (isset($_GET['type']) && !empty($_GET['type']))
            $type = $_GET['type'];
        else
            $type = "success";

        $errors = [];
        $post = $this->Post->getFirst($_GET['id']);
        $content = $post->content;
        $title = $post->title;
        $author = $post->author;
        $id = $post->post_id;
        $cat_id = $post->category_id;
        $this->loadModel('Category');
        $categories = $this->Category->getAll(['fields' => 'id,name']);

        if ($this->request->method === "POST") {

            $validate = $this->Post->validate();
            $errors = $validate[1];
            extract($validate[0]); # output $title, $author, $content, $cat_id, $id

            if (!$errors) {
                $this->Post->update($title, $author, $content, $cat_id, $id);
                header('Location: ' . $_SERVER['PHP_SELFT'] . '?a=admin_update&e=post&id=' . $id . '&message=' . urlencode("Article modifié !"));
            } else {
                $message = "Veuillez corriger vos erreurs";
                $type = "error";
            }

        }

        return compact('categories', 'title', 'author', 'content', 'cat_id', 'errors', 'id', 'message', 'type');

    }

    /**
     * Suppression d'un article
     * @return array
     */
    public function admin_delete()
    {
        if (!$this->request->id)
            die('Article introuvable');

        if (isset($_GET['goDelete'])) {
            $this->Post->delete($this->request->id);
            header('Location: ' . $_SERVER['PHP_SELFT'] . '?a=admin_index&e=post&message=' . urlencode("Article supprimé"));
        }

        $this->layout = "default";
        $post = $this->Post->getFirst($this->request->id);

        return compact('post');
    }

}