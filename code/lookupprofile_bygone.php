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
    <style>
             body {
                background-image: url("images/crowd2.jpg");
                    background-size:cover;
                
                    }  
        </style>
</head>
<body>

<?php
    //include navbar
    include "navbar.php" 
?>

<?php


?>

<!-- Data aus MariaDB --> 
<?php
        // Processing form data when form is submitted;
        $_SESSION["USERID"] = $_GET["uid"];
        $_SESSION["PARTYID"] = $_GET["pid"];
        $user_id = $_SESSION["id"];
        $USER_ID = $_SESSION["USERID"];
        $party_id = $_SESSION["PARTYID"];

        //Show Profile page, without E-Mail an permission to change something


        $sql = "
        SELECT *
        FROM users
        WHERE id = $USER_ID
        ";//Tabelle USER Abfragen    

        $ergebnis = $link->query($sql)
            or die($link->error);    

        WHILE ($row = $ergebnis->fetch_assoc()){
                $firstname = $row['firstname'];
                $lastname = $row['lastname'];
                $sexchar = $row['sex'];
                if ($sexchar == "m"){
                    $sex = "männlich";}
                    elseif ($sexchar == "w"){
                      $sex = "weiblich";}
                    elseif ($sexchar == "d"){
                        $sex = "divers";}
                    else {
                        $sex ="Keine Angabe";}
                
                $age = $row['age'];
                $email = $row['email'];
                $password = $row['password'];
                $drinks = $row['drinks'];
                $image = $row['photo'];
               // $avgrating = round($row['AVG(user_rating)'], 1);
              }
            
      /*     
        $sql2 = "
        SELECT *, AVG(user_rating)
        FROM users, userreviewed
        WHERE id = $USER_ID
        AND user_id = id
        GROUP BY user_id
        ";
        
        $ergebnis = $link->query($sql2)
            or die($link->error);
            
            if(isset($ergebnis)){

                WHILE ($row = $ergebnis->fetch_assoc())
            {
                $USERID = $row['user_id'];
                $avgrating = round($row['AVG(user_rating)'], 1);
            }
        }
          */
    
    ?>


<!-- Profilcards Design -->
<br>


<div class="container">
    <div class="row g-3">

    <div class="col-12 col-md-6 col-lg-4">
        <div class="card111">
        <img class="card-img-top" <?php
			if ($image === null){echo '<img src="images/noprofile.png" width = 200px height= 345px>';}
			else {
             echo '<img src="data:image/jpeg;base64,'.base64_encode($image).'" width = 200px height= 345px>';
            }
			?> 
        
        </div>   
    </div>
        <div class="col-12 col-md-6 col-lg-4">
            <div class="card111">
            <div class="card-body">
                <h5 class="card-title"><?php echo "$firstname $lastname"?> </h5>
                <hr>
                <p class="card-text"> Geschlecht: <?php echo "$sex"?></p>
                <p class="card-text"> Alter: <?php echo "$age"?> </p>
                <p class="card-text"> Mein Getränk:

                        <?php 
                        if ($drinks == "1"){echo "Bier";}
                        elseif($drinks == "2"){echo "Wein";}
                        elseif($drinks == "3"){echo "Sekt";} 
                        elseif($drinks == "4"){echo "Schnaps";}
                        else {echo "Kein Alkohol";} ?></p>
               <!-- <p class="card-text"> Gesamtbewertung: <?php// echo "$avgrating"?> von 5 Sternen</p> -->

               
                <?php
                ; 
                $sql2 = "
                SELECT id, name, district, date, time, description, participants, user_id 
                FROM party
                "; //code reuired to generate the individual user_id/party_id for the rating 
           
           $result = $link->query($sql2)
               or die($link->error);
   
               if ($result->num_rows > 0) {
                   if($row = $result->fetch_assoc()) {
                       if($user_id == $USER_ID){
                        echo "<br>";

                        echo "<td><a href='show_myhost_rating.php'class='btn btn-danger'> Meine Bewertungen ansehen </a></td>";
                    }
                       else
                       {
                        echo "<br>";

                        echo "<td><a href='show_userIDhost_rating.php?uid=" . $USER_ID ."&pid=" . $party_id ."'class='btn btn-danger'>Bewertungen </a></td>";
                       }
                    }
                } else {
                    echo "0 ratings";
                   }; 

                ?>
                <br>
                <br>
                <br>
                <?php echo "<td><a href='show_parties_bygone.php'class='btn btn-danger'>Zurück zu vergangene Partys </a></td>";?>
                <br>
                <br>

            </div>
            </div>
        </div>   
        <div class="col-12 col-md-6 col-lg-4">
            <div class="card111">
             <img class="card-img-top" <?php 
                        if ($drinks == "1"){$drinkimage= '<img src="images/beer.jpg" width = 200px height= 345px>';}
                        elseif($drinks == "2"){$drinkimage= '<img src="images/wine.jpg" width = 200px height= 345px>';}
                        elseif($drinks == "3"){$drinkimage= '<img src="images/sekt.jpg" width = 200px height= 345px">';}
                        elseif($drinks == "4"){$drinkimage= '<img src="images/schnaps.jpg" width = 200px height= 345px">';}
                        else {$drinkimage= '<img src="images/noalcohol.png" width = 200px height= 345px">';} 
			   ?>
			  
			<?php echo $drinkimage; ?>
           
            
            </div>   
    </div>

        </div>
<script src="script.js"></script>
<script src="bootstrap-5.1.3-dist/js/bootstrap.bundle.min.js"> </script>
</body>
</html>