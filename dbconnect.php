<?php

//define constants for db_host, db_user, db_pass, and db_database
//adjust the values below to match your database settings
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', 'root');
define('DB_DATABASE', 'dialects');

//connect to database host
$connection = mysql_connect(DB_HOST, DB_USER, DB_PASS) or die('Could not connect to the database host (please double check the settings in connection.php): ' . mysql_error());

//connect to the database
$db_selected = mysql_select_db(DB_DATABASE, $connection) or die ('Could not find a database with the name "'.DB_DATABASE.'" (please double check your settings in connection.php): ' . mysql_error());

//fetches all records from the query and returns an array with the fetched records

function fetchAll($query)
{
	$data = array();

	$result = mysql_query($query);
	while($row = mysql_fetch_assoc($result))
	{
		$data[] = $row;
	}

	return $data;
}

//fetch the first record obtained from the query
function fetchRecord($query)
{
	$result = mysql_query($query);
	return mysql_fetch_assoc($result);
}

//Randall's query to update values in my DB
// $handle = fopen('Project1 Data Table - dialect_words.csv','r');
// $i =0;
// if($handle){
// 	while(($row = fgets($handle,4096)) !== false)
// 	{
// 		if($i == 0)
// 		{
// 			$i++;
// 			continue;
// 		}

// 		$line = explode(',',$row);
// 		$sql = "INSERT INTO dialect_words VALUES(";
// 		$c = 0;
// 		foreach ($line as $key => $column)
// 		{
// 			$integer = false;
// 			if(is_int($column))
// 			{
// 				$integer = true;
// 			}

// 			if($c == 0)
// 			{
// 				$sql .= "''";
// 			}
// 			else
// 			{
// 				if($c == 4 || $c == 5)
// 				{
// 					$sql .= ','."NOW()";
// 				}
// 				else
// 				{
// 					$sql .= ','.(($integer == true) ? $column : "'".$column."'");
// 				}
				
// 			}

// 			$c++;
// 		}
// 		$sql .= ')';
// 		echo $sql."<br>";
// 		if($query = mysql_query($sql))
// 		{
// 			echo "success"."<br>";
// 		}
// 		else
// 		{
// 			echo "failed";
// 		}

// 		$i++;
// 	}
// }
//end of Randall's query

?>