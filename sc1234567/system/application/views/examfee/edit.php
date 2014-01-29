

<?php
echo link_tag('css/jquery-ui.css');
echo link_tag('css/prettify.css');
echo link_tag('css/jquery.multiselect.css');
echo script_tag('themes/js/dropdown/jquery-ui.min.js');
echo script_tag('themes/js/dropdown/prettify.js');
echo script_tag('themes/js/dropdown/jquery.multiselect.js');

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
//var_dump($result);
foreach($result as $row):
echo "<input type='hidden' name = 'ExamFeeId' id = 'ExamFeeId' value = '".$row->ExamFeeId."' />";
echo "<tr>";
echo "<td align='right' width='15%' class = 'datafield' >Class <span class = 'mandatory'>*</span></td>";
echo "<td width='2%' class='spacetd' > </td>";
echo "<td width='33%' class = 'dataview' >";
echo "<select name = 'ExamClass' id = 'ExamClass' onChange = 'section_fun();' >";
echo "<option value = 'x'>- - Select Class - -</option>";
foreach($course as $rowa):
	if($row->ExamFeeClass == $rowa->ClassId){
		echo "<option value = '".$rowa->ClassId."' selected ='selected'>".$rowa->ClassName."</option>";
	}else{
		echo "<option value = '".$rowa->ClassId."' >".$rowa->ClassName."</option>";
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
	if($sc->SectionId == $row->SectionId){
		echo"<option value  = '".$sc->SectionId."' selected >".$sc->SectionName."</option>";
	}
	else{
	echo"<option value  = '".$sc->SectionId."' >".$sc->SectionName."</option>";
	}
	    
}	
echo "</select>";
echo "</td></tr>";


echo "<tr>";
echo "<td align='right' width='15%' class = 'datafield' >Student Roll No<span class = 'mandatory'>*</span></td>";
echo "<td width='2%' class='spacetd' > </td>";
echo "<td width='33%' class = 'dataview' >";
$this->table = 'studentclass';
$this->where = array(
	array('condition' => $this->table.'.StudentClass', 'value' => $row->ExamFeeClass),
	array('condition' => $this->table.'.SectionId', 'value' => $row->SectionId),
	//array('condition' => $table.'.InstituteId', 'value' => $this->session->userdata('InstituteId')),
);
$rollno = $this->Adminmodel->show_rows($this->table, $this->where);
echo "<select name = 'StudentId' id = 'StudentId' >";
echo "<option value = 'x'>- - Select RollNo - -</option>";
foreach($rollno as $ro){
	if($row->StudentId == $ro->StudentId){
		echo "<option value = '".$row->StudentId."' selected = 'selected'>". $row->RollNo."</option>";
	}else{
		echo "<option value = '".$row->StudentId."' >". $row->RollNo."</option>";
	}
}		
echo "</select>";
echo "</td></tr>";

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
echo "<td align='right' width='15%' class = 'datafield' >No of subjects<span class = 'mandatory'>*</span></td>";
echo "<td width='2%' class='spacetd' > </td>";
echo "<td width='33%' class = 'dataview' >";
$table = 'classexamfeestype';
$where = array(
		 	array('condition' => $table.'.ClassId', 'value' => $row->ExamFeeClass)
		);
$classsubject =$this->Adminmodel->show_rows($table, $where);
echo "<select name = 'noofsubjects' id = 'noofsubjects' onchange = 'examfees_fun();'>";
echo "<option value = 'x'>-- Select no of subjects --</option>";
foreach($classsubject as $rowb1):
	if($row->NoOfSubjects == $rowb1->NoOfSubjects){
		echo "<option value = '".$rowb1->NoOfSubjects."' selected = 'selected' >";
		echo $rowb1->NoOfSubjects;
		echo "</option>";
	}else{
		echo "<option value = '".$rowb1->NoOfSubjects."' >";
		echo $rowb1->NoOfSubjects;
		echo "</option>";
	}
endforeach;
echo "</select>";
echo "</td></tr>";

