<?php

// Initialize the session
session_start();

// Check if the user is already logged in, if yes then redirect him to welcome page
if(!isset($_SESSION["loggedin"])){
    header("location: login.php");
    exit;
}

?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Vergangene Partys</title>
    <link rel="stylesheet" href="navbar.css">
    <link rel="stylesheet" href="style.css">

    <style>
             *{
                  padding: 0;
                  margin: 0;
                  box-sizing: border-box;
                  }
             body {
                    background-image: url("images/AdobeStock_311704294.jpeg");
                    background-size:cover;
                    background-repeat: no-repeat;
                    background-attachment: fixed;
                    overflow: scroll;
                    padding: 0;
                    margin: 0;
                    }
             .row {
                    background: white;
                    border-radius: 30px;
                    }
       
               

        </style>
  </head>
  <body>
    <?php
      //include navbar
      include "navbar.php"
  ?>

   <?php
           $user_id =  $_SESSION["id"];
           require_once "config.php";
            //look up date from today
           date_default_timezone_set("Europe/Berlin");
           $timestamp = time();
           $datum = date("Y-m-d",$timestamp);
           

            //prepare SQL-Statement
                $sql = "
                SELECT * 
                FROM application, users, party
                WHERE party.date <'$datum' 
                AND party.user_id = users.id 
                AND application.party_id = party.id 
                AND application.user_id = '$user_id'
                AND application.status = 'akzeptiert'
                GROUP BY application.user_id 
                ORDER BY date
                ";

                /*
                SELECT * 
                FROM application, users, party
                WHERE party.date <'$datum' 
                AND party.user_id = users.id 
                AND application.party_id = party.id 
                AND application.user_id = '$user_id'
                AND application.status = 'akzeptiert'
                ORDER BY date */


                   $result = $link->query($sql)
                       or die($link->error);

                   echo "<div class='container'>";
                                       echo "<div class='row-fluid'>";

                                           echo "<div class='col-xs-6'>";


                                               if ($result->num_rows > 0) {
                                                   // output data of each row
                                                   while($row = $result->fetch_assoc()) {
                                                    $name = $row['name'];
                                                    $date = $row['date'];
                                                    $photo = $row['photo'];
                                                    $description = $row['description'];
                                                     echo "<div class='card cardx'>";
                                                     if ($row['photo'] === null)
                                                     {
                                                     echo "<img clas='card-img-top top3' src='images/firework3.jpg' width = 515px height= 345px>";
                                                     }
                                                     else {
                                                     //echo" <img class='card-img-top top3' src='images/firework4.jpg'>";
                                                    //echo '<img src="data:image/jpeg;base64,'.base64_encode($row['photo']).'">';
                                                    echo '<img src="data:image/jpeg;base64,'.base64_encode($row['photo']).'"width = 515px height= 345px>';
                                                     }
                                                         echo "<div class='card-header'> Wasgehtab</div>";
                                                     echo "<div class='card-body'>";
                                                       echo "<h5 class='card-title'>". $row["name"] . "</h5>";
                                                       echo "<p class='card-text'>Wann? ". $row["date"] . "</p>";
                                                       echo "<p class='card-text'>Uhrzeit? ". $row["time"] . "</p>";
                                                       echo "<p class='card-text'>Beschreibung? ". $row["description"] . "</p>";
                                                       echo "<p class='card-text'>Wo? ". $row["district"] . " Mainz</p>";
                                                       echo "<p class='card-text'>Wie viele Teilnehmer? ". $row["participants"] . "</p>";
                                                        echo "<td><a href='show_pastparties_rating.php?uid=". $row["user_id"]."&pid=".$row["party_id"]."'class='btn btn-danger'> Hostbewertung abgeben </a></td>";
                                                     echo "</div>";
                                                   echo "</div>";

                                                   }
                                               } else {
                                                   include "no_partysbygone.html";
                                               }
                                           echo "</div>";
                                           echo "</div>";

                                       echo "</div>";

                                   echo "</div>";


                                              
                                              

               ?>


<script src="bootstrap-5.1.3-dist/js/bootstrap.bundle.min.js"> </script>

  </body>
  
</html>
</html>
