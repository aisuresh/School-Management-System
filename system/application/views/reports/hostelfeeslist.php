<?php
/*---------------     content        ---------------------*/
//var_dump($sectiontotalfeeslist);
echo "<table class='reporttable' border='0' cellpadding='0' cellspacing='1' >";

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
$sql1 = ''; $sql2 = ''; $sql3 = ''; $sql4 = ''; $sql = ''; $m = 0;
$this->load->model('Adminmodel');
$sql = "
SELECT DISTINCT course.ClassId FROM hostelregister
	JOIN studentclass ON hostelregister.StudentId = studentclass.StudentId
	JOIN course ON studentclass.StudentClass = course.ClassId
	JOIN sectionclass ON course.ClassId = sectionclass.ClassId where course.InstituteId = 1";
	//var_dump($sql);
$classlist = $this->Adminmodel->query_fun($sql);
foreach($classlist as $cl){
	$sql1 = "SELECT course.ClassId, sectionclass.SectionId FROM course
	JOIN sectionclass ON course.ClassId = sectionclass.ClassId
	WHERE course.ClassId = $cl->ClassId and course.InstituteId = 1";
	if(isset($Year) && $Year != ''){ 
		$sql2 = "  AND sectionclass.Year ='$Year'";
	}
	$sql = $sql1 . $sql2;
	$sectionlist = $this->Adminmodel->query_fun($sql);
	$Tfees = 0; $Trfees = 0; 
	//var_dump($sectionlist);
	foreach($sectionlist as $sl){
		$sql1 ="SELECT course.ClassName, section.SectionName, studentclass.StudentId,student.StudentName, SUM(hostelrecord.HostelTermFee) as HostelFees, (hostelfees.HostelFees - SUM(hostelrecord.HostelTermFee)) AS RemainFees FROM hostelregister
		JOIN hostelrecord ON hostelregister.StudentId = hostelrecord.StudentId
		JOIN studentclass ON hostelregister.StudentId = studentclass.StudentId
		JOIN hostelfees ON studentclass.StudentClass = hostelfees.ClassId
		JOIN student ON studentclass.StudentId= student.StudentId
		JOIN course ON studentclass.StudentClass = course.ClassId
		JOIN section ON studentclass.SectionId = section.SectionId 
		WHERE studentclass.StudentClass = $cl->ClassId AND studentclass.SectionId = $sl->SectionId and hostelregister.InstituteId = 1";
		if(isset($Year) && $Year != ''){ 
			$sql2 = " AND hostelrecord.Year = '$Year'";
		}
		if((isset($FromDate) && $FromDate != '') && (isset($ToDate) && $ToDate != '')){
			$sql3 = " AND hostelrecord.TermPaidDate BETWEEN '$FromDate' AND '$ToDate'";
		}
		$sql4 = "GROUP BY studentclass.StudentId";
		$sql = $sql1 . $sql2 . $sql3. $sql4;
		//var_dump($sql);
		$feeslist = $this->Adminmodel->query_fun($sql);
		//var_dump($feeslist);
		$fees = 0; $rfees = 0; 
		//var_dump($feeslist);
				if(count($feeslist) > 0){
					foreach($feeslist as $fl){
						echo "<tr>";
						echo "<td align='center'>" . $i++ . "</td>";
						echo "<td align='center'>" . $fl->StudentId . "</td>";
						echo "<td align='center'>" . $fl->StudentName . "</td>";
						echo "<td align='center'>" . $fl->ClassName . "</td>";
						echo "<td align='center'>" . $fl->SectionName . "</td>";
						echo "<td align='right' style = 'padding-right:10px;' >" . $fl->HostelFees . "</td>";
						echo "<td align='right' style = 'padding-right:10px;' >" . $fl->RemainFees . "</td>";
						echo "</tr>";
						$fees += $fl->HostelFees;
						$rfees += $fl->RemainFees;
					
				
				
					echo "<tr>";
					echo "<td align='right' colspan = '5' style = 'background-color:#abcde1; color:#000; font-weight:600' > $fl->ClassName class, '$fl->SectionName' section hostel fees total:</td>";
					echo "<td align='right' style = 'background-color:#abcde1; color:#000; font-weight:600; padding-right:10px;' >" . number_format($fees, 2). "</td>";
					echo "<td align='right' style = 'background-color:#abcde1; color:#000; font-weight:600; padding-right:10px;' >" . number_format($rfees, 2). "</td>";
					echo "</tr>";
					$Tfees +=$fees;
					$Trfees +=$rfees;
				
			
			
			echo "<tr>";
			echo "<td align='right' colspan = '5' style = 'background-color:#92afc0; color:#000; font-weight:600' > $fl->ClassName class hostel fees total:</td>";
			echo "<td align='right' style = 'background-color:#92afc0; color:#000; font-weight:600; padding-right:10px;' >" . number_format($Tfees, 2). "</td>";
			echo "<td align='right' style = 'background-color:#92afc0; color:#000; font-weight:600; padding-right:10px;' >" . number_format($Trfees, 2). "</td>";
			echo "</tr>";
			
			$schoolTotal += $Tfees; 
			//echo($schoolTotal);
			$RschoolTotal += $Trfees; 
		}
		}
		}
		}
		
		echo "<tr>";
		echo "<td align='right' colspan = '5' style = 'background-color:#6e96ae; color:#000; font-weight:600' >School hostel fees grand total:</td>";
		echo "<td align='right'  style = 'background-color:#6e96ae; color:#000; font-weight:600; padding-right:10px;' >" . number_format($schoolTotal, 2). "</td>";
		echo "<td align='right'  style = 'background-color:#6e96ae; color:#000; font-weight:600; padding-right:10px;' >" . number_format($RschoolTotal, 2). "</td>";
		echo "</tr>";
echo "</table>";
?>
