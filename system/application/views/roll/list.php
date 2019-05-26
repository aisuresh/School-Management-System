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
echo "<a href='".$url."roll/export' >";
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
echo "<a href='".$url."roll/addnew' >";
echo "<span><img src='".$url."images/addnew.png' border='0' /></span>";
echo "<span>  Addnew  </span>";
echo "</a>";
echo "</div>";
echo "</div>";
echo "</div>";
/*---------------     content        ---------------------*/
echo "<div align = 'center' class='content'>";

echo "<table class='reporttable' width='60%' border='0' cellpadding='0' cellspacing='1' >";
echo '<tr><th colspan = "4" id = "table_title">User\'s Role List View </th></tr>';
echo "<tr>";
echo "<th align='center' width='3%'  >S.No.</th>";
echo "<th align='center' width='3%'  > <input type = 'hidden' name = 'tablename' class = 'roll' value = '0' /></th>";
echo "<th align='center' width='28%' >Roll Name</th>";
echo "<th align='center' width='25%' >Roll Description</th>";
echo "</tr>";
$i = 1;
if($result == false){
	echo '<tr><span style="font-weight:bold; font-size:16px; color:#EA0000;"> No data to display</span></tr>';
}else{

foreach ($result as $row){

echo "<tr>";
echo "<td align='center' >" . $i++. "</td>";
echo "<td align='center' ><input type='radio' name = 'RollId' id = 'RollId' value ='" . $row->RollId . "'/></td>";
echo "<td align='center'>".$row->RollType."</td>";
echo "<td align='center'>" . $row->RollDes . "</td>";
echo "</tr>";

}
}

echo "</table>";

echo "</div>";
echo "</div>";
?>
<script>
function edit_data(){
	var rollid = $('input:radio[name=RollId]:checked').val();
	if(rollid == 'undefined' || rollid == null ){
		message('Please select any one record' );
	} else {
	 window.location='<?=$url?>roll/edit/'+rollid;
	}
}

function view_data(){
	var rollid = $('input:radio[name=RollId]:checked').val();
	if(rollid == 'undefined' || rollid == null ){
		message('Please select any one record' );
	} else {
	 window.location='<?=$url?>roll/view/'+rollid;
	}	 
}			
</script>
