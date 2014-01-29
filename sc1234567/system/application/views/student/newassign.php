<link rel="stylesheet" type="text/css" href="<?php echo $url .'themes/css/calendar.css' ?>" />
<script type="text/javascript" src="<?php echo $url .'themes/js/calendar/calendar_db.js' ?>"></script>

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
echo "<a href='".$url."student/assignlist/".$this->session->userdata('yearas')."'>";
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
echo "<div id ='message' style = 'width:480px' ></div>";
echo "<div id ='message1' ></div>";
//echo "<div><span align ='left'><b>Please ensure that you have created next acadamic year</b></span></div>";
echo "<div id = 'mandatory' ><span align ='right' class = 'mandatory'>*</span> Specified fileds are mandatory</div>";
echo "<table border='0' cellpadding='0' cellspacing='0' class='formtable' >";

echo "<tr>";
echo "<td align='right' width='15%' class = 'datafield' >Acadamic Year</td>";
echo "<td width='2%' class='spacetd' > </td>";
echo "<td width='10%' class = 'datafield' style='padding-left:15px' >Current Year (".$this->session->userdata('yearas').")</td>";
echo "<td width='10%' class = 'datafield' style='padding-left:15px' >Next Year (".$nextacadamicyear.")</td>";
echo "</tr>";

echo "<tr>";
echo "<td align='right' width='15%' class = 'datafield' >Class<span class = 'mandatory'>*</span></td>";
echo "<td width='2%' class='spacetd' > </td>";
echo "<td width='10%' class = 'dataview' >";
echo "<select name = 'ClassId' id = 'oldClassId' onchange = 'get_sectionlist(1);' >";
echo "<option value = 'x'>- - Select Class - -</option>";
	foreach($course as $rowa):
		echo "<option value = '".$rowa->ClassId."' >";
		echo $rowa->ClassName;
		echo "</option>";
	endforeach;
echo "</select>";
echo "</td>";
echo "<td width='10%' class = 'dataview' >";
echo "<select name = 'ClassId' id = 'newClassId' onchange = 'get_sectionlist(2);' >";
echo "<option value = 'x'>- - Select Class - -</option>";
	foreach($course as $rowa):
		echo "<option value = '".$rowa->ClassId."' >";
		echo $rowa->ClassName;
		echo "</option>";
	endforeach;
echo "</select>";
echo "</td></tr>";



echo "<tr>";
echo "<td align='right' width='15%' class = 'datafield' >Section<span class = 'mandatory'>*</span></td>";
echo "<td width='2%' class='spacetd' > </td>";
echo "<td width='10%' class = 'dataview' >";
echo "<select name = 'SectionId' id = 'oldSectionId' onchange = 'get_studentlist();' >";
echo "<option value = 'x'>- - Select Section - -</option>";
echo "</select>";
echo "</td>";
echo "<td width='10%' class = 'dataview' >";
echo "<select name = 'SectionId' id = 'newSectionId' >";
echo "<option value = 'x'>- - Select Section - -</option>";
echo "</select>";
echo "</td>";
echo "</td></tr>";

/*echo "<tr>";
echo "<td align='right' width='15%' class = 'datafield' >Roll No</td>";
echo "<td width='2%' class='spacetd' > </td>";
echo "<td width='33%' class = 'dataview' >";
echo "<select name = 'RollNo' id = 'RollNo' >";
echo "<option value = 'x'>- - Select RollNo - -</option>";
echo "</select>";
echo "</td></tr>";*/

echo "</table>";
echo '<fieldset id="studentclass">
 	<div id = "select_box" >
        <select name="selectfrom" id="select-from" multiple size="5">
        </select>
 	</div>
    <div id = "addremove" >
        <a href="JavaScript:void(0);" id="btn-add"><img src="'.$url.'images/right_green.gif" /></a>
        <a href="JavaScript:void(0);" id="btn-remove"><img src="'.$url.'images/left_green.gif" /></a>
 	</div>
    <div id = "select_box" >
    <select name="selectto" id="select-to" class = "select-to" multiple size="5">
    </select>
 	</div>
  </fieldset>';


echo "</div>";
echo "</div>";
?>

<script>

function validation(){
 var Class = $('#Class').val();
 var RollNo = $('.select-to').val();
	alert(RollNo); 
	 if(Class == 'x'){
		$('#message').html('Class should not be blank').show().fadeOut('slow').fadeIn('slow');
		$('#Class').focus();
		return false;
	}else if(RollNo == null || RollNo == ''){
		$('#message').html('Please select at least on one option from right side box').show().fadeOut('slow').fadeIn('slow');
		$('#RollNo').focus();
		return false;
	}else{
		return true;
	}
}


function save_data($e){
 var Class = $('#Class').val();
 var SectionId = $('#SectionId').val();
 var RollNo = $('.select-to').val();
	if(validation()){
 		$.ajax({
				type: 'POST',
				url: '<?=$url?>student/assignsave',
				data: 'RollNo='+RollNo+'&Class='+Class+'&SectionId='+SectionId,
				success: function(response){
						if(response == 1){
							if($e == 1){
								window.location.href='<?=$url?>student/assignlist/<?=$this->session->userdata('yearsh')?>';
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

function get_sectionlist($i){
	var ClassId = $('#oldClassId').val();
	$.ajax({
			type: 'POST',
			url: '<?=$url?>student/section',
			data: 'ClassId='+ClassId,
			success: function(response){
					if(response != ''){
						if($i == 1){
							$('#oldSectionId').html(response);
						}else {
							$('#newSectionId').html(response);	
						}						
					}
			}
				
	});
}	

function get_studentlist(){
	var ClassId = $('#oldClassId').val();
	var SectionId = $('#oldSectionId').val();
	$.ajax({
			type: 'POST',
			url: '<?=$url?>student/oldstudentlist',
			data: 'ClassId='+ClassId+'&SectionId='+SectionId,
			success: function(response){
				alert(response);
				if(response != ''){
					$('#select-from').html(response);
				}
			}
				
	});
}

$(document).ready(function() {
    $('#btn-add').click(function(){
        $('#select-from option:selected').each( function() {
                $('#select-to').append("<option value='"+$(this).val()+"'>"+$(this).text()+"</option>");
            $(this).remove();
        });
    });
    $('#btn-remove').click(function(){
        $('#select-to option:selected').each( function() {
            $('#select-from').append("<option value='"+$(this).val()+"'>"+$(this).text()+"</option>");
            $(this).remove();
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
