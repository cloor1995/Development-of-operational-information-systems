<?php
// Initialize the session
session_start();

// Check if the user is already logged in, if yes then redirect him to welcome page
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    header("location: entry.php");
    exit;
}

// Include config file
require_once "config.php";

// Define variables and initialize with empty values
$email = $password = "";
$email_err = $password_err = $login_err = "";

// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){

    // Check if username is empty
    if(empty(trim($_POST["email"]))){
        $email_err = "Please enter a Email.";
    } else{
        $email = trim($_POST["email"]);
    }

    // Check if password is empty
    if(empty(trim($_POST["password"]))){
        $password_err = "Please enter your password.";
    } else{
        $password = trim($_POST["password"]);
    }

    // Validate credentials
    if(empty($email_err) && empty($password_err)){
        // Prepare a select statement
        $sql = "
        SELECT id, email, password 
        FROM users 
        WHERE email = ?
        ";

        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_email);

            // Set parameters
            $param_email = $email;

            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Store result
                mysqli_stmt_store_result($stmt);

                // Check if username exists, if yes then verify password
                if(mysqli_stmt_num_rows($stmt) == 1){
                    // Bind result variables
                    mysqli_stmt_bind_result($stmt, $id, $email, $hashed_password);
                    if(mysqli_stmt_fetch($stmt)){
                        if(password_verify($password, $hashed_password)){
                            // Password is correct, so start a new session
                            session_start();

                            // Store data in session variables
                            $_SESSION["loggedin"] = true;
                            $_SESSION["id"] = $id;
                            $_SESSION["email"] = $email;

                            // Redirect user to welcome page
                            header("location: entry.php");
                        } else{
                            // Password is not valid, display a generic error message
                            $login_err = "Falsches Passwort oder falsche Email-Adresse";
                        }
                    }
                } else{
                    // Username doesn't exist, display a generic error message
                    $login_err = "Falsches Passwort oder falsche Email-Adresse";
                }
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




<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" id="popup">
<section class="Form my-4 mx-5">
         <div class="container p-3 bg-white text-dark">
             <div class="row no-gutters">
                 <div class="col-lg-7 px-2 pt-2">
                     <h1 class="font-weight-bold py-1"> Was geht?</h1>
                    <h4> Melde dich jetzt an und lege sofort los!</h4>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                    <div class="wrapper">
                        <?php
                            if(!empty($login_err)){
                                echo '<div class="alert alert-danger">' . $login_err . '</div>';
                    }
                    ?>
                     </div>
                </div>
                     <br>
                     <div class="row">
                        <div class="col-lg-7">
                            <label>Email-Addresse</label>
                                <input type="text" name="email" class="form-control <?php echo (!empty(email_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $email; ?>">
                                <span class="invalid-feedback"><?php echo $email_err; ?></span>
                        </div>
                        </div>
                        <div class="row">
                        <div class="col-lg-7">
                            <label>Passwort</label>
                                <input type="password" name="password" class="form-control <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>">
                                <span class="invalid-feedback"><?php echo $password_err; ?></span>
                        </div>
                        </div>
                        <div class="row">
                        <div class="col-lg-7 pt-2">
                            <input type="submit" class="btn btn-danger my-2 p-2" value="Login">
                        </div>
                        </div>
                        <div class="row">
                        <div class="col-lg-7 pt-2">
                            <p>Du hast noch keinen Account? Dann wird's aber Zeit! <a href="register.php"> Jetzt registrieren</a>.</p>
                         </div>
                         </div>
                         <p>  <a href="mainpage.php"> Hier geht es zurück</a></p>
                    </form>
            </div>
        </div>
    </section>
</body>
</html>