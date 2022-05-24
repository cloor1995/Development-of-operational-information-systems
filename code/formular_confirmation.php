<?php

// Initialize the session
session_start();

// Check if the user is already logged in, if yes then redirect him to welcome page
if(!isset($_SESSION["loggedin"])){
    header("location: login.php");
    exit;
}

?>

<html lang="en">
	<head>
		<!-- Required meta tags -->
		<meta charset="utf-8">
		<link rel="stylesheet" href="navbar.css">
		<meta http-equiv="refresh" content="4; URL=mainpage.php">
        <meta charset="utf-8" name="viewport" content="width=device-width, initial-scale=1.0"/>
		<script src="jquery/jquery-3.6.0.min.js"></script>
		<title>Formular-Confirmation</title>
		<style>
          *{
          padding: 0;
          margin: 0;
          box-sizing: border-box;
          }
          body {
                background-image: url("images/mainzn.jpg");
                background-color: black;
                background-size: cover;
           }
          .row {
            background: white;
            border-radius: 30px;
            }
           img{
           border-top-left-radius: 30px;
           border-bottom-left-radius: 30px;
          </style>
	</head>
	<body>
	<header class="page-header">
		<section class="Form my-4 mx-5">
		<div class="container">
			<div class="row no-gutters">
				<div class="col-lg-7 px-2 pt-5">
				<h1> Vielen Dank! </h1>
				<img src="https://imgur.com/ptuLQV7.gif">
				<h4>Sie werden zur Startseite zurückgeleitet:</h4>
				<p>Falls Ihr Browser keine automatische Weiterleitung unterstützt, <a href="mainpage.php" >klicken Sie hier</a>!</p>
			</div>	
		</div>
	</section>
	</body>
</html>
