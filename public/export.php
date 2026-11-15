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

#exportToggle {
    cursor: pointer;
}

#exportOverlay {
    transition: opacity 0.2s ease;
}

#exportOverlay:not(.hidden) {
    display: flex !important;
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
<main class="flex-1 ml-16 transition-all duration-300 ease-in-out p-6" id="mainContent">
<div id="exportOverlay" class="fixed hidden inset-0 z-[1000] flex items-center justify-center px-4">
<div id="exportBackdrop" class="absolute inset-0 bg-black/20 backdrop-blur-md transition-opacity"></div>
<div class="exportPanel relative w-[80%] max-w-lg bg-white/40 backdrop-blur-lg rounded-2xl shadow-2xl p-4 md:p-6" role="dialog" aria-modal = "true" aria-labelledby="exportTitle">
    <button id="exportClosebtn" class="absolute right-4 top-4 p-2 rounded hover:bg-lime-500 transition-all duration-300 ease-in-out">
        <span class="material-symbols-rounded">close</span>
    </button>
<h3 id="exportTitle" class="text-center text-xl font-semibold text-gray-800 mb-4">Export File</h3>
<form action="" id="exportForm" class="flex flex-col gap-4">
    <span class="text-md font-semibold">Date of Export</span>
    <div class="flex gap-4">
         <select id="expMonth" class="mt-1 w-[75%] h-full rounded p-2 border">
            <option value="January">January</option>
            <option value="February">February</option>
            <option value="March">March</option>
            <option value="April">April</option>
            <option value="May">May</option>
            <option value="June">June</option>
            <option value="July">July</option>
            <option value="August">August</option>
            <option value="September">September</option>
            <option value="October">October</option>
            <option value="November">November</option>
            <option value="December">December</option>
        </select>
        <input id="year" type="number" min="1900" placeholder="YYYY" required class="w-1/3 p-2 rounded border">
    </div>

    <label>
        <span class="text-sm font-semibold">File Type</span>
        <select id="fileType" class="mt-1 w-full rounded p-2 border">
            <option value="CSV">CSV</option>
            <option value="PDF">PDF</option>
        </select>
    </label>

    <label>
        <span class="text-sm font-semibold">File Name</span>
        <input type="text" id="fileName" required class="mt-1 w-full rounded p-2 border">
    </label>

    <div class="flex justify-center gap-3 mt-2">
        <button id="exportCancelBtn" type="button" class="px-4 py-2 rounded-md bg-gray-200 border border-slate-300 hover:bg-red-500 transition-all duration-300 ease-in-out hover:text-white font-semibold">
            Cancel
        </button>
        <button type="submit" class="px-4 py-2 rounded-md bg-green-400 border border-slate-300 hover:bg-lime-500 transition-all duration-300 ease-in-out hover:text-white font-semibold">
            Save
        </button>
    </div>
</form>
</div>
</div>

<div id="confirmPDF" class="hidden fixed inset-0 z-50 flex items-center justify-center">
    <div class="absolute inset-0 bg-black/30"></div>
    <div class="relative bg-white/70 backdrop-blur-lg rounded-2xl p-6 w-[80%] max-w-sm shadow-2xl">
      <h4 class="text-lg font-semibold mb-2">Export file as PDF</h4>
      <p class="text-sm text-slate-600 mb-4">Are you sure you with exporting this file in PDF format?</p>
      <div class="flex justify-end gap-3">
        <button id="cancelPDF-Btn" class="px-4 py-2 bg-red-200 rounded-md">Cancel</button>
        <button id="confirmPDF-Btn" class="px-4 py-2 bg-lime-500 text-white rounded-md">Export</button>
      </div>
    </div>
  </div>

