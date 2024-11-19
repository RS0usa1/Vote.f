const showAndHiddenSignup = (show) => {
const loginText = document.querySelector(".slide-title .login");
const loginForm = document.querySelector("form.login");

if (show) {
    loginForm.style.marginLeft = "-50%";
    loginText.style.marginLeft = "-50%";
} else {
    loginForm.style.marginLeft = "0%";
    loginText.style.marginLeft = "0%";
}
};

const handlerTab = (element, event) => {
if (event.srcElement.id === "signup") showAndHiddenSignup(true);

if (event.srcElement.id === "login") showAndHiddenSignup(false);
};

const signupLink = document.querySelector("form .signup-link a");
const signupBtn = document.querySelector("label.signup");

signupLink.onclick = () => {
signupBtn.click();
return false;
};