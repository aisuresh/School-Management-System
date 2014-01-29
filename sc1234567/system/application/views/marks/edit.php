
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
echo "<a href='".$url."marks/listview/".$this->session->userdata('yearmx')."'>";
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
echo "<span class = 'mandatory'>*</span> Specipied fileds are mandatory";
echo "<table  border='0' cellpadding='0' cellspacing = '0' class='formtable'>";
var_dump($result);
foreach($result as $row):
echo "<input type='hidden' name = 'MarksId' id = 'MarksId' value = '".$row->MarksId."' />";

echo "<tr>";
echo "<td align='right' width='15%' class = 'datafield' >ExamType<span class = 'mandatory'>*</span></td>";
echo "<td width='2%' class='spacetd' > </td>";
echo "<td width='10%' class = 'dataview' >";
echo "<select name = 'ExamTypeId' id = 'ExamTypeId'>";
echo "<option value = 'x'>- - Select ExamType - -</option>";
echo "<option value = '".$row->ExamTypeId."' selected='selected' >".$row->ExamType."</option>";
echo "</select>";
echo "</td></tr>";

echo "<tr>";
echo "<td align='right' width='15%' class = 'datafield' >Maximum Marks<span class = 'mandatory'>*</span></td>";
echo "<td width='2%' class='spacetd' > </td>";
echo "<td width='10%' class = 'dataview' ><label name = 'ExamMarks' id = 'ExamMarks' />".$row->ExamMarks." </td>";
echo "</tr>";

echo "<tr>";
echo "<td align='right' width='15%' class = 'datafield' >Class<span class = 'mandatory'>*</span></td>";
echo "<td width='2%' class='spacetd' > </td>";
echo "<td width='10%' class = 'dataview' >";
echo "<select name = 'ClassId' id = 'ClassId' >";
echo "<option value = 'x'>- - Select Class - -</option>";
foreach($course as $co){
	if($row->StudentClass == $co->ClassId){
		echo "<option value = '".$co->ClassId."' selected>";
		echo $co->ClassName;
		echo "</option>";
	}else{
		echo "<option value = '".$co->ClassId."' >";
		echo $co->ClassName;
		echo "</option>";
	}
}
echo "</select>";
echo "</td></tr>";



echo "<tr>";
echo "<td align='right' width='15%' class = 'datafield' >Section<span class = 'mandatory'>*</span></td>";
echo "<td width='2%' class='spacetd' > </td>";
echo "<td width='10%' class = 'dataview' >";
echo "<select name = 'SectionId' id = 'SectionId'>";
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
echo "<td width='10%' class = 'dataview' >";
echo "<select name = 'StudentId' id = 'StudentId'>";
echo "<option value = 'x'>- - Select RollNo - -</option>";
echo "<option value = '".$row->StudentId."' selected >";
echo $row->RollNo;
echo "</option>";
echo "</select>";
echo "</td></tr>";
endforeach;
echo "</table>";
//-------------------------another table----------------------------
echo "<div align='center' class='content'>";
echo "<table border='0' cellpadding='0' cellspacing = '0' class='formtable'>";
//var_dump($result);

$i=1;
foreach($result as $row):
$markarray = explode(',', $row->Marks);	
$subarray = explode(',', $row->SubjectId);	
$i=0;
foreach($subject as $rowa):

	$sujectarray[$i]=$rowa->SubjectName;
	$i++;
endforeach;
$combinearray=array_combine($subarray,$markarray);
foreach($combinearray as $com=>$value):
echo "<tr>";
echo "<td align='right' width='15%' class = 'datafield' ><label for='sub' name='sub' id='sub' >";
foreach($subject as $sub):
if($sub->SubjectId==$com){
echo $sub->SubjectName;
}
endforeach;
echo "<span class = 'mandatory'>*</span></label></td>";
echo "<td width='2%' class='spacetd' > </td>";
echo "<td width='15%' class = 'dataview' ><input type = 'text' name = 'mark".$i."' id = 'mark".$i."' value = '".$value."' />";
echo "</td>";

//echo "<td width='2%' class='spacetd' > </td>";
 
echo "<td width='15%' class = 'dataview' id = 'showstatus'  >";
echo "<label id='status".$i."' name='status'  ><font color='red'> </font>	</label>";
echo "</td>";

echo "</tr>";
endforeach; 
$i++;
endforeach;

echo "</table>";


echo "</div>";
echo "</div>";
?>
<script>

