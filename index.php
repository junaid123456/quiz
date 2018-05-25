<?php 
$quiz = array(
				array('question_id'   		=> '1',
					  'question_text' 		=> 'Which is the biggest city of pakistan ?',
					  'question_option_a'	=> 'Karachi',
					  'question_option_b'	=> 'Lahore',
					  'question_option_c'	=> 'Islamabad',
					  'question_option_d'	=> 'Sahiwal',
					  'question_correct_option'	=> 	'option_a'
					 ),
				
				array('question_id'   		=> '1',
					  'question_text' 		=> 'Lahore is the city of ?',
					  'question_option_a'	=> 'Sindh',
					  'question_option_b'	=> 'Punjab',
					  'question_option_c'	=> 'FATA',
					  'question_option_d'	=> 'Kashmir',
					  'question_correct_option'	=> 	'option_b'
					 ),
				
				array('question_id'   		=> '1',
					  'question_text' 		=> 'Islamabad is capital of ?',
					  'question_option_a'	=> 'Nepal',
					  'question_option_b'	=> 'India',
					  'question_option_c'	=> 'Pakistan',
					  'question_option_d'	=> 'Iran',
					  'question_correct_option'	=> 	'option_c'
					 )	 	 
		);
?>

<!DOCTYPE html>
<html>
    <head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Quiz Game</title>
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
		<meta content="width=device-width, initial-scale=1.0" name="viewport" />
 		<link href="public/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
 	</head>	
	<body>
	   <div class="container">
		 	<div class="row">
				<div class="col-md-9 col-md-offset-3">
 					<h3>Which is the Bigest city of Pakistan?</h3>
 					<div>Karachi</div>
					<div class="btn-group">
					  <button type="button" class="btn btn-default">1</button>
					  <button type="button" class="btn btn-default">2</button>
					  <button type="button" class="btn btn-default">3</button>
					  <button type="button" class="btn btn-default">4</button>
					  <button type="button" class="btn btn-default">5</button>
					</div>
 				</div>
			</div>
  			<div id="image" style="position:absolute;"></div>	 
 	   </div>
	<script src="public/jquery/jquery-3.1.1.min.js" type="text/javascript"></script>
	<script src="public/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
	<script src="node_modules/socket.io-client/dist/socket.io.js"></script>
	<script type="text/javascript">
	
	var self_call;
    function div_slide() {
 	   $('#image').css({ 'right': '300px'}).animate({
			'right' : '700px' 
   	   });   
	   self_call = setTimeout(div_slide, 2000);   	                 
    } 
	var Quiz = (function() {
			var the;
			var socket;
			var quiz;

			return {
					init: function () {
						the = this;
						socket = io('http://localhost:5000?_a=<?php echo @$_REQUEST['_a']; ?>', {
									  reconnection : false
									});
 						socket.on('searchOpponent', function(data){
							var opponents = data.opponents;
							console.log(opponents);
							
							/*var size = Object.keys(opponents).length;
							if(size > 0) {
								function randNumber() {
									var randomNumber = Math.floor(Math.random() * size-0+1) + 0;
                                    return randomNumber;   
								}
								
							}
  							for(i in opponents)
							{
							     
								var username     = opponents[i].username;
								var user_id      = opponents[i].user_id;
								var access_token = opponents[i].access_token;
								var socket_ids   = opponents[i].socket_ids;
								var picture      = opponents[i].picture;
								  
								$('<img />', {
								src: picture,
								width: '100px',
								height: '100px',
								}).appendTo($('#image')).css('margin-right','4px');
								div_slide();
							}	
							*/
						});
						
						
						socket.on('yourOpponent', function(user_id){
	
							console.log('your opponent is '+user_id);
							
						});
						
						
						socket.on('error', function(error){
							console.log(error);
						});
					},
 					 
 					loadQuiz: function(){
						quiz = <?php echo json_encode($quiz); ?>;
						
						
						
						console.log(quiz);
					},
			};
	})();
	Quiz.init();
		
		
		</script>
	</body>
</html>