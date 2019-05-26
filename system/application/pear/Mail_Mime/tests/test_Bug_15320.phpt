--TEST--
Bug #15320  Charset parameter in Content-Type of mail parts
--SKIPIF--
--FILE--
<?php
error_reporting(E_ALL); // ignore E_STRICT
include "Mail/mime.php";
$m = new Mail_mime();
$m->addAttachment('testfile', "text/plain", 'file.txt', FALSE, 'base64', 'attachment', 'ISO-8859-1');
$root = $m->_addMixedPart();
$enc = $m->_addAttachmentPart($root, $m->_parts[0]);
print_r($enc->_headers['Content-Type']);
?>
--EXPECT--
text/plain; charset=ISO-8859-1;
 name=file.txt

