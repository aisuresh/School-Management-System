
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
echo "<a onclick='save_data();'>";
echo "<span><img src='".$url."images/save.png' border='0' /></span>";
echo "<span>Save</span>";
echo "</a>";
echo "</div>";

echo "</div>";
echo "</div>";
/*---------------     content        ---------------------*/
echo "<div align='center' class='content'>";
echo "<div id ='message' style = 'width:500px' ></div>";
echo "<div id ='message1'></div>";
echo "<div id = 'mandatory' ><span align ='right' class = 'mandatory'>*</span> Specified fileds are mandatory</div>";
echo "<table border='0' cellpadding='0' cellspacing='0' class='formtable'>";
echo '<tr><th colspan = "3" id = "table_title">Change Your Password </th></tr>';
echo "<tr>";
echo "<td align='right' width='15%' class = 'datafield' >Enter Old Password <span class = 'mandatory'>*</span></td>";
echo "<td width='2%' class='spacetd' > </td>";
echo "<td width='33%' class = 'dataview' >";
echo "<input type= 'text' name = 'OldPassword' id = 'OldPassword' >";
echo "</td></tr>";

echo "<tr>";
echo "<td align='right' width='15%' class = 'datafield' >Enter New Password <span class = 'mandatory'>*</span></td>";
echo "<td width='2%' class='spacetd' > </td>";
echo "<td width='33%' class = 'dataview' >";
echo "<input type= 'text' name = 'NewPassword' id = 'NewPassword' >";
echo "</td></tr>";

echo "<tr>";
echo "<td align='right' width='15%' class = 'datafield' >Re-Enter New Password <span class = 'mandatory'>*</span></td>";
echo "<td width='2%' class='spacetd' > </td>";
echo "<td width='33%' class = 'dataview' >";
echo "<input type= 'text' name = 'RePassword' id = 'RePassword' >";
echo "</td></tr>";



echo "</table>";

echo "</div>";
echo "</div>";
?>
<script>

function validation(){
	var OldPassword = $('#OldPassword').val();
	var NewPassword = $('#NewPassword').val();
	var RePassword  = $('#RePassword').val();
	
     if(OldPassword ==''){
		$('#message').html('OldPassword should not be blank').show().fadeOut('slow').fadeIn('slow');
		$('#OldPassword').focus();
		return false;
	}else if(NewPassword ==''){
		$('#message').html('NewPassword should not be blank').show().fadeOut('slow').fadeIn('slow');
		$('#NewPassword').focus();
		return false;
	}else if(RePassword ==''){
		$('#message').html('RePassword should not be blank').show().fadeOut('slow').fadeIn('slow');
		$('#RePassword').focus();
		return false;
	}else if(NewPassword != RePassword){
	    $('#message').html('Password and ReEnter Password should be Same').show().fadeOut('slow').fadeIn('slow');
		 $('#NewPassword').val('');
	     $('#RePassword').val('');
	     $('#NewPassword').focus();
		return false;
	}else{
		return true;
	}
}

function save_data(){

 var OldPassword = $('#OldPassword').val();
 var NewPassword = $('#NewPassword').val();
 
 if(validation()){
	 	$.ajax({
			type: 'POST',
			url: '<?=$url?>profile/save',
			data: 'OldPassword='+OldPassword+'&NewPassword='+NewPassword,
			success: function(response){
				if(response == 1){
					 alert('Password Change Successfully');
				}else if(response == 2){
					alert('You Enter Wrong Old Password.');
				}else{
					alert('Password Change Not Successfully');
				}
			}
					
		});
	}	
}


</script>
