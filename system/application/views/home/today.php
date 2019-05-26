<?php
?>
<html>
<head></head>
<body> 
<div style=" width:500px; float:left; margin-top:5px; ">  
<table width="440"  border="0" class="todayinfo_tbl"  >
	<tr>
        <td align="center" height="52" class="field_title" colspan="8"  >Attendence Info</td>
  	</tr>
    
  <tr class = 'info_title' >
    <td width="60" rowspan="2" >Class</td>
    <td width="240" colspan="3" >Total Students</td>
    <td width="50"  rowspan="2" >Boys Today</td>
    <td width="50" rowspan="2" >Girls Today</td>
    <td width="30" rowspan="2" >Total Attendence Today</td>
  </tr>
  
  <tr class = 'info_titlea' >
    <td>Boys</td>
    <td>Girls</td>
    <td>Total</td>
  </tr>
  <?php
 // foreach($totalattend as $ta){
  echo '<tr class="info_value">
    
    <td colspan = "4" valign = "top">
		<table width = "100%" border="0" >';
		//var_dump($totalattend);
		foreach($totalattend as $ta){
		echo '<tr align = "center"  >
			<td  width = "25%" style = "border-bottom:2px solid #fff; border-right:2px solid #fff;">'.$ta->cn.'</td> <td width = "25%" style = "border-bottom:2px solid #fff; border-right:2px solid #fff;">'.$ta->male.'</td> <td width = "25%" style = "border-bottom:2px solid #fff; border-right:2px solid #fff;">'.$ta->female.'</td> <td width = "25%" style = "border-bottom:2px solid #fff;">'.$ta->sto.'</td>
		</tr>';
		}
		echo '</table>';
	echo '</td>
    <td colspan = "3" valign = "top">
		<table  width = "100%" border ="0" >';
		//var_dump($todayattend);
		foreach($todayattend as $tda){
		echo '<tr align = "center" >
			<td width = "27%" style = "border-bottom:2px solid #fff; border-right:2px solid #fff;" >'.$tda->male.'</td> <td width = "28%" style = "border-bottom:2px solid #fff; border-right:2px solid #fff;" >'.$tda->female.'</td> <td width = "45%" style = "border-bottom:2px solid #fff; ">'.$tda->ttol.'</td> 
		</tr>';
		}
		echo '</table>';
	echo '</td>
    </tr>';
 // }
  ?>
</table>
</div>
<div style=" width:553px; height:377px; overflow-x:hidden; overflow-y:scroll; float:left; margin-top:5px; ">
<table width="530"  border="0" class="todayinfo_tbl" >
	<tr>
        <td align="center" height="52" class="field_title" colspan="8" >Term Fees Info</td>
  	</tr>
    
  <tr class = 'info_title' >
  	<td width="20">#</td>
  	<td width="60">Roll No</td>
    <td width="150">Student Name</td>
    <td width="60">Class</td>
    <td width="60">Term No</td>
    <td width="80">Receipt No</td>
    <td width="100"> Amount</td>
  </tr>
 <?php
 $i = 1;
 //var_dump($termfees);
 if(count($termfees) > 0){
	 foreach($termfees as $fee){ 
	  echo '<tr align = "center" class="info_value">
		<td >'.$i.'</td>
		<td >'.$fee->StudentId.'</td>
		<td >'.$fee->StudentName.'</td>
		<td >'.$fee->ClassName.'</td>
		<td >'.$fee->TermNo.'</td>
		<td >'.$fee->ReceiptNo.'</td>
		<td style = "text-align:right; padding-right:5px">'.$fee->Fees.'</td>
	  </tr>';
	  $i++;
	 }
}else{
 echo '<tr class="info_value"><td align = "center" style="font-weight:bold; color:#000" colspan="8" >There is no data to display</td>';
 }
 ?>
 
 </table>
</div>
<div style=" width:490px; height:276px; overflow-x:hidden; overflow-y:scroll; float:left; margin-top:5px;" >
<table width="480"  border="0" class="todayinfo_tbl" >
	<tr>
        <td align="center" height="52" class="field_title" colspan="8" >Spent Amount Info</td>
  	</tr>
    
  <tr class = 'info_title' >
  	<td width="20">#</td>
  	<td width="190">Spent For</td>
    <td width="90">Bill No</td>
    <td width="90">Amount</td>
    <td width="90">Spent by</td>
  </tr>
  <?php
  $i = 1;
  if($spentamount > 0){
	  foreach ($spentamount as $sa){
	  
	 echo ' <tr class="info_value">';
		echo '<td >'.$i.'</td>';
	echo '<td >';
foreach ($spentamount1 as $rowb){
	if($sa->ExpenditureTypeId == $rowb->ExpenditureTypeId){
		echo  $rowb->ExpenditureType;
	}
	
}
		echo '</td>';
		echo '<td >'.$sa->BillNo.'</td>';
		echo '<td >'.$sa->BillAmount.'</td>';
		echo '<td >'.$sa->SpentBy.'</td>';
	   echo '</tr>';
	  $i++;
	  }
}else{
 	echo '<tr class="info_value"><td align = "center" style="font-weight:bold; color:#000" colspan="8" >There is no data to display</td>';
 }
  
 ?> 
</table>
</body>
</div>
