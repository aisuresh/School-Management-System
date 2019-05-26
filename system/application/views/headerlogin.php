<?php
echo doctype();
echo "<html xmlns='http://www.w3.org/1999/xhtml'>";
echo "<head>";
echo meta('Content-type', 'text/html; charset=utf-8', 'equiv');
echo "<title>" . $title . "</title>";
echo link_tag('css/style.css');
?>
<script type='text/javascript' src='<?php echo $url; ?>themes/js/jquery.min.js'></script>
<script type='text/javascript' src="<?php echo $url; ?>themes/js/jquery-1.9.0.js"></script>
<?php
echo "</head>";
echo "<body marginheight='0' marginwidth='0'>";
echo "<div class='header'>";
	echo "<div class='logo'>";
		echo img('images/vsreesoft_logo.png');
    echo "</div>"; 	
echo "</div>";
?>