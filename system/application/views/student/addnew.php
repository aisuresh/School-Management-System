<?php
echo "<div class='container' >";
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
echo "<a href='".$url."student/listview/".$this->session->userdata('yearsh')."'>";
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
echo "<div align = 'center' class='content' >";
echo "<div id ='message'></div>";
echo "<div id ='message1'></div>";
echo "<div id = 'mandatory' ><span align ='right' class = 'mandatory'>*</span> Specified fields are mandatory</div>";
echo "<table border='0' cellpadding='0' cellspacing='0' class='formtable'>";
echo '<tr><th colspan = "3" id = "table_title">Create New Student Information</th></tr>';


echo "<tr>";
echo "<td align='right' width='15%' class = 'datafield' >Student Roll No<span class = 'mandatory'>*</span></td>";
echo "<td width='2%' class='spacetd'> <input type = 'hidden' name = 'StudentId' id = 'StudentId' /> </td>";
echo "<td width='33%' class = 'dataview' ><input type = 'text' name = 'StudentRollNo' id = 'StudentRollNo' onKeyUp='JsCheckNumber(this)' /></td>";
echo "</tr>";

echo "<tr>";
echo "<td align='right' width='15%' class = 'datafield' >Student Name<span class = 'mandatory'>*</span></td>";
echo "<td width='2%' class='spacetd' > </td>";
echo "<td width='33%' class = 'dataview' ><input type = 'text' name = 'StudentName' id = 'StudentName' onKeyUp='JsCheckChar(this)' /></td>";
echo "</tr>";

echo "<tr>";
echo "<td align='right' width='15%' class = 'datafield' >Father Name<span class = 'mandatory'>*</span></td>";
echo "<td width='2%' class='spacetd' > </td>";
echo "<td width='33%' class = 'dataview' ><input type = 'text' name = 'FatherName' id = 'FatherName' onKeyUp='JsCheckChar(this)' /></td>";
echo "</tr>";

echo "<tr>";
echo "<td align='right' width='15%' class = 'datafield' >Mother Name<span class = 'mandatory'>*</span></td>";
echo "<td width='2%' class='spacetd' > </td>";
echo "<td width='33%' class = 'dataview' ><input type = 'text' name = 'MotherName' id = 'MotherName' onKeyUp='JsCheckChar(this)' /></td>";
echo "</tr>";

echo "<tr>";
echo "<td align='right' width='15%' class = 'datafield' >Father Occupation<span class = 'mandatory'>*</span></td>";
echo "<td width='2%' class='spacetd' > </td>";
echo "<td width='33%' class = 'dataview' ><input type = 'text' name = 'FatherOccupation' id = 'FatherOccupation' onKeyUp='JsCheckChar(this)' /></td>";
echo "</tr>";

echo "<tr>";
echo "<td align='right' width='15%' class = 'datafield' >Mother Occupation</td>";
echo "<td width='2%' class='spacetd' > </td>";
echo "<td width='33%' class = 'dataview' ><input type = 'text' name = 'MotherOccupation' id = 'MotherOccupation' onKeyUp='JsCheckChar(this)' /></td>";
echo "</tr>";

echo "<tr>";
echo "<td align='right' width='15%' class = 'datafield' >Date of Birth<span class = 'mandatory'>*</span></td>";
echo "<td width='2%' class='spacetd' > </td>";
echo "<td width='33%' class = 'dataview' >";


echo "<input type='text' name='DateOfBirth' id='DateOfBirth' class='datepicker' readonly='readonly' />";
echo "</td>";
echo "</tr>";

echo "<tr>";
echo "<td align='right' width='15%' class = 'datafield' >Gender<span class = 'mandatory'>*</span></td>";
echo "<td width='2%' class='spacetd' > </td>";
  
echo "<td width='33%' class = 'dataview' > <label> <input type = 'radio' name = 'Gender' id = 'Gender' value = 'male'  /> Male </label>";
echo " <label> <input type = 'radio' name = 'Gender' id = 'Gender' value = 'female' /> Female</label> </td>";
echo "</tr>";

echo "<tr>";
echo "<td align='right' width='15%' class = 'datafield' >Course Medium <span class = 'mandatory'>*</span></td>";
echo "<td width='2%' class='spacetd' > </td>";
echo "<td width='33%' class = 'dataview' >";
echo "<select name = 'Medium' id = 'Medium' >";
echo "<option value = 'x'>- - Select Medium - -</option>";
echo "<option value = '1'>Tamil</option>";
echo "<option value = '2'>English</option>";
echo "</select>";
echo "</td>";
echo "</tr>";

