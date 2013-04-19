<?php
//re-set the form
	session_start();
	session_unset();
	header("location: home.php");

?>