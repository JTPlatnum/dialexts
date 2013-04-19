<?php
	session_start();

	require_once('dbconnect.php'); 

	$big_table = fetchAll("SELECT dialects.id, english_word, eng_word_id, dialect_word, dialect_words.id FROM dialects LEFT JOIN dialect_words on dialects.id = dialect_words.dialect_id LEFT JOIN eng_words on dialect_words.eng_word_id = eng_words.id"); //where dialect.id = ($_POST['dialect'])
	$eng_table = fetchAll("SELECT id, english_word FROM eng_words");

	if(!empty($_POST['dialect']) || !empty($_POST['eng_word_new']) || !empty($_POST['dialect_word_new']))
	{
		$word_exists=false;
		foreach($eng_table as $eng_record)
		{
			if(in_array($_POST['eng_word_new'], $eng_record))
			{
				$word_exists=true;
				$eng_word_id = fetchRecord("SELECT id FROM eng_words WHERE english_word='$_POST[eng_word_new]'");
			}
		}
		if(!$word_exists)
		{
			$add_eng_word = mysql_query("INSERT into eng_words (id, english_word, created_at, updated_at) values('', '$_POST[eng_word_new]' , NOW(), NOW())");
				$eng_word_id = fetchRecord("SELECT id FROM eng_words WHERE english_word='$_POST[eng_word_new]'");
		}

		if(isset($_POST['dialect_word_new'])){
			$add_dialect_word = mysql_query("INSERT into dialect_words (id, dialect_id, eng_word_id, dialect_word, created_at, updated_at) values ('', '$_POST[dialect]', '$eng_word_id[id]', '$_POST[dialect_word_new]', NOW(), NOW())");
		}
	}

header('location: submitwords.php');

?>