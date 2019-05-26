<?php
/*---------------     content        ---------------------*/
//var_dump($sectiontotalfeeslist);
echo "<table class='reporttable' border='0' cellpadding='0' cellspacing='1' >";
if(isset($Year)){
	echo '<tr><th colspan = "7" id = "table_title">School Fees Report on '.$Year.' </th></tr>';
}else{
		echo '<tr><th colspan = "7" id = "table_title">School Fees Report on '.$FromDate.'-'.$ToDate.' </th></tr>';
}	
echo "<tr>";
echo "<th align='center' >#</th>";
echo "<th align='center' >Role No</th>";
echo "<th align='center' >Student Name</th>";
echo "<th align='center' >Class</th>" ;
echo "<th align='center' >Section </th>";
echo "<th align='center' >Paid Fees </th>";
echo "<th align='center' >Remain Fees </th>";
echo "</tr>";

$i = 1; $schoolTotal = 0; $RschoolTotal = 0;
$sql1 = ''; $sql2 = ''; $sql3 = ''; $sql4 = ''; $sql = '';
$this->load->model('Adminmodel');
$sql = "SELECT course.ClassId FROM course where course.InstituteId='1'";
$classlist = $this->Adminmodel->query_fun($sql);

foreach($classlist as $cl){
	$sql1 = "SELECT course.ClassId, sectionclass.SectionId FROM course
	JOIN sectionclass ON course.ClassId = sectionclass.ClassId
	WHERE course.ClassId = $cl->ClassId AND course.InstituteId='1'";
	if(isset($Year) && $Year != ''){ 
		$sql2 = "  AND sectionclass.Year ='$Year'";
	}
	$sql = $sql1 . $sql2;
	//var_dump($sql);exit;
	$sectionlist = $this->Adminmodel->query_fun($sql);
	$Tfees = 0; $Trfees = 0;
	if(isset($sectionlist) && count($sectionlist > 0)){
		foreach($sectionlist as $sl){
			$sql1 ="SELECT course.ClassName, section.SectionName, studentclass.StudentId,student.StudentName, SUM(schoolfees.Fees) as SchoolFees, (classfees.ClassFees - SUM(schoolfees.Fees)) AS RemainFees FROM schoolfees
			JOIN studentclass ON schoolfees.StudentId = studentclass.StudentId
			JOIN classfees ON studentclass.StudentClass = classfees.ClassId
			JOIN student ON studentclass.StudentId = student.StudentId
			JOIN course ON studentclass.StudentClass = course.ClassId
			JOIN section ON studentclass.SectionId = section.SectionId 
			WHERE studentclass.StudentClass = $cl->ClassId AND studentclass.SectionId = $sl->SectionId AND schoolfees.InstituteId='1'";
			if(isset($Year) && $Year != ''){ 
				$sql2 = " AND schoolfees.Year = '$Year'";
			}
			if((isset($FromDate) && $FromDate != '') && (isset($ToDate) && $ToDate != '')){
				$sql3 = " AND schoolfees.PaidDate BETWEEN '$FromDate' AND '$ToDate'";
			}
			
			
			$sql4 = " GROUP BY studentclass.StudentId";
			
			$sql = $sql1 . $sql2 . $sql3. $sql4;
			//var_dump($sql);exit;
			$feeslist = $this->Adminmodel->query_fun($sql);
			
			$fees = 0; $rfees = 0;
			
					if(isset($feeslist) && count($feeslist) > 0){
						foreach($feeslist as $fl){
							echo "<tr>";
							echo "<td align='center'>" . $i++ . "</td>";
							echo "<td align='center'>" . $fl->StudentId . "</td>";
							echo "<td align='center'>" . $fl->StudentName . "</td>";
							echo "<td align='center'>" . $fl->ClassName . "</td>";
							echo "<td align='center'>" . $fl->SectionName . "</td>";
							echo "<td align='right' style = 'padding-right:10px;' >" . $fl->SchoolFees . "</td>";
							echo "<td align='right' style = 'padding-right:10px;' >" . $fl->RemainFees . "</td>";
							echo "</tr>";
							$fees += $fl->SchoolFees;
							$rfees += $fl->RemainFees;
						
						
						echo "<tr>";
						echo "<td align='right' colspan = '5' style = 'background-color:#abcde1; color:#000; font-weight:600' > $fl->ClassName class, '$fl->SectionName' section term fees total:</td>";
						echo "<td align='right' style = 'background-color:#abcde1; color:#000; font-weight:600; padding-right:10px;' >" . number_format($fees, 2). "</td>";
						echo "<td align='right' style = 'background-color:#abcde1; color:#000; font-weight:600; padding-right:10px;' >" . number_format($rfees, 2). "</td>";
						echo "</tr>";
						$Tfees +=$fees;
						$Trfees +=$rfees;
						
						
					
			
				echo "<tr>";
				echo "<td align='right' colspan = '5' style = 'background-color:#92afc0; color:#000; font-weight:600' > $fl->ClassName class term fees total:</td>";
				
				
				echo "<td align='right' style = 'background-color:#92afc0; color:#000; font-weight:600; padding-right:10px;' >" . number_format($Tfees, 2). "</td>";
				echo "<td align='right' style = 'background-color:#92afc0; color:#000; font-weight:600; padding-right:10px;' >" . number_format($Trfees, 2). "</td>";
				echo "</tr>";
				$schoolTotal += $Tfees; 
				$RschoolTotal += $Trfees; 
			
			
			}
		}
	}
	}
}
		
		echo "<tr>";
		echo "<td align='right' colspan = '5' style = 'background-color:#6e96ae; color:#000; font-weight:600' >School term fees grand total:</td>";

		echo "<td align='right'  style = 'background-color:#6e96ae; color:#000; font-weight:600; padding-right:10px;' >" . number_format($schoolTotal, 2). "</td>";
		echo "<td align='right'  style = 'background-color:#6e96ae; color:#000; font-weight:600; padding-right:10px;' >" . number_format($RschoolTotal, 2). "</td>";
		echo "</tr>";
	
	
	echo "</table>";
?>



