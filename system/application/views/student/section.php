<?php
echo "<option value = 'x'>- - Select Section - -</option>";
foreach($section as $row){
	foreach($section as $rowa):
		if($row->SectionId == $rowa->SectionId){
			echo "<option value = '".$rowa->SectionId."' >";
			echo $rowa->SectionName;
			echo "</option>";
		}	
	endforeach;
}

?>