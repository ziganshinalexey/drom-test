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
    public function getFindManyForm(): IForm;

    /**
     * Метод создает форму создания сущности.
     *
     * @return IForm
     */
    public function getCreateOneForm(): IForm;

    /**
     * Метод создает форму обновления сущности.
     *
     * @return IForm
     */
    public function getUpdateOneForm(): IForm;

    /**
     * Метод создает форму удаления сущности.
     *
     * @return IForm
     */
    public function getRemoveOneForm(): IForm;

    /**
     * Метод создает форму обновления сущности.
     *
     * @return IForm
     */
    public function getUpdateManyForm(): IForm;

    /**
     * Метод создает форму удаления сущности.
     *
     * @return IForm
     */
    public function getRemoveManyForm(): IForm;
}
