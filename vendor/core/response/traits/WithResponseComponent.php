<?php

declare(strict_types = 1);

namespace Core\response\traits;

use Core\Core;
use Core\response\interfaces\IResponse;
use Exception;

/**
 * Трэит WithResponseComponent подключает переменную компонента к классу.
 */
trait WithResponseComponent
{
    /**
     * Свойство содержит компонент.
     *
     * @var IResponse|null
     */
    protected $responseComponent;

    /**
     * Метод возвращает компонент.
     *
     * @return IResponse
     *
     * @throws Exception Если компонент не зарегистирован.
     */
    protected function getResponseComponent(): IResponse
    {
        if (null === $this->responseComponent) {
            $this->responseComponent = Core::getApplication()->getComponent(IResponse::COMPONENT_NAME);
        }

        return $this->responseComponent;
    }

    /**
     * Метод задает компонент.
     *
     * @param IResponse $value Новое значение.
     *
     * @return void
     */
    protected function setResponseComponent(IResponse $value): void
    {
        $this->responseComponent = $value;
    }
}
