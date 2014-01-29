<?php

echo "<div class='container'>";
echo "<div class='content_header'>";
/*---------------     content title       ---------------------*/
echo "<div class='content_title'>";
echo $pagetitle.' > '. $event;
echo "</div>";
echo "<div class='content_message'>";

echo "</div>";
/*---------------     content events       ---------------------*/
echo "<div class='content_events'>";

echo "<div class='events'>";
echo "<a href='".$url."expenditure/listview/".$this->session->userdata('yearcf')."'>";
echo "<span> <img src='".$url."images/cancel.png' border='0' /></span>";
echo "<span>Cancel</span>";
echo "</a>";
echo "</div>";

echo "<div class='events'>";
echo "<a onclick='update_data(2);'>";
echo "<span><img src='".$url."images/apply.png' border='0' /></span>";
echo "<span>Apply</span>";
echo "</a>";
echo "</div>";

echo "<div class='events'>";
echo "<a onclick='update_data(1);'>";
echo "<span><img src='".$url."images/save.png' border='0' /></span>";
echo "<span>Save</span>";
echo "</a>";
echo "</div>";

echo "</div>";
echo "</div>";
/*---------------     content        ---------------------*/
echo "<div align='center' class='content'>";
echo "<div id ='message'></div>";
echo "<div id ='message1'></div>";
echo "<div id = 'mandatory' ><span align ='right' class = 'mandatory'>*</span> Specified fileds are mandatory</div>";
echo "<table border='0' cellpadding='0' cellspacing = '0' class='formtable'>";
foreach($result as $row):
echo "<input type='hidden' name = 'ExpenditureId' id = 'ExpenditureId' value = '".$row->ExpenditureId."'";
echo "<tr>";
echo "<td align='right' width='15%' class = 'datafield' >Academic Year<span class = 'mandatory'>*</span></td>";
echo "<td width='2%' class='spacetd' > </td>";
echo "<td width='33%' class = 'dataview' >";
$yearno = $this->Adminmodel->maxvalue($table = 'academicyear', $fields = array('AcademicYear'), $where = array());
		foreach($yearno as $yno){
			if($yno->AcademicYear != NULL){
				$year = $yno->AcademicYear;
			}
		}
//echo "<label Year = ".$year."'>" . $year ."</label>";

echo "<select name = 'Year' id = 'Year' disabled >";
echo "<option value = '".$year."'>".$year."</option>";
/*foreach($years as $rowa):
	if($row->Year == $rowa->AcademicYear){
		echo "<option value = '".$rowa->AcademicYear."' selected = 'selected' >";
		echo $rowa->AcademicYear;
		echo "</option>";
	}else{
		echo "<option value = '".$rowa->AcademicYear."' >";
		echo $rowa->AcademicYear;
		echo "</option>";
	}
endforeach;*/
echo "</select>";
echo "</td></tr>";

echo "<tr>";
echo "<td align='right' width='30%' class = 'datafield' >Expenditure Type<span class = 'mandatory'>*</span></td>";
echo "<td width='2%' class='spacetd' > </td>";
echo "<td width='33%' class = 'dataview' >";
echo "<select name = 'ExpenditureTypeId' id = 'ExpenditureTypeId' style='width:150px;' disabled >";
echo "<option value = 'x'>- - Select Expenditure- -</option>";
echo "<optgroup label='Administrative Expenses' value='administrativeexpenses'>";
foreach($expenditure1 as $rowb):
	if($row->ExpenditureTypeId == $rowb->ExpenditureTypeId){
     	echo "<option value = '".$rowb->ExpenditureTypeId."' selected>";
		echo $rowb->ExpenditureType;
		echo "</option>";
	}
	else
	{
	echo "<option value = '".$rowb->ExpenditureTypeId."' >";
		echo $rowb->ExpenditureType;
		echo "</option>";
	}
endforeach; 
echo "</optgroup>";
echo "<optgroup label='Financial Expenses' value='financialexpenses'>";
foreach($expenditure2 as $rowb):
	if($row->ExpenditureTypeId == $rowb->ExpenditureTypeId){
   		echo "<option value = '".$rowb->ExpenditureTypeId."'selected >";
		echo $rowb->ExpenditureType;
		echo "</option>";
	}
	else
	{
	echo "<option value = '".$rowb->ExpenditureTypeId."' >";
		echo $rowb->ExpenditureType;
		echo "</option>";
	}
endforeach; 
echo "</optgroup>";
echo "<optgroup label='Maintenance Expenses' value='maintenanceexpenses'>";
foreach($expenditure3 as $rowb):
  if($row->ExpenditureTypeId == $rowb->ExpenditureTypeId){       
		echo "<option value = '".$rowb->ExpenditureTypeId."' selected >";
		echo $rowb->ExpenditureType;
		echo "</option>";
	}
	else
	{
	echo "<option value = '".$rowb->ExpenditureTypeId."' >";
		echo $rowb->ExpenditureType;
		echo "</option>";
	}
	endforeach; 
echo "</optgroup>";
echo "</select>";
echo "</td></tr>";
echo "<tr>";


