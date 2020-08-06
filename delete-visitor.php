<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
if (strlen($_SESSION['cvmsaid']==0)) {
  header('location:logout.php');
  } else{

   
$deleteid=$_GET['deleteid'];

$query=mysqli_query($con,"delete from tblvisitor where ID='$deleteid'");
    if ($query) {
    $msg="Visitors has been deleted.";
  }
  else
    {
      $msg="Something Went Wrong. Please try again";
    }
    header("Location: manage-newvisitors.php");
    exit();
    die();
    
  
}
