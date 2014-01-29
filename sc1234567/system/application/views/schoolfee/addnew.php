
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
echo "<a href='".$url."schoolfee/listview/".$this->session->userdata('yearsf')."'>";
echo "<span> <img src='".$url."images/cancel.png' border='0' /></span>";
echo "<span>Cancel</span>";
echo "</a>";
echo "</div>";

echo "<div class='events'>";
echo "<a onclick='save_data(1);'>";
echo "<span><img src='".$url."images/apply.png' border='0' /></span>";
echo "<span>Apply</span>";
echo "</a>";
echo "</div>";

echo "<div class='events'>";
echo "<a onclick='print_receipt_fun();'>";
echo "<span><img src='".$url."images/save.png' border='0' /></span>";
echo "<span>Save</span>";
echo "</a>";
echo "</div>";

echo "<div class='events'>";
echo "<a  href = '#' id = 'addfees'  >";
echo "<span><img src='".$url."images/addnew.png' border='0' /></span>";
echo "<span>  AddFees  </span>";
echo "</a>";
echo "</div>";

echo "</div>";
echo "</div>";

/*---------------     content        ---------------------*/
echo "<div align='center' class='content'>";
echo "<div id ='message'></div>";
echo "<div id ='message1'></div>";
echo "<div style = 'margin-bottom:10px; padding-left:10px;' >";
echo '<table><tr><th colspan = "3" id = "table_title">Create New School Fees Information</th></tr></table>';
echo "<select name = 'ClassId' id = 'ClassId' onChange = 'section_fun();'  >";
echo "<option value = 'x'>- - Select Class - -</option>";
foreach($course as $row):
echo "<option value = '".$row->ClassId."' >";
echo $row->ClassName;
echo "</option>";

endforeach;
echo "</select>";

echo "<select name = 'SectionId' id = 'SectionId' onchange = 'studentlist_fun();' style = 'margin-left:10px;' >";
echo "<option value = 'x'>- - Select Section - -</option>";
echo "</select>";

echo "<select name = 'StudentId' id = 'StudentId' onclick = 'getstudentinfo_fun();' style = 'margin-left:10px;' >";
echo "<option value = 'x'>- - Select RollNo - -</option>";
echo "</select>";
echo "</div>";

echo "<div style = 'width:500px; margin:0 auto;' id = 'print_tbl' >";
echo'<table height="258" border="0" cellpadding="0" cellspacing="0" class="formtable"  style = "width:100%;">
  <tr>
    <td colspan="3" valign="top">
   	  <table width="100%" border="0" cellpadding="0" cellspacing="0" >
      	  <tr style  = "background-color:#bbcff9" id = "schooname" >
          	<td colspan="4" align="center">
            	<span style="font-size:18px; font-weight:bold;">Jnana Bharathi height School</span><br />
                <span style="font-size:14px;" >(Recognized by Govt. of AP)</span><br /><br />
                <span style="font-size:15px; font-weight:bold;" > School Fees Receipt</span> <br />
            </td>
          </tr>	
      </table>
        

    </td>
  </tr>
  <tr style = "background-color:#c4d6fe; font-size:13px; font-weight:bold; clear:both; " >
    <td width="350" height="30" align="center" colspan="2"  >Particulars</td>
    <td width="100" align="center" >Amount</td>
  </tr> 
  <tr id = "drandtotal" >
    <td width="345" align="right" style  = "padding-left:10px; height:25px; font-weight:600" class = "datafield" >Grand Total Amount</td>
     <td width="5" class="spacetd">:</td>
    <td width="100" align="right" style = "padding-right:10px; font-size:13px; font-weight:600" class = "datafield" id = "totalfees" >0.00</td>
  </tr>
  <tr>
    <td align="right" colspan="3" height="80">
    	<div style="float:left; margin:90px 0 10px 20px;" >School Seal </div>
		<div style="float:right; margin-top: 90px; margin-right:20px " >Authorized Signature</div>
    </td>
  </tr>

</table>';

echo "<table border='0' cellpadding='0' cellspacing='0' id = 'showaddfees' class='formtable' title = 'Add School Fees Particular' >";

