<?php

class Post extends AppModel
{

    /**
     * Permet de récupérer tous les articles
     * @param array $options
     * @return array
     */
    public function getAll($options = [])
    {
        if (!isset($options['fields'])) {
            $fields = '*';
        } else {
            $fields = $options['fields'];
        }

        if (isset($options['where'])) {
            $where = " WHERE " . $options['where'];
        } else {
            $where = '';
        }

        if (isset($options['order'])) {
            $order = " ORDER BY " . $options['order'];
        } else {
            $order = '';
        }

        if (isset($options['join'])) {
            $join = ' LEFT JOIN ' . $options['join'] . ' ON category_id = ' . $options['join'] . '.id';
        } else {
            $join = '';
        }

        $sql = 'SELECT ' . $fields . ' FROM posts' . $join . $where . $order;
        $pdost = $this->db->query($sql);
        return $pdost->fetchAll();
    }

    /**
     * Permet de récupérer
     * @param $id
     * @return mixed
     */
    public function getFirst($id)
    {
        $sql = 'SELECT posts.id as post_id, categories.id as categories_id, title, name as categoryName, date, content, category_id, author
                FROM posts
                LEFT JOIN categories ON category_id = categories.id
                WHERE posts.id = ' . $id;
        $pdost = $this->db->query($sql);
        return $pdost->fetch();
    }

    /**
     * Permet d'ajouter un article dans la base de données
     * @param $title
     * @param $content
     * @param $category
     * @param $author
     * @param $date
     */
    public function create($title, $content, $category, $author, $date)
    {
        $sql = 'INSERT INTO posts (title, content, category_id, author, date) VALUE (:title, :content, :cat_id, :author, :date)';
        try {
            $pdost = $this->db->prepare($sql);
            $pdost->execute([':title' => $title, ':content' => $content, ':cat_id' => $category, ':author' => $author, ':date' => $date]);
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }

    /**
     * Permet de mettre à jour un article
     * @param $title
     * @param $content
     * @param $cat_id
     * @param $id
     */
    public function update($title, $author, $content, $cat_id, $id)
    {
        $sql = 'UPDATE posts SET title = :title, author = :author, content = :content, category_id = :cat_id WHERE id = ' . $id;
        try {
            $pdost = $this->db->prepare($sql);
            $pdost->execute([':title' => $title, 'author' => $author, ':content' => $content, ':cat_id' => $cat_id]);
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }

    /**
     * Permet de supprimer un article
     * @param $id
     */
    public function delete($id)
    {
        $sql = 'DELETE FROM posts WHERE id = ' . $id;
        $this->db->query($sql);
        $sql = 'DELETE FROM comments WHERE post_id = ' . $id;
        $this->db->query($sql);
    }

    public function validate()
    {
        $errors = $d = [];
        if (isset($_POST['title']) && !empty($_POST['title'])) {
            $d['title'] = $_POST['title'];
        } else {
            $errors['title'] = true;
        }
        if (isset($_POST['author']) && !empty($_POST['author'])) {
            $d['author'] = $_POST['author'];
        } else {
            $errors['author'] = true;
        }
        if (isset($_POST['content']) && !empty($_POST['content'])) {
            $d['content'] = $_POST['content'];
        } else {
            $errors['content'] = true;
        }
        if (isset($_POST['cat_id']) && !empty($_POST['cat_id'])) {
            $d['cat_id'] = $_POST['cat_id'];
        } else {
            $errors['cat_id'] = true;
        }

        return [$d, $errors];
    }
}