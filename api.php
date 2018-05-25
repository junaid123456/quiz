<?php 
if(@$_REQUEST['check_access_token'])
{
	$json = json_encode(array('is_valid' => 'no'));
	if(@$_REQUEST['access_token'] == '1')
		$json = json_encode(array('username' => 'user_1', 'access_token' => '1', 'user_id' => '1', 'picture' => 'user1.jpg'));
	
	if(@$_REQUEST['access_token'] == '2')
		$json = json_encode(array('username' => 'user_2', 'access_token' => '2', 'user_id' => '2', 'picture' => 'user2.jpg'));
			
	if(@$_REQUEST['access_token'] == '3')
		$json = json_encode(array('username' => 'user_3', 'access_token' => '3', 'user_id' => '3', 'picture' => 'user3.jpg'));
		
	if(@$_REQUEST['access_token'] == '4')
		$json = json_encode(array('username' => 'user_4', 'access_token' => '4', 'user_id' => '4', 'picture' => 'user4.jpg'));
		
	if(@$_REQUEST['access_token'] == '5')
		$json = json_encode(array('username' => 'user_5', 'access_token' => '5', 'user_id' => '5', 'picture' => 'user5.jpg'));
		
	if(@$_REQUEST['access_token'] == '6')
		$json = json_encode(array('username' => 'user_6', 'access_token' => '6', 'user_id' => '6', 'picture' => 'user6.jpg'));			

	echo $json;
	exit();
}

?>

<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>scrollLeft demo</title>
  <script src="https://code.jquery.com/jquery-1.10.2.js"></script>
</head>
<body>  
<div id="foo" style="position:absolute"><img src="user1.jpg"></div>
<script>
   var self_call;
   function div_slide() {
	   
	   $('#foo').css({ 'right': '0px', 'left': '' }).animate({
			'right' : '300px' 
 	   });   
	   self_call = setTimeout(div_slide, 2000);   	                 
   }
   $(document).ready(function(){
    div_slide();
   });
</script>
 
</body>
</html>
 