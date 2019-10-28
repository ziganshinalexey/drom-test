<?php

declare(strict_types = 1);

namespace App\factories;

use App\interfaces\todo\IFactory;
use Core\factory\Factory;
use Core\form\interfaces\IForm;
use Exception;

/**
 * Класс TodoFactory реализует методы фабрики действий.
 */
class TodoFactory extends Factory implements IFactory
{
    public const FIND_MANY_FORM   = 'findManyForm';
    public const CREATE_ONE_FORM  = 'createOneForm';
    public const UPDATE_ONE_FORM  = 'updateOneForm';
    public const REMOVE_ONE_FORM  = 'removeOneForm';
    public const UPDATE_MANY_FORM = 'updateManyForm';
    public const REMOVE_MANY_FORM = 'removeManyForm';

    /**
     * Метод создает форму поиска сущности.
     *
     * @return IForm
     *
     * @throws Exception
     */
    public function getFindManyForm(): IForm
    {
        return $this->getInstance(static::FIND_MANY_FORM);
    }

    /**
     * Метод создает форму создания сущности.
     *
     * @return IForm
     *
     * @throws Exception
     */
    public function getCreateOneForm(): IForm
    {
        return $this->getInstance(static::CREATE_ONE_FORM);
    }

    /**
     * Метод создает форму обновления сущности.
     *
     * @return IForm
     *
     * @throws Exception
     */
    public function getUpdateOneForm(): IForm
    {
        return $this->getInstance(static::UPDATE_ONE_FORM);
    }

    /**
     * Метод создает форму удаления сущности.
     *
     * @return IForm
     *
     * @throws Exception
     */
    public function getRemoveOneForm(): IForm
    {
        return $this->getInstance(static::REMOVE_ONE_FORM);
    }

    /**
     * Метод создает форму обновления сущности.
     *
     * @return IForm
     *
     * @throws Exception
     */
    public function getUpdateManyForm(): IForm
    {
        return $this->getInstance(static::UPDATE_MANY_FORM);
    }

    /**
     * Метод создает форму удаления сущности.
     *
     * @return IForm
     *
     * @throws Exception
     */
    public function getRemoveManyForm(): IForm
    {
        return $this->getInstance(static::REMOVE_MANY_FORM);
    }
}
