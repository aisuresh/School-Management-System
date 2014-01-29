
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
echo "<a href='".$url."attendence/listview/".$this->session->userdata('yearat')."'>";
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
echo "<div id = 'mandatory' ><span align ='right' class = 'mandatory'>*</span> Specipied fileds are mandatory</div>";
echo "<table border='0' cellpadding='0' cellspacing='0' class='formtable'>";

echo "<tr>";
echo "<td align='right' width='15%' class = 'datafield' >Class <span class = 'mandatory'>*</span></td>";
echo "<td width='2%' class='spacetd' > </td>";
echo "<td width='33%' class = 'dataview' >";
echo "<select name = 'ClassId' id = 'ClassId' onChange = 'section_fun();' >";
echo "<option value = 'x'>- - Select Class - -</option>";
foreach($course as $row):
echo "<option value = '".$row->ClassId."' >";
echo $row->ClassName;
echo "</option>";
endforeach;
echo "</select>";
echo "</td></tr>";

echo "<tr>";
echo "<td align='right' width='15%' class = 'datafield' >Section<span class = 'mandatory'>*</span></td>";
echo "<td width='2%' class='spacetd' > </td>";
echo "<td width='33%' class = 'dataview' >";
echo "<select name = 'SectionId' id = 'SectionId' onchange = 'studentlist_fun();' >";
echo "<option value = 'x'>- - Select Section - -</option>";
foreach($sect as $rowa):
echo "<option value = '".$rowa->SectionId."' >";
echo $rowa->SectionName;
echo "</option>";
endforeach;
echo "</select>";
echo "</td></tr>";


echo "<tr>";
echo "<td align='right' width='15%' class = 'datafield' >Student Roll No<span class = 'mandatory'>*</span></td>";
echo "<td width='2%' class='spacetd' > </td>";
echo "<td width='33%' class = 'dataview' >";
echo "<select name = 'StudentId' id = 'StudentId'>";
echo "<option value = 'x'>- - Select RollNo - -</option>";
/*foreach($rollno as $row):
echo "<option value = '".$row->StudentId."' >";
echo $row->StudentRollNo;
echo "</option>";
endforeach;*/
echo "</select>";
echo "</td></tr>";

echo "<tr>";
echo "<td align='right' width='15%' class = 'datafield' >Present Date<span class = 'mandatory'>*</span></td>";
echo "<td width='2%' class='spacetd' > </td>";
echo "<td width='33%' class = 'dataview' >";
echo "<input type='text' name='PresentDate' id='PresentDate' class='datepicker' readonly='readonly' />";
echo"</td>";
echo "</tr>";

echo "<tr>";
echo "<td align='right' width='15%' class = 'datafield' >Session Type<span class = 'mandatory'>*</span></td>";
echo "<td width='2%' class='spacetd' > </td>";
echo "<td width='33%' class = 'dataview' >";
echo "<select name = 'SessionId' id = 'SessionId' >";
echo "<option value = 'x'>- - Select Session - -</option>";
echo "<option value = '1' >Morning</option>";
echo "<option value = '2' >Afternoon</option>";
echo "</select>";
echo "</td>";
echo "</tr>";

echo "<tr>";
echo "<td align='right' width='15%' class = 'datafield' >Attendance<span class = 'mandatory'>*</span></td>";
echo "<td width='2%' class='spacetd' > </td>";
echo "<td width='33%' class = 'dataview' >";
echo "<select name = 'Attendance' id = 'Attendance' >";
echo "<option value = 'x'>- Select Attendance -</option>";
echo "<option value = '1' >Present</option>";
echo "<option value = '0' >Absent</option>";
echo "</select>";
echo "</td>";
echo "</tr>";

echo "</table>";

echo "</div>";
echo "</div>";
?>
<script>
function validation(){
	var ClassId = $('#ClassId').val();
	var SectionId = $('#SectionId').val();
	var StudentId = $('#StudentId').val();
	var PDate = $('#PresentDate').val();
	var SessionId = $('#SessionId').val();
	var Attendance = $('#Attendance').val();
	
	if(ClassId == 'x'){
		$('#message').html('Student Class should not be blank').show().fadeOut('slow').fadeIn('slow');
		$('#ClassId').focus();
		return false;
	}else if(SectionId == 'x'){
		$('#message').html('Student Section should not be blank').show().fadeOut('slow').fadeIn('slow');
		$('#SectionId').focus();
		return false;
	}else if(StudentId == 'x'){
		$('#message').html('Student RollNo should not be blank').show().fadeOut('slow').fadeIn('slow');
		$('#StudentId').focus();
		return false;
	}else if(PDate == ''){
		$('#message').html('Attendance date should not be blank').show().fadeOut('slow').fadeIn('slow');
		$('#PresentDate').focus();
		return false;
	}else if(SessionId == 'x'){
		$('#message').html('Attendence Session should not be blank').show().fadeOut('slow').fadeIn('slow');
		$('#SessionId').focus();
		return false;
	}else if(Attendance == 'x'){
		$('#message').html('Attendence should not be blank').show().fadeOut('slow').fadeIn('slow');
		$('#Attendance').focus();
		return false;
	}else{
		return true;
	}

}
function save_data($e){
 
	var ClassId = $('#ClassId').val();
	var SectionId = $('#SectionId').val();
	var StudentId = $('#StudentId').val();
	var PDate = $('#PresentDate').val();
	var SessionId = $('#SessionId').val();
	var Attendance = $('#Attendance').val();
	
	//alert(RollNo);
	if(validation())
	{
 		$.ajax({
				type: 'POST',
				url: '<?=$url?>attendence/save',
				data: 'ClassId='+ClassId+'&SectionId='+SectionId+'&StudentId='+StudentId+'&PDate='+PDate+'&SessionId='+SessionId+'&Attendance='+  Attendance,
				success: function(response){ 
				        if(response == 1){
			            if($e == 1){
								alert('Insert Successfully');
							}else{
								alert('Insert Successfully');
							}	
						}
						else{
							alert('Insert Not Successfully');
						}
					}
					
		});
	}	
}

function section_fun(){
	var ClassId = $('#ClassId').val();
 		$.ajax({
				type: 'POST',
				url: '<?=$url?>attendence/section',
				data: 'ClassId='+ClassId,
				success: function(response){
						if(response != ''){
							$('#SectionId').html(response);
						}
					}	
		});
}
function studentlist_fun(){
	var ClassId = $('#ClassId').val();
	var SectionId = $('#SectionId').val();
	
 		$.ajax({
				type: 'POST',
				url: '<?=$url?>attendence/studentlist',
				data: 'ClassId='+ClassId+'&SectionId='+SectionId,
				success: function(response){
				//alert(response);
						if(response != ''){
							$('#StudentId').html(response);
						}
					}	
		});
}
$(function() {
 $( ".datepicker" ).datepicker({dateFormat: 'dd-mm-yy' });
});		
</script>
