<?php
	echo "<div class='container'>";
	
	  echo "<div align='center' class='login_panel'>";
	  echo "<form name='login_form' method='post' action =''>";
	  echo "<table width='70%' border='0' cellpadding='2' cellspacing='2' class='logintable'>";
	  echo "<tr><td colspan='3' > <span style='font-size:20px; font-weight:bold; color:#0a66c4;'>User Login</span> </td>";
	  echo "<tr><td colspan='3'></td>";
	  echo "<tr><td width='32%' align='right'><label>User id</label></td><td width='8%'></td>";
	  echo "<td width='30%'><input type='text' name='userid' class='text' id=userid onkeyup='validateLoginForma(event);' /></td></tr>";
	  echo "<tr><td width='32%'><label>Password</label></td><td width='8%'></td>";
	  echo "<td width='30%'><input type='password' name='password' id='password' class='text' onkeyup='validateLoginForma(event);' /></td></tr>";
	  echo "<tr><td width='32%'> </td><td width='8%'></td>";
	  echo "<td width='30%'><input type='submit' name='submit' class='submit' value='Login' onClick='validateLoginForm();' /></td></tr>";
	  echo "</table>";
	  echo "</form>";
	  echo "</div>";
	
	 echo "</div>";
?>	

<script>

/*onclick='login_fun();'
function login_fun(){
 var userid = $('#userid').val();
 var password = $('#password').val();
 $.ajax({
				type: "POST",
				url: "/school/index.php/admin/login/",
				data: "userid="+userid+"&password="+password,
				success: function(response){						
						if(response==1){
							//$("#route").val("");
							//$("#routeArea").val("");
							//$("#routeDist").val("");
							alert("Created The Route");
							}
						else{
							$("#route").val("");
							alert("Failed to create");
							}
							
					}
			});
}
</script>*/