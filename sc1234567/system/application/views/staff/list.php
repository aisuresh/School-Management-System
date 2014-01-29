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
echo "<li> <label> <input type='radio' name='searchfield' id ='searchfield' value='StaffName' /> Staff Name </label> </li>";
//echo "<li> <label> <input type='radio' name='searchfield' id ='searchfield' value='StaffTypeId' /> Roll </label> </li>";
echo "<li> <label> <input type='radio' name='searchfield' id ='searchfield' value='TotalExperiance' />Experiance </label> </li>";
echo "<li> <label> <input type='radio' name='searchfield' id ='searchfield' value='Subject01' /> Subject01 </label> </li>";
echo "<li> <label> <input type='radio' name='searchfield' id ='searchfield' value='Subject02' /> Subject02 </label> </li>";
echo "<li> <label> <input type='radio' name='searchfield' id ='searchfield' value='Town' /> Town </label> </li>";
echo "<li> <label> <input type='radio' name='searchfield' id ='searchfield' value='Status' /> Status </label> </li>";
echo "</ul>";
echo "</li>";
echo "</ul>";
echo "</span>";
echo "<span class='search_btn'> <a onClick='search_fun(this);' id = 'staff' > <img src='".$url ."images/search_btn.gif' /> </a> </span>";	
echo "</div>";

echo "</div>";
/*---------------     content events       ---------------------*/
echo "<div class='content_events'>";

echo "<div class='events'>";
echo "<a href='".$url."staff/export' >";
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
echo "<a href='".$url."staff/addnew' >";
echo "<span><img src='".$url."images/addnew.png' border='0' /></span>";
echo "<span>  Addnew  </span>";
echo "</a>";
echo "</div>";



echo "</div>";
echo "</div>";
/*---------------     content        ---------------------*/
echo "<div align='center' class='content'>";

echo "<table class='reporttable' border='0' cellpadding='0' cellspacing='1' >";
echo '<tr><th colspan = "18" id = "table_title">Staff Info List View </th></tr>';

echo "<tr>";
echo "<th align='center' >S.No.</th>";
echo "<th align='center' > <input type = 'hidden' name = 'tablename' class='staff' id ='ordertype'  value = '0' /> </th>";
echo "<th align='center' >Staff Name<a class = 'StaffName' onClick='sort_fun(this);' >
											<img id='updown_arrow' class = 'StaffName' src=''.$url.'images/up_down_arrow.gif' />
											<img id='desc' class='StaffName'  src='".$url."images/order_down.gif' /> 
											<img id='asc' class='StaffName' src='".$url."images/ORDER_UP.GIF' /></a></th>";
echo "<th align='center' >Roll <a class = 'StaffTypeId' onClick='sort_fun(this);' >
											<img id='updown_arrow' class = 'StaffTypeId' src=''.$url.'images/up_down_arrow.gif' />
											<img id='desc' class='StaffTypeId'  src='".$url."images/order_down.gif' /> 
											<img id='asc' class='StaffTypeId' src='".$url."images/ORDER_UP.GIF' /></a></th>";
//echo "<th align='center' >Gender</th>";
//echo "<th align='center' >DateOfBirth</th>";
echo "<th align='center' >Qualification</th>";
echo "<th align='center' >Experiance</th>";
echo "<th align='center' >Subject<a class = 'Subject01' onClick='sort_fun(this);' >
								   <img id='updown_arrow' class = 'Subject01' src=''.$url.'images/up_down_arrow.gif' />
								   <img id='desc' class='Subject01'  src='".$url."images/order_down.gif' /> 
								   <img id='asc' class='Subject01' src='".$url."images/ORDER_UP.GIF' /></a></th>";
//echo "<th align='center' >Subject02</th>";
//echo "<th align='center' >Subject03</th>";
//echo "<th align='center' >Phone No</th>";
//echo "<th align='center' >Mobile No</th>";
//echo "<th align='center' >Email</th>";
//echo "<th align='center' >Town / Village</th>";
//echo "<th align='center' >Address</th>";
//echo "<th align='center' >Status</th>";
//echo "<th align='center' >Description</th>";

echo "</tr>";
$i = 1;
//var_dump($result);
if($result == false){
	echo '<tr><span style="font-weight:bold; font-size:16px; color:#EA0000;"> No data to display</span></tr>';
}else{
foreach ($result as $row){
$DateOfBirth = date("d-m-Y", strtotime($row->DateOfBirth));
echo "<tr>";
echo "<td align='center' >" . $i++. "</td>";
echo "<td align='center' ><input type='radio' name = 'StaffId' id = 'StaffId' value ='" . $row->StaffId . "'/></td>";
echo "<td align='center'>" . $row->StaffName . "</td>";
echo "<td align='center'>";
foreach ($stafftype as $rowa){
	if($rowa->StaffTypeId == $row->StaffTypeId){
		 echo $rowa->StaffType;
	}
}
echo "</td>";
/*
echo "<td align='center'>";
if($row->Gender == 'm'){
echo 'Male';
}else if($row->Gender == 'f')
{
echo 'Female';
}
else echo "";
echo "</td>";
  
echo "<td align='center'>" . $DateOfBirth . "</td>";
*/
echo "<td align='center'>";
foreach ($qualification as $rowb){
	if($row->QualificationId == $rowb->QualificationId){
		 echo $rowb->graduation;
	}
	
}
echo "</td>";

echo "<td align='center'>" . $row->TotalExperiance . "</td>";
echo "<td align='center'>" . $row->Subject01 . "</td>";
/*
echo "<td align='center'>" . $row->Subject02 . "</td>";
echo "<td align='center'>" . $row->Subject03 . "</td>";
echo "<td align='center'>" . $row->PhoneNo . "</td>";
echo "<td align='center'>" . $row->MobileNo . "</td>";
echo "<td align='center'>" . $row->Email . "</td>";
echo "<td align='center'>" . $row->Town . "</td>";
echo "<td align='center'>" . $row->Address . "</td>";
echo "<td align='center'>" . $row->Status . "</td>";
echo "<td align='center'>" . $row->StaffDes . "</td>";
*/
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
	var rollid = $('input:radio[name=StaffId]:checked').val();
	if(rollid == 'undefined' || rollid == null ){
		message('Please select any one record' );
	} else {
	 window.location='<?=$url?>staff/edit/'+rollid;
	}
	 
}	

function view_data(){
	var rollid = $('input:radio[name=StaffId]:checked').val();
	if(rollid == 'undefined' || rollid == null ){
		message('Please select any one record' );
	} else {
	 window.location='<?=$url?>staff/view/'+rollid;
	}	 
	 
}	
	
</script>
<script src="<?php echo $url ?>themes/js/template.js"></script>
