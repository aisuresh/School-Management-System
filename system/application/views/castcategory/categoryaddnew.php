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
echo "<div class='content_events'>";
echo "<div class='events'>";
echo "<a onclick='category_save();'>";
echo "<span><img src='".$url."images/save.png' border='0' /></span>";
echo "<span>Save</span>";
echo "</a>";
echo "</div>";
echo "<div class='events'>";
echo "<a onclick='category_apply();'>";
echo "<span><img src='".$url."images/apply.png' border='0' /></span>";
echo "<span>Apply</span>";
echo "</a>";
echo "</div>";
echo "<div class='events'>";
echo "<a href='".$url."categories/categoryview'>";
echo "<span> <img src='".$url."images/cancel.png' border='0' /></span>";
echo "<span>Cancle</span>";
echo "</a>";
echo "</div>";
echo "</div>";
echo "</div>";
/*---------------     content        ---------------------*/
echo "<div class='content'>";

echo "<table border='0' cellpadding='0' cellspacing='1' class='formtable'>";

echo "<tr>";
echo "<td align='right' width='15%'  >Category Name</td>";
echo "<td width='2%'> </td>";
echo "<td width='33%'><input type = 'text' name = 'categoryname' id = 'categoryname' /></td>";
echo "</tr>";

echo "<tr>";
echo "<td align='right' width='15%' >Description</td>";
echo "<td width='2%' class='spacetd' > </td>";
echo "<td width='33%' ><input type = 'text' name = 'categorydes' id = 'categorydes' /></td>";
echo "</tr>";


echo "</table>";

echo "</div>";
echo "</div>";
?>
<script>
function category_save(){

 var categoryname = $('#categoryname').val();
 var categorydes = $('#categorydes').val();
 $.ajax({
				type: 'POST',
				url: '<?=$url?>categories/save',
				data: 'categoryname='+categoryname+'&categorydes='+categorydes,
				success: function(response){					
						if(response == 0){
							window.location.href='<?=$url?>categories/categoryview';
						}
					}
					
		});
		
}
function category_apply(){

 var categoryname = $('#categoryname').val();
 var categorydes = $('#categorydes').val();
 $.ajax({
				type: 'POST',
				url: '<?=$url?>categories/save',
				data: 'categoryname='+categoryname+'&categorydes='+categorydes,
				success: function(response){					
						
					}
					
		});
}				
</script>
