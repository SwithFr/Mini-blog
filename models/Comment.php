<?php

class Comment extends AppModel{

    /**
     * Permet de récupérer tous les commentaires d'un article
     * @param $article_id
     * @return array
     */
    public function getAllFor($article_id)
    {
        $sql = "SELECT * FROM comments WHERE post_id = $article_id";
        $pdost = $this->db->query($sql);
        return $pdost->fetchAll();
    }

    /**
     * Permet de récupérer tous les commentaires d'un article
     * @return array
     */
    public function getAll()
    {
        $sql = "SELECT * FROM comments ORDER BY id DESC";
        $pdost = $this->db->query($sql);
        return $pdost->fetchAll();
    }

    /**
     * Permet de créer un article
     * @param $author
     * @param $content
     * @param $post_id
     */
    public function create($author, $content, $post_id)
    {
        $sql = 'INSERT INTO comments (author, content, post_id) VALUE (:author, :content, :post_id)';
        try {
            $pdost = $this->db->prepare($sql);
            $pdost->execute([':author' => $author, ':content' => $content, ':post_id' => $post_id]);
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }

    /**
     * Permet de supprimer un commentaire
     * @param $id
     */
    public function delete($id)
    {
        $sql = 'DELETE FROM comments WHERE id = ' . $id;
        $this->db->query($sql);
    }

    /**
     * Permet de valider l'envoi d'un formulaire
     * @return array
     */
    public function validate()
    {
        $errors = [];
        if (!empty($_POST['post_id'])) {
            $d['post_id'] = $_POST['post_id'];
        } else {
            die("Attention post_id invalide");
        }

        if (!empty($_POST['author'])) {
            $d['author'] = $_POST['author'];
        } else {
            $errors['author'] = true;
        }

        if (!empty($_POST['comment'])) {
            $d['comment'] = $_POST['comment'];
        } else {
            $errors['comment'] = true;
        }

        return [$d,$errors];
    }

} 