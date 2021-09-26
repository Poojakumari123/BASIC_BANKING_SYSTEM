<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <link rel="stylesheet" type="text/css" href="css/table.css">

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">

  <style type="text/css">
    .container-fluid {
      font-size: 30px;
    }
    button{
      transition: 1.5s;
      background-color : rgb(71, 168, 175);
    }
    button:hover{
      background-color:;
      color:white;
    }
    .table th{
      padding: buttom 2px;
    }
  </style>
    <title>AllUsers</title>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light" style="background-color:rgb(98, 196, 196);">
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

<div class= "container">
    <h2 class="text-center pt-4" >Transfer Money</h2>
    <div class= "col">
        <div class="table-responsive">
            <table class= "table table-sm table-hover">
                <thead>
                    <tr class= "table-primary">
                        <th scope="col" class="text-center">ID</th>
                        <th scope="col" class="text-center">Name</th>
                        <th scope="col" class="text-center">E-mail</th>
                        <th scope="col" class="text-center">Amount</th>
                        <th scope="col" class="text-center">Operation</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                    include 'connection.php';
                    $selectquery =" select * from user";
                    $query = mysqli_query($conn,$selectquery);

                    $nums = mysqli_num_rows($query);
                    
                    while($rows = mysqli_fetch_array($query)){
                    ?>
                      <tr class="table-success">
                        <td><?php echo $rows['ID'];?></td>
                        <td class="py-2"><?php echo $rows['Name'];?></td>
                        <td class="py-2"><?php echo $rows['E-mail'];?></td>
                        <td class="py-2"><?php echo $rows['Balance'];?></td>
                        <td><a href="selecteduserdetail.php?ID= <?php echo $rows['ID'] ;?>"><button type="button" class="btn btn-outline-success">transact</button></a></td> 
                    </tr>

                <?php
                    }  
                ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<footer class="text-center mt-4 py-1 bg-dark">
    <p class="text-white">© 2021. Made by <b>Pooja Kumari</b> <br> For the Project of <b>The Sparks Foundation</b></p>
  </footer>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
</body>
</html>
