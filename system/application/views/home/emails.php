<?php
echo '<select name="emaillist" id="emaillist" multiple="multiple" style = "width:180px;" >';
	foreach($emails as $es ){
		echo '<option style = "width:160px" value="<'.$es->Email.'>" >'.$es->StudentName.'</option>';
	}
echo '</select>';
?>

<script type="text/javascript">
	$(document).ready(function(){
		$("#emaillist").multiselect({
			noneSelectedText: 'Emails List'
		});
		
	});
	
</script>
