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
echo "<a href = '#'  onClick = 'show_records();' >Go</a>";
echo "</div>";
echo"<div class = 'showbox' >";
echo "<select name = 'RollNo' id = 'RollNo' >";
echo "<option value = 'x'>- - RollNo - -</option>";
if(isset($rollno)){
foreach($rollno as $row){
	echo "<option value = '".$row->StudentId."'>".$row->RollNo."</option>";
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
echo "<select name = 'Class' id = 'Class'  onchange = 'get_studentlist();'>";
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

echo "</div>";
echo "</div>";
$years = $this->Adminmodel->show_rows($table = 'academicyear', $where = array());
		$this->session->set_userdata('years', $years);
		$this->pyear  = $this->uri->segment(3);
$table = 'hostelrecord';
 $tableArray = array(
			array('TableName' => 'studentclass', 'CompairField' => $table.'.StudentId=studentclass.StudentId')
		);
$where = array(
			array('condition' => $table.'.Year', 'value' => $this->pyear)
		);
	
$StudentId= $this->Adminmodel->fetch_row($table, $tableArray, $where);
		
//echo "<input type = 'hidden' name = 'StudentId' id='StudentId' value = '". $StudentId ."'/> </th>";


?>
<script>

function get_studentlist(){
	var Class = $('#Class').val();
	var Year = $('#Year').val();
	$.ajax({
			type: 'POST',
			url: '<?=$url?>hostelrecord/studentlist',
			data: 'Class='+Class+'&Year='+Year,
			success: function(response){
				//alert(response);
				if(response != ''){
					$('#RollNo').html(response);
				}
			}
				
	});
}

function show_records(){
    
	var StudentId = $('#RollNo').val();
	var Year = $('#Year').val();
	//alert(RollNo);
	//alert(Year);
	//alert(StudentId);
	$.ajax({
			type: 'POST',
			url: '<?=$url?>hostelrecord/records/show',
			data: 'StudentId='+StudentId+'&Year='+Year,
			success: function(response){
				//alert(response);
				if(response != ''){
					$('.content').html(response);
				}
			}
				
	});
}		
</script>
