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
echo "<span class = 'mandatory'>*</span> Specified fileds are mandatory";
echo "<table border='0' cellpadding='0' cellspacing='0' class='formtable'>";
echo '<tr><th colspan = "3" id = "table_title">Create Class Subject Information</th></tr>';
echo "<tr>";
echo "<td align='right' width='15%' class = 'datafield' >Class <span class = 'mandatory'>*</span></td>";
echo "<td width='2%' class='spacetd' > </td>";
echo "<td width='33%' class = 'dataview' >";
echo "<select name = 'Class' id = 'Class' onchange = 'getSubjects();' >";
echo "<option value = 'x'>- - Select Class - -</option>";
foreach($course as $row):
	echo "<option value = '".$row->ClassId."' >";
	echo $row->ClassName;
	echo "</option>";
endforeach;
echo "</select>
</td>";
echo "</tr>";
echo "</table>";

echo '<fieldset id="studentclass" style ="width:462px; height:308px;">
 	<div id = "select_box" style ="width:200px; height:300px;" >
        <select name="selectfrom" id="select-from" class = "select-from" multiple size="5" style ="width:200px; height:300px;" >
		</select>
 	</div>
    <div id = "addremove" style ="margin-top:-40px;" >
        <a href="JavaScript:void(0);" id="btn-add"><img src="'.$url.'images/right_green.gif" /></a>
        <a href="JavaScript:void(0);" id="btn-remove"><img src="'.$url.'images/left_green.gif" /></a>
 	</div>
    <div id = "select_box" style ="width:200px; height:300px;" >
    	<select name="selectto" id="select-to" class = "select-to" multiple size="5" style ="width:200px; height:300px;" >
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
function validation(){
	var Class = $('#Class').val();
	var Subject = $('#select-to').val();
	if(Class =='x'){
		$('#message').html('Student Class should not be blank').show().fadeOut('slow').fadeIn('slow');
		$('#Class').focus();
		return false;
	}else if(Subject == null){
		$('#message').html('Select at least one option from left side list.').show().fadeOut('slow').fadeIn('slow');
		$('#select-from').focus();
		return false;
	}else{
		return true;
	}
}

function save_data($e){ 
 //select all subjects present in right side. 
 var selecttosub = document.getElementById("select-to");
	for (var i = 0; i < selecttosub.length; i++) {
	 selecttosub[i].selected = true;     
 }
 var Class = $('#Class').val();
 var Subject = $('#select-to').val();  
 if(validation()){
		 $.ajax({
			type: 'POST',
			url: '<?=$url?>classsubject/save',
			data: 'Class='+Class+'&Subject='+Subject,
			success: function(response){
					if(response.length > 1) {
						response = response.slice(-1);   
					}
					if(response == 1){
						if($e == 1){
							window.location.href='<?=$url?>classsubject/listview';
						}else{
							alert('Insert Successfully');
						}
					}else{
						alert('Insert Not Successfully');
					}
			}
		});
  }	
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
//if(validation()){
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
//}
}

function getSelectedSubjects(){
	var Class = $('#Class').val();
//if(validation()){
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
//}
}

function selectCurrentSubjects(){
  var selecttosub = document.getElementById("select-to");
	for (var i = 0; i < selecttosub.length; i++) {
	 selecttosub[i].selected = true;
  }
}

$(document).ready(function() {
    $('#btn-add').click(function(){
        $('#select-from option:selected').each( function() {		
            $('#select-to').append("<option value='"+$(this).val()+"' selected='selected'>"+$(this).text()+"</option>");
	        $(this).remove();
        });
    });
    $('#btn-remove').click(function(){
        $('#select-to option:selected').each( function() {
            $('#select-from').append("<option value='"+$(this).val()+"'>"+$(this).text()+"</option>");
            $(this).remove();
			selectCurrentSubjects();
        });
    });
    $('#btn-up').bind('click', function() {
        $('#select-to option:selected').each( function() {
            var newPos = $('#select-to option').index(this) - 1;
            if (newPos > -1) {
                $('#select-to option').eq(newPos).before("<option value='"+$(this).val()+"' selected='selected'>"+$(this).text()+"</option>");
                $(this).remove();
            }
        });
    });
    $('#btn-down').bind('click', function() {
        var countOptions = $('#select-to option').size();
        $('#select-to option:selected').each( function() {
            var newPos = $('#select-to option').index(this) + 1;
            if (newPos < countOptions) {
                $('#select-to option').eq(newPos).after("<option value='"+$(this).val()+"' selected='selected'>"+$(this).text()+"</option>");
                $(this).remove();
            }
        });
    });
});
			
</script>
