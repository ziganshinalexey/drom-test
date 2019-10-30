<?php

declare(strict_types = 1);

namespace App\interfaces\user;

use Core\application\interfaces\IComponent as IBaseComponent;
use Core\form\interfaces\IForm;
use Core\IBaseObject;

/**
 * Интерфейс IComponent объявляет методы работы с пользователями.
 */
interface IComponent extends IBaseObject, IBaseComponent
{
    public const COMPONENT_NAME = 'user';

    /**
     * Метод возвращает форму поиска.
     *
     * @return IForm
     */
    public function login(): IForm;

    /**
     * Метод возвращает форму создания.
     *
     * @return IForm
     */
    public function createOne(): IForm;
}
