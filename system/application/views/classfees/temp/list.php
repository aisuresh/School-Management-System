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
echo "<a href='".$url."classfees/export' >";
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
echo "<a href='".$url."classfees/addnew' >";
echo "<span><img src='".$url."images/addnew.png' border='0' /></span>";
echo "<span>  Addnew  </span>";
echo "</a>";
echo "</div>";


echo "</div>";
echo "</div>";
/*---------------     content        ---------------------*/
echo "<div align='center' class='content'>";

echo "<table class='reporttable' border='0' cellpadding='0' cellspacing='1' >";

echo "<tr>";
echo "<th align='center' >#</th>";
echo "<th align='center' > <input type = 'hidden' name = 'tablename' class='libraryreg' id ='ordertype'  value = '0' /> </th>";
echo "<th align='center' >Class<a class = 'LibraryNo' onClick='sort_fun(this);' >";
echo "<th align='center' >Fees<a class = 'RollNo' onClick='sort_fun(this);' >
</tr>";
$i = 1;
if($result == false){
	echo '<tr><span style="font-weight:bold; font-size:16px; color:#EA0000;"> No data to display</span></tr>';
}else{
foreach (array_reverse($result) as $row){

echo "<tr>";
echo "<td align='center' >" . $i++. "</td>";
echo "<td align='center' ><input type='radio' name = 'ClassFeeId' id = 'ClassFeeId' value ='" . $row->ClassFeeId. "'/></td>";
echo "<td align='center'>" . $row->ClassName . "</td>";
echo "<td align='center'>" . $row->ClassFees . "</td>";

echo "</tr>";

}
}//else part ends here
echo "</table>";
echo "<div class='pagenation'>" . $links . "</div>";
echo "</div>";
echo "</div>";
?>
<script>
function edit_data(){
	var rollid = $('input:radio[name=ClassFeeId]:checked').val();
	if(rollid == 'undefined' || rollid == null ){
		alert('Please select any one record' );
	} else {
	 window.location='<?=$url?>classfees/edit/'+rollid;
	}
}	

function view_data(){
	var rollid = $('input:radio[name=ClassFeeId]:checked').val();
	if(rollid == 'undefined' || rollid == null ){
		alert('Please select any one record' );
	} else {
	 window.location='<?=$url?>classfees/view/'+rollid;
	}	 
	 
}	
	
</script>
<script src="<?php echo $url ?>js/template.js"></script>
