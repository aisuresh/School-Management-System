<?php
echo ' <div id="tabcontainer">';
 echo "<div align='center' class='login_panel'>";
	  echo "<table width='70%' border='0' cellpadding='2' cellspacing='2' class='logintable'>";
	  echo "<tr><td colspan='3' > <span style='font-size:20px; font-weight:bold; color:#0a66c4;'>User Login</span> </td>";
	  echo "<tr><td colspan='3'>
	  <label class='message' style='display:none; color:red'> <span style='margin-top:-5px; float:left;'> <img src='".$url."images/error_msg.gif' /></span> <span style=' float:left;  margin-left:5px; '> Invalid User ID and Password</span> </label>
	  </td>";
	  echo "<tr><td width='32%' align='right'><label>User id</label></td><td width='8%'></td>";
	  echo "<td width='30%'><input type='text' name='userid' class='text' id=userid onkeyup='validateLoginForma(event);' /></td></tr>";
	  echo "<tr><td width='32%' align='right' ><label>Password</label></td><td width='8%'></td>";
	  echo "<td width='30%'><input type='password' name='password' id='password' class='text' onkeyup='validateLoginForma(event);' /></td></tr>";
	  echo "<tr><td width='32%'> </td><td width='8%'></td>";
	  echo "<td width='30%'><input type='button' name='submit' class='submit' value='Login' onClick = 'validateLoginForm();'  /></td></tr>";
	  echo "</table>";
	  echo "</div>";
echo'</div>';

?>
<script>

function validateLoginForm()
{
	var userid = jQuery('#userid').val();
	var psw = jQuery('#password').val();
	if(userid == '' || psw == '')
	{
		 jQuery('.message').show().fadeIn('slow');
		 
	}else{
		 jQuery.ajax
		 ({  
             type: "POST",  
             url: "<?=$url?>tab/login",  
             data: "userid=" + userid + "&password=" + psw,  
             success: function(data)
			 {
					//alert(data);
					if( $.trim(data) != '')
					{
						jQuery('.message').hide();
						window.location.href = jQuery.trim(data);
             		}else{
				    	jQuery('.message').show().fadeIn('slow');
			 		}
			}
        });  
		
	}
	
}

/* Login page form validation Keydown event */
function validateLoginForma(e)
{
	
	if(e.keyCode == 13){
		var userid = $('#userid').val();
		var psw = $('#password').val();
		if(userid == '' || psw == '')
		{
			 $('.message').show().fadeIn('slow');
			 
		}else{
			
			$('.message').hide().fadeOut('slow');
			
			 $.ajax
			 ({  
				 type: "POST",  
				 url: "<?=$url?>tab/login",  
				 data: "userid=" + userid + "&password=" + psw,  
				 success: function(data)
				 {
						if(data != '')
						{
							$('.message').hide().fadeOut('slow');
							window.location.href = $.trim(data);
						}else{
							$('.message').show().fadeIn('slow');
						}
				}
			});  
			
		}	
	}
}

</script>