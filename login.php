<?php
session_start();
//header.php
include ("header.php");
include ('validate.php');
require ('DBConnect.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    require ('loginProcess.php');
}

$user = array();

if (isset($_SESSION['userID'])){
    $user = user_info($con, $_SESSION['userID']);
}
?>

<!-- Login -->
<section id="login">
<div class="row m-0">
<div class="col-lg-4 offset-lg-4">
    <div class="text-center pb-5">
        <h1 class="login-title text-dark">Login</h1>
        <p class="p-1 m-0 font-ubuntu text-danger">Welcome</p>
        <span class="font-ubuntu text-black-50">Create a new <a href="register.php">Account</a></span>
    </div>

    <div class="upload-profile-image d-flex justify-content-center pb-5">
        <div class="text-center">
            <img  class="img rounded-circle" src="<?php echo isset($user['profileImage']) ? $user['profileImage']:'assets/face.png';?>" alt="profile">
        </div>
    </div>

    <div class="d-flex justify-content-center">
        <h4 class="text-danger"><?php if (isset($_GET['error']) == '2') echo  $_SESSION['empty'];?></h4>
        <h4 class="text-danger"><?php if (isset($_GET['fill']) == '1') echo "You are not the member";?></h4>
        <h4 class="text-danger"><?php if (isset($_GET['pass']) == '1') echo "Password is not match";?></h4>
    </div>

    <div class="d-flex justify-content-center">
        <form action="login.php" method="post" enctype="multipart/form-data" id="log-form">
            <div class="form-row my-4">
                <div class="col">
                    <input type="text" name="email" required id="email" class="form-control"  placeholder="Email*">
                    <small id='result'></small>
                </div>
            </div>
            <div class="form-row my-4">
                <div class="col">
                    <input type="password" name="password" required id="password" class="form-control"  placeholder="Password*">
                </div>
            </div>
            <div class="submit-btn text-center my-5">
                <button type="submit" id='validate' class="btn btn-warning rounded-pill w-50 text-dark mx-5">Continue</button>
            </div>

        </form>
    </div>
</div>
</div>
</section>

<!-- End Login -->
<?php
//footer.php
include ("footer.php");
?>