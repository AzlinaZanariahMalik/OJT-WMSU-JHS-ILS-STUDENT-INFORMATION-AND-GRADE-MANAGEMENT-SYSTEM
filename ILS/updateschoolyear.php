<?php
session_start();
include("functions/connectdb.php"); 

if(isset($_POST['updatedata']))
{
    $id=$_POST['update_id'];


    $status=$_POST['status'];
    $sql = "UPDATE school_year SET status='$status' WHERE sy_id='$id'";
    $sql2 = mysqli_query($con,"UPDATE school_year SET status='No' WHERE sy_id != '$id'");

    if (mysqli_query($con, $sql)) {
		
            $_SESSION['success'] = "Successfully Update School Year Status";
		header('Location: schoolyearlist.php');

		} else {

            $_SESSION['status'] = "Something Went Wrong";
            header('Location: schoolyearlist.php'); 
		}

}   

mysqli_close($con);
?>

	
	