// JavaScript Document
//var host = $(location).attr('host');
var url =  'http://localhost/school/';
/* search  option jquery function */	
		$(document).ready(function () {	
			$('#nav li').hover(
				function () {
					//show its submenu
					$('ul', this).slideDown(100);
				},
				function () {
					//hide its submenu
					$('ul', this).slideUp(100);			
				}
			);
		});
		
/* searching jquery function */
function search_fun(e){
	//check for search option selected & search word entered
	if ($('input[name=searchfield]:checked').length == 0){
		alert("Please select search by option.");
		  return false;
	}
	var search_option = $('input[name=searchfield]:checked').val();
	var search_string = $('input[name=searchbox]').val();
	
	if(search_string == null || search_string.trim() == ''){
		alert("Please enter search word.");
		return false;
	}
	var tablename = $("input[name = 'tablename']").attr('class');
	var year = $("select#Year").val();
	$.ajax({
		type: 'POST',
		url: url+tablename+'/search_data/'+year,
		data: 'searchoption='+search_option+'&searchstring='+search_string,
		success: function(response){
			if(response != ''){
				$('.container').html(response);
			}
		}
	});
}
	
function searcha_fun(e){
	var search_option = $('input[name=searchfield]:checked').val();
	var search_string = $('input[name=searchbox]').val();
	var tablename = $("input[name = 'tablename']").attr('class');
	var year = $("select#Year").val();
	$.ajax({
		type: 'POST',
		url: url+tablename+'/assign_search_data/'+year,
		data: 'searchoption='+search_option+'&searchstring='+search_string,
		success: function(response){
			if(response != ''){
				$('.container').html(response);
			}
		}
	});
}
	
	
/* sorting jquery function */
/*function sort_fun(e) {
		var tablename = $("th input[name = 'tablename']").attr('class');
		var sortkey = $(e).attr('id');
		var ordertype = $('#ordertype').val();
		if( ordertype == 0)
		{
			order = 'desc';
		}else if(ordertype == 1)
		{
			order = 'asc';
		}
		 $.ajax({
			type: 'POST',
			url: '/school/'+tablename+'/sort_data',
			data: 'sortkey='+sortkey+'&order='+order,
			success: function(response){	
				if(response != ''){
					
					$('.container').html(response);
					if( ordertype == 0)
					{
						$('#ordertype').val(ordertype.replace('0', 1)); 
						$('#'+sortkey+' img#order_up').hide();
						$('#'+sortkey+' img#order_down').show();
					}else if(ordertype == 1)
					{
						$('#ordertype').val(ordertype.replace('1', 0));
						$('#'+sortkey+' img#order_up').show();
						$('#'+sortkey+' img#order_down').hide(); 
					}
					
				}
			}	
						
		});
	}*/
 /* sorting jquery function */
function sorta_fun(e) {
	 var tablename = $("th input[name = 'tablename']").attr('class');
	 var orderval = $('.'+tablename).val();
	 var sortkey  = $(e).attr('class');
	 var year = $("select#Year").val();
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
  		url: url+tablename+'/assignlist_sort/'+year,
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
 
 function sort_fun(e) {
	 
	 var tablename = $("th input[name = 'tablename']").attr('class');
	 var orderval = $('.'+tablename).val();
	 var sortkey  = $(e).attr('class');
	 var year = $("select#Year").val();
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
  		url: url+tablename+'/sort_data/'+year,
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
 
/*-----------------------------------------------Number,character and email validation goes here------------------------------------------------------------------*/
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

function JsCheckAmount(argval)                         
{          
var re = /^[0-9.]*$/;
  if (!re.test(argval.value))
  {
  argval.value =argval.value.replace(/[^0-9.]/g,"");
  }
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

/*function JsCheckEmail(argval)
{
	//var re=/^[^\.]+(\..{1,})*\@{1,1}\w+(\.{1,1}[a-zA-Z]{2,}){1,}$/	
						  //Allowing all characters before and after dot
		var re=/^\w+([-+.']\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*$/;	
						 //Allowing numbers,alpahbets and underscore before and after dot
		if (re.test(document.getElementById("Email").value)==false)
		{
			alert('not a valid email-id');	
			document.getElementById("Email").focus();	
			document.getElementById("Email").select();	
		}
		else
			alert('valid email-id');
} */                           
/*-----------------------------------------------Number,character and email validation ends here------------------------------------------------------------------*/
