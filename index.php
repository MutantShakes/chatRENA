<?php session_start(); 
include("dataBase.php");
if(isset($_SESSION["id"])){?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>chatRENA</title>






    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous" />


    <!-- Jquery -->
    <script src="https://code.jquery.com/jquery-3.6.1.min.js"></script>


    <!-- Styling -->
    <style>
      .navbar-brand{
        margin-left: 20px;
      }
    </style>


    <!-- css style link -->
    <link rel="stylesheet" type="text/css" href="index.css">

</head>
<body >
  
 <!-- Background image -->
<div class="bg">


<!-- Nav Bar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark sticky-top shadow-lg">
        <div class="container-fluid">

        <button class="btn btn-sm btn-secondary" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasScrolling" aria-controls="offcanvasScrolling">
                      <img src="img/msg.png" width="37" height="34" alt="">
                    </button>

            <!-- Logo -->
            <a class="navbar-brand" href="index.php" >
                <img src="img/cat.png" alt="Logo" width="55" height="47" class="d-inline-block align-text-center">
                <b><i>chat</i> RENA</b>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <!-- Menu Items -->
            <div class="collapse navbar-collapse " id="navbarNavAltMarkup">
                <div class="navbar-nav me-auto mb-2 mb-lg-0">

                    <a class="nav-link active" aria-current="page" href="index.php">Chat</a>
                    <a class="nav-link diabled" href="#">Groups</a>
                    <a class="nav-link disabled" href="#">Profile</a>
                    
                    
                </div>
                <div class="d-grid">
                    <a class="btn btn-outline-danger" href="?logout">Log Out</a>
                    </div>
                
            </div>

            

        </div>
    </nav>
    <br>
    

    <!-- GRID SYSTEM -->

    <!-- OFF CANVAS -->
    

<div class="offcanvas offcanvas-start" data-bs-scroll="true" data-bs-backdrop="false" tabindex="-1" id="offcanvasScrolling" aria-labelledby="offcanvasScrollingLabel">
  <div class="offcanvas-header bg-dark" style="color: white;">
    <h2 class="offcanvas-title" id="offcanvasScrollingLabel">Chat Groups</h2>
    <button type="button" class="btn-close btn-close-white"  data-bs-dismiss="offcanvas" aria-label="Close"></button>
    
  </div>
  <div class="offcanvas-body">
    <!-- <p><i>Create or join any group.</i></p> -->
    


     <!-- BUTTONS -->
     <div class="container">
<div class="row">

<!-- Creating Groups -->
<div class="dropdown col" >
<button class="btn btn-sm btn-outline-success dropdown-toggle"  type="button" data-bs-toggle="dropdown" aria-expanded="false">
  Create Group
</button>
<div class="dropdown-menu">
<form class="px-4 py-3" method="post">
<!-- ALERTS -->
<div class="alert alert-warning" id="exists" style="display: none;" role="alert">
    Group already exists!
      </div>

<div class="form-floating mb-3">
      <input type="text" name="groupName" class="form-control" id="floatingInput" placeholder="name">
      <label for="floatingInput">Group Name</label>
    </div>
    <div class="form-floating mb-3">
      <input type="password" name="groupPass" class="form-control" id="floatingPassword" placeholder="Password">
      <label for="floatingPassword">Password</label>
    </div>
<!-- <div class="mb-3">
 <div class="form-check">
   <input type="checkbox" class="form-check-input" id="dropdownCheck">
   <label class="form-check-label" for="dropdownCheck">
     Remember me
   </label>
 </div>
</div> -->

<div class="d-grid">
<button type="submit" name="create" class="btn btn-success">Create</button>
</div>

</form>
<div class="dropdown-divider"></div>
<a class="dropdown-item" href="#">New around here? Sign up</a>
<a class="dropdown-item" href="#">Forgot password?</a>
</div>
</div>


<!-- Joining GROUPS -->
<div class="dropdown col">
<button class="btn btn-sm btn-outline-warning dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
Join Group
</button>
<div class="dropdown-menu">
  
<form class="px-4 py-3" method="post">

<!-- ALERTS -->
<div class="alert alert-warning" id="wrong" style="display: none;" role="alert">
    Wrong Group Name or Password!
      </div>

<div class="form-floating mb-3">
      <input type="text" name="groupName" class="form-control" id="floatingInput" placeholder="name">
      <label for="floatingInput">Group Name</label>
    </div>
    <div class="form-floating mb-3">
      <input type="password" name="groupPass" class="form-control" id="floatingPassword" placeholder="Password">
      <label for="floatingPassword">Password</label>
    </div>

<!-- <div class="mb-3">
 <div class="form-check">
   <input type="checkbox" class="form-check-input" id="dropdownCheck">
   <label class="form-check-label" for="dropdownCheck">
     Remember me
   </label>
 </div>
</div> -->

<div class="d-grid">
<button type="submit" name="join" class="btn btn-warning">Join</button>
</div>

</form>
<div class="dropdown-divider"></div>
<a class="dropdown-item" href="#">New around here? Sign up</a>
<a class="dropdown-item" href="#">Forgot password?</a>
</div>
</div>
</div>
</div>


<hr>






<!-- //////////////////////////////////////////////////// -->





<!-- //////////////////////////////////////////////////// -->



    
<!-- LIST -->
   <div class="list-group list-group-flush border-bottom scrollarea">

   <!-- GROUPS -->
   <?php
   $sql = "SELECT * FROM partGroup WHERE userId='".$_SESSION["id"]."'";
   $result=mysqli_query($conn,$sql);
   if(mysqli_num_rows($result) > 0){
    while($row = mysqli_fetch_assoc($result)){
      $sql2="SELECT * FROM groups WHERE id='".$row["groupId"]."'";
      $result2=mysqli_query($conn,$sql2);
      if(mysqli_num_rows($result2) > 0){
        while($row2 = mysqli_fetch_assoc($result2)){
          echo '<a href="?id='.$row2["id"].'" class="list-group-item list-group-item-action py-3 lh-sm"  aria-current="true">
      <div class="d-flex w-100 align-items-center justify-content-between">
        <strong class="mb-1">'.$row2["name"].'</strong>
        <small><i>'.$row2["mtime"].'</i></small>
      </div>';
      $sql3="SELECT * FROM user WHERE id='".$row2["createdBy"]."'";
      $result3=mysqli_query($conn,$sql3);
      if(mysqli_num_rows($result3) > 0){
        while($row3 = mysqli_fetch_assoc($result3)){
          echo' <div class="col-10 mb-1 small">This group was created by '.$row3["name"].'</div>
    </a>';
        }
      }
    }
  }
        }
    
   }
   ?>
     
</div>



  </div>
</div>





 





    

    

  
<div class="container">

<h1>hell</h1>

<!-- Chatting frame -->
<?php
echo'  <div class="container overflow-auto" style="margin-top: 10px;">
<ul class="list-group">';
if(isset($_GET["id"]) ){
  $id = $_GET["id"];

  $sql = "SELECT * FROM message WHERE groupId = '".$id."'";
  $result = mysqli_query($conn,$sql);
  if(mysqli_num_rows($result) >0){
    while($row = mysqli_fetch_assoc($result)){
      if($row["userId"] == $_SESSION["id"]){
        echo '
      
        <div class="d-flex justify-content-end container" style="border-radius: 20px;">
        <li class="list-group-item d-flex justify-content-between align-items-start shadow-sm bg-secondary text-white" style="width: 70%;">
            
            <div class="d-flex w-100 align-items-center justify-content-between">
        <strong class="mb-1">'.$row["message"].'</strong>
        
        </div>
        <small class ="float-right"><i>Wed</i></small>
        
          </li>
          </div>
        
          <br>

         

        ';

      }else{
        echo '
          <div class="d-flex justify-content-start container" style="border-radius: 20px;">
        <li class="list-group-item d-flex justify-content-between align-items-start text-white shadow-sm bg-dark" style="width: 70%; ">

        <div class="d-flex w-100 align-items-center justify-content-between">
        <strong class="mb-1">'.$row["message"].'</strong>
        
        </div>
        <small class ="float-right"><i>Wed</i></small>
            
            
          </li>
          </div>
        
          <br>
      

        ';


      }
    }
  }

  echo'</ul>
      </div>';
  // echo '<script>
  //   alert("Working!");
  //   </script>';
}
?>


</div>



</div>










<!-- javascript link file -->
<script src="sidebars.js"></script>

<!-- Javascript -->
<script>


</script>



<!-- JS , Popper  -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>

</body>
</html>
<?php
if(isset($_POST["create"])){
  date_default_timezone_set("Asia/Calcutta");
  $gpName = $_POST["groupName"];
  $gpPass = $_POST["groupPass"];
  $datetime =date("l jS \of F Y "); ;

  $sql = "SELECT id FROM groups WHERE name = '".$gpName."'";
  $result= mysqli_query($conn,$sql);
  if(mysqli_num_rows($result) > 0){
    echo '<script>
    alert("Name already exists!");
    </script>';
    }else{

      $sql = "INSERT INTO groups (name,password,mtime,createdBy) VALUES ('".$gpName."','".$gpPass."','".$datetime."','".$_SESSION["id"]."')";
      if(!mysqli_query($conn,$sql)){
        echo "Error : ".$sql." ".mysqli_error($conn);
          }
      $sql = "SELECT id FROM groups WHERE name = '".$gpName."'";
      $result= mysqli_query($conn,$sql);
      if(mysqli_num_rows($result) > 0){
        while($row = mysqli_fetch_assoc($result)){
          $sql2 = "INSERT INTO partGroup (groupId,userId) VALUES ('".$row["id"]."','".$_SESSION["id"]."') ";
          if(!mysqli_query($conn,$sql2)){
            echo "Error : ".$sql2." ".mysqli_error($conn);
          }else{
            echo"<script>window.location.href='index.php';</script>";
          }
        }
      }

    }
      
      
    
    mysqli_close($conn);
}
if(isset($_POST["join"])){
  $gpName = $_POST["groupName"];
  $gpPass = $_POST["groupPass"];
    
    
  $sql = "SELECT * FROM groups WHERE name = '".$gpName."' AND password = '".$gpPass."'";
  $result= mysqli_query($conn,$sql);
  if(mysqli_num_rows($result) > 0){
    while($row = mysqli_fetch_assoc($result)){
      $sql2 = "SELECT * FROM partGroup WHERE userId = '".$_SESSION["id"]."' AND groupId = '".$row["id"]."'";
      $result2 = mysqli_query($conn,$sql2);
      if(mysqli_num_rows($result2) > 0){
        echo '<script>
      alert("You have already joined the group!");
      </script>';
      }else{ 
      $sql = "INSERT INTO partGroup (groupId,userId) VALUES ('".$row["id"]."','".$_SESSION["id"]."') ";
      if(!mysqli_query($conn,$sql)){
        echo "Error : ".$sql." ".mysqli_error($conn);
      }else{
        echo"<script>window.location.href='index.php';</script>";
      }
    }
  }
  }else{
    echo '<script>
    alert("Wrong Name or Password!");
    </script>'; 
  }     
    mysqli_close($conn);
}


if(isset($_GET["logout"])){
  session_destroy();
  echo"<script>window.location.href='login.php';</script>";
}
}else{
  echo"<script>window.location.href='login.php';</script>";
}?>