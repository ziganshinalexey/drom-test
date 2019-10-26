<?php

declare(strict_types = 1);

namespace Core\request\components\web;

use Core\BaseObject;
use Core\Core;
use Core\request\interfaces\components\web\IRequest;
use Core\request\interfaces\parsers\IParser;
use Exception;
use ReflectionException;

/**
 * Класс-компонент Request реализует методы парсинга входящего запроса.
 */
class Request extends BaseObject implements IRequest
{
    protected const SERVER_REQUEST_URI_KEY   = 'REDIRECT_URL';
    protected const CONTENT_TYPE_HEADER_NAME = 'content-type';
    /**
     * Свойтсво хранит роут по-умолчанию.
     *
     * @var string|null
     */
    protected $defaultRouteName;
    /**
     * Свойство содержит список парсеров ответа.
     *
     * @var IParser[]
     */
    protected $parserList = [];

    /**
     * Метод возвращает путь обращения.
     *
     * @return string
     *
     * @throws Exception Если роутинг поломался.
     */
    public function getRouteName(): string
    {
        $uri = substr($_SERVER[static::SERVER_REQUEST_URI_KEY], 1);

        if (empty($uri)) {
            return $this->getDefaultRouteName();
        }

        return $uri;
    }

    /**
     * Метод возвращает параметры запроса метода GET.
     *
     * @param string $key Ключ для выборки.
     *
     * @return string|null
     */
    public function getByKey(string $key): ?string
    {
        return (string)$_GET[$key] ?? null;
    }

    /**
     * Метод возвращает параметры запроса метода POST.
     *
     * @return array
     *
     * @throws ReflectionException
     * @throws Exception
     */
    public function post(): array
    {
        $this->parse();

        return (array)$_POST;
    }

    /**
     * Метод парсит данные входящего ответа.
     *
     * @throws ReflectionException
     * @throws Exception
     */
    protected function parse(): void
    {
        $headerList        = array_change_key_case(getallheaders());
        $contentTypeHeader = $headerList[static::CONTENT_TYPE_HEADER_NAME] ?? null;

        if (! $contentTypeHeader && ! $this->getParserList()[$contentTypeHeader]) {
            return;
        }

        $parserConfig = $this->getParserList()[$contentTypeHeader];
        $parser       = Core::createObject($parserConfig);

        if (! $parser instanceof IParser) {
            throw new Exception('Объект должен реализовать IParser');
        }

        $_POST = $parser->parse();
    }

    /**
     * Метод задает роут по-умолчанию.
     *
     * @param string $value Новое значение.
     *
     * @return void
     */
    public function setDefaultRouteName(string $value): void
    {
        $this->defaultRouteName = $value;
    }

    /**
     * Метод возвращает роут по-умолчанию.
     *
     * @return string|null
     *
     * @throws Exception
     */
    protected function getDefaultRouteName(): ?string
    {
        if (null === $this->defaultRouteName) {
            throw new Exception('Роут по-умолчанию не задан.');
        }

        return $this->defaultRouteName;
    }

    /**
     * Метод задает список парсеров.
     *
     * @param array $value новое значение.
     *
     * @return void
     *
     * @throws Exception
     */
    public function setParserList(array $value): void
    {
        $this->parserList = $value;
    }

    /**
     * Метод возвращает список парсеров.
     *
     * @return IParser[]
     */
    protected function getParserList(): array
    {
        return $this->parserList;
    }
}