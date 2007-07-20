--TEST--
By using Domain51_Template::registerCallback(), a developer can register
plug-ins that are accessible via $this.  Each plug-in will receive as its
first parameter, a copy of the Domain51_Loader that initialized it and all
of the additional parameters that were specificed when the callback was
called.
--FILE--
<?php
// BEGIN REMOVE
set_include_path(
    dirname(__FILE__) . '/../src' . PATH_SEPARATOR .
    get_include_path()
);
// END REMOVE

require_once 'Domain51/Template.php';

function some_plugin(Domain51_Template $template)
{
    return __FUNCTION__;
}

class ASimpleClass
{
    public function someMethod(Domain51_Template $template)
    {
        return __METHOD__;
    }
    
    public function someMethodWithParam(Domain51_Template $template, $param)
    {
        return $param;
    }
    
    public static function someStaticMethod(Domain51_Template $template)
    {
        return __METHOD__;
    }
}

$template = new Domain51_Template(__FILE__);

// sanity check
$obj = new ASimpleClass();
assert('$obj->someMethod($template) == "ASimpleClass::someMethod"');
$random = "random number: " . rand(100, 200);
assert('$obj->someMethodWithParam($template, $random) == $random');
assert('ASimpleClass::someStaticMethod($template) == "ASimpleClass::someStaticMethod"');
assert('some_plugin($template) == "some_plugin"');

$template->registerCallback('some_plugin', 'plugin');
assert('some_plugin($template) == $template->plugin()');

$template->registerCallback(array($obj, 'someMethod'), 'method');
assert('$obj->someMethod($template) == $template->method()');

$template->registerCallback(array($obj, 'someMethodWithParam'), 'params');
$random = rand(100, 200);
assert('$random == $template->params($random)');

$template->registerCallback(array('ASimpleClass', 'someStaticMethod'), 'staticMethod');
assert('$template->staticMethod() == "ASimpleClass::someStaticMethod"');


?>
===DONE===
--EXPECT--
===DONE===