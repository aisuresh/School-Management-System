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
echo "<a href='".$url."marks/addnew' >";
echo "<span><img src='".$url."images/addnew.png' border='0' /></span>";
echo "<span>  Addnew  </span>";
echo "</a>";
echo "</div>";

echo "<div class='events' style = 'width:80px;'>";
echo "<a href='".$url."marks/marksrecords' style = 'width:80px;float:left;'>";
echo "<span style = 'width:80px;float:left;' ><img src='".$url."images/btn4.png' border='0' /></span>";
echo "<span style = 'width:80px;float:left;' >Records</span>";
echo "</a>";
echo "</div>";

echo "<div class = 'showboxa' >";
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
echo "</div>";
/*---------------     content        ---------------------*/
echo "<div align='center' class='content'>";

echo "<table class='reporttable' border='0' cellpadding='0' cellspacing='1' >";

echo "<tr>";
echo "<th align='center' >#</th>";
echo "<th align='center' > <input type = 'hidden' name = 'tablename' class='marks' id ='ordertype'  value = '0' /> </th>";
echo "<th align='center' >Roll No<a class = 'RollNo' onClick='sort_fun(this);' >
											<img id='updown_arrow' class = 'RollNo' src=''.$url.'images/up_down_arrow.gif' />
											<img id='desc' class='RollNo'  src='".$url."images/order_down.gif' /> 
											<img id='asc' class='RollNo' src='".$url."images/ORDER_UP.GIF' /></th>";
echo "<th align='center' >Exam Type</th>";
echo "<th align='center' >Subject<a class = 'SubjectId' onClick='sort_fun(this);' >
											<img id='updown_arrow' class = 'SubjectId' src=''.$url.'images/up_down_arrow.gif' />
											<img id='desc' class='SubjectId'  src='".$url."images/order_down.gif' /> 
											<img id='asc' class='SubjectId' src='".$url."images/ORDER_UP.GIF' /></th>";
echo "<th align='center' >Total Marks</th>";
echo "<th align='center' >Marks<a class = 'Marks' onClick='sort_fun(this);' >
											<img id='updown_arrow' class = 'Marks' src=''.$url.'images/up_down_arrow.gif' />
											<img id='desc' class='Marks'  src='".$url."images/order_down.gif' /> 
											<img id='asc' class='Marks' src='".$url."images/ORDER_UP.GIF' /></th>";
echo "<th align='center' >Description</th>";

echo "</tr>";
$i=1;
if($result == false){
	echo '<tr><span style="font-weight:bold; font-size:16px; color:#EA0000;"> No data to display</span></tr>';
}
else{
foreach ($result as $row){

echo "<tr>";
echo "<td align='center' >" . $i++. "</td>";
echo "<td align='center' ><input type='radio' name = 'MarksId' id = 'MarksId' value ='" . $row->MarksId . "'/></td>";
echo "<td align='center'>" . $row->RollNo . "</td>";
echo "<td align='center'>";
foreach ($exam as $rowa){
	if($rowa->ExamId == $row->ExamTypeId){
		 echo $rowa->ExamType;
	}
}
echo "</td>";
echo "<td align='center'>"; 
foreach ($subject as $rowb){
	if($rowb->SubjectId == $row->SubjectId){
		 echo $rowb->SubjectName;
	}
}
echo "</td>";
echo "<td align='center'>" . $row->TotalMarks . "</td>";
echo "<td align='center'>" . $row->Marks . "</td>";
echo "<td align='center'>" . $row->MarksDes . "</td>";
echo "</tr>";

}
}//else ends here
echo "</table>";
echo "<div class='pagenation'>" . $links . "</div>";
echo "</div>";
echo "</div>";
?>
<script>
function edit_data(){
	var rollid = $('input:radio[name=MarksId]:checked').val();
	
	if(rollid == 'undefined' || rollid == null ){
		alert('Please select any one record' );
	} else {
	 window.location='<?=$url?>marks/edit/'+rollid;
	}
}	

function view_data(){
	var rollid = $('input:radio[name=MarksId]:checked').val();
	
	if(rollid == 'undefined' || rollid == null ){
		alert('Please select any one record' );
	} else {
	 window.location='<?=$url?>marks/view/'+rollid;
	}
}
	
function get_list(){
	var year = $('#Year').val();
	window.location='<?=$url?>marks/listview/'+year;
}		
</script>
<script src="<?php echo $url ?>js/template.js"></script>