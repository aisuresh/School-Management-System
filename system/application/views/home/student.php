<?php

echo '<div style=" width:808px; height:800px; float:left;" >
<table width="788"  border="0" class="studentinfo_tbl">
	<tr>
        <td align="center" width="158" height="52" class="field_title" colspan="4" >Search Student</td>
  	</tr>
    
	<tr>
        <td width="160" class="field" >Search Student</td>
        <td width="225" class="info" colspan="3">
			<input type="text" name="StudentId" id="StudentId" /> 
			<input type="button" name="search" id="search" value="Go" onClick = "student_search();" />
		</td>
  </tr>
</table>  

<table width="788" border="0" class="studentinfo_tbl">
	<tr>
        <td align="center" width="158" height="52" class="field_title" colspan="4" >Student Info</td>
  	</tr>';
//var_dump($student);	
if(isset($student) && $student > 0){	
 foreach($student as $row){   
echo '<tr>
    <td width="160" class="field" >Student Name</td>
    <td width="225" class="info">'.$row->StudentName.'</td>
    <td width="160" class="field">Nationality</td>
    <td width="225" class="info">'.$row->Nationality.'</td>
  </tr>
  
  <tr>
    <td class="field" >Father Name</td>
    <td class="info" >'.$row->FatherName.'</td>
    <td class="field" >Phone No</td>
    <td class="info" >'.$row->PhoneNo.'</td>
  </tr>
  <tr>
    <td class="field" >Mother Name</td>
    <td class="info" >'.$row->MotherName.'</td>
    <td class="field">Mobile No</td>
    <td class="info" >'.$row->MobileNo.'</td>
  </tr>
  <tr>
    <td class="field" >Father Accupation</td>
    <td class="info" >'.$row->FatherAccupation.'</td>
    <td class="field" >E-Mail</td>
    <td class="info" >'.$row->Email.'</td>
  </tr>
  <tr>
    <td class="field" >Mother Accupation</td>
    <td class="info" >'.$row->MotherAccupation.'</td>
    <td class="field">Class</td>
    <td class="info" >'.$row->ClassName.'</td>
  </tr>
  <tr>
    <td class="field" >Date of Birth</td>
    <td class="info" >'.$row->DateOfBirth.'</td>
    <td class="field">On TC</td>
    <td class="info" >'.$row->OnTC.'</td>
  </tr>
    <tr>
    <td class="field" >Gender</td>
    <td class="info" >';
	if($row->Gender == 'f') 
	  echo "Female";
	 else 
	  echo "Male";
	  echo  '</td>
    <td class="field" >&nbsp;</td>
    <td class="info" >&nbsp;</td>
  </tr>
    <tr>
    <td class="field" >Town/Village</td>
    <td class="info" >'.$row->Town.'</td>
    <td class="field" >&nbsp;</td>
    <td class="info">&nbsp;</td>
  </tr>
    <tr>
    <td class="field" >Cast</td>
    <td class="info" >'.$row->Cast.'</td>
    <td class="field" >&nbsp;</td>
    <td class="info" >&nbsp;</td>
  </tr>
  <tr>
    <td class="field" >Cast Category</td>
    <td class="info" >'.$row->CastCategory.'</td>
    <td class="field" >&nbsp;</td>
    <td class="info">&nbsp;</td>
  </tr>';
 } 
 }else{
 	echo '<tr>
        <td align="center" width="158" height="52" class="field" colspan="4" >Search Student Information</td>
  	</tr>';
 }
echo '</table>';

