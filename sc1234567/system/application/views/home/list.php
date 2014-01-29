<?php
//if(!isset($this->session->userdata('username')) && $this->session->userdata('username') == NULL){	header('location:' . $url .'login/index');exit;}

//echo 'Email: '.$_SESSION['maile'];
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

/*echo "<div class='events'>";
echo "<a href='".$url."rolls/rollsaddnew'>";
echo "<span><img src='".$url."images/addnew.png' border='0' /></span>";
echo "<span>Aaddnew</span>";
echo "</a>";
echo "</div>";

echo "<div class='events'>";
echo "<a href='".$url."rolls/cancel'>";
echo "<span> <img src='".$url."images/edit.png' border='0' /></span>";
echo "<span>".' '. "Edit" . ' ' . "</span>";
echo "</a>";
echo "</div>";*/

echo "</div>";
echo "</div>";
/*---------------     content        ---------------------*/
echo "<div style='padding:0;' class='content'>";
echo "<div align='center' class = 'content_left' >
    <div class = 'homemenu' ><a onClick = 'todayinfo();'><div>Today Info</div></a></div>
	<div class = 'homemenu' ><a onClick='studentinfo();'><div>Student</div></a></div>
	<div class = 'homemenu' ><a onClick='staffinfo();'><div>Staff</div></a></div>
	<div class = 'homemenu' ><a onClick='libraryinfo();'><div>Library</div></a></div>
	<div class = 'homemenu' ><a onClick='sendmail();'><div>Send Mail</div></a></div>
	<div class = 'homemenu' ><a onClick='sendsms();'><div>Send SMS</div></a></div>";
echo"</div>";
echo "<div class = 'content_right' ></div>";

echo "</div>";
echo "</div>";
?>

<script>
	function todayinfo(){
	  $.ajax({
				type: 'POST',
				url: '<?=$url?>home/todayinfo',
				data: '',
				success: function(response){
				      		if(response != ''){
							$('.content_right').html(response);
						}
					}
		});
	}
	
	function studentinfo(){
		 $.ajax({
				type: 'POST',
				url: '<?=$url?>home/studentinfo',
				data: '',
				success: function(response){
						if(response != ''){
							$('.content_right').html(response);
						}
					}
					
		});
	}
	
	function staffinfo(){
		var StaffId = $('#StaffId').val();

		 $.ajax({
				type: 'POST',
				url: '<?=$url?>home/staffinfo',
				data: 'StaffId='+StaffId,
				success: function(response){			
						if(response != ''){
							$('.content_right').html(response);
						}
					}
		});
	}
	
	function libraryinfo(){
		 
		 $.ajax({
				type: 'POST',
				url: '<?=$url?>home/libraryinfo',
				data: '',
				success: function(response){			
						if(response != ''){
							$('.content_right').html(response);
						}
					}
		});
	}

function staff_search(){
var StaffId = $('#StaffId').val();

		 $.ajax({
				type: 'POST',
				url: '<?=$url?>home/staffsearch',
				data: 'StaffId='+StaffId,
				success: function(response){
						if(response != ''){
							$('.content_right').html(response);
						}
					}
					
		});
}

function student_search(){
var StudentId = $('#StudentId').val();
		 $.ajax({
				type: 'POST',
				url: '<?=$url?>home/studentsearch',
				data: 'StudentId='+StudentId,
				success: function(response){
						if(response != ''){
							$('.content_right').html(response);
						}
					}
					
		});
}

function sendmail(){

var RollNo = $('#RollNo').val();
		 $.ajax({
				type: 'POST',
				url: '<?=$url?>home/sendmail',
				data: 'RollNo='+RollNo,
				success: function(response){
						if(response != ''){
							$('.content_right').html(response);
						}
					}
					
		});
}

function sendsms(){
var RollNo = $('#RollNo').val();

		 $.ajax({
				type: 'POST',
				url: '<?=$url?>home/sendsms',
				data: 'RollNo='+RollNo,
				success: function(response){
						if(response != ''){
							$('.content_right').html(response);
						}
					}
					
		});
}
function sendmail_fun()
{
	var MailList = $('#emaillist').val();
	var Mail = $('#email').val();
	var Subject = $('#Subject').val();
	var Message = $('#Message').val();
		 $.ajax({
				type: 'POST',
				url: '<?=$url?>home/send_mail',
				data: 'Mail='+Mail+'&Subject='+Subject+'&Message='+Message+'&MailList='+MailList,
				success: function(response){
						if(response == '1'){
							alert ('Mail sent successfully');//$('.content_right').html(response);
						}
				}
					
		});

}

function section_fun()
{
	var ClassId = $('#class').val();
	
		 $.ajax({
				type: 'POST',
				url: '<?=$url?>home/section',
				data: 'ClassId='+ClassId,
				success: function(response){
						if(response != ''){
							$('#sectionid').html(response);
						}
				}
					
		});

}


function sendsms_fun()
{
	var NumberList = $('#numberlist').val();
	var Message = $('#Message').val();
	var Numbers = $('#Numbers').val();

		 $.ajax({
				type: 'POST',
				url: '<?=$url?>home/send_sms',
				data: 'Numbers='+Numbers+'&Message='+Message+'&NumberList='+NumberList,
				success: function(response){
						alert(response);			
						//if(response == '1'){
							//alert ('Mail sent successfully');//$('.content_right').html(response);
						//}
				}
					
		});

}
function numberslist_fun(){
	var SectionId = $('#sectionid').val();
	var ClassId = $('#class').val();

		 $.ajax({
				type: 'POST',
				url: '<?=$url?>home/numberslist',
				data: 'SectionId='+SectionId+'&ClassId='+ClassId,
				success: function(response){
						if(response != ''){
							$('#numberslist').html(response);
						}
				}
		});
}
function emailslist_fun(){
	var SectionId = $('#sectionid').val();
	var ClassId = $('#class').val();
		 $.ajax({
				type: 'POST',
				url: '<?=$url?>home/emaillist',
				data: 'SectionId='+SectionId+'&ClassId='+ClassId,
				success: function(response){
						if(response != ''){
							$('#emailslist').html(response);
						}
				}
		});
}
</script>