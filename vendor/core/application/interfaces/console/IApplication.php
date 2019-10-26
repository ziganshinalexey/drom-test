<?php

declare(strict_types = 1);

namespace Core\application\interfaces\console;

use Core\application\interfaces\IComponent;
use Exception;

/**
 * Интерфейс IApplication объявляет методы приложения.
 */
interface IApplication
{
    /**
     * Метод исполнения заветных желаний.
     *
     * @return void
     */
    public function run(): void;

    /**
     * Метод возвращает компонент по его названию.
     *
     * @param string $name Название компонента.
     *
     * @return IComponent
     *
     * @throws Exception
     */
    public function getComponent(string $name): IComponent;
}
