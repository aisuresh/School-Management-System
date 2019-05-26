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
echo "<li> <label> <input type='radio' name='searchfield' id ='searchfield' value='libraryrecord.LibraryNo' /> Library No </label> </li>";
echo "<li> <label> <input type='radio' name='searchfield' id ='searchfield' value='libraryrecord.BookCode' /> Book Name </label> </li>";
//echo "<li> <label> <input type='radio' name='searchfield' id ='searchfield' value='libraryrecord.BookCode' /> Book Code </label> </li>";
echo "<li> <label> <input type='radio' name='searchfield' id ='searchfield' value='libraryrecord.IssuedDate' /> Issued Date </label> </li>";
echo "<li> <label> <input type='radio' name='searchfield' id ='searchfield' value='libraryrecord.ReturnDate' /> Return Date </label> </li>";
//echo "<li> <label> <input type='radio' name='searchfield' id ='searchfield' value='libraryrecord.ReceivedDate' /> Received Date </label> </li>";
echo "</ul>";
echo "</li>";
echo "</ul>";
echo "</span>";
echo "<span class='search_btn'> <a onClick='search_fun(this);' id = 'libraryrecord' > <img src='".$url ."images/search_btn.gif' /> </a> </span>";	
echo "</div>";

echo "</div>";
/*---------------     content events       ---------------------*/
echo "<div class='content_events'>";

echo "<div class='events'>";
echo "<a href='".$url."libraryrecord/export' >";
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
echo "<a href='".$url."libraryrecord/returns' >";
echo "<span><img src='".$url."images/return.png' border='0' /></span>";
echo "<span>  Return  </span>";
echo "</a>";
echo "</div>";

echo "<div class='events'>";
echo "<a  onClick='issue_data();' >";
echo "<span id = 'id3'><img src='".$url."images/addnew.png' border='0' /></span>";
echo "<span>  Issue  </span>";
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
	if($this->session->userdata('yearlr') == $ys->AcademicYear){
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
echo '<tr><th colspan = "7" id = "table_title">Library Record List View </th></tr>';

echo "<tr>";
echo "<th align='center' >S.No</th>";
echo "<th align='center' > <input type = 'hidden' name = 'tablename' class='libraryrecord' id ='ordertype'  value = '0' /> </th>";
echo "<th align='center' >Library No</th>";
echo "<th align='center' >Book Name<a class = 'BookCode' onClick='sort_fun(this);' >
											<img id='updown_arrow' class = 'BookCode' src=''.$url.'images/up_down_arrow.gif' />
											<img id='desc' class='BookCode'  src='".$url."images/order_down.gif' /> 
											<img id='asc' class='BookCode' src='".$url."images/ORDER_UP.GIF' /></th>";
echo "<th align='center' >Issued Date<a class = 'IssuedDate' onClick='sort_fun(this);' >
											<img id='updown_arrow' class = 'IssuedDate' src=''.$url.'images/up_down_arrow.gif' />
											<img id='desc' class='IssuedDate'  src='".$url."images/order_down.gif' /> 
											<img id='asc' class='IssuedDate' src='".$url."images/ORDER_UP.GIF' /></th>";
echo "<th align='center' >Return Date<a class = 'ReturnDate' onClick='sort_fun(this);' >
											<img id='updown_arrow' class = 'ReturnDate' src=''.$url.'images/up_down_arrow.gif' />
											<img id='desc' class='ReturnDate'  src='".$url."images/order_down.gif' /> 
											<img id='asc' class='ReturnDate' src='".$url."images/ORDER_UP.GIF' /></th>";
echo "<th align='center' >Description</th>";

echo "</tr>";
$i = 1;

if($result == false){
	echo '<tr><span style="font-weight:bold; font-size:16px; color:#EA0000;"> No data to display</span></tr>';

}else{
foreach ($result as $row){
$IssuedDate=date("d-m-Y", strtotime($row->IssuedDate));
$ReturnDate=date("d-m-Y", strtotime($row->ReturnDate));
echo "<tr>";
echo "<td align='center' >" . $i++. "</td>";
echo "<td align='center' ><input type='radio' name = 'LibraryRecordId' id = 'LibraryRecordId' value ='" . $row->LibraryRecordId . "'/></td>";
echo "<td align='center'>" . $row->LibraryNo . "</td>";
echo "<td align='center'>";
//var_dump($book);
foreach ($book as $rowa){
	if($rowa->BookCode == $row->BookCode){
		 echo $rowa->BookName;
	}
}
echo "</td>";
echo "<td align='center'>" . $IssuedDate . "</td>";
echo "<td align='center'>" . $ReturnDate . "</td>";
echo "<td align='center'>" . $row->LibraryDes . "</td>";

echo "</tr>";

}
}//else part ends here
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
    var rollid = $('input:radio[name=LibraryRecordId]:checked').val();
	if(rollid == 'undefined' || rollid == null ){
		message('Please select any one record' );
	} else {
	 window.location='<?=$url?>libraryrecord/edit/'+rollid;
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
	var rollid = $('input:radio[name=LibraryRecordId]:checked').val();
	
	if(rollid == 'undefined' || rollid == null ){
		message('Please select any one record' );
	} else {
	 window.location='<?=$url?>libraryrecord/view/'+rollid;
	}
	}
}	
function issue_data(){	
    var year = $('#Year').val();
    var currentAcademicYear = $('#currentAcademicYear').val();
   if(year != currentAcademicYear ){
	document.getElementById('id3').disabled = true;
	}
	else{
	window.location='<?=$url?>libraryrecord/issue/';
	}
	
}
	
function get_list(){
	var year = $('#Year').val();
	 window.location='<?=$url?>libraryrecord/listview/'+year;
}	
</script>
<script src="<?php echo $url ?>js/template.js"></script>
