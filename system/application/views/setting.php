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
echo "<a href='".$url."setting/settingview' >";
echo "<span><img src='".$url."images/cancel.png' border='0' /></span>";
echo "<span> Cancel </span>";
echo "</a>";
echo "</div>";

echo "<div class='events'>";
echo "<a onclick='edit_data();' >";
echo "<span><img src='".$url."images/ok.png' border='0' /></span>";
echo "<span> Edit </span>";
echo "</a>";
echo "</div>";

echo "</div>";
echo "</div>";
/*---------------     content        ---------------------*/
echo "<div align = 'center' class='content'>";
echo "<table border='0' cellpadding='0' cellspacing = '0' class='formtable'>";

foreach(array_reverse($result) as $row):
    //var_dump($row->SettingTypeId);
	//var_dump($row->flag);
	
	if($row->SettingTypeId == 1){
		//echo "<input type='hidden' name = 'SettingTypeId' id = 'SettingTypeId' value = '".$row->SettingTypeId."'";
		
		echo "<tr>";
		echo "<td align='right' width='15%' class = 'datafield' >".$row->SettingType ."</td>";
		echo "<td width='2%' class='spacetd' > </td>";
		echo "<td width='33%' class = 'dataview' >";
				
		echo "<label> <input type = 'checkbox' name = 'admissionid' id = 'admissionid' value = 'Y'";
        if($row->flag == 'Y'){ 
			echo "checked = 'checked' ";
		}
		echo " />  </label>";
		
		//echo "<label> <input type = 'checkbox' name = 'flag' id = 'flag' value = 'true'  />  </label>";
		echo "</td>";
		echo "</tr>";
		
	}
	if($row->SettingTypeId == 2){
		//echo "<input type='hidden' name = 'SettingTypeId' id = 'SettingTypeId' value = '".$row->SettingTypeId."'";
		
		echo "<tr>";
		echo "<td align='right' width='15%' class = 'datafield' >".$row->SettingType ."</td>";
		echo "<td width='2%' class='spacetd' > </td>";
		echo "<td width='33%' class = 'dataview' >";
		
		echo "<label> <input type = 'checkbox' name = 'rollid' id = 'rollid' value = 'Y'";
        if($row->flag == 'Y'){ 
			echo "checked = 'checked' ";
		}
		echo " />  </label>";
		//echo "<label> <input type = 'checkbox' name = 'flag' id = 'flag' value = 'true'  />  </label>";
		echo "</td>";
		echo "</tr>";
	}

endforeach;
echo '</table>';
echo "</div>";
echo "</div>";
?>
<script>
function edit_data(){
//alert($('#admissionid').val());
//alert($('#rollid').val());

	//var admissionidflag = ($('#admissionid').val() == 'undefined' ? 'Y' : 'N');
	//var rollidflag = $('#rollid').val() == 'undefined' ? 'Y' : 'N';
	var admissionidflag = $('input:checkbox[name=admissionid]:checked').val();
		if(admissionidflag == 'undefined' || admissionidflag == null ){
			var admissionidflag = 'N';
		}
	var rollidflag = $('input:checkbox[name=rollid]:checked').val();
	    if(rollidflag == 'undefined' || rollidflag == null ){
			var rollidflag = 'N';
		}
	//alert(admissionidflag);
	//alert(rollidflag);
	 $.ajax({
			type: 'POST',
			url: '<?=$url?>setting/update',
			data: 'admissionidflag='+admissionidflag+'&rollidflag='+rollidflag,
			success: function(response){
			alert(response);
					if(response == 1){
						alert('Update Successfully');
						}	
					else{
						alert('Update Not Successfully');
					}
				}
				
		});
}

</script>
