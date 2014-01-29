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
echo "<a href='".$url."marks/listview/".$this->session->userdata('yearmx')."'>";
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

/*foreach($result as $row):
echo "<input type='hidden' name = 'MarksId' id = 'MarksId' value = '".$row->MarksId."'";*/
echo "<tr>";
echo "<td align='right' width='15%' class = 'datafield' >Class <span class = 'mandatory'>*</span></td>";
echo "<td width='2%' class='spacetd' > </td>";
echo "<td width='33%' class = 'dataview' >";
echo "<select name = 'ClassId' id = 'ClassId' onChange = 'section_fun();' >";
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
echo "<td width='33%' class = 'dataview' >";
echo "<select name = 'SectionId' id = 'SectionId' onChange = 'studentlist_fun();' >";
echo "<option value = 'x'>- - Select Section - -</option>";
foreach($sect as $rowa1):
echo "<option value = '".$rowa1->SectionId."' >";
echo $rowa1->SectionName;
echo "</option>";
endforeach;
echo "</select>";
echo "</td></tr>";


echo "<tr>";
echo "<td align='right' width='15%' class = 'datafield' >Student Roll No<span class = 'mandatory'>*</span></td>";
echo "<td width='2%' class='spacetd' > </td>";
echo "<td width='33%' class = 'dataview' >";
echo "<select name = 'RollNo' id = 'RollNo' onChange = 'get_subjects_fun();'>";
echo "<option value = 'x'>- - Select RollNo - -</option>";
echo "</select>";
echo "</td></tr>";

echo "<tr>";
echo "<td align='right' width='15%' class = 'datafield' >Exam Type<span class = 'mandatory'>*</span></td>";
echo "<td width='2%' class='spacetd' > </td>";
echo "<td width='33%' class = 'dataview' >";
echo "<select name = 'ExamTypeId' id = 'ExamTypeId' onchange='totalmarks();'>";
echo "<option value = 'x'>- - Select Exam - -</option>";
foreach($examtype as $rowb):
echo "<option value = '".$rowb->ExamId."' >";
echo $rowb->ExamType;
echo "</option>";
endforeach;
echo "</select>";
echo "</td></tr>";

echo "<tr>";
echo "<td align='right' width='15%' class = 'datafield' >Total Marks<span class = 'mandatory'>*</span></td>";
echo "<td width='2%' class='spacetd' > </td>";
echo "<td width='33%' class = 'dataview' ><input type = 'text' name = 'TotalMarks' id = 'TotalMarks' readonly='readonly' /> </td>";
echo "</tr>";

echo "<tr>";
echo "<td align='right' width='15%' class = 'datafield' >Subject Name<span class = 'mandatory'>*</span></td>";
echo "<td width='2%' class='spacetd' > </td>";
echo "<td width='33%' class = 'dataview' >";
echo "<select name = 'SubjectId' id = 'SubjectId' onchange = 'subject_fun();'>";                    
echo "<option value = 'x'>- - Select Subject - -</option>";
foreach($subject as $rowc):
	if($row->SubjectId == $rowc->SubjectId){
		echo "<option value = '".$rowc->SubjectId."' selected = 'selected' >";
		echo $rowc->SubjectName;
		echo "</option>";
	}else{
		echo "<option value = '".$rowc->SubjectId."' >";
		echo $rowc->SubjectName;
		echo "</option>";
	}
endforeach;
echo "</select>";
echo "</td></tr>";

echo "<tr>";
echo "<td align='right' width='15%' class = 'datafield' >Marks<span class = 'mandatory'>*</span></td>";
echo "<td width='2%' class='spacetd' > </td>";
echo "<td width='33%' class = 'dataview' ><input type = 'text' name = 'Marks' id = 'Marks' onKeyUp='JsCheckNumber(this)' /> </td>";
echo "</tr>";


