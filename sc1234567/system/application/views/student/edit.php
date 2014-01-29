
<?php

echo "<div class='container'>";
echo "<div class='content_header'>";
/*---------------     content title       ---------------------*/
echo "<div class='content_title'>";
echo $pagetitle.' > '. $event;
echo "</div>";
echo "<div class='content_message'>";
echo "";
echo "</div>";
/*---------------     content events       ---------------------*/
echo "<div class='content_events'>";

echo "<div class='events'>";
echo "<a href='".$url."student/listview/".$this->session->userdata('yearsh')."'>";
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
echo "<div id = 'mandatory' ><span align ='right' class = 'mandatory'>*</span> Specipied fileds are mandatory</div>";
echo "<table border='0' cellpadding='0' cellspacing = '0' class='formtable'>";
//var_dump($result);
foreach($result as $row):
echo "<tr>";
echo "<td align='right' width='15%' class = 'datafield' >Student Roll No<span class = 'mandatory'>*</span></td>";
echo "<td width='2%' class='spacetd'> <input type = 'hidden' name = 'StudentId' id = 'StudentId' value = '".$row->StudentId."'/> </td>";
echo "<td width='33%' class = 'dataview' ><input type = 'text' name = 'StudentRollNo' id = 'StudentRollNo' value = '".$row->StudentRollNo."'  onKeyUp='JsCheckNumber(this)'/></td>";
echo "</tr>";

echo "<tr>";
echo "<td align='right' width='15%'  class = 'datafield'>Student Name<span class = 'mandatory'>*</span></td>";
echo "<td width='2%' class='spacetd' > </td>";
echo "<td width='33%' class = 'dataview'><input type = 'text' name = 'StudentName' id = 'StudentName' value = '".$row->StudentName."' onKeyUp='JsCheckChar(this)' /></td>";
echo "</tr>";

echo "<tr>";
echo "<td align='right' width='15%' class = 'datafield'>Father Name<span class = 'mandatory'>*</span></td>";
echo "<td width='2%' class='spacetd' > </td>";
echo "<td width='33%' class = 'dataview'><input type = 'text' name = 'FatherName' id = 'FatherName' value = '".$row->FatherName."' onKeyUp='JsCheckChar(this)' /></td>";
echo "</tr>";

echo "<tr>";
echo "<td align='right' width='15%' class = 'datafield'>Mother Name<span class = 'mandatory'>*</span></td>";
echo "<td width='2%' class='spacetd' > </td>";
echo "<td width='33%' class = 'dataview'><input type = 'text' name = 'MotherName' id = 'MotherName' value = '".$row->MotherName."' onKeyUp='JsCheckChar(this)' /></td>";
echo "</tr>";

echo "<tr>";
echo "<td align='right' width='15%' class = 'datafield'>Father Accupation<span class = 'mandatory'>*</span></td>";
echo "<td width='2%' class='spacetd' > </td>";
echo "<td width='33%' class = 'dataview'><input type = 'text' name = 'FatherOccupation' id = 'FatherOccupation' value = '".$row->FatherAccupation."' onKeyUp='JsCheckChar(this)' /></td>";
echo "</tr>";

echo "<tr>";
echo "<td align='right' width='15%' class = 'datafield'>Mother Accupation</td>";
echo "<td width='2%' class='spacetd' > </td>";
echo "<td width='33%' class = 'dataview'><input type = 'text' name = 'MotherOccupation' id = 'MotherOccupation' value = '".$row->MotherAccupation."' onKeyUp='JsCheckChar(this)' /></td>";
echo "</tr>";

echo "<tr>";
echo "<td align='right' width='15%' class = 'datafield'>Data of Birth<span class = 'mandatory'>*</span></td>";
echo "<td width='2%' class='spacetd' > </td>";
echo "<td width='33%' class = 'dataview'>";
$DateOfBirth=date("d-m-Y", strtotime($row->DateOfBirth));
echo "<input type='text' name='DateOfBirth' id='DateOfBirth' class='datepicker' readonly='readonly' value = '".$DateOfBirth."'/>";
echo "</td>";
echo "</tr>";

