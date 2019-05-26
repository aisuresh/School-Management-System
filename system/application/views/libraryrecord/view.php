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
echo "<a href='".$url."libraryrecord/listview/".$this->session->userdata('yearlr')."' >";
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
echo "<input type='hidden' name = 'LibraryRecordId' id = 'LibraryRecordId' value = '".$row->LibraryRecordId."'";
echo "<tr>";
echo "<td align='right' width='15%' class = 'datafield' >Library No</td>";
echo "<td width='2%' class='spacetd' > </td>";
echo "<td width='33%' class = 'dataview' >";
	foreach($libraryno as $rowa):
		if($row->LibraryNo == $rowa->LibraryNo){
			echo $rowa->LibraryNo;
		}
	endforeach;
echo "</td></tr>";

echo "<tr>";
echo "<td align='right' width='15%' class = 'datafield' >Book Name</td>";
echo "<td width='2%' class='spacetd' > </td>";
echo "<td width='33%' class = 'dataview' >";
	foreach($book as $rowb):
		if($row->BookCode == $rowb->BookCode){
			echo $rowb->BookName;
		}
	endforeach;

echo "</td></tr>";

echo "<tr>";
echo "<td align='right' width='15%' class = 'datafield' >Issued Date</td>";
echo "<td width='2%' class='spacetd' > </td>";
$IssuedDate=date("d-m-Y", strtotime($row->IssuedDate));
echo "<td width='33%' class = 'dataview' >".$IssuedDate ."</td>";
echo "</tr>";

echo "<tr>";
echo "<td align='right' width='15%' class = 'datafield' >Return Date</td>";
echo "<td width='2%' class='spacetd' > </td>";
$ReturnDate=date("d-m-Y", strtotime($row->ReturnDate));
echo "<td width='33%' class = 'dataview' >".$ReturnDate."</td>";
echo "</tr>";

echo "<tr>";
echo "<td align='right' width='15%' class = 'datafield' >Description</td>";
echo "<td width='2%' class='spacetd' > </td>";
echo "<td width='33%' class = 'dataview' >".$row->LibraryDes."</td>";
echo "</tr>";

endforeach;
echo '</table>';
echo "</div>";
echo "</div>";
?>
<script>
function edit_data(){
var rollid = $('input[name=LibraryRecordId]').val();
 window.location='<?=$url?>libraryrecord/edit/'+rollid;
}		
</script>
