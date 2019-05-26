<?php
//echo "<label> <h2>Subject and marks </label>";
echo "<table border='0' cellpadding='0' cellspacing='0' class='formtable'>";
echo '<tr><th colspan = "3" width="30%">Enter marks for Subject</th></tr>';
$i=1;
foreach($subjectlist as $row):
//echo $subjectlist;
//echo "<input type = 'hidden' name = 'currentAcademicYear' id='currentAcademicYear' value = '". $currentAcademicYear ."' /> </th>";

echo "<tr>";
echo "<td align='right' width='15%' class = 'datafield' ><label for='sub' name='sub' id='".$row->SubjectId."'>".$row->SubjectName."<span class = 'mandatory'>*</span></label></td>";
echo "<td width='2%' class='spacetd' > </td>";
echo "<td width='33%' class = 'dataview' ><input type = 'text' name = 'mark".$i."' id = 'mark".$i."' />";
 echo "</td>";

echo "<td width='2%' class='spacetd' > </td>";
 
echo "<td width='33%' class = 'dataview' id = 'showstatus'  >";
echo "<label id='status".$i."' name='status'  ><font color='red'> </font>	</label>";
echo "</td>";

echo "</tr>";
$i++;
endforeach;

echo "</table>";


?>
<script>
/*function myfun(mark)
{		
		/*var i=0;
		var mymark =[];
		i++;
		mymark[i]=mark;
		alert(mymark);
		for ( var i = 0; i < mymark.length; i = i + 1 ) {
			console.log( mymark[ i ] );
		}
	var j;
	var len=mark.length;
	//alert( len );
	for(j=0;j<len;j++){
	 var k = mark[j];
    }
	//var marks = k.split(",");
	//func(marks);
	
}
function func(marks)
{

	$.ajax({
			type: 'POST',
			url: 'http://localhost/school/marks/save',
			data: 'marks='+marks,
			success: function(response){
			alert(response);			
					if(response == 1){
						alert('insert successfully');
					}else{
						alert('Insert Not Successfully');
					}
				}
		});

}*/
$(document).ready(
  function() {
      //var mark = $('#'+markid).val();
	  //alert(mark);
   
      $('input[type=text]').change(
      function(){
	    	  
	    var markid = $(this).attr('name');
		var id = markid.substring(4, markid.length);
        mark = $('#'+markid).val();
		//alert(subjectid);		
		//var mymark["item"+counter] = mark;
		//alert(mark);
		//var mymark = array.mark(i).val();
		//alert(mymark);
		
		//var mymark = array.$('#'+markid).val();
		//links[index].label = $('#'+markid).val();
		if(mark >= 35){
		 $('#status'+id).text('Pass');
		 //$('#status33'+id).css("color","green");
		  $('#status'+id).css({"color":"green","font-family":"Arial","font-size":"12px"});
		}else {
		 $('#status'+id).text('Fail');
		$('#status'+id).css({"color":"red","font-family":"Arial","font-size":"12px"});
		}
	    	
      }
      );
	  
	  	  
  }
  );

</script>
