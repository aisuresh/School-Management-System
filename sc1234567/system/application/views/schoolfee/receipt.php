<?php
echo "<table border='0' cellpadding='0' cellspacing='0' class='formtable'>";

echo "<tr>";
echo "<td align='right' width='15%' class = 'datafield' >Class <span class = 'mandatory'>*</span></td>";
echo "<td width='2%' class='spacetd' > </td>";
echo "<td width='33%' class = 'dataview' >";
echo "<select name = 'ClassId' id = 'ClassId' onChange = 'section_fun();' >";
echo "<option value = 'x'>- - Select Class - -</option>";
foreach($course as $row):
echo "<option value = '".$row->ClassId."' >";
echo $row->ClassName;
echo "</option>";
endforeach;
echo "</select>";
echo "</td></tr>";

echo "<tr>";
echo "<td align='right' width='15%' class = 'datafield' >Section<span class = 'mandatory'>*</span></td>";
echo "<td width='2%' class='spacetd' > </td>";
echo "<td width='33%' class = 'dataview' >";
echo "<select name = 'SectionId' id = 'SectionId' onchange = 'studentlist_fun();' >";
echo "<option value = 'x'>- - Select Section - -</option>";
echo "</select>";
echo "</td></tr>";


echo "<tr>";
echo "<td align='right' width='15%' class = 'datafield' >Student Roll No<span class = 'mandatory'>*</span></td>";
echo "<td width='2%' class='spacetd' > </td>";
echo "<td width='33%' class = 'dataview' >";
echo "<select name = 'RollNo' id = 'RollNo' onclick = 'tremno_fun();'>";
echo "<option value = 'x'>- - Select RollNo - -</option>";
echo "</select>";
echo "</td></tr>";

echo "<tr>";
echo "<td align='right' width='15%' class = 'datafield' >School Fees<span class = 'mandatory'>*</span></td>";
echo "<td width='2%' class='spacetd' > </td>";
echo "<td width='33%' class = 'dataview' ><input type = 'text' name = 'Fees' id = 'Fees' onKeyUp='JsCheckNumber(this)' /></td>";
echo "</tr>";

echo "<tr>";
echo "<td align='right' width='15%' class = 'datafield' >Recept No<span class = 'mandatory'>*</span></td>";
echo "<td width='2%' class='spacetd' > </td>";
echo "<td width='33%' class = 'dataview' ><input type = 'text' name = 'ReceptNo' id = 'ReceptNo' onKeyUp='JsCheckNumber(this)' /> </td>";
echo "</tr>";

echo "<tr>";
echo "<td align='right' width='15%' class = 'datafield' >Term No<span class = 'mandatory'>*</span></td>";
echo "<td width='2%' class='spacetd' > </td>";
echo "<td width='33%' class = 'dataview' ><input type = 'text' name = 'TermNo' id = 'TermNo' onKeyUp='JsCheckNumber(this)' /></td>";
echo "</tr>";

echo "<tr>";
echo "<td align='right' width='15%' class = 'datafield' >Paid Date<span class = 'mandatory'>*</span></td>";
echo "<td width='2%' class='spacetd' > </td>";
echo "<td width='33%' class = 'dataview' >";
echo "<form name='studentform'>";											
/*calendar attaches to existing form element*/
echo "<input type='text' name='PaidDate' id='PaidDate' readonly='readonly' />";
?> 							 
<script language="JavaScript">
    new tcal ({
        'formname': 'studentform',		
        'controlname': 'PaidDate'
    });						
</script>
<?php
echo "</form>
</td>";
echo "</tr>";

echo "<tr>";
echo "<td align='right' width='15%' class = 'datafield' >Description</td>";
echo "<td width='2%' class='spacetd' > </td>";
echo "<td width='33%' class = 'dataview' ><input type = 'text' name = 'SchoolFeeDes' id = 'SchoolFeeDes' /></td>";
echo "</tr>";

echo "</table>";	
?>
<table width="450" height="258" border="1" cellpadding="0" cellspacing="0">
  <tr>
    <td height="156" colspan="3" valign="top">
   	  <table width="447" height="154" border="1" cellpadding="0" cellspacing="0" >
      	  <tr>
          	<td colspan="4" align="center">
            	<span style="font-size:18px; font-weight:bold;">Jnana Bharathi height School</span><br />
                <span style="font-size:14px;" >(Recognized by Govt. of AP)</span><br /><br />
                <span style="font-size:15px; font-weight:bold;" > School Fees Receipt</span> <br />
            </td>
          </tr>	
	      <tr>
          	<td width="67" align="right">Name:</td>
          	<td width="124">&nbsp;</td>
          	<td width="96" align="right">Father Name:</td>
          	<td width="132">&nbsp;</td>
        </tr>
          <tr>
            <td align="right">Class:</td>
            <td>&nbsp;</td>
            <td align="right" >Section:</td>
            <td>&nbsp;</td>
          </tr>
        <tr>
            <td align="right" >Paid Date:</td>
          	<td>&nbsp;</td>
            <td align="right" >Receipt No:</td>
            <td>&nbsp;</td>
        </tr>
      </table>
        

    </td>
  </tr>
  <tr>
    <td height="34" align="center" colspan="2" >Particulars</td>
    <td width="107" align="center" >Amount</td>
  </tr>
  <tr>
    <td width="328" align="left" >Tearm Fees </td>
    <td width="8">:</td>
    <td align="right">2000.00</td>
  </tr>
  <tr>
    <td align="left" >Admisssion Fees</td>
     <td>:</td>
    <td align="right" >1000.00</td>
  </tr>
  <tr>
    <td align="right" >Grand Total Amount</td>
     <td>:</td>
    <td align="right" >3000.00</td>
  </tr>
  <tr>
    <td align="right" colspan="3" height="80">
    	<div style="float:left; margin:90px 0 0 20px;" >Seal & Sign </div>
    </td>
  </tr>
   
</table>



