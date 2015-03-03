<?php

class CommentsController extends AppController
{

    /**
     * Fonction d'ajout de commentaire
     * @return array
     */
    public function create()
    {
        $errors = [];
        $author = $comment = "";

        if ($this->request->method === "POST") {
            $validate = $this->Comment->validate();
            $errors = $validate[1];
            extract($validate[0]);

            if (!$errors) {
                $this->Comment->create($author, $comment, $post_id);
                header('Location: ' . $_SERVER['PHP_SELF'] . '?a=view&e=post&id=' . $post_id . '&message=' . urlencode("Commentaire ajouté !"));
            } else {
                $message = "Veuillez corriger vos erreurs !";
                $type = "error";
            }
        }

        $this->loadModel('Post');
        $post = $this->Post->getFirst($_POST['post_id']);
        $comments = $this->Comment->getAllFor($_POST['post_id']);
        $this->loadModel('Category');
        $categories = $this->Category->getAll(['fields' => 'id,name']);
        $others = $this->Post->getAll(
            [
                'fields' => 'posts.id as post_id, title',
                'where' => 'category_id = ' . $post->categories_id . ' AND posts.id != ' . $post->post_id
            ]
        );

        $this->view = 'posts/view.php';
        return compact('post', 'comments', 'others', 'categories', 'message', 'type', 'errors', 'author', 'comment');
    }

    /**
     * Liste les commentaires pour l'administration
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

        $comments = $this->Comment->getAll();

        return compact('comments', 'message', 'type');
    }

    /**
     * Fonction de suppression d'un commentaire
     */
    public function admin_delete()
    {
        if (!$this->request->id)
            die('Commentaire introuvable');

        $this->Comment->delete($this->request->id);
        header('Location: ' . $_SERVER['PHP_SELF'] . '?a=admin_index&e=comment&message=' . urlencode("Commentaire supprimé"));
    }
} 