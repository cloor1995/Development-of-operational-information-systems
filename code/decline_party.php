<?php

include "config.php"; // Using database connection file here

$id = $_GET['id']; // get id through query string
echo $id;

$change = mysqli_query($link,"UPDATE application SET status = 'abgelehnt' WHERE id = '$id'"); // change query

if($change)
{
    mysqli_close($db); // Close connection
    header("location:requests.php"); // redirects to all records page
    exit;
}
else
{
    echo "Error changing record"; // display error message if not delete
}
?>