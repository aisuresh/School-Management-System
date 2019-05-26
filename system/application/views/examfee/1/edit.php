<link rel="stylesheet" type="text/css" href="<?php echo $url .'css/calendar.css' ?>" />
<script type="text/javascript" src="<?php echo $url .'js/calendar/calendar_db.js' ?>"></script>

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
echo "<a href='".$url."examfee/listview/".$this->session->userdata('yearef')."'>";
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
foreach($result as $row):
echo "<input type='hidden' name = 'ExamFeeId' id = 'ExamFeeId' value = '".$row->ExamFeeId."' />";
echo "<tr>";
echo "<td align='right' width='15%' class = 'datafield' >Class <span class = 'mandatory'>*</span></td>";
echo "<td width='2%' class='spacetd' > </td>";
echo "<td width='33%' class = 'dataview' >";
echo "<select name = 'ClassId' id = 'ClassId' onChange = 'section_fun();' >";
echo "<option value = 'x'>- - Select Class - -</option>";
foreach($course as $rowa):
echo "<option value = '".$rowa->ClassId."' >";
echo $rowa->ClassName;
echo "</option>";
endforeach;
echo "</select>";
echo "</td></tr>";

echo "<tr>";
echo "<td align='right' width='15%' class = 'datafield' >Section<span class = 'mandatory'>*</span></td>";
echo "<td width='2%' class='spacetd' > </td>";
echo "<td width='33%' class = 'dataview' >";
echo "<select name = 'SectionId' id = 'SectionId' onchange = 'studentlist_fun();' >";
echo "<option value = 'x'>- - Select Section - -</option>";
echo "</select>";
echo "</td></tr>";


echo "<tr>";
echo "<td align='right' width='15%' class = 'datafield' >Student Roll No<span class = 'mandatory'>*</span></td>";
echo "<td width='2%' class='spacetd' > </td>";
echo "<td width='33%' class = 'dataview' >";
echo "<select name = 'RollNo' id = 'RollNo' >";
echo "<option value = 'x'>- - Select RollNo - -</option>";
echo "<option value = '".$row->RollNo."' selected = 'selected'>". $row->RollNo."</option>";
echo "</select>";
echo "</td></tr>";

echo "<tr>";
echo "<td align='right' width='15%' class = 'datafield' >Exam Fee<span class = 'mandatory'>*</span></td>";
echo "<td width='2%' class='spacetd' > </td>";
echo "<td width='33%' class = 'dataview' ><input type = 'text' name = 'ExamFee' id = 'ExamFee' value='".$row->ExamFee ."' onKeyUp='JsCheckNumber(this)' /></td>";
echo "</tr>";

echo "<tr>";
echo "<td align='right' width='15%' class = 'datafield' >Exam Type<span class = 'mandatory'>*</span></td>";
echo "<td width='2%' class='spacetd' > </td>";
echo "<td width='33%' class = 'dataview' >";
echo "<select name = 'ExamTypeId' id = 'ExamTypeId' >";
echo "<option value = 'x'>- - Select ExamType - -</option>";
foreach($examtype as $rowb):
	if($row->ExamTypeId == $rowb->ExamId){
		echo "<option value = '".$rowb->ExamId."' selected = 'selected' >";
		echo $rowb->ExamType;
		echo "</option>";
	}else{
		echo "<option value = '".$rowb->ExamId."' >";
		echo $rowb->ExamType;
		echo "</option>";
	}
endforeach;
echo "</select>";
echo "</td></tr>";

echo "<tr>";
echo "<td align='right' width='15%' class = 'datafield' >Recept No<span class = 'mandatory'>*</span></td>";
echo "<td width='2%' class='spacetd' > </td>";
echo "<td width='33%' class = 'dataview' ><input type = 'text' name = 'ReceptNo' id = 'ReceptNo' value = '".$row->ReceptNo."' onKeyUp='JsCheckNumber(this)' /> </td>";
echo "</tr>";

echo "<tr>";
echo "<td align='right' width='15%' class = 'datafield' >Paid Date<span class = 'mandatory'>*</span></td>";
echo "<td width='2%' class='spacetd' > </td>";
echo "<td width='33%' class = 'dataview' >";
echo "<form name='studentform'>";											
/*calendar attaches to existing form element*/
echo "<input type='text' name='PaidDate' id='PaidDate' readonly='readonly' />";
?> 							 
<script language="JavaScript">
    new tcal ({
        'formname': 'studentform',		
        'controlname': 'PaidDate'
    });						
</script>
<?php
echo "</form>";
echo "</td>";
echo "</tr>";

echo "<tr>";
echo "<td align='right' width='15%' class = 'datafield' >Description</td>";
echo "<td width='2%' class='spacetd' > </td>";
echo "<td width='33%' class = 'dataview' ><input type = 'text' name = 'ExamFeeDes' id = 'ExamFeeDes' value='".$row->ExamFeeDes."'/></td>";
echo "</tr>";

endforeach;
echo "</table>";

echo "</div>";
echo "</div>";
?>
<script>

function validation(){
	
	 var RollNo = $('#RollNo').val();
	 var ExamFee = $('#ExamFee').val();
	 var ExamTypeId = $('#ExamTypeId').val();
	 var ReceptNo =$('#ReceptNo').val();
	 var PaidDate = $('#PaidDate').val();
	 var ExamFeeDes = $('#ExamFeeDes').val();
 
	if(RollNo =='x'){
		$('#message').html('Student Roll No should not be blank').show().fadeOut('slow').fadeIn('slow');
		$('#RollNo').focus();
		return false;
	}else if(ExamFee == ''){
		$('#message').html('Exam Fee should not be blank').show().fadeOut('slow').fadeIn('slow');
		$('#ExamFee').focus();
		return false;
	}else if(ExamTypeId == 'x'){
		$('#message').html('Exam Type should not be blank').show().fadeOut('slow').fadeIn('slow');
		$('#ExamTypeId').focus();
		return false;
	}else if(ReceptNo == ''){
		$('#message').html('Recept No should not be blank').show().fadeOut('slow').fadeIn('slow');
		$('#ReceptNo').focus();
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
 
 var ExamFeeId = $('#ExamFeeId').val();
 var RollNo = $('#RollNo').val();
 var ExamFee = $('#ExamFee').val();
 var ExamTypeId = $('#ExamTypeId').val();
 var ReceptNo =$('#ReceptNo').val();
 var PaidDate = $('#PaidDate').val();
 var ExamFeeDes = $('#ExamFeeDes').val();
 if(validation()){
 	$.ajax({
				type: 'POST',
				url: '<?=$url?>examfee/update',
				data: 'ExamFeeId='+ExamFeeId+'&RollNo='+RollNo+'&ExamFee='+ExamFee+'&ExamTypeId='+ExamTypeId+'&ReceptNo='+ReceptNo+'&PaidDate='+PaidDate+'&ExamFeeDes='+ExamFeeDes,
				success: function(response){				
						if(response == 1){
							if($e == 1){
								window.location.href='<?=$url?>examfee/listview/<?=$this->session->userdata('yearef')?>';
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
				url: '<?=$url?>examfee/section',
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
				url: '<?=$url?>examfee/studentlist',
				data: 'ClassId='+ClassId+'&SectionId='+SectionId,
				success: function(response){
						if(response != ''){
							$('#RollNo').html(response);
						}
					}	
		});
}						


</script>
