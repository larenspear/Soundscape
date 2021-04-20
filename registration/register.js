//Sliding Animation
var sign_up_slider = document.getElementById("sign_up_slide");
var sign_in_slider = document.getElementById("sign_in_slide");
var container = document.getElementById("container");

//Sliding Animation Functions
sign_in_slider.addEventListener("click", () => {container.classList.add("right_cover-active")});
sign_up_slider.addEventListener("click", () => {container.classList.remove("right_cover-active")});


// Login Validation
function validate_login(){
    var email = document.forms["existing_user"]["email"].value.toString();
    var password = document.forms["existing_user"]["password"].value.toString();

    var regex_email = /^[^\s@]+@([^\s@.,]+\.)+[^\s@.,]{2,}$/;
    var regex_password = /(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?!.*[^a-zA-Z0-9]).{6,10}$/;
    

    if (regex_email.test(email) && regex_password.test(password)) {
        //confirmation message
        alert("Login Successful!");

    } else {
        //alert("Invalid email or password!");
        document.getElementById("login_error1").innerHTML = "<u>Username requirements:</u><br>* 6-10 characters long<br>* Contains only letters and digits<br>* Cannot start with a digit";
        document.getElementById("login_error2").innerHTML = "<u>Password requirements:</u><br>* 6-10 characters long<br>* Contains at least one uppercase letter,<br>one lowercase letter, and one digit";
        document.getElementById("login_error1").style.visibility = "visible";
        document.getElementById("login_error2").style.visibility = "visible";
        return false;
    }
}

//Registration Validation
function validate_registration(){
    var username = document.forms["new_user"]["username"].value.toString();
    var email = document.forms["new_user"]["email"].value.toString();
    var password = document.forms["new_user"]["password"].value.toString();

    var regex_username = /^[a-zA-Z][a-zA-Z0-9]{5,9}$/; //6-10 characters, cannot start with digit
    var regex_email = /^[^\s@]+@([^\s@.,]+\.)+[^\s@.,]{2,}$/;
    var regex_password = /(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?!.*[^a-zA-Z0-9]).{6,10}$/;
    

    if (regex_username.test(username) && regex_email.test(email) && regex_password.test(password)) {
        //confirmation message
        alert("Registration Successful!");

    } else {
        //alert("Invalid username, email or password!");
        document.getElementById("signup_error1").innerHTML = "<u>Username requirements:</u><br>* 6-10 characters long<br>* Contains only letters and digits<br>* Cannot start with a digit";
        document.getElementById("signup_error2").innerHTML = "<u>Password requirements:</u><br>* 6-10 characters long<br>* Contains at least one uppercase letter,<br>one lowercase letter, and one digit";
        document.getElementById("signup_error1").style.visibility = "visible";
        document.getElementById("signup_error2").style.visibility = "visible";
        return false;
    }

}
