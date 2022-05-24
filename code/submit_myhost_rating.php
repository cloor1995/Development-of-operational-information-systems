<?php
// Initialize the session
 session_start();

// Check if the user is already logged in, if yes then redirect him to welcome page
if(!isset($_SESSION["loggedin"])){
    header("location: login.php");
	exit; 
}
?>

<?php

//database connection and extract user_id
$link = new PDO("mysql:host=localhost;dbname=ebis005", "ebis005", "Ab9kGN0Vts");
// todo# PARTY ID ermitteln  $party_id = $_GET["pid"]

$user_id = $_SESSION["id"];


// if value is set, execute the following block
if(isset($_POST["rating_data"])){

    // save data as an array 
	$data = array(
		':user_name'		=>	$_POST["user_name"],
		':user_rating'		=>	$_POST["rating_data"],
		':user_review'		=>	$_POST["user_review"],
		':datetime'			=>	time(),
		':hostguest'		=>	$_POST["hostguest"],
		':user_id'			=>	$_SESSION["id"]
	);
	

    // this query will insert data into 'hostreview' 
	$query = "
	INSERT INTO userreviewed 
	(user_name, user_rating, user_review, datetime, hostguest, nutzer_id) 
	VALUES (:user_name, :user_rating, :user_review, :datetime, :hostguest, :user_id)
	";

    // make query for execution 
	$statement = $link->prepare($query); 

    // method to execute query and insert data into mysql table 
	$statement->execute($data);
    

    // sent message to ajax request 
    echo "Vielen Dank! Deine Bewertung wurde erfolgreich übermittelt. ";

}



if(isset($_POST["action"]))
{
	//create local variables 
	$average_rating = 0;
	$total_review = 0;
	$five_star_review = 0;
	$four_star_review = 0;
	$three_star_review = 0;
	$two_star_review = 0;
	$one_star_review = 0;
	$total_user_rating = 0;
	$review_content = array();


	// this query will fetch all data from "hostreview" WHERE user_id = '$user_id'
	$query = "
	SELECT * FROM userreviewed WHERE user_id = '$user_id' ORDER BY review_id DESC
	";

	// will execute above query and return query execution result in array format 
	$result = $link->query($query, PDO::FETCH_ASSOC);

	
	foreach($result as $row)
	{
		$review_content[] = array(
			'user_name'		=>	$row["user_name"],
			'user_review'	=>	$row["user_review"],
			'rating'		=>	$row["user_rating"],
			'datetime'		=>	date('d.m.y, G:i ', $row["datetime"]),
			'hostguest'		=>  $row["hostguest"]
		);


		// increase the amount of ratings for every group
		if($row["user_rating"] == '5')
		{
			$five_star_review++;
		}

		if($row["user_rating"] == '4')
		{
			$four_star_review++;
		}

		if($row["user_rating"] == '3')
		{
			$three_star_review++;
		}

		if($row["user_rating"] == '2')
		{
			$two_star_review++;
		}

		if($row["user_rating"] == '1')
		{
			$one_star_review++;
		}

		$total_review++;

		$total_user_rating = $total_user_rating + $row["user_rating"];

	}

	//calculate average rating
	$average_rating = $total_user_rating / $total_review;

	// store all data in array variable to send ajay request 
	$output = array(
		'average_rating'	=>	number_format($average_rating, 1),
		'total_review'		=>	$total_review,
		'five_star_review'	=>	$five_star_review,
		'four_star_review'	=>	$four_star_review,
		'three_star_review'	=>	$three_star_review,
		'two_star_review'	=>	$two_star_review,
		'one_star_review'	=>	$one_star_review,
		'review_data'		=>	$review_content
	);

	// send now all to ajax request in json format 
	echo json_encode($output);


}



?>