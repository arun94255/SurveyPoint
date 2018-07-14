<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<?php
    require_once 'include/myfunc.php';
    require_once 'include/const.php';
    require_once 'include/db.php';
    require_once 'include/my_mail.php';
 function err_hand($eno, $emsg){     
 }   
 set_error_handler("err_hand", E_NOTICE | E_STRICT);
 ob_start();
 session_start();
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Paint Blog Template - free CSS template</title>
<meta name="keywords" content="paint blog, free templates, website templates, CSS, HTML" />
<meta name="description" content="Paint Blog - free blog website template provided by TemplateMo.com" />
<link href="templatemo_style.css" rel="stylesheet" type="text/css" />
<!--  Free CSS Template is designed by TemplateMo.com  -->
<!--[if lt IE 7]>
<style type="text/css">

  .date_section, .comment{ behavior: url(iepngfix.htc); }

</style>
<![endif]-->
</head>
<body>    

<div id="templatemo_top_panel">
    <img src="images/templatemo_header_bg.jpg" style="width: 100%; height: 100%"/>
</div>    
<div id="templatemo_menu_panel">
    <div id="templatemo_menu_section">
        <ul>
            <li><a href="index.php" class="current">Home</a></li>
            <?php
            if(is_login())
            {
               ?>
            <li><a href="logout.php">Logout</a></li>
            <?php
            }
            else {
            ?>
            <li><a href="login.php">Login</a></li>
            <li><a href="register.php">Register Now</a></li>  
            <?php
            }
            ?>
            <li><a href="abtus.php">About Us</a></li> 
            <li><a href="contact.php" class="lastmenu">Contact Us</a></li>                     
        </ul> 
    </div>
    <?php
    if(is_login()){
     echo " <p style='float: right;padding-right: 30px;'>Welcome   $_SESSION[uname]</br><a href='chpass.php'>Change Password</a></p> ";
    }
    ?>

</div> <!-- end of menu -->
<div id="templatemo_content_panel">
	<div id="templatemo_content">
    	
        <div id="templatemo_content_left">
            <div class="templatemo_content_left_section">
            	<div class="left_section_title">Recent Survey</div>
                <div class="left_section_content">
                	<ul>
                         <?php
                        $query = "select * from survey order by id desc limit 5 ";
                        $r = run_sql($query);
                                    while($row =mysql_fetch_array($r)){
                 $que = $row[que];
                $que100 = substr($que, 0, 30);
                if(strlen($que)>strlen($que100)){
                    $que100 .= "....."; 
                }
                echo "<li>";
                    echo "<a href='det_que.php?id=$row[id]' >$que100</a>";
                echo "</li>";
            }
                         ?>   
                    </ul>
                </div>
            </div>
            
         </div> <!-- end of content left -->
         
         <div id="templatemo_content_right">
        	<div class="templatemo_post_section">
<!--
                    <div class="date_section">
                	19<span>OCT</span>                   
                </div>
-->

