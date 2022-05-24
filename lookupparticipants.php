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
    //include config
    include "config.php"
?>


<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Profile page</title>
    <link rel="stylesheet" href="navbar.css">
         <link rel="stylesheet" href="table.css">
</head>
<body>


<?php
    //include navbar
    include "navbar.php"
?>
   <?php
$_SESSION["USERID"] = $_GET["uid"];
$_SESSION["PARTYID"] = $_GET["pid"];
$user_id = $_SESSION["id"];
$USER_ID = $_SESSION["USERID"];
$party_id = $_SESSION["PARTYID"];

        $sql = "
        SELECT * FROM 
        application, users 
        WHERE party_id='$party_id' 
        AND user_id = users.id 
        AND application.status ='akzeptiert'";


                   $result = $link->query($sql)
                       or die($link->error);
                       if ($result->num_rows > 0) {
                   

                   echo "<div class='container'>";
                                       echo "<div class='row-fluid'>";

                                           echo "<div class='col-xs-6'>";
                                           echo "<div class='table-responsive'>";

                                               echo "<table class='table table5 table-hover table-inverse'>";
                                               echo "<thead class='tablehead thead-dark'>";

                                               echo "<tr>";
                                               echo "<th>Vorname</th>";
                                               echo "<th>Nachname</th>";
                                               echo "<th>Alter</th>";
                                               echo "<th>Text</th>";
                                               echo "<th>Profil</th>";
                                               echo "</tr>";



                                                     // output data of each row
                                                        while($row = $result->fetch_assoc()) {
                                                       echo "<tr>";
                                                       echo "<td>" . $row["firstname"] . "</td>";
                                                       echo "<td>" . $row["lastname"] . "</td>";
                                                       $name = $row["firstname"];
                                                       echo "<td>" . $row["age"] . "</td>";
                                                       echo "<td>" . $row["text"] . "</td>";
                                                       echo "<td><a href='lookupprofile_participants.php?uid=". $row["user_id"]."&pid=".$party_id."'class=' btn-'>Profil anschauen </a></td>";
                                                       echo "<td><a href='mailto:". $row["email"] ."?subject=Einladung%20wasgehtab%20Party&body=Hi%20$name%0D%0A%0D%0Aich%20freue%20mich%20dass%20du%20zu%20meiner%20Party%20kommst.%0D%0A%0D%0AHier%20die%20Details:'>Jetzt Kontakt aufnehmen</a></td>";
                                                       echo "</tr>";
                                                   }

                                                echo "</thead>";
                                               echo "</table>";

                                           echo "</div>";
                                           echo "</div>";

                                       echo "</div>";

                                   echo "</div>";
                     } else {
                       include "no_participants.html";
                        }

               ?>
<script src="bootstrap-5.1.3-dist/js/bootstrap.bundle.min.js"> </script>

</body>
</html>