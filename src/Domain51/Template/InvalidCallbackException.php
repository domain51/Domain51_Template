<?php

class Domain51_Template_InvalidCallbackException extends PEAR_Exception
{
    public function __construct($callback)
    {
        parent::__construct(
            '$callback not valid',
            array('$callback' => $callback)
        );
    }
}