echo "<tr>";
echo "<td align='right' width='15%' class = 'datafield' >Exam Fee<span class = 'mandatory'>*</span></td>";
echo "<td width='2%' class='spacetd' > </td>";
echo "<td width='33%' class = 'dataview' ><input type = 'text' name = 'ExamFee' id = 'ExamFee' value='".$row->ExamFee ."' onKeyUp='JsCheckNumber(this)' /></td>";
echo "</tr>";

echo "<tr>";
echo "<td align='right' width='15%' height = '40' class = 'datafield' >Subjects<span class = 'mandatory'>*</span></td>";
echo "<td width='2%' class='spacetd' ></td>";
echo "<td width='33%' class = 'dataview' id ='subjectlist' >";
echo "<select name = 'Subjects' id = 'Subjects' multiple = 'multiple' size = '5' style = 'height:140px;'>";
$subarray = explode(',',$row->Subjects);
$table = 'classsubject';
$where = array(
		 	array('condition' => $table.'.ClassId', 'value' => $row->ExamFeeClass)
		);
$tjoin = array(
		 	array('TableName' => 'subject', 'Condition' => $table.'.SubjectId = subject.SubjectId'),
		);
$classsubject1 =$this->Adminmodel->fetch_row_where( $where, $table,$tjoin);
//echo "<option value = 'x'>-- Select no of subjects --</option>";
foreach($classsubject1 as $sub){
  for($i=0;$i<count($subarray);$i++){
	  if($subarray[$i]==$sub->SubjectId){
			echo "<option value = '".$sub->SubjectId."' selected = 'selected' >";
			echo $sub->SubjectName;
			echo "</option>";
		}else{
			echo "<option value = '".$sub->SubjectId."' >";
			echo $sub->SubjectName;
			echo "</option>";
		}
	}
}
echo "</select></td>";
echo '<script>
			$(document).ready(function(){
				$("#Subjects").multiselect({
					noneSelectedText: "Subject List";
				});
			
			});
		</script>' ;

echo "</td></tr>";


echo "<tr>";
echo "<td align='right' width='15%' class = 'datafield' >Recept No<span class = 'mandatory'>*</span></td>";
echo "<td width='2%' class='spacetd' > </td>";
echo "<td width='33%' class = 'dataview' ><input type = 'text' name = 'ReceiptNo' id = 'ReceiptNo' value = '".$row->ReceiptNo."' onKeyUp='JsCheckNumber(this)' /> </td>";
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
echo "<td width='33%' class = 'dataview' ><input type = 'text' name = 'ExamFeeDes' id = 'ExamFeeDes' value='".$row->ExamFeeDes."'/></td>";
echo "</tr>";

endforeach;
echo "</table>";

echo "</div>";
echo "</div>";
?>
<script>

