
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
echo '<tr><th colspan = "3" id = "table_title">Create New Library Record</th></tr>';


echo "<tr>";
echo "<td align='right' width='15%' class = 'datafield' >Library No<span class = 'mandatory'>*</span></td>";
echo "<td width='2%' class='spacetd' > </td>";
echo "<td width='33%' class = 'dataview' >";
echo "<select name = 'LibraryNo' id = 'LibraryNo' >";
echo "<option value = 'x'>- - Select Library No - -</option>";
	foreach($libraryno as $rowa):
		echo "<option value = '".$rowa->LibraryNo."' >";
		echo $rowa->LibraryNo;
		echo "</option>";
	endforeach;
echo "</select>";
echo "</td></tr>";

echo "<tr>";
echo "<td align='right' width='15%' class = 'datafield' >Book Category</td>";
echo "<td width='2%' class='spacetd' > </td>";
echo "<td width='33%' class = 'dataview' >";
echo "<select name = 'BookCategory' id = 'BookCategory' onChange='get_book()';  >";
echo "<option value = 'x'>- - Select Category - -</option>";
	foreach($bookcategory as $rowb):
		echo "<option value = '".$rowb->BookCategoryId."' >";
		echo $rowb->BookCategory;
		echo "</option>";
	endforeach;
echo "</select>";
echo "</td></tr>";

echo "<tr>";
echo "<td align='right' width='15%' class = 'datafield' >Book Name<span class = 'mandatory'>*</span></td>";
echo "<td width='2%' class='spacetd' > </td>";
echo "<td width='33%' class = 'dataview' >";
echo "<select name = 'BookCode' id = 'BookCode' >";
echo "<option value = 'x'>- - Select Book - -</option>";
foreach($book as $rowc):
		echo "<option value = '".$rowc->BookCategoryId."' >";
		echo $rowc->BookName;
		echo "</option>";
	endforeach;
echo "</select>";
echo "</td></tr>";

echo "<tr>";
echo "<td align='right' width='15%' class = 'datafield' >Return Date<span class = 'mandatory'>*</span></td>";
echo "<td width='2%' class='spacetd' > </td>";
echo "<td width='33%' class = 'dataview' >";											
echo "<input type='text' name='ReturnDate' id='ReturnDate' class='datepicker' readonly='readonly' />";
echo "</td>";
echo "</tr>";

echo "<tr>";
echo "<td align='right' width='15%' class = 'datafield' >Description</td>";
echo "<td width='2%' class='spacetd' > </td>";
echo "<td width='33%' class = 'dataview' ><input type = 'text' name = 'LibraryDes' id = 'LibraryDes' /></td>";
echo "</tr>";

echo "</table>";

echo "</div>";
echo "</div>";
?>

<script>

function validation(){

 var LibraryNo = $('#LibraryNo').val();
 var BookCode = $('#BookCode').val();
 var ReturnDate =$('#ReturnDate').val();
	 
	  
	  if(LibraryNo == 'x'){
		$('#message').html('LibraryNo should not be blank').show().fadeOut('slow').fadeIn('slow');
		$('#LibraryNo').focus();
		return false;
	}else if(BookCode == 'x'){
		$('#message').html('Book Name should not be blank').show().fadeOut('slow').fadeIn('slow');
		$('#BookCode').focus();
		return false;
	}else if(ReturnDate == ''){
		$('#message').html('Return Date should not be blank').show().fadeOut('slow').fadeIn('slow');
		$('#ReturnDate').focus();
		return false;
	}else{
		return true;
	}
}

function get_book(){
	var bookcategory = $('#BookCategory').val();
	$.ajax({
		type: 'POST',
		url: '<?=$url?>libraryrecord/bookcategory',
		data: 'bookcategory='+bookcategory,
		success: function(response){			
				if(response != ''){
					$('#BookCode').html(response);
				}
					
		}
					
	});
}

function save_data($e){
 var LibraryNo = $('#LibraryNo').val();
 var BookCode = $('#BookCode').val();
 var IssuedDate = $('#IssuedDate').val();
 var ReturnDate =$('#ReturnDate').val();
 var LibraryDes = $('#LibraryDes').val();
 	
	if(validation()){
 		$.ajax({
				type: 'POST',
				url: '<?=$url?>libraryrecord/save',
				data: 'LibraryNo='+LibraryNo+'&BookCode='+BookCode+'&IssuedDate='+IssuedDate+'&ReturnDate='+ReturnDate+'&LibraryDes='+LibraryDes,
				success: function(response){	
				//alert(response);		
						if(response == 1){
							if($e == 1){
								window.location.href='<?=$url?>libraryrecord/listview/<?=$this->session->userdata('yearlr')?>';
							}else{
								alert('Insert Successfully');
							}	
							
						}else{
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
