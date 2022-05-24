<?php

// Initialize the session
session_start();



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
                background-image: url("images/mainzn.jpg");
                    background-size:cover;
                    }
            h1 {
                color: white;
                font-size: 50px;
                font-weight:300;
              }    
                p {
                color: white;
                font-size: 15px;
                font-weight:300;
              }        
        </style>
</head>
<body>


<?php
    //include navbar
    include "navbar.php" 
?>

<div class="container-fluid" id="aboutus">
    <div class="row">
        <div class="col-12 col-md-6 col-lg-5">
        <video  width="500" height="600" controls autoplay>
        <source src="images/review.mp4" type="video/mp4"></source>
        </video>
         
    </div>   
        <div class="col-12 col-md-6 col-lg-2">
        
    </div> 
        <div class="col-12 col-md-6 col-lg-5"><br>
           <h1>Über Uns </h1>
           <hr>
           <p  class="paragraph">
            Hallo wir, Chris, Philipp, Sebastian & Timo, sind 4 Studenten von der JGU in Mainz. Mit <b>Wasgehtab</b> möchten wir das Partyleben wieder beleben.<br><br>
            Die CoronaPandemie hat das studentische Leben drastisch verändert. Während man davor in den Uniräumen sich mit anderen Studenten treffen und connecten konnte,
            läuft derzeit alles nur noch online ab. Die persönlichen Kontakte gehen dabei verloren.
            Aber auch außerhalb der Uni: sei es beim Sport, der abendliche Kneipenbesuch oder auch bei größeren Festen müssen Einschränkungen hingenommen werden.
            Insbesondere das <b>Partyleben</b> ist eingschlafen.<br>
            
            Mit <b>Wasgehtab</b> möchten wir das Partyleben in den Coronazeiten wiederbeleben. 
            Unser Ziel ist es, Studenten aber auch nicht Stundenten, zu verbinden und legendäre Partys zu erleben. <br><br>

            Also: Schau dich auf dieser Seite um, feier mit uns und freu dich auf die geilsten Partys deines Lebens.
            <br><br>
            
            
            LG<br>
            Chris, Philipp, Sebastian & Timo
            
           </p>    
        </div>  
</div>
</div>   
</div>
<br>
<br>
<br>
<div class="row justify-content-center align-items-center"> <p class="h1 text-center">Team</p><br><br>
            </div>
<div class="row justify-content-center align-items-center">
<div class="card05" style="width: 18rem;">
  <img class="card-img-top" src="images/loor.JPG" alt="Card image cap" height="300px" width="500px">
  <div class="card-body">
    <p class="card-text">Christian Loor<br> 2. Semester Management</p>
  </div>
</div>
<div class="card05" style="width: 18rem;">
  <img class="card-img-top" src="images/PA.jpg" alt="Card image cap" height="300px" width="500px">
  <div class="card-body">
  <p class="card-text">Philipp Anthes<br> 2. Semester Management</p>
  </div>
</div>
<div class="card05" style="width: 18rem;">
  <img class="card-img-top" src="images/may.jpg" alt="Card image cap" height="300px" width="500px">
  <div class="card-body">
  <p class="card-text">Sebastian May<br> 2. Semester Management</p>
  </div>
</div>
<div class="card05" style="width: 18rem;">
  <img class="card-img-top" src="images/TL.jpg" alt="Card image cap" height="300px" width="500px">
  <div class="card-body">
  <p class="card-text">Timo Liese<br> 1. Semester wis. Informatik</p>
  </div>
  </div>
  <br>
<br>





<script src="script.js"></script>
<script src="bootstrap-5.1.3-dist/js/bootstrap.bundle.min.js"> </script>
</body>
</html>