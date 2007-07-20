--TEST--
Answers isset() calls made against properties
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
assert('!isset($template->foo)');
$template->foo = 'bar';
assert('isset($template->foo)');

?>
===DONE===
--EXPECT--
===DONE===