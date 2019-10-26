<?php

declare(strict_types = 1);

namespace Core\application\components\web;

use Core\application\components\BaseApplication;
use Core\application\interfaces\web\IApplication;
use Core\request\traits\web\WithRequestComponent;
use Core\route\traits\WithRouteComponent;
use Exception;

/**
 * Класс приложения.
 */
class Application extends BaseApplication implements IApplication
{
    use WithRequestComponent;
    use WithRouteComponent;

    /**
     * Метод исполнения заветных желаний.
     *
     * @return void
     *
     * @throws Exception
     */
    public function run(): void
    {
        $route = $this->getRequestComponent()->getRouteName();

        $controller = $this->getRouteComponent()->findController($route);

        $controller->runAction($route);
    }
}
