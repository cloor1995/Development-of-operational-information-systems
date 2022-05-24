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



              $user_id =  $_SESSION["id"];
                require_once "config.php";
                $sql = "
                SELECT *
                FROM party, users, application
                WHERE party.user_id = users.id 
                AND application.party_id = party.id 
                AND application.user_id = '$user_id'
                AND application.status = 'ausstehend'
                ";
                
                $result = $link->query($sql);

                if ($result-> num_rows > 0) {
                  // output data of each row
                echo "<div class='container'>";
                    echo "<div class='row-fluid'>";

                        echo "<div class='col-xs-6'>";
                        echo "<div class='table-responsive'>";

                            echo "<table class='table table-hover table-inverse'>";

                            echo "<tr>";
                            echo "<th>Party</th>";
                            echo "<th>Host</th>";
                            echo "<th>Beschreibung</th>";
                            echo "<th>Bewerbungstext</th>";
                            echo "<th>Stadtteil</th>";
                            echo "<th>Datum</th>";
                            echo "<th>Uhrzeit</th>";
                            echo "<th>Teilnehmeranzahl</th>";
                            echo "</tr>";


                                // output data of each row
                                while($row = $result->fetch_assoc()) {
                                    echo "<tr>";
                                    echo "<td>" . $row["name"] . "</td>";
                                    echo "<td>" . $row["firstname"] . "</td>";
                                    echo "<td>" . $row["description"] . "</td>";
                                    echo "<td>" . $row["text"] . "</td>";
                                    echo "<td>" . $row["district"] . "</td>";
                                    echo "<td>" . $row["date"] . "</td>";
                                    echo "<td>" . $row["time"] . "</td>";
                                    echo "<td>" . $row["participants"] . "</td>";
                      
                                    
                                    echo "<td><a href='delete_application.php?id=" . $row["id"] . "'>Bewerbung zurückziehen</a></td>";
                                    echo "</tr>";
                                }


                            echo "</table>";

                        echo "</div>";
                        echo "</div>";

                    echo "</div>";

                echo "</div>";
                } else {
                 include "no_applications.html";
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

