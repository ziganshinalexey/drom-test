<?php

namespace App\controllers;

use Core\controller\Controller;
use Exception;

/**
 * Класс UserController реализует методы стартового контроллера.
 */
class UserController extends Controller
{
    /**
     * ### Тут необходимо описать делает данная функция. ###
     *
     * @throws Exception
     */
    public function actionLogin(): void
    {
        $this->render('login');
    }

    /**
     * ### Тут необходимо описать делает данная функция. ###
     *
     * @throws Exception
     */
    public function actionRegister(): void
    {
        $this->render('register');
    }
}