echo "<tr>";
echo "<td align='right' width='15%' class = 'datafield' >Bill No<span class = 'mandatory'>*</span></td>";
echo "<td width='2%' class='spacetd' > </td>";
echo "<td width='33%' class = 'dataview' ><input type = 'text' name = 'BillNo' id = 'BillNo' value='".$row->BillNo ."'/></td>";
echo "</tr>";

echo "<tr>";
echo "<td align='right' width='15%' class = 'datafield' >Bill Amount<span class = 'mandatory'>*</span></td>";
echo "<td width='2%' class='spacetd' > </td>";
echo "<td width='33%' class = 'dataview' ><input type = 'text' name = 'BillAmount' id = 'BillAmount' value='".$row->BillAmount ."'/></td>";
echo "</tr>";

echo "<tr>";
echo "<td align='right' width='15%' class = 'datafield' >Bill Date<span class = 'mandatory'>*</span></td>";
echo "<td width='2%' class='spacetd' > </td>";
echo "<td width='33%' class = 'dataview' ><input type = 'text' name = 'BillDate' id = 'BillDate' class = 'datepicker' readonly = 'readonly' value='".$row->BillDate ."'/></td>";
echo "</tr>";

echo "<tr>";
echo "<td align='right' width='15%' class = 'datafield' >Spent By<span class = 'mandatory'>*</span></td>";
echo "<td width='2%' class='spacetd' > </td>";
echo "<td width='33%' class = 'dataview' ><input type = 'text' name = 'SpentBy' id = 'SpentBy' value='".$row->SpentBy ."'/></td>";
echo "</tr>";


echo "<tr>";
echo "<td align='right' width='15%' class = 'datafield' >Justification<span class = 'mandatory'>*</span></td>";
echo "<td width='2%' class='spacetd' > </td>";
echo "<td width='33%' class = 'dataview' ><input type = 'text' name = 'Justification' id = 'Justification' value='".$row->Justification ."'/></td>";
echo "</tr>";

endforeach;
echo "</table>";

echo "</div>";
echo "</div>";
?>
<script>

function validation(){

 //var Year = $('#Year').val();
 var ExpenditureTypeId = $('#ExpenditureTypeId').val();
 var BillNo = $('#BillNo').val();
 var BillAmount = $('#BillAmount').val();
 var BillDate = $('#BillDate').val();
 var SpentBy = $('#SpentBy').val();
 var Justification = $('#Justification').val();
	 
	 /*if(Year =='x'){
		$('#message').html('Academic year should not be blank').show().fadeOut('slow').fadeIn('slow');
		$('#Year').focus();
		return false;
	}else*/
	 if(ExpenditureTypeId == 'x'){
		$('#message').html('ExpenditureType should not be blank').show().fadeOut('slow').fadeIn('slow');
		$('#ExpenditureTypeId').focus();
		return false;
	}else  if(BillNo == ''){
		$('#message').html('BillNo Fees should not be blank').show().fadeOut('slow').fadeIn('slow');
		$('#BillNo').focus();
		return false;
	}else  if(BillAmount == ''){
		$('#message').html('BillAmount Fees should not be blank').show().fadeOut('slow').fadeIn('slow');
		$('#BillAmount').focus();
		return false;
	}else  if(BillDate == ''){
		$('#message').html('BillDate Fees should not be blank').show().fadeOut('slow').fadeIn('slow');
		$('#BillDate').focus();
		return false;
	}else  if(SpentBy == ''){
		$('#message').html('SpentBy Fees should not be blank').show().fadeOut('slow').fadeIn('slow');
		$('#SpentBy').focus();
		return false;
	
	}else if(Justification == ''){
		$('#message').html('Justification Fees should not be blank').show().fadeOut('slow').fadeIn('slow');
		$('#Justification').focus();
		return false;
	}else{
		return true;
	}
}

function update_data($e){
 
 var Year = $('#Year').val();
 var ExpenditureId = $('#ExpenditureId').val();
 var ExpenditureTypeId = $('#ExpenditureTypeId').val();
 var BillNo = $('#BillNo').val();
 var BillAmount = $('#BillAmount').val();
 var BillDate = $('#BillDate').val();
 var SpentBy = $('#SpentBy').val();
 var Justification = $('#Justification').val();
 //var ExpenditureTypeId = $('#ExpenditureTypeId').val();
 
 	if(validation()){
 			$.ajax({
				type: 'POST',
				
				url: '<?=$url?>expenditure/update',
				
				data: 'Year='+Year+'&ExpenditureId='+ExpenditureId+'&ExpenditureTypeId='+ExpenditureTypeId+'&BillNo='+BillNo+'&BillAmount='+BillAmount+'&BillDate='+BillDate+'&SpentBy='+SpentBy+'&Justification='+Justification,
				
				success: function(response){
				    	if(response == 1){
							if($e == 1){
								window.location.href='<?=$url?>expenditure/listview/<?=$this->session->userdata('yearcf')?>';
							}else{
								alert('Update Successfully');
							}
						}else if(response == 2){
								alert('Record already exists!.');
							}
							else{
									alert('Update Not Successfully');
								}
					}
					
			});
		}	
}

$(function() {
 $( ".datepicker" ).datepicker({dateFormat: 'dd-mm-yy' });
});		
					

</script>
