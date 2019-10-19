<?php

declare(strict_types = 1);

namespace Autoload;

/**
 * Класс AutoLoader для подключения классов.
 */
class AutoLoader
{
    protected const PHP_EXTENSION = 'php';
    /**
     * Свойтсво хранит карту пространство имен => директория.
     *
     * @var array
     */
    protected $namespaceMap = [];

    /**
     * Метод задает карту пространство имен => директория.
     *
     * @param array $value Новое значение.
     *
     * @return static
     */
    public function setNamespaceMap(array $value): self
    {
        $this->namespaceMap = $value;

        return $this;
    }

    /**
     * Метод возвращает карту пространство имен => директория.
     *
     * @return array
     */
    public function getNamespaceMap(): array
    {
        return $this->namespaceMap;
    }

    /**
     * Метод импортирует файл с классом.
     *
     * @param string $className Класс в очереди для автозагрузки.
     *
     * @return bool
     */
    public function includeClass(string $className): bool
    {
        $file = $this->findFileByClass($className);

        if ($file) {
            require_once $file;

            return true;
        }

        return false;
    }

    /**
     * Метод ищет файл по названию класса (Логина psr).
     *
     * @param string $className Название класса.
     *
     * @return null|string
     */
    protected function findFileByClass($className): ?string
    {
        $pathAsPSR4 = strtr($className, '\\', DIRECTORY_SEPARATOR) . '.' . static::PHP_EXTENSION;

        $namespace = $className;
        while (false !== $lastPos = strrpos($namespace, '\\')) {
            $namespace = substr($namespace, 0, $lastPos);

            if (isset($this->getNamespaceMap()[$namespace])) {
                $relativeFilePath = DIRECTORY_SEPARATOR . substr($pathAsPSR4, $lastPos + 1);

                $absoluteFilePath = $this->getNamespaceMap()[$namespace] . $relativeFilePath;

                if ($absoluteFilePath && file_exists($absoluteFilePath)) {
                    return $absoluteFilePath;
                }
            }
        }

        return null;
    }
}
