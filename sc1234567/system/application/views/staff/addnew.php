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
echo "<a href='".$url."staff/listview'>";
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
echo '<tr><th colspan = "3" id = "table_title">Create New Staff Information</th></tr>';

echo "<tr>";
echo "<td align='right' width='15%' class = 'datafield' >Staff Name<span class = 'mandatory'>*</span></td>";
echo "<td width='2%' class='spacetd' > </td>";
echo "<td width='33%' class = 'dataview' ><input type = 'text' name = 'StaffName' id = 'StaffName' onKeyUp='JsCheckChar(this)' /></td>";
echo "</tr>";


echo "<tr>";
echo "<td align='right' width='15%' class = 'datafield' > Staff Type<span class = 'mandatory'>*</span></td>";
echo "<td width='2%' class='spacetd' > </td>";
echo "<td width='33%' class = 'dataview' >";
echo "<select name = 'StaffTypeId' id = 'StaffTypeId' >";
echo "<option value = 'x'>- - Select Staff Type - -</option>";
	foreach($stafftype as $rowa):
		if($rowa->InstituteId == $this->session->userdata('InstituteId'))
		{
		echo "<option value = '".$rowa->StaffTypeId."' >";
		echo $rowa->StaffType;
		echo "</option>";
		}
	endforeach;

echo "</select>";
echo "</td></tr>";

echo "<tr>";
echo "<td align='right' width='15%' class = 'datafield' >Gender<span class = 'mandatory'>*</span></td>";
echo "<td width='2%' class='spacetd' > </td>";
  
echo "<td width='33%' class = 'dataview' > <label> <input type = 'radio' name = 'Gender' id = 'Gender' value = 'male'  /> Male </label>";
echo " <label> <input type = 'radio' name = 'Gender' id = 'Gender' value = 'female' /> Female</label> </td>";
echo "</tr>";

echo "<tr>";
echo "<td align='right' width='15%' class = 'datafield' >Date of Birth<span class = 'mandatory'>*</span></td>";
echo "<td width='2%' class='spacetd' > </td>";
echo "<td width='33%' class = 'dataview' >";
echo "<input type='text' name='DateOfBirth' id='DateOfBirth' class = 'datepicker' readonly='readonly' />";
echo "</td>";
echo "</tr>";


echo "<tr>";
echo "<td align='right' width='30%' class = 'datafield' >Highest Qualification<span class = 'mandatory'>*</span></td>";
echo "<td width='2%' class='spacetd' > </td>";
echo "<td width='33%' class = 'dataview' >";
echo "<select name = 'course' id = 'course' style='width:150px;' onChange = 'branch_fun();' >";
echo "<option value = 'x'>- - Select Course- -</option>";
echo "<optgroup label='Graduation' value='graduation'>";
foreach($qualification as $rowb):
     if($rowb->InstituteId == $this->session->userdata('InstituteId'))
       {
		echo "<option value = '".$rowb->QualificationId."' >";
		echo $rowb->graduation;
		echo "</option>";
		}
	endforeach; 
echo "</optgroup>";
echo "<optgroup label='Pg' value='pg'>";
foreach($qualification1 as $rowb):
   if($rowb->InstituteId == $this->session->userdata('InstituteId'))
        {
		echo "<option value = '".$rowb->QualificationId."' >";
		echo $rowb->graduation;
		echo "</option>";
		}
	endforeach; 
echo "</optgroup>";
echo "<optgroup label='Others' value='Others'>";
foreach($qualification2 as $rowb):
   if($rowb->InstituteId == $this->session->userdata('InstituteId'))
        {
		echo "<option value = '".$rowb->QualificationId."' >";
		echo $rowb->graduation;
		echo "</option>";
		}
	endforeach; 
echo "</optgroup>";
echo "</select>";
echo "</td></tr>";
echo "<tr>";
echo "<td align='right' width='15%' class = 'datafield' >Branch</td>";
echo "<td width='2%' class='spacetd' > </td>";
echo "<td  class = 'dataview'>";
echo "<select name = 'branch' id = 'branch' style='width:150px;' >";
echo "<option value = 'x'>- - Select branch - -</option>";
echo "</select>";
echo "</td></tr>";

