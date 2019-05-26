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
echo "<a href='".$url."book/listview'>";
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
echo "<div align='center' class='content'>";
echo "<div id ='message'></div>";
echo "<div id ='message1'></div>";
echo "<div id = 'mandatory' ><span align ='right' class = 'mandatory'>*</span> Specified fileds are mandatory</div>";
echo "<table border='0' cellpadding='0' cellspacing='0' class='formtable'>";
echo '<tr><th colspan = "3" id = "table_title">Create New Book Information</th></tr>';

echo "<tr>";
echo "<td align='right' width='15%' class = 'datafield' >Book Name<span class = 'mandatory'>*</span></td>";
echo "<td width='2%' class='spacetd' > </td>";
echo "<td width='33%' class = 'dataview' ><input type = 'text' name = 'BookName' id = 'BookName' onKeyUp='JsCheckChar(this)' /></td>";
echo "</tr>";

echo "<tr>";
echo "<td align='right' width='15%' class = 'datafield' >Book Code<span class = 'mandatory'>*</span></td>";
echo "<td width='2%' class='spacetd' > </td>";
echo "<td width='33%' class = 'dataview' ><input type = 'text' name = 'BookCode' id = 'BookCode' /> </td>";
echo "</tr>";

echo "<tr>";
echo "<td align='right' width='15%' class = 'datafield' >Book Category<span class = 'mandatory'>*</span></td>";
echo "<td width='2%' class='spacetd' > </td>";
echo "<td width='33%' class = 'dataview' >";
echo "<select name = 'BookCategoryId' id = 'BookCategoryId' >";
echo "<option value = 'x'>- - Select Book Category - -</option>";
	foreach($bookcategory as $rowa):
		echo "<option value = '".$rowa->BookCategoryId."' >";
		echo $rowa->BookCategory;
		echo "</option>";
	endforeach;
echo "</select>";
echo "</td></tr>";

echo "<tr>";
echo "<td align='right' width='15%' class = 'datafield' >Book Author</td>";
echo "<td width='2%' class='spacetd' > </td>";
echo "<td width='33%' class = 'dataview' ><input type = 'text' name = 'BookAuthor' id = 'BookAuthor' onKeyUp='JsCheckChar(this)' /></td>";
echo "</tr>";

echo "<tr>";
echo "<td align='right' width='15%' class = 'datafield' >Book Volunm</td>";
echo "<td width='2%' class='spacetd' > </td>";
echo "<td width='33%' class = 'dataview' ><input type = 'text' name = 'BookVolume' id = 'BookVolume' /></td>";
echo "</tr>";

echo "<tr>";
echo "<td align='right' width='15%' class = 'datafield' >Book Edition</td>";
echo "<td width='2%' class='spacetd' > </td>";
echo "<td width='33%' class = 'dataview' ><input type = 'text' name = 'BookEdition' id = 'BookEdition' onKeyUp='JsCheckChar(this)' /></td>";
echo "</tr>";

echo "<tr>";
echo "<td align='right' width='15%' class = 'datafield' >Description</td>";
echo "<td width='2%' class='spacetd' > </td>";
echo "<td width='33%' class = 'dataview' ><input type = 'text' name = 'BookDes' id = 'BookDes' /></td>";
echo "</tr>";

echo "</table>";

echo "</div>";
echo "</div>";
?>

<script>

function validation(){
	 var BookName = $('#BookName').val();
	 var BookCode = $('#BookCode').val();
	 var BookCategoryId = $('#BookCategoryId').val();
	 var BookAuthor =$('#BookAuthor').val();
	 var BookVolume =$('#BookVolume').val();
	 var BookEdition = $('#BookEdition').val();
	 var BookDes = $('#BookDes').val();
	 
	 if(BookName == ''){
		$('#message').html('Book Name should not be blank').show().fadeOut('slow').fadeIn('slow');
		$('#BookName').focus();
		return false;
	}else if(BookCode == ''){
		$('#message').html('Book Code should not be blank').show().fadeOut('slow').fadeIn('slow');
		$('#BookCode').focus();
		return false;
	}else if(BookCategoryId == 'x'){
		$('#message').html('Book Category should not be blank').show().fadeOut('slow').fadeIn('slow');
		$('#BookCategoryId').focus();
		return false;
	}else{
		return true;
	}
 
 
}

function save_data($e){

 var BookName = $('#BookName').val();
 var BookCode = $('#BookCode').val();
 var BookCategoryId = $('#BookCategoryId').val();
 var BookAuthor =$('#BookAuthor').val();
 var BookVolume =$('#BookVolume').val();
 var BookEdition = $('#BookEdition').val();
 var BookDes = $('#BookDes').val();
 	if(validation()){
 		$.ajax({
				type: 'POST',
				url: '<?=$url?>book/save',
				data: 'BookName='+BookName+'&BookCode='+BookCode+'&BookCategoryId='+BookCategoryId+'&BookAuthor='+BookAuthor+'&BookVolume='+BookVolume+'&BookEdition='+BookEdition+'&BookDes='+BookDes,
				success: function(response){			
						if(response == 1){
							if($e == 1){
								window.location.href='<?=$url?>book/listview';
							}else{
								alert('Insert Successfully');
							}	
						}else if(response == 2){
								alert('Record already exists!..');
							}else{
								alert('Insert Not Successfully');
						}
					}
					
		});
	}	
}		
</script>
