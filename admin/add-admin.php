<?php include('partials/menu.php') ?>

 
<div class="main-content" >
    <div class="wrapper">
        <h1>Add Admin</h1>
        <br><br>

        <?php
        if(isset($_SESSION['add'])) //checking whether the session is set of lot
        {
            echo $_SESSION['add']; //display the session message
            unset($_SESSION['add']); //remove session message 
        }

        ?>

        <form action="" method="POST">

        <table class="tbl-30">
            <tr>
                <td>Full Name:</td>
                <td><input type="text" name="full_name" placeholder="Enter Yours Name"></td>        
            </tr>
            <tr>
                <td>Username: </td>
                <td> <input type="text" name="username" placeholder="Your Username"></td>
            </tr>
            <tr>
                <td>Password:</td>
                <td><input type="password" name="password" placeholder="Your Password"> </td>
            </tr>
            <tr>
                <td colspan="2">
                    <input type="submit" name="submit" value="Add Admin" class="btn-secondary">
                </td>
            </tr>
        </table>

        </form>
    </div>
</div>

<?php include('partials/footer.php') ?>

<?php 
      //process the value from form and save it in DATABASE
      //check whether the submit button is clicked or not
      if(isset($_POST['submit']))
      {
        //Button click
          

        //1.Get the DATA from form
        $full_name = $_POST['full_name'];
        $username = $_POST['username'];
        $password = md5($_POST['password']);   //password encryption with MD5
        
        //2.sql query to save data into database
        $sql = "INSERT INTO tbl_admin SET 
            full_name = '$full_name',
            username = '$username',
            password = '$password'

        ";
        //3.Executing query and saving data into database
        $res = mysqli_query($conn, $sql) or die(mysqli_error());
         //quiry succesfull res will true,when quiry fail res false
        

         //4.check whether the (query is executer) date is inserted or not and display appropriate messege
         if($res==TRUE)
         {
             //data inserted
             //echo "Data Inserted";
             //create a session variable to display 
             $_SESSION ['add'] = "Admin Added Successfully";
             //redirect page TO manage admin
             header("location: ".SITEURL.'admin/manage-admin.php');
         }
         else
         {
             //Fails to insert DATA
             //echo "Failed to Insert Data";
             //create a session variable to display 
             $_SESSION ['add'] = "Failed to Add Admin";
             //redirect page TO manage admin
             header("location: ".SITEURL.'admin/add-admin.php');
         }

        }
    
?>