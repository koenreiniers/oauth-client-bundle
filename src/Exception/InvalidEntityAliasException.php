<?php
namespace Kr\OAuthClientBundle\Exception;

class InvalidEntityAliasException extends \RuntimeException
{
    public function __construct($alias)
    {
        $message = "Invalid entity alias: '$alias''";
        $code = 500;
        $previous = null;
        parent::__construct($message, $code, $previous);
    }
}