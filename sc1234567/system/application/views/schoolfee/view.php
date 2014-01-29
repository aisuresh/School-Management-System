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
echo "<a href='".$url."schoolfee/listview/".$this->session->userdata('yearsf')."' >";
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
foreach($result as $row):
echo "<input type='hidden' name = 'SchoolFeeId' id = 'SchoolFeeId' value = '".$row->SchoolFeeId."'";
echo "<tr>";
echo "<td align='right' width='15%' class = 'datafield' >Student Roll No</td>";
echo "<td width='2%' class='spacetd' > </td>";
echo "<td width='33%' class = 'dataview' >".$row->RollNo."</td>
</tr>";

echo "<tr>";
echo "<td align='right' width='15%' class = 'datafield' >School Fees</td>";
echo "<td width='2%' class='spacetd' > </td>";
echo "<td width='33%' class = 'dataview' >".$row->Fees ."</td>";
echo "</tr>";

echo "<tr>";
echo "<td align='right' width='15%' class = 'datafield' >Recept No</td>";
echo "<td width='2%' class='spacetd' > </td>";
echo "<td width='33%' class = 'dataview' >".$row->ReceiptNo."</td>";
echo "</tr>";

echo "<tr>";
echo "<td align='right' width='15%' class = 'datafield' >Term No</td>";
echo "<td width='2%' class='spacetd' > </td>";
echo "<td width='33%' class = 'dataview' >".$row->TermNo."</td>";
echo "</tr>";

echo "<tr>";
echo "<td align='right' width='15%' class = 'datafield' >Paid Date</td>";
echo "<td width='2%' class='spacetd' > </td>";
$PaidDate=date("d-m-Y", strtotime($row->PaidDate));
echo "<td width='33%' class = 'dataview' >".$PaidDate."</td>";
echo "</tr>";

echo "<tr>";
echo "<td align='right' width='15%' class = 'datafield' >Description</td>";
echo "<td width='2%' class='spacetd' > </td>";
echo "<td width='33%' class = 'dataview' >".$row->SchoolFeeDes."</td>";
echo "</tr>";

endforeach;
echo '</table>';
echo "</div>";
echo "</div>";
?>
<script>
function edit_data(){
var rollid = $('input[name=SchoolFeeId]').val();
 window.location='<?=$url?>schoolfee/edit/'+rollid;
}		
</script>
