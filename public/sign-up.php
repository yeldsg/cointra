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
    <title>Sign Up</title>
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
   <!--Form on left side-->
<div class="flex items-center justify-center bg-slate-200 p-8 order-2 md:order-1">
<div class="bg-white shadow-xl rounded-xl p-8 w-full max-w-sm border border-gray-200 relative">
    <a href="./landing.php">
         <button class="absolute right-3 top-3 text-gray-500 hover:text-green-400 transition-all duration-350 ease-in-out">
        <span class="material-symbols-rounded">arrow_back_ios</span>
    </button>
    </a>
    
    <h1 class="text-2xl font-semibold text-center mb-2 mt-4">Create your Account</h1>
    <!--Username-->
    <div class="mb-2">
    <label class="block text-sm text-gray-800">Username</label>
    <input id="nameInput" type="text" placeholder="Username" class="w-full mt-1 px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-400" required>
     <p id="nameErr" class="text-red-600 text-sm mt-1 hidden">Please include your username.</p>
    </div>
    <!--User email -->
   <div class="mb-2">
    <label class="block text-sm text-gray-800">Email</label>
    <input id= "emailInput" type="text" placeholder="Email" class="w-full mt-1 px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-400" required>
    <p id="emailErr" class="text-red-600 text-sm mt-1 hidden">Please enter a valid email.</p>
    </div>
     <!--User password-->
   <div class="mb-2">
    <label class="block text-sm text-gray-800">Password</label>
    <div class="relative">
         <input id="passInput" type="password" placeholder="Password" class="w-full mt-1 px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-400" required>
          <span id="passToggle" class="material-symbols-rounded absolute right-3 top-1/2 -translate-y-1/2 text-gray-600 cursor-pointer select-none transition-opacity duration-150">visibility</span>
    </div>
    <p id="passErr" class="text-red-600 text-sm mt-1 hidden">Please include a strong password.</p>
   </div>
    
<button id="signupBtn" class="w-full bg-green-400 text-white font-medium py-2 rounded-lg mt-4  hover:shadow-md shadow-lime-300 duration-300 transition-all hover:bg-gradient-to-r from-green-400 to-lime-400 transition-all duration-300 ease-in-out">
Sign Up
</button>

</div>
</div>

<div class="flex items-center justify-center bg-gradient-to-b from-yellow-200 to-green-300 relative order-1 md:order-2">
<img src="../assets/cointra-removebg-preview.png" alt="" class="justify-center items-center mt-8 w-40 sm:w-48 md:w-64 lg:w-72 mx-auto">
</div>
</div>

<div id="ToS" class="fixed inset-0 bg-white/20 backdrop-blur-md hidden flex items-center justify-center z-50">
<div class="bg-white/30 rounded-xl shadow-lg p-6 w-11/12 max-w-md">
<h2 class="text-xl font-semibold text-center mb-4">📑 Terms of Service – Cointra</h2>
<div class="text-sm text-gray-700 mb-3 max-h-56 overflow-y-auto pr-2">
    <p class="text-sm text-gray-700 mb-3">
    Last Updated: Nov. 19, 2025 <br><br>
Welcome to Cointra, a finance and budget tracking system with expense categorization for individual users. By accessing or using our website and services, you agree to the following terms:<br>
1. Acceptance of Terms<br>
By creating an account or using Cointra, you confirm that you have read, understood, and agreed to these Terms of Service.<br><br>
2. Use of Service<br>
Cointra is an academic project created for educational purposes.<br>
Users may log income, expenses, and budget information for personal use only.<br>
You agree not to misuse the system or engage in activities that could disrupt service for others.<br><br>
3. User Accounts<br>
You are responsible for safeguarding your account credentials.<br>
Any activity under your account will be considered your responsibility.<br><br>
4. Data and Content<br>
You retain ownership of the data you input (income, expenses, categories, goals).<br>
By using the system, you grant Cointra permission to process your data for generating reports, charts, and analysis.<br><br>
5. Limitations of Liability<br>
Cointra does not provide professional financial, investment, or legal advice.<br>
We are not liable for any losses or financial decisions made based on the information generated by the system.<br><br>
6. Termination<br>
We may suspend or terminate accounts that violate these terms.<br><br>
</p>

</div>

<label class="flex items-center gap-2 cursor-pointer mb-4">
<input type="checkbox" id="tosAgree" class="w-4 h-4">
<span class="text-sm text-gray-600">I agree to the Terms of Service and Conditions of Cointra.</span>
<p id="tosError" class="text-red-500 text-xs mb-2 hidden">You must agree before continuing in the site.</p>

