
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
echo "<a onclick='update_data(2);'>";
echo "<span><img src='".$url."images/apply.png' border='0' /></span>";
echo "<span>Apply</span>";
echo "</a>";
echo "</div>";

echo "<div class='events'>";
echo "<a onclick='update_data(1);'>";
echo "<span><img src='".$url."images/save.png' border='0' /></span>";
echo "<span>Save</span>";
echo "</a>";
echo "</div>";

echo "</div>";
echo "</div>";
/*---------------     content        ---------------------*/
echo "<div align='center' class='content'>";
echo "<span class = 'mandatory'>*</span> Specipied fileds are mandatory";
echo "<table border='0' cellpadding='0' cellspacing = '0' class='formtable'>";
//var_dump($result);
foreach($result as $row):
echo "<input type='hidden' name = 'AttendenceId' id = 'AttendenceId' value = '".$row->AttendenceId."' />";

echo "<tr>";
echo "<td align='right' width='15%' class = 'datafield' >Class <span class = 'mandatory'>*</span></td>";
echo "<td width='2%' class='spacetd' > </td>";
echo "<td width='33%' class = 'dataview' >";
echo "<select name = 'ClassId' id = 'ClassId' onChange = 'section_fun();' disabled >";
echo "<option value = 'x'>- - Select Class - -</option>";
foreach($course as $rowa):
	if($rowa->ClassId == $row->StudentClass){
		echo "<option value = '".$rowa->ClassId."' selected >".$rowa->ClassName."</option>";
	}else{
		echo "<option value = '".$rowa->ClassId."' >".$rowa->ClassName."</option>";
	}	
endforeach;
echo "</select>";
echo "</td></tr>";

echo "<tr>";
echo "<td align='right' width='15%' class = 'datafield' >Section<span class = 'mandatory'>*</span></td>";
echo "<td width='2%' class='spacetd' > </td>";
echo "<td width='33%' class = 'dataview' >";
echo "<select name = 'SectionId' id = 'SectionId' onchange = 'studentlist_fun();' disabled >";
echo "<option value = 'x'>- - Select Section - -</option>";
foreach($section as $sc){
	if($row->SectionId == $sc->SectionId){
		echo "<option value = '".$sc->SectionId."' selected>";
		echo $sc->SectionName;
		echo "</option>";
	}else{
		echo "<option value = '".$sc->SectionId."' >";
		echo $sc->SectionName;
		echo "</option>";
	}
}
echo "</select>";
echo "</td></tr>";


echo "<tr>";
echo "<td align='right' width='15%' class = 'datafield' >Student Roll No<span class = 'mandatory'>*</span></td>";
echo "<td width='2%' class='spacetd' > </td>";
echo "<td width='33%' class = 'dataview' >";
echo "<select name = 'StudentId' id = 'StudentId'  disabled>";
echo "<option value = 'x'>- - Select RollNo - -</option>";
foreach($rollno as $rn){
	if($row->RollNo == $rn->RollNo){
		echo "<option value = '".$rn->StudentId."' selected >";
		echo $rn->RollNo;
		echo "</option>";
	}else{
		echo "<option value = '".$rn->StudentId."' >";
		echo $rn->RollNo;
		echo "</option>";
	}
}
echo "</select>";
echo "</td></tr>";

echo "<tr>";
echo "<td align='right' width='15%' class = 'datafield' >Present Date<span class = 'mandatory'>*</span></td>";
echo "<td width='2%' class='spacetd' > </td>";
echo "<td width='33%' class = 'dataview' >";
$AttendDate=date("d-m-Y", strtotime($row->AttendDate));									
echo "<input type='text' name='AttendDate' id='AttendDate' class='datepicker' readonly='readonly' value = '".$AttendDate."' />";
echo"</td>";
echo "</tr>";

echo "<tr>";
echo "<td align='right' width='15%' class = 'datafield' >Session Type<span class = 'mandatory'>*</span></td>";
echo "<td width='2%' class='spacetd' > </td>";
echo "<td width='33%' class = 'dataview' >";
echo "<select name = 'SessionId' id = 'SessionId' >";
echo "<option value = 'x'>- - Select Session - -</option>";
if($row->SessionId == 1){
	echo "<option value = '1' selected >Morning</option>";
	echo "<option value = '2' >Afternoon</option>";
}else{
	echo "<option value = '1' >Morning</option>";
	echo "<option value = '2' selected >Afternoon</option>";

}

echo "</select>";
echo "</td>";
echo "</tr>";

