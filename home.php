<?php
	session_start();
	require_once('dbconnect.php'); 
// BEGIN CHECKING DB FOR FORM INFORMATION
	$dialects = fetchAll('SELECT id, CONCAT(dialect_top, " | ", dialect_mid, " | ", dialect_low) as dialect_path FROM dialects ORDER BY dialect_top desc, dialect_mid desc, dialect_low desc');
?>

<!DOCTYPE html>
<html lang="en-US">
	<head>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="stylesheet" type="text/css" href="dialextscss.css"></link>
		<link rel="stylesheet" type="text/css" href="bootstrap.min.css" media="screen"></link>
		<title>Dialexts!</title>		
	

 	<script src="http://code.jquery.com/jquery.js"></script>
<!-- start ajax script    -->
			<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
			<script type="text/javascript">
			    $(document).ready(function(){

			    	function submitForm()
			    	{
			    		var form = $('#dialect_this_message');
			            $.post(form.attr('action'), form.serialize(), function(message){
			                if(message)
			                {
			                   $('#translated_version').html(message);
			                }

			            }, "json");
			    	}

			    	$("#dialect_dropdown").on('change', function(){
			    	   submitForm(); 
			    	});
			        $("#original_text").on('keypress', function(){
			           submitForm(); 
			        });
			    });
			</script>
<!-- end ajax script			 -->
		<script src="bootstrap.min.js"></script>

	</head>
<!-- end of head -->
	<body>
		<div id="wrapper">

			<div class="row">
				<div class="span9">
					<div class="header">
						Use dialexts to translate text to popular (and not so popular) English dialects!
					</div>	
				</div>
				<div class="span3">
					<form id="submit_dialext" action="submitwords.php" method="post">  
						<button type="submit" value="submit_dialext" class="btn">Submit your own words!</button>
					</form>  
				</div>
				<div class="span2 offset10">
					<div class="header_right">	
						<a href="reset.php">Reset the form</a>
					</div>
				</div>
			</div>			
<!-- end of header			 -->
			<form id="dialect_this_message" action="translateprocess.php" method="post">
				<div class="row">
					<div class="span12">
						<div class="options">
	<!-- dropdown & values begin -->
				<?php
					echo "<select id='dialect_dropdown' name='dialect'>";
						foreach($dialects as $dialect){
							echo '<option value="'.($dialect[id]).'">' . ($dialect['dialect_path']) . "</option>";
						}
					echo "</select><br>";
				?>
						</div>
					</div>	
	<!-- dropdown & values end -->
				</div>
	<!-- beginning of text entry -->
				<div class="row">
					<div class="span5">
						<div class="entry">
				<?php			
							echo '<label>Text to Translate:</label>';  
							  	echo '<textarea name="message" rows="10" id="original_text" class="span5" placeholder="Type here"></textarea><br>';
							echo '</label>';  
							echo '<input type="submit" value="Translate!">';
				?>				
						</div>
					</div>
						<div class="span6">
							<div class="results">
								<form id="translated_text" action="home.php" method="post">  
									  <label>Translated text:</label>  
									  		<textarea id="translated_version" name="translated" rows="10" class="span5" placeholder=""><?php
								if(isset($_SESSION['message_block_trans']))
								{
									echo $_SESSION['message_block_trans'];
									unset($_SESSION['message_block_trans']);
								}
							?></textarea>
									  </label>  
									 	<!-- <button type="submit" value="read_alound" class="btn">Read this aloud!</button>   -->
									  	<!-- <button type="submit" value="copy_clip" class="btn">Copy to clipboard!</button>   -->
									  	<!-- <button type="submit" value="send_via_text" class="btn">Send this via text!</button>   -->
								 </form> 
							</div>
						</div>
					</div>
				</div>
			</form>	
<!-- end of text entry			 -->
		</div>
<!-- end of wrapper		 -->
	</body>
</html>