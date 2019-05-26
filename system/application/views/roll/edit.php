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
echo "<a href='".$url."roll/listview'>";
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
echo "<div align = 'center' class='content'>";
echo "<div id ='message'></div>";
echo "<div id ='message1'></div>";
echo '<span class = "mandatory">*</span> Specified fileds are mandatory';
foreach($result as $row){
echo "<table border='0' cellpadding='0' cellspacing='1' class='formtable'>";
echo "<input type='hidden' id='RollId' name='RollId'  value='".$row->RollId."'  />";
echo "<tr>";
echo "<td align='right' width='15%' class = 'datafield' >Roll Type<span class = 'mandatory'>*</span></td>";
echo "<td width='2%' class='spacetd' > </td>";
echo "<td width='33%' class = 'dataview' ><input type = 'text' name = 'RollType' id = 'RollType' value = '".$row->RollType." ' disabled/></td>";
echo "</tr>";

echo "<tr>";
echo "<td align='right' width='15%' class = 'datafield' >Description</td>";
echo "<td width='2%' class='spacetd' > </td>";
echo "<td width='33%' class = 'dataview' ><input type = 'text' name = 'RollDes' id = 'RollDes' value = '".$row->RollDes."' /></td>";
echo "</tr>";
}

echo "</table>";

echo "</div>";
echo "</div>";
?>
<script>
function validation(){
	var RollType = $('#RollType').val();
	if(RollType == ''){
		$('#message').html('Roll Type should not be blank').show().fadeOut('slow').fadeIn('slow');
		$('#RollType').focus();
		return false;
	}else{
		return true;
	}

}

function update_data($e){
 var RollId = $('#RollId').val();
 var RollType = $('#RollType').val();
 var RollDes = $('#RollDes').val();
 if(validation()){
		 $.ajax({
			type: 'POST',
			url: '<?=$url?>roll/update',
			data: 'RollId='+RollId+'&RollType='+RollType+'&RollDes='+RollDes,
			success: function(response){					
					if(response == 1){
						if($e == 1){
							window.location.href='<?=$url?>roll/listview';
						}else{
							alert('Update Successfully');
						}
						
					}else if(response == 2)
					{
						alert('Record already exists!.');
					}
					else{
						alert('Update Not Successfully');
					}
				}
				
		});
	}
}

</script>
