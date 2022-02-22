<?php

    //Include constants.php file here
    include('../config/constants.php');

    //1.get the id of the admin to be delete
     $id = $_GET['id'];

    //2.create sql query to delete admin
    $sql = "DELETE FROM tbl_admin WHERE id=$id";

    //Execute the query
    $res = mysqli_query($conn, $sql);

    //check whether the query executed successfully or not
    if($res==true)
    {
        //Query executed successfully and admin deleted
        //echo "Admin Deleted";
        //create session variable to display message
        $_SESSION['delete'] =  "<div class='success'> Admin Deleted Successfully.</div>";
        //Redirect to manage admin page
        header('location:'.SITEURL.'admin/manage-admin.php');
    }
    else
    {
        //Failed to delete admin
        //echo "Failed to delete Admin";

        $_SESSION['delete'] ="<div class='error'>Failed to delete Admin. Try again later.</div>";
        header('location:'.SITEURL.'admin/manage-admin.php');

        }

    //3.redirect to manage admin page with success/error message

    



?>