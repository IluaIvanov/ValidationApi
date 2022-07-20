<?php

namespace App\Kernel\Plugin\ValidationApi\Rules;

use Exception;

class Exist
{
    /**
     * Model database
     * 
     * @param object $class
     */
    protected $class;

    /**
     * Name field in table
     * 
     * @param string $field
     */

    protected $field;

    /**
     * Incoming data
     * 
     * @param mixed $data
     */

    protected $data;

    /**
     * Result work
     * 
     * @param boolean $result
     */

    protected $result;

    /**
     * Completion construct
     * 
     * @param string $class
     * @param string $field
     * @param mixed $data
     */

    public function __construct($class, $field, $data)
    {
        if (stripos($class, 'app') !== false) {
            $class = '\\' . $class;
        } else {
            $class = "\App\Models\\" . $class;
        }
        $class = (new $class);
        if (is_object($class)) $this->class = $class; else throw new Exception("Invalid incomind data(class)");
        if (is_string($field)) $this->field = $field; else throw new Exception("Invalid incomind data(field)");
        $this->data = $data;
        $this->checkExist();
    }

    /**
     * A function that checks a record in the database 
     * for existence using a simple query can also check multiple records.
     * Returns the result to the result variable
     */

    protected function checkExist()
    {
        is_array($this->data) ? $result = $this->class->whereIn($this->field, $this->data)->limit(1) : $result = $this->class->where($this->field, $this->data)->limit(1);
        $result = $result->get();
        count($result) == 1 ? $this->result = true : $this->result = false; 
    }

    /**
     * Get parametrs class.
     * Used to return the result of the work
     */

    public function __get($parametr)
    {
        return $this->$parametr;
    }
}
