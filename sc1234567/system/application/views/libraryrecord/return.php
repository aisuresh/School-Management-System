<link rel="stylesheet" type="text/css" href="<?php echo $url .'css/calendar.css' ?>" />
<script type="text/javascript" src="<?php echo $url .'js/calendar/calendar_db.js' ?>"></script>

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
echo "<div id = 'mandatory' ><span align ='right' class = 'mandatory'>*</span> Specipied fileds are mandatory</div>";
echo "<table border='0' cellpadding='0' cellspacing='0' class='formtable'>";
echo "<tr>";
echo "<td align='right' width='15%' class = 'datafield' >Library No</td>";
echo "<td width='2%' class='spacetd' > </td>";
echo "<td width='33%' class = 'dataview' >";
echo "<select name = 'LibraryNo' id = 'LibraryNo' onchange = 'get_bookissue_list();' >";
echo "<option value = 'x'>- - Select Library No - -</option>";
	foreach($libraryno as $rowa):
		echo "<option value = '".$rowa->LibraryNo."' >";
		echo $rowa->LibraryNo;
		echo "</option>";
	endforeach;
echo "</select>";
echo "</td></tr>";
echo "</table>";

echo'<div id = "bookreturn_panel" style = "margin-top:10px;">';

echo'</div>';

echo "</div>";
echo "</div>";
?>

<script>

function validation(){
 	var bookissueno = $('input:checkbox[name = "LibraryRecordId"]:checked').length;	
	 if(bookissueno == 0){
		$('#message').html('You should select atleast one record.').show().fadeOut('slow').fadeIn('slow');
		$('input:checkbox[name = "LibraryRecordId"]').focus();
		return false;
	}else{
		return true;
	}
}



function save_data($e){
	
	var bookissueno = $('input:checkbox[name = "LibraryRecordId"]:checked').length;	
	var LibraryRecordId = Array();
	for(var i = 1; i <= bookissueno; i++){
		LibraryRecordId[i-1] = $('input:checkbox[id = "LibraryRecordId'+i+'"]:checked').val();
	}	
 
 	
	if(validation()){
 		$.ajax({
				type: 'POST',
				url: '<?=$url?>libraryrecord/update',
				data: 'LibraryRecordId='+LibraryRecordId,
				success: function(response){			
						if(response != 'error'){
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

function get_bookissue_list(){
	 var LibraryNo = $('#LibraryNo').val();
	 
	 $.ajax({
				type: 'POST',
				url: '<?=$url?>libraryrecord/issuelist',
				data: 'LibraryNo='+LibraryNo,
				success: function(response){			
						if(response != ''){
							$('#bookreturn_panel').html(response);
						}
							
					}
					
		});
}
		
</script>
