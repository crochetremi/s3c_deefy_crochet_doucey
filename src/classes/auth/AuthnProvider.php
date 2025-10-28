<?php

namespace iutnc\deefy\auth;

use iutnc\deefy\exception\AuthnException;
use iutnc\deefy\repository\DeefyRepository;

class AuthnProvider
{

    public static function signin($email, $password)
    {

        $user = DeefyRepository::getInstance()->getUserByEmail($email);

        if ($user && password_verify($password, $user['passwd'])) {
            return $user;
        } else {
            throw new AuthnException('Identifiants incorrects');
        }
    }
}