<?php if (session_status() === PHP_SESSION_NONE) { session_start(); } if (empty($_SESSION['user_id'])) { header('Location: ./login.php'); exit; } ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@24,400,0,0"/>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@400..900&family=Playfair:ital,opsz,wght@0,5..1200,300..900;1,5..1200,300..900&family=Prociono&display=swap" rel="stylesheet">
<?php include __DIR__ . '/head-meta.php'; ?>
<style>
    *{font-family: "Prociono";
        letter-spacing: 1.5px;
    }
#welcomeMsg, #username {
    font-family: "Playfair"; 
}

#mobWelcome-msg, #mobUsername {
    font-family: "Playfair"; 
}


  .sideBar { transition: all 0.32s cubic-bezier(.2,.9,.2,1); }
  html, body { overflow-x: hidden; }
  .sideBar ::-webkit-scrollbar { width: 0.05px; }
  .sideBar ::-webkit-scrollbar-track { background: transparent; }
  .sideBar ::-webkit-scrollbar-thumb { background: rgba(132,204,22,0.22); border-radius: 10px; }
  .sideBar ::-webkit-scrollbar-thumb:hover { background: rgba(132,204,22,0.4); }

.dashdropDown {
  max-height: 0;
  opacity: 0;
  overflow: hidden;
  transition: max-height 0.4s ease, opacity 0.4s ease;
}
.dashdropDown.show {
  max-height: 6rem;
  opacity: 1;
}

.dropdownIcon {
  opacity: 0.4;
  transform: translateX(6px);
  transition: transform 0.3s ease, opacity 0.3s ease, rotate 0.3s ease;
}
.dashBtn:hover .dropdownIcon,
.dashdropDown.show ~ .dropdownIcon {
  opacity: 1;
  transform: translateX(0);
}
.rotate-icon{
  transform: rotate(180deg) !important;
}

.sideBar[collapsed= "true"] .dropdownIcon{
    display:none !important;
}
</style>
</head>
<body class="min-h-screen flex">
<!--Sidebar-->
<aside class="sideBar fixed top-0 left-0 bg-gradient-to-b from-lime-500 to-gray-800 text-white border-white w-16 transition-all duration-300 ease-in-out h-screen flex-shrink-0" collapsed="true">
<div class="flex flex-col h-full overflow-y-auto overflow-x-hidden scrollbar-thin scrollbar-thumb-lime-500 scrollbar-track-700">
<div class="flex items-center justify-center h-16 border-b border-teal-200 rounded-2xl">
<button tooltip = "Menu" class="menuToggle text-2xl text-white focus:outline-none hover:bg-white font-bold py-2 px-2 rounded transition-all duration-300 hover:text-lime-500 hover:ml-[6px]">
<span class="material-symbols-rounded">menu</span>
</button>
</div>
<!--Upper contents of Sidebar-->
<nav class="sidebar-Nav flex flex-col h-full mt-4">
<ul class="upperNav space-y-1 flex-1">
<li class="navItem">
<button tooltip="Dashboard" class="dashBtn flex items-center justify-between w-full gap-3 px-4 py-3 hover:bg-white font-bold py-2 px-2 rounded transition-all duration-300 hover:text-lime-500 hover:ml-[8px]">
<div class="flex items-center gap-3">
<span class="material-symbols-rounded">dashboard</span>
<span class="navName text-sm whitespace-nowrap hidden sideBar-text">Dashboard</span>
</div>
<span class="dropdownIcon material-symbols-rounded transition-transform duration-300 whitespace-nowrap hidden sideBar-text">expand_more</span>
</button>
<ul class="dashdropDown flex-col ml-10 mt-1 space-y-1">
<li>
 <a href="./expense.php" class="block text-sm py-2 px-3 hover:bg-white font-bold rounded-md transition-all duration-300 hover:text-lime-500 hover:ml-[8px]">Expenses</a>   
</li>
<li>
 <a href="./income.php" class="block text-sm py-2 px-3 hover:bg-white font-bold rounded-md transition-all duration-300 hover:text-lime-500 hover:ml-[8px]">Income</a>   
</li>
</ul>
</li>

<li class="navItem">
<a href="./categories.php" tooltip="Categories" class = "flex items-center gap-3 px-4 py-3 hover:bg-white font-bold py-2 px-2 rounded transition-all duration-300 hover:text-lime-500 hover:ml-[8px]">
    <span class="material-symbols-rounded">category</span>
    <span class="navName text-sm whitespace-nowrap hidden sideBar-text">Categories</span>
