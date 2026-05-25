<?php

require_once __DIR__ . '/UserModel.php';

class Auth {

    public static function login($email, $password) {

        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        $userModel = new UserModel();

        $user = $userModel->findByEmail($email);

        if ($user && password_verify($password, $user['senha'])) {

            session_regenerate_id(true);

            $_SESSION['user'] = $user['email'];
            $_SESSION['type'] = $user['role'];
            $_SESSION['login_time'] = time();

            return true;
        }

        return false;
    }

    
}