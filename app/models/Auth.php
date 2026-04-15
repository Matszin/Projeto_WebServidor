<?php

class Auth {

    private static $users = [
        'user' => [
            'email' => 'user@test.com',
            'password' => '123'
        ],
        'admin' => [
            'email' => 'admin@test.com',
            'password' => '456'
        ]
    ];

    public static function login($type, $email, $password) {

        if (
            isset(self::$users[$type]) &&
            $email === self::$users[$type]['email'] &&
            $password === self::$users[$type]['password']
        ) {
            return true;
        }

        return false;
    }
}