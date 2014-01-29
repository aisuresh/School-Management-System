
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
echo '<tr><th colspan = "3" id = "table_title">Create New Exam Fees </th></tr>';
echo "<tr>";
echo "<td align='right' width='15%' class = 'datafield' >Class <span class = 'mandatory'>*</span></td>";
echo "<td width='2%' class='spacetd' > </td>";
echo "<td width='33%' class = 'dataview' >";
echo "<select name = 'ExamClass' id = 'ExamClass' onchange = 'section_fun();' >";
echo "<option value = 'x'>-- Select Class --</option>";
foreach($examfessclass as $row):
echo "<option value = '".$row->ClassId."' >";
echo $row->ClassName;
echo "</option>";
endforeach;
echo "</select>";
echo "</td></tr>";

echo "<tr>";
echo "<td align='right' width='15%' class = 'datafield' >Section<span class = 'mandatory'>*</span></td>";
echo "<td width='2%' class='spacetd' > </td>";
echo "<td width='33%' class = 'dataview' >";
echo "<select name = 'SectionId' id = 'SectionId' onchange = 'studentlist_fun();' >";
echo "<option value = 'x'>-- Select Section --</option>";
echo "</select>";
echo "</td></tr>";


echo "<tr>";
echo "<td align='right' width='15%' class = 'datafield' >Student Roll No<span class = 'mandatory'>*</span></td>";
echo "<td width='2%' class='spacetd' > </td>";
echo "<td width='33%' class = 'dataview' >";
echo "<select name = 'StudentId' id = 'StudentId' >";
echo "<option value = 'x'>-- RollNo --</option>";
echo "</select>";
echo "</td></tr>";

