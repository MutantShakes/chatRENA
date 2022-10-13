<?php include("dataBase.php");?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.104.2">
    <title>chatRENA</title>






    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous" />


    <!-- Jquery -->
    <script src="https://code.jquery.com/jquery-3.6.1.min.js"></script>

    
    <!-- Styling -->
    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }

      .b-example-divider {
        height: 3rem;
        background-color: rgba(0, 0, 0, .1);
        border: solid rgba(0, 0, 0, .15);
        border-width: 1px 0;
        box-shadow: inset 0 .5em 1.5em rgba(0, 0, 0, .1), inset 0 .125em .5em rgba(0, 0, 0, .15);
      }

      .b-example-vr {
        flex-shrink: 0;
        width: 1.5rem;
        height: 100vh;
      }

      .bi {
        vertical-align: -.125em;
        fill: currentColor;
      }

      .nav-scroller {
        position: relative;
        z-index: 2;
        height: 2.75rem;
        overflow-y: hidden;
      }

      .nav-scroller .nav {
        display: flex;
        flex-wrap: nowrap;
        padding-bottom: 1rem;
        margin-top: -1px;
        overflow-x: auto;
        text-align: center;
        white-space: nowrap;
        -webkit-overflow-scrolling: touch;
      }
    </style>
   

    <!-- CSS file Link -->
    <link rel="stylesheet" href="style.css">



</head>
<body>



<div class="container col-xl-10 col-xxl-8 px-4 py-5 text-center">

<!-- TEXT -->
    <div class="row align-items-center g-lg-5 py-5">
      <div class="col-lg-7 text-center text-lg-start">
        <h1 class="display-4 fw-bold lh-1 mb-3">Vertically centered hero sign-up form</h1>
        <p class="col-lg-10 fs-4">Below is an example form built entirely with Bootstrap's form controls. Each required form group has a validation state that can be triggered by attempting to submit the form without completing it.</p>
      </div>
      <div class="col-md-10 mx-auto col-lg-5">

      <!-- SIGN UP FORM -->
        <form class="p-4 p-md-5 border rounded-3 bg-light" method="post">


        <!-- ALERTS -->
        <div class="alert alert-warning" id="regError" style="display: none;" role="alert">
        <strong>Email</strong> already registered!
      </div>
        <!-- ALERTS -->
        <div class="alert alert-warning" id="notFilled" style="display: none;" role="alert">
        <strong>Please</strong> fill all the feilds !
      </div>

          <!-- Name -->
        <div class="form-floating mb-3">
            <input type="text" name="userName" class="form-control" id="floatingInput" placeholder="Name">
            <label for="floatingInput">Name</label>
          </div>

          <!-- Email -->
          <div class="form-floating mb-3">
            <input type="email" name="userEmail" class="form-control" id="floatingInput" placeholder="name@example.com">
            <label for="floatingInput">Email address</label>
          </div>

          <!-- Password -->
          <div class="form-floating mb-3">
            <input type="password" name="userPass" class="form-control" id="floatingPassword" placeholder="Password">
            <label for="floatingPassword">Password</label>
          </div>

          <!-- <div class="checkbox mb-3">
            <label>
              <input type="checkbox" value="remember-me"> Remember me
            </label>
          </div> -->

      <!-- Submit Button -->
          <button class="w-100 btn btn-lg btn-primary" name="submit" type="submit">Sign up</button>
          <hr class="my-4">

          <small class="text-muted">By clicking Sign up, you agree to the terms of use.</small>
          <br>
          <!-- Already registered -->
          <a href="login.php">Already registered? Login</a>

        </form>
        
      </div>
    </div>
  </div>



<!-- JS , Popper  -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>







</body>
</html>
<?php
if(isset($_POST["submit"])){
    $name = $_POST["userName"];
    $email = $_POST["userEmail"];
    $pass = $_POST["userPass"];
    $sql = "SELECT * FROM user WHERE email='".$email."'";
    $result = mysqli_query($conn,$sql);
  if(mysqli_num_rows($result) > 0){
    echo '<script>
    $(".alert").hide();
    $("#regError").show();
    </script>';  
  }else if($name == "" || $email == "" || $pass == ""){
    echo '<script>
    $(".alert").hide();
    $("#notFilled").show();
    </script>';  

  }else{
    $sql = "INSERT INTO user (name,email,password) VALUES ('".$name."','".$email."','".$pass."')";
    if(mysqli_query($conn,$sql)){
        echo '<script> alert("Successfully registered"); </script>';
        echo '<script>window.location.href="login.php"; </script>';
        header("Location: login.php");
        
          }else{
            echo "Error : ".$sql." ".mysqli_error($conn);
          }
          mysqli_close($conn);
  }
}
?>