<div class="flex justify-end gap-3">
<button id="closeTos" class="px-4 py-2 bg-gray-300 rounded-lg text-gray-700 hover:bg-red-500 transition-all duration-300 ease-in-out hover:text-white">Cancel</button>
<button id="acceptTos" class="px-4 py-2 bg-gray-300 border border-lime-500 rounded-lg text-gray-700 hover:bg-green-500 transition-all duration-300 ease-in-out hover:text-white">Accept</button>
</div>
</label>
</div>    
</div>

<script>
var signupBtn = document.getElementById("signupBtn");
var nameInput = document.getElementById("nameInput");
var nameErr = document.getElementById("nameErr");
var passInput = document.getElementById("passInput");
var passErr = document.getElementById("passErr");
var passToggle = document.getElementById("passToggle");
var emailInput = document.getElementById("emailInput");
var emailErr = document.getElementById("emailErr");
var ToS = document.getElementById("ToS");
var tosAgree = document.getElementById("tosAgree");
var tosError = document.getElementById("tosError");
var closeTos = document.getElementById("closeTos");
var acceptTos = document.getElementById("acceptTos");

function validEmail(email) {
    return /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email);
}

function validateSignup() {
    var isCorrect = true;
    var nameVal = nameInput.value.trim();
    
    if (nameVal === "") {
        nameErr.innerHTML = "Please enter your username.";
        nameErr.classList.remove("hidden");
        nameInput.classList.add("border-red-500");
        nameInput.classList.remove("border-lime-500");
        isCorrect = false;
    } else if (!/^[a-zA-Z0-9._]+$/.test(nameVal)) {
        nameErr.innerHTML = "Username can only contain letters, numbers, underscore (_), or dot (.)";
        nameErr.classList.remove("hidden");
        nameInput.classList.add("border-red-500");
        nameInput.classList.remove("border-lime-500");
        isCorrect = false;
    } else {
        nameErr.classList.add("hidden");
        nameInput.classList.add("border-lime-500");
        nameInput.classList.remove("border-red-500");
    }

    var emailVal = emailInput.value.trim();
    if (emailVal === "" || !validEmail(emailVal)) {
        emailErr.classList.remove("hidden");
        emailInput.classList.add("border-red-500");
        emailInput.classList.remove("border-lime-500");
        isCorrect = false;
    } else {
        emailErr.classList.add("hidden");
        emailInput.classList.add("border-lime-500");
        emailInput.classList.remove("border-red-500");
    }

    var passVal = passInput.value.trim();
    if (passVal === "") {
        passErr.innerHTML = "Please enter your password.";
        passErr.classList.remove("hidden");
        passInput.classList.add("border-red-500");
        passInput.classList.remove("border-lime-500");
        isCorrect = false;
    } else {
        var passErrors = [];
        if (passVal.length < 8) {
            passErrors.push("Password must be at least 8 characters.");
        }
        if (!/[A-Z]/.test(passVal)) {
            passErrors.push("Password must contain an uppercase letter.");
        }
        if (!/[a-z]/.test(passVal)) {
            passErrors.push("Password must contain a lowercase letter.");
        }
        if (!/[0-9]/.test(passVal)) {
            passErrors.push("Password must contain a number.");
        }
        if (!/[@$!%*?&]/.test(passVal)) {
            passErrors.push("Password must contain a special character.");
        }

        if (passErrors.length > 0) {
            passErr.innerHTML = passErrors.join("<br>");
            passErr.classList.remove("hidden");
            passInput.classList.add("border-red-500");
            passInput.classList.remove("border-lime-500");
            isCorrect = false;
        } else {
            passErr.classList.add("hidden");
            passInput.classList.add("border-lime-500");
            passInput.classList.remove("border-red-500");
        }
    }

    if (isCorrect) {
        ToS.classList.remove("hidden");
    }
}

signupBtn.addEventListener("click", function(a) {
    a.preventDefault();
    validateSignup();
});

closeTos.addEventListener("click", function() {
    ToS.classList.add("hidden");
    tosAgree.checked = false;
    tosError.classList.add("hidden");
});

function submitSignup() {
    if (!tosAgree.checked) {
        tosError.classList.remove("hidden");
        return;
    }
    tosError.classList.add("hidden");

    var xhr = new XMLHttpRequest();
    xhr.open('POST', '../api/auth.php?action=signup', true);
    xhr.setRequestHeader('Content-Type', 'application/json');
    
    xhr.onreadystatechange = function() {
        if (xhr.readyState === 4) {
            if (xhr.status === 200) {
                var result = JSON.parse(xhr.responseText);
                if (result.success) {
                    window.location.href = "./login.php";
                } else {
                    alert('Sign up failed: ' + result.message);
                }
            } else {
                alert('Sign up error. Please try again.');
            }
        }
    };
    
    var data = JSON.stringify({
        username: nameInput.value.trim(),
        email: emailInput.value.trim(),
        password: passInput.value.trim()
    });
    xhr.send(data);
}

acceptTos.addEventListener("click", function() {
    submitSignup();
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
</script>
    
</body>
</html>

