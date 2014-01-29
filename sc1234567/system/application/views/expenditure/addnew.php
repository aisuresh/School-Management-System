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
echo "<a onclick='save_data(2);'>";
echo "<span><img src='".$url."images/apply.png' border='0' /></span>";
echo "<span>Apply</span>";
echo "</a>";
echo "</div>";

echo "<div class='events'>";
echo "<a onclick='save_data(1);'>";
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
echo "<table border='0' cellpadding='0' cellspacing='0' class='formtable'>";
echo '<tr><th colspan = "3" id = "table_title">Create New Expenditure  Information</th></tr>';
echo "<tr>";
echo "<td align='right' width='15%' class = 'datafield' >Academic Year<span class = 'mandatory'>*</span></td>";
echo "<td width='2%' class='spacetd' > </td>";
echo "<td width='33%' class = 'dataview' >";
/*$yearno = $this->Adminmodel->maxvalue($table = 'academicyear', $fields = array('AcademicYear'), $where = array());
		foreach($yearno as $yno){
			if($yno->AcademicYear != NULL){
				$year = $yno->AcademicYear;
			}
		}
echo "<label name = 'Year' id = 'Year' >" . $year ."</label>";*/

echo "<select name = 'Year' id = 'Year' disabled >";
$yearno = $this->Adminmodel->maxvalue($table = 'academicyear', $fields = array('AcademicYear'), $where = array());
		foreach($yearno as $yno){
			if($yno->AcademicYear != NULL){
				$year = $yno->AcademicYear;
			}
		}


echo "<option value = '".$year."' >".$year."</option>";
	/*foreach($years as $rowa):
		echo "<option value = '".$rowa->AcademicYear."' >";
		echo $rowa->AcademicYear;
		echo "</option>";
	endforeach;*/
echo "</select>";
echo "</td></tr>";

echo "<tr>";
echo "<td align='right' width='30%' class = 'datafield' >Expenditure Type<span class = 'mandatory'>*</span></td>";
echo "<td width='2%' class='spacetd' > </td>";
echo "<td width='33%' class = 'dataview' >";
echo "<select name = 'ExpenditureTypeId' id = 'ExpenditureTypeId' >";
echo "<option value = 'x'>- - Select Expenditure - -</option>";
echo "<optgroup label='Administrative' value='administrativeexpenses'>";
foreach($expenditure1 as $rowb):
     	echo "<option value = '".$rowb->ExpenditureTypeId."' >";
		echo $rowb->ExpenditureType;
		echo "</option>";
endforeach; 
echo "</optgroup>";
echo "<optgroup label='Financial' value='financialexpenses'>";
foreach($expenditure2 as $rowb):
   		echo "<option value = '".$rowb->ExpenditureTypeId."' >";
		echo $rowb->ExpenditureType;
		echo "</option>";
endforeach; 
echo "</optgroup>";
echo "<optgroup label='Maintenance' value='maintenanceexpenses'>";
foreach($expenditure3 as $rowb):
   if($rowb->InstituteId == $this->session->userdata('InstituteId'))
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
echo "<td width='33%' class = 'dataview' ><input type = 'text' name = 'BillNo' id = 'BillNo' /></td>";
echo "</tr>";


echo "<tr>";
echo "<td align='right' width='15%' class = 'datafield' >Bill Amount<span class = 'mandatory'>*</span></td>";
echo "<td width='2%' class='spacetd' > </td>";
echo "<td width='33%' class = 'dataview' ><input type = 'text' name = 'BillAmount' id = 'BillAmount' /></td>";
echo "</tr>";

echo "<tr>";
echo "<td align='right' width='15%' class = 'datafield' > Bill Date<span class = 'mandatory'>*</span></td>";
echo "<td width='2%' class='spacetd' > </td>";
echo "<td width='33%' class = 'dataview' >";
echo "<input type='text' name='BillDate' id='BillDate' class='datepicker'  readonly='readonly' />";
echo "</td>";
echo "</tr>";

echo "<tr>";
echo "<td align='right' width='15%' class = 'datafield' >Spent By<span class = 'mandatory'>*</span></td>";
echo "<td width='2%' class='spacetd' > </td>";
echo "<td width='33%' class = 'dataview' ><input type = 'text' name = 'SpentBy' id = 'SpentBy' /></td>";
echo "</tr>";

echo "<tr>";
echo "<td align='right' width='15%' class = 'datafield' >Justification<span class = 'mandatory'>*</span></td>";
echo "<td width='2%' class='spacetd' > </td>";
echo "<td width='33%' class = 'dataview' ><input type = 'text' name = 'Justification' id = 'Justification' /></td>";
echo "</tr>";
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
		$('#message').html('Expenditure Type should not be blank').show().fadeOut('slow').fadeIn('slow');
		$('#ExpenditureTypeId').focus();
		return false;
	}else if(BillNo == ''){
		$('#message').html('Bill No should not be blank').show().fadeOut('slow').fadeIn('slow');
		$('#BillNo').focus();
		return false;
	}else if(BillAmount == ''){
		$('#message').html('Bill Amount should not be blank').show().fadeOut('slow').fadeIn('slow');
		$('#BillAmount').focus();
		return false;
	}else if(BillDate == ''){
		$('#message').html('Bill Date should not be blank').show().fadeOut('slow').fadeIn('slow');
		$('#BillDate').focus();
		return false;
	}else if(SpentBy == ''){
		$('#message').html('Spent By should not be blank').show().fadeOut('slow').fadeIn('slow');
		$('#SpentBy').focus();
		return false;
	}else if(Justification == ''){
		$('#message').html('Justification should not be blank').show().fadeOut('slow').fadeIn('slow');
		$('#Justification').focus();
		return false;
	}else{
		return true;
	}
}
function save_data($e){

 var Year = $('#Year').val();
 var ExpenditureTypeId = $('#ExpenditureTypeId').val();
 var BillNo = $('#BillNo').val();
 var BillAmount = $('#BillAmount').val();
 var BillDate = $('#BillDate').val();
 var SpentBy = $('#SpentBy').val();
 var Justification = $('#Justification').val();
	 

 if(validation()){
 		$.ajax({
				type: 'POST',
				url: '<?=$url?>expenditure/save',
				data: 'Year='+Year+'&ExpenditureTypeId='+ExpenditureTypeId+'&BillNo='+BillNo+'&BillAmount='+BillAmount+'&BillDate='+BillDate+'&SpentBy='+SpentBy+'&Justification='+Justification,
				success: function(response){
						if(response == 1){
							if($e == 1){
								window.location.href='<?=$url?>expenditure/listview/<?=$this->session->userdata('yearcf')?>';
							}else{
								alert('Insert Successfully');
							}	
						}else if(response == 2){
								alert('Record already exists!.');
							}
							else{
								alert('Insert Not Successfully');
							}
					}
					
		});
	}	
}

$(function() {
 $( ".datepicker" ).datepicker({dateFormat: 'dd-mm-yy' });
});		
					
		
</script>
