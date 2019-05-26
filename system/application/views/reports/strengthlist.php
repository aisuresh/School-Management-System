<?php
/*---------------     content        ---------------------*/
//var_dump($sectiontotalfeeslist);
$i = 1; $total = 0;
echo "<table class='reporttable' border='0' cellpadding='0' cellspacing='1'  >";
echo '<tr><th colspan = "23" id = "table_title">Student\'s Strength Report </th></tr>';
echo "<tr>";
echo "<th align='center' rowspan = '2' >Class</th>";
$sql = "select * from castcategory";
$castcategory = $this->Adminmodel->query_fun($sql);
$sql = "select * from course";
$course = $this->Adminmodel->query_fun($sql);
foreach($castcategory as $cc){
	echo "<th align='center' colspan = '3' >".$cc->CastCategory."</th>";
}
echo "<th align='center'  rowspan = '2' >Class Grand <br />Total</th>";
echo "</tr>";
echo '<tr>';
	for($i = 0; $i < count($castcategory); $i++){
		echo'<th align="center" >Boys</th>
		<th align="center" >Girls</th>
		<th align="center" >Total</th>';
	}	
echo'</tr>';
	$OCm = 0; $OCf =0; $BCAm = 0; $BCAf = 0; $BCBm = 0; $BCBf = 0; $BCCm = 0;
	$BCCf = 0; $BCDm = 0; $BCDf = 0; $STm = 0; $STf = 0; $SCm = 0; $SCf = 0;
