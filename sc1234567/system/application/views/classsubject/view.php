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
echo "<a href='".$url."classsubject/listview'>";
echo "<span> <img src='".$url."images/cancel.png' border='0' /></span>";
echo "<span>Cancel</span>";
echo "</a>";
echo "</div>";

echo "<div class='events'>";
echo "<a onclick='edit_data();' >";
echo "<span><img src='".$url."images/edit.png' border='0' /></span>";
echo "<span> Edit </span>";
echo "</a>";
echo "</div>";

echo "</div>";
echo "</div>";
/*---------------     content        ---------------------*/
echo "<div align='center' class='content'>";
echo "<table border='0' cellpadding='0' cellspacing = '0' class='formtable'>";
$count=0;
foreach($result as $row):
if($count != 1){
echo "<input type='hidden' name = 'ClassId' id = 'ClassId' value = '".$row->ClassId."'";

echo "<tr>";
echo "<td align='right' width='15%' class = 'datafield' >Class </td>";
echo "<td width='2%' class='spacetd' > </td>";
echo "<td width='33%' class = 'dataview'>";
echo "<select name = 'Class' id = 'Class' disabled>";
echo "<option value = 'x'>- - Select Class - -</option>";
foreach($course as $rowa):
	if($row->ClassId == $rowa->ClassId){
		echo "<option value = '".$rowa->ClassId."' selected='selected' >";
		echo $rowa->ClassName;
		echo "</option>";
	}else{
		echo "<option value = '".$rowa->ClassId."' >";
		echo $rowa->ClassName;
		echo "</option>";
	}	
endforeach;
echo "</select>";
echo "</td></tr>";
 $count = 1;
}
endforeach;
echo "</table>";
echo '<fieldset id="studentclass" style ="width:462px; height:308px;">
 	<div id = "select_box" style ="width:200px; height:300px;" >
	    <select name="selectfrom" id="select-from" multiple size="5" style ="width:200px; height:300px;">
		</select>
 	</div>

    <div id = "addremove" style ="margin-top:-40px;" >	
        <a href="JavaScript:void(0);" id="btn-add" disabled><img src="'.$url.'images/right_green.gif" /></a>
        <a href="JavaScript:void(0);" id="btn-remove" disabled><img src="'.$url.'images/left_green.gif" /></a>	
 	</div> 
    <div id = "select_box" style ="width:200px; height:300px;" >
     	<select name="selectto" id="select-to" class = "select-to" multiple size="5" style ="width:200px; height:300px;">
	    </select>
   </div>
  </fieldset>';
echo "</div>";
echo "</div>";
?>
<link rel="stylesheet" type="text/css" href="<?php echo $url .'themes/css/calendar.css' ?>" />
<script type="text/javascript" src="<?php echo $url .'themes/js/calendar/calendar_db.js' ?>"></script>
<script type="text/javascript" src="<?php echo $url .'themes/js/calendar/calendar_eu.js' ?>"></script>
<script type="text/javascript" src="<?php echo $url .'themes/js/calendar/calendar_us.js' ?>"></script>
<script>
function edit_data(){
 var ClassId = $('#ClassId').val();
 window.location='<?=$url?>classsubject/edit/'+ClassId;
}

function getSubjects(){	
	var Class = $('#Class').val();
	if(Class != 'x'){
		getAvailableSubjects();
		getSelectedSubjects();
	}
}

function getAvailableSubjects(){
	var Class = $('#Class').val();
	 $.ajax({
		type: 'POST',
		url: '<?=$url?>classsubject/getAvailableSubjects',
		data: 'Class='+Class,
		success: function(response){			
				if(response != 'error'){
				    $('#select-from').html(response);					
				}
			}
	});
}

function getSelectedSubjects(){
	var Class = $('#Class').val();
	 $.ajax({
		type: 'POST',
		url: '<?=$url?>classsubject/getSelectedSubjects',
		data: 'Class='+Class,
		success: function(response){
				if(response != 'error'){
				    $('#select-to').html(response);					
				}
			}
	});
}

$(document).ready(function(){
	$(function(){
     getSubjects();
   });
});

</script>
