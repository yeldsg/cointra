<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@24,400,0,0"/>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Prociono&display=swap" rel="stylesheet">
<?php include __DIR__ . '/head-meta.php'; ?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css" integrity="sha512-2SwdPD6INVrV/lHTZbO2nodKhrnDdJK9/kg2XD1r9uGqPo1cUbujc+IYdlYdEErWNu69gVcYgdxlmVmzTWnetw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Document</title>
    <style>
        *{font-family: "Prociono";}
        input[type="password"]::-ms-reveal,
        input[type="password"]::-ms-clear {
            display: none;
        }
        input[type="password"]::-webkit-credentials-auto-fill-button {
            visibility: hidden;
            display: none;
        }
    </style>
</head>
<body class="min-h-screen bg-gray-100 flex items-center justify-center">
<div class="w-full max-w-3xl mx-auto grid grid-cols-1 md:grid-cols-2 min-h-[600px] rounded-xl overflow-hidden shadow-xl">

<div class="flex items-center justify-center bg-gradient-to-b from-yellow-200 to-green-300 relative order-2 md:order-1">
<img src="../assets/cointra-removebg-preview.png" alt="" class="justify-center items-center mt-8 w-40 sm:w-48 md:w-64 lg:w-72 mx-auto">
</div>
   <!--Form on left side-->
<div class="flex items-center justify-center bg-slate-200 p-8 order-1 md:order-2">
<div class="bg-white shadow-xl rounded-xl p-8 w-full max-w-sm border border-gray-200 relative">
    <a href="./sign-up.php">
         <button class="absolute right-3 top-3 text-gray-500 hover:text-green-400 transition-all duration-350 ease-in-out">
        <span class="material-symbols-rounded">arrow_back_ios</span>
    </button>
    </a>
    <p class="text-sm text-gray-400">WELCOME BACK!</p>
    <h1 class="text-2xl font-semibold text-center mb-2 mt-2">Log in to your Account</h1>
    <!--User name-->
    <div class="mb-2">
    <label class="block text-sm text-gray-800">Username or Email</label>
    <input id="nameInput" type="text" placeholder="Username or Email" class="w-full mt-1 px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-400" required>
     <p id="nameErr" class="text-red-600 text-sm mt-1 hidden">Please include your user name or email.</p>
    </div>

     <!--User password-->
   <div class="mb-2">
    <label class="block text-sm text-gray-800">Password</label>
    <div class="relative">
         <input id="passInput" type="password" placeholder="Password" class="w-full mt-1 px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-400" required>
          <span id="passToggle" class="material-symbols-rounded absolute right-3 top-1/2 -translate-y-1/2 text-gray-600 cursor-pointer select-none transition-opacity duration-150">visibility</span>
    </div>
    <p id="passErr" class="text-red-600 text-sm mt-1 hidden">Please use your correct password.</p>
   </div>

<div class="mb-2">
  <a href="newPassword-playground.html" id="forgotToggle" class="mt-4 text-red-400 hover:shadow-md shadow-lime-400 p-[6px] rounded-xl hover:bg-gradient-to-r from-green-200 to-lime-400 transition-all duration-300 ease-in-out hover:text-white hover:font-semibold">Forgot Password?</a>
 </div>
    
<button id="loginBtn" class="w-full bg-green-400 text-white font-medium py-2 rounded-lg mt-4  hover:shadow-md shadow-lime-300 duration-300 transition-all hover:bg-gradient-to-r from-green-400 to-lime-400 transition-all duration-300 ease-in-out">
Log In
</button>

</div>
</div>

</div>

<div id="ForgotModalOverlay" class="hidden fixed inset-0 z-[1000] flex items-center justify-center">
<div id="ForgotBackdrop" class="absolute inset-0 bg-black/30 backdrop-blur-md transition-opacity"></div>
<div id="ForgotModal" class="modal-panel relative w-[75%] max-w-3xl bg-white/90 rounded-2xl shadow-2xl ring-1 ring-white/40 p-4 md:p-6">
<button id="closeForgotModal" class="absolute right-4 top-4 bg-white/30 hover:bg-white/60 text-gray-700 p-2 rounded-md transition">
<span class="material-symbols-rounded">close</span>
</button>
<h2 class="text-xl font-semibold mb-4 text-center">Forgot Password</h2>
<p class="text-lg text-gray-600 mb-4 text-center">Enter your email to receive a password reset link.</p>
<label class="block text-md text-gray-800 font-semibold">Email</label>
<input id="forgotEmail" type="email" placeholder="Email" class="w-full mt-1 px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-400" required>
<p id="forgotErr" class="text-red-600 text-sm mt-1 hidden">Please include your valid email.</p>
<button id="submitForgot" class="w-full bg-green-400 text-white font-medium py-2 rounded-lg mt-4  hover:shadow-md shadow-lime-300 duration-300 transition-all hover:bg-gradient-to-r from-green-400 to-lime-400 transition-all duration-300 ease-in-out">
Submit Form
</button>
</div>
</div>
<script>
var loginBtn = document.getElementById("loginBtn");
var nameInput = document.getElementById("nameInput");
var nameErr = document.getElementById("nameErr");
var passInput = document.getElementById("passInput");
var passErr = document.getElementById("passErr");
var passToggle = document.getElementById("passToggle");
var ForgotModalOverlay = document.getElementById("ForgotModalOverlay");
var forgotToggle = document.getElementById("forgotToggle");
var closeForgotModal = document.getElementById("closeForgotModal");
var submitForgot = document.getElementById("submitForgot");
var forgotEmail = document.getElementById("forgotEmail");
var forgotErr = document.getElementById("forgotErr");
var RESET_EMAIL_KEY = "cointra_reset_email";

