<?php
/*---------------     content        ---------------------*/
//var_dump($sectiontotalfeeslist);
$i = 1;
echo "<table class='reporttable' border='0' cellpadding='0' cellspacing='1' >";

echo "<tr>";
echo "<th align='center' >#</th>";
echo "<th align='center' >Expenditure Purpose</th>";
echo "<th align='center' >Received By</th>";
echo "<th align='center' >Bill No</th>";
echo "<th align='center' >BillAmount</th>" ;
echo "<th align='center' >Spent By</th>";
echo "<th align='center' >Bill Date</th>";
echo "</tr>";
if(count($expenditure) > 0){
	foreach($expenditure as $exp){
		echo "<tr>";
		echo "<td align='center' >".$i++."</th>";
		echo "<td align='center' >";
		foreach ($expendituretype as $rowb){
	if($exp->ExpenditureTypeId == $rowb->ExpenditureTypeId){
		 echo $rowb->ExpenditureType;
	}
	
} 
        echo "</td>";
		echo "<td align='center' >".$exp->ReceivedBy."</td>";
		echo "<td align='center' >".$exp->BillNo."</td>";
		echo "<td align='center' >".$exp->BillAmount."</td>" ;
		echo "<td align='center' >".$exp->SpentBy."</td>";
		echo "<td align='center' >".$exp->BillDate."</td>";
		echo "</tr>";
	}
}else{
	echo "<tr>";
	echo "<td align='center' colspan = '7' style = 'color:red; font-weight:bold;' >These is no data to display.</th>";
	echo "</tr>";
}	
echo "</table>";
?>
