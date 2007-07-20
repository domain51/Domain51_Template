--TEST--
If you attempt to register a non-valid callback with registerCallback(), a
Domain51_Template_InvalidCallbackException will be thrown.
--FILE--
<?php
// BEGIN REMOVE
set_include_path(
    dirname(__FILE__) . '/../src' . PATH_SEPARATOR .
    get_include_path()
);
// END REMOVE

require_once 'Domain51/Template.php';

$template = new Domain51_Template(__FILE__);
try {
    $template->registerCallback('unknown_and_unkowable_function', 'foo');
    trigger_error('exception not caught');
} catch (Domain51_Template_InvalidCallbackException $e) {
    assert('$e->getMessage() == "\$callback not valid"');
    assert('$e->getCause() == array("\$callback" => "unknown_and_unkowable_function")');
}
?>
===DONE===
--EXPECT--
===DONE===