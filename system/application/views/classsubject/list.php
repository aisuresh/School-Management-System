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
echo "<a href='".$url."classsubject/export' >";
echo "<span><img src='".$url."images/export.gif' border='0' /></span>";
echo "<span>  Export  </span>";
echo "</a>";
echo "</div>";

echo "<div class='events'>";
echo "<a onclick='edit_data();' >";
echo "<span><img src='".$url."images/edit.png' border='0' /></span>";
echo "<span>  Edit  </span>";
echo "</a>";
echo "</div>";


echo "<div class='events'>";
echo "<a onclick='view_data();' >";
echo "<span><img src='".$url."images/view.gif' border='0' /></span>";
echo "<span>  View  </span>";
echo "</a>";
echo "</div>";

echo "<div class='events'>";
echo "<a href='".$url."classsubject/addnew' >";
echo "<span><img src='".$url."images/addnew.png' border='0' /></span>";
echo "<span>  Addnew  </span>";
echo "</a>";
echo "</div>";

/*echo "<div class='events'>";
echo "<a href='".$url."student/addnew' >";
echo "<span><img src='".$url."images/addnew.png' border='0' /></span>";
echo "<span>  Addnew  </span>";
echo "</a>";
echo "</div>";*/

echo "</div>";
echo "</div>";
/*---------------     content        ---------------------*/
echo "<div align='center' class='content'>";

echo "<table class='reporttable' border='0' cellpadding='0' cellspacing='1' >";
echo '<tr><th colspan = "4" id = "table_title">Class Subject List View </th></tr>';
echo "<tr>";
echo "<th align='center' >S.No.</th>";
echo "<th align='center' > <input type = 'hidden' name = 'tablename' class = 'course' value = '0' /></th>";
echo "<th align='center' >Class Name</th>";
echo "<th align='center' >Subject Name</th>";

echo "</tr>";
$i = 1;
if($result == false){
	echo '<tr><span style="font-weight:bold; font-size:16px; color:#EA0000;"> No data to display</span></tr>';
}else{
 foreach (array_reverse($course) as $row){

echo "<tr>";
echo "<td align='center' >" . $i++. "</td>";
echo "<td align='center' ><input type='radio' name = 'ClassId' id = 'ClassId' value ='" . $row->ClassId . "'/></td>";
echo "<td align='center'>" . $row->ClassName . "</td>";
echo "<td>";
$subjects = array();
foreach($result as $sub){
  if($row->ClassId == $sub->ClassId){
	$subjects[] = $sub->SubjectName;
  }
}
$subjects = array_reverse($subjects);
$subject = implode($subjects, ', ');
echo $subject;
echo "</td>";
echo "</tr>";
 }
}
echo "</table>";
echo "</div>";
echo "</div>";
?>
<script>
function edit_data(){
	var ClassId = $('input:radio[name=ClassId]:checked').val();
	if(ClassId == 'undefined' || ClassId == null ){
		message('Please select any one record' );
	} else {
	 window.location='<?=$url?>classsubject/edit/'+ClassId;
	}
	
}	

function view_data(){
	var ClassId = $('input:radio[name=ClassId]:checked').val();
	if(ClassId == 'undefined' || ClassId == null ){
		message('Please select any one record' );
	} else {
	 window.location='<?=$url?>classsubject/view/'+ClassId;
	}
}
	
</script>
