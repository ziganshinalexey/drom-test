<?php

declare(strict_types = 1);

namespace App\components;

use App\interfaces\todo\IComponent;
use App\interfaces\todo\IFactory;
use Core\BaseObject;
use Core\factory\traits\WithFactoryTrait;
use Core\form\interfaces\IForm;
use Exception;

/**
 * Класс TodoComponent реализует методы работы с действиями.
 */
class TodoComponent extends BaseObject implements IComponent
{
    use WithFactoryTrait {
        WithFactoryTrait::getFactory as getFactoryFromTrait;
    }

    /**
     * Метод возвращает форму поиска.
     *
     * @return IForm
     *
     * @throws Exception
     */
    public function findMany(): IForm
    {
        return $this->getFactory()->getFindForm();
    }

    /**
     * Метод возвращает форму создания.
     *
     * @return IForm
     *
     * @throws Exception
     */
    public function createOne(): IForm
    {
        return $this->getFactory()->getCreateForm();
    }

    /**
     * Метод возвращает форму редактирования.
     *
     * @return IForm
     *
     * @throws Exception
     */
    public function updateOne(): IForm
    {
        return $this->getFactory()->getUpdateForm();
    }

    /**
     * Метод возвращает форму удаления.
     *
     * @return IForm
     *
     * @throws Exception
     */
    public function removeOne(): IForm
    {
        return $this->getFactory()->getRemoveForm();
    }

    /**
     * Метод переопределяет метод трейта для автокомплита.
     *
     * @return IFactory
     *
     * @throws Exception
     */
    protected function getFactory(): IFactory
    {
        /* @noinspection PhpIncompatibleReturnTypeInspection */
        return $this->getFactoryFromTrait();
    }
}
