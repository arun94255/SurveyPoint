<?php $page="createser.php";?>
<?php 
require_once 'header.php'; 
require_once 'include/form_func.php'; 
check_login();
?>
<?php
$err="";
if(isset($_POST["que"]))
{
    if(!check_required($_POST["que"])){
        $err = "Question is required";
    }
    else if(!check_required ($_POST["op1"])){
        $err = "Option 1 is required!";
    }
    else if(!check_required ($_POST["op2"])){
        $err = "Option 2 is required!";
    }
    else {
    $query="INSERT INTO `survey` (`que`, `op1`, `op2`, 
        `op3`, `op4`, `email`,  
        created_date, `status`) 
        VALUES ('$_POST[que]', '$_POST[op1]', '$_POST[op2]', 
        '$_POST[op3]', '$_POST[op4]', '$_SESSION[email]', 
        '$today' , 'new');";
        $r = run_sql($query);
        redirect("index.php?msg=1");
    }
}
?>
    <h1>Create Survey</h1>
    <form method="post">
    <table>
        <tr>
            <td>Question</td>
            <td>
                <textarea name="que" cols="60" rows="5"><?php echo $_POST["que"]?></textarea>
            </td>
        </tr>
        <tr>
            <td>Option 1</td>
            <td>
                <textarea name="op1" cols="60" rows="3"><?php echo $_POST["op1"]?></textarea>
            </td>
        </tr>
        <tr>
            <td>Option 2</td>
            <td>
                <textarea name="op2" cols="60" rows="3"><?php echo $_POST["op2"]?></textarea>
            </td>
        </tr>
        <tr>
            <td>Option 3</td>
            <td>
                <textarea name="op3" cols="60" rows="3"><?php echo $_POST["op3"]?></textarea>
            </td>
        </tr>
        <tr>
            <td>Option 4</td>
            <td>
                <textarea name="op4" cols="60" rows="3"><?php echo $_POST["op4"]?></textarea>
            </td>
        </tr>
        <tr>
            <td><input type="submit" value="Create"/></td>
            <td><input type="reset"></td>
        </tr>
        <tr>
            <td colspan="2" style="color: red"><?php echo $err?></td>
        </tr>
    </table>
    </form>

<?php require_once 'footer.php';?>
