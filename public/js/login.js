
const rmCheck = document.getElementById("rememberMe"),
emailInput = document.getElementById("email");

if (localStorage.checkbox && localStorage.checkbox !== "") {
rmCheck.setAttribute("checked", "checked");
emailInput.value = localStorage.username;
} else {
rmCheck.removeAttribute("checked");
emailInput.value = "";
}

function lsRememberMe() {
if (rmCheck.checked && emailInput.value !== "") {
localStorage.username = emailInput.value;
localStorage.checkbox = rmCheck.value;
} else {
localStorage.username = "";
localStorage.checkbox = "";
}
}



const togglePassword = document.querySelector("#togglePassword");
const password = document.querySelector("#password");

togglePassword.addEventListener("click", function () {
    // toggle the type attribute
    const type = password.getAttribute("type") === "password" ? "text" : "password";
    password.setAttribute("type", type);
    
    // toggle the icon
    this.classList.toggle("bi-eye");
});