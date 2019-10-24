<?php

declare(strict_types = 1);

namespace Core\application\components;

use Core\BaseObject;
use Core\db\interfaces\IDatabase;
use Core\migration\interfaces\IMigration;
use Core\route\interfaces\IRoute;
use Exception;

/**
 * Класс приложения.
 */
abstract class BaseApplication extends BaseObject
{
    /**
     * Свойство хранит объект компонента БД.
     *
     * @var IDatabase|null
     */
    protected $dbComponent;
    /**
     * Свойство хранит объект компонента роутинга.
     *
     * @var IRoute|null
     */
    protected $routeComponent;

    /**
     * Метод исполнения заветных желаний.
     *
     * @return void
     *
     * @throws Exception
     */
    abstract public function run(): void;

    /**
     * Метод возвращает компонент БД.
     *
     * @param IDatabase $value Новое значение.
     *
     * @return void
     *
     * @throws Exception Если класс фабрики отсутствует.
     */
    public function setDb(IDatabase $value): void
    {
        $this->dbComponent = $value;
    }

    /**
     * Метод возвращает компонент запросов.
     *
     * @param IRoute $value Новое значение.
     *
     * @return void
     *
     * @throws Exception Если класс фабрики отсутствует.
     */
    public function setRoute(IRoute $value): void
    {
        $this->routeComponent = $value;
    }

    /**
     * Метод возвращает компонент БД.
     *
     * @return IDatabase
     *
     * @throws Exception
     */
    public function getDb(): IDatabase
    {
        if (null === $this->dbComponent) {
            throw new Exception('Компонент отсутствует.');
        }

        return $this->dbComponent;
    }

    /**
     * Метод возвращает компонент роутинга.
     *
     * @return IRoute
     *
     * @throws Exception
     */
    public function getRoute(): IRoute
    {
        if (null === $this->routeComponent) {
            throw new Exception('Компонент отсутствует.');
        }

        return $this->routeComponent;
    }
}
