<?php


// Initialize the session
session_start();

if(!isset($_SESSION["loggedin"])){
    header("location: login.php");
    exit;
}

?>


<?php




// Include config file
require_once "config.php"; 



// Processing form data when form is submitted
$user_id =  $_SESSION["id"];
 
// Define variables and initialize with empty values
$district = $date = $time = $description = $participants = $photo = $name = "";
$district_err = $date_err = $time_err = $description_err  = $participants_err = $photo_err = $name_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 	
	// Validate district
    /*if(empty(trim($_POST["district"]))){
		$district_err = "Please enter the district of the event.";
	} else{*/
		$district = trim($_POST["district"]);
	//}

	// Validate district
        if(empty(trim($_POST["name"]))){
    		$name_err = "Please enter the name of the event.";
    	} else{
    		$name = trim($_POST["name"]);
    	}

    // Validate date
    if(empty(trim($_POST["date"]))){
		$date_err = "Please enter a date.";
	} else{
		$date = trim($_POST["date"]);
	}
	// Validate time
    if(empty(trim($_POST["time"]))){
		$time_err = "Please choose a start.";
	} else{
		$time = trim($_POST["time"]);
	}
	
	// Validate description
    if(empty(trim($_POST["description"]))){
		$description_err = "Please enter an description of the event.";
	} else{
		$description = trim($_POST["description"]);
	}
	
	// Validate participants
    if(empty(trim($_POST["participants"]))){
		$participants_err = "Please choose a amount of participants.";
	} else{
		$participants = trim($_POST["participants"]);
	}

		
    $photo = file_get_contents($_FILES["image"]["tmp_name"]);
    // Check input errors before inserting in database
    if(empty($district_err) && 
	empty($date_err) &&
	empty($time_err) &&
	empty($description_err) &&
	empty($participants_err)&&
	empty($photo_err)
	){
     // Prepare an insert statement
     $sql = "INSERT INTO party (name, district, date, time, description, participants, photo, user_id) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
         
        if($stmt = mysqli_prepare($link, $sql)){
			
			// Set parameters
            $param_district = $district;
			$param_date = $date;
			$param_time = $time;
			$param_description = $description;
			$param_participants = $participants;
			$param_user_id = $user_id;
			$param_name = $name;
			$param_photo = $photo;
			
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "ssssssss",$name, $param_district, $param_date, $param_time, $param_description, $param_participants, $param_photo, $param_user_id);
           
            
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

<?php
     //include navbar
     include "navbar.php"
 ?>

<!doctype html>
<html lang="de">
  <head>
    <!-- Required meta tags -->
    <title>Create your own Party</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="navbar.css">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
	<script src="jquery/jquery-3.6.0.min.js"></script>
    
  </head>
  <style>
  body {
     background-image: url("images/mainzn.jpg");
     background-size: cover;
     }

  .container{
    max-width: 970px;
    border-radius: 30px;
    }
</style>
 <body>

	<header class="page-header">
    <section class="Form my-4 mx-5">
        <div class="container p-3 my-1 bg-white text-dark">
            <div class="row no-gutters">
                <div class="col-lg-7 px-2 pt-5">
                    <h1 class="font-weight-bold py-1"> Noch nichts geplant? </h1>
                    </div>
                    <h2 > Erstelle hier deine eigene Party! </h2>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" enctype="multipart/form-data">

					<label > Wie heißt deine Party?</label>
                    <div class="input-group mb-3">
                    	<span class="input-group-text" id="basic-addon3">Name: <?php echo $district_err; ?></span>
                    	<input type="text" name="name" class="form-control" required <?php echo (!empty($district_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $name; ?>">
                    </div>
                        <label > Wo findet deine Party statt?</label>
					 <div class="input-group mb-3">
                    <span class="input-group-text" id="basic-addon3">Gebiet: <?php echo $district_err; ?></span>
					 <select class="form-select" name="district" id="id_select" required <?php echo (!empty($district_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $district; ?>">
                                    <option value=""><?php echo $district_err; ?></option>
                                    <option value="Neustadt"> Neustadt</option>
                                    <option value="Altstadt"> Altstadt</option>
                                    <option value="Rheinwiesen"> Rheinwiesen</option>
                                    <option value="Oberstadt"> Oberstadt</option>
                                    <option value="Bretzenheim"> Bretzenheim</option>
                                    <option value="Gonsenheim"> Gonsenheim</option>
                                    <option value="wo anders"> wo anders</option>
                                     </select>
                    </div>

					<label for="basic-url" class="form-label">Gib hier das gewünschte Datum ein:</label>
					<div class="input-group mb-3">
						<span class="input-group-text" id="basic-addon3">Wähle das Datum: <?php echo $date_err; ?></span>
						<input type="date" name="date" min="2021-10-01" class="form-control" id="basic-url" aria-describedby="basic-addon3" required <?php echo (!empty($date_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $date; ?>">
					</div>
					
					<label for="basic-url" class="form-label">Gib hier die gewünschte Uhrzeit ein:</label>
					<div class="input-group mb-3">
						<span class="input-group-text" id="basic-addon3">Wähle die Startzeit:   <?php echo $time_err; ?> </span>
						<input type="time" name="time" class="form-control  id="basic-url" aria-describedby="basic-addon3" required <?php echo (!empty($time_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $date; ?>">
					</div>
					
				
					<label for="basic-url" class="form-label">Gib hier eine kurze Beschreibung deiner Party an:</label>
					<div class="form-group">
						<span class="input-group-text">Partybeschreibung:<?php echo $description_err; ?></span> 
						<textarea name="description" type="text" placeholder="Ziehe das Feld mit der Maus nach unten für eine bessere Übersicht." class="form-control" required <?php echo (!empty($description_err)) ? 'is-invalid' : ''; ?>" value= "<?php echo $description; ?>"> </textarea>
					</div>
					
					<label for="basic-url" class="form-label">Wie viele Gäste dürfen maximal teilnehmen?</label>
					<div class="input-group mb-3">
						<span class="input-group-text" id="basic-addon3"> Anzahl der Teilnehmer: <?php echo $participants_err; ?></span>
						<input type="number" style="text-align:center" name="participants" min="0" max="10000" step="1" required <?php echo (!empty($participants_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $participants; ?>">
					</div>
					<label for="basic-url" class="form-label">Lade ein passendes Foto hoch(max 100KB)</label>
                    <div class="input-group mb-3">
                        <!--
                    <div class ="inputBox">
                                <input type="file" style="color: white;" id="image" name="image" accept="image/" required><?php echo (!empty($photo_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $photo; ?>">
                          </div> -->
                          <div class ="inputBox">
                                <input type="file"id="image" name="image" accept="image/*" required>
                          </div>

                    <div class="form-row">
                        <input type="submit" name="submit" class="btn btn-danger my-2 p-2" value="Bestätigen">
                        <input type="reset" class="btn btn-secondary ml-2 p-2" value="Reset">
                    </div>
                    </form>
                </div>
            </div>
        </div>
        
    </section>
    <script src="bootstrap-5.1.3-dist/js/bootstrap.bundle.min.js"> </script>
  </body>
</html>

