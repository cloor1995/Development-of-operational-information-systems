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
    include "config.php" 
?>


<!DOCTYPE HTML>
<html>
<head>
    <meta charset="utf-8" />
    <title>Meine Bewertungen</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="stylesheet" href="navbar.css">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
	<script src="bootstrap-5.1.3-dist/js/bootstrap.bundle.min.js"> </script>
</head>
<body>

<?php
    //include navbar
    include "navbar.php" 
?>


<!-- Data from MariaDB; can be used to personalize this rating site for each user--> 
<?php
$user_id =  $_SESSION["USERID"];
$party_id = $_SESSION["PARTYID"];
$sql = "SELECT * FROM users WHERE id='$user_id'";//Tabelle USER Abfragen


$ergebnis = $link->query($sql)
    or die($link->error);  

WHILE ($row = $ergebnis->fetch_assoc()){
    $firstname = $row['firstname'];
    $lastname = $row['lastname'];
    $sexchar = $row['sex'];
    if ($sexchar == "m"){
        $sex = "männlich";}
        elseif ($sexchar == "w"){
          $sex = "weiblich";}
        elseif ($sexchar == "d"){
            $sex = "divers";}
        else {
            $sex ="Keine Angabe";}
    
    $age = $row['age'];
    $email = $row['email'];
    $password = $row['password'];
    $drinks = $row['drinks'];
    $image = $row['photo'];

}
?>

    <div class="container">
            <div class="row">
    	<h1 class="mt-5 mb-5" >Wie hat die Community <?php echo "$firstname"?> erlebt?</h1>
    	<div class="card">
    		<div class="card-header" style="font-size:20px;" >Das Ergebnis: </div>
    		<div class="card-body">    
    			<div class="row">
    				<div class="col-sm-4 text-center">
    					<h1 class="text-warning mt-4 mb-4">
    						<b><span id="average_rating">0.0</span> / 5</b> <!-- Show average_rating -->
    					</h1>
    					<div class="mb-3">
                            <!--  display five starring gray color stars on the webpage -->
    						<i class="fas fa-star star-light mr-1 main_star"></i>
                            <i class="fas fa-star star-light mr-1 main_star"></i>
                            <i class="fas fa-star star-light mr-1 main_star"></i>
                            <i class="fas fa-star star-light mr-1 main_star"></i>
                            <i class="fas fa-star star-light mr-1 main_star"></i>
	    				</div>
                        <!-- This tag value will set using ajax jury code -->
    					<h3><span id="total_review">0</span> Bewertungen </h3>
    				</div>
    				<div class="col-sm-4">
    					<p>
                            <!-- Display star in yellow color for 5 stars -->
                            <div class="progress-label-left"><b>5</b> <i class="fas fa-star text-warning"></i></div>
                            <!--Dynamical display for colorizing the total review of 5 stars  -->
                            <div class="progress-label-right">(<span id="total_five_star_review">0</span>)</div>
                            <div class="progress">
                                <!-- Make progress in gray color for 5 stars  -->
                                <div class="progress-bar bg-warning" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" id="five_star_progress"></div>
                            </div>
                        </p>
    					<p>
                            <!-- Display star in yellow color for4 stars -->
                            <div class="progress-label-left"><b>4</b> <i class="fas fa-star text-warning"></i></div>
                            <!--Dynamical display for colorizing the total review of 4 stars  -->
                            <div class="progress-label-right">(<span id="total_four_star_review">0</span>)</div>
                            <div class="progress">
                                <!-- Make progress in gray color for 4 stars  -->
                                <div class="progress-bar bg-warning" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" id="four_star_progress"></div>
                            </div>               
                        </p>
    					<p>
                            <!-- Display star in yellow color for 3 stars -->
                            <div class="progress-label-left"><b>3</b> <i class="fas fa-star text-warning"></i></div>
                            <!--Dynamical display for colorizing the total review of 3 stars  -->
                            <div class="progress-label-right">(<span id="total_three_star_review">0</span>)</div>
                            <div class="progress">
                                <!-- Make progress in gray color for 3 stars  -->
                                <div class="progress-bar bg-warning" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" id="three_star_progress"></div>
                            </div>               
                        </p>
    					<p>
                            <!-- Display star in yellow color for 2 stars -->
                            <div class="progress-label-left"><b>2</b> <i class="fas fa-star text-warning"></i></div>
                            <!--Dynamical display for colorizing the total review of 2 stars  -->
                            <div class="progress-label-right">(<span id="total_two_star_review">0</span>)</div>
                            <div class="progress">
                                <!-- Make progress in gray color for 2 stars  -->
                                <div class="progress-bar bg-warning" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" id="two_star_progress"></div>
                            </div>               
                        </p>
    					<p>
                            <!-- Display star in yellow color for an single star -->
                            <div class="progress-label-left"><b>1</b> <i class="fas fa-star text-warning"></i></div>
                            <!--Dynamical display for colorizing the total review of an single star  -->
                            <div class="progress-label-right">(<span id="total_one_star_review">0</span>)</div>
                            <div class="progress">
                                <!-- Make progress in gray color for a single star  -->
                                <div class="progress-bar bg-warning" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" id="one_star_progress"></div>
                            </div>               
                        </p>
    				</div>
                    <!-- Create Pop-uo for the review formular -->
    				</div>
    			</div>
    		
    	</div>
    	 <div class="col-12 col-md-6 col-lg-4">
                <div class="card12">
                <img class="card-img-top3" <?php
        			if ($image === null){echo '<img src="images/noprofile.png" width = 300px height= 345px>';}
        			else {
                     echo '<img src="data:image/jpeg;base64,'.base64_encode($image).'"width = 200px height= 345px>';
                    }
        			?>
                </div>
    </div>
      <div class="col-12 col-md-6 col-lg-2">
                <div class="card1">
                <div class="card-body">
                    <h5 class="card-title"><?php echo "User <br> $firstname $lastname"?> </h5>
                    <hr>
                    <br>
                    <p class="card-text"> Geschlecht: <?php echo "$sexchar"?></p>
                    <p class="card-text"> Alter: <?php echo "$age"?> </p>
                    <p class="card-text"> Getränk: 
                    <?php
                            if ($drinks == "1"){echo "Bier";}
                            elseif($drinks == "2"){echo "Wein";}
                            elseif($drinks == "3"){echo "Sekt";}
                            elseif($drinks == "4"){echo "Schnaps";}
                            else {echo "Kein Alkohol";} ?></p>
                    <br>
                    <br>
                    <br>
  </div>
                </div>
                </div>
        <!-- Load user submitted star rating and review data -->
    	<div class="mt-5" id="review_content"></div>
        
        <!-- Back to profile --> 
        <a href="lookupprofile.php?uid=<?php echo "$user_id"?>&pid=<?php echo "$party_id"?>" class="btn btn-danger my-2 p-2">Gehe wieder zum Profil</a>  
    </div>

