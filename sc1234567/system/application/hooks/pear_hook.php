<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Pear_hook{
  function index(){
  // OS independent
  //ini_set('include_path',ini_get('include_path').PATH_SEPARATOR.BASEPATH.'application/pear/');
  // on Apache
  // ini_set('include_path',ini_get('include_path').':'.BASEPATH.'application/pear/');
  // on Windows
   ini_set('include_path',ini_get('include_path').';'.BASEPATH.'application/pear/');
  }
}

?>  