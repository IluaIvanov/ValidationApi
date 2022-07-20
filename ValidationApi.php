<?php

namespace App\Kernel\Plugin\ValidationApi;

use App\Kernel\Plugin\ValidationApi\Rules\Custom;
use App\Kernel\Plugin\ValidationApi\Rules\Exist;
use App\Kernel\Plugin\ValidationApi\Rules\General;
use Illuminate\Http\Request;

use Exception;
use Illuminate\Http\Response;

class ValidationApi
{
    /**
     * @var array
     * Library with Russian messages by default
     */

    protected static $languageRus;

    /**
     * @var array
     * Library with English messages by default
     */

    protected static $languageEn;

    /**
     * Array of comparisons of method names and keywords for the user
     * @var array
     */

    protected static $comparison = [
        'required' => 'isEmpty',
        'array' => 'isArray',
        'integer' => 'isNumeric',
        'string' => 'isString',
        'in_object' => 'inObject',
        'key_array' => 'inArrayKey',
        'in_array' => 'inArrayValue',
        'exist' => 'isExist',
        'bool' => 'isExist',
        'email' => 'isEmail',
        'phone' => 'isPhone',
        'between' => 'isBetween',
		'json' => 'isJSON'
    ];

    /**
     * Format of the output validation error message
     * @var int
     */

    protected static $format;

    /**
     * @var \Illuminate\Http\Request 
     */

    protected static $request;

    /**
     * A variable in which, if available, custom messages are placed
     * @var array
     */

    protected static $customMessage;

    /**
     * Variable for storing an array of parameters
     * 
     * @var array
     */

    protected static $parametrs = [];

    /**
     * Creates a new instance of the validator, 
     * and runs a method for parsing user input data
     * example string rules: ValidationApi:validate($request, [
     *   'limit:required|array|in_array?print,less/small/test',
     *   'phone:custom?App\Kernel\WorkData\Users\Users,issetPhoneNumber,exist,+700000',
     *   'phone:unique?User,phone,+79083205070/+79999999999'
     * ]);
     * 
     * @param \Illuminate\Http\Request
     * @param array $rules
     * @param int $format
     * @param array $custom
     * 
     * @return string format JSON 
     */

    public static function validate(Request $request, $rules, $format = DEFAULT_FORMAT_ERROR_DVOR24, $custom = '')
    {
        self::$languageRus = include __DIR__ . "/Language/LibraryRus.php";
        self::$languageEn = include __DIR__ . "/Language/LibraryEn.php";
        self::$request = $request;
        self::$format = $format;
        self::$customMessage = $custom;
        self::parseRulesCheck($rules, 'validate');
        return $request->all();
    }

    /**
     * Create a new instance of the alligator, and run a method for parsing user input data, 
     * is needed to get an array with the validated values at the output
     * example string rules: ValidationApi:validate($request, [
     *   'limit:required|array|in_array?print,less/small/test',
     *   'phone:custom?App\Kernel\WorkData\Users\Users,issetPhoneNumber,exist,+700000',
     *   'phone:unique?User,phone,+79083205070/+79999999999'
     * ]);
     * 
     * @param \Illuminate\Http\Request
     * @param array $rules
     * @param array $custom
     * 
     * @return array 
     */

    public static function validateParametrs(Request $request, $parametrs, $rules, $custom = '')
    {
        self::$parametrs = [];
        self::$request = $request;
        self::$customMessage = $custom;
        self::parseRulesCheck($rules, 'validateParametrs');
        return array_merge(self::$parametrs, $parametrs);
    }

    /**
     * Parse input strings on the field and rules via ":", 
     * as well as the rules themselves are not corrected via "|"
     * 
     * @param array $rules
     */

    protected static function parseRulesCheck($rules, $type)
    {
        foreach ($rules as $rule) {
            $attribute = explode(':', $rule);
            substr($attribute[1], -1) !== '|' ?: $attribute[1] = substr($attribute[1], 0, -1);
            $massRulesOneField = explode('|', $attribute[1]);
            $attribute = $attribute[0];
            switch ($type) {
                case 'validateParametrs':
                    self::checkComparison($attribute, $massRulesOneField, $type);
                    break;
                case 'validate':
                    self::checkComparison($attribute, $massRulesOneField, $type, self::$format);
                    break;
            }
        }
    }

    /**
     * Replaces stubs for field names (:attribute) with field names in the message
     * 
     * @param array|string $attribute
     * @param array|string $value
     * @param string $message
     */

    protected static function setAttribute($attribute, $value, $message)
    {
        return str_replace($attribute, $value, $message);
    }

