<?php
	session_start();
?>

<!DOCTYPE html>
<html lang="en-US">
	<head>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="stylesheet" type="text/css" href="dialextscss.css"></link>
		<link rel="stylesheet" type="text/css" href="bootstrap.min.css" media="screen"></link>
		<title>Results!</title>		
	</head>
<!-- end of head -->
	<body>
	    <script src="http://code.jquery.com/jquery.js"></script>
	   	<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script><br><script type="text/javascript"></script>
		<script src="bootstrap.min.js"></script>
  		<script>
 			$(function() {
  				$( "#tabs" ).tabs();
  			});
 		 </script>

		<div id="wrapper">
			<div class="row">
				<div class="span9">
					<div class="header">
						Your text has been TRANSLATED!
					</div>
				</div>		
				<div class="span2 offset10">
					<div class="header_right">	
						<a href="reset.php">Reset the form</a>
					</div>
				</div>
			</div>			
<!-- end of header			 -->
			<div class="row">
				<div class="span12">
					<div class="options">

					<?php
						if(isset($_SESSION['dialect_path']))
						{
							echo $_SESSION['dialect_path'];
							// echo "<select name='dialect'>";
							// 	echo '<option value="'.($_SESSION['dialect_path']).'">' . ($_SESSION['dialect_path']) . "</option>";
							// echo "</select><br>";
							unset($_SESSION['dialect_path']);
						}
					?>	
					</div>
				</div>	
			</div>
<!-- end of select options	-->
			<div class="row">
				<div class="span6">
					<div class="entry">
						<form id="translate_text" action="results.php" method="post">  
							<label>Original text:</label>  
						  		<textarea name="original" rows="10" input type="text" class="span5" placeholder=""><?php
						if(isset($_SESSION['message']))
						{
							echo $_SESSION['message'];
							unset($_SESSION['message']);
						}
					?></textarea>
							</label>  
							<!-- <button type="submit" value="Translate" class="btn">Made more changes? Translate Again!</button>   -->
						</form>  	
					</div>
				</div>
	<!-- end of entered			 -->
				<div class="span6">
					<div class="results">
						<form id="translated_text" action="home.php" method="post">  
							  <label>Translated text:</label>  
							  		<textarea name="translated" rows="10" input type="text" class="span5" placeholder=""><?php
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
	<!-- end of translated			 -->
			</div>
<!-- end of translate entry			 -->
		</div>
<!-- end of wrapper		 -->
	</body>
</html>