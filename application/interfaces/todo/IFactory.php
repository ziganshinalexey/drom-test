<?php

declare(strict_types = 1);

namespace App\interfaces\todo;

use Core\form\interfaces\IForm;

/**
 * Интерфейс IFactory объявляет методы фабрики действий.
 */
interface IFactory
{
    /**
     * Метод создает форму поиска сущности.
     *
     * @return IForm
     */
    public function getFindForm(): IForm;

    /**
     * Метод создает форму создания сущности.
     *
     * @return IForm
     */
    public function getCreateForm(): IForm;

    /**
     * Метод создает форму обновления сущности.
     *
     * @return IForm
     */
    public function getUpdateForm(): IForm;

    /**
     * Метод создает форму удаления сущности.
     *
     * @return IForm
     */
    public function getRemoveForm(): IForm;
}
