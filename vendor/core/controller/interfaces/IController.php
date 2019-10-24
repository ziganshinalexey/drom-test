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
     * @param string $route Роут.
     *
     * @return void
     */
    public function runAction(string $route): void;
}
