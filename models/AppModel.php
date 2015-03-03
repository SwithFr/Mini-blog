<?php

class AppModel {

    protected  $db = null;
    const DSN = "mysql:dbname=blogWeb;host:localhost";
    const USERNAME = "root";
    const PASSWORD = "root";
    private $options = [
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    ];

    function __construct()
    {
        try {
            $this->db = new PDO(self::DSN, self::USERNAME, self::PASSWORD, $this->options);
            $this->db->query('SET CHARACTER SET UTF8');
            $this->db->query('SET NAMES UTF8');
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }

} 