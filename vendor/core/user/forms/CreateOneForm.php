<?php

declare(strict_types = 1);

namespace Core\user\forms;

use Core\form\BaseForm;
use Core\form\interfaces\IForm;
use Core\query\traits\WithQueryTrait;
use Core\result\interfaces\IDataResult;
use Exception;

/**
 * Класс CreateOneForm реализует методы формы.
 */
class CreateOneForm extends BaseForm implements IForm
{
    use WithQueryTrait;

    protected const ACCESS_KEY_LENGTH = 32;
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
     * Свойство содержит имя пользователя.
     *
     * @var null|string
     */
    protected $firstName;
    /**
     * Свойство содержит фамилию пользователя.
     *
     * @var null|string
     */
    protected $lastName;

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

        $data         = $this->getInsertData();
        $insertResult = $this->getQuery()->insert($data);

        $id         = (int)$insertResult->getData()['id'] ?? null;
        $data['id'] = $id;
        $this->getResult()->setData($data);

        return $this->getResult();
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

        $result = $this->getQuery()->all(['login' => $this->getLogin()]);
        if (! empty($result->getData())) {
            $this->getResult()->addError('Пользователь с таким логином уже существует.');
        }

        return empty($this->getResult()->getErrorList());
    }

    /**
     * Метод генерирует случайную строку в виде ключа доступа.
     *
     * @return string
     *
     * @throws Exception
     */
    protected function generateAccessToken(): string
    {
        return strtr(base64_encode(random_bytes(static::ACCESS_KEY_LENGTH)), '+/', '-_');
    }

    /**
     * Метод возвращает данные для добавления в БД.
     *
     * @return array
     *
     * @throws Exception
     */
    protected function getInsertData(): array
    {
        return [
            'login'       => $this->getLogin(),
            'password'    => $this->getPassword(),
            'lastName'    => $this->getLastName(),
            'firstName'   => $this->getFirstName(),
            'accessToken' => $this->generateAccessToken(),
        ];
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

    /**
     * Метод задает имя пользователя.
     *
     * @param string $value Новое значение.
     *
     * @return void
     */
    public function setFirstName(string $value): void
    {
        $this->firstName = $value;
    }

    /**
     * Метод возвращает имя пользователя.
     *
     * @return string|null
     */
    public function getFirstName(): ?string
    {
        return null === $this->firstName ? null : (string)$this->firstName;
    }

    /**
     * Метод задает фамилию пользователя.
     *
     * @param string $value Новое значение.
     *
     * @return void
     */
    public function setLastName(string $value): void
    {
        $this->lastName = $value;
    }

    /**
     * Метод возвращает фамилию пользователя.
     *
     * @return string|null
     */
    public function getLastName(): ?string
    {
        return null === $this->lastName ? null : (string)$this->lastName;
    }
}
