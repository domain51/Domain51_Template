--TEST--
If no $alias parameter is specified as part of the registerCallback() call,
Domain51_Template will set an alias appropriate to the callback using the
following formula:

* functions will be registered as themselves
* static or instantiated object callbacks will regiseter as the method
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

// load plug-ins
require_once dirname(__FILE__) . '/_plugins.inc';

$template->registerCallback('some_plugin');
assert('$template->some_plugin() == "some_plugin"');

$template->registerCallback(array($obj, 'someMethod'));
assert('$template->someMethod() == "ASimpleClass::someMethod"');

$template->registerCallback(array($obj, 'someMethodWithParam'));
$random = rand(100, 200);
assert('$random == $template->someMethodWithParam($random)');

$template->registerCallback(array('ASimpleClass', 'someStaticMethod'));
assert('$template->someStaticMethod() == "ASimpleClass::someStaticMethod"');

?>
===DONE===
--EXPECT--
===DONE===