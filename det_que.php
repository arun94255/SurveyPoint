<?php $page="det_que.php";?>
<?php require_once 'header.php'; ?>
<?php require_once 'include/form_func.php'; ?>
    <?php
    $showres= false;
    if(isset($_POST["id"]))
{
    if(!check_required($_POST["ans"])){
        $err = "Please select an answer!";
    }
    else if(!check_required($_POST["email"])){
        $err = "E Mail is required!";
    }
    else if(!check_email ($_POST["email"])){
        $err = "E Mail is incorrect!";
    }
    else {
        //mail_it($_POST["email"], "test", "test", null);
    $query="INSERT INTO `participant` (`sid`, `email`, `ans`) 
        VALUES ('$_POST[id]', '$_POST[email]', '$_POST[ans]');";
        global $dbname;
        mysql_connect(DB_SERVER, DB_USER, DB_PASS) 
            or die("Could not connect ". mysql_error());
        mysql_select_db($dbname);
        $r=mysql_query($query);
        if(mysql_affected_rows()>0){
            switch($_POST["ans"]){
                case "op1":
                    $inc =  " count_op1 = count_op1 +1 ";
                    break;
                case "op2":
                    $inc =  " count_op2 = count_op2 +1 ";
                    break;
                case "op3":
                    $inc =  " count_op3 = count_op3 +1 ";
                    break;
                case "op4":
                    $inc =  " count_op4 = count_op4 +1 ";
                    break;
            }
            $query = "update survey set $inc where id = $_POST[id] ";
            $r = run_sql($query);
            $showres = true;
        }
        else {
            $err = "You have already participated on the survey!!";            
        }
}
}
    $query = "select * from survey where id = $_REQUEST[id]";
    $r = run_sql($query);
    ?>

            <?php
            if($row =mysql_fetch_array($r)){
                if($showres==false)
                {
                    echo "<form method='post'>";
                    if(!is_login()){
                    echo "<p><strong>E Mail :</strong> <input type='text' name='email'/></p>";                        
                    }
                    else {
                    echo "<input type='hidden' name='email' value = '$_SESSION[email]'/>";                        
                    }
                    echo "<p><strong>Question :</strong> $row[que]</p>";
                    echo "<p><input type='radio' name='ans' value = 'op1'>$row[op1]</input></p>";
                    echo "<p><input type='radio' name='ans' value = 'op2'>$row[op2]</input></p>";
                    if($row[op3]!=""){
                    echo "<p><input type='radio' name='ans' value = 'op3'>$row[op3]</input></p>";                        
                    }
                    if($row[op4]!=""){
                    echo "<p><input type='radio' name='ans' value = 'op4'>$row[op4]</input></p>";
                    }
                    if(($_SESSION["email"] == $row["email"]) || is_admin()){
                    echo "<p >op1 : $row[count_op1], op2 : $row[count_op2]";                        
                    if($row[op3]!=""){
                    echo ", op3 : $row[count_op3]";                        
                    }
                    if($row[op4]!=""){
                    echo ", op4 : $row[count_op4]";                        
                    }
                    echo "</p>";  
                    echo "<p ><a href='del_que.php?id=$row[id]' style='color:blue' >Delete</a></p>";                        
                    }
                    echo "<input type='hidden' name='id' value = '$row[id]'/>";
                    echo "<p><a href='index.php' style='color:blue'>Back</a></p>";
                    echo "<p><input type='submit' value='Submit'/></p>";
                    echo "</form>";
                }
                else {
                    echo "<p><strong>Question :</strong> $row[que]</p>";
                    echo "<p>$row[op1]</p>";
                    echo "<p>$row[op2]</p>";
                    if($row[op3]!=""){
                    echo "<p>$row[op3]</p>";
                    }
                    if($row[op4]!=""){
                    echo "<p>$row[op4]</p>";
                    }
                    echo "<p >op1 : $row[count_op1], op2 : $row[count_op2]";                        
                    if($row[op3]!=""){
                    echo ", op3 : $row[count_op3]";                        
                    }
                    if($row[op4]!=""){
                    echo ", op4 : $row[count_op4]";                        
                    }
                    echo "</p>";                        
                    echo "<p><a href='index.php' style='color:blue'>Back To List</a></p>";
                }
            }
            echo "$err";
            ?>
<?php require_once 'footer.php';?>