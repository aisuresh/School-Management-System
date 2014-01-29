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
echo "<a href='".$url."category/listview'>";
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
echo "<div id ='message'></div>";
echo "<div id ='message1'></div>";
echo "<div id = 'mandatory' ><span align ='right' class = 'mandatory'>*</span> Specified fileds are mandatory</div>";
echo "<table border='0' cellpadding='0' cellspacing='0' class='formtable'>";
echo '<tr><th colspan = "3" id = "table_title">Create New Book Category Information</th></tr>';

echo "<tr>";

echo "<tr>";
echo "<td align='right' width='15%' class = 'datafield' >Book Category<span class = 'mandatory'>*</span></td>";
echo "<td width='2%' class='spacetd' > </td>";
echo "<td width='33%' class = 'dataview' ><input type = 'text' name = 'BookCategory' id = 'BookCategory' onKeyUp='JsCheckChar(this)' /></td>";
echo "</tr>";

echo "<tr>";
echo "<td align='right' width='15%' class = 'datafield' >Description</td>";
echo "<td width='2%' class='spacetd' > </td>";
echo "<td width='33%' class = 'dataview' ><input type = 'text' name = 'BookCategoryDes' id = 'BookCategoryDes' /></td>";
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
function validation(){
	var BookCategory = $('#BookCategory').val();
	
	if(BookCategory ==''){
		$('#message').html('Book Category should not be blank').show().fadeOut('slow').fadeIn('slow');
		$('#BookCategory').focus();
		return false;
	}else{
		return true;
	}
}
function save_data($e){

 var BookCategory = $('#BookCategory').val();
 var BookCategoryDes = $('#BookCategoryDes').val();

 if(validation()){
 		$.ajax({
				type: 'POST',
				url: '<?=$url?>category/save',
				data: 'BookCategory='+BookCategory+'&BookCategoryDes='+BookCategoryDes,
				success: function(response){			
						if(response == 1){
							if($e == 1){
								window.location.href='<?=$url?>category/listview';
							}else{
								alert('Insert Successfully');
							}	
						}else if(response == 2){
								alert('Record already exists!..');
							}else{
								alert('Insert Not Successfully');
						}
					}
					
		});
	}	
}		
</script>
