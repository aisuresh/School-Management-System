<?php

echo "<div class='container'>";
echo "<div class='content_header'>";
/*---------------     content title       ---------------------*/
echo "<div class='content_title'>";
echo $pagetitle.' > '. $event;
echo "</div>";
echo "<div class='content_message'></div>";
/*---------------     content events       ---------------------*/
echo "<div class='content_events'>";

echo "<div class='events'>";
echo "<a href='".$url."examfee/export' >";
echo "<span><img src='".$url."images/export.gif' border='0' /></span>";
echo "<span>  Export  </span>";
echo "</a>";
echo "</div>";

echo "<div class='events'>";
echo "<a onclick='edit_data();' >";
echo "<span><img src='".$url."images/edit.png' border='0' /></span>";
echo "<span>  Edit  </span>";
echo "</a>";
echo "</div>";

echo "<div class='events'>";
echo "<a onclick='view_data();' >";
echo "<span><img src='".$url."images/view.gif' border='0' /></span>";
echo "<span>  View  </span>";
echo "</a>";
echo "</div>";

echo "<div class='events'>";
echo "<a href='".$url."timetable/addnew' >";
echo "<span><img src='".$url."images/addnew.png' border='0' /></span>";
echo "<span>  Addnew  </span>";
echo "</a>";
echo "</div>";

echo "</div>";
echo "</div>";
/*---------------     content        ---------------------*/
echo "<div align='center' class='content'>";
echo'<table  width="80%"  border="0" cellpadding="0" cellspacing="0" id="timetable_tbl">';
$yearno = $this->Adminmodel->maxvalue($table = 'academicyear', $fields = array('AcademicYear'), $where = array());
foreach($yearno as $yno){
	if($yno->AcademicYear != NULL){
		$year = $yno->AcademicYear;
	}
}

$sql = "SELECT * FROM course";
$classlist = $this->Adminmodel->query_fun($sql);

$sql = "SELECT * FROM daylist";
$daylist = $this->Adminmodel->query_fun($sql);
$sql = "SELECT * FROM periodtimings where Year = '$year'";
$totalperiodlist = $this->Adminmodel->query_fun($sql);
	foreach($classlist as $cl){
		echo'<tr>
				<th colspan="12" class = "classtitle" >'.$cl->ClassName.' Class</th>
			 <tr>';
	   echo'<tr>
	   		    <th height="30" >Day Name</th>';
				foreach($totalperiodlist as $tpl){
					if($tpl->PeriodNo % 2 != 0){
						echo'<th >Period ' . $tpl->PeriodNo . '</th>';
					}else{
						if($tpl->PeriodNo != 4){
							if($tpl->PeriodNo < count($totalperiodlist)){
								echo'<th >Period ' . $tpl->PeriodNo . '</th>';
								echo '<th ><span style = "color:#FF6600" >Break</span></th>';
							}else{
								echo'<th >Period ' . $tpl->PeriodNo . '</th>';
							}	
						}else{
							echo'<th >Period ' . $tpl->PeriodNo . '</th>';
							echo'<th ><span style = "color:#FF6600" >Lunch <br />Break</span></th>';
						}
					}		
				}	
	       echo'</tr>';
	foreach($daylist as $dl){
			 
	$sql = "SELECT daylist.DayName, timetable.ClassId, timetable.SectionId,
	SUM(IF(timetable.PeriodId = 1, timetable.TeacherId, 0)) AS  'Teacher1', 
	SUM(IF(timetable.PeriodId = 1, subject.SubjectName, 0)) AS  'Subject1',
	SUM(IF(timetable.PeriodId = 2, timetable.TeacherId, 0)) AS  'Teacher2', 
	SUM(IF(timetable.PeriodId = 2, subject.SubjectName, 0)) AS  'Subject2',
	SUM(IF(timetable.PeriodId = 3, timetable.TeacherId, 0)) AS  'Teacher3', 
	SUM(IF(timetable.PeriodId = 3, subject.SubjectName, 0)) AS  'Subject3',
	SUM(IF(timetable.PeriodId = 4, timetable.TeacherId, 0)) AS  'Teacher4', 
	SUM(IF(timetable.PeriodId = 4, subject.SubjectName, 0)) AS  'Subject4',
	
	SUM(IF(timetable.PeriodId = 5, timetable.TeacherId, 0)) AS  'Teacher5', 
	SUM(IF(timetable.PeriodId = 5, subject.SubjectName, 0)) AS  'Subject5',
	SUM(IF(timetable.PeriodId = 6, timetable.TeacherId, 0)) AS  'Teacher6', 
	SUM(IF(timetable.PeriodId = 6, subject.SubjectName, 0)) AS  'Subject6',
	SUM(IF(timetable.PeriodId = 7, timetable.TeacherId, 0)) AS  'Teacher7', 
	SUM(IF(timetable.PeriodId = 7, subject.SubjectName, 0)) AS  'Subject7',
	SUM(IF(timetable.PeriodId = 8, timetable.TeacherId, 0)) AS  'Teacher8', 
	SUM(IF(timetable.PeriodId = 8, subject.SubjectName, 0)) AS  'Subject8'
	
	FROM timetable
	JOIN subject ON timetable.SubjectId = subject.SubjectId
	JOIN daylist ON timetable.DayId = daylist.DayId
	WHERE timetable.ClassId = $cl->ClassId AND timetable.DayId = $dl->DayId AND timetable.Year = '$year'";
	$timetablelist = $this->Adminmodel->query_fun($sql);
	
		foreach($timetablelist  as $tml){  
			echo'<tr>
				<td height="20" class = "dayname" >'.$tml->DayName.'</td>
				<td>'.$tml->Subject1.'</td>
				<td>'.$tml->Subject2.'</td>
				<td>&nbsp;</td>
				<td>'.$tml->Subject3.'</td>
				<td>'.$tml->Subject4.'</td>
				
				<td>&nbsp;</td>
				<td>'.$tml->Subject5.'</td>
				<td>'.$tml->Subject6.'</td>
				<td>&nbsp;</td>
				<td>'.$tml->Subject7.'</td>
				<td>'.$tml->Subject8.'</td>     
			</tr>';
		}	
	}
}  
echo '</table>';  
echo "</div>";
echo "</div>";
?>
<script>
function edit_data(){
	var rollid = $('input:radio[name=SchoolFeeId]:checked').val();
	 window.location='<?=$url?>timetable/edit';
}	
	
	
</script>
<script src="<?php echo $url ?>js/template.js"></script>