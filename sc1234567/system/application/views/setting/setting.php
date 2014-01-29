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
echo "<a href='".$url."setting/settingview' >";
echo "<span><img src='".$url."images/cancel.png' border='0' /></span>";
echo "<span> Cancel </span>";
echo "</a>";
echo "</div>";

echo "<div class='events'>";
echo "<a onclick='edit_data();' >";
echo "<span><img src='".$url."images/ok.png' border='0' /></span>";
echo "<span> Edit </span>";
echo "</a>";
echo "</div>";

echo "</div>";
echo "</div>";
/*---------------     content        ---------------------*/
echo "<div align = 'center' class='content'>";
echo "<table border='0' cellpadding='0' cellspacing = '0' class='formtable'>";
foreach(array_reverse($result) as $row):
echo "<input type='hidden' name = 'SettingTypeId' id = 'SettingTypeId' value = '".$row->SettingTypeId."'";

echo "<tr>";
echo "<td align='right' width='15%' class = 'datafield' >SettingType</td>";
echo "<td width='2%' class='spacetd' > </td>";
echo "<td width='33%' class = 'dataview' >".$row->SettingType ."</td>";
echo "</tr>";

echo "<tr>";
echo "<td align='right' width='15%' class = 'datafield' >flag</td>";
echo "<td width='2%' class='spacetd' > </td>";
echo "<td width='33%' class = 'dataview' >";
if($row->flag == 'true')
echo "<label> <input type = 'checkbox' name = 'flag' id = 'flag' value = 'true' checked='checked' />  </label>";
else
echo "<label> <input type = 'checkbox' name = 'flag' id = 'flag' value = 'false'  />  </label>";
	
echo "</td></tr>";

/*echo "<tr>";
echo "<td align='right' width='15%' class = 'datafield' >Gender</td>";
echo "<td width='2%' class='spacetd' > </td>";
echo "<td width='33%' class = 'dataview' >";
if($row->Gender == 'm'){
echo 'Male';
}else if($row->Gender == 'f')
{
echo 'Female';
}
else 
echo "";
echo"</td></tr>";*/

endforeach;
echo '</table>';
echo "</div>";
echo "</div>";
?>
<script>
function edit_data(){
//var rollid = $('input[name=StaffId]').val();
 window.location='<?=$url?>staff/edit';
}		
</script>