</a>
</li>

<li class="navItem">
<a href="./accounts.php" tooltip="Accounts" class = "flex items-center gap-3 px-4 py-3 hover:bg-white font-bold py-2 px-2 rounded transition-all duration-300 hover:text-lime-500 hover:ml-[8px]">
    <span class="material-symbols-rounded">switch_account</span>
    <span class="navName text-sm whitespace-nowrap hidden sideBar-text">Accounts</span>
</a>
</li>

<li class="navItem">
<a href="./budgets.php" tooltip="Budgets" class = "flex items-center gap-3 px-4 py-3 hover:bg-white font-bold py-2 px-2 rounded transition-all duration-300 hover:text-lime-500 hover:ml-[8px]">
    <span class="material-symbols-rounded">savings</span>
    <span class="navName text-sm whitespace-nowrap hidden sideBar-text">Budgets</span>
</a>
</li>

<li class="navItem">
<a href="./transactions.php" tooltip="Transaction Records" class = "flex items-center gap-3 px-4 py-3 hover:bg-white font-bold py-2 px-2 rounded transition-all duration-300 hover:text-lime-500 hover:ml-[8px]">
    <span class="material-symbols-rounded">checkbook</span>
    <span class="navName text-sm whitespace-nowrap hidden sideBar-text">Transaction Records</span>
</a>
</li>

<li class="navItem">
<a href="./users.php" tooltip="Users" class = "flex items-center gap-3 px-4 py-3 hover:bg-white font-bold py-2 px-2 rounded transition-all duration-300 hover:text-lime-500 hover:ml-[8px]">
    <span class="material-symbols-rounded">account_circle</span>
    <span class="navName text-sm whitespace-nowrap hidden sideBar-text">Users</span>
</a>
</li>
</ul>

<!--Lower contents of Sidebar-->
<ul class="lowerNav space-y-1 rounded-2xl pt-2 mt-auto mb-4">
<li class="navItem">
<a href="./history.php" tooltip="History" class = "flex items-center gap-3 px-4 py-3 hover:bg-white font-bold py-2 px-2 rounded transition-all duration-300 hover:text-lime-500 hover:ml-[8px]">
    <span class="material-symbols-rounded">history</span>
    <span class="navName text-sm whitespace-nowrap hidden sideBar-text">History</span>
</a>
</li>

<li class="navItem">
<a href="./export.php" id="exportToggle" tooltip="Export as CSV/PDF" class = "flex items-center gap-3 px-4 py-3 hover:bg-white font-bold py-2 px-2 rounded transition-all duration-300 hover:text-lime-500 hover:ml-[8px]">
    <span class="material-symbols-rounded">file_export</span>
    <span class="navName text-sm whitespace-nowrap hidden sideBar-text">Export as CSV/PDF</span>
</a>
</li>

<li class="navItem">
<a href="./delete.php" tooltip="Delete and Reset" class = "flex items-center gap-3 px-4 py-3 hover:bg-white font-bold py-2 px-2 rounded transition-all duration-300 hover:text-lime-500 hover:ml-[8px]">
    <span class="material-symbols-rounded">delete</span>
    <span class="navName text-sm whitespace-nowrap hidden sideBar-text">Delete and Reset</span>
</a>
</li>

<li class="navItem">
<a href="./log-out.php" tooltip="Log Out" class = "flex items-center gap-3 px-4 py-3 hover:bg-white font-bold py-2 px-2 rounded transition-all duration-300 hover:text-lime-500 hover:ml-[8px]">
    <span class="material-symbols-rounded">exit_to_app</span>
    <span class="navName text-sm whitespace-nowrap hidden sideBar-text">Log Out</span>
</a>
</li>
</ul>

