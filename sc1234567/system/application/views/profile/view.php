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
echo "</div>";
echo "</div>";
/*---------------     content        ---------------------*/
echo "<div align = 'center' class='content'>";
echo "<table border='0' cellpadding='0' cellspacing = '0' class='formtable'>";

$rollid = $this->session->userdata('RollId');
if($rollid == '6' || $rollid == '7'){
$table = 'student';
$where = array(
				array('condition' => $table.'.StudentId', 'value' => $this->session->userdata('RNo'))
				);
		
$result1 = $this->Adminmodel->show_rows($table, $where);
foreach($result1 as $row):
echo "<tr>";
echo "<td align='right' width='15%' class = 'datafield' >Student Roll No</td>";
echo "<td width='2%' class='spacetd'> <input type = 'hidden' name = 'StudentId' id = 'StudentId' value = '".$row->StudentId."'/> </td>";
echo "<td width='33%' class = 'dataview' > ".$row->StudentRollNo."</td>";
echo "</tr>";

echo "<tr>";
echo "<td align='right' width='15%'  class = 'datafield'>Student Name</td>";
echo "<td width='2%' class='spacetd'> </td>";
echo "<td width='33%' class = 'dataview'>".$row->StudentName."</td>";
echo "</tr>";

echo "<tr>";
echo "<td align='right' width='15%' class = 'datafield'>Father Name</td>";
echo "<td width='2%' class='spacetd' > </td>";
echo "<td width='33%' class = 'dataview'>".$row->FatherName."</td>";
echo "</tr>";

echo "<tr>";
echo "<td align='right' width='15%' class = 'datafield'>Mother Name</td>";
echo "<td width='2%' class='spacetd' > </td>";
echo "<td width='33%' class = 'dataview'>".$row->MotherName."</td>";
echo "</tr>";

echo "<tr>";
echo "<td align='right' width='15%' class = 'datafield'>Father Accupation</td>";
echo "<td width='2%' class='spacetd' > </td>";
echo "<td width='33%' class = 'dataview'>".$row->FatherAccupation."</td>";
echo "</tr>";

echo "<tr>";
echo "<td align='right' width='15%' class = 'datafield'>Mother Accupation</td>";
echo "<td width='2%' class='spacetd' > </td>";
echo "<td width='33%' class = 'dataview'>".$row->MotherAccupation."</td>";
echo "</tr>";

echo "<tr>";
echo "<td align='right' width='15%' class = 'datafield'>Data of Birth</td>";
echo "<td width='2%' class='spacetd' > </td>";
$DateOfBirth=date("d-m-Y", strtotime($row->DateOfBirth));
echo "<td width='33%' class = 'dataview' >".$DateOfBirth."</td>";
echo "</tr>";

echo "<tr>";
echo "<td align='right' width='15%' class = 'datafield'>Gender</td>";
echo "<td width='2%' class='spacetd' > </td>";
echo "<td width='33%' class = 'dataview'>"; 
if($row->Gender == 'm'){
echo 'Male';
}else{
echo 'Female';
}
echo "</td></tr>";

echo "<tr>";
echo "<td align='right' width='15%' class = 'datafield'>Cast</td>";
echo "<td width='2%' class='spacetd' > </td>";
echo "<td width='33%' class = 'dataview'>".$row->Cast."</td>";
echo "</tr>";


echo "<tr>";
echo "<td align='right' width='15%' class = 'datafield'>Cast Category</td>";
echo "<td width='2%' class='spacetd' > </td>";
echo "<td width='33%' class = 'dataview'>";
	foreach ($castcategory as $rowb){
	if($rowb->CastCategoryId == $row->CastCategoryId){
		 echo $rowb->CastCategory;
	}
}
echo "</td>";
echo "</tr>";


echo "<tr>";
echo "<td align='right' width='15%' class = 'datafield'>Nationality</td>";
echo "<td width='2%' class='spacetd' > </td>";
echo "<td width='33%' class = 'dataview'>";
	foreach ($nationality as $rowc){
	if($rowc->NationalityId == $row->NationalityId){
		 echo $rowc->Nationality;
	}
}
echo "</td>";
echo "</tr>";


echo "<tr>";
echo "<td align='right' width='15%' class = 'datafield'>Village / Town</td>";
echo "<td width='2%' class='spacetd' > </td>";
echo "<td width='33%' class = 'dataview'>".$row->Town."</td>";
echo "</tr>";

echo "<tr>";
echo "<td align='right' width='15%' class = 'datafield'>PH</td>";
echo "<td width='2%' class='spacetd' > </td>";
echo "<td width='33%' class = 'dataview'>".$row->PH."</td>";
echo "</tr>";

echo "<tr>";
echo "<td align='right' width='15%' class = 'datafield'>Address</td>";
echo "<td width='2%' class='spacetd' > </td>";
echo "<td width='33%' class = 'dataview'>".$row->Address."</td>";
echo "</tr>";

echo "<tr>";
echo "<td align='right' width='15%' class = 'datafield'>Phone No</td>";
echo "<td width='2%' class='spacetd' > </td>";
echo "<td width='33%' class = 'dataview'>".$row->PhoneNo."</td>";
echo "</tr>";

echo "<tr>";
echo "<td align='right' width='15%' class = 'datafield'>Mobile No</td>";
echo "<td width='2%' class='spacetd' > </td>";
echo "<td width='33%' class = 'dataview'>".$row->MobileNo."</td>";
echo "</tr>";

echo "<tr>";
echo "<td align='right' width='15%' class = 'datafield'>Email</td>";
echo "<td width='2%' class='spacetd' > </td>";
echo "<td width='33%' class = 'dataview'>".$row->Email."</td>";
echo "</tr>";

echo "<tr>";
echo "<td align='right' width='15%' class = 'datafield'>On TC</td>";
echo "<td width='2%' class='spacetd' > </td>";
echo "<td width='33%' class = 'dataview'>";
if($row->OnTC == 'Y'){
	echo "Yes";
}else{
	echo "No";
}
echo "</td></tr>";

endforeach;
echo '</table>';
}
else{
 $table = 'staff';
 $where = array(
	array('condition' => $table.'.StaffId', 'value' => $this->session->userdata('RNo'))
);
$result = $this->Adminmodel->show_rows($table, $where);
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
}
echo "</div>";
echo "</div>";
?>
<script>
function edit_data(){
var rollid = $('input[name=StaffId]').val();
 window.location='<?=$url?>staff/edit/'+rollid;
}		
</script>
