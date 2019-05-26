<?php

echo "<div class='container'>";
echo "<div class='content_header'>";
/*---------------     content title       ---------------------*/
echo "<div class='content_title'>";
echo $pagetitle.' > '. $event;
echo "</div>";
echo "<div class='content_message'>";
echo "";
echo "</div>";
/*---------------     content events       ---------------------*/
echo "<div class='content_events'>";

echo "<div class='events'>";
echo "<a href='".$url."student/listview/".$this->session->userdata('yearsh')."' >";
echo "<span><img src='".$url."images/cancel.png' border='0' /></span>";
echo "<span> Cancel </span>";
echo "</a>";
echo "</div>";

echo "<div class='events'>";
echo "<a onClick = 'edit_data();' >";
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
echo "<td align='right' width='15%' class = 'datafield'>MotherTongue</td>";
echo "<td width='2%' class='spacetd' > </td>";
echo "<td width='33%' class = 'dataview'>";
	foreach ($mothertongue as $rowc){
	if($rowc->MotherTongueId == $row->MotherTongueId){
		 echo $rowc->MotherTongue;
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

echo "<tr>";
echo "<td align='right' width='15%' class = 'datafield'>BloodGroup</td>";
echo "<td width='2%' class='spacetd' > </td>";
echo "<td width='33%' class = 'dataview'>";
	foreach ($bloodgroup as $rowc){
	if($rowc->BloodGroupId == $row->BloodGroupId){
		 echo $rowc->BloodGroupType;
	}
}
echo "</td>";
echo "</tr>";



endforeach;
echo '</table>';
echo "</div>";
echo "</div>";
?>
<script>
function edit_data(){
     var rollid = $('input[name=StudentId]').val();
	 window.location='<?=$url?>student/edit/'+rollid;
	
 
}	
function view_data(){
	var rollid = $('input:radio[name=StudentId]:checked').val();
	if(rollid == 'undefined' || rollid == null ){
		alert('Please select any one record' );
	} else {
	 window.location='<?=$url?>student/view/'+rollid;
	}	 
	 
}	
		
</script>