</nav>
</div>
</aside>
<!--End point of Sidebar-->
<main class="flex-1 ml-16 overflow-hidden bg-gradient-to-br from-lime-500/20 to-gray-700/20 duration-250 ease-in-out p-6" id="mainContent">
<div class="min-h-screen w-full mx-auto mt-6 mb-8 rounded-2xl shadow-lg bg-white">
   <div class="relative border-b-2 border-green-400">
    <img src="" id ="bannerPic" class="w-full h-48 sm:h-56 md:h-64 object-cover rounded-lg" alt="">
    <label for="bannerInput" class="absolute bottom-4 right-4 bg-white w-6 h-6 md:h-7 md:w-7 flex items-center justify-center rounded-lg cursor-pointer shadow-md hover:bg-green-500 transition-all duration-300 ease-in-out hover:text-white">
        <span class="material-symbols-rounded">edit</span>
    </label>
     <input type="file" id="bannerInput" class="hidden" accept="image/jpeg, image/png, image/jpg">

    <div class="absolute top-4 right-4">
        <button id="userSettings" class="bg-white/30 p-2 rounded-full shadow-md hover:bg-green-500 duration-300 transition-all ease-in-out hover:text-white">
            <span class="material-symbols-rounded">settings</span>
        </button>
         <div id="settingsDropdown" class="hidden absolute right-0 mt-2 w-40 sm:w-48 bg-white rounded-md shadow-md z-10">
        <ul class="divide-y divide-gray-200 text-sm sm:text-base">
            <li><button class="w-full px-4 py-2 hover:bg-green-500 transition-all duration-300 ease-in-out hover:text-white">Edit User Name</button></li>
            <li><button class="w-full px-4 py-2 hover:bg-green-500 transition-all duration-300 ease-in-out hover:text-white">Edit Details</button></li>
            <li><button class="w-full px-4 py-2 hover:bg-green-500 transition-all duration-300 ease-in-out hover:text-white">Edit About Me</button></li>
        </ul>
    </div>
    </div>

   <!-- Desktop Banner Text -->
<div class="hidden md:flex absolute inset-0 flex-col justify-end 
            pl-56
            pb-4 select-none pointer-events-none">

    <h2 id="welcomeMsg" class="font-extrabold opacity-85 text-3xl lg:text-4xl">
        Welcome,
    </h2>
    <h1 id="username" class="font-extrabold text-5xl lg:text-6xl">
        Usagi
    </h1>
</div>

    <div class="absolute -bottom-12 left-6 sm:left-10 md:left-16">
        <img id="pfp" src="" alt="" class="w-24 h-24 sm:h-28 sm:w-28 md:h-32 md:w-32 rounded-full object-cover border-4 border-green-400">
        <label for="pfpInput" class="absolute bottom-1 right-1 bg-white w-6 h-6 md:w-7 md:h-7 flex items-center justify-center rounded-full cursor-pointer hover:bg-green-500 duration-300 transition-all ease-in-out hover:text-white">
            <span class="material-symbols-rounded text-sm md:text-base">edit</span>
        </label>
        <input type="file" id="pfpInput" class="hidden" accept="image/jpeg, image/png, image/jpg">
    </div>
</div>    
<!-- Mobile/Tablet Header Text -->
<div class="md:hidden px-6 pt-6 mt-6 text-center select-none">
    <h2 id="mobWelcome-msg" class="font-extrabold text-5xl opacity-70">Welcome,</h2>
    <h1 id ="mobUsername" class="font-extrabold text-6xl mt-1">Usagi</h1>
</div>

    <div class="mt-16 px-4 sm:px-6 md:px-8 max-w-4xl mx-auto">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-4 sm:gap-6">
            <div class="bg-lime-200 p-4 rounded-lg text-center ring-2 ring-green-200 ring-inset max-w-full break-words overflow-hidden">
          <p id="displayUsername" class="text-xl sm:text-2xl font-semibold break-words">-</p>
          <p class="text-gray-600 text-sm sm:text-base">User Name</p>
          <p id="displayBirthday" class="text-xl sm:text-2xl font-semibold break-words">-</p>
          <p class="text-gray-600 text-sm sm:text-base">Birthday</p>
        </div>
        <div class="bg-lime-200 p-4 rounded-lg text-center ring-2 ring-green-200 ring-inset max-w-full break-words overflow-hidden">
          <p id="displayEmail" class="text-xl sm:text-2xl font-semibold break-words">-</p>
          <p class="text-gray-600 text-sm sm:text-base">Email</p>
        </div>
        <div class="bg-lime-200 p-4 rounded-lg text-center ring-2 ring-green-200 ring-inset max-w-full break-words overflow-hidden">
          <p id="displayAccountCreated" class="text-xl sm:text-2xl font-semibold">-</p>
          <p class="text-gray-600 text-sm sm:text-base">Account Created</p>
        </div>
        </div>
        <div class="bg-green-400 mt-4 max-w-full text-center rounded-lg">
        <h2 class="text-lg sm:text-xl font-semibold text-gray-800 text-center">About Me</h2>
        <p id="displayAboutMe" class="mt-2 text-gray-700 text-sm sm:text-base leading-relaxed max-w-full">
          -
        </p>
      </div>
    </div>


