<?php

declare(strict_types = 1);

namespace App\components;

use App\interfaces\user\IComponent;
use App\interfaces\user\IFactory;
use Core\BaseObject;
use Core\factory\traits\WithFactoryTrait;
use Core\form\interfaces\IForm;
use Exception;

/**
 * Класс UserComponent реализует методы работы с пользователями.
 */
class UserComponent extends BaseObject implements IComponent
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
    public function login(): IForm
    {
        return $this->getFactory()->getLoginForm();
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
        return $this->getFactory()->getCreateOneForm();
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
