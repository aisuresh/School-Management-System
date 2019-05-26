<?php
echo "<table class='reporttable' border='0' cellpadding='0' cellspacing='1' >";
echo "<tr>";
echo "<th align='center' >#</th>";
echo "<th align='center' > <input type = 'checkbox' name = 'LibraryRecordId' id = 'LibraryRecordId' /> </th>";
echo "<th align='center' >Book Code</th>";
echo "<th align='center' >Book Name</th>";
echo "<th align='center' >Issue Date</th>";
echo "<th align='center' >Return Date</th>";
echo "</tr>";
$i = 0;

if(isset($return) && count($return) > 0){
	foreach($return as $row){
		echo "<tr>";
		echo "<td align='center'>" . ++$i . "</td>";
		echo "<td align='center'><input type = 'checkbox' name = 'LibraryRecordId' id = 'LibraryRecordId".$i."' value = '".$row->LibraryRecordId."' /></td>";
		echo "<td align='center'>" . $row->BookCode . "</td>";
		echo "<td align='center'>" . $row->BookName . "</td>";
		echo "<td align='center'>" . $row->IssuedDate . "</td>";
		echo "<td align='center'>" . $row->ReturnDate . "</td>";
		echo "</tr>";
	}
}else{
	echo "<tr>";
	echo "<td align='center' colspan ='6'>These is no data to display.</td>";
	echo "</tr>";
}
echo "</table>";

?>