echo "<tr>";
echo "<td align='right' width='15%' class = 'datafield' >Attendance<span class = 'mandatory'>*</span></td>";
echo "<td width='2%' class='spacetd' > </td>";
echo "<td width='33%' class = 'dataview' >";
echo "<select name = 'Attendance' id = 'Attendance' >";
echo "<option value = 'x'>- Select Attendance -</option>";
if($row->Attendance == 1){
	echo "<option value = '1' selected >Present</option>";
	echo "<option value = '0' >Absent</option>";
}else{
	echo "<option value = '1' >Present</option>";
	echo "<option value = '0' selected >Absent</option>";
}	
echo "</select>";
echo "</td>";
echo "</tr>";

endforeach;
echo "</table>";

echo "</div>";
echo "</div>";
?>
<script>

function validation(){
	var CourseId = $('#CourseId').val();
	var CourseYearId = $('#CourseYearId').val();
	var GroupId = $('#GroupId').val();
	var SectionId = $('#SectionId').val();
	var StudentId = $('#StudentId').val();
	var PDate = $('#AttendDate').val();
	var SessionId = $('#SessionId').val();
	var Attendance = $('#Attendance').val();
	
	if(CourseId == 'x'){
		$('#message').html('Student Course should not be blank').show().fadeOut('slow').fadeIn('slow');
		$('#CourseId').focus();
		return false;
	}else if(CourseYearId == 'x'){
		$('#message').html('Student Course year should not be blank').show().fadeOut('slow').fadeIn('slow');
		$('#CourseYearId').focus();
		return false;
	}else if(GroupId == 'x'){
		$('#message').html('Student group should not be blank').show().fadeOut('slow').fadeIn('slow');
		$('#GroupId').focus();
		return false;
	}else if(SectionId == 'x'){
		$('#message').html('Student section should not be blank').show().fadeOut('slow').fadeIn('slow');
		$('#SectionId').focus();
		return false;
	}else if(StudentId == 'x'){
		$('#message').html('Student roll no should not be blank').show().fadeOut('slow').fadeIn('slow');
		$('#StudentId').focus();
		return false;
	}else if(PDate == ''){
		$('#message').html('Attendance date should not be blank').show().fadeOut('slow').fadeIn('slow');
		$('#AttendDate').focus();
		return false;
	}else if(SessionId == ''){
		$('#message').html('Attendence Session should not be blank').show().fadeOut('slow').fadeIn('slow');
		$('#SessionId').focus();
		return false;
	}else if(Attendance == ''){
		$('#message').html('Attendence should not be blank').show().fadeOut('slow').fadeIn('slow');
		$('#Attendance').focus();
		return false;
	}else{
		return true;
	}

}

function update_data($e){
    var AttendenceId = $('#AttendenceId').val();
	var ClassId = $('#ClassId').val();
    var SectionId = $('#SectionId').val();
 	var StudentId = $('#StudentId').val();
	var PDate = $('#AttendDate').val();
	var SessionId = $('#SessionId').val();
	var Attendance = $('#Attendance').val();
 	var AttendenceId = $('#AttendenceId').val();
	alert(PDate);
	 $.ajax({
			type: 'POST',
			url: '<?=$url?>attendence/update',
			data: 'AttendenceId='+AttendenceId+'&StudentId='+StudentId+'&PDate='+PDate+'&SessionId='+SessionId+'&Attendance='+Attendance+'&AttendenceId='+AttendenceId,
			success: function(response){
					if(response == 1){
						if($e == 1){
							window.location.href='<?=$url?>attendence/listview/<?=$this->session->userdata('yearat')?>';
						}else{
							alert('Update Successfully');
						}
					}else{
						alert('Update Not Successfully');
					}
				}
				
	});
}

function courseyear_fun(){
	var ClassId = $('#StudentClass').val();
	$.ajax({
		type: 'POST',
		url: '<?=$url?>student/courseyear',
		data: 'ClassId='+ClassId,
		success: function(response){
			if(response != ''){
				$('#CourseYearId').html(response);
			}
		}	
	});
}		

function group_fun(){
	var CourseId = $('#StudentClass').val();
	var YearId = $('#CourseYearId').val();
	$.ajax({
		type: 'POST',
		url: '<?=$url?>student/group',
		data: 'CourseId='+CourseId+'&YearId='+YearId,
		success: function(response){
			if(response != ''){
				$('#GroupId').html(response);
			}
		}	
	});
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

</script>
