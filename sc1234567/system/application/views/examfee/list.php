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
echo "<li> <label> <input type='radio' name='searchfield' id ='searchfield' value='examfee.ReceiptNo' /> Receipt No </label> </li>";
echo "<li> <label> <input type='radio' name='searchfield' id ='searchfield' value='examfee.PaidDate' /> Paid Date </label> </li>";
echo "</ul>";
echo "</li>";
echo "</ul>";
echo "</span>";
echo "<span class='search_btn'> <a onClick='search_fun(this);' id = 'examfee' > <img src='".$url ."images/search_btn.gif' /> </a> </span>";	
echo "</div>";

echo "</div>";
/*---------------     content events       ---------------------*/
echo "<div class='content_events'>";

echo "<div class='events'>";
echo "<a href='".$url."examfee/export' >";
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
	if($this->session->userdata('yearef') == $ys->AcademicYear){
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
echo '<tr><th colspan = "10" id = "table_title">Exam Fees List View </th></tr>';

echo "<tr>";
echo "<th align='center' >S.No</th>";
echo "<th align='center' > <input type = 'hidden' name = 'tablename' class='examfee' id ='ordertype'  value = '0' /> </th>";
echo "<th align='center' >Roll No<a class = 'RollNo' onClick='sort_fun(this);' >
											<img id='updown_arrow' class = 'RollNo' src=''.$url.'images/up_down_arrow.gif' />
											<img id='desc' class='RollNo'  src='".$url."images/order_down.gif' /> 
											<img id='asc' class='RollNo' src='".$url."images/ORDER_UP.GIF' /></th>";
echo "<th align='center' >Class</th>";
echo "<th align='center' >No of Subjects</th>";
echo "<th align='center' >Subjects</th>";
echo "<th align='center' >Exam Fees</th>";
echo "<th align='center' >Receipt No<a class = 'ReceiptNo' onClick='sort_fun(this);' >
											<img id='updown_arrow' class = 'ReceiptNo' src=''.$url.'images/up_down_arrow.gif' />
											<img id='desc' class='ReceiptNo'  src='".$url."images/order_down.gif' /> 
											<img id='asc' class='ReceiptNo' src='".$url."images/ORDER_UP.GIF' /></th>";
echo "<th align='center' >Paid Date<a class = 'PaidDate' onClick='sort_fun(this);' >
											<img id='updown_arrow' class = 'PaidDate' src=''.$url.'images/up_down_arrow.gif' />
											<img id='desc' class='PaidDate'  src='".$url."images/order_down.gif' /> 
											<img id='asc' class='PaidDate' src='".$url."images/ORDER_UP.GIF' /></th>";
echo "<th align='center' >Description</th>";

echo "</tr>";
$i = 1;
//var_dump($result);
if($result == false){
	echo '<tr><span style="font-weight:bold; font-size:16px; color:#EA0000;"> No data to display</span></tr>';

}else{
 $subject = array();$subarray = array();
foreach ($result as $row){
$PaidDate=date("d-m-Y", strtotime($row->PaidDate));
echo "<tr>";
echo "<td align='center' >" . $i++. "</td>";
echo "<td align='center' ><input type='radio' name = 'ExamFeeId' id = 'ExamFeeId' value ='" . $row->ExamFeeId . "'/></td>";
echo "<td align='center'>" . $row->StudentRollNo . "</td>";
echo "<td align='center'>" . $row->ClassName . "</td>";
echo "<td align='center'>" . $row->NoOfSubjects . "</td>";
echo "<td align='center'>";
$subarray = explode(',', $row->Subjects);
$subjectnewarray = array();
foreach($subjects as $sub){
	$subject[] = $sub->SubjectName;
}
foreach($subarray as $id){
	$subjectnewarray[] = $subject[$id-1];
}
$showsubjects = implode(', ', $subjectnewarray);
echo $showsubjects;
echo "</td>";
echo "<td align='center'>" . $row->ExamFee . "</td>";
echo "<td align='center'>" . $row->ReceiptNo . "</td>";
echo "<td align='center'>" . $PaidDate . "</td>";
echo "<td align='center'>" . $row->ExamFeeDes . "</td>";

echo "</tr>";

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
    }else{
    	var rollid = $('input:radio[name=ExamFeeId]:checked').val();
		if(rollid == 'undefined' || rollid == null ){
			message('Please select any one record' );
		} else {
	 		window.location='<?=$url?>examfee/edit/'+rollid;
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
	var rollid = $('input:radio[name=ExamFeeId]:checked').val();
	
	if(rollid == 'undefined' || rollid == null ){
		message('Please select any one record' );
	} else {
	 window.location='<?=$url?>examfee/view/'+rollid;
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
	window.location='<?=$url?>examfee/addnew/';
	}
	
}


function get_list(){
	var year = $('#Year').val();
	window.location='<?=$url?>examfee/listview/'+year;
}		
</script>
<script src="<?php echo $url ?>themes/js/template.js"></script>