echo '<table width="788"  border="0"  class="studentinfo_tbl" cellpadding="0" >
	<tr>
        <td align="center" width="158" height="52" class="field_title" colspan="4" >Attendence Info</td>
  	</tr>

	<tr>
      <td width="158" height="52" class="field" >Month</td>
      <td width="620" class="info" colspan="3" rowspan="2">
      <table width="100%" height="100%" border="0" class="attendence_tbl" >
        <tr>
          <th>JAN</th>
          <th>FEB</th>
          <th>MAR</th>
          <th>APR</th>
          <th>MAY</th>
          <th>JUN</th>
          <th>JUL</th>
          <th>AUG</th>
          <th>SEP</th>
          <th>OCT</th>
          <th>NOV</th>
          <th>DEC</th>
        </tr><tr>';
	
		if(isset($attend) && $attend > 0){  
	 
	 foreach($attend as $rowa){ 
	 	if($rowa->MonthId == 1){ 
         	echo ' <td>' . $rowa->TotalDays . ' / ' . ($rowa->Morning + $rowa->Afternoon)/2 . '</td>';
	 	}elseif($rowa->MonthId == 2){ 
         	echo ' <td>' . $rowa->TotalDays . ' / ' . ($rowa->Morning + $rowa->Afternoon)/2 . '</td>';
	 	}elseif($rowa->MonthId == 3){ 
         	echo ' <td>' . $rowa->TotalDays . ' / ' . ($rowa->Morning + $rowa->Afternoon)/2 . '</td>';
	 	}elseif($rowa->MonthId == 4){ 
         	echo ' <td>' . $rowa->TotalDays . ' / ' . ($rowa->Morning + $rowa->Afternoon)/2 . '</td>';
	 	}elseif($rowa->MonthId == 5){ 
         	echo ' <td>' . $rowa->TotalDays . ' / ' . ($rowa->Morning + $rowa->Afternoon)/2 . '</td>';
	 	}elseif($rowa->MonthId == 6){ 
         	echo ' <td>' . $rowa->TotalDays . ' / ' . ($rowa->Morning + $rowa->Afternoon)/2 . '</td>';
	 	}elseif($rowa->MonthId == 7){ 
         	echo ' <td>' . $rowa->TotalDays . ' / ' . ($rowa->Morning + $rowa->Afternoon)/2 . '</td>';
	 	}elseif($rowa->MonthId == 8){ 
         	echo ' <td>' . $rowa->TotalDays . ' / ' . ($rowa->Morning + $rowa->Afternoon)/2 . '</td>';
	 	}elseif($rowa->MonthId == 9){ 
         	echo ' <td>' . $rowa->TotalDays . ' / ' . ($rowa->Morning + $rowa->Afternoon)/2 . '</td>';
	 	}elseif($rowa->MonthId == 10){ 
         	echo ' <td>' . $rowa->TotalDays . ' / ' . ($rowa->Morning + $rowa->Afternoon)/2 . '</td>';
	 	}elseif($rowa->MonthId == 11){ 
         	echo ' <td>' . $rowa->TotalDays . ' / ' . ($rowa->Morning + $rowa->Afternoon)/2 . '</td>';
	 	}elseif($rowa->MonthId == 12){ 
         	echo ' <td>' . $rowa->TotalDays . ' / ' . ($rowa->Morning + $rowa->Afternoon)/2 . '</td>';
	 	}else{
			echo '<td>&nbsp;</td>';
		}				  
     }    
  echo '</tr>';
  }else{
 	echo '<tr>
        <td align="center" width="158" height="52" style="font-weight:bold; color:#000" colspan="12" >There is no data to display</td>
  	</tr>';
 }
 echo '</table> 
 <tr>
        <td width="158" height="52" class="field" >Days</td>
  </tr>
</table>';

