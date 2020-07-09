

$(document).ready(function (e) {

    let $uploadfile = $('#register.upload-profile-image input[type="file"]');

    $uploadfile.change(function (){
       readURL(this);
    });

    $("#reg-form").submit(function (event) {

        let $password = $("#password");
        let $confirm  = $("#confirm-pass");
        let $error    = $("#confirm-error");

        if($password.val() === $confirm.val()){
            return true;
        }else{
            $error.text("Password are not match");
            event.preventDefault();
            return false;
        }
    });

});

function readURL(input)
{
    if(input.files && input.files[0]){
        let reader = new FileReader();
        reader.onload = function(e){
            $("#register.upload-profile-image.img").attr('src',e.target.result);
            $("#register.upload-profile-image.camera-icon").css({display:"none"});
        }

        reader.readAsDataURL(input.files[0]);
    }

}







function validateEmail(email) {
    const re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(email);
}

function validate() {
    const $result = $("#result");
    const email   = $("#email").val();
    $result.text("");

    if (validateEmail(email)) {

        return true;

    } else {
        $result.text(email + "Email is not valid :(");
        $result.css("color", "red");
    }
    return false;
}

$("#validate").on("click", validate);


