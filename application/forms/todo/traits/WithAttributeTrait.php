<?php

namespace App\forms\todo\traits;

/**
 * Трэит WithAttributeTrait добавляет атрибуты.
 */
trait WithAttributeTrait
{
    /**
     * Свойство хранит название.
     *
     * @var string|null
     */
    protected $name;
    /**
     * Свойство хранит признак выполнености.
     *
     * @var int
     */
    protected $isCompleted = 0;

    /**
     * Метод задает название.
     *
     * @param string $value Новое значение.
     *
     * @return void
     */
    public function setName(string $value): void
    {
        $this->name = $value;
    }

    /**
     * Метод возвращает название.
     *
     * @return string|null
     */
    public function getName(): ?string
    {
        return null === $this->name ? null : (string)$this->name;
    }

    /**
     * Метод задает признак выполнености.
     *
     * @param int $value Новое значение.
     *
     * @return void
     */
    public function setIsCompleted(int $value): void
    {
        $this->isCompleted = $value;
    }

    /**
     * Метод возвращает признак выполнености.
     *
     * @return int|null
     */
    public function getIsCompleted(): ?int
    {
        return null === $this->isCompleted ? null : (int)$this->isCompleted;
    }
}