<?php

require_once 'PEAR/Exception.php';

class Domain51_Template
{
    private $_data = array();
    private $_file = null;
    
    public function __construct($file)
    {
        if (!is_file($file)) {
            throw new Domain51_Template_NonValidFileException(
                'non-valid $file parameter provided',
                array(
                    '$file' => $file,
                )
            );
        }
        if (!is_readable($file)) {
            throw new Domain51_Template_FileNotReadableException(
                'provided $file parameter not readable',
                array('$file' => $file)
            );
        }
        
        $this->_file = $file;
    }
    
    public function __get($key)
    {
        return $this->_data[$key];
    }
    
    public function __set($key, $value)
    {
        $this->_data[$key] = $value;
    }
    
    public function __toString()
    {
        ob_start();
        include $this->_file;
        $buffer = ob_get_clean();
        return $buffer;
    }
}

class Domain51_Template_NonValidFileException extends PEAR_Exception { }
class Domain51_Template_FileNotReadableException extends PEAR_Exception { }