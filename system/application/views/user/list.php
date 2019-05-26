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
echo "<a href='".$url."user/export' >";
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
echo "<a href='".$url."user/addnew' >";
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
echo '<tr><th colspan = "6" id = "table_title">User Details List View </th></tr>';
echo "<tr>";
echo "<th align='center' >S.No.</th>";
echo "<th align='center' > <input type = 'hidden' name = 'tablename' class = 'user' value = '0' /></th>";
echo "<th align='center' >User Name</th>";
echo "<th align='center' >User Id</th>";
echo "<th align='center' >User Type</th>";
echo "<th align='center' >Description</th>";

echo "</tr>";
$i = 1;
if($result == false){
	echo '<tr><span style="font-weight:bold; font-size:16px; color:#EA0000;"> No data to display</span></tr>';
}else{

//var_dump($result);
foreach ($result as $row){

echo "<tr>";
echo "<td align='center' >" . $i++. "</td>";
echo "<td align='center' ><input type='radio' name = 'UserNo' id = 'UserNo' value ='" . $row->UserNo . "'/></td>";
echo "<td align='center'>" . $row->UserName . "</td>";
echo "<td align='center'>" . $row->UserId . "</td>";
/*if($row->RollId == 1){
	echo "<td align='center'>Super Admin</td>";
}*/
foreach($rolltype as $rowa ){
	if($rowa->RollId == $row->RollId){
		echo "<td align='center'>" . $rowa->RollType . "</td>";
	}
}
echo "<td align='center'>" . $row->UserDes . "</td>";
echo "</tr>";

}
}

echo "</table>";
echo "</div>";
echo "</div>";
?>
<script>
function edit_data(){
	var userno = $('input:radio[name=UserNo]:checked').val();
	if(userno == 'undefined' || userno == null ){
		message('Please select any one record' );
	} else {
	 window.location='<?=$url?>user/edit/'+userno;
	}
	 
}	

function view_data(){
	var userno = $('input:radio[name=UserNo]:checked').val();
	if(userno == 'undefined' || userno == null ){
		message('Please select any one record' );
	} else {
	 window.location='<?=$url?>user/view/'+userno;
	}
	
}	
	
</script>
<script src="<?php echo $url ?>themes/js/template.js"></script>	
