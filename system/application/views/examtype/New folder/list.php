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
echo "<a href='".$url."examtype/export' >";
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
echo "<a href='".$url."examtype/addnew' >";
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

echo "<tr>";
echo "<th align='center' >#</th>";
echo "<th align='center' > <input type = 'hidden' name = 'tablename' class = 'exam' value = '0' /></th>";
echo "<th align='center' >Exam Type</th>";
echo "<th align='center' >Exam Marks</th>";
echo "<th align='center' >Description</th>";

echo "</tr>";
$i = 1;
foreach ($result as $row){

echo "<tr>";
echo "<td align='center' >" . $i++. "</td>";
echo "<td align='center' ><input type='radio' name = 'ExamId' id = 'ExamId' value ='" . $row->ExamId . "'/></td>";
echo "<td align='center'>" . $row->ExamType . "</td>";
echo "<td align='center'>" . $row->ExamMarks . "</td>";
echo "<td align='center'>" . $row->ExamDes . "</td>";
echo "</tr>";

}

echo "</table>";
echo "<div class='pagenation'>" . $links . "</div>";
echo "</div>";
echo "</div>";
?>
<script>
function edit_data(){
	var rollid = $('input:radio[name=ExamId]:checked').val();
	if(rollid == 'undefined' || rollid == null ){
		alert('Please select any one record' );
	} else {
	 window.location='<?=$url?>examtype/edit/'+rollid;
	}
}	

function view_data(){
	var rollid = $('input:radio[name=ExamId]:checked').val();
	if(rollid == 'undefined' || rollid == null ){
		alert('Please select any one record' );
	} else {
	 window.location='<?=$url?>examtype/view/'+rollid;
	}	 
	
}	
	
/* sorting jquery function */
function sort_fun(e) {
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
  		url: '/school/examtype/sort_data',
   		data: 'sortkey='+sortkey+'&order='+order,
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
</script>
