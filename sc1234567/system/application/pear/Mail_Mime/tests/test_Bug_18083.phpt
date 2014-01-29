--TEST--
Bug #18083  Separate charset for attachment's content and headers
--SKIPIF--
--FILE--
<?php
error_reporting(E_ALL); // ignore E_STRICT
include "Mail/mime.php";
$m = new Mail_mime();

$m->addAttachment('testfile', "text/plain",
    base64_decode("xZtjaWVtYQ=="), FALSE,
    'base64', 'attachment', 'ISO-8859-1', 'pl', '',
    'quoted-printable', 'base64', '', 'UTF-8');

$root = $m->_addMixedPart();
$enc = $m->_addAttachmentPart($root, $m->_parts[0]);

echo $enc->_headers['Content-Type'];
echo "\n";
echo $enc->_headers['Content-Disposition'];
?>
--EXPECT--
text/plain; charset=ISO-8859-1;
 name="=?UTF-8?Q?=C5=9Bciema?="
attachment;
 filename="=?UTF-8?B?xZtjaWVtYQ==?="