</body>
</html>






<style>
    .card12{
margin-left:220px;
}
body 
{
    background-image: url("images/crowd2.jpg");
    background-size:cover;
} 

h2 
{
    color: white;
    font-size: 50px;
    font-weight:300;
} 

.progress-label-left
{
    float: left;
    margin-right: 0.5em;
    line-height: 1em;
}
.progress-label-right
{
    float: right;
    margin-left: 0.3em;
    line-height: 1em;
}
.star-light
{
	color:#e9ecef;
}
</style>

<script>

$(document).ready(function(){

	var rating_data = 0; 

    // When user submitted data, this function will be executed
    $('#add_review').click(function(){

        $('#review_modal').modal('show'); //pop-up model on web page 

    });

    // Change the color of the stars if the mouse enters the space of the stars 
    $(document).on('mouseenter', '.submit_star', function(){ 

        var rating = $(this).data('rating'); // fetch data rating attribute value and store it as variable 

        reset_background();
        
        // Change background color for stars (between 1 and rated star)
        for(var count = 1; count <= rating; count++) 
        {

            $('#submit_star_'+count).addClass('text-warning');

        }

    });

    // helper function to reset the background color of the star icons
    function reset_background()
    {
        for(var count = 1; count <= 5; count++)
        {

            $('#submit_star_'+count).addClass('star-light');

            $('#submit_star_'+count).removeClass('text-warning');

        }
    }

    // code will be executed if the mouse leaves the area 
    $(document).on('mouseleave', '.submit_star', function(){

        reset_background();

        for(var count = 1; count <= rating_data; count++)
        {

            $('#submit_star_'+count).removeClass('star-light');

            $('#submit_star_'+count).addClass('text-warning');
        }

    });
    
    //Click on modal star icon to execute this code 
    $(document).on('click', '.submit_star', function(){

        rating_data = $(this).data('rating'); // fetch data rating attribute value from star icon and store it as an variable  

    });

    // Click on submit button will execute this block 
    $('#save_review').click(function(){

        var user_name = $('#user_name').val(); //store user_name as variable with the value from the formula 

        var user_review = $('#user_review').val(); //store user_review as variable with the value from the formula 

        var hostguest = $('#hostguest').val(); // store hostguest as value

        var user_id = $('#user_id').val(); // store user_id as value

        var party_id = $('#party_id').val(); // store party_id as value

        var partyname = $('#partyname').val(); // store partyname as value

        var firstname = $('#firstname').val(); // store partyname as value


        if(user_name == '' || user_review == ''|| hostguest == ''|| user_id == '' || party_id == '')
        {
            alert("Füllen Sie bitte alle Felder aus!"); //error-alert if at least one textfield is empty 
            return false;
        }
        else
        {
            /*AJAX is a technique for accessing web servers from a web page. AJAX stands for Asynchronous JavaScript And XML.*/
            $.ajax({
                url:"submit_userIDhost_rating.php", //a string containing the URL to which the request is sent.
                method:"GET", //HTTP method to use for the request
                data:{rating_data:rating_data, user_name:user_name, user_review:user_review, hostguest:hostguest, user_id:user_id, party_id:party_id}, //data to be sent to the server 
                success:function(data) //function will be executed if the request succeeds.
                {
                    $('#review_modal').modal('show');

                    //if connections to db succeds, load the rating data
                    load_rating_data();

                    alert(data);
                }
            })
        }

    });


        


    load_rating_data();

    // helper function to load saved data 
    function load_rating_data()
    {
        $.ajax({
            url:"submit_userIDhost_rating.php",
            method:"GET",
            data:{action:'load_data'},
            dataType:"JSON", //return JS object
            success:function(data)
            {
                // display average and total rating on web page 
                $('#average_rating').text(data.average_rating);
                $('#total_review').text(data.total_review);

                var count_star = 0;
                

                $('.main_star').each(function(){
                    count_star++;
                    // display the amount of the average rating in yellow stars 
                    if(Math.ceil(data.average_rating) >= count_star)
                    {
                        $(this).addClass('text-warning');
                        $(this).addClass('star-light');
                    }
                });

                // display the amount of stars per each group as a bar chart
                $('#total_five_star_review').text(data.five_star_review);

                $('#total_four_star_review').text(data.four_star_review);

                $('#total_three_star_review').text(data.three_star_review);

                $('#total_two_star_review').text(data.two_star_review);

                $('#total_one_star_review').text(data.one_star_review);

                // calculate the percentages of every group and highlight these shares as yellow bars 
                $('#five_star_progress').css('width', (data.five_star_review/data.total_review) * 100 + '%');

                $('#four_star_progress').css('width', (data.four_star_review/data.total_review) * 100 + '%');

                $('#three_star_progress').css('width', (data.three_star_review/data.total_review) * 100 + '%');

                $('#two_star_progress').css('width', (data.two_star_review/data.total_review) * 100 + '%');

                $('#one_star_progress').css('width', (data.one_star_review/data.total_review) * 100 + '%');

                // now display user review data on webpage
                if(data.review_data.length > 0)
                {
                    var html = '';
                    
                    // generate for every user_review the required CSS elements 
                    for(var count = 0; count < data.review_data.length; count++)
                    {
                        html += '<div class="row mb-3">';

                        html += '<div class="col-sm-1"><div class="rounded-circle bg-danger text-white pt-2 pb-2"><h3 class="text-center">'+data.review_data[count].user_name.charAt(0)+'</h3></div></div>';

                        html += '<div class="col-sm-11">';

                        html += '<div class="card">';

                        html += '<div class="card-header"><b>'+data.review_data[count].user_name+'</b></div>';

                        html += '<div class="card-body">';


                        // display for every CSS element the user submitted stars as an star rating 
                        for(var star = 1; star <= 5; star++)
                        {
                            var class_name = '';

                            if(data.review_data[count].rating >= star)
                            {
                                class_name = 'text-warning';
                            }
                            else
                            {
                                class_name = 'star-light';
                            }

                            html += '<i class="fas fa-star '+class_name+' mr-1"></i>';
                        }
                        
                        html += '<br />'; 

                        if(data.review_data[count].hostguest == 1)
                            {
                                name = 'Host';
                            }
                            else
                            {
                                name = 'Gast';
                            }

                            html += 'Wurde von '+data.review_data[count].user_name+ ' als ' +name+ ' bewertet';
                        
                        html += '<br />';
                        html += '<br />';

                        html += 'Bewertung:';
                        html += '<br />';

                        html += data.review_data[count].user_review;

                        
                        html += '</div>';
                        
                        // print for every user rating an timestamp 
                        html += '<div class="card-footer text-right">On '+data.review_data[count].datetime+'</div>';
                        
                        // closing tags for every review
                        html += '</div>';

                        html += '</div>';

                        html += '</div>';
                    }
                    
                    // id is equal to review contant taguser: display review content on webpage 
                    $('#review_content').html(html);
                }
            }
        })
    }

});

</script>