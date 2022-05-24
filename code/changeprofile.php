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
    require "config.php"; 


    $user_id =$_SESSION["id"];
 
    //When button is pressed look up values and change them
    if (isset($_POST["submit"])){
        $firstname = mysqli_real_escape_string($link, $_POST["firstname"]);
        $lastname = mysqli_real_escape_string($link, $_POST["lastname"]);
        $sex = $_POST['sexselect'];
        $drinks = $_POST['drinkselect'];
        $age = mysqli_real_escape_string($link, $_POST["age"]);
        $password = mysqli_real_escape_string($link, md5($_POST["firstname"]));  
        $image_data = mysqli_real_escape_string($link, file_get_contents($_FILES["image"]["tmp_name"]));

        
        

                $sql = "UPDATE users SET firstname='$firstname', lastname='$lastname', age='$age', sex='$sex', photo='$image_data', drinks='$drinks' WHERE id='$user_id'"; 
                $result = mysqli_query($link, $sql);
                 if ($result){
                    echo "<script>alert('Profil aktualisiert');</script>";
                    header("location: profile.php");
                    
                 } else{
                    echo "<script>alert('Fehler: Profil konnte nicht aktualisiert werden');</script>";
                 }
             
            
    }
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="profilestyle.css">
    <title>Profil Anpassen</title>
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
<br>

 

 
        <div class="container">
            <div class="row g-3">
                <div class="col-12 col-md-6 col-lg-6">
                <h2>Profil anpassen</h2>
        <form action="" method="POST" enctype="multipart/form-data">

            <?php
        
            $sql = "SELECT * FROM users WHERE id='$user_id'";
            $result = mysqli_query($link, $sql);
            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {

               
            
            ?>
            <div class="form-floating mb-3">
                 <input type="text" class="form-control" id="floatingInput" name="firstname" placeholder="Vorname" value="<?php echo $row['firstname']?>" required>
                <label for="floatingInput">Vorname</label>
            </div>
           
            <div class="form-floating mb-3">
                 <input type="text" class="form-control" id="lastname" name="lastname" placeholder="Vorname" value="<?php echo $row['lastname']?>" required>
                <label for="floatingInput">Nachname</label>
            </div>

            <div class="form-floating mb-3">
                 <input type="text" class="form-control" id="age" name="age" placeholder="Alter" value="<?php echo $row['age']?>" required>
                <label for="floatingInput">Alter</label>
            </div> 
             <!--
            <div class="form-floating mb-3">
                 <input type="text" class="form-control" id="email" name="email" placeholder="E-Mail" disabled value="<?php echo $row['email']?>" required>
                <label for="floatingInput">Email</label>
            </div>

            <div class="form-floating mb-3">
                 <input type="password" class="form-control" id="password" name="password" placeholder="Password" disabled value="<?php echo $row['password']?>" required>
                <label for="floatingInput">Password</label>
            </div>
                -->
            
            
        
            <select class="form-select" name="sexselect" id="id_select">
                <option value=""> Mein Geschlecht:</option>
                <option value="m"> männlich</option>
                <option value="w"> weiblich</option>
                <option value="d"> divers</option>
                
            </select>
            aktuell hinterlegt:
            <b><?php
               $sexchar = $row['sex'];
               if ($sexchar == "m"){
                echo "männlich";}
               elseif ($sexchar == "w"){
                echo "weiblich";}
                elseif ($sexchar == "d"){
                    echo "divers";}
               else {
                echo "Keine Angabe";
                     };
            ?></b>

            <br>
            <br>
            <select class="form-select" name="drinkselect">
                     <option value= "">Auf Partys trinke ich:</option>
                     <option value="1">Bier</option>
                     <option value="2">Wein</option>
                     <option value="3">Sekt</option>
                     <option value="4">Schnaps</option>
                     <option value="5">Kein Alkohol</option>
                    </select> 
            aktuell hinterlegt:
            <b><?php
            $drinktyp = $row['drinks'];
            if ($drinktyp == "1"){echo "Bier";}
            elseif($drinktyp == "2"){echo "Wein";}
            elseif($drinktyp == "3"){echo "Sekt";} 
            elseif($drinktyp == "4"){echo "Schnaps";}
            elseif($drinktyp == "5"){echo "Kein Alkohol";}
            else {echo "Keine Angabe";} ?>
            </b>
            <br>
            Profilbild:
            <br>
            
			<?php
			if ($row['photo'] === null){echo '<img src="images/noprofile.png" width=100px height= 100px>';}
			else {
             echo '<img src="data:image/jpeg;base64,'.base64_encode($row['photo']).'" width = 100px height= 100px>';
            }
			}
			}
			?>
        
            <br>
            <div class ="inputBox">
                <input type="file" accept="image/*" id="image" name="image" required>
            </div>
            <br>
          
            <button type="submit" name="submit" class="btn btn-danger">Profil aktualisieren</button>




            <a href="profile.php" class="btn btn-danger">Zurück</a>  

            
        </div>
        
        </div>
        </div>
           
        
    </div>  

    <script src="bootstrap-5.1.3-dist/js/bootstrap.bundle.min.js"> </script>
</body>
</html>
