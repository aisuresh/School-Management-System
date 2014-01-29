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
echo "<a href='".$url."schoolfee/listview/".$this->session->userdata('yearsf')."' >";
echo "<span><img src='".$url."images/cancel.png' border='0' /></span>";
echo "<span> Cancel </span>";
echo "</a>";
echo "</div>";

echo"<div class = 'showbtn' >";
echo '<a href = "#" onclick = "schoolfee_show();" >Go</a>';
echo "</div>";

echo"<div class = 'showbox' >";
echo "<select name = 'StudentId' id = 'StudentId' >";
echo "<option value = 'x'>- - RollNo - -</option>";
//var_dump($rollno);
if(isset($rollno)){
foreach($rollno as $row){
	echo "<option value = '".$row-StudentId."'>".$row->RollNo."</option>";
}
}
echo "</select>";
echo "</div>";


echo "<div class = 'showbox' >";
echo "<select name = 'SectionId' id = 'SectionId' onchange = 'get_studentlist();' >";
echo "<option value = 'x'>- - Section - -</option>";
foreach($Section as $row){
	echo "<option value = '".$row->SectionId."'>".$row->SectionName."</option>";
}
echo "</select>";
echo "</div>";


echo "<div class = 'showbox' >";
echo "<select name = 'Class' id = 'Class' onchange = 'get_section();' >";
echo "<option value = 'x'>- - Class - -</option>";
foreach($course as $row){
	echo "<option value = '".$row->ClassId."'>".$row->ClassName."</option>";
}
echo "</select>";
echo "</div>";

echo "<div class = 'showbox' >";
echo "<select name = 'Year' id = 'Year' >";
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

echo "</div>";
echo "</div>";
/*---------------     content        ---------------------*/
echo "<div align = 'center' class='content'>";

echo '<div id="schoolfeetableshow" style="display:none; margin-top:10px;">';

echo '</div>';
//------------------------------------------------------------------------------------
echo "</div>";
echo "</div>";
?>
<script>
function edit_data(){
var rollid = $('input[name=SchoolFeeId]').val();
 window.location='<?=$url?>schoolfee/edit/'+rollid;
}		

function get_section(){
	var ClassId = $('#Class').val();
	$.ajax({
			type: 'POST',
			url: '<?=$url?>schoolfee/section',
			data: 'ClassId='+ClassId,
			success: function(response){
				if(response != ''){
					$('#SectionId').html(response);
				}
			}
				
	});
}
function get_studentlist(){
	var ClassId = $('#Class').val();
	var SectionId = $('#SectionId').val();
	var Year = $('#Year').val();
	$.ajax({
			type: 'POST',
			url: '<?=$url?>schoolfee/studentlist',
			data: 'ClassId='+ClassId+'&Year='+Year+'&SectionId='+SectionId,
			success: function(response){
				if(response != ''){
					$('#StudentId').html(response);
				}
			}
				
	});
}

function schoolfee_show(){
	var ClassId = $('#Class').val();
	var SectionId = $('#SectionId').val();
	var StudentId = $('#StudentId').val();
	var Year = $('#Year').val();
	//alert(SectionId);
	$.ajax({
		  type: 'POST',
		  
		  url: '<?=$url?>schoolfee/getSchoolfees',
		  
		  data:'ClassId='+ClassId+'&SectionId='+SectionId+'&StudentId='+StudentId+'&Year='+Year,
		  
		  success: function(response){ 
		  //alert(response);
		  if(response != ''){
			$('#schoolfeetableshow').show().html(response);
			}
		  }
			 
	});
}
//--------------------------------------------------------------
</script>
