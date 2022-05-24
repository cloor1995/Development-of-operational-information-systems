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
    <title>Party anfragen</title>
    <link rel="stylesheet" href="navbar.css">
  </head>
  <body>



  <?php
    //include navbar
    include "navbar.php"
?>
    <div class="container-fluid">
<!---------------- Mittelteil --------->
          <div class="col">
              <?php

            
             
             $user_id = $_SESSION["id"];
             $party_id = $_SESSION["PARTYID"];
             
             
             $timestamp = time();
             $datum = date("Y-m-d",$timestamp);
             
 

                              require_once "config.php";
                              $sql = "
                              SELECT DISTINCT *
                              FROM party, users, application
                              WHERE party.id = '$party_id'
                              AND party.user_id = '$user_id' 
                              AND application.status = 'akzeptiert'
                              AND application.user_id = users.id
                              AND application.party_id = party.id
                              GROUP BY application.user_id
                              ";


                              $result = $link->query($sql);

                if ($result->num_rows > 0) {
                echo "<div class='container'>";
                    echo "<div class='row-fluid'>";

                        echo "<div class='col-xs-6'>";
                        echo "<div class='table-responsive'>";

                            echo "<table class='table table-hover table-inverse'>";

                            echo "<tr>";
                            echo "<th>Party</th>";
                            echo "<th>Vorname</th>";
                            echo "<th>Nachname</th>";
                            echo "<th>Bewerbungstext</th>";
                            echo "<th>Datum</th>";
                            echo "<th>Uhrzeit</th>";
                            echo "<th>Teilnehmeranzahl</th>";
                            echo "<th>Gäste</th>";
                            echo "</tr>";


                                // output data of each row
                                while($row = $result->fetch_assoc()) {

                                    echo "<tr>";
                                    echo "<td>" . $row["name"] . "</td>";
                                    echo "<td>" . $row["firstname"] . "</td>";
                                    echo "<td>" . $row["lastname"] . "</td>";
                                    echo "<td>" . $row["text"] . "</td>";
                                    echo "<td>" . $row["date"] . "</td>";
                                    echo "<td>" . $row["time"] . "</td>";
                                    echo "<td>" . $row["participants"] . "</td>";
                                    echo "<td><a href='show_guest_rating.php?uid=". $row["user_id"]."&pid=".$party_id."'> Bewerten </a></td>";
                                    echo "</tr>";
                                }

                            echo "</table>";

                        echo "</div>";
                        echo "<td><a href='show_myparties_bygone.php'class='btn btn-danger'>Zurück zu vergangenen Partys </a></td>";

                        echo "</div>";

                    echo "</div>";

                echo "</div>";
                }  else {
                include "no_records.html";

                 }
                // Close connection
                mysqli_close($link);
                ?>
        </div>
        </div>
      </div>


<script src="bootstrap-5.1.3-dist/js/bootstrap.bundle.min.js"> </script>
  </body>
</html>