<div id="editOverlay" class="hidden modalOverlay fixed inset-0 z-40 backdrop-blur-md"></div>
<div id="editName" class="hidden fixed inset-0 z-50 flex items-center justify-center p-4">
<div class="modalCard bg-white/70 p-6 rounded-xl shadow-lg w-full max-w-sm">
    <h2 class="text-xl font-bold mb-3">Edit User Name</h2>
    <input id="newNameInput" type="text" class="w-full border rounded p-2 mb-4" placeholder ="Enter new username">
    <div class="flex justify-end gap-2">
        <button class="closeModal px-4 py-2 bg-lime-300 rounded hover:bg-green-300 transition-all ease-in-out duration-300">Cancel</button>
        <button id="savenewName" class="px-4 py-2 bg-lime-300 rounded hover:bg-green-300 transition-all ease-in-out duration-300">Save</button>
    </div>
</div>
</div>

<div id="editDetail" class="hidden fixed inset-0 z-50 flex items-center justify-center p-4">
<div class="modalCard bg-white/70 p-6 rounded-xl shadow-lg w-full max-w-xl">
<h2 class="text-xl font-bold mb-3">Edit Details</h2>
<label class="font-semibold">Birthday</label>
<input id="userBday" type="date" class="w-full border rounded p-2 mb-3">
<label class="font-semibold">Email</label>
<input id="userEmail" type="email" class="w-full border rounded p-2 mb-3">
<div class="flex justify-end gap-2">
        <button class="closeModal px-4 py-2 bg-lime-300 rounded hover:bg-green-300 transition-all ease-in-out duration-300">Cancel</button>
        <button id="saveDetails" class="px-4 py-2 bg-lime-300 rounded hover:bg-green-300 transition-all ease-in-out duration-300">Save</button>
    </div>
</div>
</div>

<div id="editAboutme" class="hidden fixed inset-0 z-50 flex items-center justify-center p-4">
<div class="modalCard bg-white/70 p-6 rounded-xl shadow-lg w-full max-w-sm">
    <h2 class="text-xl font-bold mb-3">Edit About Me</h2>
    <textarea id="aboutMeInput" class="w-full border rounded p-2 h-40" placeholder ="Write interestings about yourself here!"></textarea>
    <div class="flex justify-end gap-2">
        <button class="closeModal px-4 py-2 bg-lime-300 rounded hover:bg-green-300 transition-all ease-in-out duration-300">Cancel</button>
        <button id="saveAboutme" class="px-4 py-2 bg-lime-300 rounded hover:bg-green-300 transition-all ease-in-out duration-300">Save</button>
    </div>
</div>
</div>

</div>
</main>
<script>
const menuToggle = document.querySelector(".menuToggle");
const sideBar = document.querySelector(".sideBar");
const txtLabels = document.querySelectorAll(".sideBar-text");
const dropdownIcon = document.querySelector(".dropdownIcon");
const dashdropDown = document.querySelector(".dashdropDown");
const dashBtn = document.querySelector(".dashBtn");
const main = document.querySelector("main");

menuToggle.addEventListener("click", () => {
const Collapsed = sideBar.getAttribute("collapsed")==="true";
sideBar.classList.toggle("w-56", Collapsed);
sideBar.classList.toggle("w-16", !Collapsed);
main.classList.toggle("ml-56", Collapsed);
main.classList.toggle("ml-16", !Collapsed);

txtLabels.forEach(label => label.classList.toggle("hidden", !Collapsed));
sideBar.setAttribute("collapsed", Collapsed ? "false" : "true");
dropdownIcon.classList.toggle("hidden", !Collapsed);
if (!Collapsed) {
    dashdropDown.classList.remove("show");
    dropdownIcon.classList.remove("rotate-icon");
}
});

dashBtn.addEventListener("click", () => {
    const Collapsed = sideBar.getAttribute("collapsed")==="true";
    if (Collapsed) {
        menuToggle.click();
    }

    const openDash = dashdropDown.classList.contains("show");
    dashdropDown.classList.toggle("show", !openDash);
    dropdownIcon.classList.toggle("rotate-icon", !openDash);
});

