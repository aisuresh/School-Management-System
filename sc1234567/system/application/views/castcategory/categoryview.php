<?php
echo "<div class='container'>";
echo "<div class='content_header'>";
/*---------------     content title       ---------------------*/
echo "<div class='content_title'>";
echo "Category";
echo "</div>";
echo "<div class='content_message'>";

echo "</div>";
/*---------------     content events       ---------------------*/
echo "<div class='events'>";
echo "<a href='".$url."categories/categoryaddnew' >";
echo "<span><img src='".$url."images/addnew.png' border='0' /></span>";
echo "<span>  Addnew  </span>";
echo "</a>";
echo "</div>";
echo "<div class='content_events'>";
echo "<div class='events'>";
echo "<a onclick='category_edit();' >";
echo "<span><img src='".$url."images/edit.png' border='0' /></span>";
echo "<span>  Edit  </span>";
echo "</a>";
echo "</div>";
echo "</div>";
echo "</div>";
/*---------------     content        ---------------------*/
echo "<div class='content'>";

echo "<table class='reporttable' width='60%' border='0' cellpadding='0' cellspacing='1' >";

echo "<tr>";
echo "<th align='center' width='3%'  >#</th>";
echo "<th align='center' width='3%'  > </th>";
echo "<th align='center' width='28%' >Category Name</th>";
echo "<th align='center' width='25%' >Description</th>";
echo "</tr>";

foreach ($query as $row){

echo "<tr>";
echo "<td align='center' >" . $row->category_id . "</td>";
echo "<td align='center' ><input type='radio' name = 'categoryid' id = 'categoryid' value ='" . $row->category_id . "'/></td>";
echo "<td align='center'>" . $row->category_name . "</td>";
echo "<td align='center'>" . $row->description . "</td>";
echo "</tr>";

}

echo "</table>";

echo "</div>";
echo "</div>";
?>
<script>
function category_edit(){
var categoryid = $('input:radio[name=categoryid]:checked').val();
 window.location='<?=$url?>categories/categoryedit/'+categoryid;
}		
</script>