/*echo "<tr>";
echo "<td align='right' width='15%' class = 'datafield' >Class <span class = 'mandatory'>*</span></td>";
echo "<td width='2%' class='spacetd' > </td>";
echo "<td width='33%' class = 'dataview' >";
echo "<select name = 'ClassId' id = 'ClassId' onChange = 'section_fun();' >";
echo "<option value = 'x'>- - Select Class - -</option>";
foreach($course as $row):
echo "<option value = '".$row->ClassId."' >";
echo $row->ClassName;
echo "</option>";
endforeach;
echo "</select>";
echo "</td></tr>";

echo "<tr>";
echo "<td align='right' width='15%' class = 'datafield' >Section<span class = 'mandatory'>*</span></td>";
echo "<td width='2%' class='spacetd' > </td>";
echo "<td width='33%' class = 'dataview' >";
echo "<select name = 'SectionId' id = 'SectionId' onchange = 'studentlist_fun();' >";
echo "<option value = 'x'>- - Select Section - -</option>";
echo "</select>";
echo "</td></tr>";*/


echo "<tr>";
echo "<td align='right' width='15%' class = 'datafield' >Student <span class = 'mandatory'>*</span></td>";
echo "<td width='2%' class='spacetd' > </td>";
echo "<td width='33%' class = 'dataview' >";
echo "<select name = 'FeesType' id = 'FeesType' onclick = 'tremno_fun();'>";
echo "<option value = 'x'>- - Select Fees Particulars - -</option>";
echo "<option value = 'Admission Fees'> Admission Fees</option>";
echo "<option value = 'School Term Fees'> Term Fees</option>";
echo "<option value = 'School Bus Fees'> Bus Fees</option>";
echo "</select>";
echo "</td></tr>";

echo "<tr>";
echo "<td align='right' width='15%' class = 'datafield' >Paying Fees<span class = 'mandatory'>*</span></td>";
echo "<td width='2%' class='spacetd' > </td>";
echo "<td width='33%' class = 'dataview' ><input type = 'text' name = 'Fees' id = 'Fees' onKeyUp='JsCheckNumber(this)' /></td>";
echo "</tr>";

echo "<tr>";
echo "<td align='right' width='15%' class = 'datafield' >Description</td>";
echo "<td width='2%' class='spacetd' > </td>";
echo "<td width='33%' class = 'dataview' ><input type = 'text' name = 'SchoolFeeDes' id = 'SchoolFeeDes' /></td>";
echo "</tr>";
echo "</table>";

echo "</div>";
echo "</div>";
echo "</div>";
?>

<script>

function validation(){
	 var StudentId = $('#StudentId').val();
	 var Fees = $('#Fees').val();
	 var ReceptNo = $('#ReceptNo').val();
	 var TermNo =$('#TermNo').val();
	 var PaidDate = $('#PaidDate').val();
	 var SchoolFeeDes = $('#SchoolFeeDes').val();
	 
	 if(StudentId == 'x'){
		$('#message').html('Roll No should not be blank').show().fadeOut('slow').fadeIn('slow');
		$('#StudentId').focus();
		return false;
	}else if(Fees == ''){
		$('#message').html('Fees should not be blank').show().fadeOut('slow').fadeIn('slow');
		$('#Fees').focus();
		return false;
	}else if(ReceptNo == ''){
		$('#message').html('Recept No should not be blank').show().fadeOut('slow').fadeIn('slow');
		$('#ReceptNo').focus();
		return false;
	}else if(TermNo == ''){
		$('#message').html('Term No should not be blank').show().fadeOut('slow').fadeIn('slow');
		$('#TermNo').focus();
		return false;
	}else if(PaidDate == ''){
		$('#message').html('Paid Date should not be blank').show().fadeOut('slow').fadeIn('slow');
		$('#PaidDate').focus();
		return false;
	}else{
		return true;
	}
}

