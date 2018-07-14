<?php $page="register.php";?>
<?php 
require_once 'header.php'; 
require_once 'include/form_func.php'; 
?>
<?php
$err="";
if(isset($_POST["email"]))
{
    if(!check_required($_POST["email"])){
        $err = "E Mail is required";
    }
    else if(!check_email($_POST["email"])){
        $err = "Incorrect E Mail";
    }
    else if(is_exist ($_POST["email"])){
        $err = "E Mail already registered!";
    }
    else if(!check_required ($_POST["pass"])){
        $err = "Password is required!";
    }
    else if(check_password($_POST["pass"])!=""){
        $err = check_password($_POST["pass"]);
    }
    else if(!check_required ($_POST["cpass"])){
        $err = "Confirm Password is required!";
    }
    else if($_POST["cpass"]!=$_POST["pass"]){
        $err = "Passwords do not match!";
    }
    else if(!check_required($_POST["s_que"])){
        $err = "Security Question is required";
    }
    else if(!check_required($_POST["s_ans"])){
        $err = "Security answer is required";
    }
    else if(!empty ($_POST["pno"]) && check_phone_no($_POST["pno"])==false){
        $err = "Incorrect Phone No";
    }
    else {
    $query="INSERT INTO `app_users` (`uname`, `email`, `pass`, 
        `s_que`, `s_ans`, `role`,  
        phone_no, `status`) 
        VALUES ('$_POST[uname]', '$_POST[email]', '$_POST[pass]', 
        '$_POST[s_que]', '$_POST[s_ans]', 'user', 
        '$_POST[pno]' , 'new');";
        $r = run_sql($query);
        mail_it($_POST[email], "Registration Successful!!", "Welcome....", null);
        redirect("login.php?msg=1");
    }
}
?>
    <h1>Register</h1>
    <form method="post">
    <table>
        <tr>
            <td>User Name</td>
            <td><input  value="<?php echo $_POST["uname"]?>" type="text" name="uname"></td>
        </tr>
        <tr>
            <td>E Mail</td>
            <td><input type="text" name="email" value="<?php echo $_POST["email"]?>">*</td>
        </tr>
        <tr>
            <td>Password</td>
            <td><input type="password" name="pass">*</td>
        </tr>
        <tr>
            <td>Confirm Password</td>
            <td><input type="password" name="cpass">*</td>
        </tr>
        <tr>
            <td>Security Question</td>
            <td><input type="text" name="s_que" value="<?php echo $_POST["s_que"]?>">*</td>
        </tr>
        <tr>
            <td>Security Answer</td>
            <td><input type="text" name="s_ans" value="<?php echo $_POST["s_ans"]?>">*</td>
        </tr>
        <tr>
            <td>Phone No</td>
            <td><input type="text" name="pno" value="<?php echo $_POST["pno"]?>"></td>
        </tr>
        <tr>
            <td><input type="submit" value="Register"/></td>
            <td><input type="reset"></td>
        </tr>
        <tr>
            <td colspan="2" style="color: red"><?php echo $err?></td>
        </tr>
    </table>
    </form>

<?php require_once 'footer.php';?>
