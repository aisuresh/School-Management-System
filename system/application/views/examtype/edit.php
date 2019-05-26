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
echo "<a href='".$url."examtype/listview'>";
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
echo "<div id ='message'></div>";
echo "<div id ='message1'></div>";
echo "<span class = 'mandatory'>*</span> Specified fileds are mandatory";
foreach($result as $row){
echo "<table border='0' cellpadding='0' cellspacing = '0' class='formtable'>";
echo "<input type='hidden' name = 'ExamId' id = 'ExamId' value = '".$row->ExamId."'";

echo "<tr>";
echo "<td align='right' width='15%' class = 'datafield' >Exam Type<span class = 'mandatory'>*</span></td>";
echo "<td width='2%' class='spacetd' > </td>";
echo "<td width='33%' class = 'dataview' ><input type = 'text' name = 'ExamType' id = 'ExamType' value='".$row->ExamType ."' disabled/> </td>";
echo "</tr>";

echo "<tr>";
echo "<td align='right' width='15%' class = 'datafield' >Exam Marks<span class = 'mandatory'>*</span></td>";
echo "<td width='2%' class='spacetd' > </td>";
echo "<td width='33%' class = 'dataview' ><input type = 'text' name = 'ExamMarks' id = 'ExamMarks' value = '".$row->ExamMarks."' onKeyUp='JsCheckNumber(this)' /> </td>";
echo "</tr>";

echo "<tr>";
echo "<td align='right' width='15%' class = 'datafield' >Exam Marks<span class = 'mandatory'>*</span></td>";
echo "<td width='2%' class='spacetd' > </td>";
echo "<td width='33%' class = 'dataview' ><input type = 'text' name = 'PassMarks' id = 'PassMarks' value = '".$row->PassMarks."' onKeyUp='JsCheckNumber(this)' /> </td>";
echo "</tr>";

echo "<tr>";
echo "<td align='right' width='15%' class = 'datafield' >Description</td>";
echo "<td width='2%' class='spacetd' > </td>";
echo "<td width='33%' class = 'dataview' ><input type = 'text' name = 'ExamDes' id = 'ExamDes' value='".$row->ExamDes."'/></td>";
echo "</tr>";
}
echo "</table>";

echo "</div>";
echo "</div>";
?>
<script>

function validation(){
 	var ExamType = $('#ExamType').val();
 	var ExamMarks = $('#ExamMarks').val();
	var PassMarks = $('#PassMarks').val();
	if(ExamType ==''){
		$('#message').html('Exam Type should not be blank.').show().fadeOut('slow').fadeIn('slow');
		$('#ExamType').focus();
		return false;
	}else if(ExamMarks == ''){
		$('#message').html('Exam Marks should not be blank.').show().fadeOut('slow').fadeIn('slow');
		$('#ExamMarks').focus();
		return false;
	}else if(PassMarks == ''){
		$('#message').html('Pass Marks should not be blank.').show().fadeOut('slow').fadeIn('slow');
		$('#PassMarks').focus();
		return false;
	}else{
		return true;
	}
}


function update_data($e){

 var ExamId = $('#ExamId').val();
 var ExamType = $('#ExamType').val();
 var ExamMarks = $('#ExamMarks').val();
 var PassMarks = $('#PassMarks').val();
 var ExamDes = $('#ExamDes').val();
 
 	if(validation()){
 		$.ajax({
			type: 'POST',
			url: '<?=$url?>examtype/update',
			data: 'ExamId='+ExamId+'&ExamType='+ExamType+'&ExamMarks='+ExamMarks+'&PassMarks='+PassMarks+'&ExamDes='+ExamDes,
			success: function(response){
			        //alert(response);					
					if(response == 1){
						if($e == 1){
							window.location.href='<?=$url?>examtype/listview';
						}else{
							alert('Update Successfully');
						}
					}else if(response == 2){
						alert('Record already exists!.');
					}else{
						alert('Update Not Successfully');
					}
			}
		});
	}
}

</script>
