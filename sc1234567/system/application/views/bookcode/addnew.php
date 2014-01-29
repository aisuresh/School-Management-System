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
echo "<a href='".$url."bookcode/listview'>";
echo "<span> <img src='".$url."images/cancel.png' border='0' /></span>";
echo "<span>Cancel</span>";
echo "</a>";
echo "</div>";

echo "<div class='events'>";
echo "<a onclick='save_data(2);'>";
echo "<span><img src='".$url."images/apply.png' border='0' /></span>";
echo "<span>Apply</span>";
echo "</a>";
echo "</div>";

echo "<div class='events'>";
echo "<a onclick='save_data(1);'>";
echo "<span><img src='".$url."images/save.png' border='0' /></span>";
echo "<span>Save</span>";
echo "</a>";
echo "</div>";

echo "</div>";
echo "</div>";
/*---------------     content        ---------------------*/
echo "<div align='center' class='content'>";

echo "<table border='0' cellpadding='0' cellspacing='0' class='formtable'>";
echo "<tr>";

echo "<tr>";
echo "<td align='right' width='15%' class = 'datafield' >Book Code</td>";
echo "<td width='2%' class='spacetd' > </td>";
echo "<td width='33%' class = 'dataview' ><input type = 'text' name = 'BookCode' id = 'BookCode' /></td>";
echo "</tr>";

echo "<tr>";
echo "<td align='right' width='15%' class = 'datafield' >Book Category</td>";
echo "<td width='2%' class='spacetd' > </td>";
echo "<td width='33%' class = 'dataview' >";
echo "<select name = 'BookCategoryId' id = 'BookCategoryId' >";
echo "<option value = 'x'>- - Select Book Code - -</option>";
	foreach($bookcategory as $rowa):
		echo "<option value = '".$rowa->BookCategoryId."' >";
		echo $rowa->BookCategory;
		echo "</option>";
	endforeach;
echo "</select>";
echo "</td></tr>";

echo "<tr>";
echo "<td align='right' width='15%' class = 'datafield' >Description</td>";
echo "<td width='2%' class='spacetd' > </td>";
echo "<td width='33%' class = 'dataview' ><input type = 'text' name = 'BookCodeDes' id = 'BookCodeDes' /></td>";
echo "</tr>";

echo "</table>";

echo "</div>";
echo "</div>";
?>
<link rel="stylesheet" type="text/css" href="<?php echo $url .'css/calendar.css' ?>" />
<script type="text/javascript" src="<?php echo $url .'js/calendar/calendar_db.js' ?>"></script>
<script type="text/javascript" src="<?php echo $url .'js/calendar/calendar_eu.js' ?>"></script>
<script type="text/javascript" src="<?php echo $url .'js/calendar/calendar_us.js' ?>"></script>
<script>
function save_data($e){

 var BookCode = $('#BookCode').val();
 var BookCategoryId = $('#BookCategoryId').val();
 var BookCodeDes = $('#BookCodeDes').val();
 
 $.ajax({
				type: 'POST',
				url: '<?=$url?>bookcode/save',
				data: 'BookCode='+BookCode+'&BookCategoryId='+BookCategoryId+'&BookCodeDes='+BookCodeDes,
				success: function(response){			
						if(response == 1){
							if($e == 1){
								window.location.href='<?=$url?>bookcode/listview';
							}else{
								alert('Insert Successfully');
							}	
						}else{
							alert('Insert Not Successfully');
						}
					}
					
		});
}		
</script>
