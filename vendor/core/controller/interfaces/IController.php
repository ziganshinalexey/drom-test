<?php

declare(strict_types = 1);

namespace Core\controller\interfaces;

/**
 * Интерфейс IController объявляет методы контроллера.
 */
interface IController
{
    public const ACTION_PREFIX = 'action';

    /**
     * Метод  исполнения действия.
     *
     * @param string $route     Роут.
     * @param array  $paramList Список параметров.
     *
     * @return void
     */
    public function runAction(string $route, array $paramList = []): void;
}
