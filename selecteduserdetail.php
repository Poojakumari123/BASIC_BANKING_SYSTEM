<?php
include 'connection.php';

if(isset($_POST['submit'])){
    $from = $_GET['ID'];
    $to =$_POST['to'];
    $amount =$_POST['amount'];

    $sql = "select * from user where ID=$from";
    $query = mysqli_query($conn,$sql);
    $sql1 = mysqli_fetch_array($query);

    $sql = "select * from user where ID=$to";
    $query = mysqli_query($conn,$sql);
    $sql2 = mysqli_fetch_array($query);

    if (($amount)<0)
    {
         echo '<script type="text/javascript">';
         echo ' alert("Oops! Negative values cannot be transferred")';  // showing an alert box.
         echo '</script>';
     }

     else if($amount > $sql1['Balance']) 
    {
        
        echo '<script type="text/javascript">';
        echo ' alert("Bad Luck! Insufficient Balance")';  // showing an alert box.
        echo '</script>';
    }
	
    else if($amount == 0){

        echo "<script type='text/javascript'>";
        echo "alert('Oops! Zero value cannot be transferred')";
        echo "</script>";
    }

    else {
        
        // deducting amount from sender's account
        $newbalance = $sql1['Balance'] - $amount;
        $sql = "UPDATE user set Balance=$newbalance where ID=$from";
        mysqli_query($conn,$sql);
     
        // adding amount to reciever's account
        $newbalance = $sql2['Balance'] + $amount;
        $sql = "UPDATE user set Balance=$newbalance where ID=$to";
        mysqli_query($conn,$sql);
        
        // Now insert in database
        $sender = $sql1['Name'];
        $receiver = $sql2['Name'];
        $sql = "INSERT INTO transaction(`sender`, `receiver`, `amount`) VALUES ('$sender','$receiver','$amount')";
        $query = mysqli_query($conn,$sql);

        if($query){
          echo "<script> alert('Transaction Successful');
           window.location='transactionhistory.php';
            </script>";
            
        }
        $newbalance= 0;
        $amount =0;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="table.css">

    <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <title>TransactionDetail</title>

    <style type="text/css">
    
    .container-fluid {
      font-size: 30px;
    }
		button{
			border:none;
			background: #d9d9d9;
		}
	    button:hover{
			background-color:#777E8B;
			transform: scale(1.1);
			color:white;
		}
    </style>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light"style="background-color: rgb(98, 196, 196);">
    <div class="container-fluid">
      <a class="navbar-brand" href="index.html" style="font-size: 32px; padding-right: 30px;">Home</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="#" style="padding-right: 40px;">About</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="#">Contact us</a>
          </li>
        </ul>
        <div class="Foundation" aria-current="page" href="#"><u> Foundation Bank</u></div>
      </div>
    </div>
</nav>

<div class="container">
        <h2 class="text-center pt-4">Transaction</h2>
            <?php
                include 'connection.php';
                $sid=$_GET['ID'];
                $sql = "select * from  user where ID=$sid";
                $result=mysqli_query($conn,$sql);
                if(!$result)
                {
                    echo "Error : ".$sql."<br>".mysqli_error($conn);
                }
                $rows=mysqli_fetch_assoc($result);
            ?>
            <form method="post" name="tcredit" class="tabletext" ><br>
    <div>
        <table class="table table-sm table-hover">
                <tr class= "table-primary">
                    <th class="text-center">Id</th>
                    <th class="text-center">Name</th>
                    <th class="text-center">Email</th>
                    <th class="text-center">Balance</th>
                </tr>
                <tr class="table-success">
                    <td class="py-2"><?php echo $rows['ID'] ?></td>
                    <td class="py-2"><?php echo $rows['Name'] ?></td>
                    <td class="py-2"><?php echo $rows['E-mail'] ?></td>
                    <td class="py-2"><?php echo $rows['Balance'] ?></td>
                </tr>
        </table>
  </div>
    <br><br><br>

    <label style="color : black;"><b>Transfer To:</b></label>
    <select name="to" class="form-control" required>
            <option value="" disabled selected>Choose</option>
            <?php
                include 'connection.php';
                $sid=$_GET['ID'];
                $sql = "SELECT * FROM user where ID!=$sid";
                $result=mysqli_query($conn,$sql);
                if(!$result)
                {
                    echo "Error ".$sql."<br>".mysqli_error($conn);
                }
                while($rows = mysqli_fetch_assoc($result)) {
            ?>
                <option class="table" value="<?php echo $rows['ID'];?>" >
                
                    <?php echo $rows['Name'] ;?> (Balance: 
                    <?php echo $rows['Balance'] ;?> ) 
               
                </option>
            <?php 
                } 
            ?>
            <div>
        </select>
        <br><br>
        <label style="color : black;"><b>Amount:</b></label>
            <input type="number" class="form-control" name="amount" required>   
            <br><br>
                <div class="text-center" >
                <button type="submit" name="submit" class="btn btn-outline-success">transact</button>
            </div>
        </form>
    </div>
    <footer class="text-center mt-5 py-1">
    <p>© 2021. Made by <b>Pooja Kumari</b> <br> For the Project of <b>The Sparks Foundation</b></p>
  </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>

  </body>
</html>