echo "<tr>";
echo "<td align='right' width='15%' class = 'datafield' >Total Experience<span class = 'mandatory'>*</span></td>";
echo "<td width='2%' class='spacetd' > </td>";
echo "<td width='33%' class = 'dataview'>";
echo "<select name = 'Years' id = 'Years' style='width:150px;' >";
echo "<option value = 'x'>- - Select Year - -</option>";
  for ($i=0; $i<=50; $i++)
    {
       echo "<option value = '".$i."' >";
	   echo $i;
	    echo "</option>";
    }

echo "</select>";
echo "</td></tr>";
echo "<tr>";
echo "<td align='right' width='15%' class = 'datafield' >Month</td>";
echo "<td width='2%' class='spacetd' > </td>";
echo "<td width='33%' class = 'dataview'>";
echo "<select name = 'Months' id = 'Months'  style='width:150px;'>";
echo "<option value = 'x'>- - Select Months - -</option>";
  for ($i=0; $i<=12; $i++)
    {
       echo "<option value = '".$i."' >";
	   echo $i;
	    echo "</option>";
    }

echo "</select>";
echo "</td></tr>";

echo "<tr>";
echo "<td align='right' width='15%' class = 'datafield' >Job Type<span class = 'mandatory'>*</span></td>";
echo "<td width='2%' class='spacetd' > </td>";
echo "<td width='33%' class = 'dataview' >";
echo "<select name = 'jobtype' id = 'jobtype' >";
echo "<option value = 'x'>- - Select JobType- -</option>";
echo "<option value = 'F' >Permanent Full Time</option>";
echo "<option value = 'P' >Permanent Part Time</option>";
echo "<option value = 'C' >Contract</option>";
echo "</select>";
echo "</td>";
echo "</tr>";

echo "<tr>";
echo "<td align='right' width='15%' class = 'datafield' >Subject 01<span class = 'mandatory'>*</span></td>";
echo "<td width='2%' class='spacetd' > </td>";
echo "<td width='33%' class = 'dataview' >";
echo "<select name = 'Subject01' id = 'Subject01' >";
echo "<option value = 'x'>- - Select Subject1- -</option>";
	foreach($subject as $rowc):
		if($rowc->InstituteId == $this->session->userdata('InstituteId'))
		{
		echo "<option value = '".$rowc->SubjectName."'>";
		echo $rowc->SubjectName;
		echo "</option>";
		}
	endforeach;
echo "</select>";
echo "</td>";
echo "</tr>";

echo "<tr>";
echo "<td align='right' width='15%' class = 'datafield' >Subject 02</td>";
echo "<td width='2%' class='spacetd' > </td>";
echo "<td width='33%' class = 'dataview' >";
echo "<select name = 'Subject02' id = 'Subject02' >";
echo "<option value = 'x'>- - Select Subject2- -</option>";
	foreach($subject as $rowc):
		if($rowc->InstituteId == $this->session->userdata('InstituteId'))
		{
		echo "<option value = '".$rowc->SubjectName."'>";
		echo $rowc->SubjectName;
		echo "</option>";
		}
	endforeach;
echo "</select>";
echo "</td>";
echo "</tr>";

echo "<tr>";
echo "<td align='right' width='15%' class = 'datafield' >Subject 03</td>";
echo "<td width='2%' class='spacetd' > </td>";
echo "<td width='33%' class = 'dataview' >";
echo "<select name = 'Subject03' id = 'Subject03' >";
echo "<option value = 'x'>- - Select Subject3- -</option>";
	foreach($subject as $rowc):
		if($rowc->InstituteId == $this->session->userdata('InstituteId'))
		{
		echo "<option value = '".$rowc->SubjectName."'>";
		echo $rowc->SubjectName;
		echo "</option>";
		}
	endforeach;
echo "</select>";
echo "</td>";
echo "</tr>";

