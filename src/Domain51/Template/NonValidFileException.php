<?php

class Domain51_Template_NonValidFileException extends PEAR_Exception
{
    public function __construct($file)
    {
        parent::__construct(
            'non-valid $file parameter provided',
            array('$file' => $file)
        );
    }
}
