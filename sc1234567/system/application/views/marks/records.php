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

echo"<div class = 'showbtn' >";
echo '<a href = "#" onclick = "show_records();" >Go</a>';
echo "</div>";

echo"<div class = 'showbox' >";
echo "<select name = 'RollNo' id = 'RollNo' >";
echo "<option value = 'x'>- - RollNo - -</option>";
if(isset($rollno)){
foreach($rollno as $row){
	echo "<option value = '".$row->RollNo."'>".$row->StudentName."</option>";
}
}
echo "</select>";
echo "</div>";

echo "<div class = 'showbox' >";
echo "<select name = 'Year' id = 'Year' onchange = 'get_studentlist();' >";
echo "<option value = 'x'>- - Year - -</option>";
foreach( array_reverse($this->session->userdata('years')) as $ys){
	if($this->session->userdata('yearhrg') == $ys->AcademicYear){
		echo "<option value = '".$ys->AcademicYear."' selected = 'selected'>".$ys->AcademicYear."</option>";
	}else{
		echo "<option value = '".$ys->AcademicYear."'>".$ys->AcademicYear."</option>";
	}	
}
echo "</select>";
echo "</div>";

echo "<div class = 'showbox' >";
echo "<select name = 'Class' id = 'Class' >";
echo "<option value = 'x'>- - Class - -</option>";
foreach($course as $row){
	echo "<option value = '".$row->ClassId."'>".$row->ClassName."</option>";
}
echo "</select>";
echo "</div>";



echo "</div>";
echo "</div>";
/*---------------     content        ---------------------*/
echo "<div align = 'center' class='content'>";
//echo "<table border='0' cellpadding='0' cellspacing = '0' class='formtable'>";

echo "</div>";
echo "</div>";
?>
<script>

function get_studentlist(){
	var Class = $('#Class').val();
	var Year = $('#Year').val();
	$.ajax({
			type: 'POST',
			url: '<?=$url?>hostelrecord/hostelstudentlist',
			data: 'Class='+Class+'&Year='+Year,
			success: function(response){
				if(response != ''){
					$('#RollNo').html(response);
				}
			}
				
	});
}

function show_records(){
	var RollNo = $('#RollNo').val();
	var Year = $('#Year').val();
	$.ajax({
			type: 'POST',
			url: '<?=$url?>hostelrecord/records/show',
			data: 'RollNo='+RollNo+'&Year='+Year,
			success: function(response){
				if(response != ''){
					$('.content').html(response);
				}
			}
				
	});
}		
</script>
