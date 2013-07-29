<?php

namespace Texter;

class Error
{
    private $name;
    private $file;
    private $line;
    private $exception;
    private $parameters;

    public function __construct($name, \Exception $exception)
    {
        $this->exception = $exception;
        $this->name      = $name;
        $this->renderException();
    }

    /**
     * @return \Exception
     */
    public function getException()
    {
        return $this->exception;
    }

    public function getFile()
    {
        return $this->file;
    }

    public function getLine()
    {
        return $this->line;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getParameters()
    {
        return $this->parameters;
    }

    public function getMessage()
    {
        return $this->getException()->getMessage();
    }

    protected function renderException()
    {
        $trace = $this->exception->getTrace();
        foreach ($trace as $error) {
            if (isset($error['file']) && Suite::$filePath == $error['file']) {
                $this->parameters = Suite::$parameters;
                $this->file       = $error['file'];
                $this->line       = $error['line'];
                break;
            }
        }
    }
}