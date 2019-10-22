<?php

declare(strict_types = 1);

namespace Core\application\console;

use Core\application\interfaces\IApplication;
use Core\BaseObject;
use Core\db\interfaces\IDatabase;
use Core\migration\interfaces\IMigration;
use Core\request\interfaces\IRequest;
use Core\route\interfaces\IRoute;
use Exception;

/**
 * Класс приложения.
 */
class Application extends BaseObject implements IApplication
{
    /**
     * Свойство хранит объект компонента запроса.
     *
     * @var IRequest|null
     */
    protected $requestComponent;
    /**
     * Свойство хранит объект компонента роутинга.
     *
     * @var IRoute|null
     */
    protected $routeComponent;
    /**
     * Свойство хранит объект компонента миграций.
     *
     * @var IMigration|null
     */
    protected $migrationComponent;
    /**
     * Свойство хранит объект компонента БД.
     *
     * @var IDatabase|null
     */
    protected $dbComponent;

    /**
     * Метод исполнения заветных желаний.
     *
     * @return void
     *
     * @throws Exception
     */
    public function run(): void
    {
        $request = $this->getRequest();

        $route     = $request->getRoute();
        $paramList = $request->getParamList();

        $controller = $this->getRoute()->findController($route);

        $controller->runAction($route, $paramList);
    }

    /**
     * Метод возвращает компонент запросов.
     *
     * @param IRequest $value Новое значение.
     *
     * @return void
     *
     * @throws Exception Если класс фабрики отсутствует.
     */
    public function setRequest(IRequest $value): void
    {
        $this->requestComponent = $value;
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
     * Метод возвращает компонент запросов.
     *
     * @param IMigration $value Новое значение.
     *
     * @return void
     *
     * @throws Exception Если класс фабрики отсутствует.
     */
    public function setMigration(IMigration $value): void
    {
        $this->migrationComponent = $value;
    }

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
     * @return IRequest
     *
     * @throws Exception
     */
    public function getRequest(): IRequest
    {
        if (null === $this->requestComponent) {
            throw new Exception('Компонент отсутствует.');
        }

        return $this->requestComponent;
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

    /**
     * Метод возвращает компонент миграций.
     *
     * @return IMigration
     *
     * @throws Exception
     */
    public function getMigration(): IMigration
    {
        if (null === $this->migrationComponent) {
            throw new Exception('Компонент отсутствует.');
        }

        return $this->migrationComponent;
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
}
