<?php

	//webscraping code was modified from the following website: http://scraping.pro/ and http://webrobots.io/scraping-tutorial/

	//getting entered city
	if(isset($_GET['city'])){
		$city = htmlspecialchars(trim($_GET['city']));
		//removing any space between city
		$city = str_replace(" ", "", $city);
	}
	//getting conntent of weather-forecast website with provided city
	$content = file_get_contents("http://www.weather-forecast.com/locations/" .$city ."/forecasts/latest");
	//sing regex to scrap 3 days weather prediction
	preg_match('/3 Day Weather Forecast Summary:<\/b><span class="read-more-small"><span class="read-more-content"> <span class="phrase">(.*?)<\/span>/s', $content, $match);
	print_r($match[1]);



/*
	echo $match[1];
	echo $city;
	//
	//
	//
	//Open a new connection to the MySQL server
	$mysqli = new mysqli('oniddb.cws.oregonstate.edu','hesseljo-db','PgYfUf1S43SqPmiC','hesseljo-db');

	//Output any connection error
	if ($mysqli->connect_error) {
	    die('Error : ('. $mysqli->connect_errno .') '. $mysqli->connect_error);
	}

	$match[1]; = $_POST['my_report'];

	$a = $my_report

	//values to be inserted in database table

	$query = "INSERT INTO cities (report) VALUES($a)";
	$statement = $mysqli->prepare($query);

	//bind parameters for markers, where (s = string, i = integer, d = double,  b = blob)
	$statement->bind_param('sss', $a);

	if($statement->execute()){
	    print 'Success! ID of last inserted record is : ' .$statement->insert_id .'<br />'; 
	}else{
	    die('Error : ('. $mysqli->errno .') '. $mysqli->error);
	}
	$statement->close();

	*/
	?>

	

	
