//Sliding Animation
var sign_up_slider = document.getElementById("sign_up_slide");
var sign_in_slider = document.getElementById("sign_in_slide");
var container = document.getElementById("container");

//Sliding Animation Functions
sign_in_slider.addEventListener("click", () => {container.classList.add("right_cover-active")});
sign_up_slider.addEventListener("click", () => {container.classList.remove("right_cover-active")});



// Registration Validation
//document.getElementById("validate").addEventListener("click", valid()) 

// Registration Validation Functions
function valid(){

    var formElements = document.forms.validator;
    var username = formElements[0].value.toString();
    var password = formElements[1].value.toString();
    var repeat = formElements[2].value.toString();
    var email = formElements[3].value.toString();
    var username_good = false;
    var password_good = false;
    var email_good = false;
    var alpha_regex = /^[a-zA-Z0-9]+$/
    var username_regex = /^[^\d][A-Za-z0-9]+.{4,8}$/ 
    var password_regex = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,10}$/
    var email_regex = /^[a-zA-Z0-9.!#$%&’*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/

    if (username_regex.test(username)) {
        username_good = true;
        }

    if (alpha_regex.test(username) == false){
        username_good = false;
        }

    if (password_regex.test(password) && password === repeat) {
        password_good = true;
        }

    if (password_good == false || username_good == false) {
        alert("Invalid Username or Password")
    } 

    if (email_regex.test(email)) {
        email_good = true;
    }

    if (email_good == false) {
        alert("Invalid Email")
    }   else {
        document.getElementById('validator').submit()
    }
}




