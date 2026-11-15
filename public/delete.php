<?php if (session_status() === PHP_SESSION_NONE) { session_start(); } if (empty($_SESSION['user_id'])) { header('Location: ./login.php'); exit; } ?>
<!--Delete Page Ver:1-->
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
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

<!-- Main content -->
<main class="flex-1 ml-16 transition-all duration-300 ease-in-out p-6" id="mainContent">
  <div class="grid gap-4 mt-10 grid-cols-1">

  <!-- Delete Records -->
<div class="bg-white rounded-xl p-6 shadow-xl flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 text-center sm:text-left">
  <div class="sm:max-w-[70%]">
    <h3 class="text-lg font-semibold text-gray-800">Delete Records</h3>
    <p class="text-sm text-gray-700 mt-1">
      Removes all transaction records but keeps your current accounts, categories, and budgets.
    </p>
  </div>
  <button
    id="deleteRecordBtn"
    class="mx-auto sm:mx-0 flex items-center justify-center gap-2 bg-lime-500 rounded-full px-6 py-3 font-bold text-black hover:bg-gradient-to-r from-lime-400 via-green-500 to-yellow-400 hover:shadow-md shadow-lime-400 transition-all duration-300 text-base hover:text-white sm:text-lg md:text-xl min-w-[150px]"
  >
    <span class="material-symbols-rounded text-2xl sm:text-3xl">delete</span>
    <span>Delete</span>
  </button>
</div>

<!-- Delete All -->
<div class="bg-white rounded-xl p-6 shadow-xl flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 text-center sm:text-left">
  <div class="sm:max-w-[70%]">
    <h3 class="text-lg font-semibold text-gray-800">Delete All</h3>
    <p class="text-sm text-gray-700 mt-1">
      Deletes everything — all records, accounts, categories, and budgets.
    </p>
  </div>
  <button
    id="deleteAllBtn"
    class="mx-auto sm:mx-0 flex items-center justify-center gap-2 bg-yellow-300 rounded-full px-6 py-3 font-bold text-black hover:bg-gradient-to-r from-yellow-300 via-amber-300 to-orange-300 hover:shadow-md shadow-orange-300 transition-all duration-300 text-base hover:text-white sm:text-lg md:text-xl min-w-[150px]"
  >
    <span class="material-symbols-rounded text-2xl sm:text-3xl">delete</span>
    <span>Delete All</span>
  </button>
</div>

<!-- Reset All -->
<div class="bg-white rounded-xl p-6 shadow-xl flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 text-center sm:text-left">
  <div class="sm:max-w-[70%]">
    <h3 class="text-lg font-semibold text-gray-800">Reset All</h3>
    <p class="text-sm text-gray-700 mt-1">
      Restores Cointra to its original state, removing all records, accounts, categories, and budgets.
    </p>
  </div>
  <button
    id="resetAllBtn"
    class="mx-auto sm:mx-0 flex items-center justify-center gap-2 bg-red-400 rounded-full px-6 py-3 font-bold text-black hover:bg-gradient-to-r from-rose-400 to-red-500 hover:shadow-md shadow-red-400 transition-all duration-300 text-base hover:text-white sm:text-lg md:text-xl min-w-[150px]"
  >
    <span class="material-symbols-rounded text-2xl sm:text-3xl">delete</span>
    <span>Reset</span>
  </button>
</div>



  <!-- Confirmation Modals -->
  <div id="delete-recordsOverlay" class="hidden fixed inset-0 z-50 flex items-center justify-center">
    <div class="absolute inset-0 bg-black/30"></div>
    <div class="relative bg-white/70 backdrop-blur-lg rounded-2xl p-6 w-[80%] max-w-sm shadow-2xl">
      <h4 class="text-lg font-semibold mb-2">Delete Records</h4>
      <p class="text-sm text-slate-600 mb-4">Are you sure you want to delete all records?</p>
      <div class="flex justify-end gap-3">
        <button id="cancelDRBtn" class="px-4 py-2 bg-gray-200 rounded-md">Cancel</button>
        <button id="confirmDRBtn" class="px-4 py-2 bg-red-500 text-white rounded-md">Delete</button>
      </div>
    </div>
  </div>

  <div id="delete-allOverlay" class="hidden fixed inset-0 z-50 flex items-center justify-center">
    <div class="absolute inset-0 bg-black/30"></div>
    <div class="relative bg-white/70 backdrop-blur-lg rounded-2xl p-6 w-[80%] max-w-sm shadow-2xl">
      <h4 class="text-lg font-semibold mb-2">Delete All</h4>
      <p class="text-sm text-slate-600 mb-4">Are you sure you want to delete all data from Cointra?</p>
      <div class="flex justify-end gap-3">
        <button id="cancelDABtn" class="px-4 py-2 bg-gray-200 rounded-md">Cancel</button>
        <button id="confirmDABtn" class="px-4 py-2 bg-red-500 text-white rounded-md">Delete</button>
      </div>
    </div>
  </div>

  <div id="resetOverlay" class="hidden fixed inset-0 z-50 flex items-center justify-center">
    <div class="absolute inset-0 bg-black/30"></div>
    <div class="relative bg-white/70 backdrop-blur-lg rounded-2xl p-6 w-[80%] max-w-sm shadow-2xl">
      <h4 class="text-lg font-semibold mb-2">Reset All</h4>
      <p class="text-sm text-slate-600 mb-4">Are you sure you want to reset Cointra to its default settings?</p>
      <div class="flex justify-end gap-3">
        <button id="cancelResetBtn" class="px-4 py-2 bg-gray-200 rounded-md">Cancel</button>
        <button id="confirmResetBtn" class="px-4 py-2 bg-red-500 text-white rounded-md">Reset</button>
      </div>
    </div>
  </div>