echo "<tr>";
echo "<td align='right' width='15%' class = 'datafield'>Gender<span class = 'mandatory'>*</span></td>";
echo "<td width='2%' class='spacetd' > </td>";
echo "<td width='33%' class = 'dataview'>"; 
if($row->Gender == 'm'){
echo "<label> <input type = 'radio' name = 'Gender' id = 'Gender' value = 'm' checked = 'checked'/> Male </label> <label> <input type = 'radio' name = 'Gender' id = 'Gender' value = 'f' /> Female</label> ";
}else{
	echo "<label> <input type = 'radio' name = 'Gender' id = 'Gender' value = 'm' checked = 'checked'/> Male </label> <label> <input type = 'radio' name = 'Gender' id = 'Gender' value = 'f' checked = 'checked'/> Female</label> ";
}
echo "</td></tr>";

echo "<tr>";
echo "<td align='right' width='15%' class = 'datafield' >Class / Course Medium<span class = 'mandatory'>*</span></td>";
echo "<td width='2%' class='spacetd' > </td>";
echo "<td width='33%' class = 'dataview' >";
echo "<select name = 'Medium' id = 'Medium' >";
echo "<option value = 'x'>- - Select Medium - -</option>";
if($row->Medium == 1){
	echo "<option value = '1' selected >Telugu</option>";
	echo "<option value = '2'>English</option>";
}else{
	echo "<option value = '1'  >Telugu</option>";
	echo "<option value = '2' selected >English</option>";
}
echo "</select>";
echo "</td>";
echo "</tr>";

