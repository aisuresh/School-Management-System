<link rel="stylesheet" href="<?=$url?>css/zebra_transform.css" type="text/css">
<script type="text/javascript" src="<?=$url?>js/zebra_transform.js"></script>
<script type="text/javascript" src="<?=$url?>js/functions.js"></script>
<style>
	
</style>
<?php
$i = 1;
echo'<table border="0" cellpadding="0" cellspacing="0" id = "attendance_tbl" >';
foreach($studentlist as $sl){
echo'<tr>
		<td class = "sno" align = "center" >'.$i.' </td>
    	<td class = "label" width = "200" align ="right" ><label for="checkbox">'.$sl->StudentName.'</label></td>
    	<td width = "20" >&nbsp;</td>
    	<td class = "check_box" width = "50" align = "left" >
 			<div class = "checkbox" name = "checkbox" >
				<a href = "#" onClick = "student_attend_fun('.$i.');" id = "attendance'.$i.'" >
					<input type = "hidden" name = "attendval" id = "attendval'.$i.'" value = "0" />
					<input type = "hidden" name = "RollNo" id = "RollNo'.$i.'" value = "'.$sl->RollNo.'" />
				</a>
			</div>
		</td>
    </tr>';
  $i++;
  }
 echo '<input type = "hidden" name = "TotalStudents" id = "TotalStudents" value = "'.$i.'" />';
echo'</table>';
echo'<div style = "float:left; width:100%; margin-top:10px;" >';
	echo '<input type = "button" name = "save" id = "save" onClick = "sava_attend_fun();" value = "Save Attendance" />';
echo'</div>';
?>
