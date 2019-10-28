<?php

declare(strict_types = 1);

namespace App\interfaces\todo;

use Core\application\interfaces\IComponent as IBaseComponent;
use Core\form\interfaces\IForm;
use Core\IBaseObject;

/**
 * Интерфейс IComponent объявляет методы работы с действиями.
 */
interface IComponent extends IBaseObject, IBaseComponent
{
    public const COMPONENT_NAME = 'todo';

    /**
     * Метод возвращает форму поиска.
     *
     * @return IForm
     */
    public function findMany(): IForm;

    /**
     * Метод возвращает форму создания.
     *
     * @return IForm
     */
    public function createOne(): IForm;

    /**
     * Метод возвращает форму редактирования.
     *
     * @return IForm
     */
    public function updateOne(): IForm;

    /**
     * Метод возвращает форму удаления.
     *
     * @return IForm
     */
    public function removeOne(): IForm;

    /**
     * Метод возвращает форму редактирования.
     *
     * @return IForm
     */
    public function updateMany(): IForm;

    /**
     * Метод возвращает форму удаления.
     *
     * @return IForm
     */
    public function removeMany(): IForm;
}
