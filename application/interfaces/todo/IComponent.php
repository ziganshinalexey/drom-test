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
    public function find(): IForm;

    /**
     * Метод возвращает форму создания.
     *
     * @return IForm
     */
    public function create(): IForm;

    /**
     * Метод возвращает форму редактирования.
     *
     * @return IForm
     */
    public function update(): IForm;

    /**
     * Метод возвращает форму удаления.
     *
     * @return IForm
     */
    public function remove(): IForm;
}
