--TEST--
Domain51_Template requires a valid file at instantiation
--FILE--
<?php
// BEGIN REMOVE
set_include_path(
    dirname(__FILE__) . '/../src' . PATH_SEPARATOR .
    get_include_path()
);
// END REMOVE

require_once 'Domain51/Template.php';

$obj = new Domain51_Template(__FILE__);

try {
    new Domain51_Template(dirname(__FILE__));
    trigger_error('exception not caught');
} catch (Domain51_Template_NonValidFileException $e) {
    
}

?>
===DONE===
--EXPECT--
===DONE===