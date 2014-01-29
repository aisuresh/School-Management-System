--TEST--
Bug #2364   Tabs in _quotedPrintableEncode()
--SKIPIF--
--FILE--
<?php
error_reporting(E_ALL); // ignore E_STRICT
$test = "Here's\t\na tab\n";
require_once('Mail/mimePart.php');
$part = new Mail_mimePart();
print $part->_quotedPrintableEncode($test, 7);
?>
--EXPECT--
Here's=
=09
a tab
