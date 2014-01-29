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
echo "<a href='".$url."hostelfees/listview/".$this->session->userdata('yearhf')."' >";
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
echo '<tr><th colspan = "3" id = "table_title">Create New Hostel Fees Information</th></tr>';

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
//echo $year;
echo "<select name = 'Year' id = 'Year' disabled >";
echo "<option value = '".$year."'>".$year."</option>";
	/*foreach($years as $rowa):
		echo "<option value = '".$rowa->AcademicYear."' >";
		echo $rowa->AcademicYear;
		echo "</option>";
	endforeach;*/
echo "</select>";
echo "</td></tr>";

echo "<tr>";
echo "<td align='right' width='15%' class = 'datafield' >Class<span class = 'mandatory'>*</span></td>";
echo "<td width='2%' class='spacetd' > </td>";
echo "<td width='33%' class = 'dataview' >";
echo "<select name = 'Class' id = 'Class' >";
echo "<option value = 'x'>- - Select Class - -</option>";
   var_dump($course);
	foreach($course as $rowa):
			echo "<option value = '".$rowa->ClassId."' >";
			echo $rowa->ClassName;
			echo "</option>";
		
endforeach;
echo "</select>";
echo "</td></tr>";

echo "<tr>";
echo "<td align='right' width='15%' class = 'datafield' >Hostel Fees<span class = 'mandatory'>*</span></td>";
echo "<td width='2%' class='spacetd' > </td>";
echo "<td width='33%' class = 'dataview' ><input type = 'text' name = 'HostelFees' id = 'HostelFees' onKeyUp='JsCheckNumber(this)' /></td>";
echo "</tr>";
echo "</table>";

echo "</div>";
echo "</div>";
?>
<script>

function validation(){

 //var Year = $('#Year').val();
 var Class = $('#Class').val();
 var HostelFees = $('#HostelFees').val();
	 
	 /*if(Year =='x'){
		$('#message').html('Academic year should not be blank').show().fadeOut('slow').fadeIn('slow');
		$('#Year').focus();
		return false;
	}else */
	if(Class == 'x'){
		$('#message').html('Class should not be blank').show().fadeOut('slow').fadeIn('slow');
		$('#Class').focus();
		return false;
	}else if(HostelFees == ''){
		$('#message').html('Hostel Fees should not be blank').show().fadeOut('slow').fadeIn('slow');
		$('#HostelFees').focus();
		return false;
	}else{
		return true;
	}
}
function save_data($e){

 var Year = $('#Year').val();
 var Class = $('#Class').val();
 var HostelFees = $('#HostelFees').val();
	
	/*alert(Year);
	alert(Class);
	alert(HostelFees);*/
	 

 if(validation()){
 		$.ajax({
				type: 'POST',
				url: '<?=$url?>hostelfees/save',
				data: 'Year='+Year+'&Class='+Class+'&HostelFees='+HostelFees,
				success: function(response){
				       //alert(response);			
						if(response == 1){
							if($e == 1){
								window.location.href='<?=$url?>hostelfees/listview/<?=$this->session->userdata('yearhf')?>';
							}else{
								alert('Insert Successfully');
							}	
						}else if(response == 2){
								alert('Record already exists!.');
							}else{
								alert('Insert Not Successfully');
							}
					}
					
		});
	}	
}		
</script>
