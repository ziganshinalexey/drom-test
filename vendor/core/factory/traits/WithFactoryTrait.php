<?php

declare(strict_types = 1);

namespace Core\factory\traits;

use Core\factory\interfaces\IFactory;

/**
 * Трэит WithFactoryTrait подключает фабрику к классу.
 */
trait WithFactoryTrait
{
    /**
     * Свойство хранит объект фабрики.
     *
     * @var IFactory|null
     */
    protected $factory;

    /**
     * Метод задает объект фабрики.
     *
     * @param IFactory $value Новое значение.
     *
     * @return static
     */
    public function setFactory(IFactory $value): self
    {
        $this->factory = $value;

        return $this;
    }

    /**
     * Метод возвращает объект фабрики.
     *
     * @return IFactory
     */
    protected function getFactory(): IFactory
    {
        return $this->factory;
    }
}
