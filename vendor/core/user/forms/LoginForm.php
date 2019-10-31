<?php

declare(strict_types = 1);

namespace Core\user\forms;

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
        if (! $this->validate()) {
            return $this->getResult();
        }

        $data = $this->getQuery()->all(['login' => $this->getLogin()])->getData();
        $user = array_shift($data);

        return $this->getResult()->setData($user);
    }

    /**
     * Метод валидации формы.
     *
     * @return bool
     *
     * @throws Exception
     */
    protected function validate(): bool
    {
        if (empty($this->getLogin())) {
            $this->getResult()->addError('Логин не может быть пустым.');
        }

        if (empty($this->getPassword())) {
            $this->getResult()->addError('Пароль не может быть пустым.');
        }

        $loginLength = mb_strlen($this->getLogin(), 'utf-8');
        if (6 > $loginLength || 255 < $loginLength) {
            $this->getResult()->addError('Логин должен быть более 6 и менее 255 символов.');
        }

        $passwordLength = mb_strlen($this->getPassword(), 'utf-8');
        if (6 > $passwordLength || 255 < $passwordLength) {
            $this->getResult()->addError('Пароль должен быть более 6 и менее 255 символов.');
        }

        if (! $this->getResult()->isSuccess()) {
            return false;
        }

        $data     = $this->getQuery()->all(['login' => $this->getLogin()])->getData();
        $user     = array_shift($data);
        $password = $user['password'] ?? null;

        if (null === $user || null === $password || $password !== $this->getPassword()) {
            $this->getResult()->addError('Неверный логин или пароль.');
        }

        return $this->getResult()->isSuccess();
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
