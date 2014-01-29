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
echo "<li> <a href='#' class='selected'> <img src='". $url ."images/search_opt_btn.gif' /> </a>";
echo "<ul>";
echo "<li> <label> <input type='radio' name='searchfield' id ='searchfield' value='StudentRollNo' /> Student Roll No </label> </li>";
echo "<li> <label> <input type='radio' name='searchfield' id ='searchfield' value='StudentName' /> Student Name </label> </li>";
echo "<li> <label> <input type='radio' name='searchfield' id ='searchfield' value='Town' /> Town </label> </li>";
echo "</ul>";
echo "</li>";
echo "</ul>";
echo "</span>";

echo "<span class='search_btn'><a><img src='".$url ."images/search_btn.gif' onclick='search_fun(this);' /></a></span>";	

echo "</div>";
echo "</div>";
/*---------------     content events       ---------------------*/
echo "<div class='content_events'>";

echo "<div class='events'>";
echo "<a href='".$url."student/export' >";
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

$yearno = $this->Adminmodel->maxvalue($table = 'academicyear', $fields = array('AcademicYear'), $where = array());
foreach($yearno as $yno){
	if($yno->AcademicYear != NULL){
		$currentAcademicYear = $yno->AcademicYear;
	}
}


echo "<div class = 'showboxa' >";
echo "<select name = 'Year' id = 'Year' style='width: 100px;' onchange = 'get_list();' >";
foreach( array_reverse($this->session->userdata('years')) as $ys){
	if($this->session->userdata('yearas') == $ys->AcademicYear){
		echo "<option value = '".$ys->AcademicYear."' selected = 'selected'>".$ys->AcademicYear."</option>";
	}else{
		echo "<option value = '".$ys->AcademicYear."'>".$ys->AcademicYear."</option>";
	}	
}
echo "</select>";
echo "</div>";

echo "</div>";
echo "</div>";



/*---------------     content        ---------------------*/
echo "<div align = 'center' class='content' style = ' height:400px;'>";

echo "<table class='reporttable' border='0' cellpadding='0' cellspacing='1' >";

echo "<tr>";
echo "<th align='center' >S.No</th>";

echo "<th align='center' > <input type = 'hidden' name = 'tablename' class = 'student' value = '0' /> </th>";

echo "<th align='center' >Roll No<a class = 'StudentRollNo' onClick='sort_fun(this);' >
											<img id='updown_arrow' class = 'StudentRollNo' src=''.$url.'images/up_down_arrow.gif' />
											<img id='desc' class='StudentRollNo'  src='".$url."images/order_down.gif' /> 
											<img id='asc' class='StudentRollNo' src='".$url."images/ORDER_UP.GIF' /></th>";

echo "<th align='center' >Student Name<a class = 'StudentName' onClick='sort_fun(this);' >
											<img id='updown_arrow' class = 'student.StudentName' src=''.$url.'images/up_down_arrow.gif' />
											<img id='desc' class='student.StudentName'  src='".$url."images/order_down.gif' /> 
											<img id='asc' class='student.StudentName' src='".$url."images/ORDER_UP.GIF' /></th>";
echo "<th align='center' >Class</th>";
echo "<th align='center' >Section</th>";
echo "<th align='center' >Year</th>";
echo "</tr>";
$i = 1;

if($result == false){
	echo '<tr><span style="font-weight:bold; font-size:16px; color:#EA0000;"> No data to display</span></tr>';

}else{

foreach ($result as $row){

echo "<tr>";
echo "<td align='center' >" . $i++. "</td>";
echo "<td align='center' ><input type='radio' name = 'StudentId' id = 'StudentId' value ='" . $row->StudentId . "'/></td>";
echo "<td align='center'>" . $row->StudentRollNo . "</td>";
echo "<td align='center'>" . $row->StudentName . "</td>";
echo "<td align='center'>" . $row->ClassName . "</td>";
echo "<td align='center'>" . $row->SectionName . "</td>";
echo "<td align='center'>" . $row->Year . "</td>";

}
}//else ends here
echo "</table>";
echo "<div class='pagenation'>" . $links . "</div>";
echo "</div>";
echo "</div>";
echo "<input type = 'hidden' name = 'currentAcademicYear' id='currentAcademicYear' value = '". $currentAcademicYear ."' /> </th>";

?>
<script>
function edit_data(){
   var year = $('#Year').val();
   var currentAcademicYear = $('#currentAcademicYear').val();
   if(year != currentAcademicYear ){
	document.getElementById('id1').disabled = true;
	}
	else{
    var rollid = $('input:radio[name=SchoolFeeId]:checked').val();
	if(rollid == 'undefined' || rollid == null ){
		alert('Please select any one record' );
	} else {
	 window.location='<?=$url?>student/edit/'+rollid;
	}
	}
}	

function view_data(){
   var year = $('#Year').val();
  var currentAcademicYear = $('#currentAcademicYear').val();
   if(year != currentAcademicYear ){
	document.getElementById('id2').disabled = true;
	}
	else{
	var rollid = $('input:radio[name=SchoolFeeId]:checked').val();
	
	if(rollid == 'undefined' || rollid == null ){
		alert('Please select any one record' );
	} else {
	 window.location='<?=$url?>student/view/'+rollid;
	}
	}
}	
function addnew_data(){	
    var year = $('#Year').val();
    var currentAcademicYear = $('#currentAcademicYear').val();
   if(year != currentAcademicYear ){
	document.getElementById('id3').disabled = true;
	}
	else{
	window.location='<?=$url?>student/newassign/';
	}
	
}


function get_list(){
	var year = $('#Year').val();
	window.location='<?=$url?>student/assignlist/'+year;
}	
	
</script>
<script src="<?php echo $url ?>js/template.js"></script>