<div id="confirmCSV" class="hidden fixed inset-0 z-50 flex items-center justify-center">
    <div class="absolute inset-0 bg-black/30"></div>
    <div class="relative bg-white/70 backdrop-blur-lg rounded-2xl p-6 w-[80%] max-w-sm shadow-2xl">
      <h4 class="text-lg font-semibold mb-2">Export file as CSV</h4>
      <p class="text-sm text-slate-600 mb-4">Are you sure you with exporting this file in CSV format?</p>
      <div class="flex justify-end gap-3">
        <button id="cancelCSV-Btn" class="px-4 py-2 bg-red-200 rounded-md">Cancel</button>
        <button id="confirmCSV-Btn" class="px-4 py-2 bg-lime-500 text-white rounded-md">Export</button>
      </div>
    </div>
  </div>

  <div id="exportPop-up" class="hidden fixed inset-x-0 bottom-10 z-50 flex justify-center">
  <div
    class="flex items-center gap-3 bg-white/90 backdrop-blur-md border border-green-400/40 shadow-lg rounded-2xl px-5 py-3 text-green-600 transform transition-all duration-500 opacity-0 translate-y-5"
    id="popUpContent"
  >
    <span class="material-symbols-rounded text-3xl text-green-600">check_circle</span>
    <span id="popUp-Msg" class="font-medium text-base">Action completed successfully.</span>
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
const exportToggle = document.getElementById("exportToggle");
const exportOverlay = document.getElementById("exportOverlay");
const exportBackdrop = document.getElementById("exportBackdrop");
const exportForm = document.getElementById("exportForm");
const fileChoice = document.getElementById("fileType");
const exportClosebtn = document.getElementById("exportClosebtn");
const exportCancelBtn = document.getElementById("exportCancelBtn");
const confirmCSV = document.getElementById("confirmCSV");
const confirmPDF = document.getElementById("confirmPDF");
const confirmCSVBtn = document.getElementById("confirmCSV-Btn");
const confirmPDFBtn = document.getElementById("confirmPDF-Btn");
const exportPopup = document.getElementById("exportPop-up");
const popUpContent = document.getElementById("popUpContent");
const popUpMsg = document.getElementById("popUp-Msg");
const showModalbox = modal => modal.classList.remove("hidden");
const hideModalbox = modal => modal.classList.add("hidden");

//Opens Export Modal - same pattern as logout
exportToggle.addEventListener("click", (a) => {
  a.preventDefault();
  exportOverlay.classList.remove("hidden");
});

exportClosebtn.addEventListener("click", ()=> {
  exportOverlay.classList.add("hidden");
  exportOverlay.style.display = '';
});

exportCancelBtn.addEventListener("click", ()=> {
  exportOverlay.classList.add("hidden");
  exportOverlay.style.display = '';
});
 exportForm.addEventListener("submit", (a) => {
a.preventDefault();
exportOverlay.classList.add("hidden");
const fileType = fileChoice.value;

if (fileType === "CSV") {
    showModalbox(confirmCSV);
} else if (fileType === "PDF") {
    showModalbox(confirmPDF);
}});

function showMsg(message){
    popUpMsg.textContent = message;
    exportPopup.classList.remove("hidden");

    requestAnimationFrame(() => {
        popUpContent.classList.remove("opacity-0", "translate-y-5");
        popUpContent.classList.add("opacity-100", "translate-y-0");
    });

    setTimeout(() => {
        popUpContent.classList.remove("opacity-100", "translate-y-0");
        popUpContent.classList.add("opacity-0","translate-y-5");
        setTimeout(() => exportPopup.classList.add("hidden"), 500);
    },2000);
}

document.getElementById("confirmCSV-Btn").addEventListener("click", async () => {
    hideModalbox(confirmCSV);
    const month = document.getElementById("expMonth").value;
    const year = document.getElementById("year").value;
    const filename = document.getElementById("fileName").value || "transactions";
    
    if (!year) {
        alert("Please enter a year");
        return;
    }
    
    try {
        const url = `../api/export.php?format=CSV&month=${encodeURIComponent(month)}&year=${year}&filename=${encodeURIComponent(filename)}`;
        window.location.href = url;
        showMsg("CSV file is being downloaded!");
    } catch (error) {
        console.error("Export error:", error);
        alert("Error exporting CSV file");
    }
});

document.getElementById("confirmPDF-Btn").addEventListener("click", async () => {
    hideModalbox(confirmPDF);
    const month = document.getElementById("expMonth").value;
    const year = document.getElementById("year").value;
    const filename = document.getElementById("fileName").value || "transactions";
    
    if (!year) {
        alert("Please enter a year");
        return;
    }
    
    try {
        const url = `../api/export.php?format=PDF&month=${encodeURIComponent(month)}&year=${year}&filename=${encodeURIComponent(filename)}`;
        // Open in new window and trigger print dialog
        const printWindow = window.open(url, '_blank');
        if (printWindow) {
            printWindow.onload = function() {
                setTimeout(() => {
                    printWindow.print();
                }, 500);
            };
        }
        showMsg("PDF file is being generated! Use the print dialog to save as PDF.");
    } catch (error) {
        console.error("Export error:", error);
        alert("Error exporting PDF file");
    }
});

document.getElementById("cancelPDF-Btn").addEventListener("click", () => {
    hideModalbox(confirmPDF);
});

document.getElementById("cancelCSV-Btn").addEventListener("click", () => {
    hideModalbox(confirmCSV);
});
</script>
</body>
</html>