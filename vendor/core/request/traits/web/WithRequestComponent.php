<?php

declare(strict_types = 1);

namespace Core\request\traits\web;

use Core\Core;
use Core\request\interfaces\components\web\IRequest;
use Exception;

/**
 * Трэит WithRequestComponent подключает переменную компонента к классу.
 */
trait WithRequestComponent
{
    /**
     * Свойство содержит компонент.
     *
     * @var IRequest|null
     */
    protected $requestComponent;

    /**
     * Метод возвращает компонент.
     *
     * @return IRequest
     *
     * @throws Exception Если компонент не зарегистирован.
     */
    protected function getRequestComponent(): IRequest
    {
        if (null === $this->requestComponent) {
            $this->requestComponent = Core::getApplication()->getComponent(IRequest::COMPONENT_NAME);
        }

        return $this->requestComponent;
    }

    /**
     * Метод задает компонент.
     *
     * @param IRequest $value Новое значение.
     *
     * @return void
     */
    protected function setRequestComponent(IRequest $value): void
    {
        $this->requestComponent = $value;
    }
}
