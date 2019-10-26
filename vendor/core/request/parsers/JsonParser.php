<?php

namespace Core\request\parsers;

use Core\BaseObject;
use Core\request\interfaces\parsers\IParser;

/**
 * Класс JsonParser реализует методы парса json запросов.
 */
class JsonParser extends BaseObject implements IParser
{
    protected const REQUEST_BODY_STREAM = 'php://input';

    /**
     * Метод парсит входящий ответ.
     *
     * @return array
     */
    public function parse(): array
    {
        return json_decode(file_get_contents(static::REQUEST_BODY_STREAM), true);
    }
}
