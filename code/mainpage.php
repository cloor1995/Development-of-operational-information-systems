<?php

// Initialize the session
session_start();

?>


<?php
    //include config
    require "config.php"; 
?>

<DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Was geht ab</title>
    <link rel="stylesheet" href="navbar.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
    <style>
             body {
                    background-color: black;
                    }
             .firstrow{
               background: white;
               border-radius: 30px;
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
              .first{
                    background-image: url("images/mainzn.jpg");
                    background-size:cover;
                
                    }
             .container{
                     max-width: 970px;
                    }
              .br {
                margin-bottom: 10em
              }

              .font2{
              font-weight: 600;
              }
        </style>
    
   
</head>

<body>
<?php
    //include navbar
    include "navbar.php" 
?>

<!-- Build up first Form to select location & date using bootstrap --> 
<form action="search_results.php" method="GET">
<div class="first">
<div class="container-fluid">
<br>
<br>
        
<section class="Form my-4 mx-7">
  <div class="container-sm-3"> 
  
  
    <div class="row">
       <div class="col-sm-2">
       </div>
       <div class="col-sm-8">
       <div class="container firstrow" >
        <hr class="my-3">
       <div class="row">
          <div class="col-sm-5">
          <!-- Input location-->
                 <label for="inputplz" class="font font2">Wo willst du feiern?</label>
            					 <select class="form-select form-control" name="location" id="id_select" placeholder="PLZ" aria-label="City">
                                         <option value="">Gebiet</option>
                                         <option value="Neustadt"> Neustadt</option>
                                         <option value="Altstadt"> Altstadt</option>
                                         <option value="Rheinwiesen"> Rheinwiesen</option>
                                         <option value="Oberstadt"> Oberstadt</option>
                                         <option value="Bretzenheim"> Bretzenheim</option>
                                         <option value="Gonsenheim"> Gonsenheim</option>
                                         <option value="Wo anders"> Wo anders</option
                                     </select>
                                                 </select>
            <br>
          </div>           
         <div class="col-sm-5">
            <!-- Input date-->
            <label for="inputdate" class="font font2">Wann willst du feiern?</label>
            <input type="date" name="date" class="form-control" placeholder="Datum" aria-label="State" required>
            <br>
         </div>
        
          <div class="col-sm-2">
            <br>
            <!-- Button onclick move to search_results.php -->
            <button type="submit" class="btn btn-danger">Suchen</button>
            
          </div>
                  </div>
       </div>
      </div>
                  
                  </div>
                  </div>
    </div>
    </section>
    <!-- Some line breaks for style -->
<br>
<br>
<br>
<br>
<br>
<h2 class="text-center">Noch keinen Termin für deine Party vor Augen?<br>
Kein Problem!<hr>
 <!-- Button show all parties--> 
<a href="search_results_all.php" class="btn btn-danger">Alle Partys zeigen</a>  </h2>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>


</div>
</div>
</form>  
 <br>
<!-- Get Data from the last 3 Partys from MariaDB --> 
<?php
        $sql = "SELECT * FROM party ORDER BY ID DESC LIMIT 1"; //last party
        $sql2= "SELECT * FROM party ORDER BY ID DESC LIMIT 1,1";//snd-last party
        $sql3= "SELECT * FROM party ORDER BY ID DESC LIMIT 1,2";//thrid-last party
    
        
        //data from sql1
        $ergebnis = $link->query($sql)
            or die($link->error);    

        WHILE ($row = $ergebnis->fetch_assoc()){
                $district1 = $row['district'];
                $date1 = $row['date'];
                $name1 = $row['name'];
                $description1 = $row['description'];
                $id1 = $row['id'];
                $photo1 = $row['photo'];
              }
        //data from sql2
        $ergebnis = $link->query($sql2)
            or die($link->error);    

        WHILE ($row = $ergebnis->fetch_assoc()){
                $district2 = $row['district'];
                $date2 = $row['date'];
                $name2 = $row['name'];
                $description2 = $row['description'];
                $id2 = $row['id'];
                $photo2 = $row['photo'];
              }
          //data from sql2
          $ergebnis = $link->query($sql3)
              or die($link->error);    
  
          WHILE ($row = $ergebnis->fetch_assoc()){
                  $district3 = $row['district'];
                  $date3 = $row['date'];
                  $name3 = $row['name'];
                  $description3 = $row['description'];
                  $id3 = $row['id'];
                  $photo3 = $row['photo'];

                } 

    ?>

<h3  class="text-center"> Entdecke die neusten Partys auf Wasgehtab: </h3>
<br>
<br>
<!-- Build up Carousel for newest Party, using bootstrap -->
  <div class="row">
    <div class="col-sm-3">
    </div>
  <div class="col-sm-6">
    <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">
      <div class="carousel-indicators">
       <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
        <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
        <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
      </div>
    <div class="carousel-inner">
     <div class="carousel-item active d-block w-100">
     <img class="d-block w-100"
     <?php echo '<img src="data:image/jpeg;base64,'.base64_encode($photo1).'"width = 200px height= 445px>' ?>
        <div class="carousel-caption d-none d-md-block">
          <!-- Values from Maria DB last party-->
          <h3><?php echo "$name1"?></h3>
          <p>Datum: <?php echo "$date1"?><br>Ort: <?php echo "$district1"?></p>
          <!-- Button to apply directly -> Give party id to next php file -->
          <button class="btn btn-danger"><?php echo "<a href='apply_direct.php?pid=" . $id1. "'>Direkt Bewerben</a>"; ?></button>
      </div>
    </div>
    <div class="carousel-item">
      <img class="d-block w-100"
     <?php echo '<img src="data:image/jpeg;base64,'.base64_encode($photo2).'"width = 200px height= 445px>' ?>
      <div class="carousel-caption d-none d-md-block">
        <!-- Values from Maria DB snd-last party-->
        <h3><?php echo "$name2"?></h3>
        <p>Datum: <?php echo "$date2"?><br>Ort: <?php echo "$district2"?></p>
        <button class="btn btn-danger"><?php echo "<a href='apply_direct.php?pid=" . $id2. "'>Direkt Bewerben</a>"; ?></button>
        
      </div>
    </div>
    <div class="carousel-item">
    <img class="d-block w-100"
     <?php echo '<img src="data:image/jpeg;base64,'.base64_encode($photo3).'"width = 200px height= 445px>' ?>
      <div class="carousel-caption d-none d-md-block">
        <!-- Values from Maria DB third-last party-->
        <h3><?php echo "$name3"?></h3>
        <p>Datum: <?php echo "$date3"?><br>Ort: <?php echo "$district3"?></p>
        <button class="btn btn-danger"><?php echo "<a href='apply_direct.php?pid=" . $id3. "'>Direkt Bewerben</a>"; ?></button>
      </div>
    </div>
  </div>
  <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Previous</span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Next</span>
  </button>
</div>
<p class="br"></p> <!-- do some breaks-->
</div>


<!-- Add Footer to the mainpage-->
<footer class="bg-dark text-light">
  <div class="container text-left">
    <div class="row">
              <div class="col">
                <br>
              <h5 class="text-uppercase mb-4"> Contact </h5>
              <p>
              <i class="bi bi-house-door"> </i>Saarstraße 21, 55122 Mainz
              &nbsp; &nbsp; 
              <i class="bi bi-envelope"></i> </i>wasgehtab@gmail.com
              &nbsp; &nbsp; 
              <i class="bi bi-telephone"></i> </i>06131 390
              </p> 
              </div>

              <hr class="mb-4">
              <div class="row align-items-center">

                <div class="col-md-7 col-lg-8">
                  <small>Copyright© 2022 All rights reserved by: Wasgehtab GmbH&Co.KG</small>
              </div>
    </div>
</footer>
<script src="bootstrap-5.1.3-dist/js/bootstrap.bundle.min.js"> </script>
</body>
</html>
