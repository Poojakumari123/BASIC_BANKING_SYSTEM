<?php
$insert = false;
if(isset($_POST['submit'])){
    // set connection variable
    $server= "Localhost";
    $username = "root";
    $password = "";

    //Create  a database connection
    $con = mysqli_connect($server, $username, $password);

    //Check for connection success
    if(!$con){
        die("connection to this database failed due to".mysqli_connect_error());
    }
    // echo "Success connecting to the database";

    //collect post variables
    $name = $_POST['name'];
    $email = $_POST['email'];
    $balance = $_POST['balance'];
    
    $sql = "INSERT INTO `foundation_bank`.`user` (`Name`, `E-mail`, `Balance`) VALUES ('$name', 
     '$email','$balance');";
    //echo $sql;

    //Execute the query
    
    if ($con->query($sql) === TRUE){
        //echo "Successful inserted";

        //Flag for successful insertion
        $insert= true;
    }
    else{
        echo "ERROR: $sql <br> $con->error";
    }
    //Close the database connection
    $con->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Limelight&family=Merriweather:wght@300&display=swap"
        rel="stylesheet">

        <!-- Font Awesome -->
    <script src="https://kit.fontawesome.com/9f1c951fee.js" crossorigin="anonymous"></script>
    <title>CreateUser</title>
</head>
<body>
    <!-- <img class="bg" src="wit5.jpg" alt="wit"> -->
    <link rel="stylesheet" href="style.css">
    <div class="container">
        <?php
        if($insert == true){
        echo "<p class='submitMssg'>Thanks for submitting your details. We are happy to see you joining with us</p>";
    } 
        ?>
        <a href="http://localhost:8080/BASIC_BANKING_SYSTEM/"><p>Back to home</p></a>";
    </div>
</body>
</html>
