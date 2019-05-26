
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
echo "<a href='".$url."hostelrecord/listview/".$this->session->userdata('yearhr')."'>";
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
echo "<div id = 'mandatory' ><span align ='right' class = 'mandatory'>*</span> Specipied fileds are mandatory</div>";
echo "<table border='0' cellpadding='0' cellspacing='0' class='formtable'>";
echo '<tr><th colspan = "3" id = "table_title">Create New Hostel Record </th></tr>';

echo "<tr>";
echo "<td align='right' width='15%' class = 'datafield' >Student Class<span class = 'mandatory'>*</span></td>";
echo "<td width='2%' class='spacetd' > </td>";
echo "<td width='33%' class = 'dataview' >";
echo "<select name = 'Class' id = 'Class' onchange = 'get_studentlist();' >";
echo "<option value = 'x'>- - Select Class - -</option>";
	foreach($course as $rowa):
		echo "<option value = '".$rowa->ClassId."' >";
		echo $rowa->ClassName;
		echo "</option>";
	endforeach;
echo "</select>";
echo "</td></tr>";

echo "<tr>";
echo "<td align='right' width='15%' class = 'datafield' >Roll No & StudentName<span class = 'mandatory'>*</span></td>";
echo "<td width='2%' class='spacetd' > </td>";
echo "<td width='33%' class = 'dataview' >";
echo "<select name = 'StudentId' id = 'StudentId' onchange = 'get_termno();' >";
echo "<option value = 'x'>- - Select RollNo - -</option>";
echo "</select>";
echo "</td></tr>";

echo "<tr>";
echo "<td align='right' width='15%' class = 'datafield' >Hostel Term No<span class = 'mandatory'>*</span></td>";
echo "<td width='2%' class='spacetd' > </td>";
echo "<td width='33%' class = 'dataview' >"; 
echo "<input type='text' name='HostelTermNo' id='HostelTermNo' readonly='readonly' />";
echo "</td>";
echo "</tr>";

echo "<tr>";
echo "<td align='right' width='15%' class = 'datafield' >Hostel Term Fees<span class = 'mandatory'>*</span></td>";
echo "<td width='2%' class='spacetd' > </td>";
echo "<td width='33%' class = 'dataview' >"; 
echo "<input type='text' name='HostelTermFee' id='HostelTermFee' />";
echo "</td>";
echo "</tr>";

echo "<tr>";
echo "<td align='right' width='15%' class = 'datafield' > Term Paid Date<span class = 'mandatory'>*</span></td>";
echo "<td width='2%' class='spacetd' > </td>";
echo "<td width='33%' class = 'dataview' >";
echo "<input type='text' name='TermPaidDate' id='TermPaidDate' class='datepicker' value = '".date('d-m-Y')."' readonly='readonly' />";
echo "</td>";
echo "</tr>";

echo "<tr>";
echo "<td align='right' width='15%' class = 'datafield' >Paid By<span class = 'mandatory'>*</span></td>";
echo "<td width='2%' class='spacetd' > </td>";
echo "<td width='33%' class = 'dataview' >"; 
echo "<input type='text' name='PaidBy' id='PaidBy' />";
echo "</td>";
echo "</tr>";

echo "<tr>";
echo "<td align='right' width='15%' class = 'datafield' >Description</td>";
echo "<td width='2%' class='spacetd' > </td>";
echo "<td width='33%' class = 'dataview' ><input type = 'text' name = 'HostelTermDes' id = 'HostelTermDes' /></td>";
echo "</tr>";

echo "</table>";

echo "</div>";
echo "</div>";
?>

<script>

function validation(){
 
 var Class = $('#Class').val();
 var StudentId = $('#StudentId').val();
 var HostelTermNo = $('#HostelTermNo').val();
 var HostelTermFee = $('#HostelTermFee').val();
 var TermPaidDate =$('#TermPaidDate').val();
 var PaidBy =$('#PaidBy').val();
   
  
  if(Class == 'x'){
		$('#message').html('Class should not be blank').show().fadeOut('slow').fadeIn('slow');
		$('#Class').focus();
		return false;
	}else if(StudentId == 'x'){
		$('#message').html('Roll No should not be blank').show().fadeOut('slow').fadeIn('slow');
		$('#StudentId').focus();
		return false;
	}else if(HostelTermNo == 'x'){
		$('#message').html('Book Name should not be blank').show().fadeOut('slow').fadeIn('slow');
		$('#HostelTermNo').focus();
		return false;
	}else if(HostelTermFee == ''){
		$('#message').html('Hostel Term Fees should not be blank').show().fadeOut('slow').fadeIn('slow');
		$('#HostelTermFee').focus();
		return false;
	}else if(TermPaidDate == ''){
		$('#message').html('TermPaidDate should not be blank').show().fadeOut('slow').fadeIn('slow');
		$('#TermPaidDate').focus();
		return false;
	}else if(PaidBy == ''){
		$('#message').html('PaidBy should not be blank').show().fadeOut('slow').fadeIn('slow');
		$('#PaidBy').focus();
		return false;
	}else{
		return true;
	}
}


function save_data($e){

 
 var Class = $('#Class').val();
 var StudentId = $('#StudentId').val();
 var HostelTermNo = $('#HostelTermNo').val();
 var HostelTermFee = $('#HostelTermFee').val();
 var TermPaidDate = $('#TermPaidDate').val();
 var PaidBy =$('#PaidBy').val();
 var HostelTermDes =$('#HostelTermDes').val();
 //alert(Class);
 	
	if(validation()){
 		$.ajax({
				type: 'POST',
				url: '<?=$url?>hostelrecord/save',
				data: 'Class='+Class+'&StudentId='+StudentId+'&HostelTermNo='+HostelTermNo+'&HostelTermFee='+HostelTermFee+'&TermPaidDate='+TermPaidDate+'&PaidBy='+PaidBy+'&HostelTermDes='+HostelTermDes,
				success: function(response){
				   // alert(response);
					    if(response == 1){
							if($e == 1){
								window.location.href='<?=$url?>hostelrecord/listview/<?=$this->session->userdata('yearhr')?>';
							}else{
								alert('Insert Successfully');
							}
							}else if(response == 2){
								alert('Record already exists!..');	
						}else{
							alert('Insert Not Successfully');
						}
					}
					
		});
	}	
}

function get_studentlist(){
	var Class = $('#Class').val();
	$.ajax({
			type: 'POST',
			url: '<?=$url?>hostelrecord/studentlist',
			data: 'Class='+Class,
			success: function(response){
			//alert(response);
				if(response != ''){
					$('#StudentId').html(response);
				}
			}
				
	});
}

function get_termno(){
	var StudentId = $('#StudentId').val();
	$.ajax({
			type: 'POST',
			url: '<?=$url?>hostelrecord/hostelterm',
			data: 'StudentId='+StudentId,
			success: function(response){
					if(response != '0'){
						$('#HostelTermNo').val((parseInt(response)+1));
					}else{
						$('#HostelTermNo').val('1');
					}
			}
				
	});
}
$(function() {
 $( ".datepicker" ).datepicker({dateFormat: 'dd-mm-yy' });
});		
					
</script>
