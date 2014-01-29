<?php
echo "<option value = 'x'>- - Select RollNo - -</option>";
var_dump($rollno);
foreach($rollno as $rowa):
		echo "<option value = '".$rowa->RollId."' >";
		echo $rowa->RollId;
		echo "</option>";
endforeach;
?>