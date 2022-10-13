<?php session_start(); 
include("dataBase.php");?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">

<meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.104.2"> -->
    <title>chatRENA</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous" />


    <!-- Jquery -->
    <script src="https://code.jquery.com/jquery-3.6.1.min.js"></script>

        

    
    <!-- Styling -->
    <style>

  body {
    background-color: #f5f5f5;
  }
        .form-signin input[type="email"] {
    margin-bottom: -1px;
    border-bottom-right-radius: 0;
    border-bottom-left-radius: 0;
  }
  
  .form-signin input[type="password"] {
    margin-bottom: 10px;
    border-top-left-radius: 0;
    border-top-right-radius: 0;
  } 

  .form-signin {
    max-width: 330px;
    padding: 15px;
  }
    </style>

</head>
<body>
<!-- <div class="container-fluid text-center"> -->
    <!-- NAVBAR -->
    <nav class="navbar navbar-expand-lg bg-dark navbar-dark shadow-lg ">
  <div class="container-fluid">
    
    <span class="navbar-brand pb-0 mb-0 mt-1 h1"><img src="img/cat.png" alt="Logo" width="55" height="47" class="d-inline-block align-text-center">
                <b><i>chat</i> RENA</b></span>
  </div>
</nav>




  

    <div class="form-signin w-100 m-auto container-fluid text-center">
  <form method="post">

  <!-- Image -->
    <img class="mb-4" src="img/cat.png" alt="" width="144" height="140">
    <!-- Text -->
    <!-- <h1 class="h2 mb-3 fw-normal"> <b> <i>chat</i> RENA </b> </h1> -->

    <!-- ALERTS -->
    <div class="alert alert-danger" id="regError" style="display: none;" role="alert">
    Wrong Email or Password entered!
      </div>

    <div class="form-floating">
      <input type="email" name="userEmail" class="form-control" id="floatingInput" placeholder="name@example.com">
      <label for="floatingInput">Email address</label>
    </div>
    <div class="form-floating">
      <input type="password" name="userPass" class="form-control" id="floatingPassword" placeholder="Password">
      <label for="floatingPassword">Password</label>
    </div>

   

    <button class="w-100 btn btn-lg btn-primary" type="submit" name="submit">Log in</button>
    <p class="mt-5 mb-3 text-muted">&copy; 2017-2022</p>
  </form>
      <a href="signUp.php">Not registered? Sign Up</a>
</div>

    <!-- </div> -->





<!-- JS , Popper  -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>







</body>
</html>
<?php
if(isset($_POST["submit"])){
    $email = $_POST["userEmail"];
    $pass = $_POST["userPass"];
    $sql = "SELECT * FROM user WHERE email='".$email."' AND password= '".$pass."'";
    $result = mysqli_query($conn,$sql);
  if(mysqli_num_rows($result) > 0){
      while($row = mysqli_fetch_assoc($result)){
        $_SESSION["id"] = $row["id"];
      } 
      header("Location: index.php");
  }else{
    echo '<script>
    $(".alert").hide();
    $("#regError").show();
    </script>'; 
        
          
  }
}
?>