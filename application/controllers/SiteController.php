<?php

namespace App\controllers;

use Core\controller\Controller;
use Exception;

/**
 * Класс SiteController реализует методы стартового контроллера.
 */
class SiteController extends Controller
{
    /**
     * Метод выполняет действие по-умолчанию.
     *
     * @return void
     *
     * @throws Exception Если компонент не зарегистрирован.
     */
    public function actionIndex(): void
    {
        $this->render('index');
    }
}
