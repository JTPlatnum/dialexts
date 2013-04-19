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
		<title>Submit!</title>		
	</head>
<!-- end of head -->
	<body>
		<script src="http://code.jquery.com/jquery.js"></script>
		<script src="bootstrap.min.js"></script>
		<div id="wrapper">
			<div class="row">
				<div class="span10">
					<div class="header">
						Submit your own dialext (for everybody to use) or Add words to existing dialects!
					</div>	
				</div>	
				<div class="span2 offset9">	
					<div class="header_right">	
				 		<a href="reset.php">Back home...</a>
					</div>
				</div>
			</div>			
<!-- end of header			 -->
			<form id="submit_new" action="submitwordsprocess.php" method="post">
				<div class="row">
					<div class="span12"><h4> Search for an existing dialect: </h4>
						<div class="options"><?php
							echo "<select name='dialect'>";
								foreach($dialects as $dialect){
									echo '<option value="'.($dialect[id]).'">' . ($dialect['dialect_path']) . "</option>";
								}
							echo "</select><br>";
							?>
						</div>
					</div>	
				</div>	
	<!-- end of select options			 -->
				<div id="table">
					<div class="row">
						<div class="span12">
							<table class="table">
								<tr>
									<th>English word</th>
									<th>Dialect word</th>
								</tr>
								<?php
								echo "<tr>";
									echo '<td><input type="text" name="eng_word_new" placeholder="English Word..."></td>';
									echo '<td><input type="text" name="dialect_word_new" placeholder="Dialect Word..."></td></tr>';
								?>
							</table>
						</div>
						<div class="span1">
							<input type="submit" value="Submit!">
						</div>		
					</div>			
				</div>
	<!-- end of table entry		 -->
			</form>	
		</div>
<!-- end of wrapper		 -->
	</body>
</html>