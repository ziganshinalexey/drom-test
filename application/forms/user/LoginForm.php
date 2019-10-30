<?php

declare(strict_types = 1);

namespace App\forms\user;

use Core\form\BaseForm;
use Core\form\interfaces\IForm;
use Core\query\traits\WithQueryTrait;
use Core\result\interfaces\IDataResult;
use Exception;

/**
 * Класс LoginForm реализует методы формы.
 */
class LoginForm extends BaseForm implements IForm
{
    use WithQueryTrait;
    /**
     * Свойство содержит логин пользователя.
     *
     * @var null|string
     */
    protected $login;
    /**
     * Свойство содержит пароль пользователя.
     *
     * @var null|string
     */
    protected $password;

    /**
     * Метод реализует основное действие формы.
     *
     * @return IDataResult
     *
     * @throws Exception
     */
    public function run(): IDataResult
    {

    }

    /**
     * Метод задает логин пользователя.
     *
     * @param string $value Новое значение.
     *
     * @return void
     */
    public function setLogin(string $value): void
    {
        $this->login = $value;
    }

    /**
     * Метод возвращает логин пользователя.
     *
     * @return string|null
     */
    public function getLogin(): ?string
    {
        return null === $this->login ? null : (string)$this->login;
    }

    /**
     * Метод задает пароль пользователя.
     *
     * @param string $value Новое значение.
     *
     * @return void
     */
    public function setPassword(string $value): void
    {
        $this->password = $value;
    }

    /**
     * Метод возвращает пароль пользователя.
     *
     * @return string|null
     */
    public function getPassword(): ?string
    {
        return null === $this->password ? null : (string)$this->password;
    }
}
