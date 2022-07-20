<?php

namespace ValidationApi\Rules;

use Exception;

class Custom
{
    /**
     * Class in folder WorkData
     * 
     * @param object $class
     */
    protected $class;

    /**
     * Name method in class
     * 
     * @param string $method
     */

    protected $method;

    /**
     * Type check return value
     * 
     * @param string $check
     */

    protected $check;

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
     * @param object $class
     * @param string $method
     * @param string $check
     * @param mixed $data
     */

    public function __construct($class, $method, $check, $data)
    {
        $class = '\\'.$class;
        $class = (new $class);

        if(is_object($class)) $this->class = $class; else throw new Exception("Invalid incomind data(class)");
        if(is_string($method)) $this->method = $method; else throw new Exception("Invalid incomind data(method)");
        if(is_string($check)) $this->check = $check; else throw new Exception("Invalid incomind data(check)");
        $this->data = $data;
        $this->checkExist();   
    }

    /**
     * A function that checks the result 
     * of the selected method in the selected class
     */

    protected function checkExist()
    {
        $general = new General();
        $nameMethod = $this->method;
        if(is_array($this->data)){
            $countData = count($this->data);
            if($countData > 4) throw new Exception("The number of input data cannot be more than four");
            switch ($countData) {
                case 1:
                    $result = $this->class->$nameMethod($this->data[0]);
                    break;
                case 2:
                    $result = $this->class->$nameMethod($this->data[0], $this->data[1]);
                    break;
                case 3:
                    $result = $this->class->$nameMethod($this->data[0], $this->data[1], $this->data[2]);
                    break;
                case 4:
                    $result = $this->class->$nameMethod($this->data[0], $this->data[1], $this->data[2], $this->data[3]);
                    break;
            }
        } else {
            $result = $this->class->$nameMethod($this->data);
        }
        $check = $this->check;
        $this->result = $general->$check($result);
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
