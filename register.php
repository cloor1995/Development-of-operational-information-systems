<?php
// Include config file
require_once "config.php";
 
// Define variables and initialize with empty values
$email = $password = $confirm_password = $firstname = $lastname = "";
$email_err = $password_err = $confirm_password_err = $firstname_err = $lastname_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Validate email
    if(empty(trim($_POST["email"]))){
        $email_err = "Bitte gebe eine Email-Adresse ein.";
    } elseif(strlen(trim($_POST["email"])) < 6){
        $email_err = "Bitte benutze eine gültige Email-Adresse.";
    } else{
        // Prepare a select statement
        $sql = "SELECT id FROM users WHERE email = ?";
        
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_email);
            
            // Set parameters
            $param_email = trim($_POST["email"]);
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                /* store result */
                mysqli_stmt_store_result($stmt);
                
                if(mysqli_stmt_num_rows($stmt) == 1){
                    $email_err = "Diese Email-Adresse wird bereits verwendet.";
                } else{
                    $email = trim($_POST["email"]);
                }
            } else{
                echo "Ups!Da ist etwas schief gelaufen. Versuch's noch einmal.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }
    
    // Validate password
    if(empty(trim($_POST["password"]))){
        $password_err = "Bitte gebe ein Passwort ein.";
    } elseif(strlen(trim($_POST["password"])) < 6){
        $password_err = "Das Passwort muss aus mindestens 6 Zeichen bestehen.";
    } else{
        $password = trim($_POST["password"]);
    }

    // Validate firstname
    if(empty(trim($_POST["firstname"]))){
        $firstname_err = "Bitte gebe deinen Vornamen an.";
    } else{
        $firstname = trim($_POST["firstname"]);
    }
    // Validate lastname
    if(empty(trim($_POST["lastname"]))){
       $lastname_err = "Bitte gebe deinen Nachnamen an.";
    } else{
       $lastname = trim($_POST["lastname"]);
    }
    
    // Validate confirm password
    if(empty(trim($_POST["confirm_password"]))){
        $confirm_password_err = "Bitte bestätige dein Passwort.";
    } else{
        $confirm_password = trim($_POST["confirm_password"]);
        if(empty($password_err) && ($password != $confirm_password)){
            $confirm_password_err = "Die Passwörter stimmen nicht überein.";
        }
    }
    
    // Check input errors before inserting in database
    if(empty($email_err) && empty($password_err) && empty($confirm_password_err) && empty($firstname_err) && empty($lastname_err)){
        
        // Prepare an insert statement
        $sql = "INSERT INTO users (email, password, firstname, lastname) VALUES (?, ?, ?, ?)";
         
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "ssss", $param_email, $param_password, $firstname, $lastname);
            
            // Set parameters
            $param_email = $email;
            $param_password = password_hash($password, PASSWORD_DEFAULT); // Creates a password hash
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Redirect to login page
                header("location: login.php");
            } else{
                echo "Ups!Da ist etwas schief gelaufen. Versuch's noch einmal.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }
    
    // Close connection
    mysqli_close($link);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Login</title>
    <link rel="stylesheet" href="navbar.css">
    <meta charset="utf-8" name="viewport" content="width=device-width, initial-scale=1.0"/>
    <style>
         body {
                          background-image: url("images/mainzn.jpg");
                          background-color: black;
                          background-size: cover;
                         }
                      .firstrow{

                         }
                       h2 {
                         color: white;
                         font-size: 50px;
                         font-weight:300;
                       }

                       h3 {
                         color: white;
                         font-size: 30px;
                         font-weight:300;
                       }



                      .container{
                       max-width: 970px;
                       border-radius: 30px;
                             }

    </style>
</head>
  <body>
<br>
<br>
<br>
<br>

    <section class="Form my-4 mx-5">
        <div class="container p-3 bg-white text-dark">
            <div class="row no-gutters">
                <div class="col-lg-7 px-2 pt-2">
                    <h1 class="font-weight-bold py-1"> Was geht?</h1>
                    <h4> Registriere dich jetzt und lege sofort los!</h4>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                    <div class="form-row">
                        <div class="col">
                            <label>Vorname</label>
                            <input type="text" name="firstname" placeholder="Max" class="form-control <?php echo (!empty($firstname_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $firstname; ?>">
                            <span class="invalid-feedback"><?php echo $firstname_err; ?></span>
                        </div>

                        <div class="col">
                            <label>Nachname</label>
                            <input type="text" name="lastname" placeholder="Mustermann" class="form-control <?php echo (!empty($lastname_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $lastname; ?>">
                            <span class="invalid-feedback"><?php echo $lastname_err; ?></span>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-lg-7">
                            <label>Email-Addresse</label>
                            <input type="text" name="email" placeholder="example@example.com" class="form-control <?php echo (!empty($email_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $email; ?>">
                            <span class="invalid-feedback"><?php echo $email_err; ?></span>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="col">
                            <label>Passwort</label>
                            <input type="password" placeholder="********" name="password" class="form-control my-1 p-2 <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $password; ?>">
                            <span class="invalid-feedback"><?php echo $password_err; ?></span>
                        </div>

                        <div class="col">
                            <label>Passwort bestätigen</label>
                            <input type="password" placeholder="********" name="confirm_password" class="form-control <?php echo (!empty($confirm_password_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $confirm_password; ?>">
                            <span class="invalid-feedback"><?php echo $confirm_password_err; ?></span>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-lg-7">
                        <input type="submit" class="btn btn-danger my-2" value="Bestätigen">
                        <input type="reset" class="btn btn-secondary my-2" value="Reset">
                    </div>
                    </div>
                    <p>Du hast bereits einen Account? <a href="login.php"> Anmelden</a>.</p>
                    <p>  <a href="mainpage.php"> Hier geht es zurück</a></p>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    -->
  </body>
</html>
