<?php

namespace iutnc\deefy\action;

use JetBrains\PhpStorm\NoReturn;

class LogoutAction extends Action
{
    #[NoReturn] public function execute(): string
    {
        $_SESSION = [];

        session_destroy();

        header('Location: ?action=default');
        exit;
    }
}