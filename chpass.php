<?php $page="chpass.php";?>
<?php 
require_once 'header.php'; 
require_once 'include/form_func.php'; 
?>
<?php
$err="";
check_login();
if(isset($_POST["opass"]))
{
    if(!check_required ($_POST["opass"])){
        $err = "Old password is required!";
    }
    else if(!check_required ($_POST["npass"])){
        $err = "New Password is required!";
    }
    else if(check_password($_POST["npass"])!=""){
        $err = check_password($_POST["npass"]);
    }
    else if(!check_required ($_POST["cpass"])){
        $err = "Confirm Password is required!";
    }
    else if($_POST["cpass"]!=$_POST["npass"]){
        $err = "Passwords do not match!";
    }
    else {
    $query="update `app_users` set
        `pass` =  '$_POST[npass]'
        where 
        email = '$_SESSION[email]'
        and pass = '$_POST[opass]'";
        $r = run_sql($query);
        if(mysql_affected_rows()>0){
            session_destroy();
            redirect("login.php?msg=3");            
        }
        else {
            $err = "Incorrect old password!!";
        }
    }
}
?>
    <h1>Change Password</h1>
    <form method="post">
    <table>
        <tr>
            <td>Old Password</td>
            <td><input type="password" name="opass">*</td>
        </tr>
        <tr>
            <td>New Password</td>
            <td><input type="password" name="npass">*</td>
        </tr>
        <tr>
            <td>Confirm Password</td>
            <td><input type="password" name="cpass">*</td>
        </tr>
        <tr>
            <td><input type="submit" value="Submit"/></td>
            <td><input type="reset"></td>
        </tr>
        <tr>
            <td colspan="2" style="color: red"><?php echo $err?></td>
        </tr>
    </table>
    </form>
<?php require_once 'footer.php';?>
