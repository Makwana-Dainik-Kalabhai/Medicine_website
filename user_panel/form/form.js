$(document).ready(function () {

    //! fadeOut Form Error & success
    $("#form_error, #form_succ").fadeOut(7000);

    //! This is Signup Form
    /* This is for show password of signUp_form */
    $(".regi_form .fa-eye-slash").hide();
    $("#pass_des").hide();


    //When click on pass input, then display pass_description
    $("#sign_form .pass").focus(() => {
        $("#pass_des").show();
    });
    $("#sign_form .pass").blur(() => {
        $("#pass_des").hide();
    });
    
    
    //Click on show_pass btn in signUp_form, then display password
    $("#sign_form .fa-eye").click(function () {
        $("#sign_form .fa-eye").hide();
        $("#sign_form .fa-eye-slash").show();
        $("#sign_form .pass").attr("type", "text");
    });
    
    //Click on hide_pass btn in signUp_form, then hide the password
    $("#sign_form .fa-eye-slash").click(function () {
        $("#sign_form .fa-eye").show();
        $("#sign_form .fa-eye-slash").hide();
        $("#sign_form .pass").attr("type", "password");
    });
    
    
    // ! This is for Login Form
    /* This is for hide password of login_form */
    $(".fa-eye-slash").hide();
    
    //Click on show_pass btn in signUp_form, then display password
    $("#login_form .fa-eye").click(function () {
        $("#login_form .fa-eye").hide();
        $("#login_form .fa-eye-slash").show();
        $("#login_form .pass").attr("type", "text");
    });
    
    //Click on hide_pass btn in loginUp_form, then hide the password
    $("#login_form .fa-eye-slash").click(function () {
        $("#login_form .fa-eye").show();
        $("#login_form .fa-eye-slash").hide();
        $("#login_form .pass").attr("type", "password");
    });

    
    
    // Focus on password textbox, then display password description
    $(".pass").focus(() => {
        $("#pass_description").css("display","inline-block");
    });
    // Focus out on password textbox, then hide password description
    $(".pass").blur(() => {
        $("#pass_description").css("display","none");
    });
});