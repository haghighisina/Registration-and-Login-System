<?php
session_start();

$error = '';

$email = val_input_email(filter_input(INPUT_POST, 'email',FILTER_SANITIZE_FULL_SPECIAL_CHARS));
if (empty($email))
{
    $error = "Please fill out the Email! ";
}

$pass = val_input_txt(filter_input(INPUT_POST, 'password',FILTER_SANITIZE_FULL_SPECIAL_CHARS));
if (empty($pass))
{
    $error = "Please fill out the Password! ";
}

if (empty($error)){

    //Query
    $query = "SELECT `userID`, `firstname`, `lastname`, `email`, `password`, `profileImage` FROM `user` WHERE email=?";

    $q = mysqli_stmt_init($con);

    mysqli_stmt_prepare($q, $query);

    mysqli_stmt_bind_param($q, 's', $email);

    mysqli_stmt_execute($q);

    $result = mysqli_stmt_get_result($q);

    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);


   if (!empty($row)){

       if (password_verify($pass, $row['password'])){

           session_start();

           $_SESSION['userID'] = $row['userID'];

           header("location: index.php");
           exit();
       }else{
           header("location: login.php?pass=1");
           exit();
       }
   }else{
       header("location: login.php?fill=1");
       exit();
   }
}else{
    session_start();

    $_SESSION['empty'] = $error;

    header("location: login.php?error=2");
    exit();
}