<?php


namespace App\Repository;

class LegacyFileFormatException extends \Exception
{
    public function __construct($message, $code = 0, \Exception $previous = null)
    {
        // some code

        // make sure everything is assigned properly
        parent::__construct($message, $code, $previous);
    }

    public function __toString()
    {
        return __CLASS__ . ": [{$this->code}]: {$this->message}\n";
    }
}
