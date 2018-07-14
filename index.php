<?php $page="index.php";?>
<?php require_once 'header.php'; ?>
    <?php
    if(is_login()){
        echo "<p><a href='createser.php'>Create Survey</a></p>";
    }
    $msg="";
    if($_REQUEST["msg"]==1){
        $msg = "Thanks for participation!!"; 
    }

    ?>
      <h1>Survey</h1>
    <?php
    $query = "select * from survey order by id desc";
    $r = run_sql($query);
    ?>
      <h3 style="color: red"><?php echo $msg?></h3>
    <table style="border-collapse: collapse" border="1" width="80%">
            <tr>
                <th width="10%">Id</th>
                <th width="90%">Question</th>
            </tr>
            <?php
            while($row =mysql_fetch_array($r)){
                 $que = $row[que];
                $que100 = substr($que, 0, 95);
                if(strlen($que)>strlen($que100)){
                    $que100 .= "....."; 
                }
                echo "<tr>";
                    echo "<td><a href='det_que.php?id=$row[id]' >$row[id]</a></td>";
                    echo "<td><a href='det_que.php?id=$row[id]' >$que100</a></td>";
                echo "</tr>";
            }
            ?>
    </table>
<?php require_once 'footer.php';?>