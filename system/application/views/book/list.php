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
echo "<li style = 'width:30px;'> <a href='#' class='selected'> <img src='". $url ."images/search_opt_btn.gif' /> </a>";
echo "<ul>";
echo "<li> <label> <input type='radio' name='searchfield' id ='searchfield' value='BookName' /> Book Name </label> </li>";
echo "<li> <label> <input type='radio' name='searchfield' id ='searchfield' value='BookCode' /> Book Code </label> </li>";
echo "</ul>";
echo "</li>";
echo "</ul>";
echo "</span>";
echo "<span class='search_btn'> <a onClick='search_fun(this);' id = 'book' > <img src='".$url ."images/search_btn.gif' /> </a> </span>";	
echo "</div>";

echo "</div>";
/*---------------     content events       ---------------------*/
echo "<div class='content_events'>";

echo "<div class='events'>";
echo "<a href='".$url."book/export' >";
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
echo "<a href='".$url."book/addnew' >";
echo "<span><img src='".$url."images/addnew.png' border='0' /></span>";
echo "<span>  Addnew  </span>";
echo "</a>";
echo "</div>";



echo "</div>";
echo "</div>";
/*---------------     content        ---------------------*/
echo "<div align='center' class='content'>";

echo "<table class='reporttable' border='0' cellpadding='0' cellspacing='1' >";
echo '<tr><th colspan = "9" id = "table_title">Book Details List View </th></tr>';

echo "<tr>";
echo "<th align='center' >S.No</th>";
echo "<th align='center' > <input type = 'hidden' name = 'tablename' class='book' id ='ordertype'  value = '0' /> </th>";

echo "<th align='center' >Book Name<a class = 'BookName' onClick='sort_fun(this);' >
											<img id='updown_arrow' class = 'BookName' src=''.$url.'images/up_down_arrow.gif' />
											<img id='desc' class='BookName'  src='".$url."images/order_down.gif' /> 
											<img id='asc' class='BookName' src='".$url."images/ORDER_UP.GIF' /></th>";

echo "<th align='center' >Book Code<a class = 'BookCode' onClick='sort_fun(this);' >
											<img id='updown_arrow' class = 'BookCode' src=''.$url.'images/up_down_arrow.gif' />
											<img id='desc' class='BookCode '  src='".$url."images/order_down.gif' /> 
											<img id='asc' class='BookCode' src='".$url."images/ORDER_UP.GIF' /></th>";

echo "<th align='center' >Book Category<a class = 'BookCategoryId' onClick='sort_fun(this);' >
											<img id='updown_arrow' class = 'BookCategoryId' src=''.$url.'images/up_down_arrow.gif' />
											<img id='desc' class='BookCategoryId'  src='".$url."images/order_down.gif' /> 
											<img id='asc' class='BookCategoryId' src='".$url."images/ORDER_UP.GIF' /></th>";
echo "<th align='center' >Book Author</th>";
echo "<th align='center' >Book Volume</th>";
echo "<th align='center' >Book Edition</th>";
echo "<th align='center' >Description</th>";

echo "</tr>";
$i = 1;
if($result == false){
	echo '<tr><span style="font-weight:bold; font-size:16px; color:#EA0000;"> No data to display</span></tr>';

}else{
foreach ($result as $row){

echo "<tr>";
echo "<td align='center' >" . $i++. "</td>";
echo "<td align='center' ><input type='radio' name = 'BookId' id = 'BookId' value ='" . $row->BookId . "'/></td>";
echo "<td align='center'>" . $row->BookName . "</td>";
echo "<td align='center'>" . $row->BookCode . "</td>";
echo "<td align='center'>";
foreach ($bookcategory as $rowa){
	if($rowa->BookCategoryId == $row->BookCategoryId){
		 echo $rowa->BookCategory;
	}
}
echo "</td>";
echo "<td align='center'>" . $row->BookAuthor . "</td>";
echo "<td align='center'>" . $row->BookVolume . "</td>";
echo "<td align='center'>" . $row->BookEdition . "</td>";
echo "<td align='center'>" . $row->BookDes . "</td>";

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
	var rollid = $('input:radio[name=BookId]:checked').val();
	if(rollid == 'undefined' || rollid == null ){
		message('Please select any one record' );
	} else {
	 window.location='<?=$url?>book/edit/'+rollid;
	}
	
	
}	

function view_data(){
	var rollid = $('input:radio[name=BookId]:checked').val();
	if(rollid == 'undefined' || rollid == null ){
		message('Please select any one record' );
	} else {
	 window.location='<?=$url?>book/view/'+rollid;
	}
	 
}	
	
</script>
<script src="<?php echo $url ?>js/template.js"></script>
