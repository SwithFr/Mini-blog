<?php

class Category extends AppModel
{
    /**
     * Permet de récupérer des catégories
     * @param null $options
     * @return mixed
     */
    public function getAll($options = null)
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

        $sql = 'SELECT ' . $fields . ' FROM categories' . $where;
        $pdost = $this->db->query($sql);
        return $pdost->fetchAll();
    }

    /**
     * Permet de récupérer une catégorie en particulier
     * @param null $options
     * @param $id
     * @return mixed
     */
    public function getFirst($options = null, $id)
    {
        if (!isset($options['fields'])) {
            $fields = '*';
        } else {
            $fields = $options['fields'];
        }

        $where = " WHERE id = " . $id;

        $sql = 'SELECT ' . $fields . ' FROM categories' . $where . ' LIMIT 1';
        $pdost = $this->db->query($sql);
        return $pdost->fetch();
    }

    /**
     * Permet de créer une catégorie
     * @param $name
     * @return bool
     */
    public function create($name)
    {
        $sql = 'INSERT INTO categories (name) VALUE (:name)';
        try {
            $pdost = $this->db->prepare($sql);
            $pdost->execute([':name' => $name]);
            return true;
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }

    /**
     * Permet de mettre à jour une catégorie
     * @param $name
     * @param $id
     */
    public function update($name, $id)
    {
        $sql = 'UPDATE categories SET name = :name WHERE id = ' . $id;
        try {
            $pdost = $this->db->prepare($sql);
            $pdost->execute([':name' => $name]);
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }

    /**
     * Permet de supprimer une catégorie
     * @param $id
     * @return bool
     */
    public function delete($id)
    {
        $sql = 'DELETE FROM categories WHERE id = ' . $id;
        $this->db->query($sql);
        return true;
    }

    /**
     * Permet de valider l'envoi d'un formulaire
     * @return array
     */
    public function validate()
    {
        $errors = $d = [];
        if (isset($_POST['name']) && !empty($_POST['name']))
            $d['name'] = $_POST['name'];
        else
            $errors['name'] = true;

        return [$d, $errors];
    }
}