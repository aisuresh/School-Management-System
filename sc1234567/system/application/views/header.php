<?php
echo doctype();

echo "<html xmlns='http://www.w3.org/1999/xhtml'>";
echo "<head>";

echo meta('Content-type', 'text/html; charset=utf-8', 'equiv');

echo "<title>" . $title . "</title>";

echo link_tag('themes/'.$this->session->userdata('InstituteId').'/css/style.css');
echo link_tag('themes/'.$this->session->userdata('InstituteId').'/css/superfish.css');
echo link_tag('themes/'.$this->session->userdata('InstituteId').'/css/custom-theme/jquery-ui-1.10.0.custom.css');
?>
<script type='text/javascript' src="http://code.jquery.com/jquery-1.10.2.min.js"></script>
<!--<script type='text/javascript' src="<?php echo $url; ?>themes/js/jquery.js"></script>-->
<script type='text/javascript' src="<?php echo $url; ?>themes/js/jquery-ui-1.10.0.custom.js"></script>
<script type='text/javascript' src='<?php echo $url; ?>themes/js/template.js'></script>

<?php

echo "</head>";
echo "<body marginheight='0' marginwidth='0'>";
echo "<div class='header'>";
	echo "<div class='logo'>";
		echo img('themes/'.$this->session->userdata('InstituteId').'/images/logo.png');
    echo "</div>";
	echo "<div class='logout_bar'>"; 
	echo "<div align='right'  class='logout'>";
	echo "<span align='right' style=' width:100%;'> 
	<span style='font-size:14px; font-weight:bold; color:#404343;'> Welcome:</span> 
	<span style='font-size:14px; color:#404343;'>" .$this->session->userdata('username') . "</span> 
	</span>";
	echo "<span align='right' style='width:100%; float:left;' > <a href='".$url."login/logout'>Logout</a> </span>";
	echo "</div>"; 	
echo "</div>";
?>
