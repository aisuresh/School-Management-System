<?php
echo ' <div id="tabcontainer" align="center" >';
		echo '<div style = "width:100%; font-size:20px; font-weight:600; margin-top:20px; color:#81cb51" >Student Attendance successfully inserted.</div>';
		$totalpresent = 0; $totalabsents = 0;
		foreach($attendsucces as $as){
			if($as->Attendance == 1 ){
				$totalpresent++;
			}else{
				$totalabsents++;
			}
		}
		echo '<div style = "width:100%; font-size:16px; font-weight:600; margin-top:20px;" > Student Total Present : <span style = "color:#81cb51" >'.$totalpresent.'</span> </div>';
		echo '<div style = "width:100%; font-size:16px; font-weight:600; margin-top:20px;" > Student Total Absents : <span style = "color:#81cb51" >'.$totalabsents.' </span> </div>';
echo'</div>';


?>
<script>
$('#attendance').addClass('current');
</script>
