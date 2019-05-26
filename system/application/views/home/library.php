<?php
 
echo '<table width="520"  border="0" class="todayinfo_tbl" cellpadding="0" cellspacing="1">
	<tr>
        <td align="center" height="30" class="field_title" colspan="8" >Books Issued Info</td>
  	</tr>

  <tr class = "info_title" >
  	<td width="20">#</td>
  	<td width="60">Roll No</td>
    <td width="150">S\'Name</td>
    <td width="60">Class</td>
    <td width="130">Book Name</td>
    <td width="100">Book Code</td>
  </tr>';

 // $num = count($issued);
  //echo $num;
  $i=1;
  //var_dump($issued);
  if($issued > 0){
  
 foreach($issued as $rowa){     
echo '<tr class="info_value">
    <td >'.$i++.'</td>
    <td >'.$rowa->StudentId.'</td>
    <td >'.$rowa->StudentName.'</td>
    <td >'.$rowa->ClassName.'</td>
    <td >'.$rowa->BookName.'</td>
    <td >'.$rowa->BookCode.'</td>
  </tr>';
 }
 }else{
 echo '<tr class="info_value"><td align = "center" style="font-weight:bold; color:#000" colspan="8" >There is no data to display</td>';
 } 
echo  '</table>';

echo '<table width="520"  border="0" class="todayinfo_tbl" cellpadding="0" cellspacing="1">
	<tr>
        <td align="center" height="30" class="field_title" colspan="8" >Books Recieved Info</td>
  	</tr>

  <tr class = "info_title" >
  	<td width="20">#</td>
  	<td width="60">Roll No</td>
    <td width="150">S\'Name</td>
    <td width="60">Class</td>
    <td width="130">Book Name</td>
    <td width="100">Book Code</td>
  </tr>';
  $i =1;
  //var_dump($received);
  if($received > 0){
 foreach($received as $rowb){     
echo '<tr class="info_value">
    <td >'.$i++.'</td>
    <td >'.$rowb->StudentId.'</td>
    <td >'.$rowb->StudentName.'</td>
    <td >'.$rowb->ClassName.'</td>
    <td >'.$rowb->BookName.'</td>
    <td >'.$rowb->BookCode.'</td>
  </tr>';
 }
 }else{
 echo '<tr class="info_value"><td align = "center" style="font-weight:bold; color:#000" colspan="8" >There is no data to display</td>';
 } 
echo  '</table>';
?>
