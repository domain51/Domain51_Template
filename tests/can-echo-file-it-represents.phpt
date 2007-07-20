--TEST--
When Domain51_Template is cast to a string, it outputs the file it represents
--FILE--
<?php
// BEGIN REMOVE
set_include_path(
    dirname(__FILE__) . '/../src' . PATH_SEPARATOR .
    get_include_path()
);
// END REMOVE

require_once 'Domain51/Template.php';

echo new Domain51_Template(dirname(__FILE__) . '/support/hello-world.txt') . "\n";

$template = new Domain51_Template(dirname(__FILE__) . '/support/message.tpl');
$template->message = "Hola World!";
echo $template . "\n";

$template->message = "This is a message...";
echo $template . "\n";

?>
===DONE===
--EXPECT--
Hello World!
Hola World!
This is a message...
===DONE===