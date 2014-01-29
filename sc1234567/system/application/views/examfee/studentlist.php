<?php
	echo '<option value="x" >-- RollNo --</option>';
	foreach($rollno as $rno ){
		echo '<option value="'.$rno->RollNo.'" >'.$rno->RollNo.'</option>';
	}
?>