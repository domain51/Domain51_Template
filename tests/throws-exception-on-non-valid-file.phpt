--TEST--
Domain51_Template will throw an exception if the $file parameter provided is
not a valid, readable file.
--FILE--
<?php
// BEGIN REMOVE
set_include_path(
    dirname(__FILE__) . '/../src' . PATH_SEPARATOR .
    get_include_path()
);
// END REMOVE

require_once 'Domain51/Template.php';

try {
    new Domain51_Template(dirname(__FILE__));
    trigger_error('exception not caught');
} catch (Domain51_Template_NonValidFileException $e) {
    assert('$e->getMessage() == "non-valid \$file parameter provided"');
    $expected = array(
        '$file' => dirname(__FILE__),
    );
    assert('$e->getCause() == $expected');
}

$unreadable = dirname(__FILE__) . '/unreadable';
touch($unreadable);
chmod($unreadable,  0200);

try {
    new Domain51_Template($unreadable);
    trigger_error('exception not caught');
} catch (Domain51_Template_FileNotReadableException $e) {
    assert('$e->getMessage() == "provided \$file parameter not readable"');
    assert('$e->getCause() == array("\$file" => $unreadable)');
}

?>
===DONE===
--CLEAN--
<?php @unlink(dirname(__FILE__) . '/unreadable'); ?>
--EXPECT--
===DONE===