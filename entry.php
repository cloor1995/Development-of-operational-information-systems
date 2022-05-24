<?php
// Initialize the session
session_start();

// Check if the user is logged in, if not then redirect him to login page
if(isset($_SESSION["loggedin"])){
    header("location: mainpage.php"); //geändert davor stand hier: "location: Wasgehtab/index.html" /Seb
    exit;
}
/*
echo htmlspecialchars($_SESSION["email"])
*/
?>

<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="utf-8"/>
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" type="text/css" href="index.css"/>
    <title>Wasgehtab</title>
    <script src="jquery/jquery-3.6.0.min.js"></script>
</head>
<body>
   <header class="page-header">
   <div class="container">

  <div class="jumbotron header-jumbotron text-center d-flex flex-column" >
    <h2 class="my-5">Hi, Mainz. Was geht heute Abend? </h2>
    <h1 class="display-5">Suche oder veranstalte jetzt deine Party</h1>
    <hr class="my-4">
    <p class="lead">
      <a class="btn btn-primary button1 btn-lg" href="login.php" role="button" id="buttonlosgehts">Los Gehts</a>
      <script>
        $("#buttonlosgehts").click(function()
        {
          alert("Klappt noch nicht")
        });
      </script>
    </p>
  </div>
</div>
</header>
</body>
</html>

