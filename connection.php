<?php

$server="localhost";
$username="root";
$password="";
$dbname="foundation_bank";

$conn = mysqli_connect($server, $username, $password,$dbname);

if(!$conn){
    die("connection to this database failed due to".mysqli_connect_error());
}
 //echo "Success connecting to the database";
 
?>