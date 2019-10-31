<?php

declare(strict_types = 1);

namespace Core\user\interfaces;

use Core\user\interfaces\forms\IFindOneForm;
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

    /**
     * Метод возвращает форму поиска одной сущности.
     *
     * @return IFindOneForm
     */
    public function findOne(): IFindOneForm;

    /**
     * Метод возвращает текущего пользователя.
     *
     * @return array|null
     */
    public function getCurrentUser(): ?array;
}