foreach($course as $cs){
	$sql = "SELECT studentclass.StudentClass, 
	SUM(IF(student.CastCategoryId = 1 AND student.Gender = 'm', 1, 0)) AS  'OCm',
	SUM(IF(student.CastCategoryId = 1 AND student.Gender = 'f', 1, 0)) AS  'OCf',
	SUM(IF(student.CastCategoryId = 2 AND student.Gender = 'm', 1, 0)) AS  'BCAm',
	SUM(IF(student.CastCategoryId = 2 AND student.Gender = 'f', 1, 0)) AS  'BCAf',
	SUM(IF(student.CastCategoryId = 3 AND student.Gender = 'm', 1, 0)) AS  'BCBm',
	SUM(IF(student.CastCategoryId = 3 AND student.Gender = 'f', 1, 0)) AS  'BCBf',
	SUM(IF(student.CastCategoryId = 4 AND student.Gender = 'm', 1, 0)) AS  'BCCm',
	SUM(IF(student.CastCategoryId = 4 AND student.Gender = 'f', 1, 0)) AS  'BCCf',
	SUM(IF(student.CastCategoryId = 5 AND student.Gender = 'm', 1, 0)) AS  'BCDm',
	SUM(IF(student.CastCategoryId = 5 AND student.Gender = 'f', 1, 0)) AS  'BCDf',
	SUM(IF(student.CastCategoryId = 6 AND student.Gender = 'm', 1, 0)) AS  'STm',
	SUM(IF(student.CastCategoryId = 6 AND student.Gender = 'f', 1, 0)) AS  'STf',
	SUM(IF(student.CastCategoryId = 7 AND student.Gender = 'm', 1, 0)) AS  'SCm',
	SUM(IF(student.CastCategoryId = 7 AND student.Gender = 'f', 1, 0)) AS  'SCf'
	FROM student
	JOIN studentclass ON student.StudentId = studentclass.StudentId
	JOIN castcategory ON student.CastCategoryId = castcategory.CastCategoryId
	WHERE studentclass.StudentClass = $cs->ClassId AND Year = '$year'
	GROUP BY studentclass.StudentId";
	$strengthlist = $this->Adminmodel->query_fun($sql);
	//print_r($strengthlist);
	//echo $strengthlist;
	

		if(isset($strengthlist) && count($strengthlist) > 0 ){
			foreach($strengthlist as $stl){
					if($stl->OCm != 0){
						$OCm = $stl->OCm;
					}else{
						$OCm = 0;
					}
					if($stl->OCf != 0){
						$OCf = $stl->OCf;
					}else{
						$OCf = 0;
					}
					if($stl->BCAm != 0){
						$BCAm = $stl->BCAm;
					}else{
						$BCAm = 0;
					}					
					if($stl->BCAf != 0){
						$BCAf = $stl->BCAf;
					}else{
						$BCAf = 0;
					}
					if($stl->BCBm != 0){
						$BCBm = $stl->BCBm;
					}else{
						$BCBm = 0;
					}
					if($stl->BCBf != 0){
						$BCBf = $stl->BCBf;
					}else{
						$BCBf = 0;
					}
					if($stl->BCCm != 0){
						$BCCm = $stl->BCCm;
					}else{
						$BCCm = 0;
					}
					if($stl->BCCf != 0){
						$BCCf = $stl->BCCf;
					}else{
						$BCCf = 0;
					}
					if($stl->BCDm != 0){
						$BCDm = $stl->BCDm ;
					}else{
						$BCDm = 0;
					}
					if($stl->BCDf != 0){
						$BCDf = $stl->BCDf;
					}else{
						$BCDf = 0;
					}
					if($stl->STm != 0){
						$STm = $stl->STm;
					}else{
						$STm = 0;
					}
					if($stl->STf != 0){
						$STf = $stl->STf;
					}else{
						$STf = 0;
					}
					if($stl->SCm != 0){
						$SCm = $stl->SCm;
					}else{
						$SCm = 0;
					}
					if($stl->SCf != 0){
						$SCf = $stl->SCf;
					}else{
						$SCf = 0;
					}
				//}	
					$OC =  ($OCm+$OCf);
					$BCA = ($BCAm+$BCAf);
					$BCB = ($BCBm+$BCBf);
					$BCC = ($BCCm+$BCCf);
					$BCD = ($BCDm+$BCDf);
					$ST =  ($STm+$STf);
					$SC =  ($SCm+$SCf);
					
					echo "<tr>";
					echo "<td align='center' >".$cs->ClassName."</th>";
					echo "<td align='center' >".$OCm."</td>";
					echo "<td align='center' >".$OCf."</td>";
					echo "<td align='center' >".$OC."</td>";
					echo "<td align='center' >".$BCAm."</td>";
					echo "<td align='center' >".$BCAf."</td>" ;
					echo "<td align='center' >".$BCA."</td>";
					echo "<td align='center' >".$BCBm."</td>";
					echo "<td align='center' >".$BCBf."</td>";
					echo "<td align='center' >".$BCB."</td>";
					echo "<td align='center' >".$BCCm."</td>";
					echo "<td align='center' >".$BCCf."</td>";
					echo "<td align='center' >".$BCC."</td>";
					echo "<td align='center' >".$BCDm."</td>";
					echo "<td align='center' >".$BCDf."</td>";
					echo "<td align='center' >".$BCD."</td>";
					echo "<td align='center' >".$STm."</td>";
					echo "<td align='center' >".$STf."</td>";
					echo "<td align='center' >".$ST."</td>";
					echo "<td align='center' >".$SCm."</td>";
					echo "<td align='center' >".$SCf."</td>";
					echo "<td align='center' >".$SC."</td>";
					echo "<td align='center' >".($OC + $BCA + $BCB + $BCC + $BCD + $ST + $SC)."</td>";
					$total += ($OC + $BCA + $BCB + $BCC + $BCD + $ST + $SC);
			}
		}	
}
	echo "<tr style = 'font-weight:600; font-size:12px;' >";
		echo '<td colspan = "'.((count($castcategory) * 3)+ 1).'" align = "right" >School Grand Total Strenth: </td>';
		echo '<td  align = "center"  >'.$total.'</td>';
	echo "</tr>";			
echo "</table>";
?>
