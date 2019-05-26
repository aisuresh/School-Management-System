<?php

echo "<div class='container'>";
echo "<div class='content_header'>";
/*---------------     content title       ---------------------*/
echo "<div class='content_title'>";
echo $pagetitle.' > '. $event;
echo "</div>";
echo "<div class='content_message'>";
echo "";
echo "</div>";
/*---------------     content events       ---------------------*/
echo "<div class='content_events'>";


echo "</div>";
echo "</div>";
/*---------------     content        ---------------------*/
echo "<div align = 'center' class='content'>";
echo "<table border='0' cellpadding='0' cellspacing='0' class='formtable'>";
echo "<tr>";
echo "<td align='right' width='15%' class = 'datafield' >Upload Student Info List <span class = 'mandatory'>*</span></td>";
echo "<td width='2%' class='spacetd' > </td>";
echo "<td width='33%' class = 'dataview' >";
echo "<input type='button' id='uploadStudent' class='browse_media' value='Upload Student List' style = 'float:left; width:150px;' /> <div style = 'width:75%; height: 18px; margin-left:5px; float:left; display:none' id = 'uploadStudent_filename'></div> <input type = 'hidden' name = 'uploadStudent_xls' id = 'uploadStudent_xls' /><span id = 'uploadStudent_error' style = 'float:left' ></span>";
echo "</td></tr>";

echo "<tr>";
echo "<td align='right' width='15%' class = 'datafield' >Upload Student Class List <span class = 'mandatory'>*</span></td>";
echo "<td width='2%' class='spacetd' > </td>";
echo "<td width='33%' class = 'dataview' >";
echo "<input type='button' id='uploadClass' class='browse_media' value='Upload Student Class' style = 'float:left;width:150px;' /> <div style = 'width:75%; height: 18px; margin-left:5px; float:left; display:none' id = 'uploadClass_filename'></div> <input type = 'hidden' name = 'uploadClass_xls' id = 'uploadClass_xls' /><span id = 'uploadClass_error' style = 'float:left' ></span>";
echo "</td></tr>";

echo "<tr>";
echo "<td align='right' width='15%' class = 'datafield' >Upload Student Fees List <span class = 'mandatory'>*</span></td>";
echo "<td width='2%' class='spacetd' > </td>";
echo "<td width='33%' class = 'dataview' >";
echo "<input type='button' id='uploadFees' class='browse_media' value='Upload Student Fees' style = 'float:left;width:150px;' /> <div style = 'width:75%; height: 18px; margin-left:5px; float:left; display:none' id = 'uploadFees_filename'></div> <input type = 'hidden' name = 'uploadFees_xls' id = 'uploadFees_xls' /><span id = 'uploadFees_error' style = 'float:left' ></span>";
echo "</td></tr>";
echo "</table>";


echo "</div>";
echo "</div>";
echo '<script src = "'.$url.'themes/js/uploadscript/ajaxupload.3.5.js" ></script>';
?>
<script>
function edit_data(){
var rollid = $('input[name=StudentId]').val();
 window.location='<?=$url?>student/edit/'+rollid;
}

$('.browse_media').click(function(){
   var id = $(this).attr('id');
   var btnUpload = $('#'+id);
   var adinfoid=$('#adinfoid').val();
   var xlspath = $('#'+id+'_xls').val();
   var url = '';
   if(id == 'uploadStudent'){
   		url = '<?=$url?>student/uploadstudentinfo';
   }else if(id == 'uploadClass'){
   		url = '<?=$url?>student/uploadstudentclass';
   }else if(id == 'uploadFees'){
   		url = '<?=$url?>student/uploadstudentfees';
   }
   new AjaxUpload(btnUpload, {
     action: url,
     name: 'uploadfile',
     onSubmit: function(file, ext){
       if (! (ext && /^(xls)$/.test(ext))){
         $("#"+id+'_error').html('Only XLS is allowed');
         $("#"+id+'_error').css('display','block');
         return false;
       }
     },
     onComplete: function(file, response){
	 	$('#'+id+'_filename').html('');
	   if(response == 'error'){
			$('#'+id+'_filename').css('display', 'block').html('<span style = "color:#f73a07; font-size:12px; font-weight:600">Error occured. Please check and try again.</span>');
			$('#'+id+'_xls').val(xlspath.replace(xlspath, ''));	
       }else if(response == 'invalid'){
			$('#'+id+'_filename').css('display', 'block').html('<span style = "color:#f73a07; font-size:12px; font-weight:600">Invalid file format.</span>');
			$('#'+id+'_xls').val(xlspath.replace(xlspath, ''));	
	   }else if(response.indexOf('validation error') != -1){
	       $('#'+id+'_filename').css('display', 'block').html('<span style = "color:#f73a07; font-size:12px; font-weight:600">File contains incorrect data at record: '+response.substring(17, response.length)+'</span>');
		   	$('#'+id+'_xls').val(xlspath.replace(xlspath, ''));
       }else if(response == 'no rows'){
			$('#'+id+'_filename').css('display', 'block').html('<span style = "color:#f73a07; font-size:12px; font-weight:600">No records to process.</span>');
			$('#'+id+'_xls').val(xlspath.replace(xlspath, ''));	
	   }else{ 
	   		$('#'+id+'_filename').css('display', 'block').html('<span style = "color:#4bb30d; font-size:10px; font-weight:600">'+response+' uploaded successfully.</span>');
			$('#'+id+'_xls').val(xlspath.replace(xlspath, response));
	   }
     }
   });
 });
</script>
