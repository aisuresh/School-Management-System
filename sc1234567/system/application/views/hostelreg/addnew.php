
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
echo '<tr><th colspan = "3" id = "table_title">Create New Hostel Register </th></tr>';

echo "<tr>";
echo "<td align='right' width='15%' class = 'datafield' >Student Class<span class = 'mandatory'>*</span></td>";
echo "<td width='2%' class='spacetd' > </td>";
echo "<td width='33%' class = 'dataview' >";
echo "<select name = 'Class' id = 'Class' onchange = 'get_studentlist();' >";
echo "<option value = 'x'>- - Select Class - -</option>";
	foreach($course as $rowa):
		echo "<option value = '".$rowa->ClassId."' >";
		echo $rowa->ClassName;
		echo "</option>";
	endforeach;
echo "</select>";
echo "</td></tr>";

echo "<tr>";
echo "<td align='right' width='15%' class = 'datafield' > Roll No & StudentName<span class = 'mandatory'>*</span></td>";
echo "<td width='2%' class='spacetd' > </td>";
echo "<td width='33%' class = 'dataview' >";
echo "<select name = 'StudentId' id = 'StudentId' onchange = 'get_hostelfee();'>";
echo "<option value = 'x'>- - Select RollNo - -</option>";
/*foreach($rollno as $rowa1):
		echo "<option value = '".$rowa1->RollNo."' >";
		echo $rowa1->RollNo;
		echo "</option>";
	endforeach;*/
echo "</select>";
echo "</td></tr>";


echo "<tr>";
echo "<td align='right' width='15%' class = 'datafield' >HostelFee<span class = 'mandatory'>*</span></td>";
echo "<td width='2%' class='spacetd' > </td>";
echo "<td width='33%' class = 'dataview' >";
echo "<input type='text' name='HostelFee' id='HostelFee' readonly='readonly' /></td>";
echo "</tr>";

echo "<tr>";
echo "<td align='right' width='15%' class = 'datafield' >HostelFeeDiscount<span class = 'mandatory'>*</span></td>";
echo "<td width='2%' class='spacetd' > </td>";
echo "<td width='33%' class = 'dataview' ><input type = 'text' name = 'HostelFeeDiscount' id = 'HostelFeeDiscount' onchange ='get_totalfee();' /></td>";
echo "</tr>";

echo "<tr>";
echo "<td align='right' width='15%' class = 'datafield' >TotalHostelFee</td>";
echo "<td width='2%' class='spacetd' > </td>";
echo "<td width='33%' class = 'dataview' >";
echo "<input type = 'text' name = 'THostelFee' id = 'THostelFee'  readonly = 'readonly' style = 'border:none' /></td>";
echo "</tr>";

echo "<tr>";
echo "<td align='right' width='15%' class = 'datafield' >Description</td>";
echo "<td width='2%' class='spacetd' > </td>";
echo "<td width='33%' class = 'dataview' ><input type = 'text' name = 'HostelFeeDes' id = 'HostelFeeDes' /></td>";
echo "</tr>";

echo "</table>";

echo "</div>";
echo "</div>";
?>
<script>

function validation(){

 var Class = $('#Class').val();
 var StudentId = $('#StudentId').val();
 var HostelFee=$('#HostelFee').val();
 var HostelFeeDiscount=$('#HostelFeeDiscount').val();
 
 
 
	 if(Class == 'x'){
	 $('#message').html('Class should not be blank').show().fadeOut('slow').fadeIn('slow');
		$('#Class').focus();
		return false;
	 }else if(StudentId =='x'){
		$('#message').html('RollNo should not be blank').show().fadeOut('slow').fadeIn('slow');
		$('#StudentId').focus();
		return false;
	}else if(HostelFee ==''){
		$('#message').html('HostelFee should not be blank').show().fadeOut('slow').fadeIn('slow');
		$('#HostelFee').focus();
		return false;
	}
	else if(HostelFeeDiscount=''){
		$('#message').html('hostelFeeDiscount should not be blank').show().fadeOut('slow').fadeIn('slow');
		$('#HostelFeeDiscount').focus();
		return false;
	}else{
		return true;
	}
}
function save_data($e){

 var Class = $('#Class').val();
 var StudentId = $('#StudentId').val();
 var HostelFee = $('#HostelFee').val().trim();
 var HostelFeeDiscount = $('#HostelFeeDiscount').val();
 var THostelFee =$('#THostelFee').val();
 
 var HostelFeeDes = $('#HostelFeeDes').val();
/*alert(HostelFee);
alert(JoinDate);
alert(RollNo);
alert(HostelFeeDiscount);
alert(HostelFeeDes)
alert(Year);*/
 if(validation()){
 		$.ajax({
				type: 'POST',
				url: '<?=$url?>hostelreg/save',
				data: 'Class='+Class+'&StudentId='+StudentId+'&HostelFee='+HostelFee+'&HostelFeeDiscount='+HostelFeeDiscount+'&HostelFeeDes='+HostelFeeDes,
				success: function(response){	
				     //alert(response);		
						if(response == 1){
							if($e == 1){
								window.location.href='<?=$url?>hostelreg/listview/<?=$this->session->userdata('yearhrg')?>';
							}else{
								alert('Insert Successfully');
							}
						}else if(response == 2){
								alert('Record already exists!..');	
						}else{
							alert('Insert Not Successfully');
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
			       //alert(response);
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
