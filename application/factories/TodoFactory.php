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
    public const FIND_FORM   = 'findForm';
    public const CREATE_FORM = 'createForm';
    public const UPDATE_FORM = 'updateForm';
    public const REMOVE_FORM = 'removeForm';

    /**
     * Метод создает форму поиска сущности.
     *
     * @return IForm
     *
     * @throws Exception
     */
    public function getFindForm(): IForm
    {
        return $this->getInstance(static::FIND_FORM);
    }

    /**
     * Метод создает форму создания сущности.
     *
     * @return IForm
     *
     * @throws Exception
     */
    public function getCreateForm(): IForm
    {
        return $this->getInstance(static::CREATE_FORM);
    }

    /**
     * Метод создает форму обновления сущности.
     *
     * @return IForm
     *
     * @throws Exception
     */
    public function getUpdateForm(): IForm
    {
        return $this->getInstance(static::UPDATE_FORM);
    }

    /**
     * Метод создает форму удаления сущности.
     *
     * @return IForm
     *
     * @throws Exception
     */
    public function getRemoveForm(): IForm
    {
        return $this->getInstance(static::REMOVE_FORM);
    }
}
