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
              $party_id = $_GET["pid"];
              $user_id =  $_SESSION["id"];
                              require_once "config.php";
                              $sql = "SELECT *
                              FROM application, party, users
                              WHERE WHERE party_id='$party_id'
                              AND application.party_id = party.id
                              AND application.user_id = users.id
                              AND party.user_id='$user_id'
                              AND application.status = 'ausstehend'
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
                            echo "<th>Bewerber</th>";
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
                                    echo "<td><a href='lookupprofilerequest.php?uid=". $row["user_id"]."&pid=".$row["id"]."'>Profil anschauen </a></td>";
                                    echo "<td><a href='accept_request.php?id=" . $row['id'] . "'>Annehmen</a></td>";
                                    echo "<td><a href='decline_request.php?id=" . $row["id"] .  "'>Ablehnen</a></td>";
                                    echo "</tr>";
                                }

                            echo "</table>";

                        echo "</div>";
                        echo "</div>";

                    echo "</div>";

                echo "</div>";
                } else {
                include "no_records.html";

                 }
                // Close connection
                mysqli_close($link);
                ?>
        </div>
        </div>
      </div>

    <div class="footer">
        <p>Copyright 2021 - Wasgehtab</p>
    </div>
<script src="bootstrap-5.1.3-dist/js/bootstrap.bundle.min.js"> </script>
  </body>
</html>

