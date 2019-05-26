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
echo "<a href='".$url."expendituretype/listview/".$this->session->userdata('yearcf')."'>";
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
echo '<tr><th colspan = "3" id = "table_title">Create New Expenditure Type</th></tr>';
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
echo "<td align='right' width='15%' class = 'datafield' >Expenditure Group<span class = 'mandatory'>*</span></td>";
echo "<td width='2%' class='spacetd' > </td>";
echo "<td width='33%' class = 'dataview' >";
//echo "<td width='33%' class = 'dataview' ><input type = 'text' name = 'ExpenditureUnder' id = 'ExpenditureUnder' /></td>";
echo "<select name = 'ExpenditureUnder' id = 'ExpenditureUnder' >";
echo "<option value = 'x'>- - Select Group - -</option>";
echo "<option value = 'Administrative'>Administrative</option>";
echo "<option value = 'Financial'>Financial</option>";
echo "<option value = 'Maintenance'>Maintenance</option>";
echo "</select>";
echo "</td></tr>";

echo "<tr>";
echo "<td align='right' width='15%' class = 'datafield' >Expenditure Type<span class = 'mandatory'>*</span></td>";
echo "<td width='2%' class='spacetd' > </td>";
//echo "<td width='33%' class = 'dataview' >";
echo "<td width='33%' class = 'dataview' ><input type = 'text' name = 'ExpenditureType' id = 'ExpenditureType' /></td>";
/*echo "<select name = 'ExpenditureType' id = 'ExpenditureType' >";
echo "<option value = 'x'>- - Select ExpenditureType - -</option>";
	foreach($expendituretype as $rowa):
			echo "<option value = '".$rowa->ExpenditureTypeId."' >";
			echo $rowa->ExpenditureType;
			echo "</option>";
		
	endforeach;
echo "</select>";*/
echo "</tr>";

echo "<tr>";
echo "<td align='right' width='15%' class = 'datafield' >Description<span class = 'mandatory'>*</span></td>";
echo "<td width='2%' class='spacetd' > </td>";
echo "<td width='33%' class = 'dataview' ><input type = 'text' name = 'Description' id = 'Description' /></td>";
echo "</tr>";
echo "</table>";

echo "</div>";
echo "</div>";
?>
<script>

function validation(){

 //var Year = $('#Year').val();
 
 var ExpenditureUnder = $('#ExpenditureUnder').val();
 var ExpenditureType = $('#ExpenditureType').val();
 var Description = $('#Description').val();
	 
	 /*if(Year =='x'){
		$('#message').html('Academic year should not be blank').show().fadeOut('slow').fadeIn('slow');
		$('#Year').focus();
		return false;
	}else*/
	  if(ExpenditureUnder == 'x'){
		$('#message').html('Expenditure Group should not be blank').show().fadeOut('slow').fadeIn('slow');
		$('#ExpenditureUnder').focus();
		return false;
	}else if(ExpenditureType == ''){
		$('#message').html('Expenditure Type should not be blank').show().fadeOut('slow').fadeIn('slow');
		$('#ExpenditureType').focus();
		return false;
	}else if(Description == ''){
		$('#message').html('Description should not be blank').show().fadeOut('slow').fadeIn('slow');
		$('#Description').focus();
		return false;
	}else{
		return true;
	}
}
function save_data($e){

 var Year = $('#Year').val();
 var ExpenditureUnder = $('#ExpenditureUnder').val();
 var ExpenditureType = $('#ExpenditureType').val();
 var Description = $('#Description').val();
// alert(ExpenditureType);
 //alert(ExpenditureUnder);
	 

 if(validation()){
 		$.ajax({
				type: 'POST',
				url: '<?=$url?>expendituretype/save',
				data: 'Year='+Year+'&ExpenditureType='+ExpenditureType+'&ExpenditureUnder='+ExpenditureUnder+'&Description='+Description,
				success: function(response){			
						if(response == 1){
							if($e == 1){
								window.location.href='<?=$url?>expendituretype/listview/<?=$this->session->userdata('yearcf')?>';
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
</script>
