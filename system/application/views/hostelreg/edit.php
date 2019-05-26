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
echo "<a href='".$url."hostelreg/listview/".$this->session->userdata('yearhrg')."'>";
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
echo "<div id = 'mandatory' ><span align ='right' class = 'mandatory'>*</span> Specipied fileds are mandatory</div>";
echo "<table border='0' cellpadding='0' cellspacing = '0' class='formtable'>";
//var_dump($result);
foreach($result as $row):
echo "<input type='hidden' name = 'HostelRegId' id = 'HostelRegId' value = '".$row->HostelRegId."'>";

echo "<tr>";
echo "<td align='right' width='15%' class = 'datafield' >Student Class<span class = 'mandatory'>*</span></td>";
echo "<td width='2%' class='spacetd' > </td>";
echo "<td width='33%' class = 'dataview' >";
echo "<select name = 'Class' id = 'Class' onchange = 'get_studentlist();' >";
echo "<option value = 'x'>- - Select Class - -</option>";
	foreach($course as $rowa):
		if($row->ClassId == $rowa->ClassId){
			echo "<option value = '".$rowa->ClassId."' selected = 'selected' >";
			echo $rowa->ClassName;
			echo "</option>";
		}else{
			echo "<option value = '".$rowa->ClassId."' >";
			echo $rowa->ClassName;
			echo "</option>";
		}	
	endforeach;
echo "</select>";
echo "</td></tr>";

echo "<tr>";
echo "<td align='right' width='15%' class = 'datafield' >Student Roll No & StudentName<span class = 'mandatory'>*</span></td>";
echo "<td width='2%' class='spacetd' > </td>";
echo "<td width='33%' class = 'dataview' >";
echo "<select name = 'StudentId' id = 'StudentId' onchange = 'get_hostelfee();'>";
echo "<option value = 'x'>- - Select RollNo - -</option>";
foreach($student as $sc):
		if($sc->StudentId == $row->StudentId){
			echo "<option value ='".$row->StudentId."' selected='selected' >";
			echo $row->StudentRollNo.'-'.$row->StudentName;
			echo "</option>";
		}else{
			echo "<option value = '".$row->StudentId."' selected='selected' >";
			echo $row->StudentRollNo.'-'.$row->StudentName;
			echo "</option>";
		}	
	endforeach;
echo "</select>";
echo "</td></tr>";

echo "<tr>";
echo "<td align='right' width='15%' class = 'datafield' >Hostel Fee<span class = 'mandatory'>*</span></td>";
echo "<td width='2%' class='spacetd' > </td>";
echo "<td width='33%' class = 'dataview' >";
echo "<input type = 'text' name = 'HostelFee' id = 'HostelFee' value = '".$row->HostelFee."'  readonly = 'readonly' /></td>";
echo "</tr>";

echo "<tr>";
echo "<td align='right' width='15%' class = 'datafield' >Hostel Fee Discount<span class = 'mandatory'>*</span></td>";
echo "<td width='2%' class='spacetd' > </td>";
echo "<td width='33%' class = 'dataview' ><input type = 'text' name = 'HostelFeeDiscount' id = 'HostelFeeDiscount' value ='".$row->HostelFeeDiscount."' onblur  ='get_totalfee();' /></td>";
echo "</tr>";

echo "<tr>";
echo "<td align='right' width='15%' class = 'datafield' >Total Hostel Fee<span class = 'mandatory'>*</span></td>";
echo "<td width='2%' class='spacetd' > </td>";
echo "<td width='33%' class = 'dataview' >";
echo "<input type = 'text' name = 'THostelFee' id = 'THostelFee'  value = ' Rs ".($row->HostelFee - $row->HostelFeeDiscount)."' readonly = 'readonly' style = 'border:none' /></td>";
echo "</tr>";

echo "<tr>";
echo "<td align='right' width='15%' class = 'datafield' >Description</td>";
echo "<td width='2%' class='spacetd' > </td>";
echo "<td width='33%' class = 'dataview' ><input type = 'text' name = 'HostelFeeDes'  id = 'HostelFeeDes' value = '".$row->HostelDes."' /></td>";
echo "</tr>";

endforeach;
echo "</table>";

echo "</div>";
echo "</div>";
?>
<script>

function validation(){
 
 var Class = $('#Class').val();
 var StudentId = $('#StudentId').val();
 
 
	  if(Class == 'x'){
	     $('#message').html('Class should not be blank').show().fadeOut('slow').fadeIn('slow');
		$('#Class').focus();
		return false;
	 }else if(StudentId =='x'){
		$('#message').html('RollNo should not be blank').show().fadeOut('slow').fadeIn('slow');
		$('#StudentId').focus();
		return false;
	}else{
		return true;
	}
}

function update_data($e){

 var HostelRegId = $('#HostelRegId').val();
 var StudentId = $('#StudentId').val();
 var HostelFee = $('#HostelFee').val();
 var HostelFeeDiscount = $('#HostelFeeDiscount').val();
 var HostelFeeDes = $('#HostelFeeDes').val();
 
 	if(validation()){
 			$.ajax({
				type: 'POST',
				
				url: '<?=$url?>hostelreg/update',
				
				data: 'HostelRegId='+HostelRegId+'&StudentId='+StudentId+'&HostelFee='+HostelFee+'&HostelFeeDiscount='+HostelFeeDiscount+'&HostelFeeDes='+HostelFeeDes,
				
				success: function(response){	
				   // alert(response);			
						if(response == 1){
							if($e == 1){
								window.location.href='<?=$url?>hostelreg/listview/<?=$this->session->userdata('yearhrg')?>';
							}else{
								alert('Update Successfully');
							}
						}else if(response == 2){
								alert('Record already exists!..');
						}else{
							alert('Update Not Successfully');
						}
					}
					
			});
		}	
}

function get_studentlist(){
	var Class = $('#Class').val();
	$.ajax({
			type: 'POST',
			url: '<?=$url?>hostelreg/studentlist',
			data: 'Class='+Class,
			success: function(response){
					if(response != ''){
						$('#StudentId').html(response);
					}
				}
				
	});
}

function get_hostelfee(){
	var Class = $('#Class').val();
	$.ajax({
			type: 'POST',
			url: '<?=$url?>hostelreg/hostelfee',
			data: 'Class='+Class,
			success: function(response){
					if(response != ''){
						$('#HostelFee').val(response);
					}
				}
				
	});
}

function get_totalfee(){
	var HostelFee = $('#HostelFee').val();
	var HostelFeeDis = $('#HostelFeeDiscount').val();
	$('#THostelFee').val('Rs '+(HostelFee-HostelFeeDis));
}
</script>
