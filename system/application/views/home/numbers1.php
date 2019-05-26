<?php
echo '<select name="numberlist" id="numberlist" multiple="multiple" style = "width:180px;" >';
	foreach($numbers as $ns ){
		echo '<option style = "width:160px" value="'.$ns->MobileNo.'" >'.$ns->StudentName.'</option>';
	}
echo '</select>';
?>

<script type="text/javascript">
	$(document).ready(function(){
		$("#numberlist").multiselect({
			noneSelectedText: 'Numbers List'
		});
		
	});
	
</script>