echo "<tr>";
echo "<td align='right' width='15%' class = 'datafield' >Class<span class = 'mandatory'>*</span></td>";
echo "<td width='2%' class='spacetd' > </td>";
echo "<td width='33%' class = 'dataview' >";
echo "<select name = 'StudentClass' id = 'StudentClass' onchange = 'section_fun();' >";
echo "<option value = 'x'>- - Select Class - -</option>";
foreach($class as $rowa):
echo "<option value = '".$rowa->ClassId."' >";
echo $rowa->ClassName;
echo "</option>";
endforeach;
echo "</select>";
echo "</td>";
echo "</tr>";

echo "<tr>";
echo "<td align='right' width='15%' class = 'datafield' >Section <span class = 'mandatory'>*</span></td>";
echo "<td width='2%' class='spacetd' > </td>";
echo "<td width='33%' class = 'dataview' >";
echo "<select name = 'SectionId' id = 'SectionId' onchange = 'studentlist_fun();' >";
echo "<option value = 'x'>- - Select Section - -</option>";
foreach($sect as $rowb):
echo "<option value = '".$rowb->SectionId."' >";
echo $rowb->SectionName;
echo "</option>";
endforeach;
echo "</select>";
echo "</td>";
echo "</tr>";


echo "<tr>";
echo "<td align='right' width='15%' class = 'datafield' >Village / Town<span class = 'mandatory'>*</span></td>";
echo "<td width='2%' class='spacetd' > </td>";
echo "<td width='33%' class = 'dataview' ><input type = 'text' name = 'Town' id = 'Town' onKeyUp='JsCheckChar(this)' /></td>";
echo "</tr>";

echo "<tr>";
echo "<td align='right' width='15%' class = 'datafield' >Caste<span class = 'mandatory'>*</span></td>";
echo "<td width='2%' class='spacetd' > </td>";
echo "<td width='33%' class = 'dataview' ><input type = 'text' name = 'Cast' id = 'Cast' onKeyUp='JsCheckChar(this)' /></td>";
echo "</tr>";

echo "<tr>";
echo "<td align='right' width='15%' class = 'datafield' >Caste Category<span class = 'mandatory'>*</span></td>";
echo "<td width='2%' class='spacetd' > </td>";
echo "<td width='33%' class = 'dataview' >";
echo "<select name = 'CastCategoryId' id = 'CastCategoryId' >";
echo "<option value = 'x'>- Select Cast Category -</option>";
foreach($castc as $row):
echo "<option value = '".$row->CastCategoryId."' >";
echo $row->CastCategory;
echo "</option>";
endforeach;
echo "</select>";
echo "</td>";
echo "</tr>";

echo "<tr>";
echo "<td align='right' width='15%' class = 'datafield' >Nationality<span class = 'mandatory'>*</span></td>";
echo "<td width='2%' class='spacetd' > </td>";
echo "<td width='33%' class = 'dataview' >";
echo "<select name = 'NationalityId' id = 'NationalityId' >";
echo "<option value = 'x'>- - Select Nationality - -</option>";
foreach($nationality as $row):
echo "<option value = '".$row->NationalityId."' >";
echo $row->Nationality;
echo "</option>";
endforeach;
echo "</select>";
echo "</td>";
echo "</tr>";

echo "<tr>";
echo "<td align='right' width='15%' class = 'datafield' >MotherTongue<span class = 'mandatory'>*</span></td>";
echo "<td width='2%' class='spacetd' > </td>";
echo "<td width='33%' class = 'dataview' >";
echo "<select name = 'MotherTongueId' id = 'MotherTongueId' >";
echo "<option value = 'x'>- - Select Nationality - -</option>";
foreach($mothertongue as $row):
echo "<option value = '".$row->MotherTongueId."' >";
echo $row->MotherTongue;
echo "</option>";
endforeach;
echo "</select>";
echo "</td>";
echo "</tr>";

echo "<tr>";
echo "<td align='right' width='15%' class = 'datafield'>Physically challenged<span class = 'mandatory'>*</span></td>";
echo "<td width='2%' class='spacetd' > </td>";
echo "<td width='33%' class = 'dataview'>";
echo "<select name = 'PH' id = 'PH' >";
	echo "<option value = 'x' >-- Select Physically Challenged --</option>";
	echo "<option value = 'Y' >Yes</option>";
	echo "<option value = 'N' >No</option>";
echo "</select>";
echo "</td></tr>";

echo "<tr>";
echo "<td align='right' width='15%' class = 'datafield' >Address</td>";
echo "<td width='2%' class='spacetd' > </td>";
echo "<td width='33%' class = 'dataview' ><input type = 'text' name = 'Address' id = 'Address' /></td>";
echo "</tr>";

echo "<tr>";
echo "<td align='right' width='15%' class = 'datafield' >Phone No</td>";
echo "<td width='2%' class='spacetd' > </td>";
echo "<td width='33%' class = 'dataview' ><input type = 'text' name = 'PhoneNo' id = 'PhoneNo' onKeyUp='JsCheckNumber(this)' /></td>";
echo "</tr>";

