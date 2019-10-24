<?php

declare(strict_types = 1);

namespace Core\application\components\console;

use Core\application\components\BaseApplication;
use Core\application\interfaces\console\IApplication;
use Core\migration\interfaces\IMigration;
use Core\request\interfaces\console\IRequest;
use Exception;

/**
 * Класс приложения.
 */
class Application extends BaseApplication implements IApplication
{
    /**
     * Свойство хранит объект компонента запроса.
     *
     * @var IRequest|null
     */
    protected $requestComponent;
    /**
     * Свойство хранит объект компонента миграций.
     *
     * @var IMigration|null
     */
    protected $migrationComponent;

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
        $route   = $request->getRoute();

        $controller = $this->getRoute()->findController($route);

        $controller->runAction($route);
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
}
