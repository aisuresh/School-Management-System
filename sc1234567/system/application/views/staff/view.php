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
echo "<a href='".$url."staff/listview' >";
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
echo "<input type='hidden' name = 'StaffId' id = 'StaffId' value = '".$row->StaffId."'";

echo "<tr>";
echo "<td align='right' width='15%' class = 'datafield' >Staff Name</td>";
echo "<td width='2%' class='spacetd' > </td>";
echo "<td width='33%' class = 'dataview' >".$row->StaffName ."</td>";
echo "</tr>";

echo "<tr>";
echo "<td align='right' width='15%' class = 'datafield' > Staff Type </td>";
echo "<td width='2%' class='spacetd' > </td>";
echo "<td width='33%' class = 'dataview' >";
	foreach($stafftype as $rowa):
	if($row->StaffTypeId == $rowa->StaffTypeId){
		echo $rowa->StaffType;

	}
	endforeach;
echo "</td></tr>";

echo "<tr>";
echo "<td align='right' width='15%' class = 'datafield' >Gender</td>";
echo "<td width='2%' class='spacetd' > </td>";
echo "<td width='33%' class = 'dataview' >";
if($row->Gender == 'm'){
echo 'Male';
}else if($row->Gender == 'f')
{
echo 'Female';
}
else 
echo "";
echo"</td></tr>";

$DateOfBirth = date("d-m-Y", strtotime($row->DateOfBirth));
echo "<tr>";
echo "<td align='right' width='15%' class = 'datafield' >DateOfBirth</td>";
echo "<td width='2%' class='spacetd' > </td>";
echo "<td width='33%' class = 'dataview' >".$DateOfBirth."</td>";
echo "</tr>";

echo "<tr>";
echo "<td align='right' width='15%' class = 'datafield' >Qualification</td>";
echo "<td width='2%' class='spacetd' > </td>";
echo "<td width='33%' class = 'dataview' >";
foreach ($qualification as $rowb){
	if($row->QualificationId == $rowb->QualificationId){
		 echo $rowb->graduation;
	}
	
}
echo "</td></tr>";

echo "<tr>";
echo "<td align='right' width='15%' class = 'datafield' >Experiance</td>";
echo "<td width='2%' class='spacetd' > </td>";
echo "<td width='33%' class = 'dataview' >".$row->TotalExperiance."</td>";
echo "</tr>";

echo "<tr>";
echo "<td align='right' width='15%' class = 'datafield' >Subject01</td>";
echo "<td width='2%' class='spacetd' > </td>";
echo "<td width='33%' class = 'dataview' >".$row->Subject01."</td>";
echo "</tr>";

echo "<tr>";
echo "<td align='right' width='15%' class = 'datafield' >Subject02</td>";
echo "<td width='2%' class='spacetd' > </td>";
echo "<td width='33%' class = 'dataview' >".$row->Subject02."</td>";
echo "</tr>";

echo "<tr>";
echo "<td align='right' width='15%' class = 'datafield' >Subject03</td>";
echo "<td width='2%' class='spacetd' > </td>";
echo "<td width='33%' class = 'dataview' >".$row->Subject03."</td>";
echo "</tr>";

echo "<tr>";
echo "<td align='right' width='15%' class = 'datafield' >Phone No</td>";
echo "<td width='2%' class='spacetd' > </td>";
echo "<td width='33%' class = 'dataview' >".$row->PhoneNo."</td>";
echo "</tr>";

echo "<tr>";
echo "<td align='right' width='15%' class = 'datafield' >Mobile No</td>";
echo "<td width='2%' class='spacetd' > </td>";
echo "<td width='33%' class = 'dataview' >".$row->MobileNo."</td>";
echo "</tr>";

echo "<tr>";
echo "<td align='right' width='15%' class = 'datafield' >Email</td>";
echo "<td width='2%' class='spacetd' > </td>";
echo "<td width='33%' class = 'dataview' >".$row->Email."</td>";
echo "</tr>";

echo "<tr>";
echo "<td align='right' width='15%' class = 'datafield' >Town / Village</td>";
echo "<td width='2%' class='spacetd' > </td>";
echo "<td width='33%' class = 'dataview' >".$row->Town."</td>";
echo "</tr>";

echo "<tr>";
echo "<td align='right' width='15%' class = 'datafield' >Address</td>";
echo "<td width='2%' class='spacetd' > </td>";
echo "<td width='33%' class = 'dataview' >".$row->Address."</td>";
echo "</tr>";

echo "<tr>";
echo "<td align='right' width='15%' class = 'datafield' >Status</td>";
echo "<td width='2%' class='spacetd' > </td>";
echo "<td width='33%' class = 'dataview' >".$row->Status."</td>";
echo "</tr>";

echo "<tr>";
echo "<td align='right' width='15%' class = 'datafield' >Description</td>";
echo "<td width='2%' class='spacetd' > </td>";
echo "<td width='33%' class = 'dataview' >".$row->StaffDes."</td>";
echo "</tr>";
endforeach;
echo '</table>';
echo "</div>";
echo "</div>";
?>
<script>
function edit_data(){
var rollid = $('input[name=StaffId]').val();
 window.location='<?=$url?>staff/edit/'+rollid;
}		
</script>
