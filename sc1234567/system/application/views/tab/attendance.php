<?php
echo ' <div id="tabcontainer" align="center" >';
	echo'<table width="200" border="0" cellpadding="0" cellspacing="0" class = "formtable" style = "margin-top:10px;"  >';
	echo "<tr>";
			echo "<td align='right' width='15%' class = 'datafield' >Class Name<span class = 'mandatory'>*</span></td>";
			echo "<td width='2%' class='spacetd' > </td>";
			echo "<td width='33%' class = 'dataview' >";
			echo '<select name = "ClassId" id = "ClassId" onChange = "show_section();" >
				<option value = "x" >-- Select Class --</option>';
				foreach($classes as $cs){
					echo '<option value = "'.$cs->ClassId.'" >'.$cs->ClassName.'</option>';
				}
			echo'</select>';
			echo'</td>';
	  echo "</tr>";
	  echo "<tr>";
			echo "<td align='right' width='15%' class = 'datafield' >Section Name<span class = 'mandatory'>*</span></td>";
			echo "<td width='2%' class='spacetd' > </td>";
			echo "<td width='33%' class = 'dataview' >";
			echo '<select name = "SectionId" id = "SectionId" >
				  	<option value = "x" >-- Select Section --</option>';
			echo'</select>';
			echo'</td>';
	  echo "</tr>";
	   echo "<tr>";
			echo "<td align='right' width='15%' class = 'datafield' >Session Time<span class = 'mandatory'>*</span></td>";
			echo "<td width='2%' class='spacetd' > </td>";
			echo "<td width='33%' class = 'dataview' >";
			echo '<select name = "SessionId" id = "SessionId"  onChange = "show_studentlist();" >
				  	<option value = "x" >-- Select Session --</option>
					<option value = "1" >Morning</option>
					<option value = "2" >Afternoon</option>';
			echo'</select>';
			echo'</td>';
	  echo "</tr>";
	echo'</table>';
	echo'<div style = "float:left; width:100%; margin-top:10px;" id = "student_list" >';
	
	echo'</div>';
echo'</div>';


?>
<script>
$('#attendance').addClass('current');

function show_section(){
	var ClassId = $('#ClassId').val();
	$.ajax({
		type: 'POST',
		url: '<?=$url?>tab/sectionlist',
		data: 'ClassId='+ClassId,
		success: function(response){			
			if(response != ''){
				$('#SectionId').html(response);	
			}
		}	
	});
}

function show_studentlist(){
	var ClassId = $('#ClassId').val();
	var SectionId = $('#SectionId').val();
	$.ajax({
		type: 'POST',
		url: '<?=$url?>tab/show_student_list',
		data: 'ClassId='+ClassId+'&SectionId='+SectionId,
		success: function(response){
			if(response != ''){
				$('#student_list').html(response);	
			}
		}	
	});
}

function student_attend_fun(n){
	var checkval = $('#attendval'+n).val();	
	if(checkval == '0'){
		$('#attendval'+n).val('');
		$('#attendval'+n).val(1);
		//$('#attendval'+n).val().replace(checkval, 1);
		$('#attendance'+n).addClass('checked');
	}else{
		//$('#attendval'+n).replace(checkval, 0);
		//$('#attendval'+n).val().replace(checkval, 0);
		$('#attendval'+n).val('');
		$('#attendval'+n).val(0);
		$('#attendance'+n).removeClass('checked');
	}	
	
}

function sava_attend_fun(){
	var totalstudent = $('#TotalStudents').val();
	var ClassId = $('#ClassId').val();
	var SectionId = $('#SectionId').val();
	var SessionId = $('#SessionId').val();
	var attendval = Array();
	var RollNo = Array();
	for(var i = 0; i < (totalstudent - 1); i++){
		attendval[i] = $('#attendval'+(i+1)).val();
		RollNo[i] = $('#RollNo'+(i+1)).val();
	}
	var SectionId = $('#SectionId').val();
	$.ajax({
		type: 'POST',
		url: '<?=$url?>tab/save_attendance',
		data: 'attendval='+attendval+'&RollNo='+RollNo+'&ClassId='+ClassId+'&SectionId='+SectionId+'&SessionId='+SessionId,
		success: function(response){
			alert(response);
			if(response != 'error'){
				window.location.href = $.trim(response);
			}
		}	
	});
}
</script>
