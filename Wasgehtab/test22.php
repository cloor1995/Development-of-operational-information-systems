
<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wasgehtab</title>
    <link rel="stylesheet" href="/ebis005/Wasgehtab/style.css">
</head>
<body>


    <nav>
        <div class="nav-left">
          <a href="/ebis005/Wasgehtab/index.html"><img src="/ebis005/Wasgehtab/images/wasgehtab.png" class="logo"></a>

        </div>

        <div class="nav-right">

            <div class="nav-user-icon online" onclick="settingsMenuToggle()">
                <img src="/ebis005/Wasgehtab/images/philipp.png">
            </div>

        </div>
        <!-- ------dropdown-settings-menu--------- -->
        <div class="settings-menu">
            <div id="dark-btn">
                <span></span>
            </div>
            <div class="settings-menu-inner">
                <div class="user-profile">
                    <img src="/ebis005/Wasgehtab/images/philipp.png">
                    <div>
                        <p>Timo Liese</p>
                        <a href="../Profile/profile.php">Gehe zu deinem Profil</a>
                    </div>
                </div>
                <hr>
                <div class="user-profile">
                    <img src="/ebis005/Wasgehtab/images/feedback.png">
                    <div>
                        <p>Geb uns Feedback!</p>
                        <a href="Support.html">Helfe uns die besten Partys anzubieten</a>
                    </div>
                </div>
                <hr>
                <div class="settings-links">
                    <img src="/ebis005/Wasgehtab/images/setting.png" class="settings-icon">
                    <a href="">Einstellungen <img src="/ebis005/Wasgehtab/images/arrow.png" width="10px"></a>
                </div>
                <div class="settings-links">
                    <img src="/ebis005/Wasgehtab/images/help.png" class="settings-icon">
                    <a href="">Hilfe & Support <img src="/ebis005/Wasgehtab/images/arrow.png" width="10px"></a>
                </div>
                <div class="settings-links">
                    <img src="/ebis005/Wasgehtab/images/display.png" class="settings-icon">
                    <a href="">Anzeige <img src="/ebis005/Wasgehtab/images/arrow.png" width="10px"></a>
                </div>
                <div class="settings-links">
                    <img src="/ebis005/Wasgehtab/images/logout.png" class="settings-icon">
                    <a href="/ebis005/logout.php">Logout <img src="/ebis005/Wasgehtab/images/arrow.png" width="10px"></a>
                </div>
            </div>

        </div>
    </nav>
   </body>
</html>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <title>Login</title>
        <link rel="stylesheet" type="text/css" href="index.css"/>
        <meta charset="utf-8" name="viewport" content="width=device-width, initial-scale=1.0"/>
    <body>
    <div class="container-fluid">
       <div class="row">
           <div class="col-md-3">
               <div class="imp-links">
                   <a href="neueEvents.html"><img src="/ebis005/Wasgehtab/images/news.png"> Neuste Events</a>
                   <a href="#"><img src="/ebis005/Wasgehtab/images/balloons.png"> MeineEvents</a>
                   <a href="/ebis005/createparty.php"><img src="/ebis005/Wasgehtab/images/profile-home.png">Neue Party</a>
                   <a href="/ebis005/apply.php"><img src="/ebis005/Wasgehtab/images/balloons.png"> Bewerben</a>
                   <a href="/ebis005/applications.php"><img src="/ebis005/Wasgehtab/images/balloons.png"> Meine Bewerbungen</a>
                   <a href="/ebis005/applications.php"><img src="/ebis005/Wasgehtab/images/balloons.png"> Anfragen</a>
               </div>
               <div class="shortcut-links">
                   <a href="#"><img src=""> </a>
                   <a href="#"><img src=""></a>
                   <a href="#"><img src=""></a>
                   <a href="#"><img src=""></a>
                </div>
           </div>
<!---------------- Mittelteil --------->
          <div class="col">
              <?php
                require_once "ebis005/config.php";
                $sql = "SELECT id, status, text, party_id FROM application";
                $result = $link->query($sql);

                echo "<div class='container'>";
                    echo "<div class='row-fluid'>";

                        echo "<div class='col-xs-6'>";
                        echo "<div class='table-responsive'>";

                            echo "<table class='table table-hover table-inverse'>";

                            echo "<tr>";
                            echo "<th>ID</th>";
                            echo "<th>Text</th>";
                            echo "<th>party_id</th>";
                            echo "</tr>";

                            if ($result->num_rows > 0) {
                                // output data of each row
                                while($row = $result->fetch_assoc()) {

                                    echo "<tr>";
                                    echo "<td>" . $row["id"] . "</td>";
                                    echo "<td>" . $row["text"] . "</td>";
                                    echo "<td>" . $row["party_id"] . "</td>";
                                    echo "</tr>";
                                }
                            } else {
                                echo "0 results";
                            }

                            echo "</table>";

                        echo "</div>";
                        echo "</div>";

                    echo "</div>";

                echo "</div>";

                // Close connection
                mysqli_close($link);
                ?>
        </div>
        </div>
      </div>

    <div class="footer">
        <p>Copyright 2021 - Wasgehtab</p>
    </div>
    <script src="/ebis005/Wasgehtab/script.js"></script>
</body>
</html>
