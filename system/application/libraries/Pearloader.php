<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Pearloader{
  function load($package, $class,$options = null){
   require_once($package.'/'.$class.'.php');
   $classname = $package."_".$class;
   if(is_null($options)){
  return new $classname();
   }else{
  return new $classname($options);
   }
  }
}

?>  