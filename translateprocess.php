<?php
	session_start();

	require_once('dbconnect.php'); 
	
	if(!empty($_POST['dialect']) || !empty($_POST['message']))
	{
		
//get words from the database that are relative to english and the dialect chosen
		$rel_word_list=fetchAll("SELECT english_word, dialect_word 
			FROM eng_words 
			LEFT JOIN dialect_words on eng_words.id = dialect_words.eng_word_id 
			WHERE dialect_id=" . $_POST['dialect']);

//for each value in the query, set the enlish word as the key and the associated word as the value

		// //replace all non alphabetical characters to space
		$_POST['message'] = preg_replace('/[^\p{L}]/u', " ", $_POST['message']);
		$_POST['message'] = trim(preg_replace('!\s+!', ' ', $_POST['message']));	

		$messages = explode(" ", $_POST['message']);
		$revised_messages = array();

		// foreach($messages as $word)
		// {
		// 	$changed = false;
		// 	foreach ($rel_word_list as $key => $value) 
		// 	{
		// 		if($word == $value['english_word'])
		// 		{
		// 			$revised_messages[] = $value['dialect_word'];
		// 			$changed = true;
		// 		}
		// 	}
		// 	if($changed == false)
		// 	{
		// 		$revised_messages[] = $word;
		// 	}
		// }


		$revised = implode(" ", $revised_messages);

		foreach ($rel_word_list as $key => $value) 
		{
			$eng_words[] = " " . $value['english_word'] . " ";
			$dialect_words[] = " " . $value['dialect_word'] . " ";
		}

		$message_block = " " . $_POST['message'] . " ";

		$translated = str_replace($eng_words, $dialect_words, $message_block);
	}

	echo json_encode(trim($translated)); 

	// header('location: home.php');


?>