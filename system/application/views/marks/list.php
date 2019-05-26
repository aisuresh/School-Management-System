<?php

echo "<div class='container'>";
echo "<div class='content_header'>";
/*---------------     content title       ---------------------*/
echo "<div class='content_title'>";
echo $pagetitle.' > '. $event;
echo "</div>";
echo "<div class='content_message'>";

echo "<div class = 'search_area' title = 'search here' >";
echo "<span class='search_box'> <input type='text' name ='searchbox' id = 'searchbox' title='Select Search Option Using Arrow Button' ></span>";
echo "<span class='search_option'>"; 
echo "<ul style=' float:left;' id='nav'>";
echo "<li style = 'width:30px;' > <a href='#' class='selected'> <img src='". $url ."images/search_opt_btn.gif' /> </a>";
echo "<ul>";
echo "<li> <label> <input type='radio' name='searchfield' id ='searchfield' value='RollNo' /> Student Roll No </label> </li>";
echo "<li> <label> <input type='radio' name='searchfield' id ='searchfield' value='SubjectName' /> Subject </label> </li>";
echo "<li> <label> <input type='radio' name='searchfield' id ='searchfield' value='Marks' /> Marks </label> </li>";
echo "</ul>";
echo "</li>";
echo "</ul>";
echo "</span>";
echo "<span class='search_btn'> <a onClick='search_fun(this);' id = 'marks' > <img src='".$url ."images/search_btn.gif' /> </a> </span>";	
echo "</div>";

echo "</div>";
/*---------------     content events       ---------------------*/
echo "<div class='content_events'>";

echo "<div class='events'>";
echo "<a href='".$url."marks/export' >";
echo "<span><img src='".$url."images/export.gif' border='0' /></span>";
echo "<span>  Export  </span>";
echo "</a>";
echo "</div>";

echo "<div class='events'>";
echo "<a onclick='edit_data();' >";
echo "<span id ='id1'><img src='".$url."images/edit.png' border='0' /></span>";
echo "<span>  Edit  </span>";
echo "</a>";
echo "</div>";

echo "<div class='events'>";
echo "<a onclick='view_data();' >";
echo "<span id = 'id2'><img src='".$url."images/view.gif' border='0' /></span>";
echo "<span>  View  </span>";
echo "</a>";
echo "</div>";

echo "<div class='events'>";
echo "<a onClick='addnew_data();' >";
echo "<span id = 'id3'><img src='".$url."images/addnew.png' border='0' /></span>";
echo "<span>  Addnew  </span>";
echo "</a>";
echo "</div>";

echo "</div>";

/*echo "<div class='events' style = 'width:80px;'>";
echo "<a href='".$url."marks/marksrecords' style = 'width:80px;float:left;'>";
echo "<span style = 'width:80px;float:left;' ><img src='".$url."images/btn4.png' border='0' /></span>";
echo "<span style = 'width:80px;float:left;' >Records</span>";
echo "</a>";
echo "</div>";*/


echo "<div align = 'center' class='content'>";

$yearno = $this->Adminmodel->maxvalue($table = 'academicyear', $fields = array('AcademicYear'), $where = array());
foreach($yearno as $yno){
	if($yno->AcademicYear != NULL){
		$currentAcademicYear = $yno->AcademicYear;
	}
}
echo "<div align = 'center' class = 'showbox' >";
echo "<select name = 'ExamTypeId' id = 'ExamTypeId' onchange = 'examtypelist_show();' >";
echo "<option value = 'x'>- - ExamType - -</option>";
var_dump($exam);
foreach($exam as $row){
	echo "<option value = '".$row->ExamId."'>".$row->ExamType."</option>";
}
echo "</select>";
echo "</div>";

echo "<div align = 'center' class = 'showbox' >";
echo "<select name = 'StudentId' id = 'StudentId' >";
echo "<option value = 'x'>- - Student - -</option>";
echo "</select>";
echo "</div>";

echo "<div align = 'center' class = 'showbox' >";
echo "<select name = 'SectionId' id = 'SectionId' onchange = 'studentlist_fun();'  >";
echo "<option value = 'x'>- - Section - -</option>";
echo "</select>";
echo "</div>";

