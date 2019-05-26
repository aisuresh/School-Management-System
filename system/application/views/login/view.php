<?php
	echo "<div class='container'>";
	
	  echo "<div align='center' class='login_panel'>";
	  echo "<form name='login_form' method='post' >";
	  echo "<table width='70%' border='0' cellpadding='2' cellspacing='2' class='logintable'>";
	  echo "<tr><td colspan='3' > <span style='font-size:20px; font-weight:bold; color:#0a66c4;'>User Login</span> </td>";
	  echo "<tr><td colspan='3'>
	  <label class='message' style='display:none; color:red'> <span style='margin-top:-5px; float:left;'> <img src='".base_url()."images/error_msg.gif' /></span> <span style=' float:left;  margin-left:5px; '> Invalid User ID and Password</span> </label>
	  </td>";
	  echo "<tr><td width='32%' align='right'><label>User id</label></td><td width='8%'></td>";
	  echo "<td width='30%'><input type='text' name='userid' class='text' id='userid' onkeyup='validateLoginForma(event);' /></td></tr>";
	  echo "<tr><td width='32%' align='right' ><label>Password</label></td><td width='8%'></td>";
	  echo "<td width='30%'><input type='password' name='password' id='password' class='text' onkeyup='validateLoginForma(event);' /></td></tr>";
	  echo "<tr><td width='32%'> </td><td width='8%'></td>";
	  echo "<td width='30%'><input type='button' name='submit' class='submit' value='Login' onClick = 'validateLoginForm();'  /></td></tr>";
	  echo "</table>";
	  echo "</form>";
	  echo "</div>";
	
	 echo "</div>";
?>	

<script>

function validateLoginForm()
{
	var userid = jQuery('#userid').val();
	var psw = jQuery('#password').val();
	//alert(1);
	if(userid == '' || psw == '')
	{
		 jQuery('.message').show().fadeIn('slow');
		 
	}else{
		 jQuery.ajax
		 ({  
             type: "POST",  
             url: "<?=$url?>login/user",  
             data: "userid=" + userid + "&password=" + psw,  
             success: function(data)
			 {
					//alert(data);
					if($.trim(data) != 'error')
					{
						jQuery('.message').hide();
						window.location.href = jQuery.trim($.trim(data));
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
		//alert(1);
		if(userid == '' || psw == '')
		{
			 $('.message').show().fadeIn('slow');
			 
		}else{
			
			$('.message').hide().fadeOut('slow');
			
			 $.ajax
			 ({  
				 type: "POST",  
				 url: "<?=$url?>login/user",  
				 data: "userid=" + userid + "&password=" + psw,  
				 success: function(data)
				 {
						//alert(data);
						if($.trim(data) != 'error')
						{
							$('.message').hide().fadeOut('slow');
							window.location.href = $.trim($.trim(data));
						}else{
							$('.message').show().fadeIn('slow');
						}
				}
			});  
			
		}	
	}
}

</script>