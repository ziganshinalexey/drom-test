<?php

declare(strict_types = 1);

namespace Core\response\components;

use Core\BaseObject;
use Core\response\interfaces\IResponse;

/**
 * Класс-компонент Response реализует методы отправки ответа.
 */
class Response extends BaseObject implements IResponse
{
    /**
     * Свойство содержит список заголовков.
     *
     * @var array
     */
    protected $headerList = [];

    /**
     * Метод задает список заголовков.
     *
     * @param array $value
     *
     * @return IResponse
     */
    public function setHeaderList(array $value): IResponse
    {
        $this->headerList = $value;

        return $this;
    }

    /**
     * Метод возвращает список заголовков.
     *
     * @return array
     */
    public function getHeaderList(): array
    {
        return (array)$this->headerList;
    }

    /**
     * Метод добавляет/заменяет заголовок к ответу.
     *
     * @param string $key   Название заголовка.
     * @param string $value Значение.
     *
     * @return IResponse
     */
    public function addHeader(string $key, string $value): IResponse
    {
        $this->headerList[$key] = $value;

        return $this;
    }

    /**
     * Метод отправляет ответ пользователю.
     *
     * @param string $content Сообщение для пользователя.
     * @param int    $code    Код ответа.
     *
     * @return void
     */
    public function send(string $content, int $code = 200): void
    {
        $this->sendHeaders($code);
        $this->sendContent($content);
    }

    /**
     * Метод формирует заголовки для сообщения.
     *
     * @param int $code Код ответа.
     *
     * @return void
     */
    protected function sendHeaders(int $code): void
    {
        header('HTTP/1.1 ' . $code);

        foreach ($this->getHeaderList() as $name => $value) {
            header(sprintf('%s: %s', $name, $value));
        }
    }

    /**
     * Метод отправляет контент.
     *
     * @param string $content Сообщение для пользователя.
     *
     * @return void
     */
    protected function sendContent(string $content): void
    {
        echo $content;
    }
}
