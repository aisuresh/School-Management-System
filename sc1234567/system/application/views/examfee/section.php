<?php
	echo '<option value="x" >-- Select Section --</option>';
	
	foreach($section as $se ){
		echo '<option value="'.$se->SectionId.'" >'.$se->SectionName.'</option>';
	
	}
	}
?>