<?php
echo "<div class='container'>";
echo "<div class='content_header'>";
/*---------------     content title       ---------------------*/
echo "<div class='content_title'>";
echo $pagetitle.' > '. $event;
echo "</div>";
echo "<div class='content_message'>";
echo "<div class = 'search_area' title = 'search here' >";
echo "<span class='search_box'> <input type='text' name ='searchbox' id = 'searchbox' title='Select Search Option Using Arrow Button' ></span>";
echo "<span class='search_option'>"; 
echo "<ul style=' float:left;' id='nav'>";
echo "<li style = 'width:30px;' > <a href='#' class='selected'> <img src='". $url ."images/search_opt_btn.gif' /> </a>";
echo "<ul>";
echo "<li> <label> <input type='radio' name='searchfield' id ='searchfield' value='BookCategoryId' /> Book category </label> </li>";
echo "</ul>";
echo "</li>";
echo "</ul>";
echo "</span>";
echo "<span class='search_btn'> <a onClick='search_fun(this);' id = 'category' > <img src='".$url ."images/search_btn.gif' /> </a> </span>";	
echo "</div>";


echo "</div>";
/*---------------     content events       ---------------------*/
echo "<div class='content_events'>";

echo "<div class='events'>";
echo "<a href='".$url."category/export' >";
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
echo "<a href='".$url."category/addnew' >";
echo "<span><img src='".$url."images/addnew.png' border='0' /></span>";
echo "<span>  Addnew  </span>";
echo "</a>";
echo "</div>";

/*echo "<div class='events'>";
echo "<a href='".$url."student/addnew' >";
echo "<span><img src='".$url."images/addnew.png' border='0' /></span>";
echo "<span>  Addnew  </span>";
echo "</a>";
echo "</div>";*/

echo "</div>";
echo "</div>";
/*---------------     content        ---------------------*/
echo "<div align='center' class='content'>";

echo "<table class='reporttable' border='0' cellpadding='0' cellspacing='1' >";
echo '<tr><th colspan = "5" id = "table_title">Book Category List View </th></tr>';

echo "<tr>";
echo "<th align='center' >S.No</th>";
echo "<th align='center' > <input type = 'hidden' name = 'tablename' class='category' id ='ordertype'  value = '0' /></th>";
echo "<th align='center' >Book Category<a class = 'BookCategory' onClick='sort_fun(this);'>
											<img id='updown_arrow' class = 'BookCategory' src=''.$url.'images/up_down_arrow.gif' />
											<img id='desc' class='BookCategory'  src='".$url."images/order_down.gif' /> 
											<img id='asc' class='BookCategory' src='".$url."images/ORDER_UP.GIF' /></th>";
echo "<th align='center' >Description</th>";

echo "</tr>";
//var_dump($result);
$i=1;
if($result == false){
	echo '<tr><span style="font-weight:bold; font-size:16px; color:#EA0000;"> No data to display</span></tr>';

}else{
foreach ($result as $row){

echo "<tr>";
echo "<td align='center' >" . $i++. "</td>";
echo "<td align='center' ><input type='radio' name = 'BookCategoryId' id = 'BookCategoryId' value ='" . $row->BookCategoryId . "'/></td>";
echo "<td align='center'>" . $row->BookCategory . "</td>";
echo "<td align='center'>" . $row->BookCategoryDes . "</td>";

echo "</tr>";

}
}
echo "</table>";
echo "<div class='pagenation'>" . $links . "</div>";
echo "</div>";
echo "</div>";
?>
<script>
function edit_data(){
	var rollid = $('input:radio[name=BookCategoryId]:checked').val();
	if(rollid == 'undefined' || rollid == null ){
		message('Please select any one record' );
	} else {
	 window.location='<?=$url?>category/edit/'+rollid;
	}
	
}	

function view_data(){
	var rollid = $('input:radio[name=BookCategoryId]:checked').val();
	if(rollid == 'undefined' || rollid == null ){
		message('Please select any one record' );
	} else {
	 window.location='<?=$url?>category/view/'+rollid;
	}
	 
}	

 /* sorting jquery function */
/*function sort_fun(e) {
	 var tablename = $("th input[name = 'tablename']").attr('class');
	 var orderval = $('.'+tablename).val();
	 var sortkey  = $(e).attr('class');
	 $('.' + sortkey + ' img#updown_arrow').hide();
	 $('.' + sortkey + ' img#desc').hide();
	 if( orderval == '0')
	 {
		 order = 'asc';
	 }else if(orderval == '1')
	 {
	 	order = 'desc';
	 }
   	 $.ajax({
   	 	type: 'POST',
  		url: '/school/category/sort_data',
   		data: 'sortkey='+sortkey+'&orderval='+orderval,
   		success: function(response){
			if(response != ''){
		 
				$('.container').html(response);
				if( order == 'asc')
				{
					$('.' + tablename).val(orderval.replace('0', '1'));
					$('.' + sortkey + ' img#asc').show();
					$('.' + sortkey + ' img#desc').hide();
					$('.' + sortkey + ' img#updown_arrow').hide();
				}else if(order == 'desc')
				{
					$('.' + tablename).val(orderval.replace('1', '0'));
					$('.' + sortkey + ' img#desc').show();
					$('.' + sortkey + ' img#asc').hide();
					$('.' + sortkey + ' img#updown_arrow').hide();	
				}
		 
			}
   		} 
    });
 }
 */
</script>
