<?php session_start();
include("dataBase.php");
if(isset($_SESSION["id"])){


  $msg = $_POST["msg"];
  if($msg != ""){
  $sql = "INSERT INTO message (groupId,userId,message) VALUES ('".$_SESSION["prevId"]."','".$_SESSION["id"]."','".$msg."')";
  if(!mysqli_query($conn,$sql)){
    echo "Error : ".$sql." ".mysqli_error($conn);
    }
  }

}else{
    echo "<script>window.location.href='login.php';</script>";
}
?>