<?php

require ("validate.php");

$error ='';

$firstName = val_input_txt(filter_input(INPUT_POST, 'firstName',FILTER_SANITIZE_FULL_SPECIAL_CHARS ));
if (empty($firstName))
{
    $error = "Please fill out the Name!";
}

$lastName = val_input_txt(filter_input(INPUT_POST, 'lastName',FILTER_SANITIZE_FULL_SPECIAL_CHARS));
if (empty($lastName))
{
    $error = "Please fill out the Last Name!";
}


$file = $_FILES['profileUpload'];
$profile_image = upload_file('./assets/', $file);


$email = val_input_email(filter_input(INPUT_POST, 'email',FILTER_SANITIZE_FULL_SPECIAL_CHARS));
if (empty($email))
{
    $error = "Please fill out the Email! ";
}

$pass = val_input_txt(filter_input(INPUT_POST, 'password',FILTER_SANITIZE_FULL_SPECIAL_CHARS));
if (empty($pass))
{
    $error = "Please fill out the Password!";
}

$confirm_pass = val_input_txt(filter_input(INPUT_POST, 'confirm-pass',FILTER_SANITIZE_FULL_SPECIAL_CHARS));
if (empty($confirm_pass))
{
    $error = "Please fill out the Confirm Password!";
}

if ($pass !== $confirm_pass){
    $error = "Passwords are not match";
}


if (empty($error)){

    //register User
    $hash_pass = password_hash($pass, PASSWORD_DEFAULT);
    require ('DBConnect.php');

    //query
    $query = "INSERT INTO user(userID,firstname,lastname,email,password,profileImage,registerDate)";
    $query .= "VALUES('',?,?,?,?,?,NOW())";

    //initialize statement
    $q = mysqli_stmt_init($con);

    //prepare statement
    mysqli_stmt_prepare($q, $query);

    //bind values
    mysqli_stmt_bind_param($q, 'sssss', $firstName, $lastName, $email, $hash_pass, $profile_image);

    //execute
    mysqli_stmt_execute($q);

    if (mysqli_stmt_affected_rows($q) == 1){

        session_start();

        $_SESSION['userID'] = mysqli_insert_id($con);

        header("location: login.php");
        exit();
    }else{
        echo "Something went Wrong !";
    }
}else {
    session_start();

    $_SESSION['error'] = $error;

    header("location: register.php?Error=1");
    exit();
}