echo "<tr>";
echo "<td align='right' width='15%' class = 'datafield' >Description</td>";
echo "<td width='2%' class='spacetd' > </td>";
echo "<td width='33%' class = 'dataview' ><input type = 'text' name = 'MarksDes' id = 'MarksDes' /></td>";
echo "</tr>";
//endforeach;
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

     
	 var RollNo = $('#RollNo').val();
	 var ExamId = $('#ExamTypeId').val();
	 var TotalMarks = $('#TotalMarks').val();
	 var SubjectId =$('#SubjectId').val();
	 var Marks = $('#Marks').val();
	 var MarksDes = $('#MarksDes').val();
	 
	  if(RollNo =='x'){
		$('#message').html('Roll No should not be blank').show().fadeOut('slow').fadeIn('slow');
		$('#RollNo').focus();
		return false;
	}else if(ExamId == 'x'){
		$('#message').html('Exam Type should not be blank').show().fadeOut('slow').fadeIn('slow');
		$('#ExamId').focus();
		return false;
	}else if(TotalMarks == ''){
		$('#message').html('Total Marks should not be blank').show().fadeOut('slow').fadeIn('slow');
		$('#TotalMarks').focus();
		return false;
	}else if(SubjectId == 'x'){
		$('#message').html('Subject should not be blank').show().fadeOut('slow').fadeIn('slow');
		$('#SubjectId').focus();
		return false;
	}else if(Marks == ''){
		$('#message').html('Marks should not be blank').show().fadeOut('slow').fadeIn('slow');
		$('#Marks').focus();
		return false;
	}else{
		return true;
	}
}
function save_data($e){
      
	 var RollNo = $('#RollNo').val();
	 var ExamId = $('#ExamTypeId').val();
	 var TotalMarks = $('#TotalMarks').val();
	 var SubjectId =$('#SubjectId').val();
	 var Marks = $('#Marks').val();
	 var MarksDes = $('#MarksDes').val();
	 if(validation()){
 		$.ajax({
			type: 'POST',
			url: '<?=$url?>marks/save',
			data: 'RollNo='+RollNo+'&ExamId='+ExamId+'&TotalMarks='+TotalMarks+'&SubjectId='+SubjectId+'&Marks='+Marks+'&MarksDes='+MarksDes,
			success: function(response){
			alert(response);			
					if(response == 1){
						if($e == 1){
							window.location.href='<?=$url?>marks/listview/<?=$this->session->userdata('yearmx')?>';
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
function get_subjects_fun(){
	var Class = $('#ClassId').val();
 		$.ajax({
			type: 'POST',
			url: '<?=$url?>marks/subjectlist',
			data: 'Class='+Class,
			success: function(response){
				if(response != ''){
					$('#ClassId').html(response);
				}
			}	
		});
}
function totalmarks(){
	 var ExamTypeId = $('#ExamTypeId').val();
 	 $.ajax({
			type: 'POST',
			url: '<?=$url?>marks/examtype',
			data: 'ExamTypeId='+ExamTypeId,
			success: function(response){
					if(response != ''){
						var totalmarks = $('#TotalMarks').val();
						$('#TotalMarks').val(totalmarks.replace(totalmarks, response ));
					}else{
						alert('Please set exam marks');
					}
			}
					
	 });
}	

function section_fun(){
	var Class = $('#ClassId').val();
 		$.ajax({
				type: 'POST',
				url: '<?=$url?>marks/section',
				data: 'Class='+Class,
				success: function(response){
				         alert(response);
						if(response != ''){
							$('#SectionId').html(response);
						}
					}	
		});
}
function studentlist_fun(){
	var Class = $('#ClassId').val();
	var SectionId = $('#SectionId').val();
 		$.ajax({
				type: 'POST',
				url: '<?=$url?>marks/studentlist',
				data: 'Class='+Class+'&SectionId='+SectionId,
				success: function(response){
						if(response != ''){
							$('#RollNo').html(response);
						}
					}	
		});
}	
function subject_fun(){
	var Class = $('#ClassId').val();
	var SubjectId = $('#SubjectId').val();
 		$.ajax({
				type: 'POST',
				url: '<?=$url?>marks/subjectlist',
				data: 'Class='+Class+'$SectionId='+SectionId,
				success: function(response){
						if(response != ''){
							$('#ClassId').html(response);
						}
					}	
		});
}											
</script>
