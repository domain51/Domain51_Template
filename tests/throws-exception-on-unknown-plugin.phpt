--TEST--
If a call is made against an unknown plug-in, a
Domain51_Template_UnknownPluginException will be thrown.
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
    $template->unknown();
    trigger_error('exception not caught');
} catch (Domain51_Template_UnknownPluginException $e) {
    assert('$e->getMessage() == "requested plugin unknown"');
    assert('$e->getCause() == array("\$plugin_name" => "unknown")');
}
?>
===DONE===
--EXPECT--
===DONE===