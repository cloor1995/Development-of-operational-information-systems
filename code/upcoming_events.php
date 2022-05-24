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
    <title>Profile</title>
    <link rel="stylesheet" href="navbar.css">
    <link rel="stylesheet" href="style.css"> 
     <style>
                 *{
                      padding: 0;
                      margin: 0;
                      box-sizing: border-box;
                      }
                 body {
                    background-image: url("images/mainzn.jpg");
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
              $timestamp = time();
              $datum = date("Y-m-d",$timestamp);
                require_once "config.php";
                $sql = "
                SELECT DISTINCT name, description,status, text, district, date, time, participants, party.photo, application.id, users.firstname, users.email 
                FROM application, party, users 
                WHERE party.user_id = users.id 
                AND application.party_id = party.id 
                AND application.user_id='$user_id' 
                AND application.status = 'akzeptiert'
                AND date>='$datum'  
                GROUP BY name
                ";
                $result = $link->query($sql)
                                      or die($link->error);
                                  if ($result->num_rows > 0) {

                                  echo "<div class='container'>";
                                                      echo "<div class='row-fluid'>";
                                                          echo "<div class='col-xs-6'>";
                                                                  // output data of each row
                                                                  while($row = $result->fetch_assoc()) {
                                                                    $name = $row['name'];
                                                                    $date = $row['date'];
                                                                    $status = $row['status'];
                                                                    $photo = $row['photo'];
                                                                     $description = $row['description'];
                                                                     echo "<div class='card cardx'>";
                                                                     if ($row['photo'] === null)
                                                                     {
                                                                     echo "<img clas='card-img-top top3' src='images/firework3.jpg'>";
                                                                     }
                                                                     else {
                                                                     //echo" <img class='card-img-top top3' src='images/firework4.jpg'>";
                                                                    echo '<img src="data:image/jpeg;base64,'.base64_encode($row['photo']).'"width = 515px height= 345px">';
                                                                     }
                                                                         echo "<div class='card-header'> Wasgehtab</div>";
                                                                     echo "<div class='card-body'>";
                                                                       echo "<h5 class='card-title'>". $row["name"] . "</h5>";
                                                                       $name = $row["firstname"];
                                                                       $pname = $row["name"];
                                                                       echo "<p class='card-text'>Wann? ". $row["date"] . "</p>";
                                                                       echo "<p class='card-text'>Uhrzeit? ". $row["time"] . "</p>";
                                                                       echo "<p class='card-text'>Beschreibung? ". $row["description"] . "</p>";
                                                                       echo "<p class='card-text'>Wo? ". $row["district"] . " Mainz</p>";
                                                                       echo "<p class='card-text'>Wie viele Teilnehmer? ". $row["participants"] . "</p>";
                                                                       echo "<td><a href='mailto:". $row["email"] ."?subject=Deine%20Party%20auf%20wasgehtab:%20$pname&body=Hi%20$name,%0D%0A%0D%0Aich%20habe%20noch%20eine%20Frage%20zu%20deiner%20Party:'>Jetzt Kontakt aufnehmen</a></td>";
                                                                     echo "</div>";
                                                                   echo "</div>";

                                                                   }

                                                           echo "</div>";
                                                           echo "</div>";

                                                       echo "</div>";

                                                   echo "</div>";
                                                } else {
                                                    include "no_matches.html";
                                                 }



                               ?>

                    <script src="bootstrap-5.1.3-dist/js/bootstrap.bundle.min.js"> </script>
                  </body>
                </html>


