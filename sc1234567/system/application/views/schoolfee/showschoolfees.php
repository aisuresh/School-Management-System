<?php
echo "<table class='reporttable' border='0' cellpadding='0' cellspacing='1' >";
       // var_dump($records);
	   if(isset($records) && count($records) > 0){
		foreach($records as $row){
		echo '<tr valign="top">
			<td height = "45" colspan="6" valign="top">    
				<table width="100%" border="0" cellpadding="0" cellspacing="0" id="record_header">
				  <tr id="recordtitle" >
					<th height = "25"  align="left" width="28%" style="padding-left:10px;">Name</th>
					<th align="left" width="28%" style="padding-left:10px;" >Father/Mother Name</th>
					<th align="center" width="5%">Addmission No</th>
					<th align="center" width="5%">Class</th>
					<th align="center" width="5%">Section</th>
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
					<td align="center" valign="middle" >'.$row->SectionName.'</td>';
				}		
					echo '<td align="center" valign="middle" >';
					echo $studentfees;
					echo'</td>
					
				  </tr>
				</table>';
			echo '</td>
		  </tr>';
echo "<tr>";
echo "<th align='center' >#</th>";
echo "<th align='center' >Receipt No</th>";
echo "<th align='center' >Term No</th>";
echo "<th align='center' >Paid Date</th>";
echo "<th align='center' >Paid Fees</th>";
echo "<th align='center' >Remaining Fee</th>";

echo "</tr>";
}
else{
			echo '<tr><td colspan = "6" align  = "center" ><span style = "color:red; font-weight:600; font-size:12px;" >Not yet paid any school fees.</span></td></tr>';
}	  
		
$i = 1; //$amtRemaining = 0;
$t = 0;
if(isset($result) && count($result) > 0){
if($result == false){
	echo '<tr><span style="font-weight:bold; font-size:16px; color:#EA0000;"> No data to display</span></tr>';

}else{

foreach ($result as $row){
$PaidDate=date("d-m-Y", strtotime($row->PaidDate));
echo "<tr>";
echo "<td align='center' >" . $i++. "</td>";
echo "<td align='center'>" . $row->ReceiptNo . "</td>";
echo "<td align='center'>" . $row->TermNo . "</td>";
echo "<td align='center'>" . $PaidDate . "</td>";
echo "<td align='right'>".$row->Fees."</td>";
$t = $t+ $row->Fees;
$t = number_format($t,2);
$amtRemaining = $totalfee - $t;
$amtRemaining = number_format($amtRemaining,2);
echo "<td align='right'>".$amtRemaining."</td>";

echo "</tr>";
}
echo "<tr style='background-color:#e4eef0; color:#000;'>";
//echo "<td align='center' style = 'border-right:0; border-left:0;'></td>";
echo "<td align='center' style = 'border-right:0; border-left:0;' callspan = '2' ><span style='float:left; margin-left:10px; color:#000;' >Total Fee: " .$totalfee.'/-'."</span></td>";
echo "<td align='center' style = 'border-right:0; border-left:0;' ></td>";
//echo "<td align='right' style ='color:#000; border-right:0; border-left:0;'></td>";
echo "<td align='right' style ='color:#000;' >Paid: " .$t."/-</td>";
echo "<td align='right' style ='color:#000;' >Balence: ".$amtRemaining."/-</td>";

echo "</tr>";

}
}
else{
			echo '<tr><td colspan = "6" align  = "center" ><span style = "color:red; font-weight:600; font-size:12px;" >Not yet paid any school fees.</span></td></tr>';
}
echo "</table>";
?>
