<?php

echo '<table width="788"  border="0" class="studentinfo_tbl">
	<tr>
        <td align="center" width="158" height="52" class="field_title" colspan="4" >Search Staff</td>
  	</tr>
    
	<tr>
        <td width="160" class="field" >Search Staff</td>
        <td width="225" class="info" colspan="3"><input type="text" name="StaffId" id="StaffId" /> <input type="button" name="search" id="search" value="Go" onClick="staff_search();" /></td>
  	</tr>
</table>  

<table width="788"  border="0" class="studentinfo_tbl">
	<tr>
        <td align="center" width="158" height="52" class="field_title" colspan="4" >Staff Info</td>
  	</tr>';
if(isset($staff) && $staff > 0){	
 foreach($staff as $row){    
echo '<tr>
    <td width="160" class="field" > Staff Name</td>
    <td width="225" class="info">'.$row->StaffName.'</td>
    <td width="160" class="field">&nbsp;</td>
    <td width="225" class="info">&nbsp;</td>
  </tr>
  
  <tr>
    <td class="field" >Staff Type</td>
    <td class="info" >'.$row->StaffType.'</td>
    <td class="field" >Email</td>
    <td class="info" >'.$row->Email.'</td>
  </tr>
  <tr>
    <td class="field" >Qualification</td>
    <td class="info" >'.$row->QualificationId.'</td>
    <td class="field">Town</td>
    <td class="info" >'.$row->Town.'</td>
  </tr>
  <tr>
    <td class="field" >Experiance</td>
    <td class="info" >'.$row->TotalExperiance.'</td>
    <td class="field" >Status</td>
    <td class="info" >'.$row->Status.'</td>
  </tr>
  <tr>
    <td class="field" >Subject01</td>
    <td class="info" >'.$row->Subject01.'</td>
    <td class="field">StaffDes</td>
    <td class="info" >'.$row->StaffDes.'</td>
  </tr>
  <tr>
    <td class="field" >Subject02</td>
    <td class="info" >'.$row->Subject02.'</td>
    <td class="field">Address</td>
    <td class="info" >'.$row->Address.'</td>
  </tr>
    <tr>
    <td class="field" >Subject03</td>
    <td class="info" >'.$row->Subject03.'</td>
    <td class="field" >&nbsp;</td>
    <td class="info" >&nbsp;</td>
  </tr>
    <tr>
    <td class="field" >PhoneNo</td>
    <td class="info" >'.$row->PhoneNo.'</td>
    <td class="field" >&nbsp;</td>
    <td class="info" >&nbsp;</td>
  </tr>
  <tr>
    <td class="field" >MobileNo</td>
    <td class="info" >'.$row->MobileNo.'</td>
    <td class="field" >&nbsp;</td>
    <td class="info">&nbsp;</td>
  </tr>';
  }
 }else{
 	echo '<tr>
        <td align="center" width="158" height="52" style="font-weight:bold; color:#000" colspan="4" >Search Staff Information</td>
  	</tr>';
 }
  
echo '</table>';
?>
