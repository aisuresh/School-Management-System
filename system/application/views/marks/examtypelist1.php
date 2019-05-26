<?php

	
  echo '<table class="reporttable" border="0" cellpadding="0" cellspacing="1" >  
        <tr><th colspan = "7" id = "table_title">Mark Detail List View </th></tr>

				   <tr id="recordtitle" >
					    <th align="center" >S.No</th>
						<th align="center" ><input type = "hidden" name = "tablename" class="MarksId" id ="ordertype"  value = "0" /> </th>
						<th align="center" >ExamType</th>
						<th align="center" ></th>
						
					</tr>';
   $i = 1;
   if(isset($result) && count($result>0)){
   foreach($result as $row){
		            echo '<tr>
					<td align="center"  >' . $i++. '</td>
					<td align="center" ><input type="radio" name = "MarksId" id = "MarksId" value =' . $row->MarksId . '/></td>	
		
					<td align="center" >'.$row->ExamType. '</td>
					<td align="center" >
					<table border="0" >  
						<tr id="recordtitle" >
							<th align="center" >Subject</th>
							<th align="center" >Marks</th>
						</tr>';
						
							
$subarray = explode(',', $row->Marks);	
//$subarray = explode(',', $row->Marks);	
	
$i=0;						
foreach($subjects as $sub){
    $firstarray[$i] = $sub->SubjectName;
	$i++;
  //echo '<tr><td>'.$sub->SubjectName .'</td></tr>';
	//echo '<td>'.$subarray.'</td></tr>';
}
$combinearray= array_combine($firstarray,$subarray);
foreach($combinearray as $com=>$value){


echo '<tr><td>'.$com.'</td>';
echo '<td>'.$value.'</td></tr>';
}
echo '</table></td>';
echo '</tr>';
	}

}
else{
	echo '<tr><span style="font-weight:bold; font-size:12px; color:#EA0000;"> No data to display</span></tr>';
}
echo '</table>';
    
echo "<div class='pagenation'>" . $links . "</div>";
echo "</div>";
echo "</div>";
?>
