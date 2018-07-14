<?php
$page="";
require_once 'include/const.php';
mysql_connect(DB_SERVER, DB_USER, DB_PASS) or die(mysql_error());
$query = "DROP SCHEMA if exists $dbname;";
$r=mysql_query($query);
if(!$r){
    die("could not drop database");
}
$query = "CREATE SCHEMA $dbname;";
$r=mysql_query($query);
if(!$r){
    die("could not create database");
}
echo "db created!!</br>";
mysql_select_db($dbname);
$query = "CREATE  TABLE `app_users` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `uname` VARCHAR(45) NULL ,
  `email` VARCHAR(45) NULL ,
  `pass` VARCHAR(45) NULL ,
  `s_que` VARCHAR(100) NULL ,
  `s_ans` VARCHAR(100) NULL ,
  `role` VARCHAR(45) NULL ,
  `status` VARCHAR(45) NULL ,
  `phone_no` VARCHAR(45) NULL ,
  PRIMARY KEY (`id`) ,
  UNIQUE INDEX `email_UNIQUE` (`email` ASC) );";
$r=mysql_query($query);
if(!$r){
    die("could not create app_users");
}
echo "app_users created!!</br>";
$query="INSERT INTO `app_users` (`uname`, `email`, `pass`, 
    `s_que`, `s_ans`, `role`, 
    `status`) 
    VALUES ('admin', 'admin', 'admin', 
    'admin', 'admin', 'admin', 
    'approved');";
$r=mysql_query($query);
if(!$r){
    die("could not insert admin");
}
echo "admin inserted!!</br>";

$query = "CREATE TABLE survey (
  id int(11) NOT NULL AUTO_INCREMENT,
  email varchar(45) DEFAULT NULL,
  que text,
  op1 text,
  op2 text,
  op3 text,
  op4 text,
  count_op1 int(11) DEFAULT '0',
  count_op2 int(11) DEFAULT '0',
  count_op3 int(11) DEFAULT '0',
  count_op4 int(11) DEFAULT '0',
  status varchar(45) DEFAULT NULL,
  created_date datetime DEFAULT NULL,
  PRIMARY KEY (id)
) ;
";
$r=mysql_query($query);
if(!$r){
    die("could not create survey");
}
echo "survey created!!</br>";

$query = "CREATE  TABLE participant (
  sid INT NOT NULL ,
  email VARCHAR(100) NOT NULL ,
  ans VARCHAR(45) NULL ,
  PRIMARY KEY (sid, email) );


";
$r=mysql_query($query);
if(!$r){
    die("could not create participant");
}
echo "participant created!!</br>";

?>
