<?php
echo "<div class='footer' style = 'float:left;' ></div>";
echo '<div id = "error_msg" title="Error message" >this is message!</div>';
echo "</body>";
echo "</html>";
?>
<script>
var dh = $(document).height();
var ch = $('.container').height();
if(ch <=500){
	$('.container').height((dh-175)+'px');
}
function message(msg){
	
	$( "#error_msg" ).html(msg).css('display','block').dialog({
		modal: true,
		buttons: {
			Ok: function() {
				$( this ).dialog( "close" );
			}
		}
	});
};	
</script>
