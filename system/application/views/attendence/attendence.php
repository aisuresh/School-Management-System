<?php
echo '<table class="reporttable" border="0" cellpadding="0" cellspacing="1" >  
        <tr><th colspan = "7" id = "table_title">Student Detail List View </th></tr>

				   <tr id="recordtitle" >
					    <th align="center" >S.No</th>
						<th align="center" ><input type = "hidden" name = "tablename" class="AttendenceId" id ="ordertype"  value = "0" /> </th>					
						<th align="center">Student RollNo</th>
						<th align="center">Student Name</th>
						<th align="center">Attend Date</th>
						<th align="center">Session</th>
						<th align="center">Attendance</th>
					</tr>';
$i = 1;
    // var_dump($attendance);
    if(isset($attendance) && $attendance >0){
	foreach ($attendance as $row){
	$AttendDate=date("d-m-Y", strtotime($row->AttendDate));
		echo "<tr>";
		echo "<td align='center' >" . $i++. "</td>";
		echo "<td align='center' ><input type='radio' name = 'AttendenceId' id = 'AttendenceId' value ='" . $row->AttendenceId . "'/></td>";
		echo "<td align='center'>" . $row->StudentRollNo . "</td>";
		echo "<td align='center'>" . $row->StudentName . "</td>";
		echo "<td align='center'>" . $AttendDate . "</td>";
		if( $row->SessionId == 1){
			echo "<td align='center'>Morning</td>";
		}else{
			echo "<td align='center'>Afternoon</td>";
		}	
		if( $row->Attendance ==  1){
			echo "<td align='center'>Present</td>";
		}else{
			echo "<td align='center'>Absent</td>";
		}	
		echo "</tr>";
	
	}
}
echo "</table>";
echo "<div class='pagenation'>" . $links . "</div>";
echo "</div>";
echo "</div>";
?>