function save_data($e){

	 var StudentId = $('#StudentId').val();
	 var Fees = $('#Fees').val();
	 var ReceptNo = $('#ReceptNo').val();
	 var TermNo =$('#TermNo').val();
	 var PaidDate = $('#PaidDate').val();
	 var SchoolFeeDes = $('#SchoolFeeDes').val();
	 
 	if(validation()){
 		$.ajax({
				type: 'POST',
				url: '<?=$url?>schoolfee/save',
				data: 'StudentId='+StudentId+'&Fees='+Fees+'&ReceptNo='+ReceptNo+'&TermNo='+TermNo+'&PaidDate='+PaidDate+'&SchoolFeeDes='+SchoolFeeDes,
				success: function(response){
						//alert(response);
						if(response == 1){
							if($e == 1){
								window.location.href='<?=$url?>schoolfee/listview/<?=$this->session->userdata('yearsf')?>';
								//newwindow=window.open(url,'name','height=200,width=150');
							}else{
								alert('Insert Successfully');
							}	
						}else{
							alert('Insert Not Successfully');
						}
					}
		});
	}	
}		

function section_fun(){
	var ClassId = $('#ClassId').val();
 		$.ajax({
				type: 'POST',
				url: '<?=$url?>schoolfee/section',
				data: 'ClassId='+ClassId,
				success: function(response){
						if(response != ''){
							$('#SectionId').html(response);
						}
					}	
		});
}

function studentlist_fun(){
	var ClassId = $('#ClassId').val();
	var SectionId = $('#SectionId').val();
 		$.ajax({
				type: 'POST',
				url: '<?=$url?>schoolfee/studentlist',
				data: 'ClassId='+ClassId+'&SectionId='+SectionId,
				success: function(response){
						if(response != ''){
							$('#StudentId').html(response);
						}
					}	
		});
}						
function tremno_fun(){
	var StudentId = $('#StudentId').val();
	if(StudentId != 'x'){
 		$.ajax({
				type: 'POST',
				url: '<?=$url?>schoolfee/termno',
				data: 'StudentId='+StudentId,
				success: function(response){
						if(response != '0' || response != 0){
							$('#TermNo').val(parseInt(response)+1);
						}else{
							$('#TermNo').val(1);
						}
					}	
		});
	}	
}	


//$(function() {
		
$("#showaddfees").dialog({
			bgiframe: true,
			autoOpen: false,
			width: 350,
			height: 300,
			modal: true,
			buttons: {
				'Add Fees Particulars': function() {
					var bValid = true;
					//allFields.removeClass('ui-state-error');
						 var FeesType = $('#FeesType').val();
						 var Fees = $('#Fees').val();
					
						$('tr#drandtotal:first').before('<tr>' +
							'<td align="left" style  = "padding-left:10px; height:25px; font-weight:600" class = "datafield" >'+FeesType+'</td>'+
     						 '<td class="spacetd" >:</td>'+
    						 '<td align="right" style = "padding-right:10px; font-size:13px; font-weight:600" class = "dataview" >'+Fees+'.00</td>'+
							'</tr>');
						var tfees = $('#totalfees').text();
						var gfees = parseInt(tfees) + parseInt(Fees);
						gfees = gfees+'.00';
						$('#totalfees').text('');
						$('#totalfees').text(gfees);
						//$(this).dialog('close');
				},
				Cancel: function() {
					$(this).dialog('close');
				}
			},
			close: function() {
				//allFields.val('').removeClass('ui-state-error');
			}
		});
		
		
		
		$('#addfees').click(function() {
			$('#showaddfees').dialog('open');
		});
	//});	
$(function() {
	$("#PaidDate").datepicker();
});

function getstudentinfo_fun(){
	var StudentId = $('#StudentId').val();
	if(StudentId != 'x'){
		$.ajax({
			type: 'POST',
			url: '<?=$url?>schoolfee/getstudentinfo',
			data: 'StudentId='+StudentId,
			success: function(response){
				if(response != ''){
					$('#schooname:last').after(response);
				}
			}	
		});
	}	
}		

function print_receipt_fun(){
	w=window.open();
	w.document.write($('#print_tbl').html());
	w.print();
	w.close();
}
</script>
