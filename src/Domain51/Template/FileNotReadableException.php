<?php

class Domain51_Template_FileNotReadableException extends PEAR_Exception
{
    public function __construct($file)
    {
        parent::__construct(
            'provided $file parameter not readable',
            array('$file' => $file)
        );
    }
}
