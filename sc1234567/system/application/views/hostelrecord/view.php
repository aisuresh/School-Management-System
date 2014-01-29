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
echo "<a href='".$url."hostelrecord/listview/".$this->session->userdata('yearhr')."' >";
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
echo "<div align = 'center' class='content'>";
echo "<table border='0' cellpadding='0' cellspacing = '0' class='formtable'>";
//var_dump($result);
foreach($result as $row):
echo "<input type='hidden' name = 'HostelRecordId' id = 'HostelRecordId' value = '".$row->HostelRecordId."'";
echo "<tr>";
echo "<td align='right' width='15%' class = 'datafield' >Student Roll No</td>";
echo "<td width='2%' class='spacetd' > </td>";
echo "<td width='33%' class = 'dataview' >";
echo $row->StudentRollNo;
echo "</td></tr>";

echo "<tr>";
echo "<td align='right' width='15%' class = 'datafield' >Hostel Term No</td>";
echo "<td width='2%' class='spacetd' > </td>";
echo "<td width='33%' class = 'dataview' >";
echo $row->HostelTermNo;
echo "</td></tr>";

echo "<tr>";
echo "<td align='right' width='15%' class = 'datafield' >Hostel Term Fees</td>";
echo "<td width='2%' class='spacetd' > </td>";
echo "<td width='33%' class = 'dataview' >".$row->HostelTermFee ."</td>";
echo "</tr>";

echo "<tr>";
echo "<td align='right' width='15%' class = 'datafield' >Paid Date</td>";
echo "<td width='2%' class='spacetd' > </td>";
$TermPaidDate=date("d-m-Y", strtotime($row->TermPaidDate));
echo "<td width='33%' class = 'dataview' >".$TermPaidDate."</td>";
echo "</tr>";

echo "<tr>";
echo "<td align='right' width='15%' class = 'datafield' >Paid By</td>";
echo "<td width='2%' class='spacetd' > </td>";
echo "<td width='33%' class = 'dataview' >".$row->PaidBy."</td>";
echo "</tr>";

echo "<tr>";
echo "<td align='right' width='15%' class = 'datafield' >Description</td>";
echo "<td width='2%' class='spacetd' > </td>";
echo "<td width='33%' class = 'dataview' >".$row->HostelTermDes."</td>";
echo "</tr>";

endforeach;
echo '</table>';
echo "</div>";
echo "</div>";
?>
<script>
function edit_data(){
var rollid = $('input[name=HostelRecordId]').val();
 window.location='<?=$url?>hostelrecord/edit/'+rollid;
}		
</script>