echo "<tr>";
echo "<td align='right' width='15%' class = 'datafield' >Mobile No<span class = 'mandatory'>*</span></td>";
echo "<td width='2%' class='spacetd' > </td>";
echo "<td width='33%' class = 'dataview' ><input type = 'text' name = 'MobileNo' id = 'MobileNo' onchange='JsCheckMobile(this)' /></td>";
echo "</tr>";

echo "<tr>";
echo "<td align='right' width='15%' class = 'datafield' >Email<span class = 'mandatory'>*</span></td>";
echo "<td width='2%' class='spacetd' > </td>";
echo "<td width='33%' class = 'dataview' ><input type = 'text' name = 'Email' id = 'Email' onchange='JsCheckEmail(this)'/></td>";
echo "</tr>";

echo "<tr>";
echo "<td align='right' width='15%' class = 'datafield' >Admission Fee<span class = 'mandatory'>*</span></td>";
echo "<td width='2%' class='spacetd' > </td>";
echo "<td width='33%' class = 'dataview' ><input type = 'text' name = 'AddmissionFee' id = 'AddmissionFee' onKeyUp='JsCheckNumber(this)' /></td>";
echo "</tr>";

echo "<tr>";
echo "<td align='right' width='15%' class = 'datafield' >Bus Fees</td>";
echo "<td width='2%' class='spacetd' > </td>";
echo "<td width='33%' class = 'dataview' ><input type = 'text' name = 'BusFees' id = 'BusFees' onKeyUp='JsCheckNumber(this)' /></td>";
echo "</tr>";

echo "<tr>";
echo "<td align='right' width='15%' class = 'datafield'>On TC<span class = 'mandatory'>*</span></td>";
echo "<td width='2%' class='spacetd' > </td>";
echo "<td width='33%' class = 'dataview'>";
echo "<select name = 'OnTc' id = 'OnTc' >";
	echo "<option value = 'x' >-- Select On TC --</option>";
	echo "<option value = 'Y' >Yes</option>";
	echo "<option value = 'N' >No</option>";
echo "</select>";
echo "</td></tr>";

echo "<tr>";
echo "<td align='right' width='15%' class = 'datafield' >BloodGroup<span class = 'mandatory'>*</span></td>";
echo "<td width='2%' class='spacetd' > </td>";
echo "<td width='33%' class = 'dataview' >";
echo "<select name = 'BloodGroupId' id = 'BloodGroupId' >";
echo "<option value = 'x'>- - Select BloodGroup - -</option>";
foreach($bloodgroup as $row):
echo "<option value = '".$row->BloodGroupId."' >";
echo $row->BloodGroupType;
echo "</option>";
endforeach;
echo "</select>";
echo "</td>";
echo "</tr>";


echo "<tr>";
echo "<td align='right' width='15%' class = 'datafield' >Upload Photo<span class = 'mandatory'>*</span></td>";
echo "<td width='2%' class='spacetd' > </td>";
echo "<td width='33%' class = 'dataview' >";
echo "<input type='button' id='upload' class='browse_media' value='Upload Photo' style = 'float:left;'> <div style = 'width:75%; height: 18px; margin-left:5px; float:left; display:none' id = 'filename'></div> <input type = 'hidden' name = 'imagename' id = 'imagename' /></td>";
echo "</tr>";
echo "</table>";