function loginUser() {
    var isCorrect = true;
    
    if (nameInput.value.trim() === "") {
        nameErr.classList.remove("hidden");
        nameInput.classList.add("border-red-500");
        nameInput.classList.remove("border-lime-500");
        isCorrect = false;
    } else {
        nameErr.classList.add("hidden");
        nameInput.classList.add("border-lime-500");
        nameInput.classList.remove("border-red-500");
    }

    if (passInput.value.trim() === "") {
        passErr.classList.remove("hidden");
        passInput.classList.add("border-red-500");
        passInput.classList.remove("border-lime-500");
        isCorrect = false;
    } else {
        passErr.classList.add("hidden");
        passInput.classList.add("border-lime-500");
        passInput.classList.remove("border-red-500");
    }

    if (isCorrect) {
        var xhr = new XMLHttpRequest();
        xhr.open('POST', '../api/auth.php?action=login', true);
        xhr.setRequestHeader('Content-Type', 'application/json');
        
        xhr.onreadystatechange = function() {
            if (xhr.readyState === 4) {
                if (xhr.status === 200) {
                    var result = JSON.parse(xhr.responseText);
                    if (result.success) {
                        window.location.href = "./expense.php";
                    } else {
                        alert('Login failed: ' + result.message);
                    }
                } else {
                    alert('Login error. Please try again.');
                }
            }
        };
        
        var data = JSON.stringify({
            username: nameInput.value.trim(),
            password: passInput.value.trim()
        });
        xhr.send(data);
    }
}

loginBtn.addEventListener("click", function(a) {
    a.preventDefault();
    loginUser();
});

passToggle.addEventListener("click", function() {
    passToggle.classList.add("opacity-0");
    setTimeout(function() {
        if (passInput.type === "password") {
            passInput.type = "text";
            passToggle.textContent = "visibility_off";
        } else {
            passInput.type = "password";
            passToggle.textContent = "visibility";
        }
        passToggle.classList.remove("opacity-0");
    }, 150);
});

forgotToggle.addEventListener("click", function(a) {
    a.preventDefault();
    ForgotModalOverlay.classList.remove("hidden");
});

closeForgotModal.addEventListener("click", function(a) {
    a.preventDefault();
    ForgotModalOverlay.classList.add("hidden");
});

function requestPasswordReset() {
    var emailValue = forgotEmail.value.trim();
    var validPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    
    if (!emailValue || !validPattern.test(emailValue)) {
        forgotErr.classList.remove("hidden");
        forgotEmail.classList.add("border-red-500");
        forgotEmail.classList.remove("border-lime-500");
        forgotErr.textContent = "Please include your valid email.";
        return;
    }

    forgotEmail.classList.remove("border-red-500");
    forgotErr.classList.add("hidden");
    forgotEmail.classList.add("border-lime-500");

    submitForgot.disabled = true;
    submitForgot.textContent = "Sending...";

    var xhr = new XMLHttpRequest();
    xhr.open("POST", "../api/auth.php?action=request_password_reset", true);
    xhr.setRequestHeader("Content-Type", "application/json");
    
    xhr.onreadystatechange = function() {
        if (xhr.readyState === 4) {
            submitForgot.disabled = false;
            submitForgot.textContent = "Submit Form";
            
            if (xhr.status === 200) {
                var result = JSON.parse(xhr.responseText);
                if (result.success) {
                    sessionStorage.setItem(RESET_EMAIL_KEY, emailValue);
                    window.location.href = "./newPassword.php";
                } else {
                    forgotErr.textContent = result.message || "Unable to process request.";
                    forgotErr.classList.remove("hidden");
                    forgotEmail.classList.add("border-red-500");
                    forgotEmail.classList.remove("border-lime-500");
                }
            } else {
                forgotErr.textContent = "Something went wrong. Please try again.";
                forgotErr.classList.remove("hidden");
                forgotEmail.classList.add("border-red-500");
                forgotEmail.classList.remove("border-lime-500");
            }
        }
    };
    
    var data = JSON.stringify({ email: emailValue });
    xhr.send(data);
}

submitForgot.addEventListener("click", function(event) {
    event.preventDefault();
    requestPasswordReset();
});
</script>
    
</body>
</html>