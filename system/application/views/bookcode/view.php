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
echo "<a href='".$url."bookcode/listview' >";
echo "<span><img src='".$url."images/cancel.png' border='0' /></span>";
echo "<span> Cancel </span>";
echo "</a>";
echo "</div>";

echo "<div class='events'>";
echo "<a onclick='edit_data();' >";
echo "<span><img src='".$url."images/edit.png' border='0' /></span>";
echo "<span> Edit </span>";
echo "</a>";
echo "</div>";

echo "</div>";
echo "</div>";
/*---------------     content        ---------------------*/
echo "<div align = 'center' class='content'>";
echo "<table border='0' cellpadding='0' cellspacing = '0' class='formtable'>";

foreach($result as $row):
echo "<input type='hidden' name = 'BookCodeId' id = 'BookCodeId' value = '".$row->BookCodeId."'";

echo "<tr>";
echo "<td align='right' width='15%' class = 'datafield' >Book Code</td>";
echo "<td width='2%' class='spacetd' > </td>";
echo "<td width='33%' class = 'dataview' >".$row->BookCode ."</td>";
echo "</tr>";

echo "<tr>";
echo "<td align='right' width='15%' class = 'datafield' >Book Category</td>";
echo "<td width='2%' class='spacetd' > </td>";
echo "<td width='33%' class = 'dataview' >";

foreach($bookcategory as $rowa):
	if($rowa->BookCategoryId == $row->BookCategoryId){
			echo $rowa->BookCategory;
		}
endforeach;

echo "</td></tr>";



echo "<tr>";
echo "<td align='right' width='15%' class = 'datafield' >Description</td>";
echo "<td width='2%' class='spacetd' > </td>";
echo "<td width='33%' class = 'dataview' >".$row->BookCodeDes."</td>";
echo "</tr>";

endforeach;
echo '</table';
echo "</div>";
echo "</div>";
?>
<script>
function edit_data(){
var rollid = $('input[name=BookCodeId]').val();
 window.location='<?=$url?>bookcode/edit/'+rollid;
}		
</script>
