/*
Template Name: PDSI - Admin & Dashboard Template
Author: ICT PDSI
Website: https://ICT PDSI.com/
Contact: ICT PDSI@gmail.com
File: Password addon Js File
*/

// password addon
Array.from(document.querySelectorAll("form .auth-pass-inputgroup")).forEach(function (item) {
    Array.from(item.querySelectorAll(".password-addon")).forEach(function (subitem) {
        subitem.addEventListener("click", function (event) {
            var passwordInput = item.querySelector(".password-input");
            if (passwordInput.type === "password") {
                passwordInput.type = "text";
            } else {
                passwordInput.type = "password";
            }
        });
    });
});