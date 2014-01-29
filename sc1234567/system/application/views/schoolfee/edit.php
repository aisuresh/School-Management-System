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
echo "<a href='".$url."schoolfee/listview/".$this->session->userdata('yearsf')."'>";
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
echo "<input type='hidden' name = 'SchoolFeeId' id = 'SchoolFeeId' value = '".$row->SchoolFeeId."'";
echo "<tr>";
echo "<td align='right' width='15%' class = 'datafield' >Class <span class = 'mandatory'>*</span></td>";
echo "<td width='2%' class='spacetd' > </td>";
echo "<td width='33%' class = 'dataview' >";
echo "<select name = 'ClassId' id = 'ClassId' onChange = 'section_fun();' >";
echo "<option value = 'x'>- - Select Class - -</option>";
foreach($course as $rowa):
	if($row->StudentClass == $rowa->ClassId){
		echo "<option value = '".$rowa->ClassId."' selected>";
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
echo "<td align='right' width='15%' class = 'datafield' >Section<span class = 'mandatory'>*</span></td>";
echo "<td width='2%' class='spacetd' > </td>";
echo "<td width='33%' class = 'dataview' >";
echo "<select name = 'SectionId' id = 'SectionId' onchange = 'studentlist_fun();' >";
echo "<option value = 'x'>- - Select Section - -</option>";
foreach($section as $sc){
		if($row->SectionId == $sc->SectionId){
		echo "<option value = '".$sc->SectionId."' selected>";
		echo $sc->SectionName;
		echo "</option>";
	}else{
		echo "<option value = '".$sc->SectionId."' >";
		echo $sc->SectionName;
		echo "</option>";
	}	
	
}
echo "</select>";
echo "</td></tr>";


echo "<tr>";
echo "<td align='right' width='15%' class = 'datafield' >Student Roll No<span class = 'mandatory'>*</span></td>";
echo "<td width='2%' class='spacetd' > </td>";
echo "<td width='33%' class = 'dataview' >";
echo "<select name = 'StudentId' id = 'StudentId' >";
echo "<option value = 'x'>- - Select RollNo - -</option>";
echo "<option value = '".$row->StudentId."' selected = 'selected'>". $row->RollNo."</option>";
echo "</select>";
echo "</td></tr>";

echo "<tr>";
echo "<td align='right' width='15%' class = 'datafield' >School Fees<span class = 'mandatory'>*</span></td>";
echo "<td width='2%' class='spacetd' > </td>";
echo "<td width='33%' class = 'dataview' ><input type = 'text' name = 'Fees' id = 'Fees' value='".$row->Fees ."' onKeyUp='JsCheckNumber(this)' /></td>";
echo "</tr>";

echo "<tr>";
echo "<td align='right' width='15%' class = 'datafield' >Recept No<span class = 'mandatory'>*</span></td>";
echo "<td width='2%' class='spacetd' > </td>";
echo "<td width='33%' class = 'dataview' ><input type = 'text' name = 'ReceiptNo' id = 'ReceiptNo' value = '".$row->ReceiptNo."' onKeyUp='JsCheckNumber(this)' /> </td>";
echo "</tr>";

echo "<tr>";
echo "<td align='right' width='15%' class = 'datafield' >Term No<span class = 'mandatory'>*</span></td>";
echo "<td width='2%' class='spacetd' > </td>";
echo "<td width='33%' class = 'dataview' ><input type = 'text' name = 'TermNo' id = 'TermNo' value='".$row->TermNo."' onKeyUp='JsCheckNumber(this)' /></td>";
echo "</tr>";

echo "<tr>";
echo "<td align='right' width='15%' class = 'datafield' >Paid Date<span class = 'mandatory'>*</span></td>";
echo "<td width='2%' class='spacetd' > </td>";
echo "<td width='33%' class = 'dataview' >";
$PaidDate=date("d-m-Y", strtotime($row->PaidDate));
echo "<input type='text' name='PaidDate' id='PaidDate' class='datepicker' readonly='readonly' value='".$PaidDate ."' />";
echo "</td>";
echo "</tr>";

echo "<tr>";
echo "<td align='right' width='15%' class = 'datafield' >Description</td>";
echo "<td width='2%' class='spacetd' > </td>";
echo "<td width='33%' class = 'dataview' ><input type = 'text' name = 'SchoolFeeDes' id = 'SchoolFeeDes' value='".$row->SchoolFeeDes."'/></td>";
echo "</tr>";

endforeach;
echo "</table>";

echo "</div>";
echo "</div>";
?>
<script>

function validation(){
	 var StudentId = $('#StudentId').val();
	 var Fees = $('#Fees').val();
	 var ReceiptNo = $('#ReceiptNo').val();
	 var TermNo =$('#TermNo').val();
	 var PaidDate = $('#PaidDate').val();
	 var SchoolFeeDes = $('#SchoolFeeDes').val();
	 
	 if(StudentId == 'x'){
		$('#message').html('Roll No should not be blank').show().fadeOut('slow').fadeIn('slow');
		$('#StudentId').focus();
		return false;
	}else if(Fees == 'x'){
		$('#message').html('Fees be blank').show().fadeOut('slow').fadeIn('slow');
		$('#Fees').focus();
		return false;
	}else if(ReceiptNo == ''){
		$('#message').html('Recept No should not be blank').show().fadeOut('slow').fadeIn('slow');
		$('#ReceiptNo').focus();
		return false;
	}else if(TermNo == ''){
		$('#message').html('Term No should not be blank').show().fadeOut('slow').fadeIn('slow');
		$('#TermNo').focus();
		return false;
	}else if(PaidDate == ''){
		$('#message').html('Paid Date should not be blank').show().fadeOut('slow').fadeIn('slow');
		$('#PaidDate').focus();
		return false;
	}else{
		return true;
	}
}

function update_data($e){
 var ClassId = $('#ClassId').val();
 var SchoolFeeId = $('#SchoolFeeId').val();
 var StudentId = $('#StudentId').val();
 var Fees = $('#Fees').val();
 var ReceiptNo = $('#ReceiptNo').val();
 var TermNo =$('#TermNo').val();
 var PaidDate = $('#PaidDate').val();
 var SchoolFeeDes = $('#SchoolFeeDes').val();
 if(validation()){
 $.ajax({
				type: 'POST',
				url: '<?=$url?>schoolfee/update',
				data: 'SchoolFeeId='+SchoolFeeId+'&StudentId='+StudentId+'&Fees='+Fees+'&ReceiptNo='+ReceiptNo+'&TermNo='+TermNo+'&PaidDate='+PaidDate+'&SchoolFeeDes='+SchoolFeeDes,
				success: function(response){
							//alert(response);				
						if(response == 1){
							if($e == 1){
								window.location.href='<?=$url?>schoolfee/listview/<?=$this->session->userdata('yearsf')?>';
							}else{
								alert('Update Successfully');
							}
							}else{
								alert('Update Not Successfully');
						}
					}
					
		});
	}	
}

function section_fun(){
	var ClassId = $('#ClassId').val();
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

function studentlist_fun(){
	var ClassId = $('#ClassId').val();
	var SectionId = $('#SectionId').val();
 		$.ajax({
				type: 'POST',
				url: '<?=$url?>schoolfee/studentlist',
				data: 'ClassId='+ClassId+'&SectionId='+SectionId,
				success: function(response){
						if(response != ''){
							$('#StudentId').html(response);
						}
					}	
		});
}						
$(function() {
 $( ".datepicker" ).datepicker({dateFormat: 'dd-mm-yy' });
});	


</script>
