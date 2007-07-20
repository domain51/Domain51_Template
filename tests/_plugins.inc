<?php

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

// sanity check
$obj = new ASimpleClass();
assert('$obj->someMethod($template) == "ASimpleClass::someMethod"');
$random = "random number: " . rand(100, 200);
assert('$obj->someMethodWithParam($template, $random) == $random');
assert('ASimpleClass::someStaticMethod($template) == "ASimpleClass::someStaticMethod"');
assert('some_plugin($template) == "some_plugin"');
