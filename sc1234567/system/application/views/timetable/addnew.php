<style>
	table#timetable_tbl tr td{ text-align:center; background-color:#dbf0fc; border:1px solid #a7d2eb; border-top:none; border-left:none; height:60px; }
</style>
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
echo "<a href='".$url."timetable/listview/'>";
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
$k = 1; $a = 1;
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
	      echo' </tr>';
		  $i =1;
	foreach($daylist as $dl){
			 
			echo'<tr>
				<td height="20" class = "dayname" >'.$dl->DayName.'</td>';
				$sql = "select * from totalperiods where Year = '$year' ";
				$totalperiods = $this->Adminmodel->query_fun($sql);
				$total_periods = 0;
				foreach($totalperiods as $tp){
					$total_periods += $tp->NoOfPeriods;
				}	
				for($k = 1; $k <= $total_periods; $k++){
					
					if($k % 2 != 0 ){
						echo'<td>';
							$sql = "SELECT DISTINCT facultylist.TeacherId, staff.StaffName FROM facultylist 
									JOIN staff ON facultylist.TeacherId = staff.StaffId 
									WHERE YEAR = '$year' ";
							$teacherlist = $this->Adminmodel->query_fun($sql);
							echo '<select name = "teacher'.$a.$i.$k.'" id ="teacher'.$a.$i.$k.'" class = "timetable_select" onChange = "show_subjects('.$a.','.$i.','.$k.');" >';
								echo '<option value = "x" >-- Teacher --</option>';
								foreach($teacherlist as $tl){
									echo '<option value = "'.$tl->TeacherId.'" >'.$tl->StaffName.'</option>';
								}	
							echo'</select>';
							
							$sql = "SELECT * FROM subject";
							$teacherlist = $this->Adminmodel->query_fun($sql);
							echo '<select name = "subject'.$a.$i.$k.'" id ="subject'.$a.$i.$k.'" class = "timetable_select" style ="margin-top:10px;" >';
								echo '<option value = "x" >-- Subject --</option>';
							echo'</select>';
						echo'</td>';
					}else{
						
						echo'<td>';
							$sql = "SELECT DISTINCT facultylist.TeacherId, staff.StaffName FROM facultylist 
									JOIN staff ON facultylist.TeacherId = staff.StaffId 
									WHERE YEAR = '$year' ";
							$teacherlist = $this->Adminmodel->query_fun($sql);
							echo '<select name = "teacher'.$a.$i.$k.'" id ="teacher'.$a.$i.$k.'" class = "timetable_select" onChange = "show_subjects('.$a.','.$i.','.$k.');" >';
								echo '<option value = "x" >-- Teacher --</option>';
								foreach($teacherlist as $tl){
									echo '<option value = "'.$tl->TeacherId.'" >'.$tl->StaffName.'</option>';
								}	
							echo'</select>';
							
							$sql = "SELECT * FROM subject";
							$teacherlist = $this->Adminmodel->query_fun($sql);
							echo '<select name = "subject'.$a.$i.$k.'" id ="subject'.$a.$i.$k.'" class = "timetable_select" style ="margin-top:10px;" >';
								echo '<option value = "x" >-- Subject --</option>';
							echo'</select>';
						echo'</td>';
						echo'<td>&nbsp;</td>';
					}
				}	
			echo'</tr>';
		$i++;	
	}
	$a++;
}  
echo '</table>';  
echo "</div>";
echo "</div>";
?>
<script>	

function show_subjects(a,i,k){
var teacher = $("#teacher"+a+i+k).val();
	$.ajax({
		type: 'POST',
		url: '<?=$url?>timetable/showsubjects',
		data: 'teacher='+teacher,
		success: function(response){
			if(response != ''){
				$("#subject"+a+i+k).html(response);
			}
		}
						
	});
}

function save_data($e){
 var teachers = Array();
 var subjects = Array();
 var classid = Array();
 var week = Array();
 var period = Array(); 
 var r = 0; 
 for(var a = 1; a < <?=count($classlist)?>; a++){
 	for(var i = 1; i < <?=$i?>; i++  ){
		for(var k = 1; k < <?=$k?>; k++){
			teachers[r] = $('#teacher'+a+i+k).val();
			subjects[r] = $('#subject'+a+i+k).val();
			classid[r] = a;
			week[r] = i;
			period[r] = k;
			r++;
		}
	}	
 }
	 $.ajax({
			type: 'POST',
			url: '<?=$url?>timetable/save',
			data: 'teachers='+teachers+'&subjects='+subjects+'&classid='+classid+'&period='+period+'&week='+week,
			success: function(response){  
					if(response == 1){
						if($e == 1){
							window.location.href='<?=$url?>timetable/listview/';
						}else{
							alert('Insert Successfully');
						}	
					}else{
						alert('Insert Not Successfully');
					}
			}
	});
}	

</script>
<script src="<?php echo $url ?>js/template.js"></script>
