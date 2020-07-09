<?php

function val_input_txt($textVal)
{
    if (!empty($textVal))
    {
        $trim     = trim($textVal);

        $sanitize = filter_var($trim, FILTER_SANITIZE_STRING);

        return $sanitize;
    }
    return '';
}

function val_input_email($emailVal)
{
    if (!empty($emailVal))
    {
        $trim     = trim($emailVal);

        $sanitize = filter_var($trim, FILTER_SANITIZE_EMAIL);

        $filter   = filter_var($sanitize, FILTER_VALIDATE_EMAIL);

        return $filter;
    }
    return '';
}



function upload_file($path, $file)
{

    $target  = $path;
    $default = "face.png";

    $filename = basename($file['name']);
    $targetFilePath = $target.$filename;
    $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);

    if (!empty($filename)){

        $allowType = array('jpg', 'png', 'jpeg', 'gif', 'pdf');

        if (in_array($fileType, $allowType)) {


            if (move_uploaded_file($file['tmp_name'], $targetFilePath)) {
                return $targetFilePath;
            }
        }else{
            echo "The extension was not right.we choose the default one ";
        }
    }

    //return default image
    return $path.$default;

}

//user info
function user_info($con, $userID)
{
    $query = "SELECT `firstname`, `lastname`, `email`, `profileImage` FROM `user` WHERE userID=?";

    $q = mysqli_stmt_init($con);

    mysqli_stmt_prepare($q,$query);

    mysqli_stmt_bind_param($q, 'i', $userID);

    mysqli_stmt_execute($q);

    $result = mysqli_stmt_get_result($q);

    $row = mysqli_fetch_array($result);

    return empty($row) ? false:$row;
}







