<?php

namespace Data\Field;

use SplSubject;
use SplObserver;
use Data\Type\Type;

use InvalidArgumentException;

abstract class Field implements SplObserver
{
    /**
     * @var string
     */
    protected $name;

    /**
     * @var Type
     */
    protected $data;

    /**
     * @var mixed
     */
    protected $default;

    /**
     * @var bool
     */
    protected $changed = false;

    /**
     * @var bool
     */
    protected $nullable;

    /**
     * @param string $name
     * @param Type   $data
     * @param bool   $nullable
     */
    public function __construct($name, Type $data, $nullable)
    {
        if (! is_string($name)) {
            throw new InvalidArgumentException('Name must be string');
        }

        if (! is_bool($nullable)) {
            throw new InvalidArgumentException('Nullable must be bool');
        }

        $this->name = $name;
        $this->data = $data;
        $this->nullable = $nullable;

        if (! $this->getData()->isNull()) {
            $this->check();
            $this->default = $this->getData()->value();
        }
        $this->getData()->attach($this);
    }

    /**
     * Check the value of the data when it's changing
     */
    abstract protected function check();

    /**
     * Return the name property
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Return the data instance
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * Return the default property
     */
    public function getDefault()
    {
        return $this->default;
    }

    /**
     * Observe the change of the data
     *
     * @param SplSubject $subject
     */
    public function update(SplSubject $subject)
    {
        if (! $subject->isNull()) {
            $this->check();
        }

        $this->changed = true;
    }

    /**
     * Is this field changed?
     *
     * @return bool
     */
    public function isChanged()
    {
        return $this->changed === true;
    }

    /**
     * Is this field nullable?
     *
     * @return bool
     */
    public function isNullable()
    {
        return $this->nullable === true;
    }
}
