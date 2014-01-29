--TEST--
Bug #12411  RFC2047 encoded attachment filenames
--SKIPIF--
--FILE--
<?php
error_reporting(E_ALL); // ignore E_STRICT
include "Mail/mime.php";
$m = new Mail_mime();

// some text with polish Unicode letter at the beginning
$path = "/path/";
$filename = $path . base64_decode("xZtjaWVtYQ==");
$m->addAttachment('testfile', "text/plain", $filename, FALSE,
    'base64', 'attachment', 'ISO-8859-1', 'pl', '',
    'quoted-printable', 'base64');

$root = $m->_addMixedPart();
$enc = $m->_addAttachmentPart($root, $m->_parts[0]);

echo $enc->_headers['Content-Type'];
echo "\n";
echo $enc->_headers['Content-Disposition'];
?>
--EXPECT--
text/plain; charset=ISO-8859-1;
 name="=?ISO-8859-1?Q?=C5=9Bciema?="
attachment;
 filename="=?ISO-8859-1?B?xZtjaWVtYQ==?="
