
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
echo "<a onclick='save_data();'>";
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
echo '<tr><th colspan = "3" id = "table_title">Create New Institute </th></tr>';
echo "<tr>";
echo "<td align='right' width='15%' class = 'datafield' >Institute Name<span class = 'mandatory'>*</span></td>";
echo "<td width='2%' class='spacetd' > </td>";
echo "<td width='33%' class = 'dataview' ><input type = 'text' name = 'InstituteName' id = 'InstituteName' onKeyUp='JsCheckChar(this)' /></td>";
echo "</td></tr>";

echo "<tr>";
echo "<td align='right' width='15%' class = 'datafield' >Institute Owner<span class = 'mandatory'>*</span></td>";
echo "<td width='2%' class='spacetd' > </td>";
echo "<td width='33%' class = 'dataview' ><input type = 'text' name = 'InstituteOwner' id = 'InstituteOwner' onKeyUp='JsCheckChar(this)' /></td>";
echo "</td></tr>";


echo "<tr>";
echo "<td align='right' width='15%' class = 'datafield' >Institute Address<span class = 'mandatory'>*</span></td>";
echo "<td width='2%' class='spacetd' > </td>";
echo "<td width='33%' class = 'dataview' ><textarea col = '28' row = '5' name = 'InstituteAddress' id = 'InstituteAddress'> </textarea> </td>";
echo "</td></tr>";

echo "<tr>";
echo "<td align='right' width='15%' class = 'datafield' >Phone No</td>";
echo "<td width='2%' class='spacetd' > </td>";
echo "<td width='33%' class = 'dataview' ><input type = 'text' name = 'PhoneNo' id = 'PhoneNo' onKeyUp='JsCheckNumber(this)' /></td>";
echo "</td></tr>";

echo "<tr>";
echo "<td align='right' width='15%' class = 'datafield' >Mobile No</td>";
echo "<td width='2%' class='spacetd' > </td>";
echo "<td width='33%' class = 'dataview' ><input type = 'text' name = 'MobileNo' id = 'MobileNo' onchange='JsCheckMobile(this)' /></td>";
echo "</td></tr>";

echo "<tr>";
echo "<td align='right' width='15%' class = 'datafield' >Email Id</td>";
echo "<td width='2%' class='spacetd' > </td>";
echo "<td width='33%' class = 'dataview' ><input type = 'text' name = 'Email' id = 'Email' onchange='JsCheckEmail(this)'/></td>";
echo "</tr>";
echo "</table>";
echo "</div>";
echo "</div>";
?>
<script>

function validation(){
	var InstituteName = $('#InstituteName').val();
	var InstituteOwner = $('#InstituteOwner').val();
	var InstituteAddress = $('#InstituteAddress').val();
	

      if(InstituteName ==''){
		$('#message').html('Institute Name should not be blank').show().fadeOut('slow').fadeIn('slow');
		$('#InstituteName').focus();
		return false;
	}else if(InstituteOwner ==''){
		$('#message').html('Institute Owner should not be blank').show().fadeOut('slow').fadeIn('slow');
		$('#InstituteOwner').focus();
		return false;
	}else if(InstituteAddress ==''){
		$('#message').html('Institute Address should not be blank').show().fadeOut('slow').fadeIn('slow');
		$('#InstituteAddress').focus();
		return false;
	}else{
		return true;
	}
}

function save_data(){
 var InstituteName = $('#InstituteName').val();
 var InstituteOwner = $('#InstituteOwner').val();
 var InstituteAddress = $('#InstituteAddress').val();
 var PhoneNo = $('#PhoneNo').val();
 var MobileNo = $('#MobileNo').val();
 var Email = $('#Email').val();

 if(validation()){
	 	$.ajax({
			type: 'POST',
			url: '<?=$url?>login/save',
			data: 'InstituteName='+InstituteName+'&InstituteOwner='+InstituteOwner+'&InstituteAddress='+InstituteAddress+'&PhoneNo='+PhoneNo+'&MobileNo='+MobileNo+'&Email='+Email,
			success: function(response){
			    // alert(response);
				if($.trim(response) == 1){
					alert('Insert Successfully');
				}else{
					alert('Insert Not Successfully');
				}
			}
					
		});
	}	
}
function JsCheckChar(argval)                         
{          
   var p=0,j=0;
   q=' ';		
   var re = /^([A-Za-z]+)$/;                               
   if (re.test(argval.value))                        
   {            
	return;                                     
   }            
   argval.value =argval.value.replace(/[^a-zA-Z]/g,""); 	
}                                             

function JsCheckNumber(argval)                         
{          
var re = /^[0-9]*$/;
  if (!re.test(argval.value))
  {
  argval.value =argval.value.replace(/[^0-9]/g,"*");
  }
} 

function JsCheckMobile(argval)                         
{          
var re = /^\d{10}$/;
  if (re.test(argval.value)==false)
  {
  		alert("**********Mobile No should have 10 digits");
  		
  }
  //else
  		//alert("valid mobile number");
} 
function JsCheckEmail(argval)
{
	//var re=/^[^\.]+(\..{1,})*\@{1,1}\w+(\.{1,1}[a-zA-Z]{2,}){1,}$/	
						  //Allowing all characters before and after dot
		var re=/^\w+([-+.']\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*$/;	
						 //Allowing numbers,alpahbets and underscore before and after dot
						 
		if (re.test(argval.value)==false)
		{
			alert('not a valid email-id');
		}
		//else
			//alert('valid email-id');
}                          


</script>
