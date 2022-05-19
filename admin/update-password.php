<?php include('partials/menu.php') ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Change Password</h1>
        <br><br>

        <?php 
            if(isset($_GET['id']))
            {
                $id=$_GET['id'];
            }
        ?>

        <form action="" method="POST">
        
        <table class="tbl-30">
            <tr>
                <td>Current Password: </td>
                <td>
                    <input type="password" name="current_password" placeholder="Current Password" >
                </td>
            </tr>
            <tr>
                <td>New Password: </td>
                <td>
                    <input type="password" name="new_password" placeholder="New Password" >
                </td>
            </tr>
            <tr>
                <td>Confirm Password: </td>
                <td>
                    <input type="password" name="confirm_password" placeholder="Confirm Password" >
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <input type="hidden" name="id" value="<?php echo $id ?>">
                    <input type="submit" name="submit" value="Change Password" class="btn-secondary">
                </td>
            </tr>
        </table>

        </form>
    </div>
</div>

<?php
            if(isset($_POST['submit'])){
               // echo "clicked";
            
               //1.get data from the form
               $id= $_POST['id'];
               $current_password = md5($_POST['current_password']);
               $new_password = md5($_POST['new_password']);
               $confirm_password = md5($_POST['confirm_password']);

               //2.check current id and current password is correct or not
                $sql = "SELECT * FROM tbl_admin WHERE id=$id AND password= '$current_password' " ;

                //execute the query
                $res = mysqli_query($conn, $sql);

                if($res==true)
                {
                    //check whether data is available or not
                    $count=mysqli_num_rows($res);

                    if($count==1)
                    {
                        //user exist
                        //echo "user found";
                        if($new_password==$confirm_password)
                        {
                            //update password
                            //echo "updated";
                            //quary
                            $sql2 = "UPDATE tbl_admin SET 
                                    password='$new_password'
                                    WHERE id=$id
                            ";
                            //exucute the quary 
                            $res2 = mysqli_query($conn, $sql2);

                            //check whether quary executed or not
                            if($res2==true)
                            {
                                //display success messege
                                $_SESSION['changed-password'] = "<div class='success'>Password change successfully </div>";
                                //rederect the user
                                header('location:'.SITEURL.'admin/manage-admin.php');
                            }
                            else
                            {
                                //display error messege
                                $_SESSION['not-changed-password'] = "<div class='error'>Failed to change password</div>";
                                //rederect the user
                                header('location:'.SITEURL.'admin/manage-admin.php');
                            }

                        }
                        else
                        {
                            //user does not found
                             $_SESSION['password-not-match'] = "<div class='error'>Confirm password did not match </div>";
                            //rederect the user
                            header('location:'.SITEURL.'admin/manage-admin.php');
                        }

                    }
                    else
                    {
                        //user does not found
                        $_SESSION['user-not-found'] = "<div class='error'> user not found </div>";
                        //rederect the user
                        header('location:'.SITEURL.'admin/manage-admin.php');
                    }
                }

               //3. check new password and confirm password are match.

               //4.change password if all are true
            }

?>


<?php include('partials/footer.php')?>