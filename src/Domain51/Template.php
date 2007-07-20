<?php
/**
 * This file contians {@link Domain51_Template}
 *
 * @package Tools
 * @subpackage Template
 * @author Travis Swicegood <development@domain51.com>
 * @version Release: @@VERSION@@
 * @copyright 2007 Domain51
 * @license http://www.gnu.org/licenses/lgpl.html LGPL
 */

/**
 * Insure that Domain51_Loader is already available
 *
 * @ignore
 */
require_once 'Domain51/Loader.php';


/**
 * Domain51_Template provides a small, lightweight,
 * extensible templating engine.
 * 
 * Values are assigned by assigning properties to
 * the template object, and retrieved within the
 * templates via the $this object.
 * 
 * Domain51_Template implements a Value Object
 * pattern.  As such, once instantiated, the
 * template object represents on file in the file
 * system.  There is no limit on how the file is
 * named, or where it is placed.  The only
 * criteria is that it must be readable, and when
 * passed to is_file(), return true.
 * 
 * Plug-ins can be any valid PHP callback,
 * allowing infinite flexibility in configuring
 * your template object.  Plugins, once
 * registered, are accessed via the $this object,
 * either using their method or function name if
 * no $alias was provided, or the using the name
 * provided as its $alias when registered.
 *
 * @package Tools
 * @subpackage Template
 * @author Travis Swicegood <development@domain51.com>
 * @version Release: @@VERSION@@
 * @copyright 2007 Domain51
 * @license http://www.gnu.org/licenses/lgpl.html LGPL
 */
class Domain51_Template
{
    private $_callbacks = array();
    private $_data = array();
    private $_file = null;
    
    /**
     * Handle instantiation
     *
     * @param string $file A valid file
     */
    public function __construct($file)
    {
        if (!is_file($file)) {
            throw new Domain51_Template_NonValidFileException($file);
        }
        if (!is_readable($file)) {
            throw new Domain51_Template_FileNotReadableException($file);
        }
        
        $this->_file = $file;
    }
    
    /**
     * Magic method to handle retrieving assigned values to the template object
     *
     *
     * @param string $key
     * 
     * @return mixed
     */
    public function __get($key)
    {
        return $this->_data[$key];
    }
    
    
    /**
     * Magic method to handle assigning values to this template object
     *
     *
     * @param string $key
     * 
     * @param mixed $value
     */
    public function __set($key, $value)
    {
        $this->_data[$key] = $value;
    }
    
    
    /**
     * Magic method to handle isset() calls made against assigned values
     *
     *
     * @param string $key
     *
     * @return bool
     */
    public function __isset($key)
    {
        return isset($this->_data[$key]);
    }
    
    
    /**
     * Magic method to handle converting this object to a string
     *
     *
     * @return string
     */
    public function __toString()
    {
        ob_start();
        include $this->_file;
        $buffer = ob_get_clean();
        return $buffer;
    }
    
    
    /**
     * Used to register callbacks to use as plug-ins.
     *
     * $callback must be a valid callback as determined by is_callable().  If not null,
     * $alias will serve as the name used to invoke the callback; if null, the function
     * or method name will be used to invoke the callback.
     *
     *
     * @param mixed $callback
     *
     * @param null|string $alias
     */
    public function registerCallback($callback, $alias = null)
    {
        if (!is_callable($callback)) {
            throw new Domain51_Template_InvalidCallbackException($callback);
        }
        
        if (is_null($alias)) {
            $alias = is_string($callback) ? $callback : $callback[1];
        }
        
        $this->_callbacks[$alias] = $callback;
    }
    
    /**
     * Magic method to handle dispatching method calls to registered plug-ins
     *
     *
     * @param string $plugin_name
     *
     * @param array $arguments
     */
    public function __call($plugin_name, $arguments)
    {
        if (!isset($this->_callbacks[$plugin_name])) {
            throw new Domain51_Template_UnknownPluginException($plugin_name);
        }
        
        array_unshift($arguments, $this);
        return call_user_func_array(
            $this->_callbacks[$plugin_name],
            $arguments
        );
    }
}