echo '<table width="788"  border="0"  class="studentinfo_tbl" cellpadding="0" cellspacing="0">
	<tr>
        <td align="center" width="158" height="52" class="field_title" colspan="4" >Exam Marks Info</td>
  	</tr>

	<tr>
    <td>
    <table width="100%" height="100%" border="0" class="attendence_tbl" >
        <tr>';
			echo ' <th colspan = "2" >Subject</th>';
			
        foreach($examtype as $ey){ 
		 echo ' <th colspan = "2" >'.$ey->ExamType.'</th>';
      	}    
       echo '</tr>';
	if(isset($marksa) && $marksa > 0){	
		foreach($marksa  as $mks){
			 echo '<tr>
			  <td class="subject" colspan = "2">'.$mks->SubjectName.'</td>';
			  if( $mks->ExamTypeId1 != 0){
			  	echo '<td >'.$mks->TotalMarks.'</td>';
				echo '<td >'.$mks->ExamTypeId1.'</td>';
			  }else{
				echo '<td >&nbsp;</td>';
				echo '<td >&nbsp;</td>';
			  } 
			  if($mks->ExamTypeId2 != 0){
			  	echo '<td >'.$mks->TotalMarks.'</td>';
				echo '<td >'.$mks->ExamTypeId2.'</td>';
			  }else{
				echo '<td >&nbsp;</td>';
				echo '<td >&nbsp;</td>';
			  } 
			  if($mks->ExamTypeId3 != 0){
			  	echo '<td >'.$mks->TotalMarks.'</td>';
				echo '<td >'.$mks->ExamTypeId3.'</td>';
			  }else{
				echo '<td >&nbsp;</td>';
				echo '<td >&nbsp;</td>';
			  } 
			  if($mks->ExamTypeId4 != 0){
			  	echo '<td >'.$mks->TotalMarks.'</td>';
				echo '<td >'.$mks->ExamTypeId4.'</td>';
			  }else{
				echo '<td >&nbsp;</td>';
				echo '<td >&nbsp;</td>';
			  } 
			  if($mks->ExamTypeId5 != 0){
			  	echo '<td >'.$mks->TotalMarks.'</td>';
				echo '<td >'.$mks->ExamTypeId5.'</td>';
			  }else{
				echo '<td >&nbsp;</td>';
				echo '<td >&nbsp;</td>';
			  } 
			  if($mks->ExamTypeId6!= 0){
			  	echo '<td >'.$mks->TotalMarks.'</td>';
				echo '<td >'.$mks->ExamTypeId6.'</td>';
			  }else{
				echo '<td >&nbsp;</td>';
				echo '<td >&nbsp;</td>';
			  } 
			  if($mks->ExamTypeId7 != 0){
			  	echo '<td >'.$mks->TotalMarks.'</td>';
				echo '<td >'.$mks->ExamTypeId7.'</td>';
			  }else{
				echo '<td >&nbsp;</td>';
				echo '<td >&nbsp;</td>';
			  }
		echo '</tr>';
		}
	
	}else{
 	echo '<tr>
        <td align="center" style="font-weight:bold; color:#000" colspan="16" >There is no data to display</td>
  	</tr>';
 }	
      echo '</table>
        </td>
  </tr>
  
</table>'; 

echo "<table width='792'  border='0' class='todayinfo_tbl' >
	<tr>
        <td align='center' height='52' class='field_title' colspan='8' >School Fees Info</td>
  	</tr>
    
  <tr class = 'info_title' >
  	<td>#</td>
  	<td>Term No</td>
    <td>Receipt No</td>
    <td>Paid Date</td>
    <td>Paid Amount</td>
	<td>Remain Amount</td>
  </tr>";
  
  
 $i = 1; $t =0; $cfees=0;
 if(isset($schoolfee) && count($schoolfee) > 0){
	foreach($schoolfee as $fee){ 
	 $t = $t+ $fee->Fees;
    $amtRemaining = $cfees - $t;
	  	echo '<tr align = "center" class="info_value">
		<td >'.$i.'</td>
		<td >'.$fee->TermNo.'</td>
		<td >'.$fee->ReceiptNo.'</td>
		<td >'.$fee->PaidDate.'</td>
		<td align = "right" >'.$fee->Fees.'</td>
		<td align = "right" >'.$amtRemaining.'</td>
		</tr>';
		$i++;
	}	
	echo '<tr class = "info_value" ><td></td><td align = "right" colspan="2" >Total Fees:'.$cfees.'.00/-</td><td align = "right" colspan="2">Total Paid: '.$t.'.00/-</td><td>Total Remain:'.$amtRemaining.'.00/- </td></tr></table>';
 } 
  
echo "</div>
<div style = 'float:left; width:200px; ;'>";
if(isset($student) && $student > 0){	
 foreach($student as $row){
	echo "<div style=' width:180px; height:180px; float:left; background-color:#edf3f5; margin-top:7px;  padding:10px; ' ><img src ='".base_url()."images/photos/thumb/".$row->PhotoPath."' width = '180' height = '180px' /></div>
	<div style=' width:180px; height:180px; float:left; background-color:#edf3f5; margin-top:7px; padding:10px;' >";
	$arr = explode(',',$row->Address);
	for($i = 0; $i< count($arr); $i++){
		echo $arr[$i].'<br />';
	}
 }
} 
echo '</div></div>';

?>
