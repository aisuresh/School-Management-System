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
echo "<a href='".$url."subject/listview'>";
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
echo "<table border='0' cellpadding='0' cellspacing = '0' class='formtable'>";
foreach($result as $row):
echo "<input type='hidden' name = 'SubjectId' id = 'SubjectId' value = '".$row->SubjectId."'";

echo "<tr>";
echo "<td align='right' width='15%' class = 'datafield' >Subject Name<span class = 'mandatory'>*</span></td>";
echo "<td width='2%' class='spacetd' > </td>";
echo "<td width='33%' class = 'dataview' ><input type = 'text' name = 'SubjectName' id = 'SubjectName' value='".$row->SubjectName ."' onKeyUp='JsCheckChar(this)' disabled/> </td>";
echo "</tr>";

echo "<tr>";
echo "<td align='right' width='15%' class = 'datafield' >Description</td>";
echo "<td width='2%' class='spacetd' > </td>";
echo "<td width='33%' class = 'dataview' ><input type = 'text' name = 'SubjectDes' id = 'SubjectDes' value='".$row->SubjectDes."'/></td>";
echo "</tr>";
endforeach;
echo "</table>";

echo "</div>";
echo "</div>";
?>
<script>

function validation(){
 	var SubjectName = $('#SubjectName').val();
	if(SubjectName == ''){
		$('#message').html('Subject Name should not be blank').show().fadeOut('slow').fadeIn('slow');
		$('#SubjectName').focus();
		return false;
	}else{
		return true;
	}

}

function update_data($e){

 var SubjectId = $('#SubjectId').val();
 var SubjectName = $('#SubjectName').val();
 var SubjectDes = $('#SubjectDes').val();
 if(validation()){
 		$.ajax({
			type: 'POST',
			url: '<?=$url?>subject/update',
			data: 'SubjectId='+SubjectId+'&SubjectName='+SubjectName+'&SubjectDes='+SubjectDes,
			
			success: function(response){					
					if(response == 1){
						if($e == 1){
							window.location.href='<?=$url?>subject/listview';
						}else{
							alert('Update Successfully');
						}
					}else if(response == 2){
							alert('Record already exists');
							}
							else{
						alert('Update Not Successfully');
					}
				}
		});
	}	
}

</script>
