<?php

class UsersController extends AppController
{
    public function check()
    {
        if ($this->request->method === "POST") {
            if (empty($_REQUEST['email']) || empty($_REQUEST['password']))
                die('Pas bon :p');
            $user = $this->User->get($_REQUEST['email'], sha1($_REQUEST['password']));
            if ($user) {
                $this->connect($user->email);
            } else {
                $this->create($_REQUEST['email'], sha1($_REQUEST['password']));
            }
        }

    }

    private function connect($email)
    {
        $_SESSION['user'] = $email;
        $_SESSION['connected'] = 1;
        setcookie("user", $email, time() + 15 * 24 * 3600);
        header("Location: " . $_SERVER['PHP_SELF']);
    }

    private function create($email, $password)
    {
        $this->User->create($email, $password);
        $this->connect($email);
    }

    public function disconnect()
    {
        session_destroy();
        unset($_SESSION['user']);
        unset($_SESSION['connected']);
        setcookie("user", "", time() - 15 * 24 * 3600);
        header('Location: ' . $_SERVER['PHP_SELF']);
    }

} 