echo "<div align = 'center' class = 'showbox' >";
echo "<select name = 'Class' id = 'Class' onchange = 'section_fun();' >";
echo "<option value = 'x'>- - Class - -</option>";
foreach($course as $row){
	echo "<option value = '".$row->ClassId."'>".$row->ClassName."</option>";
}
echo "</select>";
echo "</div>";

echo "<div align = 'center' class = 'showboxa' >";
echo "<select name = 'Year' id = 'Year' style='width: 100px;' onchange = 'get_list();' >";
foreach( array_reverse($this->session->userdata('years')) as $ys){
	if($this->session->userdata('yearmx') == $ys->AcademicYear){
		echo "<option value = '".$ys->AcademicYear."' selected = 'selected'>".$ys->AcademicYear."</option>";
	}else{
		echo "<option value = '".$ys->AcademicYear."'>".$ys->AcademicYear."</option>";
	}	
}
echo "</select>";
echo "</div>";

echo "</div>";
//echo "</div>";


echo "<div align = 'center' class='content'>";

echo '<div id="examtypeshow" style="display:none; margin-top:10px;">';
echo '</div>';

echo '</div>';
echo "</div>";
echo "</div>";
/*---------------     content        ---------------------*/

echo "<input type = 'hidden' name = 'currentAcademicYear' id='currentAcademicYear' value = '". $currentAcademicYear ."' /> </th>";
?>
<script>
function edit_data(){
	var year = $('#Year').val();
	var currentAcademicYear = $('#currentAcademicYear').val();
	if(year != currentAcademicYear ){
		document.getElementById('id1').disabled = true;
	}else{
		var rollid = $('input:radio[name=MarksId]:checked').val();
		if(rollid == 'undefined' || rollid == null ){
			message('Please select any one record' );
		}else{
			window.location='<?=$url?>marks/edit/'+rollid;
		}
	}
}	

function view_data(){
   var year = $('#Year').val();
   var currentAcademicYear = $('#currentAcademicYear').val();
   if(year != currentAcademicYear ){
		document.getElementById('id2').disabled = true;
   }else{
		var rollid = $('input:radio[name=MarksId]:checked').val();	
		if(rollid == 'undefined' || rollid == null ){
			message('Please select any one record' );
		} else {
			window.location='<?=$url?>marks/view/'+rollid;
		}
	}
}	
function addnew_data(){	
    var year = $('#Year').val();
    var currentAcademicYear = $('#currentAcademicYear').val();
   if(year != currentAcademicYear ){
		document.getElementById('id3').disabled = true;
   }else{
		window.location='<?=$url?>marks/addnew/';
	}
	
}

function get_list(){
	var year = $('#Year').val();
	//alert(year);
	window.location='<?=$url?>marks/listview/'+year;
		
}	
function section_fun(){
	var ClassId = $('#Class').val();
	$.ajax({
			type: 'POST',
			url: '<?=$url?>marks/section',
			data: 'ClassId='+ClassId,
			success: function(response){
				if(response != ''){
					$('#SectionId').html(response);
				}
			}
				
	});
}

function studentlist_fun(){
	var ClassId = $('#Class').val();
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
function examtypelist_show(){
	var ClassId = $('#Class').val();
	var SectionId = $('#SectionId').val();
	var StudentId = $('#StudentId').val();
	var ExamTypeId = $('#ExamTypeId').val();
	var Year = $('#Year').val();
	//alert(StudentId);
	//alert(ExamTypeId);
	//alert(Year);
	$.ajax({
		  type: 'POST',
		  
		  url: '<?=$url?>marks/examtypelist1',
		  
		  data:'ClassId='+ClassId+'&SectionId='+SectionId+'&StudentId='+StudentId+'&ExamTypeId='+ExamTypeId+'&Year='+Year,
		  
		  success: function(response){ 
		//alert(response);
		  if(response != ''){
			$('#examtypeshow').show().html(response);
			}
		  }
			 
	});
}
</script>
<script src="<?php echo $url ?>themes/js/template.js"></script>
