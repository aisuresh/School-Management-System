<?php
	echo '<option value="x" >-- Select RollNo --</option>';
	foreach($studentlist as $rno ){
		echo '<option value="'.$rno->StudentId.'" >'.$rno->StudentId.'</option>';
	}
?>
