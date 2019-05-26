<?php
if(isset($records) && count($records) > 0){
	$hostelfee = 0;$i = 0;
	foreach($records as $row){
		echo '<table border="0" cellpadding="0" cellspacing="0" id="record_tbl" style = "width:60%">';
		echo '<tr valign="top">
			<td height = "45" colspan="'.(count($subjects)+6).'" valign="top">    
				<table width="100%" border="0" cellpadding="0" cellspacing="0" id="record_header" style = "width:100%">
				  <tr id="recordtitle" >
					<th height = "25"  align="left" style="padding-left:10px;">Name</th>
					<th align="left" style="padding-left:10px;" >Father/Mother Name</th>
					<th align="center" >Role No</th>
					<th align="center" >Class</th>
					<th align="center" >Section</th>
				  </tr>
				  <tr id="recordtitlevalue">
					<td style="padding-left:10px;" >'.$row->StudentName.'</td>
					<td style="padding-left:10px;" >';
					if($row->FatherName != NULL){
						echo $row->FatherName;
					}else{
						echo $row->MotherName;
					}
				echo '</td>
					<td height = "20"  align="center" valign="middle">'.$row->RollNo.'</td>
					<td align="center" valign="middle" >'.$row->ClassName.'</td>
					<td align="center" valign="middle" >'.$row->SectionName.'</td>
				  </tr>
				</table>';
				}
		}
			echo '</td>
		   
		  </tr>';
		 if(isset($result) && count($result) > 0){
		 echo'<tr id="recordheader">
				<th height="30">SNO</th>
				<th>Exam Type</th>
				<th>Max Marks</th>';
				foreach($subjects as $sbj){
					echo '<th>'.$sbj->SubjectName.'</th>';
				}
				echo'<th>Total Marks</th>
				<th>Percent</th>
				<th>Class/Grade</th>';
		echo '</tr>';
		
		foreach($exammarks as $ex){
			$totalmarks = ($ex->Telugu + $ex->English + $ex->Hindi + $ex->Maths + $ex->Science + $ex->Social);
			$percent = 0; $grade = '';
			if(($ex->ExamMarks / 100) == 0){
				$percent = $totalmarks/6;
			}elseif(($ex->ExamMarks / 100) == 0.5){
				$percent = ($totalmarks * 2)/6;
			}elseif(($ex->ExamMarks / 100) == 0.25){
				
				$percent = ($totalmarks * 4)/6;
			}
			
			if( $percent > 0 &&  $percent < 30){
				$grade = 'Fail';
			}elseif($percent >= 30 &&  $percent < 50){
				$grade = 'C';
			}elseif($percent >= 50 &&  $percent < 80){
				$grade = 'B';
			}elseif($percent >= 80 &&  $percent <= 100){
				$grade = 'A';
			}
			$percent = number_format($percent,2);
			echo '<tr class = "row">';
			echo '<td align="center" valign="middle">'.++$i.'</td>';
			echo '<td height = "20"  align="center" valign="middle" style = "font-weight:bold;">'.$ex->ExamType.'</td>';
			echo '<td align="center" valign="middle" style = "font-weight:bold;" >'.$ex->ExamMarks.'</td>';
			echo '<td align="center" valign="middle">'.$ex->Telugu.'</td>';
			echo '<td align="center" valign="middle">'.$ex->English.'</td>';
			echo '<td align="center" valign="middle">'.$ex->Hindi.'</td>';
			echo '<td align="center" valign="middle">'.$ex->Maths.'</td>';
			echo '<td align="center" valign="middle">'.$ex->Science.'</td>';
			echo '<td align="center" valign="middle">'.$ex->Social.'</td>';
			echo '<td align="center" valign="middle">'.$totalmarks.'</td>';
			echo '<td align="center" valign="middle">'.$percent.'% </td>';
			echo '<td align="center" valign="middle">'.$grade.'</td>';
			echo '</tr>';
		}
		 
		}else{
			echo '<tr><td colspan = "'.(count($subjects)+6).'" align  = "center" ><span style = "color:red; font-weight:600; font-size:12px;" >Not yet paind any hostel term fees.</span></td></tr>';
		}	  
		
		echo '</table>';
?>