const tooltip = document.createElement("div");
tooltip.className = "fixed bg-white text-black text-sm font-semibold py-1 px-2 rounded-lg shadow-lg z-50 opacity-0 pointer-events-none transform transition-all duration-300";
document.body.appendChild(tooltip);
document.addEventListener("mouseover", (a) => {
    const tt = a.target.closest("[tooltip]");
    if (!tt) return;
    if(tt.closest(".group"))return;
    if(tt.closest(".sideBar") && sideBar.getAttribute("collapsed")!=="true") {
        tooltip.style.opacity = 0; return;
    }
        tooltip.textContent = tt.getAttribute("tooltip");
        const r = tt.getBoundingClientRect();
        tooltip.style.left = (r.right + 8 ) + "px";
        tooltip.style.top = (r.top + r.height /2 ) + "px";
        tooltip.style.opacity = 1;
        tooltip.style.transform = "translateY(-50%)";

    });

document.addEventListener("mouseout", (a) => {
    const tt = a.target.closest("[tooltip]");
    if (tt) tooltip.style.opacity = 0;
});

const userSettings = document.getElementById("userSettings");
const settingsDropdown = document.getElementById("settingsDropdown");

userSettings.addEventListener("click", (a) =>{
settingsDropdown.classList.toggle("hidden");
});

const pfp = document.getElementById("pfp");
const pfpInput = document.getElementById("pfpInput");
const bannerPic = document.getElementById("bannerPic");
const bannerInput= document.getElementById("bannerInput");

// API helper functions
async function uploadUserFile(file, type) {
    try {
        const formData = new FormData();
        formData.append(type, file);
        
        const response = await fetch('../api/users.php', {
            method: 'POST',
            body: formData,
            credentials: 'include'
        });
        
        const result = await response.json();
        if (result.success && result.data) {
            return result.data[type] || null;
        } else {
            alert('Error uploading ' + type + ': ' + (result.message || 'Unknown error'));
            return null;
        }
    } catch (error) {
        console.error('Error uploading file:', error);
        alert('Error uploading file. Please try again.');
        return null;
    }
}

async function updateUserProfile(data) {
    try {
        const response = await fetch('../api/users.php', {
            method: 'PUT',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify(data),
            credentials: 'include'
        });
        
        const result = await response.json();
        if (result.success) {
            return result.data;
        } else {
            alert('Error updating profile: ' + (result.message || 'Unknown error'));
            return null;
        }
    } catch (error) {
        console.error('Error updating profile:', error);
        alert('Error updating profile. Please try again.');
        return null;
    }
}

async function loadUserProfile() {
    try {
        const response = await fetch('../api/users.php', {
            method: 'GET',
            headers: { 'Content-Type': 'application/json' },
            credentials: 'include' // Include cookies for session
        });
        
        if (!response.ok) {
            console.error('Failed to load user profile:', response.status, response.statusText);
            // If 401, user might not be logged in - that's okay, show default values
            if (response.status === 401) {
                return;
            }
        }
        
        const result = await response.json();
        if (result.success && result.data) {
            const user = result.data;
            
            // Username
            const username = user.username || '-';
            document.getElementById("username").textContent = username;
            document.getElementById("mobUsername").textContent = username;
            document.getElementById("displayUsername").textContent = username;
            
            // Birthday
            if (user.birthday) {
                const dateObj = new Date(user.birthday);
                const formatted = dateObj.toLocaleDateString("en-US", {
                    year: "numeric", 
                    month: "long",
                    day: "numeric"
                });
                document.getElementById("displayBirthday").textContent = formatted;
            } else {
                document.getElementById("displayBirthday").textContent = '-';
            }
            
            // Email
            document.getElementById("displayEmail").textContent = user.email || '-';
            
            // Account Created
            if (user.created_at) {
                const dateObj = new Date(user.created_at);
                const formatted = dateObj.toLocaleDateString("en-US", {
                    year: "numeric", 
                    month: "long",
                    day: "numeric"
                });
                document.getElementById("displayAccountCreated").textContent = formatted;
            } else {
                document.getElementById("displayAccountCreated").textContent = '-';
            }
            
            // About Me
            document.getElementById("displayAboutMe").textContent = user.about_me || '-';
            
            // Avatar
            if (user.avatar) {
                pfp.src = '../' + user.avatar;
            }
            
            // Banner
            if (user.banner) {
                bannerPic.src = '../' + user.banner;
                detectBanner();
            }
        }
    } catch (error) {
        console.error('Error loading user profile:', error);
    }
}

