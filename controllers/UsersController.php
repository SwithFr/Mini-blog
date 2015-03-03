<?php

class UsersController extends AppController
{
    public function login()
    {
        if (empty($_REQUEST['email']) || empty($_REQUEST['password']))
        {
            die('Pas bon :p');
        }

        $user = $this->User->get($_REQUEST['email'],sha1($_REQUEST['password']));

        if ($user) {
            $this->connect($user);
        } else {
            $this->create($_REQUEST['email'],sha1($_REQUEST['password']));
        }
    }

    public function connect($user)
    {
        $_SESSION['user'] = $user->email;
        $_SESSION['connected'] = 1;
        header("Location: " . $_SERVER['PHP_SELF']);
    }
} 