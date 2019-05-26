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
echo '<tr><th colspan = "3" id = "table_title">Create Marks Information</th></tr>';

/*foreach($result as $row):
echo "<input type='hidden' name = 'MarksId' id = 'MarksId' value = '".$row->MarksId."'";*/
echo "<tr>";
echo "<td align='right' width='15%' class = 'datafield' >Exam Type<span class = 'mandatory'>*</span></td>";
echo "<td width='2%' class='spacetd' > </td>";
echo "<td width='33%' class = 'dataview' >";
echo "<select name = 'ExamTypeId' id = 'ExamTypeId' onchange='exammarks();'>";
echo "<option value = 'x'>- - Select Exam - -</option>";
foreach($examtype as $rowb):
echo "<option value = '".$rowb->ExamId."' >";
echo $rowb->ExamType;
echo "</option>";
endforeach;
echo "</select>";
echo "</td></tr>";

echo "<tr>";
echo "<td align='right' width='15%' class = 'datafield' >Maximum Marks<span class = 'mandatory'>*</span></td>";
echo "<td width='2%' class='spacetd' > </td>";
echo "<td width='33%' class = 'dataview' ><label name = 'ExamMarks' id = 'ExamMarks' /> </td>";
echo "</tr>";

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
echo "<select name = 'SectionId' id = 'SectionId' onChange = 'studentlist_fun();' >";
echo "<option value = 'x'>- - Select Section - -</option>";
echo "</select>";
echo "</td></tr>";


echo "<tr>";
echo "<td align='right' width='15%' class = 'datafield' >Student Roll No<span class = 'mandatory'>*</span></td>";
echo "<td width='2%' class='spacetd' > </td>";
echo "<td width='33%' class = 'dataview' >";
echo "<select name = 'StudentId' id = 'StudentId' onchange = 'subject_fun();'>";
echo "<option value = 'x'>- - Select RollNo - -</option>";
echo "</select>";
echo "</td></tr>";
echo "</table>";
//echo "<div align = 'center' class='content'>";
echo '<div id="showsubjectlist" style="display:none; margin-top:10px;">';
//echo "</div>";
echo "</div>";
echo "</div>";
//echo "</div>";
?>
<link rel="stylesheet" type="text/css" href="<?php echo $url .'css/calendar.css' ?>" />
<script type="text/javascript" src="<?php echo $url .'js/calendar/calendar_db.js' ?>"></script>
<script type="text/javascript" src="<?php echo $url .'js/calendar/calendar_eu.js' ?>"></script>
<script type="text/javascript" src="<?php echo $url .'js/calendar/calendar_us.js' ?>"></script>
<script>
function validation(){

     
	 var ExamTypeId = $('#ExamTypeId').val();
	 var StudentId = $('#StudentId').val();
	 var ClassId = $('#ClassId').val();
	 var SectionId = $('#SectionId').val();
	 
	 if(ExamTypeId == 'x'){
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
			var marksarray;
	 		var i=0;
  			 $('input[type="text"]').each(function(i){
			 //var j=i;
  					marksarray =  $(this).val();
				if(marksarray == ''){
						$('#message').html('Mark should not be blank').show().fadeOut('slow').fadeIn('slow');        
						//$(this).attr('name').focus();
						
						
						//alert("mark-"+marksarray+"-");
						validation = false;
						//return false;
						   
				  } 
				  if(marksarray > maxmarks){
    						$('#message').html('Mark can not be greater than maximum mark').show().fadeOut('slow').fadeIn('slow');
							
							//(this).attr('name').focus();
							alert("mark1-"+marksarray+"-");
							alert("max-"+maxmarks+"-");
							validation = false;
							//return false;
						
					}i++;	
			}); 
			
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
function save_data($e){
      
	 var ExamTypeId = $('#ExamTypeId').val();
	 var StudentId =$('#StudentId').val();
	 //var SubjectId = $("#"+$row->SubjectId).text();
	 var marksarray=[];
	 var i=0;
	 var marks='';
     $('input[type="text"]').each(function(){
	 			    
        marks =  $(this).val();
		marksarray[i]=marks;
		i++;
		
     });
	 
	 
	 
var subjectarray=[];
 var i=0;
 var subject='';
     $('label[name="sub"]').each(function(){         
        subject =  $(this).attr('id');
		subjectarray[i]=subject;
  		i++;
  
     });
	 
	 /*$('input').each(function() {
    
        var sub1 = $('label[for="' + this.id + '"]').html();
    
	});*/
	
	/*$('.input').each(function() { 
	   $this = $(this);
	   var sub1 = $('label[for="'+ $this.attr('sub') +'"]');
	   //alert(sub1.text());
   
	});*/
	 
	
	 //alert(marksarray);
	 //alert(subjectarray);
	 	 if(validation()){
 		$.ajax({
			type: 'POST',
			url: '<?=$url?>marks/save',
			data: 'ExamTypeId='+ExamTypeId+'&StudentId='+StudentId+'&marksarray='+marksarray+'&subjectarray='+subjectarray,
			success: function(response){
			alert(response);			
					if(response == 1){
						if($e == 1){
							window.location.href='<?=$url?>marks/listview/<?=$this->session->userdata('yearmx')?>';
						}else{
							alert('Insert Successfully');
						}	
					}else{
						alert('Insert Not Successfully');
					}
				}
		});
		
	}	
}
/*function get_subjects_fun(){
	var Class = $('#ClassId').val();
 		$.ajax({
			type: 'POST',
			url: 'marks/subjectlist',
			data: 'Class='+Class,
			success: function(response){
				if(response != ''){
					$('#ClassId').html(response);
				}
			}	
		});
}*/
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

function section_fun(){
	var ClassId = $('#ClassId').val();
 		$.ajax({
				type: 'POST',
				url: '<?=$url?>marks/section',
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
	var ClassId = $('#ClassId').val();
	var SectionId = $('#SectionId').val();
 		$.ajax({
				type: 'POST',
				url: '<?=$url?>marks/studentlist',
				data: 'ClassId='+ClassId+'&SectionId='+SectionId,
				success: function(response){
						if(response != ''){
							$('#StudentId').html(response);
						}
					}	
		});
}						
function subject_fun(){
	var ClassId = $('#ClassId').val();
	//alert(Class);
	$.ajax({
				type: 'POST',
				url: '<?=$url?>marks/subjectlist',
				data: 'ClassId='+ClassId,
				success: function(response){
				//alert(response);
						if(response != ''){
							$('#showsubjectlist').show().html(response);
						}
					}	
		});
}											
</script>