<!-- SLIDE-UP SUCCESS TOAST -->
<div id="successToast" class="hidden fixed inset-x-0 bottom-10 z-50 flex justify-center">
  <div
    class="flex items-center gap-3 bg-white/90 backdrop-blur-md border border-green-400/40 shadow-lg rounded-2xl px-5 py-3 text-green-600 transform transition-all duration-500 opacity-0 translate-y-5"
    id="successToastContent"
  >
    <span class="material-symbols-rounded text-3xl text-green-600">check_circle</span>
    <span id="successToastMessage" class="font-medium text-base">Action completed successfully.</span>
  </div>
</div>

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

  // Button & modal references
  const deleteRecordBtn = document.getElementById('deleteRecordBtn');
  const deleteAllBtn = document.getElementById('deleteAllBtn');
  const resetAllBtn = document.getElementById('resetAllBtn');

  const deleteRecordsOverlay = document.getElementById('delete-recordsOverlay');
  const deleteAllOverlay = document.getElementById('delete-allOverlay');
  const resetOverlay = document.getElementById('resetOverlay');

  const showModal = modal => modal.classList.remove('hidden');
  const hideModal = modal => modal.classList.add('hidden');

  // Confirmation modal triggers
  deleteRecordBtn.addEventListener('click', () => showModal(deleteRecordsOverlay));
  deleteAllBtn.addEventListener('click', () => showModal(deleteAllOverlay));
  resetAllBtn.addEventListener('click', () => showModal(resetOverlay));

  // Cancel buttons
  document.getElementById('cancelDRBtn').addEventListener('click', () => hideModal(deleteRecordsOverlay));
  document.getElementById('cancelDABtn').addEventListener('click', () => hideModal(deleteAllOverlay));
  document.getElementById('cancelResetBtn').addEventListener('click', () => hideModal(resetOverlay));

  //Toast success modal
  const successToast = document.getElementById('successToast');
  const toastContent = document.getElementById('successToastContent');
  const toastMessage = document.getElementById('successToastMessage');

  function showToast(message) {
    toastMessage.textContent = message;
    successToast.classList.remove('hidden');

    // Animate in
    requestAnimationFrame(() => {
      toastContent.classList.remove('opacity-0', 'translate-y-5');
      toastContent.classList.add('opacity-100', 'translate-y-0');
    });

    // Animate out smoothly
    setTimeout(() => {
      toastContent.classList.remove('opacity-100', 'translate-y-0');
      toastContent.classList.add('opacity-0', 'translate-y-5');
      setTimeout(() => successToast.classList.add('hidden'), 500);
    }, 2000);
  }

  async function performMaintenance(action) {
    try {
      const response = await fetch('../api/maintenance.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        credentials: 'include',
        body: JSON.stringify({ action })
      });
      const result = await response.json();
      if (!result.success) {
        throw new Error(result.message || 'Failed to complete the action.');
      }
      return true;
    } catch (error) {
      console.error('Maintenance action failed:', error);
      alert(error.message || 'Something went wrong while processing your request.');
      return false;
    }
  }

  // Confirm buttons (actions)
  document.getElementById('confirmDRBtn').addEventListener('click', async () => {
    hideModal(deleteRecordsOverlay);
    const ok = await performMaintenance('delete_records');
    if (ok) {
      showToast('All records have been successfully deleted. Your accounts, categories, and budgets are still saved.');
    }
  });

  document.getElementById('confirmDABtn').addEventListener('click', async () => {
    hideModal(deleteAllOverlay);
    const ok = await performMaintenance('delete_all');
    if (ok) {
      showToast('All data has been permanently deleted from Cointra.');
    }
  });

  document.getElementById('confirmResetBtn').addEventListener('click', async () => {
    hideModal(resetOverlay);
    const ok = await performMaintenance('reset_all');
    if (ok) {
      showToast('Cointra has been reset to its default state. Welcome back to a fresh start!');
    }
  });
</script>


</body>
</html>
