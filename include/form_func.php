<?php
function check_required($v) {
if (!isset($v) || (empty($v))) { 
    return false;    
}
else {
    return true;
}
}


function check_email( $email ){
    if(!filter_var( $email, FILTER_VALIDATE_EMAIL ))
	{
        return false;
	}
        else {
	return true;            
        }
}

function check_phone_no( $pn ){
    if(!preg_match('/^0?[7-9]{1}[0-9]{9}$/', $pn))
	{
        return false;
	}
        else {
            return true;
        }
}

function check_numeric($v) {
   if (!is_numeric($v)) { 
   return false;
}
else {
return true;   
}	
}

function check_date($date_str) {
$date = DateTime::createFromFormat('d/m/Y', $date_str);
if($date==NULL || !($date_str == date_format($date, 'd/m/Y')))
{
return false;
}
else {
    return true;
}
}
function check_password($pwd) {
    $err="";
    if (strlen($pwd) < 8) {
        $err = "Password too short!";
    }

    if (!preg_match("#[0-9]+#", $pwd)) {
       $err = "Password must include at least one number!";
    }

    if (!preg_match("#[a-zA-Z]+#", $pwd)) {
        $err = "Password must include at least one letter!";
    }     
    return $err;
}
?>