    /**
     * Checking the mapping and generating an error message, including custom ones
     * 
     * @param string $attribute
     * @param array $rules
     * @param int $format
     * 
     * @return string format JSON
     */

    protected static function checkComparison($attribute, $rules, $type, $format = '')
    {
        $general = new General();
        if ($type == 'validateParametrs') $checkParametr = true;
        foreach ($rules as $rule) {
            $arguments = '';
            if (strpos($rule, '?') !== false) {
                $method = explode('?', $rule);
                $arguments = explode(',', $method[1]);
                $method = $method[0];
                foreach ($arguments as $key => $argument) {
                    strpos($argument, '/') === false ?: $arguments[$key] = explode('/', $argument);
                }

                $method == 'bool' ? $reqMethod = 'boolean' : $reqMethod = 'input';
                if ($method == 'custom') {
                    $result = (new Custom($arguments[0], $arguments[1], self::$comparison[$arguments[2]], $arguments[3]))->result;
                    $result ? $result = false : $result = true;
                } elseif ($method == 'unique') {
                    $result = (new Exist($arguments[0], $arguments[1], $arguments[2]))->result;
                    $result ? $result = false : $result = true;
                } else {
                    $methodClass = self::$comparison[$method];
                    $countArgument = count($arguments);
                    if ($countArgument > 4) throw new Exception("The number of input data cannot be more than four");
                    switch ($countArgument) {
                        case 1:
                            $result = $general->$methodClass(self::$request->$reqMethod($attribute), $arguments[0]);
                            break;
                        case 2:
                            $result = $general->$methodClass(self::$request->$reqMethod($attribute), $arguments[0], $arguments[1]);
                            break;
                        case 3:
                            $result = $general->$methodClass(self::$request->$reqMethod($attribute), $arguments[0], $arguments[1], $arguments[2]);
                            break;
                        case 4:
                            $result = $general->$methodClass(self::$request->$reqMethod($attribute), $arguments[0], $arguments[1], $arguments[2], $arguments[3]);
                            break;
                    }
                }
            } else {
                $method = $rule;
                $method == 'bool' ? $reqMethod = 'boolean' : $reqMethod = 'input';
                $methodClass = self::$comparison[$rule];
                $result = $general->$methodClass(self::$request->$reqMethod($attribute));
            }

            if ($type == 'validate' && !$result) self::getResponse($attribute, $method, $arguments, $format);
            if ($type == 'validateParametrs' && !$result) $checkParametr = false;
        }

        if ($type == 'validateParametrs' && $checkParametr) self::getArrayParams($attribute);
    }

    protected function getResponse($attribute, $method, $arguments, $format)
    {
        $messageEn = self::$languageEn[$method];
        $messageRus = self::$languageRus[$method];
        $attributeEn = $attributeRus = $attribute;

        if (!empty(self::$customMessage)) {
            if (array_key_exists($attribute, self::$customMessage)) {
                if (array_key_exists('atr', self::$customMessage[$attribute])) {
                    if (array_key_exists('en', self::$customMessage[$attribute]['atr'])) $attributeEn = self::$customMessage[$attribute]['atr']['en'];
                    $attributeRus = self::$customMessage[$attribute]['atr']['ru'];
                }
                if (array_key_exists($method, self::$customMessage[$attribute])) {
                    if (array_key_exists('message', self::$customMessage[$attribute][$method])) {
                        $messageEn = self::$customMessage[$attribute][$method]['message']['en'];
                        $messageRus = self::$customMessage[$attribute][$method]['message']['ru'];
                    }
                }
            }
        }
        if (isset($arguments[0])) {
            if (strpos($messageEn, ":min") !== false && strpos($messageEn, ":max") !== false) {
                $search = [':attribute', ':min', ':max'];
                $replaceRus = [$attributeRus, $arguments[0], $arguments[1]];
                $replaceEn = [$attributeEn, $arguments[0], $arguments[1]];
            } else {
                $search = [':attribute', ':other'];
                $replaceRus = [$attributeRus, $arguments[0]];
                $replaceEn = [$attributeEn, $arguments[0]];
            }
        } else {
            $search = ':attribute';
            $replaceRus = $attributeRus;
            $replaceEn = $attributeEn;
        }

        getResponse([
            self::setAttribute($search, $replaceEn, $messageEn),
            self::setAttribute($search, $replaceRus, $messageRus)
        ], 400, $format);
    }

    protected function getArrayParams($attribute)
    {
        if (!empty(self::$customMessage) && array_key_exists($attribute, self::$customMessage)) {
            self::$parametrs[self::$customMessage[$attribute]] = self::$request->input($attribute);
        } else {
            self::$parametrs[$attribute] = self::$request->input($attribute);
        }
    }
}
