<?php
/* vim: set expandtab tabstop=4 shiftwidth=4: */
// +----------------------------------------------------------------------+
// | PHP Version 4                                                        |
// +----------------------------------------------------------------------+
// | Copyright (c) 1997 - 2003 The PHP Group                              |
// +----------------------------------------------------------------------+
// | This source file is subject to version 3.0 of the PHP license,       |
// | that is bundled with this package in the file LICENSE, and is        |
// | available at through the world-wide-web at                           |
// | http://www.php.net/license/3_0.txt.                                  |
// | If you did not receive a copy of the PHP license and are unable to   |
// | obtain it through the world-wide-web, please send a note to          |
// | license@php.net so we can mail you a copy immediately.               |
// +----------------------------------------------------------------------+
// | Author:  Klaus Guenther <klaus@capitalfocus.org>                     |
// +----------------------------------------------------------------------+
//
// $Id: Doctypes.php,v 1.5 2003/07/12 06:45:33 thesaur Exp $

/**
 * This file contains an array of doctype declarations.
 * These declarations have been taken directly from the w3c website:
 * http://www.w3c.org/
 * 
 */

// Array of defaults:
$default['default'][0] = 'XHTML 1.0 Transitional';

$default['xhtml'][0] = 'XHTML 1.0 Strict';
$default['xhtml']['1.0'][0] = 'XHTML 1.0 Strict';
$default['xhtml']['basic'][0] = 'XHTML Basic 1.0';

$default['html'][0] = 'HTML 4.01 Strict';
$default['html']['4.01'][0] = 'HTML 4.01 Strict';

// Array of doctype declarations:

// XHTML 1.0 Strict
$doctype['xhtml']['1.0']['strict'][] = '<!DOCTYPE html';
$doctype['xhtml']['1.0']['strict'][] = '    PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"';
$doctype['xhtml']['1.0']['strict'][] = '    "http://www.w3c.org/TR/xhtml1/DTD/xhtml1-strict.dtd">';

// XHTML 1.0 Transitional
$doctype['xhtml']['1.0']['transitional'][] = '<!DOCTYPE html';
$doctype['xhtml']['1.0']['transitional'][] = '    PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"';
$doctype['xhtml']['1.0']['transitional'][] = '    "http://www.w3c.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">';

// XHTML 1.0 Frameset
$doctype['xhtml']['1.0']['frameset'][] = '<!DOCTYPE html';
$doctype['xhtml']['1.0']['frameset'][] = '    PUBLIC "-//W3C//DTD XHTML 1.0 Frameset//EN"';
$doctype['xhtml']['1.0']['frameset'][] = '    "http://www.w3c.org/TR/xhtml1/DTD/xhtml1-frameset.dtd">';

// all ready for this :)
// XHTML 1.1
$doctype['xhtml']['1.1'][] = '<!DOCTYPE html';
$doctype['xhtml']['1.1'][] = '    PUBLIC "-//W3C//DTD XHTML 1.1//EN"';
$doctype['xhtml']['1.1'][] = '    "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">';

// XHTML Basic 1.0
$doctype['xhtml']['basic']['1.0'][] = '<!DOCTYPE html';
$doctype['xhtml']['basic']['1.0'][] = '    PUBLIC "-//W3C//DTD XHTML Basic 1.0//EN"';
$doctype['xhtml']['basic']['1.0'][] = '    "http://www.w3.org/TR/xhtml-basic/xhtml-basic10.dtd">';

// XHTML 2.0
// from the W3C Working Draft 6 May 2003
$doctype['xhtml']['2.0'][] = '<!DOCTYPE html';
$doctype['xhtml']['2.0'][] = '    PUBLIC "-//W3C//DTD XHTML 2.0//EN"';
$doctype['xhtml']['2.0'][] = '    "TBD">';

// HTML 4.01 Strict
$doctype['html']['4.01']['strict'][] = '<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN"';
$doctype['html']['4.01']['strict'][] = '        "http://www.w3.org/TR/html4/strict.dtd">';

// HTML 4.01 Transitional
$doctype['html']['4.01']['transitional'][] = '<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"';
$doctype['html']['4.01']['transitional'][] = '        "http://www.w3.org/TR/html4/loose.dtd">';

// HTML 4.01 Frameset
$doctype['html']['4.01']['frameset'][] = '<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Frameset//EN"';
$doctype['html']['4.01']['frameset'][] = '        "http://www.w3.org/TR/html4/frameset.dtd">';

// Since the following is simply historic, I'm not adding the level 1 & 2 or strict stuff.
// This doctype should be sufficient for most historic uses.

// HTML 2.0
$doctype['html']['2.0'][] = '<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML 2.0//EN">';

// HTML 3.2
$doctype['html']['3.2'][] = '<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 3.2 Final//EN">';

?>