<?php

declare(strict_types = 1);

namespace Core\response\interfaces;

use Core\application\interfaces\IComponent;

/**
 * Интерфейс IRequest объявляет методы компонента.
 */
interface IResponse extends IComponent
{
    public const COMPONENT_NAME = 'response';

    /**
     * Метод задает список заголовков.
     *
     * @param array $value
     *
     * @return IResponse
     */
    public function setHeaderList(array $value): IResponse;

    /**
     * Метод возвращает список заголовков.
     *
     * @return array
     */
    public function getHeaderList(): array;

    /**
     * Метод добавляет/заменяет заголовок к ответу.
     *
     * @param string $key   Название заголовка.
     * @param string $value Значение.
     *
     * @return IResponse
     */
    public function addHeader(string $key, string $value): IResponse;

    /**
     * Метод отправляет ответ пользователю.
     *
     * @param string $content Сообщение для пользователя.
     * @param int    $code    Код ответа.
     *
     * @return void
     */
    public function send(string $content = null, int $code = 200): void;
}
