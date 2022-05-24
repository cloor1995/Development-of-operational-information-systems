<!-- Only Navbar Code-->
<!-- Import Bootstrap Navbar + individual designing in css file on the bottom-->



<nav class="navbar sticky-top navbar-expand-lg navbar-light bg-light">
  <div class="container-fluid">
    <a class="navbar-brand" img  href="mainpage.php"><img src="images/Wasgehticon.png" width = 150px height= 30px></a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ms-auto">

        <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
          Party
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                  <a class="dropdown-item" href="createparty.php">Party erstellen</a>
                  <a class="dropdown-item" href="myparty.php">Meine Partys</a>
                  <a class="dropdown-item" href="upcoming_events.php">Bevorstehende Partys</a>
                  <a class="dropdown-item" href="search_results_all.php">Alle Partys anzeigen</a>
                </div>
              </li>
          
        <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                  Bewerbungen
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                  <a class="dropdown-item" href="applications.php">Meine versendeten Bewerbungen</a>
                  <a class="dropdown-item" href="requests.php">Teilnehmeranfragen</a>
                </div>
              </li>


              <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                  Bewertungen
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                  <a class="dropdown-item" href="show_myparties_bygone.php">Meine veranstalteten Partys</a>
                  <a class="dropdown-item" href="show_parties_bygone.php">Teilgenommene Partys</a>
                </div>
              </li>

        <li class="nav-item">
                  <a class="nav-link" href="profile.php">Mein Profil</a>
        </li>

        <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                  Wasgehtab
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                  <a class="dropdown-item" href="aboutus.php">Über uns</a>
                  <a class="dropdown-item" href="show_feedback_rating.php">Gib uns Feedback</a>
                </div>
              </li>
      </ul>
      <ul class="navbar-nav ms-auto">
      <li class="nav-item">
      <?php
          if(isset($_SESSION["loggedin"])){
            echo "<a class='nav-link' aria-current='page' href='logout.php'>Logout</a>";
          } else {
            echo "<a class='nav-link' aria-current='page' href='login.php'>Login</a>";
         }
             ?>
        </li>
      </ul>
    </div>
  </div>
</nav>

