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
echo "<a href='".$url."bookcode/export' >";
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
echo "<a href='".$url."bookcode/addnew' >";
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

echo "<tr>";
echo "<th align='center' >#</th>";
echo "<th align='center' > </th>";
echo "<th align='center' >Book Code</th>";
echo "<th align='center' >Book Category</th>";
echo "<th align='center' >Description</th>";

echo "</tr>";
$i = 1;
foreach ($result as $row){

echo "<tr>";
echo "<td align='center' >" . $i++. "</td>";
echo "<td align='center' ><input type='radio' name = 'BookCodeId' id = 'BookCodeId' value ='" . $row->BookCodeId . "'/></td>";
echo "<td align='center'>" . $row->BookCode . "</td>";
echo "<td align='center'>" . $row->BookCategoryId . "</td>";
echo "<td align='center'>" . $row->BookCodeDes . "</td>";

echo "</tr>";

}

echo "</table>";

echo "</div>";
echo "</div>";
?>
<script>
function edit_data(){
	var rollid = $('input:radio[name=BookCodeId]:checked').val();
	 window.location='<?=$url?>bookcode/edit/'+rollid;
}	

function view_data(){
	var rollid = $('input:radio[name=BookCodeId]:checked').val();
	 window.location='<?=$url?>bookcode/view/'+rollid;
}	
	
</script>
