<?php

declare(strict_types = 1);

namespace Core\controller;

use App\traits\WithUserComponent;
use Core\BaseObject;
use Core\controller\interfaces\IController;
use Core\request\traits\web\WithRequestComponent;
use Core\response\traits\WithResponseComponent;
use Exception;

/**
 * Класс Controller реализует методы контроллера.
 */
class Controller extends BaseObject implements IController
{
    use WithUserComponent;
    use WithResponseComponent;
    use WithRequestComponent;

    public const LOGIN_PERMISSION  = '?';
    public const LOGOUT_PERMISSION = '@';
    /**
     * Свойство хранит карту Идентификатор действия => Право.
     *
     * @var array
     */
    protected $permissionMap = [];
    /**
     * Свойтсво хранит карту Условное название => Путь к файлу.
     *
     * @var array
     */
    protected $viewMap = [];

    /**
     * Метод задает карту Условное название => Путь к файлу.
     *
     * @param array $value Новое значение.
     *
     * @return static
     */
    public function setViewMap(array $value): IController
    {
        $this->viewMap = $value;

        return $this;
    }

    /**
     * Метод возвращает карту Условное название => Путь к файлу.
     *
     * @return array
     */
    public function getViewMap(): array
    {
        return $this->viewMap;
    }

    /**
     * Метод  исполнения действия.
     *
     * @param string $route Роут.
     *
     * @return void
     *
     * @throws Exception Если действие не найдено.
     */
    public function runAction(string $route): void
    {
        $actionId   = substr($route, strripos($route, '/') + 1);
        $actionName = static::ACTION_PREFIX . ucfirst($actionId);

        if (! method_exists($this, $actionName)) {
            $this->getResponseComponent()->send('Page not found', 404);

            return;
        }

        if (! $this->checkPermission($actionId)) {
            $this->getResponseComponent()->send('Permission denied', 403);

            return;
        }

        $this->$actionName();
    }

    /**
     * Метод проверяет права пользователя.
     *
     * @param string $actionId
     *
     * @return bool
     *
     * @throws Exception Если действие не найдено.
     */
    protected function checkPermission(string $actionId): bool
    {
        if (! isset($this->permissionMap[$actionId])) {
            return true;
        }

        $user = $this->getUserComponent()->getCurrentUser();

        if (empty($user) && $this->permissionMap[$actionId] === static::LOGOUT_PERMISSION) {
            return true;
        }
        if (! empty($user) && $this->permissionMap[$actionId] === static::LOGIN_PERMISSION) {
            return true;
        }

        return false;
    }

    /**
     * Метод рендера страницы.
     *
     * @param string $relativeUrl Относительный путь.
     *
     * @return void
     *
     * @throws Exception
     */
    protected function redirect(string $relativeUrl): void
    {
        $response = $this->getResponseComponent();
        $response->addHeader('Location', $relativeUrl);

        $response->send();
    }

    /**
     * Метод рендера страницы.
     *
     * @param string $view      Ключ для карты с шаблоном вьюхи.
     * @param array  $paramList Список параметров для рендера страницы.
     *
     * @return void
     *
     * @throws Exception
     */
    protected function render(string $view, array $paramList = []): void
    {
        $viewPath = $this->getViewMap()[$view] ?? null;
        if (null === $viewPath || ! is_file($viewPath) || ! is_readable($viewPath)) {
            throw new Exception('Вью не найдена.');
        }

        extract($paramList, EXTR_OVERWRITE);
        ob_start();
        require_once $viewPath;
        $content = ob_get_contents();
        ob_end_clean();

        $this->getResponseComponent()->send($content);
    }

    /**
     * Метод рендера json документа.
     *
     * @param array $paramList Список параметров для рендера страницы.
     *
     * @return void
     *
     * @throws Exception
     */
    protected function renderJson(array $paramList = []): void
    {
        $content  = json_encode($paramList, JSON_UNESCAPED_UNICODE);
        $response = $this->getResponseComponent();
        $response->addHeader('Content-Type', 'application/json');

        $response->send($content);
    }
}
