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
foreach($result as $row):
echo "<tr>";
echo "<td align='right' width='15%' class = 'datafield' >Class <span class = 'mandatory'>*</span></td>";
echo "<td width='2%' class='spacetd' > </td>";
echo "<td width='33%' class = 'dataview' >";
echo "<select name = 'ClassId' id = 'ClassId' onChange = 'section_fun();' >";
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
echo "<select name = 'SectionId' id = 'SectionId' onchange = 'studentlist_fun();' >";
echo "<option value = 'x'>- - Select Section - -</option>";
foreach($section as $rowa):
	if($rowa->SectionId == $row->SectionId){
		echo "<option value = '".$rowa->SectionId."' selected >".$rowa->SectionName."</option>";
	}else{
		echo "<option value = '".$rowa->SectionId."' >".$rowa->SectionName."</option>";
	}	
endforeach;
echo "</select>";
echo "</td></tr>";


echo "<tr>";
echo "<td align='right' width='15%' class = 'datafield' >Student Roll No<span class = 'mandatory'>*</span></td>";
echo "<td width='2%' class='spacetd' > </td>";
echo "<td width='33%' class = 'dataview' >";
echo "<select name = 'RollNo' id = 'RollNo' >";
echo "<option value = 'x'>- - Select RollNo - -</option>";
echo "<option value = '".$row->RollNo."' selected = 'selected'>". $row->RollNo."</option>";
echo "</select>";
echo "</td></tr>";

echo "<tr>";
echo "<td align='right' width='15%' class = 'datafield' >Month Name<span class = 'mandatory'>*</span></td>";
echo "<td width='2%' class='spacetd' > </td>";
echo "<td width='33%' class = 'dataview' >";
echo "<select name = 'MonthName' id = 'MonthName' >";
echo "<option value = 'x'>- Select Month -</option>";
foreach($months as $mn){
	if($row->MonthId == $mn->MonthNo){
		echo "<option value = '".$mn->MonthNo."' selected>".$mn->MonthName."</option>";
	}else{
		echo "<option value = '".$mn->MonthNo."' >".$mn->MonthName."</option>";
	}	
}
echo "</select>";
echo "</td>";
echo "</tr>";


echo "<tr>";
echo "<td align='right' width='15%' class = 'datafield' >Total Working Days<span class = 'mandatory'>*</span></td>";
echo "<td width='2%' class='spacetd' > </td>";
echo "<td width='33%' class = 'dataview' ><input type = 'text' name = 'TotalDays' id = 'TotalDays' value='" . $row->TotalDays . "' onKeyUp='JsCheckNumber(this)' /></td>";
echo "</tr>";

echo "<tr>";
echo "<td align='right' width='15%' class = 'datafield' >Morning Attendance<span class = 'mandatory'>*</span></td>";
echo "<td width='2%' class='spacetd' > </td>";
echo "<td width='33%' class = 'dataview' ><input type = 'text' name = 'Morning' id = 'Morning' value = '". $row->Morning."' onKeyUp='JsCheckNumber(this)' /></td>";
echo "</tr>";

echo "<tr>";
echo "<td align='right' width='15%' class = 'datafield' >Afternoon Attendance<span class = 'mandatory'>*</span></td>";
echo "<td width='2%' class='spacetd' > </td>";
echo "<td width='33%' class = 'dataview' ><input type = 'text' name = 'Afternoon' id = 'Afternoon' value = '". $row->Afternoon."' onKeyUp='JsCheckNumber(this)' /></td>";
echo "</tr>";

endforeach;
echo "</table>";

echo "</div>";
echo "</div>";
?>
<script>

function validation(){
	var ClassId = $('#ClassId').val();
	var SectionId = $('#SectionId').val();
	var RollNo = $('#RollNo').val();
	var MonthName = $('#MonthName').val();
	var TotalDays = $('#TotalDays').val();
	var Morning = $('#Morning').val();
	var Afternoon = $('#Afternoon').val();
	
	if(ClassId == 'x'){
		$('#message').html('Student Class should not be blank').show().fadeOut('slow').fadeIn('slow');
		$('#ClassId').focus();
		return false;
	}else if(SectionId == 'x'){
		$('#message').html('Student Section should not be blank').show().fadeOut('slow').fadeIn('slow');
		$('#SectionId').focus();
		return false;
	}else if(RollNo == 'x'){
		$('#message').html('Student RollNo should not be blank').show().fadeOut('slow').fadeIn('slow');
		$('#RollNo').focus();
		return false;
	}else if(MonthName == 'x'){
		$('#message').html('Month should not be blank').show().fadeOut('slow').fadeIn('slow');
		$('#MonthName').focus();
		return false;
	}else if(TotalDays == 'x'){
		$('#message').html('Total working Days should not be blank').show().fadeOut('slow').fadeIn('slow');
		$('#TotalDays').focus();
		return false;
	}else if(Morning == ''){
		$('#message').html('Morning attendence days should not be blank').show().fadeOut('slow').fadeIn('slow');
		$('#Morning').focus();
		return false;
	}else if(Afternoon == ''){
		$('#message').html('Afternoon  attendence days should not be blank').show().fadeOut('slow').fadeIn('slow');
		$('#Afternoon').focus();
		return false;
	}else{
		return true;
	}

}

function update_data($e){

 var RollNo = $('#RollNo').val();
 var MonthName = $('#MonthName').val();
 var TotalDays = $('#TotalDays').val();
 var Morning = $('#Morning').val();
 var Afternoon = $('#Afternoon').val();
 
	 $.ajax({
			type: 'POST',
			url: '<?=$url?>attendence/update',
			data: 'RollNo='+RollNo+'&MonthName='+MonthName+'&TotalDays='+TotalDays+'&Morning='+Morning+'&Afternoon='+Afternoon,
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
						if(response != ''){
							$('#RollNo').html(response);
						}
					}	
		});
}						


</script>
