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
<div class="w-full max-w-3xl mx-auto grid grid-cols-1 md:grid-cols-2 min-h-screen-[600px] rounded-xl overflow-hidden shadow-xl">
   <!--Form on left side-->
<div class="flex items-center justify-center bg-slate-200 p-8 order-2 md:order-1">
<div class="bg-white shadow-xl rounded-xl p-8 w-full max-w-sm border border-gray-200 relative">
    
    <h1 class="text-2xl font-semibold text-center mb-2 mt-4">Create your new Password</h1>
 <div class="mb-2">
    <label class="block text-sm text-gray-800">Password</label>
    <div class="relative">
         <input id="newpassInput" type="password" placeholder="Password" class="w-full mt-1 px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-400" required>
          <span id="newPassToggle" class="material-symbols-rounded absolute right-3 top-1/2 -translate-y-1/2 text-gray-600 cursor-pointer select-none transition-opacity duration-150">visibility</span>
    </div>
    <p id="newpassErr" class="text-red-600 text-sm mt-1 hidden">Please include a strong password.</p>
   </div>
   <div class="mb-2">
    <label class="block text-sm text-gray-800">Retype your new Password</label>
    <div class="relative">
         <input id="retypepassInput" type="password" placeholder="Password" class="w-full mt-1 px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-400" required>
          <span id="retypepassToggle" class="material-symbols-rounded absolute right-3 top-1/2 -translate-y-1/2 text-gray-600 cursor-pointer select-none transition-opacity duration-150">visibility</span>
    </div>
    <p id="retypepassErr" class="text-red-600 text-sm mt-1 hidden">Please retype your password.</p>
   </div>
    
<button id="ConfirmPassBtn" class="w-full bg-green-400 text-white font-medium py-2 rounded-lg mt-4  hover:shadow-md shadow-lime-300 duration-300 transition-all hover:bg-gradient-to-r from-green-400 to-lime-400 transition-all duration-300 ease-in-out">
Confirm Password
</button>

</div>
</div>

<div class="flex items-center justify-center bg-gradient-to-b from-yellow-200 to-green-300 relative order-1 md:order-2">
<img src="../assets/cointra-removebg-preview.png" alt="" class="justify-center items-center mt-8 w-40 sm:w-48 md:w-64 lg:w-72 mx-auto">
</div>
</div>



<script>
const newpassInput = document.getElementById("newpassInput");
const retypepassInput = document.getElementById("retypepassInput");
const newpassErr = document.getElementById("newpassErr");
const retypepassErr = document.getElementById("retypepassErr");
const ConfirmPassBtn = document.getElementById("ConfirmPassBtn");
const newPassToggle = document.getElementById("newPassToggle");
const retypepassToggle = document.getElementById("retypepassToggle");
const RESET_EMAIL_KEY = "cointra_reset_email";
const storedResetEmail = sessionStorage.getItem(RESET_EMAIL_KEY);

ConfirmPassBtn.addEventListener("click", async (a) => {
a.preventDefault();
let isCorrect = true;
const newPassValue = newpassInput.value.trim();
const retypeValue = retypepassInput.value.trim();

if (newPassValue==="") {
    newpassErr.classList.remove("hidden");
    newpassErr.classList.add("border-red-500");
    newpassErr.classList.remove("border-lime-500");
    newpassErr.textContent = "Please include a strong password.";
    isCorrect = false;
} else if (newPassValue.length < 8) {
    newpassErr.classList.remove("hidden");
    newpassErr.classList.add("border-red-500");
    newpassErr.classList.remove("border-lime-500");
    newpassErr.textContent = "Password must be at least 8 characters.";
    isCorrect = false;
} else {
    newpassErr.classList.add("hidden");
    newpassErr.classList.remove("border-red-500");
    newpassErr.classList.add("border-lime-500");
}

if (retypeValue==="") {
    retypepassErr.classList.remove("hidden");
    retypepassErr.classList.add("border-red-500");
    retypepassErr.classList.remove("border-lime-500");
    retypepassErr.textContent = "Please retype your password.";
    isCorrect = false;
} else if ( retypeValue !== newPassValue) {
    retypepassErr.textContent = "Passwords do not match, try again."
    retypepassErr.classList.remove("hidden");
    retypepassErr.classList.add("border-red-500");
    retypepassErr.classList.remove("border-lime-500");
    isCorrect = false;
}
 else {
    retypepassErr.classList.add("hidden");
    retypepassErr.classList.remove("border-red-500");
    retypepassErr.classList.add("border-lime-500");}

    if (isCorrect) {
        ConfirmPassBtn.disabled = true;
        ConfirmPassBtn.textContent = "Updating...";
        try {
            const response = await fetch("../api/auth.php?action=reset_password", {
                method: "POST",
                headers: { "Content-Type": "application/json" },
                body: JSON.stringify({
                    password: newPassValue,
                    email: storedResetEmail || ""
                })
            });

            const result = await response.json();

            if (result.success) {
                alert("Password successfully changed! You will be redirected to the Log-In page in a moment...");
                sessionStorage.removeItem(RESET_EMAIL_KEY);
                window.location.href = "./login.php";
            } else {
                throw new Error(result.message || "Unable to reset password.");
            }
        } catch (error) {
            console.error(error);
            retypepassErr.textContent = error.message || "Something went wrong. Please try again.";
            retypepassErr.classList.remove("hidden");
            retypepassErr.classList.add("border-red-500");
            retypepassErr.classList.remove("border-lime-500");
        } finally {
            ConfirmPassBtn.disabled = false;
            ConfirmPassBtn.textContent = "Confirm Password";
        }
    }
});

//for toggling new password visibility
newPassToggle.addEventListener("click", () => {
newPassToggle.classList.add("opacity-0");
setTimeout(() => {
if (newpassInput.type === "password") {
    newpassInput.type ="text";
    newPassToggle.textContent = "visibility_off";
} else {
    newpassInput.type = "password";
    newPassToggle.textContent = "visibility";}

    newPassToggle.classList.remove("opacity-0");
}, 150);
});

//for toggling retyped password visibility
retypepassToggle.addEventListener("click", () => {
retypepassToggle.classList.add("opacity-0");
setTimeout(() => {
if (retypepassInput.type === "password") {
    retypepassInput.type ="text";
    retypepassToggle.textContent = "visibility_off";
} else {
    retypepassInput.type = "password";
    retypepassToggle.textContent = "visibility";}

    retypepassToggle.classList.remove("opacity-0");
}, 150);
});
</script>
    
</body>
</html>