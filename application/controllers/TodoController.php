<?php

namespace App\controllers;

use Core\controller\Controller;
use Core\Core;
use Exception;

/**
 * Класс SiteController реализует методы стартового контроллера.
 */
class TodoController extends Controller
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

    /**
     * Метод возвращает список действия.
     *
     * @todo: является черновым.
     *
     * @throws Exception
     */
    public function actionList(): void
    {
        $sql = 'select * from `todo`';

        $result = Core::getApplication()->getDb()->getConnection()->execute($sql);

        $this->renderJson(['data' => $result->getData()]);
    }

    /**
     * Метод возвращает список действия.
     *
     * @todo: является черновым.
     *
     * @throws Exception
     */
    public function actionCreate(): void
    {
        $data       = Core::getApplication()->getRequest()->post();
        $data['id'] = random_int(1, 3254234);

        $this->renderJson([
            'data' => $data,
        ]);
    }
}
