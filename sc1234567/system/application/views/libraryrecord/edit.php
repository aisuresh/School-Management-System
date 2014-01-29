
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
echo "<a href='".$url."libraryrecord/listview/".$this->session->userdata('yearlr')."'>";
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
echo "<div id = 'mandatory' ><span align ='right' class = 'mandatory'>*</span> Specipied fileds are mandatory</div>";
echo "<table border='0' cellpadding='0' cellspacing = '0' class='formtable'>";
//var_dump($result);
foreach($result as $row):
echo "<input type='hidden' name = 'LibraryRecordId' id = 'LibraryRecordId' value = '".$row->LibraryRecordId."' />";
echo "<tr>";
echo "<td align='right' width='15%' class = 'datafield' >Library No</td>";
echo "<td width='2%' class='spacetd' > </td>";
echo "<td width='33%' class = 'dataview' >";
echo "<select name = 'LibraryNo' id = 'LibraryNo' >";
echo "<option value = 'x'>- - Select Library No - -</option>";
	foreach($libraryno as $rowa):
		if($row->LibraryNo == $rowa->LibraryNo){
			echo "<option value = '".$rowa->LibraryNo."' selected = 'selected'>";
			echo $rowa->LibraryNo;
			echo "</option>";
		}else{
			echo "<option value = '".$rowa->LibraryNo."' >";
			echo $rowa->LibraryNo;
			echo "</option>";

		}
	endforeach;
echo "</select>";
echo "</td></tr>";

echo "<tr>";
echo "<td align='right' width='15%' class = 'datafield' >Book Name</td>";
echo "<td width='2%' class='spacetd' > </td>";
echo "<td width='33%' class = 'dataview' >";
echo "<select name = 'BookCode' id = 'BookCode' >";
echo "<option value = 'x'>- - Select Book - -</option>";

	foreach($bookcode as $rowb):
		if($row->BookCode == $rowb->BookCode){
			echo "<option value = '".$rowb->BookCode."' selected = 'selected' >";
			echo $rowb->BookName;
			echo "</option>";
		}else{
			echo "<option value = '".$rowb->BookCode."' >";
			echo $rowb->BookName;
			echo "</option>";
		}
	endforeach;

echo "</select>";
echo "</td></tr>";

echo "<tr>";
echo "<td align='right' width='15%' class = 'datafield' >Issued Date</td>";
echo "<td width='2%' class='spacetd' > </td>";
echo "<td width='33%' class = 'dataview' >";
echo date("d-m-Y", strtotime($row->IssuedDate));
echo "</td>";
echo "</tr>";

echo "<tr>";
echo "<td align='right' width='15%' class = 'datafield' >Return Date</td>";
echo "<td width='2%' class='spacetd' > </td>";
echo "<td width='33%' class = 'dataview' >"; 
$ReturnDate=date("d-m-Y", strtotime($row->ReturnDate));
echo "<input type='text' name='ReturnDate' id='ReturnDate' class='datepicker' readonly='readonly' value='".$ReturnDate ."' />";

echo "</form>";
echo "</td>";
echo "</tr>";
echo "<tr>";
echo "<td align='right' width='15%' class = 'datafield' >Description</td>";
echo "<td width='2%' class='spacetd' > </td>";
echo "<td width='33%' class = 'dataview' ><input type = 'text' name = 'LibraryDes' id = 'LibraryDes' value='".$row->LibraryDes."'/></td>";
echo "</tr>";

endforeach;
echo "</table>";

echo "</div>";
echo "</div>";
?>

<script>

function validation(){
 
 var LibraryNo = $('#LibraryNo').val();
 var BookCode = $('#BookCode').val();
 var IssuedDate = $('#IssuedDate').val();
 var ReturnDate =$('#ReturnDate').val();
 
	 if(LibraryNo == 'x'){
		$('#message').html('LibraryNo should not be blank').show().fadeOut('slow').fadeIn('slow');
		$('#LibraryNo').focus();
		return false;
	}else if(BookCode == 'x'){
		$('#message').html('Book Code should not be blank').show().fadeOut('slow').fadeIn('slow');
		$('#BookCode').focus();
		return false;
	}else if(IssuedDate == ''){
		$('#message').html('Issued Date should not be blank').show().fadeOut('slow').fadeIn('slow');
		$('#IssuedDate').focus();
		return false;
	}else if(ReturnDate == ''){
		$('#message').html('Return Date should not be blank').show().fadeOut('slow').fadeIn('slow');
		$('#ReturnDate').focus();
		return false;
	}else{
		return true;
	}
}

function update_data($e){

 var LibraryRecordId = $('#LibraryRecordId').val();
 var LibraryNo = $('#LibraryNo').val();
 var BookCode = $('#BookCode').val();
 var IssuedDate = $('#IssuedDate').val();
 var ReturnDate =$('#ReturnDate').val();
 var ReceivedDate =$('#ReceivedDate').val();
 var LibraryDes = $('#LibraryDes').val();
 //alert(BookCode);
 	if(validation()){
 		$.ajax({
				type: 'POST',
				url: '<?=$url?>libraryrecord/update',
				data: 'LibraryRecordId='+LibraryRecordId+'&LibraryNo='+LibraryNo+'&BookCode='+BookCode+'&IssuedDate='+IssuedDate+'&ReturnDate='+ReturnDate+'&ReceivedDate='+ReceivedDate+'&LibraryDes='+LibraryDes,
				success: function(response){
				         	alert(response);			
						if(response == 1){
							if($e == 1){
								window.location.href='<?=$url?>libraryrecord/listview/<?=$this->session->userdata('yearlr')?>';
							}else{
								alert('Update Successfully');
							}
						
						}else{
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