echo "</div>";
echo "</div>";
echo "<div id = 'wizard' style = 'float:left;' > </div>";
//echo script_tag('themes/js/uploadscript/ajaxupload.3.5.js');
?>
<script type="text/javascript" src="<?php echo $url .'themes/js/uploadscript/ajaxupload.3.5.js' ?>"></script>
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
	var Email = $('#Email').val();
	var AdmissionFee = $('#AddmissionFee').val();
	var OnTc = $('#OnTc').val();
	var BloodGroupId = $('#BloodGroupId').val();
	
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
		$('#message').html('Father Occupation should not be blank').show().fadeOut('slow').fadeIn('slow');
		$('#FatherOccupation').focus();
		return false;
	}else if(MotherOccupation == ''){
		$('#message').html('Mother Occupation should not be blank').show().fadeOut('slow').fadeIn('slow');
		$('#MotherOccupation').focus();
		return false;
	}else if(DateOfBirth == ''){
		$('#message').html('Date of Birth should not be blank').show().fadeOut('slow').fadeIn('slow');
		$('#DateOfBirth').focus();
		return false;
	}else if(Gender == '' ){
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
	}else if(Email == ''){
		$('#message').html('Mobile No should not be blank').show().fadeOut('slow').fadeIn('slow');
		$('#Email').focus();
		return false;
	}else if(AdmissionFee == ''){
		$('#message').html('Addmission Fee should not be blank').show().fadeOut('slow').fadeIn('slow');
		$('#AddmissionFee').focus();
		return false;
	}else if(OnTc == 'x'){
		$('#message').html('On TC should not be blank').show().fadeOut('slow').fadeIn('slow');
		$('#OnTc').focus();
		return false;
	}else if(BloodGroupId == 'x'){
		$('#message').html('BloodGroup should not be blank').show().fadeOut('slow').fadeIn('slow');
		$('#BloodGroupId').focus();
		return false;
	}else{
		return true;
	}
}
function save_data($e){

// var StudentId =  $('#StudentId').val();
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
 var AdmissionFee = $('#AddmissionFee').val();
 var OnTc = $('#OnTc').val();
 var BloodGroupId = $('#BloodGroupId').val();
 var imgpath = $('#imagename').val();
 var BusFees = $('#BusFees').val();
 alert(StudentName);
  alert(DateOfBirth);
 if(validation()){

	 $.ajax({
					type: 'POST',
					url: '<?=$url?>student/save',
					data: 'StudentRollNo='+StudentRollNo+'&StudentName='+StudentName+'&FatherName='+FatherName+'&MotherName='+MotherName+'&FatherOccupation='+FatherOccupation+'&MotherOccupation='+MotherOccupation+'&DateOfBirth='+DateOfBirth+'&Gender='+Gender+'&Medium='+Medium+'&StudentClass='+StudentClass+'&SectionId='+SectionId+'&Town='+Town+'&Cast='+Cast+'&CastCategoryId='+CastCategoryId+'&NationalityId='+NationalityId+'&MotherTongueId='+MotherTongueId+'&PH='+PH+'&Address='+Address+'&PhoneNo='+PhoneNo+'&MobileNo='+MobileNo+'&Email='+Email+'&SectionId='+SectionId+'&AdmissionFee='+AdmissionFee+'&OnTc='+OnTc+'&BloodGroupId='+BloodGroupId+'&imgpath='+imgpath+'&BusFees='+BusFees,
					success: function(response){
							//alert(response);			
							if(response == 1){
								if($e == 1){
								     alert('Insert Successfully');
								}else{
									alert('Insert Successfully');
								}
							}else if(response == 2){
								alert('Recode already exists!..');	
							}else{
								alert('Insert Not Successfully');
							}
					}
						
			});
			
			}
					
}		
		
//-------------------------------------------------------------------------
/*--- for onchange event of class ---*/
function section_fun(){
	var ClassId = $('#StudentClass').val();
 		$.ajax({
				type: 'POST',
				url: '<?=$url?>student/section',
				data: 'ClassId='+ClassId,
				success: function(response){
				      //alert(response);
						if(response != ''){
							$('#SectionId').html(response);
						}
						
					}	
		});
}

function studentlist_fun(){
	var ClassId = $('#StudentClass').val();
	var SectionId = $('#SectionId').val();
 		$.ajax({
				type: 'POST',
				url: '<?=$url?>student/studentlist',
				data: 'ClassId='+ClassId+'&SectionId='+SectionId,
				success: function(response){
						if(response != ''){
							$('#ClassId').html(response);
						}
					}	
		});
		
}					
//--------------------------------------------------------------------------

</script>
<script type="text/javascript">    
 $(function(){
   var btnUpload=$('#upload');
   var adinfoid=$('#adinfoid').val();
   var imgpath = $('#imagename').val();
   new AjaxUpload(btnUpload, {
     action: '<?=$url?>student/photoupload',
     name: 'uploadfile',
     onSubmit: function(file, ext){
       if (! (ext && /^(jpg|png|jpeg|gif|JPG|PNG|JPEG|GIF)$/.test(ext))){
         $("#mainphotoerror").html('Only JPG, PNG, GIF, files are allowed');
         $("#mainphotoerror").css('display','block');
         return false;
       }        
     },
     onComplete: function(file, response){
       if(response){
	   	var arr = split(',', response );
			$('#filename').css('display', 'block').html('<span style = "color:#4bb30d">'+arr[0]+' File is uploaded.<span>');
			$('#imagename').val(imgpath.replace(imgpath, arr[1]));
       }else{
			$('#filename').css('display', 'block').html('<span style = "color:#f73a07">Fail to upload your file.<span>');
			$('#imagename').val(imgpath.replace(imgpath, ''));		 
       }
     }
   });  
 }); 
 
 $(function() {
 $( ".datepicker" ).datepicker({dateFormat: 'dd-mm-yy', changeMonth: true, changeYear: true, yearRange: '1950:<?=date('Y')?>' });
});   
</script>

<style>
#wizard{ width:auto; height:auto; position:absolute; left:50%; top:50%;}
</style>
