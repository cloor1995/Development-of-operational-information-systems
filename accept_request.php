<?php

include "config.php"; // Using database connection file here

$apply_id = $_GET['id'];

$change = mysqli_query($link,"UPDATE application SET status = 'akzeptiert' WHERE id = '$apply_id'"); // change query

if($change)
{
    mysqli_close($db); // Close connection
    header("location: requests.php"); // redirects to all records page
    exit;
}
else
{
    echo "Error changing record"; // display error message if not delete
}
?>