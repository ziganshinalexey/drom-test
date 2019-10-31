<?php

declare(strict_types = 1);

namespace Core\user\controllers;

use Core\controller\Controller;
use Core\request\traits\web\WithRequestComponent;
use Exception;

/**
 * Класс UserController реализует методы стартового контроллера.
 */
class UserController extends Controller
{
    use WithRequestComponent;
    /**
     * Переопределенное свойство хранит карту Идентификатор действия => Право.
     *
     * @var array
     */
    protected $permissionMap = [
        'login'    => self::LOGOUT_PERMISSION,
        'register' => self::LOGOUT_PERMISSION,
        'save'     => self::LOGOUT_PERMISSION,
        'auth'     => self::LOGOUT_PERMISSION,
    ];

    /**
     * Метод реализует действие логина.
     *
     * @throws Exception
     *
     * @return void
     */
    public function actionLogin(): void
    {
        $this->render('login');
    }

    /**
     * Метод реализует действие регистрации.
     *
     * @throws Exception
     *
     * @return void
     */
    public function actionRegister(): void
    {
        $this->render('register');
    }

    /**
     * Метод сохраняет данные пользователя.
     *
     * @throws Exception
     *
     * @return void
     */
    public function actionCreate(): void
    {
        $form = $this->getUserComponent()->createOne();

        $form->load($this->getRequestComponent()->post());
        $result = $form->run();

        if ($result->isSuccess()) {
            $this->renderJson([
                'data'   => ['success' => true],
                'errors' => [],
            ]);

            return;
        }

        $this->renderJson([
            'data'   => [],
            'errors' => $result->getErrorList(),
        ]);
    }

    /**
     * Метод возвращает ключ доступа.
     *
     * @throws Exception
     *
     * @return void
     */
    public function actionAuth(): void
    {
        $form = $this->getUserComponent()->login();

        $form->load($this->getRequestComponent()->post());
        $result = $form->run();

        if ($result->isSuccess()) {
            $this->renderJson([
                'data'   => ['accessToken' => $result->getData()['accessToken'] ?? null],
                'errors' => [],
            ]);

            return;
        }

        $this->renderJson([
            'data'   => [],
            'errors' => $result->getErrorList(),
        ]);
    }
}
