<?php $page="login.php";?>
<?php require_once 'header.php'; ?>
<?php
$err="";
$msg="";
if($_REQUEST["msg"]==1){
   $msg = "Registration successful!!"; 
}
else if($_REQUEST["msg"]==2){
   $msg = "Your password has been sent!!"; 
}
else if($_REQUEST["msg"]==3){
   $msg = "Your password has been changed!!"; 
}
if(isset($_POST["email"]))
{
    $email =sanatize($_POST["email"]);
    $pass = sanatize($_POST["pass"]);   
    $query = "select * from app_users 
            where email = '$email' and pass= '$pass'";
    $r = run_sql($query);
    if(mysql_num_rows($r)>0){
        $row = mysql_fetch_array($r);
        $_SESSION["email"]=$email;
        $_SESSION["uname"]=$row["uname"];
        $_SESSION["role"]=$row["role"];
        redirect("index.php");
    }
    else {
        $err="Username or password is incorrect!";
    }
}
?>
      <h3 style="color: red"><?php echo $msg?></h3>
    <h1>Login</h1>
    <form method="post">
    <table>
        <tr>
            <td>E Mail</td>
            <td><input type="text" name="email"></td>
        </tr>
        <tr>
            <td>Password</td>
            <td><input type="password" name="pass"></td>
        </tr>
        <tr>
            <td><input type="submit" value="Login"/></td>
            <td><input type="reset"></td>
        </tr>
        <tr>
            <td colspan="2"><a href="forgot.php">Forgot Password</a></td>
        </tr>
        <tr>
            <td  colspan="2"  style="color: red"><?php echo $err?></td>
        </tr>
    </table>
    </form>
<?php require_once 'footer.php';?>