pfpInput.addEventListener("change", async () => {
    const file = pfpInput.files[0];
    if (file) {
        // Show preview immediately
        pfp.src = URL.createObjectURL(file);
        
        // Upload to server
        const filePath = await uploadUserFile(file, 'avatar');
        if (filePath) {
            // Update to use server path
            pfp.src = '../' + filePath;
        } else {
            // Revert to previous if upload failed
            pfpInput.value = '';
        }
    }
});

bannerInput.addEventListener("change", async () => {
    const file = bannerInput.files[0];
    if (file) {
        // Show preview immediately
        bannerPic.src = URL.createObjectURL(file);
        detectBanner();
        
        // Upload to server
        const filePath = await uploadUserFile(file, 'banner');
        if (filePath) {
            // Update to use server path
            bannerPic.src = '../' + filePath;
            detectBanner();
        } else {
            // Revert to previous if upload failed
            bannerInput.value = '';
        }
    }
});
//Detect banner color
function detectBanner() {
    const banner = document.getElementById("bannerPic");
    if (!banner.complete) {
        banner.onload = detectBanner;
        return;
    }

    const canvas = document.createElement("canvas");
    const ctx = canvas.getContext("2d");

    canvas.width = 50;
    canvas.height = 50;

    ctx.drawImage(banner,0,0,canvas.width,canvas.height);
    const img = ctx.getImageData(0,0,canvas.width,canvas.height);
    let brightness = 0;
    for (let i=0; i<img.data.length; i +=4) {
        const r = img.data[i];
        const g = img.data[i + 1];
        const b = img.data[i + 2];

        const defaultBrightness = 0.2126*r + 0.7152*g + 0.0722*b;
        brightness += defaultBrightness;
    }

    const ttlBrightness = brightness/(img.data.length/4);
    const welcomeMsg = document.getElementById("welcomeMsg");
    const username = document.getElementById("username");

    if (ttlBrightness < 110) {
        welcomeMsg.style.color="white";
        username.style.color = "white";
    } else {
         welcomeMsg.style.color="black";
        username.style.color = "black";
    }
}

window.addEventListener("load", () => {
    detectBanner();
    loadUserProfile(); // Load user profile from API
});

const editOverlay = document.getElementById("editOverlay");
const editName = document.getElementById("editName");
const editDetails = document.getElementById("editDetail");
const editAbout = document.getElementById("editAboutme");

function openModal(modal) {
    editOverlay.classList.remove("hidden");
    modal.classList.remove("hidden");
}
const dropdowns = settingsDropdown.querySelectorAll("button");
dropdowns[0].addEventListener("click", () => openModal(editName));
dropdowns[1].addEventListener("click", () => openModal(editDetails));
dropdowns[2].addEventListener("click", () => openModal(editAbout));

document.querySelectorAll(".closeModal").forEach( btn => {
btn.addEventListener("click", closeModals);
});

function closeModals () {
    editOverlay.classList.add("hidden");
     editName.classList.add("hidden");
      editDetails.classList.add("hidden");
       editAbout.classList.add("hidden");
}

document.getElementById("savenewName").addEventListener("click", async () => {
const value = document.getElementById("newNameInput").value.trim();
if (value === "") return;

const updated = await updateUserProfile({ username: value });
if (updated) {
    document.getElementById("username").textContent = value;
    document.getElementById("mobUsername").textContent = value;
    document.getElementById("displayUsername").textContent = value;
    closeModals();
}
});

document.getElementById("saveDetails").addEventListener("click", async () => {
const birthday = document.getElementById("userBday").value;
const email = document.getElementById("userEmail").value;

const updateData = {};
if (birthday) updateData.birthday = birthday;
if (email) updateData.email = email;

if (Object.keys(updateData).length > 0) {
    const updated = await updateUserProfile(updateData);
    if (updated) {
        if(birthday) {
            const dateObj = new Date(birthday);
            const formatted = dateObj.toLocaleDateString("en-US", {
                year: "numeric", 
                month: "long",
                day: "numeric"
            });
            document.getElementById("displayBirthday").textContent = formatted;
        }
        if (email) {
            document.getElementById("displayEmail").textContent = email;
        }
        closeModals();
    }
} else {
    closeModals();
}
});

document.getElementById("saveAboutme").addEventListener("click", async () => {
    const text = document.getElementById("aboutMeInput").value.trim();
    if (text === "") return;

    const updated = await updateUserProfile({ about_me: text });
    if (updated) {
        document.getElementById("displayAboutMe").textContent = text;
        closeModals();
    }
});
</script>
</body>
</html>