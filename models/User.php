<?php

class User
{
    public function get($email,$password)
    {
        $sql = "SELECT * FROM users WHERE email=:email AND password=:password";
        $pdost = $this->db->prepare($sql);
        $pdost->execute([':email'=>$email,':password'=>$password]);
        return $pdost->fetch();
    }

    public function create($email, $password)
    {
        $sql = "INSERT INTO users(email,password) VALUES(:email,:password)";
        $pdost = $this->db->prepare($sql);
        $pdost->execute([':email'=>$email,':password'=>$password]);
    }

}