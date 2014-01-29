<?php
echo "<option value = 'x'>- - Select Section - -</option>";
foreach($section as $row):
		echo "<option value = '".$row->SectionId."' >";
		echo $row->SectionName;
		echo "</option>";
	endforeach;
?>