function validation(){

	 var ExamClass = $('#ExamClass').val();
	 var SectionId = $('#SectionId').val();
	 var StudentId = $('#StudentId').val();
	 var ExamFee = $('#ExamFee').val();
	 var ExamTypeId = $('#ExamTypeId').val();
	 var NoOfSubjects = $('#noofsubjects').val();
	 var Subjects = $('#Subjects').val();
	 var ReceiptNo =$('#ReceiptNo').val();
	 var PaidDate = $('#PaidDate').val();
	 var ExamFeeDes = $('#ExamFeeDes').val();
	 
    if(ExamClass == 'x'){
	 	$('#message').html('Class should not be blank').show().fadeOut('slow').fadeIn('slow');
		$('#ExamClass').focus();
		return false;
	 }else if(SectionId == 'x'){
	 	$('#message').html('Section should not be blank').show().fadeOut('slow').fadeIn('slow');
		$('#SectionId').focus();
		return false;
	}else if(StudentId =='x'){
		$('#message').html('Student Roll No should not be blank').show().fadeOut('slow').fadeIn('slow');
		$('#StudentId').focus();
		return false;
	}else if(ExamFee == ''){
		$('#message').html('Exam Fee should not be blank').show().fadeOut('slow').fadeIn('slow');
		$('#ExamFee').focus();
		return false;
		}else if(NoOfSubjects == 'x'){
		$('#message').html('No of subjects should not be blank').show().fadeOut('slow').fadeIn('slow');
		$('#noofsubjects').focus();
		return false;
	}else if(ExamTypeId == 'x'){
		$('#message').html('Exam Type should not be blank').show().fadeOut('slow').fadeIn('slow');
		$('#ExamTypeId').focus();
		return false;
	}else if(ReceiptNo == ''){
		$('#message').html('Recept No should not be blank').show().fadeOut('slow').fadeIn('slow');
		$('#ReceiptNo').focus();
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
 var ExamClass = $('#ExamClass').val();
 var SectionId = $('#SectionId').val();
 var ExamFeeId = $('#ExamFeeId').val();
 var StudentId = $('#StudentId').val();
 var ExamFee = $('#ExamFee').val();
 var ExamTypeId = $('#ExamTypeId').val();
 var NoOfSubjects = $('#noofsubjects').val();
  var Subjects = $('#Subjects').val();
 var ReceiptNo =$('#ReceiptNo').val();
 var PaidDate = $('#PaidDate').val();
 var ExamFeeDes = $('#ExamFeeDes').val();
 //alert(Subjects);
 if(validation()){
 	$.ajax({
				type: 'POST',
				url: '<?=$url?>examfee/update',
				data:  '&ExamClass='+ExamClass+'&SectionId='+SectionId+'&ExamFeeId='+ExamFeeId+'&StudentId='+StudentId+'&ExamFee='+ExamFee+'&ExamTypeId='+ExamTypeId+'&NoOfSubjects='+NoOfSubjects+'&Subjects='+Subjects+'&ReceiptNo='+ReceiptNo+'&PaidDate='+PaidDate+'&ExamFeeDes='+ExamFeeDes,
				success: function(response){				
						if(response == 1){
						//alert(response);
							if($e == 1){
								window.location.href='<?=$url?>examfee/listview/<?=$this->session->userdata('yearef')?>';
							}else{
								alert('Update Successfully');
							}
						}else if(response == 2){
				   
								alert('Record already exists!.');
							
						}else{
							alert('Update Not Successfully');
						}
					}
					
		});
	}	
}

function section_fun(){
	var ExamClass= $('#ExamClass').val();
 		$.ajax({
				type: 'POST',
				url: '<?=$url?>examfee/section',
				data: ' ExamClass='+ ExamClass,
				success: function(response){
				    //alert(response);
						if(response != ''){
							$('#SectionId').html(response);
						}
					}	
		});
}

function studentlist_fun(){
	var  ExamClass = $('#ExamClass').val();
	var SectionId = $('#SectionId').val();
	//alert(ExamClass);
 		$.ajax({
				type: 'POST',
				url: '<?=$url?>examfee/studentlist',
				data: ' ExamClass='+ ExamClass+'&SectionId='+SectionId,
				success: function(response){
						if(response != ''){
							$('#StudentId').html(response);
						}
					}	
		});
}
function noofsubjects_fun(){
	var  ExamClass = $('# ExamClass').val();
	$.ajax({
		type: 'POST',
		url: '<?=$url?>examfee/noofsubjects',
		data: ' ExamClass='+ ExamClass,
		success: function(response){
			if(response != ''){
				$('#noofsubjects').html(response);
			}
		}	
	});
}													
function examfees_fun(){
 	 var ExamClass = $('#ExamClass').val();
	 var noofsubjects = $('#noofsubjects').val();
	 var ExamFee = $('#ExamFee').val();
       //alert(ExamClass);
	   //alert(noofsubjects);
	 if(noofsubjects != 'x'){
		 $.ajax({
			type: 'POST',
			url: '<?=$url?>examfee/examfees',
			data: ' ExamClass='+ ExamClass+'&noofsubjects='+noofsubjects,
			success: function(response){	
			   alert(response);		
				if(response != ''){
					var arrayval = response.split('====');
					$('#ExamFee').val(ExamFee.replace(ExamFee, arrayval[0]));
					$('#subjectlist').html(arrayval[1]);
				}else{
					alert('Please set exam marks');
				}
			}
		});
	}else{
		$('#ExamFee').val(ExamFee.replace(ExamFee, ''));
	}	
}				
	$(document).ready(function(){
		$("#Subjects").multiselect({
			noneSelectedText: 'Subject List'
		});
		
	});
$(function() {
 $( ".datepicker" ).datepicker({dateFormat: 'dd-mm-yy' });
});	


</script>
