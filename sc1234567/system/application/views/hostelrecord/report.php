<?php
//var_dump($records);
if(isset($records) && count($records) > 0){
	$hostelfee = 0;
	
		echo '<table border="0" width = "80%"  cellpadding="0" cellspacing="0" id="record_tbl">';
		foreach($records as $row){
		echo '<tr valign="top">
			 <td height = "45" colspan="6" valign="top">    
				<table width="100%" border="0" cellpadding="0" cellspacing="0" id="record_header">
				  <tr id="recordtitle" >
					<th height = "25"  align="left" width="28%" style="padding-left:10px;">Name</th>
					<th align="left" width="28%" style="padding-left:10px;" >Father/Mother Name</th>
					<th align="center" width="5%">Roll No</th>
					<th align="center" width="5%">Class</th>
					<th align="center" width="5%">Section</th>
					<th align="center" width="20%">H-Join Date</th>
					<th align="center" width="15%">Hostel Fee</th>
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
					<td align="center" valign="middle" >'.$row->HostelJoinDate.'</td>
					<td align="center" valign="middle" >';
					$hostelfee = $row->HostelFee - $row->HostelFeeDiscount;
					echo $hostelfee;
					echo'</td>
				  </tr>
				</table>';
				}
		echo '</td>
		  </tr>';
		} 
		 
		
		 if(isset($result) && count($result) > 0){
		 echo'<tr id="recordheader">
			<th width="5%" height="30">Term No</th>
			<th width="32%">Paid By</th>
			<th width="18%">Paid Date</th>
			<th width="13%">Hostel Fees</th>
			<th width="13%">Paind Fees</th>
			<th width="13%">Remaining Fees</th>
		  </tr>';
		  $paid = 0; $k  = 0; $v = 0; $r = 0;$amount = 0; $tpaid = 0; $tremain = 0;
		 
			  foreach($result as $row){
			  $paid = $paid + $row->HostelTermFee;
			  $TermPaidDate=date("d-m-Y", strtotime($row->TermPaidDate));
			  echo '<tr class = "row" >
				   <td align="center" height="25">'.$row->HostelTermNo.'</td>
				   <td align="center" >'.$row->PaidBy.'</td>
				   <td align="center" >'.$TermPaidDate.'</td>';
			  if($k == 0){
			  		//$amount = $hostelfee - $paid;
					echo '<td align="center" height="25">'.$hostelfee.'</td>';
					
					$k++;
				}else{
					echo '<td align="center" height="25">'.$v.'</td>';
				}	
				
			echo '<td align="right" style="padding-right:10px;" >'.$row->HostelTermFee.'</td>';
				if($r==0){
					$v = $hostelfee - $row->HostelTermFee;
					echo '<td align="right" style="padding-right:10px;" >'.$v.'</td>';
					$r++;
				}else{
					$v = $v - $row->HostelTermFee;
					//$v = $amount - $row->HostelTermFee;
					echo '<td align="right" style="padding-right:10px;" >'.$v.'</td>';
				}
			  echo'</tr>';
			  }
			 echo '<tr style = "font-weight:600;" id="recordtitlevalue" >
			 	<td style="padding-right:10px;" height="25"> Total: '.$row->HostelTermNo.'</td>
				<td></td>
				<td></td>
				<td></td>
				<td align="right" style="padding-right:10px;" > Total Paid: '.$paid.'</td>
				<td align="right" style="padding-right:10px;" > Total Balance: '.($hostelfee - $paid).'</td>
			 </tr>'; 
		}else{
			echo '<tr><td colspan = "6" align  = "center" ><span style = "color:red; font-weight:600; font-size:12px;" >Not yet paid any hostel term fees.</span></td></tr>';
		}	  
		
		echo '</table>';
?>
