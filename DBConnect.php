<?php

define('DB_NAME', 'register');
define('DB_USER', 'root');
define('DB_PASSWORD', '');
define('DB_HOST', 'localhost');

try{

    //connection
    $con = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

    mysqli_set_charset($con, 'utf8');

}catch (Exception $e){
    print "An Error occurred".$e->getMessage();
}catch (Error $e){
    print "Try later";
}