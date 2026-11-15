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
<style>
    *{font-family: "Prociono";
        letter-spacing: 1.5px;
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
<a id="openLogoutModal" href="./log-out.php" tooltip="Log Out" class = "flex items-center gap-3 px-4 py-3 hover:bg-white font-bold py-2 px-2 rounded transition-all duration-300 hover:text-lime-500 hover:ml-[8px]">
    <span class="material-symbols-rounded">exit_to_app</span>
    <span class="navName text-sm whitespace-nowrap hidden sideBar-text">Log Out</span>
</a>
</li>
</ul>

</nav>
</div>
</aside>
<!--End point of Sidebar-->
<main class="flex-1 ml-16 transition-all duration-300 ease-in-out p-6" id="mainContent">
   <!--LogOut Modal-->
<div id="logOut" class="hidden fixed inset-0 bg-white/20 backdrop-blur-lg flex items-center justify-center z-50">
<div class="bg-white/10 rounded-xl shadow-xl p-6 w-80 text-center">
<h2 class="text-xl font-bold text-gray-800 mb-3">Log Out</h2>
<p class="text-gray-600 mb-6">Are you sure you want to log out of Cointra?</p>
<div class="flex justify-center gap-4">
<button id="cancelOut" class="px-4 py-2 rounded-lg bg-gray-200 border border-red-500 hover:bg-red-500 transition-all duration-300 ease-in-out hover:text-white">Cancel</button>
<button id="confirmOut" class="px-4 py-2 rounded-lg bg-gray-200 border border-lime-500 hover:bg-green-500 transition-all duration-300 ease-in-out hover:text-white">Log Out</button>
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

const logOut = document.getElementById("logOut");
const togglelogOut = document.getElementById("openLogoutModal");
const cancelOut = document.getElementById("cancelOut");
const confirmOut = document.getElementById("confirmOut");

//Opens Logout Modal
togglelogOut.addEventListener("click", (a) => {
a.preventDefault();
logOut.classList.remove("hidden");
});

//Closes Logout Modal
cancelOut.addEventListener("click", () => {
logOut.classList.add("hidden");
});

//Confirms Logout Modal
confirmOut.addEventListener("click", async () => {
try {
    // Call logout API to destroy session
    const response = await fetch('../api/auth.php', {
        method: 'DELETE',
        headers: { 'Content-Type': 'application/json' },
        credentials: 'include'
    });
    
    const result = await response.json();
    // Redirect to landing page regardless of API response
    window.location.href = "./landing.php";
} catch (error) {
    console.error('Logout error:', error);
    // Still redirect even if API call fails
    window.location.href = "./landing.php";
}
});

//Closes when clicking anywhere else in the screen
logOut.addEventListener("click", (a) => {
    if (a.target === logOut) {
        logOut.classList.add("hidden");
    }
});

window.addEventListener('DOMContentLoaded', () => {
  logOut.classList.remove('hidden');
});
</script>
</body>
</html>