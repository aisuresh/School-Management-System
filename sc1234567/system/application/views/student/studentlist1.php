<?php
  echo '<table class="reporttable" border="0" cellpadding="0" cellspacing="1" >  
        <tr><th colspan = "7" id = "table_title">Student Detail List View </th></tr>

				   <tr id="recordtitle" >
					    <th align="center" >S.No</th>
						<th align="center" ><input type = "hidden" name = "tablename" class="studentId" id ="ordertype"  value = "0" /> </th>					
						<th align="center">Roll No</th>
						<th align="center">Student Name</th>
						<th align="center">Father Name</th>
						<th align="center">Mother Name</th>
						<th align="center">Mobile No</th>
					</tr>';
   
	
	$i = 1;
	if($result == false){
		echo '<tr><span style="font-weight:bold; font-size:16px; color:#EA0000;"> No data to display</span></tr>';
	}else{
		foreach($result as $row){
		            echo '<tr>
					<tr id="recordtitlevalue">
					<td align="center" >' . $i++. '</td>
					<td align="center" ><input type="radio" name = "StudentId" id = "StudentId" value =' . $row->StudentId . '/></td>	
					<td align="center" >'.$row->StudentRollNo.'</td>
					<td align="center">'.$row->StudentName. '</td>
		            <td align="center">'.$row->FatherName. '</td>
		            <td align="center">'.$row->MotherName. '</td>
				    <td align="center">'.$row->MobileNo.'</td>';
					
		}
	}
	echo '</tr>';
	       
		   
echo '</table>';    
echo "<div class='pagenation'>" . $links . "</div>";
echo "</div>";
echo "</div>";
?>
