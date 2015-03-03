<?php

namespace Data\Field;

abstract class Fieldset
{
    protected static $default = array();
    protected static $primary = array();
    protected static $unique  = array();
    protected static $index   = array();
    protected static $serial;

    protected $fields = array();

    protected function define($name, $value)
    {
        if ( ! isset (static::$default[$name])) {
            static::$default[$name] = $value;

            if ($value instanceof \Data\Field\Int && $value->serial === true) {
                if (static::$serial !== null) {
                    throw new \Exception('Only one serial field allowed, ' . static::$serial . ' is already defined, rejecting the field ' . $name);
                }
                static::$serial = $name;
                $this->primary($name);
            }
        }

        $this->fields[$name] = clone static::$default[$name];
    }

    public function __get($name)
    {
        return $this->fields[$name]->data->value;
    }

    public function field($name)
    {

        return $this->fields[$name];
    }

    public function __set($name, $value)
    {
        if ($value !== null) {
            try {
                $this->fields[$name]->set($value);
            } catch (\Exception $e) {
                $class = get_class($e);
                throw new $class('Problems with the field "' . $this->table . '.' . $name . '": ' . $e->getMessage());
            }
        }
    }

    public function primary($name)
    {
        if (array_search($name, static::$primary) === false) {
            static::$primary[] = $name;
        }
    }

    public function unique($name, array $fields = array())
    {
        if ( ! isset (static::$unique[$name])) {
            if (empty ($fields)) {
                $fields = array($name);
            }

            foreach ($fields as $key => $value) {
                if ( ! isset (static::$default[$value])) {
                    throw new \Exception('Field doesn\'t exist: ' . $value);
                }
            }

            if (isset (static::$index[$name])) {
                throw new \Exception('Duplicate key name: "' . $name . '"');
            }

            static::$unique[$name] = $fields;
        }
    }

    public function index($name, array $fields = array())
    {
        if ( ! isset (static::$index[$name])) {
            if (empty ($fields)) {
                $fields = array($name);
            }

            foreach ($fields as $key => $value) {
                if ( ! isset (static::$default[$value])) {
                    throw new \Exception('Field doesn\'t exist: ' . $value);
                }
            }

            if (isset (static::$unique[$name])) {
                throw new \Exception('Duplicate key name: "' . $name . '"');
            }

            static::$index[$name] = $fields;
        }
    }
}