function validation(){
	 var MarksId = $('#MarksId').val();
	 var ExamTypeId = $('#ExamTypeId').val();
	 var StudentId = $('#StudentId').val();
	 var ClassId = $('#ClassId').val();
	 var SectionId = $('#SectionId').val();
	 var marksarray;
	 var i=0;
	 
	 	 
	    if(MarksId == ''){
		$('#message').html('MarksId Type should not be blank').show().fadeOut('slow').fadeIn('slow');
		$('#MarksId').focus();
		return false;
	}else if(ExamTypeId == 'x'){
		$('#message').html('Exam Type should not be blank').show().fadeOut('slow').fadeIn('slow');
		$('#ExamTypeId').focus();
		return false;
	}else if(ClassId == 'x'){
		$('#message').html('Class should not be blank').show().fadeOut('slow').fadeIn('slow');
		$('#ClassId').focus();
		return false;
	}else if(SectionId == 'x'){
		$('#message').html('Section should not be blank').show().fadeOut('slow').fadeIn('slow');
		$('#SectionId').focus();
		return false;
	}else if(StudentId == 'x'){
		$('#message').html('Student should not be blank').show().fadeOut('slow').fadeIn('slow');
		$('#StudentId').focus();
		return false;
	}else 
		 {
   			var validation=true; 
			var maxmarks =$('#ExamMarks').text().trim();
			
  			 $('input[type="text"]').each(function(i){
			 
  					marksarray =  $(this).val();
				if(marksarray == ''){
						$('#message').html('Mark should not be blank').show().fadeOut('slow').fadeIn('slow');        
						//$(this).attr('name').focus();
						alert("mark-"+marksarray+"-");
						validation = false;
						//return false;
						   
				  }/*else 
				  if(marksarray > maxmarks){
    						$('#message').html('Mark can not be greater than maximum mark').show().fadeOut('slow').fadeIn('slow');
							//$(this).focus();
							alert("mark1-"+marksarray+"-");
							alert("max-"+maxmarks+"-");
							validation = false;
							//return false;
							
					}*/
			}); i++;
			
			alert(validation);
			return validation;
	} /* 
		if(ma[i] == ''){
    $('#message').html('Mark should not be blank').show().fadeOut('slow').fadeIn('slow');
    $(this).focus();
    validation = false;
  }else if(ma[i] > max.mark){
    $('#message').html('Mark can not be greater than maximum mark defined').show().fadeOut('slow').fadeIn('slow');
    $(this).focus();
    validation = false;
  }
  i++;*/
	
	/*if(1){
	$('input[type="text"]').each(function(){
		ma[i] =  $(this).val();
			if(ma[i] == ''){
				$('#message').html('Marks should not be blank').show().fadeOut('slow').fadeIn('slow');
				$('#StudentId').focus();
				return false;
			}i++;
			});
			} else { 
				return true;
			}
			-----}else {
		marksvalidation();
	}
	function marksvalidation(){
		if(1){
		$('input[type="text"]').each(function(){
		
			ma[i] =  $(this).val();
	 		if(ma[i] == ''){
				$('#message').html('Marks should not be blank').show().fadeOut('slow').fadeIn('slow');
				$('#StudentId').focus();
				
				return false;
			}i++;
			});
			} else 
				return true;
	}*/
	
	 
	 
}

function update_data($e){
	 var MarksId = $('#MarksId').val();
	 var ExamTypeId = $('#ExamTypeId').val();
	 var StudentId = $('#StudentId').val();
	 alert(MarksId);alert(ExamTypeId);alert(StudentId);
	 
     var marksarray=[];
	 var i=0;
	 var marks='';
     $('input[type="text"]').each(function(){
	 			    
        marks =  $(this).val();
		marksarray[i]=marks;
		i++;
		
     });
	 alert(marksarray);
	 
	 if(validation()){
 		$.ajax({
			type: 'POST',
			url: '<?=$url?>marks/update',
			data: 'MarksId='+MarksId+'&ExamTypeId='+ExamTypeId+'&StudentId='+StudentId+'&marksarray='+marksarray,
			success: function(response){
			alert(response);			
					if(response == 1){
						if($e == 1){
							window.location.href='<?=$url?>marks/listview/<?=$this->session->userdata('yearmx')?>';
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
function exammarks(){
	 var ExamTypeId = $('#ExamTypeId').val();
 	 $.ajax({
			type: 'POST',
			url: '<?=$url?>marks/examtype',
			data: 'ExamTypeId='+ExamTypeId,
			success: function(response){
					if(response != ''){
						var exammarks = $('#ExamMarks').text();
						$('#ExamMarks').text(exammarks.replace(exammarks, response ));
					}else{
						alert('Please set exam marks');
					}
			}
					
	 });
}	


function courseyear_fun(){
	var ClassId = $('#StudentClass').val();
	$.ajax({
		type: 'POST',
		url: '<?=$url?>student/courseyear',
		data: 'ClassId='+ClassId,
		success: function(response){
			if(response != ''){
				$('#CourseYearId').html(response);
			}
		}	
	});
}		

function group_fun(){
	var CourseId = $('#StudentClass').val();
	var YearId = $('#CourseYearId').val();
	$.ajax({
		type: 'POST',
		url: '<?=$url?>student/group',
		data: 'CourseId='+CourseId+'&YearId='+YearId,
		success: function(response){
			if(response != ''){
				$('#GroupId').html(response);
			}
		}	
	});
}		
		
function section_fun(){
	var ClassId = $('#ClassId').val();
 		$.ajax({
				type: 'POST',
				url: '<?=$url?>attendence/section',
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
				url: '<?=$url?>attendence/studentlist',
				data: 'ClassId='+ClassId+'&SectionId='+SectionId,
				success: function(response){
				//alert(response);
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


