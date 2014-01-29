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
echo "<li> <label> <input type='radio' name='searchfield' id ='searchfield' value='LibraryNo' /> Library No </label> </li>";
echo "<li> <label> <input type='radio' name='searchfield' id ='searchfield' value='StudentRollNo' /> Student Roll No </label> </li>";
echo "</ul>";
echo "</li>";
echo "</ul>";
echo "</span>";
echo "<span class='search_btn'> <a onClick='search_fun(this);' id = 'libraryreg' > <img src='".$url ."images/search_btn.gif' /> </a> </span>";	
echo "</div>";

echo "</div>";
/*---------------     content events       ---------------------*/
echo "<div class='content_events'>";

echo "<div class='events'>";
echo "<a href='".$url."libraryreg/export' >";
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
echo "<a href='".$url."libraryreg/addnew' >";
echo "<span><img src='".$url."images/addnew.png' border='0' /></span>";
echo "<span>  Addnew  </span>";
echo "</a>";
echo "</div>";


echo "</div>";
echo "</div>";
/*---------------     content        ---------------------*/
echo "<div align='center' class='content'>";

echo "<table class='reporttable' border='0' cellpadding='0' cellspacing='1' >";
echo '<tr><th colspan = "5" id = "table_title">Library Register List View </th></tr>';

echo "<tr>";
echo "<th align='center' >S.No</th>";
echo "<th align='center' > <input type = 'hidden' name = 'tablename' class='libraryreg' id ='ordertype'  value = '0' /> </th>";

echo "<th align='center' >Library No<a class = 'LibraryNo' onClick='sort_fun(this);' >
											<img id='updown_arrow' class = 'LibraryNo' src=''.$url.'images/up_down_arrow.gif' />
											<img id='desc' class='LibraryNo'  src='".$url."images/order_down.gif' /> 
											<img id='asc' class='LibraryNo' src='".$url."images/ORDER_UP.GIF' /></th>";
echo "<th align='center' > Roll No<a class = 'RollNo' onClick='sort_fun(this);' >
											<img id='updown_arrow' class = 'RollNo' src=''.$url.'images/up_down_arrow.gif' />
											<img id='desc' class='RollNo'  src='".$url."images/order_down.gif' /> 
											<img id='asc' class='RollNo' src='".$url."images/ORDER_UP.GIF' /></th>";
echo "<th align='center' >Description</th>";

echo "</tr>";
$i=1;
//var_dump($result);
if($result == false){
	echo '<tr><span style="font-weight:bold; font-size:16px; color:#EA0000;"> No data to display</span></tr>';

}else{
foreach ($result as $rowa){

echo "<tr>";
echo "<td align='center' >" . $i++. "</td>";
echo "<td align='center' ><input type='radio' name = 'LibraryId' id = 'LibraryId' value ='" . $rowa->LibraryId . "'/></td>";
echo "<td align='center'>" . $rowa->LibraryNo . "</td>";
echo "<td align='center'>" . $rowa->StudentRollNo . "</td>";
echo "<td align='center'>" . $rowa->LibraryDes . "</td>";

echo "</tr>";

}
}//else part ends here
echo "</table>";
echo "<div class='pagenation'>" . $links . "</div>";
echo "</div>";
echo "</div>";
?>
<script>
function edit_data(){
	var rollid = $('input:radio[name=LibraryId]:checked').val();
	if(rollid == 'undefined' || rollid == null ){
		message('Please select any one record' );
	} else {
	 window.location='<?=$url?>libraryreg/edit/'+rollid;
	}
}	

function view_data(){
	var rollid = $('input:radio[name=LibraryId]:checked').val();
	if(rollid == 'undefined' || rollid == null ){
		message('Please select any one record' );
	} else {
	 window.location='<?=$url?>libraryreg/view/'+rollid;
	}
	 
}	
	
</script>
<script src="<?php echo $url ?>js/template.js"></script>
