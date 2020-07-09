<?php
session_start();
//header.php
include ("header.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    require ('registerProcess.php');
}
?>

<!-- registration -->
<section id="register">
<div class="row m-0">
    <div class="col-lg-4 offset-lg-4">
        <div class="text-center pb-5">
            <h1 class="login-title text-dark">Register</h1>
            <p class="p-1 m-0 font-ubuntu text-black-50">Registration</p>
            <span class="font-ubuntu text-black-50">I have <a href="login.php">Login</a></span>
        </div>

        <div class="upload-profile-image d-flex justify-content-center pb-5">
            <div class="text-center">
                <div class="d-flex justify-content-center">
                    <img class="img camera-icon" src="./assets/camera.png" alt="camera">
                </div>
                <img  class="img rounded-circle" src="./assets/face.png" alt="profile">
                <small class="form-text text-black-50">Choose Image</small>
                <input type="file" form="reg-form" class="form-control-file" name="profileUpload" id="upload-profile">
            </div>
        </div>

        <div class="d-flex justify-content-center">
            <h4 class="text-danger"><?php if (isset($_GET['Error']) == "1")echo $_SESSION['error'] ;?></h4>
        </div>

        <div class="d-flex justify-content-center">
            <form action="register.php" method="post" enctype="multipart/form-data" id="reg-form">
                <div class="form-row">
                    <div class="col">
                        <input type="text" value="<?php if (isset($_POST['firstName']))echo $_POST['firstName'];?>" name="firstName" id="firstName" class="form-control" placeholder="First Name">
                    </div>
                    <div class="col">
                        <input type="text" value="<?php if (isset($_POST['lastName']))echo $_POST['lastName'];?>" name="lastName" id="lastName" class="form-control" placeholder="Last Name">
                    </div>
                </div>

                <div class="form-row my-4">
                    <div class="col">
                        <input type="text" value="<?php if (isset($_POST['email']))echo $_POST['email'];?>" name="email" id="email" class="form-control" required placeholder="Email*">
                        <small id='result'></small>
                    </div>
                </div>

                <div class="form-row my-4">
                    <div class="col">
                        <input type="password" name="password" id="password" class="form-control" required placeholder="Password*">
                    </div>
                </div>

                <div class="form-row my-4">
                    <div class="col">
                        <input type="password" name="confirm-pass" id="confirm-pass" class="form-control" required placeholder="Confirm Password*">
                        <small id="confirm-error" class="text-danger"></small>
                    </div>
                </div>

                <div class="form-check form-check-inline">
                    <input type="checkbox" name="agreement" required class="form-check-input">
                    <label for="agreement" class="form-check-label font-ubuntu text-black-50">I agree <a href="#">Term and Policy </a>(*)</label>
                </div>

                <div class="submit-btn text-center my-5">
                    <button type="submit" id='validate' class="btn btn-warning rounded-pill w-50 text-dark mx-5">Continue</button>
                </div>

            </form>
        </div>
    </div>
</div>
</section>

<!-- End registration -->
<?php
//footer.php
include ("footer.php");
?>