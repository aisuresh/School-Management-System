<?php
echo "<div class='container'>";
echo "<div class='content_header'>";

echo"<div class = 'showbtn' >";
echo '<a href = "#" onclick = "Rollno_show();" >RollNo</a>';
echo "</div>";


echo "<div class = 'showbox' >";
echo "<select name = 'Medium' id = 'Medium' >";
echo "<option value = 'x'>- - Select Medium - -</option>";
echo "<option value = '1'>Telugu</option>";
echo "<option value = '2'>English</option>";
echo "</select>";
echo "</div>";

echo "<div class = 'showbox' >";
echo "<select name = 'SectionId' id = 'SectionId'  >";
echo "<option value = 'x'>- - Section - -</option>";
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


foreach($studentclass as $row){
echo "<input type='hidden' name = 'StudentClassId' id = 'StudentClassId' value = '".$row->StudentClassId."'>";
}
echo "</div>";
echo "</div>";
?>
<script>

function get_section(){
	var ClassId = $('#Class').val();
	$.ajax({
			type: 'POST',
			url: '<?=$url?>student/section',
			data: 'ClassId='+ClassId,
			success: function(response){
				if(response != ''){
					$('#SectionId').html(response);
				}
			}
				
	});
}
function Rollno_show(){
	var ClassId = $('#Class').val();
	var SectionId = $('#SectionId').val();
	var Medium = $('#Medium').val();
	var StudentClassId = $('#StudentClassId').val();
	alert(StudentClassId);
	$.ajax({
		  type: 'POST',
		  
		  url: '<?=$url?>autogenerateid/updaterollno',
		  
		  data:'ClassId='+ClassId+'&SectionId='+SectionId+'&Medium='+Medium,
		  
		  success: function(response){ 
		if(response == 1){
			alert('Update Successfully');
			}
		  }
			 
	});
}
</script>
<script src="<?php echo $url ?>js/template.js"></script>
