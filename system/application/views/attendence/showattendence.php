<?php
if(isset($records) && count($records) > 0){
	$hostelfee = 0;$i = 0;
	foreach($records as $row){
		echo '<table border="0" cellpadding="0" cellspacing="0" id="record_tbl" style = "width:60%">';
		echo '<tr valign="top">
			<td height = "45" colspan="5" valign="top">    
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
		 if(isset($attendence) && count($attendence) > 0){
			echo'<tr id="recordheader">
					<th height="30">SNO</th>
					<th>Months</th>
					<th>Total Days</th>
					<th>Present Days</th>
					<th>Percent</th>';
			echo '</tr>';
			$totalanttendm = 0; $totalanttenda = 0; $totaldays = 0;
		 foreach($attendence as $at){
	
			$totalpresent = ($at->Morning + $at->Afternoon)/2;
			$percent = ($totalpresent * 100)/$at->TotalDays;
			
			echo '<tr class = "row">';
			echo '<td align="center" valign="middle">'.++$i.'</td>';
			echo '<td height = "20"  align="center" valign="middle" style = "font-weight:bold;">'.$at->MonthName.'</td>';
			echo '<td align="center" valign="middle" style = "font-weight:bold;" >'.$at->TotalDays.'</td>';
			echo '<td align="center" valign="middle">'.$totalpresent.'</td>';
			echo '<td align="center" valign="middle">'.number_format($percent,2).'%</td>';
			echo '</tr>';
		}
		 
		}else{
			echo '<tr><td colspan = "'.(count($subjects)+6).'" align  = "center" ><span style = "color:red; font-weight:600; font-size:12px;" >Not yet paind any hostel term fees.</span></td></tr>';
		}	  
		
		echo '</table>';
?>