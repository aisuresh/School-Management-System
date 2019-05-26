<?php
$this->load->helper('html');
echo doctype();
echo "<html xmlns='http://www.w3.org/1999/xhtml'>";
echo "<head>";
echo meta('Content-type', 'text/html; charset=utf-8', 'equiv');
echo "<title>" . $title . "</title>";
echo link_tag('css/tab.css');
?>
<script type='text/javascript' src='<?php echo $url; ?>js/jquery.min.js'></script>
<?php
echo'</head>

<body>
	<div id="tabwarp">
    	<div id="tabheader">
        	<div id="tablogo">';
		echo img('images/logo.gif');	
		echo'</div>
            <div id="tablogo_right"></div>
        </div>';

?>


