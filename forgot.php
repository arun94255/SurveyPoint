<?php $page="forgot.php";?>
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
    else if(!is_exist ($_POST["email"])){
        $err = "E Mail not registered!";
    }
    else if(!check_required($_POST["s_que"])){
        $err = "Security Question is required";
    }
    else if(!check_required($_POST["s_ans"])){
        $err = "Security answer is required";
    }
    else {
        
    $email =sanatize($_POST["email"]);
    $s_que = sanatize($_POST["s_que"]);   
    $s_ans = sanatize($_POST["s_ans"]);   
    $query = "select * from app_users 
            where email = '$email' and s_que= '$s_que' 
            and  s_ans= '$s_ans'";
    $r = run_sql($query);
    if(mysql_num_rows($r)>0){
        $row = mysql_fetch_array($r);
        $pass=$row["pass"];
        mail_it($email, "MySurvey password!!", "Your password is $pass", null);        
        redirect("login.php?msg=2");
    }
    else {
        $err="Incorrect information!";
    }
    }
}
?>
    <h1>Forgot Password</h1>
    <form method="post">
    <table>
        <tr>
            <td>E Mail</td>
            <td><input type="text" name="email" value="<?php echo $_POST["email"]?>">*</td>
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
            <td><input type="submit" value="Get Password"/></td>
            <td><input type="reset"></td>
        </tr>
        <tr>
            <td colspan="2" style="color: red"><?php echo $err?></td>
        </tr>
    </table>
    </form>
<?php require_once 'footer.php';?>
