<?php

echo "<div class='container'>";
echo "<div class='content_header'>";
/*---------------     content title       ---------------------*/
echo "<div class='content_title'>";
echo $pagetitle.' > '. $event;
echo "</div>";
echo "<div class='content_message'>";
//search area starts here ------------------------
echo "<div class = 'search_area' title = 'search here' >";
echo "<span class='search_box'> <input type='text' name ='searchbox' id = 'searchbox' title='Select Search Option Using Arrow Button' ></span>";
echo "<span class='search_option'>"; 
echo "<ul style=' float:left;' id='nav'>";
echo "<li style = 'width:30px;' > <a href='#' class='selected'> <img src='". $url ."images/search_opt_btn.gif' /> </a>";
echo "<ul>";
echo "<li> <label> <input type='radio' name='searchfield' id ='searchfield' value='RollNo' />  Roll No </label> </li>";
echo "<li> <label> <input type='radio' name='searchfield' id ='searchfield' value='student.StudentName' /> Student Name </label> </li>";
echo "<li> <label> <input type='radio' name='searchfield' id ='searchfield' value='attendence.MonthName' /> Month Name </label> </li>";
echo "</ul>";
echo "</li>";
echo "</ul>";
echo "</span>";
echo "<span class='search_btn'> <a onClick='search_fun(this);' id = 'attendence' > <img src='".$url ."images/search_btn.gif' /> </a> </span>";	

echo "</div>";
echo "</div>";
/*---------------     content events       ---------------------*/
echo "<div class='content_events'>";

echo "<div class='events'>";
echo "<a href='".$url."attendence/export' >";
echo "<span><img src='".$url."images/export.gif' border='0' /></span>";
echo "<span>  Export  </span>";
echo "</a>";
echo "</div>";

echo "<div class='events'>";
echo "<a onClick='edit_data();' >";
echo "<span id ='id1'><img src='".$url."images/edit.png' border='0'  /></span>";
echo "<span>  Edit  </span>";
echo "</a>";
echo "</div>";

echo "<div class='events'>";
echo "<a  onClick='view_data();' >";
echo "<span id = 'id2'><img src='".$url."images/view.gif' border='0' /></span>";
echo "<span>  View  </span>";
echo "</a>";
echo "</div>";

echo "<div class='events'>";
echo "<a  onClick='addnew_data();'>";
echo "<span id = 'id3'><img src='".$url."images/addnew.png' border='0'  /></span>";
echo "<span>  Addnew  </span>";
echo "</a>";
echo "</div>";


echo '<a href = "#" ></a>';
echo "</div>";



echo "<div align = 'center' class='content'>";
$yearno = $this->Adminmodel->maxvalue($table = 'academicyear', $fields = array('AcademicYear'), $where = array());
foreach($yearno as $yno){
	if($yno->AcademicYear != NULL){
		$currentAcademicYear = $yno->AcademicYear;
	}
}



echo "<div  align='center' class = 'showbox' >";
echo "<select name = 'SectionId' id = 'SectionId'  onChange = 'studentlist_show();' >";
echo "<option value = 'x'>- - Section - -</option>";
echo "</select>";
echo "</div>";

echo "<div  align='center' class = 'showbox' >";
echo "<select name = 'Class' id = 'Class' onchange = 'get_section();' >";
echo "<option value = 'x'>- - Class - -</option>";
foreach($course as $row){
	echo "<option value = '".$row->ClassId."'>".$row->ClassName."</option>";
}
echo "</select>";
echo "</div>";

echo "<div  align='center' class = 'showboxa' >";
echo "<select name = 'Year' id = 'Year' style='width: 100px;' onchange = 'get_list();' >";
foreach( array_reverse($this->session->userdata('years')) as $ys){
	if($this->session->userdata('yearsh') == $ys->AcademicYear){
		echo "<option value = '".$ys->AcademicYear."' selected = 'selected'>".$ys->AcademicYear."</option>";
	}else{
		echo "<option value = '".$ys->AcademicYear."'>".$ys->AcademicYear."</option>";
	}	
}
echo "</select>";


echo "</div>";


//changed here as search div was hiding beyond list table
echo "</div>";
echo "</div>";

echo "<div align = 'center' class='content'>";
echo '<div id="studentshow" style="display:none; margin-top:10px;">';
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
		var rollid = $('input:radio[name=AttendenceId]:checked').val();
		if(rollid == 'undefined' || rollid == null ){
			message('Please select any one record' );
		}else{
			window.location='<?=$url?>attendence/edit/'+rollid;
		}
	}
}	

function view_data(){
   var year = $('#Year').val();
   var currentAcademicYear = $('#currentAcademicYear').val();
   if(year != currentAcademicYear ){
		document.getElementById('id2').disabled = true;
   }else{
		var rollid = $('input:radio[name=AttendenceId]:checked').val();	
		if(rollid == 'undefined' || rollid == null ){
			message('Please select any one record' );
		} else {
			window.location='<?=$url?>attendence/view/'+rollid;
		}
	}
}	
function addnew_data(){	
    var year = $('#Year').val();
    var currentAcademicYear = $('#currentAcademicYear').val();
   if(year != currentAcademicYear ){
		document.getElementById('id3').disabled = true;
   }else{
		window.location='<?=$url?>attendence/addnew/';
	}
	
}

function get_list(){
	var year = $('#Year').val();
	window.location='<?=$url?>attendence/listview/'+year;
		
}	
function get_section(){
	var ClassId = $('#Class').val();
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
function studentlist_show(){
	var ClassId = $('#Class').val();
	var SectionId = $('#SectionId').val();
	var Year = $('#Year').val();
	//alert(Year);
	$.ajax({
		  type: 'POST',
		  
		  url: '<?=$url?>attendence/showattendence',
		  
		  data:'ClassId='+ClassId+'&SectionId='+SectionId+'&Year='+Year,
		  
		  success: function(response){ 
         
		  if(response != ''){
			$('#studentshow').show().html(response);
			}
		  }
			 
	});
}
</script>
<script src="<?php echo $url ?>themes/js/template.js"></script>
