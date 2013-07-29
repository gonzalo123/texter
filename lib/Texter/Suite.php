<?php

namespace Texter;

class Suite
{
    static private $errors = [];
    static public $filePath;
    static public $parameters;
    static public $describeCount = 0;

    static public function appendError(Error $error)
    {
        self::$errors[] = $error;
    }

    /**
     * @return Error[]
     */
    static public function getErrors()
    {
        return self::$errors;
    }
}