echo "<tr>";
echo "<td align='right' width='15%' class = 'datafield' >Phone No</td>";
echo "<td width='2%' class='spacetd' > </td>";
echo "<td width='33%' class = 'dataview' ><input type = 'text' name = 'PhoneNo' id = 'PhoneNo' onKeyUp='JsCheckNumber(this)' /></td>";
echo "</tr>";

echo "<tr>";
echo "<td align='right' width='15%' class = 'datafield' >Mobile No<span class = 'mandatory'>*</span></td>";
echo "<td width='2%' class='spacetd' > </td>";
echo "<td width='33%' class = 'dataview' ><input type = 'text' name = 'MobileNo' id = 'MobileNo' onchange ='JsCheckMobile(this)' /></td>";
echo "</tr>";

echo "<tr>";
echo "<td align='right' width='15%' class = 'datafield' >Email<span class = 'mandatory'>*</span></td>";
echo "<td width='2%' class='spacetd' > </td>";
echo "<td width='33%' class = 'dataview' ><input type = 'text' name = 'Email' id = 'Email' onchange = 'JsCheckEmail(this)' /></td>";
echo "</tr>";

echo "<tr>";
echo "<td align='right' width='15%' class = 'datafield' >Town / Village<span class = 'mandatory'>*</span></td>";
echo "<td width='2%' class='spacetd' > </td>";
echo "<td width='33%' class = 'dataview' ><input type = 'text' name = 'Town' id = 'Town' onKeyUp='JsCheckChar(this)' /></td>";
echo "</tr>";

echo "<tr>";
echo "<td align='right' width='15%' class = 'datafield' >Address<span class = 'mandatory'>*</span></td>";
echo "<td width='2%' class='spacetd' > </td>";
echo "<td width='33%' class = 'dataview' ><input type = 'text' name = 'Address' id = 'Address' /></td>";
echo "</tr>";

echo "<tr>";
echo "<td align='right' width='15%' class = 'datafield' >Status<span class = 'mandatory'>*</span></td>";
echo "<td width='2%' class='spacetd' > </td>";
echo "<td width='33%' class = 'dataview' >";
echo "<select name = 'Status' id = 'Status' >";
echo "<option value = 'x'>- - Select Status - -</option>";
echo "<option value = 'Staff'> Staff </option>";
echo "<option value = 'Applicant'> Applicant </option>";
echo "</select>";
echo "</td></tr>";

echo "<tr>";
echo "<td align='right' width='15%' class = 'datafield' >Description</td>";
echo "<td width='2%' class='spacetd' > </td>";
echo "<td width='33%' class = 'dataview' ><input type = 'text' name = 'StaffDes' id = 'StaffDes' /></td>";
echo "</tr>";

echo "</table>";

echo "</div>";
echo "</div>";
?>

