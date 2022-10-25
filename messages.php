<!-- Chatting frame -->
<?php session_start();
include("dataBase.php");
if(isset($_SESSION["id"])){
$id="";
$output ='  <div class="container overflow-auto" style="margin-top: 10px;">
<ul class="list-group">';
if($_POST["id"] != ""){
  $id = $_POST["id"];
  $_SESSION["prevId"] = $id;
}
else if(isset($_SESSION["prevId"])){
  $id = $_SESSION["prevId"];
}else{
  $sql = "SELECT * FROM message WHERE userId = '".$_SESSION["id"]."'";
  $result = mysqli_query($conn,$sql);
  if(mysqli_num_rows($result) >0){
    while($row = mysqli_fetch_assoc($result)){
      $id = $row["groupId"];
      $_SESSION["prevId"] = $id;
      break;
    }
  }
}

if($id != ""){
  $sql = "SELECT * FROM message WHERE groupId = '".$id."'";
  $result = mysqli_query($conn,$sql);
  if(mysqli_num_rows($result) >0){
    while($row = mysqli_fetch_assoc($result)){
      if($row["userId"] == $_SESSION["id"]){
        $output .= '
      
        <div class="d-flex justify-content-end container" style="border-radius: 20px;">
        <li class="list-group-item d-flex justify-content-between align-items-start shadow-sm bg-dark text-white" style="width: 70%;">
            
            <div class="d-flex w-100 align-items-center justify-content-between">
        <strong class="mb-1">'.$row["message"].'</strong>
        
        </div>';
        $sql2 = "SELECT * FROM user WHERE id = '".$row["userId"]."'";
        $result2 = mysqli_query($conn,$sql2);
        if(mysqli_num_rows($result) >0){
          while($row2 = mysqli_fetch_assoc($result2)){
        $output .='
        <small class ="float-right"><i>'.$row2["name"].'</i></small>';
          }
          $output .='
          </li>
          </div>
        
          <br>

         

        ';
        }
      }else{
        $output .= '
          <div class="d-flex justify-content-start container" style="border-radius: 20px;">
        <li class="list-group-item d-flex justify-content-between align-items-start text-white shadow-sm bg-secondary" style="width: 70%; ">

        <div class="d-flex w-100 align-items-center justify-content-between">
        <strong class="mb-1">'.$row["message"].'</strong>
        
        </div>';
        $sql2 = "SELECT * FROM user WHERE id = '".$row["userId"]."'";
        $result2 = mysqli_query($conn,$sql2);
        if(mysqli_num_rows($result) >0){
          while($row2 = mysqli_fetch_assoc($result2)){
        $output .='
        <small class ="float-right"><i>'.$row2["name"].'</i></small>';
          }
          $output .='
          </li>
          </div>
        
          <br>
      

        ';

        }
      }
    }
  }
}

  $output .='</ul>
      </div>';
  // $output .= '<script>
  //   alert("Working!");
  //   </script>';

  echo $output;

}else{
    echo "<script>window.location.href='login.php';</script>";
}?>