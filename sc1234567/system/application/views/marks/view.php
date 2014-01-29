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
echo "<a href='".$url."marks/listview/".$this->session->userdata('yearmx')."' >";
echo "<span><img src='".$url."images/cancel.png' border='0' /></span>";
echo "<span> Cancel </span>";
echo "</a>";
echo "</div>";

echo "<div class='events'>";
echo "<a onclick='edit_data();' >";
echo "<span><img src='".$url."images/edit.png' border='0' /></span>";
echo "<span> Edit </span>";
echo "</a>";
echo "</div>";

echo "</div>";
echo "</div>";
/*---------------     content        ---------------------*/
echo "<div align='center' class='content'>";
echo "<table border='0' cellpadding='0' cellspacing = '0' class='formtable'>";
//var_dump($result);
foreach($result as $row):
echo "<input type='hidden' name = 'MarksId' id = 'MarksId' value = '".$row->MarksId."'";
echo "<tr>";
echo "<td align='right' width='15%' class = 'datafield' >Student Name</td>";
echo "<td width='2%' class='spacetd' > </td>";
echo "<td width='15%' class = 'dataview' >".$row->StudentName ."</td></tr>";

echo "<tr>";
echo "<td align='right' width='15%' class = 'datafield' >ExamType</td>";
echo "<td width='2%' class='spacetd' > </td>";
echo "<td width='15%' class = 'dataview' >".$row->ExamType."</td></tr>";

echo "<tr>";
echo "<td align='right' width='15%' class = 'datafield' >Subjects</td>";
echo "<td width='2%' class='spacetd' > </td>";
echo "<td width='15%' class = 'dataview' >Marks</td></tr>";

$markarray = explode(',', $row->Marks);	
$subarray = explode(',', $row->SubjectId);	
$i=0;
/*foreach($subject as $rowa):

	$sujectarray[$i]=$rowa->SubjectName;
	$i++;
endforeach;*/
$combinearray=array_combine($subarray,$markarray);
foreach($combinearray as $com=>$value):
echo "<tr>";
echo "<td align='right' width='15%' class = 'datafield' >";
foreach($subject as $sub):
if($sub->SubjectId==$com){
echo $sub->SubjectName;
}
endforeach;
echo "</td>";

echo "<td width='2%' class='spacetd' > </td>";
echo "<td width='15%' class = 'dataview' >" .$value."</td>";
echo "</tr>";
endforeach;
endforeach;
echo "</table>";
echo "</div>";
echo "</div>";
?>
<script>
function edit_data(){
var rollid = $('input[name=MarksId]').val();
 window.location='<?=$url?>marks/edit/'+rollid;
}		
</script>