<script>
function validation($e){

	 var StaffName = $('#StaffName').val();
	 var StaffTypeId = $('#StaffTypeId').val();
	 var Gender = $('#Gender').val();
	 var DateOfBirth = $('#DateOfBirth').val();
	 var Qualification = $('#course').val();
	 var Experiance = $('#Years').val();
	 var jobtype = $('#jobtype').val();
	 var Subject01 =$('#Subject01').val();
	 var MobileNo =$('#MobileNo').val();  
	 var Town = $('#Town').val();
	 var Address = $('#Address').val();
	 var Status = $('#Status').val(); 
	 
	 if(StaffName ==''){
		$('#message').html('Staff Name should not be blank').show().fadeOut('slow').fadeIn('slow');
		$('#StaffName').focus();
		return false;
	}else if(StaffTypeId == 'x'){
		$('#message').html('Staff Type should not be blank').show().fadeOut('slow').fadeIn('slow');
		$('#StaffTypeId').focus();
		return false;
	}else if(Gender == '' ){
		$('#message').html('Gender should not be blank').show().fadeOut('slow').fadeIn('slow');
		$('#Gender').focus();
		return false;
	}else if(DateOfBirth == ''){
		$('#message').html('Date of Birth should not be blank').show().fadeOut('slow').fadeIn('slow');
		$('#DateOfBirth').focus();
		return false;
	}else if(Qualification == 'x'){
		$('#message').html('Qualification should not be blank').show().fadeOut('slow').fadeIn('slow');
		$('#course').focus();
		return false;
	}else if(Experiance == 'x'){
		$('#message').html('Experiance should not be blank').show().fadeOut('slow').fadeIn('slow');
		$('#Years').focus();
		return false;
	}else if(jobtype== 'x'){
		$('#message').html('job type should not be blank').show().fadeOut('slow').fadeIn('slow');
		$('#jobtype').focus();
		return false;
	}else if(Subject01 == 'x'){
		$('#message').html('Subject 01 should not be blank').show().fadeOut('slow').fadeIn('slow');
		$('#Subject01').focus();
		return false;
	}else if(MobileNo == ''){
		$('#message').html('MobileNo should not be blank').show().fadeOut('slow').fadeIn('slow');
		$('#MobileNo').focus();
		return false;
	}else if(Town == ''){
		$('#message').html('Town / Village should not be blank').show().fadeOut('slow').fadeIn('slow');
		$('#Town').focus();
		return false;
	}else if(Address == ''){
		$('#message').html('Address should not be blank').show().fadeOut('slow').fadeIn('slow');
		$('#Address').focus();
		return false;
	}
	else if(Status == 'x'){
		$('#message').html('Status not be blank').show().fadeOut('slow').fadeIn('slow');
		$('#Status').focus();
		return false;
	}else{
		return true;
	}
	 
}
 
function save_data($e){

 var StaffName = $('#StaffName').val();
 var StaffTypeId = $('#StaffTypeId').val();
 var Gender = $('#Gender:checked').val();
 var DateOfBirth = $('#DateOfBirth').val();
 var Qualification = $('#course').val();
 var Experiance = $('#Years').val();
 var Months = $('#Months').val();
 var jobtype = $('#jobtype').val();
 var Subject01 =$('#Subject01').val();
 var Subject02 =$('#Subject02').val();
 var Subject03 =$('#Subject03').val();
 var PhoneNo =$('#PhoneNo').val();
 var MobileNo =$('#MobileNo').val();  
 var Email = $('#Email').val();
 var Town = $('#Town').val();
 var Address = $('#Address').val(); 
 var Status = $('#Status').val(); 
 var StaffDes = $('#StaffDes').val();
 if(validation()){
 		$.ajax({
				type: 'POST',
				url: '<?=$url?>staff/save',
				data: 'StaffName='+StaffName+'&StaffTypeId='+StaffTypeId+'&Gender='+Gender+'&DateOfBirth='+DateOfBirth+'&Qualification='+Qualification+'&Experiance='+Experiance+'&Months='+Months+'&jobtype='+jobtype+'&Subject01='+Subject01+'&Subject02='+Subject02+'&Subject03='+Subject03+'&PhoneNo='+PhoneNo+'&MobileNo='+MobileNo+'&Email='+Email+'&Town='+Town+'&Address='+Address+'&Status='+Status+'&StaffDes='+StaffDes,
				success: function(response){			
						if(response == 1){
							if($e == 1){
								window.location.href='<?=$url?>staff/listview';
							}else{
								alert('Insert Successfully');
							}	
						}else if(response == 2){
									alert("Record already exists!");
							}else{
							alert('Insert Not Successfully');
						}
					}
					
		});
	}	
}	

$(function() {
 $( ".datepicker" ).datepicker({dateFormat: 'dd-mm-yy', changeMonth: true, changeYear: true, yearRange: '1950:<?=date('Y')?>' });
});	


function branch_fun(){
	var Course = $('#course').val();
	//alert(Course);
 		$.ajax({
				type: 'POST',
				url: '<?=$url?>staff/branch',
				data: 'Course='+Course,
				success: function(response){
						if(response != ''){
							$('#branch').html(response);
						}
					}	
		});
}
</script>
