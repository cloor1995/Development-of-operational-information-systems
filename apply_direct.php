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


require_once "config.php";

// Define variables and initialize with empty values
$text = "";
$text_err = "";

// Processing form data when form is submitted
$user_id =  $_SESSION["id"];
$party_id = $_GET["pid"];

//get partyname from the party_id 
    $sql = "SELECT * FROM party WHERE id='$party_id'";
    $ergebnis = $link->query($sql)
            or die($link->error);    

    WHILE ($row = $ergebnis->fetch_assoc()){
                $partyname = $row['name'];
                $partyhost = $row['user_id'];
            }

//get username from the user_id 
$sql = "SELECT * FROM users WHERE id='$partyhost'";
$ergebnis = $link->query($sql)
        or die($link->error);    

WHILE ($row = $ergebnis->fetch_assoc()){
            $firstname = $row['firstname'];
            $lastname = $row['lastname'];
        }


if($_SERVER["REQUEST_METHOD"] == "POST"){

	// Validate text
    if(empty(trim($_POST["text"]))){
		$text_err = "Bitte schreibe eine Nachricht";
	} else{
		$text = trim($_POST["text"]);
	}


    $pid = trim($_POST["pid"]);


    // Check input errors before inserting in database
    if(empty($district_err) && empty($text_err)){
     // Prepare an insert statement
     $sql = "INSERT INTO application (text,user_id,party_id, status) VALUES (?, ?, ?, ?)";

        if($stmt = mysqli_prepare($link, $sql)){

			// Set parameters
            $param_text = $text;
			$param_user_id = $user_id;
			$param_party_id = $pid;
			$param_status = "ausstehend";

            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "siis", $param_text, $param_user_id, $param_party_id, $param_status);


            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Redirect to start page
                header("location: formular_confirmation.php");
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            mysqli_stmt_close($stmt);

        }
    }
    // Close connection
    mysqli_close($link);
}
?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="navbar.css">
    <title>Bewerbung</title>
      <style>
          *{
          padding: 0;
          margin: 0;
          box-sizing: border-box;
          }
          body {
            background-image: url("images/bar.jpg");
                    background-size:cover;
            }
          .container{
           border-top-left-radius: 30px;
           border-bottom-left-radius: 30px;
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
    <section class="Form my-4 mx-4">
        <div class="container ">
                <div class="col px-2 pt-3 ">
                    <h2> Bewerbe dich jetzt auf die Party "<?php echo "$partyname"?>" von <?php echo "$firstname $lastname"?></h2>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                    <input type = "hidden" name = "pid" value="<?php echo $party_id; ?>">
                </div>
		        <div class="col-xs-4">
                        <label>Bewerbungstext</label>
                        <span class="invalid-feedback"><?php echo $text_err; ?></span>
						<input type="textarea" rows="3" name="text" class="form-control" >
				</div>
                <div class="form-row">
                        <input type="submit" class="btn btn-danger my-2 p-2" value="Bestätigen">
                        <input type="reset" class="btn btn-secondary ml-2 p-2" value="Zurücksetzen">
                </div>
                    </form>
                <button onclick="window.location.href = 'mainpage.php';" class = "btn btn-danger">Zurück zur Startseite</button>
                </div>
            </div>
        </div>
    </section>
  </body>
  <script src="bootstrap-5.1.3-dist/js/bootstrap.bundle.min.js"> </script>
</html>