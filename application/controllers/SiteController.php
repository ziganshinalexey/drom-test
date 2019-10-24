<?php

namespace App\controllers;

use Core\controller\Controller;
use Core\Core;
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
        $id = Core::getApplication()->getRequest()->getByKey('id');
        var_dump($id);
        die;

        return;
    }
}