echo "<tr>";
echo "<td align='right' width='15%' class = 'datafield' >Exam Type<span class = 'mandatory'>*</span></td>";
echo "<td width='2%' class='spacetd' > </td>";
echo "<td width='33%' class = 'dataview' >";
echo "<select name = 'ExamType' id = 'ExamType' onchange = 'noofsubjects_fun();' >";
echo "<option value = 'x'>-- Select ExamType --</option>";
	foreach($examtype as $rowb):
	 if($rowb->InstituteId == $this->session->userdata('InstituteId'))
		{
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
echo "<select name = 'noofsubjects' id = 'noofsubjects' onchange = 'examfees_fun();'>";
echo "<option value = 'x'>-- Select no of subjects --</option>";
echo "</select>";
echo "</td></tr>";

echo "<tr>";
echo "<td align='right' width='15%' class = 'datafield' >Exam Fee<span class = 'mandatory'>*</span></td>";
echo "<td width='2%' class='spacetd' > </td>";
echo "<td width='33%' class = 'dataview' ><input type = 'text' name = 'ExamFee' id = 'ExamFee' onKeyUp='JsCheckNumber(this)' readonly='readonly'/></td>";
echo "</tr>";

echo "<tr>";
echo "<td align='right' width='15%' height = '40' class = 'datafield' >Subjects<span class = 'mandatory'>*</span></td>";
echo "<td width='2%' class='spacetd' > </td>";
echo "<td width='33%' class = 'dataview' id='subjectlist' >";
echo "<select name = 'Subjects' id = 'Subjects' multiple = 'multiple' size = '5' style = 'height:40px;' >";
echo "</select>";
echo "</td></tr>";

echo "<tr>";
echo "<td align='right' width='15%' class = 'datafield' >Paid Date<span class = 'mandatory'>*</span></td>";
echo "<td width='2%' class='spacetd' > </td>";
echo "<td width='33%' class = 'dataview' >";
echo "<input type='text' name='PaidDate' id='PaidDate' class='datepicker' readonly='readonly' />";
echo "</td>";
echo "</tr>";

echo "<tr>";
echo "<td align='right' width='15%' class = 'datafield' >Description</td>";
echo "<td width='2%' class='spacetd' > </td>";
echo "<td width='33%' class = 'dataview' ><input type = 'text' name = 'ExamFeeDes' id = 'ExamFeeDes' /></td>";
echo "</tr>";
echo "</table>";

echo "</div>";
echo "</div>";
?>
<script>

function validation(){
	var StudentId = $('#StudentId').val();
	var ExamFee = $('#ExamFee').val();
	var ExamClass = $('#ExamClass').val();
	var SectionId = $('#SectionId').val();
	var NoOfSubjects = $('#noofsubjects').val();
	var Subjects = $('#Subjects').val();
	//var ReceptNo =$('#ReceptNo').val();
	var PaidDate = $('#PaidDate').val();
 //alert(NoOfSubjects);

      if(ExamClass =='x'){
		$('#message').html('Student Class should not be blank').show().fadeOut('slow').fadeIn('slow');
		$('#ExamClass').focus();
		return false;
	}else if(StudentId =='x'){
		$('#message').html('Student Roll No should not be blank').show().fadeOut('slow').fadeIn('slow');
		$('#StudentId').focus();
		return false;
	}else if(SectionId =='x'){
		$('#message').html('Section should not be blank').show().fadeOut('slow').fadeIn('slow');
		$('#SectionId').focus();
		return false;
	}else if(ExamFee == ''){
		$('#message').html('Exam Fee should not be blank').show().fadeOut('slow').fadeIn('slow');
		$('#ExamFee').focus();
		return false;
	}else if(NoOfSubjects == 'x'){
		$('#message').html('No of subjects should not be blank').show().fadeOut('slow').fadeIn('slow');
		$('#noofsubjects').focus();
		return false;
	}else if((Subjects == 'x') || (NoOfSubjects != Subjects.length)){
		$('#message').html('You should select '+NoOfSubjects + ' subjects.').show().fadeOut('slow').fadeIn('slow');
		$('#Subjects').focus();
		return false;
	}else if(PaidDate == ''){
		$('#message').html('Paid Date should not be blank').show().fadeOut('slow').fadeIn('slow');
		$('#PaidDate').focus();
		return false;
	}else{
		return true;
	}
}

function save_data($e){

 
 var StudentId = $('#StudentId').val();
 var ExamFee = $('#ExamFee').val();
 var ExamClass = $('#ExamClass').val();
 var ExamType = $('#ExamType').val();
 var NoOfSubjects = $('#noofsubjects').val();
 var Subjects = $('#Subjects').val();
// var ReceptNo =$('#ReceptNo').val();
 var PaidDate = $('#PaidDate').val();
 var ExamFeeDes = $('#ExamFeeDes').val();
//alert(Subjects);
 if(validation()){
	 	$.ajax({
			type: 'POST',
			url: '<?=$url?>examfee/save',
			data: 'StudentId='+StudentId+'&ExamFee='+ExamFee+'&ExamClass='+ExamClass+'&ExamType='+ExamType+'&NoOfSubjects='+NoOfSubjects+'&Subjects='+Subjects+'&PaidDate='+PaidDate+'&ExamFeeDes='+ExamFeeDes,
			success: function(response){
			//alert(response);
				if(response == 1){
					if($e == 1){
						window.location.href='<?=$url?>examfee/listview/<?=$this->session->userdata('yearef')?>';
					}else{
						alert('Insert Successfully');
					}	
				}else if(response == 2){
				   
								alert('Record already exists!.');
							
				}else{
					alert('Insert Not Successfully');
				}
			}
					
		});
	}	
}

function section_fun(){
	var ExamClass = $('#ExamClass').val();
	$.ajax({
		type: 'POST',
		url: '<?=$url?>examfee/section',
		data: 'ExamClass='+ExamClass,
		success: function(response){
			if(response != ''){
				$('#SectionId').html(response);
			}
		}	
	});
}
function studentlist_fun(){
	var ExamClass = $('#ExamClass').val();
	var SectionId = $('#SectionId').val();
	//alert(SectionId);
 		$.ajax({
			type: 'POST',
			url: '<?=$url?>examfee/studentlist',
			data: 'ExamClass='+ExamClass+'&SectionId='+SectionId,
			success: function(response){
				if(response != ''){
					$('#StudentId').html(response);
				}
			}	
		});
}

function noofsubjects_fun(){
	var ExamClass = $('#ExamClass').val();
	$.ajax({
		type: 'POST',
		url: '<?=$url?>examfee/noofsubjects',
		data: 'ExamClass='+ExamClass,
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
       //alert(ClassId);
	   //alert(noofsubjects);
	 if(noofsubjects != 'x'){
		 $.ajax({
			type: 'POST',
			url: '<?=$url?>examfee/examfees',
			data: 'ExamClass='+ExamClass+'&noofsubjects='+noofsubjects,
			success: function(response){	
			   //alert(response);		
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
