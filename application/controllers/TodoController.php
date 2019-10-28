<?php

namespace App\controllers;

use App\traits\WithTodoComponent;
use Core\controller\Controller;
use Core\db\traits\WithDatabaseComponent;
use Core\request\traits\web\WithRequestComponent;
use Exception;

/**
 * Класс SiteController реализует методы стартового контроллера.
 */
class TodoController extends Controller
{
    use WithDatabaseComponent;
    use WithTodoComponent;
    use WithRequestComponent;

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
     * @throws Exception
     */
    public function actionList(): void
    {
        $form   = $this->getTodoComponent()->find();
        $result = $form->run();

        $this->renderJson(['data' => $result->getData()]);
    }

    /**
     * Метод возвращает список действия.
     *
     * @throws Exception
     */
    public function actionCreate(): void
    {
        $form = $this->getTodoComponent()->create();

        $form->load($this->getRequestComponent()->post());
        $result = $form->run();

        $this->renderJson([
            'data' => $result->getData(),
        ]);
    }

    /**
     * Метод возвращает список действия.
     *
     * @throws Exception
     */
    public function actionRemove(): void
    {
        $id = $this->getRequestComponent()->getByKey('id');
        if (null === $id) {
            throw new Exception('Сущность не найдена.');
        }

        $form = $this->getTodoComponent()->remove();
        $form->setId((int)$id);
        $result = $form->run();

        $this->renderJson([
            'data' => ['isSuccess' => $result->getData()['success'] ?? false],
        ]);
    }
}