echo "<tr>";
//echo "<td width='2%' class='spacetd'> <input type = 'hidden' name = 'StudentClassId' id = 'StudentClassId' value = '".$row->StudentClassId."'/> </td>";
echo "<td align='right' width='15%' class = 'datafield'>Class / Course<span class = 'mandatory'>*</span></td>";
echo "<td width='2%' class='spacetd'> <input type = 'hidden' name = 'StudentClassId' id = 'StudentClassId' value = '".$row->StudentClassId."'/> </td>";
//echo "<td width='2%' class='spacetd' > </td>";
echo "<td width='33%' class = 'dataview' >";
echo "<select name = 'StudentClass' id = 'StudentClass' onchange = 'section_fun();'  >";
echo "<option value = 'x'>- - Select Class - -</option>";
foreach($class as $rowa):
	if( $rowa->ClassId == $row->StudentClass){
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
echo "</td>";
echo "</tr>";

echo "<tr>";
echo "<td align='right' width='15%' class = 'datafield' >Section <span class = 'mandatory'>*</span></td>";
echo "<td width='2%' class='spacetd' > </td>";
echo "<td width='33%' class = 'dataview' >";
echo "<select name = 'SectionId' id = 'SectionId' >";
echo "<option value = 'x'>- - Select Section - -</option>";
foreach($sect as $rowa1):
	if( $rowa1->SectionId == $row->SectionId){
			echo "<option value = '".$rowa1->SectionId."' selected = 'selected' >";
			echo $rowa1->SectionName;
			echo "</option>";
	}else{
		echo "<option value = '".$rowa1->SectionId."' >";
		echo $rowa1->SectionName;
		echo "</option>";
	}		
endforeach;
echo "</select>";
echo "</td>";
echo "</tr>";


echo "<tr>";
echo "<td align='right' width='15%' class = 'datafield'>Village / Town<span class = 'mandatory'>*</span></td>";
echo "<td width='2%' class='spacetd' > </td>";
echo "<td width='33%' class = 'dataview'><input type = 'text' name = 'Town' id = 'Town' value = '".$row->Town."' onKeyUp='JsCheckChar(this)' /></td>";
echo "</tr>";

echo "<tr>";
echo "<td align='right' width='15%' class = 'datafield'>Cast<span class = 'mandatory'>*</span></td>";
echo "<td width='2%' class='spacetd' > </td>";
echo "<td width='33%' class = 'dataview'><input type = 'text' name = 'Cast' id = 'Cast' value = '".$row->Cast."' onKeyUp='JsCheckChar(this)' /></td>";
echo "</tr>";

echo "<tr>";
echo "<td align='right' width='15%' class = 'datafield'>Cast Category<span class = 'mandatory'>*</span></td>";
echo "<td width='2%' class='spacetd' > </td>";
echo "<td width='33%' class = 'dataview'>";
echo "<select name = 'CastCategoryId' id = 'CastCategoryId' >";
foreach($castc as $rowb):
	if($row->CastCategoryId == $rowb->CastCategoryId){
		echo "<option value = '".$rowb->CastCategoryId."' selected >";
		echo $rowb->CastCategory;
		echo "</option>";
	}else{
		echo "<option value = '".$rowb->CastCategoryId."' >";
		echo $rowb->CastCategory;
		echo "</option>";
	}	
endforeach;
echo "</select>";
echo "</td>";
echo "</tr>";

echo "<tr>";
echo "<td align='right' width='15%' class = 'datafield'>Nationality<span class = 'mandatory'>*</span></td>";
echo "<td width='2%' class='spacetd' > </td>";
echo "<td width='33%' class = 'dataview'>";
echo "<select name = 'NationalityId' id = 'NationalityId' >";
foreach($nationality as $rowc):
	if($row->NationalityId == $rowc->NationalityId){
		echo "<option value = '".$rowc->NationalityId."' selected >";
		echo $rowc->Nationality;
		echo "</option>";
	}else{
		echo "<option value = '".$rowc->NationalityId."' >";
		echo $rowc->Nationality;
		echo "</option>";

	}
endforeach;
echo "</select>";
echo "</td>";
echo "</tr>";

echo "<tr>";
echo "<td align='right' width='15%' class = 'datafield'>MotherTongue<span class = 'mandatory'>*</span></td>";
echo "<td width='2%' class='spacetd' > </td>";
echo "<td width='33%' class = 'dataview'>";
echo "<select name = 'MotherTongueId' id = 'MotherTongueId' >";
foreach($mothertongue as $rowc):
	if($row->MotherTongueId == $rowc->MotherTongueId){
		echo "<option value = '".$rowc->MotherTongueId."' selected >";
		echo $rowc->MotherTongue;
		echo "</option>";
	}else{
		echo "<option value = '".$rowc->MotherTongueId."' >";
		echo $rowc->MotherTongue;
		echo "</option>";

	}
endforeach;
echo "</select>";
echo "</td>";
echo "</tr>";

echo "<tr>";
echo "<td align='right' width='15%' class = 'datafield'>Physically challanged</td>";
echo "<td width='2%' class='spacetd' > </td>";
echo "<td width='33%' class = 'dataview'>";
echo "<select name = 'PH' id = 'PH' >";
if($row->PH == 'Y'){
	echo "<option value = 'Y' selected = 'selected' >Yes</option>";
}else{
	echo "<option value = 'N' selected = 'selected' >No</option>";
}
echo "</select>";
echo "</td></tr>";

echo "<tr>";
echo "<td align='right' width='15%' class = 'datafield'>Address</td>";
echo "<td width='2%' class='spacetd' > </td>";
echo "<td width='33%' class = 'dataview'><input type = 'text' name = 'Address' id = 'Address' value = '".$row->Address."'/></td>";
echo "</tr>";

echo "<tr>";
echo "<td align='right' width='15%' class = 'datafield'>Phone No</td>";
echo "<td width='2%' class='spacetd' > </td>";
echo "<td width='33%' class = 'dataview'><input type = 'text' name = 'PhoneNo' id = 'PhoneNo' value = '".$row->PhoneNo."' onKeyUp='JsCheckNumber(this)' /></td>";
echo "</tr>";

echo "<tr>";
echo "<td align='right' width='15%' class = 'datafield'>Mobile No<span class = 'mandatory'>*</span></td>";
echo "<td width='2%' class='spacetd' > </td>";
echo "<td width='33%' class = 'dataview'><input type = 'text' name = 'MobileNo' id = 'MobileNo' value = '".$row->MobileNo."' onKeyUp='JsCheckNumber(this)' /></td>";
echo "</tr>";

echo "<tr>";
echo "<td align='right' width='15%' class = 'datafield'>Email</td>";
echo "<td width='2%' class='spacetd' > </td>";
echo "<td width='33%' class = 'dataview'><input type = 'text' name = 'Email' id = 'Email' value = '".$row->Email."'/></td>";
echo "</tr>";

echo "<tr>";
echo "<td align='right' width='15%' class = 'datafield'>On TC</td>";
echo "<td width='2%' class='spacetd' > </td>";
echo "<td width='33%' class = 'dataview'>";
echo "<select name = 'OnTc' id = 'OnTc' >";
if($row->OnTC == 'Y'){
	echo "<option value = 'Y' selected = 'selected' >Yes</option>";
}else{
	echo "<option value = 'N' selected = 'selected' >No</option>";
}
echo "</select>";
echo "</td></tr>";

echo "<tr>";
echo "<td align='right' width='15%' class = 'datafield'>BloodGroup<span class = 'mandatory'>*</span></td>";
echo "<td width='2%' class='spacetd' > </td>";
echo "<td width='33%' class = 'dataview'>";
echo "<select name = 'BloodGroupId' id = 'BloodGroupId' disabled>";
foreach($bloodgroup as $rowc):
	if($row->BloodGroupId == $rowc->BloodGroupId){
		echo "<option value = '".$rowc->BloodGroupId."' selected >";
		echo $rowc->BloodGroupType;
		echo "</option>";
	}else{
		echo "<option value = '".$rowc->BloodGroupId."' >";
		echo $rowc->BloodGroupType;
		echo "</option>";

	}
endforeach;
echo "</select>";
echo "</td>";
echo "</tr>";



/*echo "<tr>";
echo "<td align='right' width='15%' class = 'datafield'>Upload Photo<span class = 'mandatory'>*</span></td>";
echo "<td width='2%' class='spacetd' > </td>";
echo "<td width='33%' class = 'dataview'><input type = 'text' name = 'Photo' id = 'Photo' value = '".$row->Photo."'/></td>";
echo "</tr>";*/

endforeach;
echo "</table>";

echo "</div>";
echo "</div>";
?>
<script>

function validation(){
   
	var StudentRollNo = $('#StudentRollNo').val();
	var StudentName = $('#StudentName').val();
	var FatherName = $('#FatherName').val();
	var MotherName = $('#MotherName').val();
	var FatherOccupation = $('#FatherOccupation').val();
	var MotherOccupation = $('#MotherOccupation').val();
	var DateOfBirth = $('#DateOfBirth').val();
	var Gender = $('#Gender').val();
	var StudentClass = $('#StudentClass').val();
	var SectionId = $('#SectionId').val();
	var Town = $('#Town').val();
	var Cast = $('#Cast').val();
	var CastCategoryId = $('#CastCategoryId').val();
	var NationalityId = $('#NationalityId').val();
	var MotherTongueId = $('#MotherTongueId').val();
	var PH = $('#PH').val();
	var Address = $('#Address').val();
	var PhoneNo = $('#PhoneNo').val();
	var MobileNo = $('#MobileNo').val();
	var AddmissionFee = $('#AddmissionFee').val();
	var OnTc = $('#OnTc').val();
	
	
	
	
	 if(StudentRollNo ==''){
		$('#message').html('Student Roll No should not be blank').show().fadeOut('slow').fadeIn('slow');
		$('#StudentRollNo').focus();
		return false;
	}else if(StudentName == ''){
		$('#message').html('Student Name should not be blank').show().fadeOut('slow').fadeIn('slow');
		$('#StudentName').focus();
		return false;
	}else if(FatherName == ''){
		$('#message').html('Father Name should not be blank').show().fadeOut('slow').fadeIn('slow');
		$('#FatherName').focus();
		return false;
	}else if(MotherName == ''){
		$('#message').html('Mother Name should not be blank').show().fadeOut('slow').fadeIn('slow');
		$('#MotherName').focus();
		return false;
	}else if(FatherOccupation == ''){
		$('#message').html('Father Accupation should not be blank').show().fadeOut('slow').fadeIn('slow');
		$('#FatherOccupation').focus();
		return false;
	}else if(MotherOccupation == ''){
		$('#message').html('Mother Accupation should not be blank').show().fadeOut('slow').fadeIn('slow');
		$('#MotherOccupation').focus();
		return false;
	}else if(DateOfBirth == ''){
		$('#message').html('Date of Birth should not be blank').show().fadeOut('slow').fadeIn('slow');
		$('#DateOfBirth').focus();
		return false;
	}else if(Gender == ''){
		$('#message').html('Gender should not be blank').show().fadeOut('slow').fadeIn('slow');
		$('#Gender').focus();
		return false;
	}else if(StudentClass == 'x'){
		$('#message').html('Student Class should not be blank').show().fadeOut('slow').fadeIn('slow');
		$('#StudentClass').focus();
		return false;
	}else if(SectionId == 'x'){
		$('#message').html('Section should not be blank').show().fadeOut('slow').fadeIn('slow');
		$('#SectionId').focus();
		return false;
	}else if(Town == ''){
		$('#message').html('Town should not be blank').show().fadeOut('slow').fadeIn('slow');
		$('#Town').focus();
		return false;
	}else if(Cast == ''){
		$('#message').html('Cast should not be blank').show().fadeOut('slow').fadeIn('slow');
		$('#Cast').focus();
		return false;
	}else if(CastCategoryId == 'x'){
		$('#message').html('Cast Category should not be blank').show().fadeOut('slow').fadeIn('slow');
		$('#CastCategoryId').focus();
		return false;
	}else if(NationalityId == 'x'){
		$('#message').html('Nationality should not be blank').show().fadeOut('slow').fadeIn('slow');
		$('#NationalityId').focus();
		return false;
	}else if(MotherTongueId == 'x'){
		$('#message').html('MotherTongue should not be blank').show().fadeOut('slow').fadeIn('slow');
		$('#MotherTongueId').focus();
		return false;
	}else if(MobileNo == ''){
		$('#message').html('Mobile No should not be blank').show().fadeOut('slow').fadeIn('slow');
		$('#MobileNo').focus();
		return false;
	}/*else if(AddmissionFee == ''){
		$('#message').html('Addmission Fee should not be blank').show().fadeOut('slow').fadeIn('slow');
		$('#AddmissionFee').focus();
		return false;
	}*/else if(OnTc == 'x'){
		$('#message').html('On TC should not be blank').show().fadeOut('slow').fadeIn('slow');
		$('#OnTc').focus();
		return false;
	}else{	
		return true;
	}
}

function update_data($e){
 
 var StudentId = $('#StudentId').val();
 var StudentClassId = $('#StudentClassId').val();
 var StudentRollNo = $('#StudentRollNo').val();
 var StudentName = $('#StudentName').val();
 var FatherName = $('#FatherName').val();
 var MotherName = $('#MotherName').val();
 var FatherOccupation = $('#FatherOccupation').val();
 var MotherOccupation = $('#MotherOccupation').val();
 var DateOfBirth = $('#DateOfBirth').val();
 var Gender = $('#Gender:checked').val();
 var Medium = $('#Medium').val();
 var StudentClass = $('#StudentClass').val();
 var SectionId = $('#SectionId').val();
 var Town = $('#Town').val();
 var Cast = $('#Cast').val();
 var CastCategoryId = $('#CastCategoryId').val();
 var NationalityId = $('#NationalityId').val();
 var MotherTongueId = $('#MotherTongueId').val();
 var PH = $('#PH').val();
 var Address = $('#Address').val();
 var PhoneNo = $('#PhoneNo').val();
 var MobileNo = $('#MobileNo').val();
 var Email = $('#Email').val();
 var AddmissionFee = $('#AddmissionFee').val();
 var OnTc = $('#OnTc').val();
 //var BloodGroupId = $('#BloodGroupId').val();
 //alert(StudentRollNo);
 if(validation()){
 
 $.ajax({
				type: 'POST',
				
				url: '<?=$url?>student/update',
				
				data: 'StudentId='+StudentId+'&StudentClassId='+StudentClassId+'&StudentRollNo='+StudentRollNo+'&StudentName='+StudentName+'&FatherName='+FatherName+'&MotherName='+MotherName+'&FatherOccupation='+FatherOccupation+'&MotherOccupation='+MotherOccupation+'&DateOfBirth='+DateOfBirth+'&Gender='+Gender+'&Medium='+Medium+'&StudentClass='+StudentClass+'&SectionId='+SectionId+'&Town='+Town+'&Cast='+Cast+'&CastCategoryId='+CastCategoryId+'&NationalityId='+NationalityId+'&MotherTongueId='+MotherTongueId+'&PH='+PH+'&Address='+Address+'&PhoneNo='+PhoneNo+'&MobileNo='+MobileNo+'&Email='+Email+'&AdmissionFee='+AddmissionFee+'&OnTc='+OnTc,
				success: function(response){	
				       //alert(response);				
						if(response == 1){
							if($e == 1){
								alert('Update Successfully');
						}else if(response == 2){
								alert('Recode already exists!..');	
						}else {
								alert('Update Not Successfully');
						}
					}
					
		});
		
	}	
}


function section_fun(){
		var ClassId = $('#StudentClass').val();
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
$(function() {
 $( ".datepicker" ).datepicker({dateFormat: 'dd-mm-yy', changeMonth: true, changeYear: true, yearRange: '1950:<?=date('Y')?>' });
});   
</script>
