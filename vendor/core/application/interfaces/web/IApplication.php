<?php

declare(strict_types = 1);

namespace Core\application\interfaces\web;

use Core\db\interfaces\IDatabase;
use Core\request\interfaces\web\IRequest;
use Core\route\interfaces\IRoute;

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
     * Метод возвращает компонент запросов.
     *
     * @return IRequest
     */
    public function getRequest(): IRequest;

    /**
     * Метод возвращает компонент роутинга.
     *
     * @return IRoute
     */
    public function getRoute(): IRoute;

    /**
     * Метод возвращает компонент БД.
     *
     * @return IDatabase
     */
    public function getDb(): IDatabase;
}
