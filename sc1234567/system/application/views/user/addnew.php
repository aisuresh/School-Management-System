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
echo "<a href='".$url."user/listview'>";
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
echo "<span class = 'mandatory'>*</span> Specified fileds are mandatory";
echo "<table border='0' cellpadding='0' cellspacing='0' class='formtable'>";
echo '<tr><th colspan = "3" id = "table_title">Create New User Information</th></tr>';
echo "<tr>";
echo "<td align='right' width='15%' class = 'datafield' >User Name<span class = 'mandatory'>*</span></td>";
echo "<td width='2%' class='spacetd' > </td>";
echo "<td width='33%' class = 'dataview' ><input type = 'text' name = 'UserName' id = 'UserName' onKeyUp='JsCheckChar(this)' /> </td>";
echo "</tr>";

echo "<tr>";
echo "<td align='right' width='15%' class = 'datafield' >User Id<span class = 'mandatory'>*</span></td>";
echo "<td width='2%' class='spacetd' > </td>";
echo "<td width='33%' class = 'dataview' ><input type = 'text' name = 'UserId' id = 'UserId' /> </td>";
echo "</tr>";

echo "<tr>";
echo "<td align='right' width='15%' class = 'datafield' >Password<span class = 'mandatory'>*</span></td>";
echo "<td width='2%' class='spacetd' > </td>";
echo "<td width='33%' class = 'dataview' ><input type = 'text' name = 'Password' id = 'Password' /> </td>";
echo "</tr>";

echo "<tr>";
echo "<td align='right' width='15%' class = 'datafield' >User Type<span class = 'mandatory'>*</span></td>";
echo "<td width='2%' class='spacetd' > </td>";
echo "<td width='33%' class = 'dataview' >";
echo "<select name = 'UserTypeId' id = 'UserTypeId' >";
echo "<option value = 'x'>- - Select User Type - -</option>";
	foreach($roll as $row):
	
	if($row->InstituteId == $this->session->userdata('InstituteId'))
	{
			echo "<option value = '".$row->RollId."' visible = 'hidden' >";
			echo $row->RollType;
			echo "</option>";
	}
	endforeach;
echo "</select>";
echo "</td></tr>";

echo "<tr>";
echo "<td align='right' width='15%' class = 'datafield' >Description</td>";
echo "<td width='2%' class='spacetd' > </td>";
echo "<td width='33%' class = 'dataview' ><input type = 'text' name = 'UserDes' id = 'UserDes' /></td>";
echo "</tr>";

echo "</table>";

echo "</div>";
echo "</div>";
?>

<script>

function validation(){
	 var UserName = $('#UserName').val();
	 var UserId = $('#UserId').val();
	 var Password = $('#Password').val();
	 var UserTypeId = $('#UserTypeId').val();
	if(UserName == ''){
		$('#message').html('User Name should not be blank').show().fadeOut('slow').fadeIn('slow');
		$('#UserName').focus();
		return false;
	}else if(UserId == ''){
		$('#message').html('UserId should not be blank').show().fadeOut('slow').fadeIn('slow');
		$('#UserId').focus();
		return false;
	}else if(Password == ''){
		$('#message').html('Password should not be blank').show().fadeOut('slow').fadeIn('slow');
		$('#Password').focus();
		return false;
	}else if(UserTypeId == 'x'){
		$('#message').html('User Type should not be blank').show().fadeOut('slow').fadeIn('slow');
		$('#UserTypeId').focus();
		return false;
	}else{
		return true;
	}

}

function save_data($e){

 var UserName = $('#UserName').val();
 var UserId = $('#UserId').val();
 var Password = $('#Password').val();
 var UserTypeId = $('#UserTypeId').val();
 var UserDes = $('#UserDes').val();
 if(validation()){
 		$.ajax({
				type: 'POST',
				url: '<?=$url?>user/save',
				data: 'UserName='+UserName+'&UserId='+UserId+'&Password='+Password+'&UserTypeId='+UserTypeId+'&UserDes='+UserDes,
				success: function(response){
				
						if(response == 1){
							if($e == 1){
								window.location.href='<?=$url?>user/listview';
							}else{
								alert('Insert Successfully');
							}	
						}else if(response == 2)
					{
						alert('Username already exists!.');
					}
					else{
						alert('Insert Not Successfully');
						}
					}
					
		});
	}	
}
				
</script>
