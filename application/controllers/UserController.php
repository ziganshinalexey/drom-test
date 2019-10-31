<?php

declare(strict_types = 1);

namespace App\controllers;

use App\traits\WithUserComponent;
use Core\controller\Controller;
use Core\request\traits\web\WithRequestComponent;
use Exception;

/**
 * Класс UserController реализует методы стартового контроллера.
 */
class UserController extends Controller
{
    use WithRequestComponent;
    use WithUserComponent;

    /**
     * Метод реализует действие логина.
     *
     * @throws Exception
     */
    public function actionLogin(): void
    {
        $post = $this->getRequestComponent()->post();
        if (! empty($post)) {
            $form = $this->getUserComponent()->login();

            $form->load($post);
            $form->run();

            $this->redirect('/user/login');

            return;
        }

        $this->render('login');
    }

    /**
     * Метод реализует действие регистрации.
     *
     * @throws Exception
     */
    public function actionRegister(): void
    {
        $post = $this->getRequestComponent()->post();
        if (! empty($post)) {
            $form = $this->getUserComponent()->createOne();

            $form->load($post);
            $form->run();

            $this->redirect('/user/login');

            return;
        }

        $this->render('register');
    }
}
