<?php

namespace ValidationApi\Rules;

class General
{
    /**
     * Check on empty
     * 
     * @param alltype $value;
     * @return boolean true/false
     */

    public function isEmpty($value)
    {
        $result = '';
        is_array($value) ? (count($value) > 0 ? $result = true : $result = false) : ((!empty($value) && $value !== 'null') || $value === 0 ? $result = true : $result = false);
        return $result;
    }

    /**
     * Check on array
     * 
     * @param array $value;
     * @return boolean true/false
     */

    public function isArray($value)
    {
        is_array($value) ? $result = true : $result = false;
        return $result;
    }

    /**
     * Check on numeric
     * 
     * @param integer $value;
     * @return boolean true/false
     */

    public function isNumeric($value)
    {
        is_numeric($value) ? $result = true : $result = false;
        return $result;
    }

    /**
     * Check on string
     * 
     * @param string $value;
     * @return boolean true/false
     */

    public function isString($value)
    {
        is_string($value) ? $result = true : $result = false;
        return $result;
    }

    /**
     * Check on exist
     * 
     * @param integer $value;
     * @return boolean true/false
     */

    public function isExist($value)
    {
        $value ? $result = true : $result = false;
        return $result;
    }

    /**
     * Check on exist in object
     * 
     * @param object $value
     * @param string $key;
     * @return boolean true/false
     */

    public function inObject($value, $key)
    {
        property_exists($value, $key) ? $result = true : $result = false;
        return $result;
    }

    /**
     * Check on exist in array key 
     * 
     * @param array $value
     * @param string $key;
     * @return boolean true/false
     */

    public function inArrayKey($value, $key)
    {
        array_key_exists($key, $value) ? $result = true : $result = false;
        return $result;
    }

    /**
     * Check on exist in array value
     * 
     * @param array $value
     * @param allType $key;
     * @return boolean true/false
     */

    public function inArrayValue($value, $key)
    {
        in_array($key, $value) ? $result = true : $result = false;
        return $result;
    }

    /**
     * Check email address
     * 
     * @param string $value
     * @return boolean true/false
     */

    public function isEmail($value)
    {
        filter_var($value, FILTER_VALIDATE_EMAIL) === false ? $result = false : $result = true;
        return $result;
    }

    /**
     * Check phone number
     * 
     * @param string $value
     * @return boolean true/false
     */

    public function isPhone($value)
    {
        !preg_match('/^((\+7|8|\+374|\+994|\+995|\+375|\+7|\+380|\+38|\+996|\+998|\+993)[\- ]?)?\(?\d{3,5}\)?[\- ]?\d{1}[\- ]?\d{1}[\- ]?\d{1}[\- ]?\d{1}[\- ]?\d{1}(([\- ]?\d{1})?[\- ]?\d{1})?$/', $value) ? $result = false : $result = true;
        return $result;
    }

    /**
     * Checking the value from two sides, no more and no less
     * 
     * @param alltype $value;
     * @return boolean true/false
     */

    public function isBetween($value, $min, $max)
    {
        $result = '';
        !is_array($value) ? (is_numeric($value) ? $count = $value : ($value == null && $min == 0 ? $result = true : $result = false)) : $count = count($value);
        if ($result === true) return $result;
        if ($result !== false) $count >= $min && $count <= $max ? $result = true : $result = false;
        return $result;
    }

	/**
	 * Checking the validity of a json string
	 * 
	 * @param $value
	 * @return boolean true/false
	 */

	function isJSON($value) {
		json_decode($value);
		json_last_error() === JSON_ERROR_NONE ? $result = true : $result = false;
		return $result;
	}
}
