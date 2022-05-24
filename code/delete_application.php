<?php

include "config.php"; // Using database connection file here

$id = $_GET['id']; // get id through query string
echo $id;

$del = mysqli_query($link,"delete from application where id = '$id'"); // delete query

if($del)
{
    mysqli_close($db); // Close connection
    header("location:applications.php"); // redirects to all records page
    exit;
}
else
{
    echo "Error deleting record"; // display error message if not delete
}
?>