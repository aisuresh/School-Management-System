<link rel="stylesheet" type="text/css" href="<?php echo $url .'css/calendar.css' ?>" />
<script type="text/javascript" src="<?php echo $url .'js/calendar/calendar_db.js' ?>"></script>
<?php

echo "<div class='container'>";
echo "<div class='content_header'>";
/*---------------     content title       ---------------------*/
echo "<div class='content_title'>";
echo $pagetitle.' > '. $event;
echo "</div>";
echo "<div class='content_message'>";
echo "</div>";
/*---------------     content events       ---------------------*/
echo "<div class='content_events'>";

echo "<div class='events'>";
echo "<a href='#' onclick = 'export_report();' >";
echo "<span><img src='".$url."images/export.gif' border='0' /></span>";
echo "<span>  Export  </span>";
echo "</a>";
echo "</div>";

echo"<div class = 'showbtn' >";
echo '<a href = "#" onclick = "show_reports();" >Go</a>';
echo "</div>";

echo "<div class = 'showbox' >";
echo "<select name = 'Year' id = 'Year' >";
echo "<option value = 'x'>- - Year - -</option>";
foreach( array_reverse($this->session->userdata('years')) as $ys){
	echo "<option value = '".$ys->AcademicYear."'>".$ys->AcademicYear."</option>";
}
echo "</select>";
echo "</div>";

echo "</div>";
echo "</div>";
/*---------------     content        ---------------------*/
echo "<div align = 'center' class='content' style = 'float:left; height:inherit; background-color:#fff' >";
//echo "<table border='0' cellpadding='0' cellspacing = '0' class='formtable'>";

echo "</div>";
echo "</div>";
?>
<script>
function show_reports(){
	var FromDate = $('#FromDate').val();
	var ToDate = $('#ToDate').val();
	var Year = $('#Year').val();
		$.ajax({
				type: 'POST',
				url: '<?=$url?>school/reports/strengthlist',
				data: 'FromDate='+FromDate+'&ToDate='+ToDate+'&Year='+Year,
				success: function(response){
					if(response != ''){
						$('.content').html(response);
					}
				}
		});
}
function export_report(){
	var year = $('#Year').val();
	window.location='<?=$url?>school/exportstrenth/'+year;
}
</script>