
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
<title></title>
<style>
  *{font-family:"Prociono";}
  
  .modal-panel { transform: translateY(8px); transition: transform .22s cubic-bezier(.2,.9,.2,1), opacity .18s ease; opacity: 0; }
  .modal-panel.show { transform: translateY(0); opacity: 1; }
  
  .progress-fill { transition: width 500ms ease, background 300ms ease; }
  .thin-scroll::-webkit-scrollbar { height:8px; width:8px; }
  .thin-scroll::-webkit-scrollbar-thumb { background: rgba(0,0,0,0.12); border-radius:8px; }
 
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
<body class="min-h-screen flex overflow-x-hidden overflow-y-auto">

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
<!--End of Sidebar Code-->

<!--Start of main content-->
<main class="flex-1 ml-16 transition-all duration-300 ease-in-out p-6" id="mainContent">
  <!--Main Content Gridding Set-Up-->
  <div class="grid gap-4 grid-cols-1">
    <!--Welcome message & Date System-->
    <div class="welcomeUser bg-gradient-to-r from-lime-500 to-gray-700 rounded-xl shadow-xl p-6 flex flex-col gap-4 lg:flex-row lg:items-center lg:justify-between">
      <div>
        <h1 id="welcomeUsername" class="text-xl font-bold text-white">Hello User!</h1>
        <p class="text-gray-100 text-sm mt-1">Welcome back to your Budget.</p>
      </div>
      <!--Date Display Alignment-->
      <div class="flex flex-col sm:flex-row sm:items-center gap-3">
        <div class="flex items-center gap-2 bg-lime-40 p-2 rounded-lg shadow-inner mt-4 sm:mt-0">
          <!--Previous date  button-->
          <button class="prevBtn bg-lime-500 text-white rounded-xl hover:bg-white font-bold py-2 px-2 rounded transition-all duration-300 hover:text-lime-500 border-[2px] hover:mr-[8px]">
            <span class="material-symbols-rounded">chevron_left</span>
          </button>
          <!--Date Text-->
          <div class="dateDisplay text-white font-semibold text-lg min-w-[150px] text-center select-none transition-all duration ease-in-out"></div>
          <!--Next Date Button-->
          <button class="nextBtn bg-lime-500 text-white rounded-xl hover:bg-white font-bold py-2 px-2 rounded transition-all duration-300 hover:text-lime-500 border-[2px] hover:ml-[8px]">
            <span class="material-symbols-rounded">chevron_right</span>
          </button>
        </div>
      </div>
    </div>
    <!--Total Balance Chart-->
  </div>

  <!--Total Budget Container & Content-->
  <div class="grid gap-4 mt-10 grid-cols-1 xl:grid-cols-2">
    <div id="totalBudgetCard" class="bg-white rounded-xl border-lime-300 shadow-lg shadow-lime-200/50 p-4">
      <h1 class="text-lg font-bold text-gray-800 mb-3">Total Budget</h1>
      <h6 id="totalBudgetAmount" class="text-lg font-bold text-gray-800 mb-3">₱ 0.00</h6>
    </div>

    <div id="totalSpentCard" class="bg-white rounded-xl border-lime-300 shadow-lg shadow-lime-200/50 p-4">
      <h1 class="text-lg font-bold text-gray-800 mb-3">Total Spent</h1>
      <h6 id="totalSpentAmount" class="text-lg font-bold text-gray-800 mb-3">₱ 0.00</h6>
    </div>
  </div>

  <!--Start of Budget Categories Container-->
  <div class="flex-1 p-6 overflow-y-auto"> 
    <!--Budget Categories gridding set-up-->
    <div class="grid gap-4 mt-10 grid-cols-1">
      <div class="bg-white rounded-xl shadow-lg shadow-lime-200/50 p-4 text-center">
        <h1 class="text-2xl font-bold text-gray-800">Budget</h1>
      </div>
    </div>

    <!-- Budgets grid (cards will be injected here) -->
    <div id="budgetsGrid" class="grid gap-4 mt-6 grid-cols-1 md:grid-cols-2 lg:grid-cols-3 auto-rows-min"></div>
  </div>
</main>

<!-- Add/Edit Modal (asks name, limit, spent) -->
<div id="modalOverlay" class="hidden fixed inset-0 z-50 flex items-center justify-center">
  <div id="modalBackdrop" class="absolute inset-0 bg-black/70 backdrop-blur-md"></div>

  <div id="modalPanel" class="relative w-[80%] max-w-lg bg-white/70 backdrop-blur-sm rounded-2xl shadow-2xl p-4 md:p-6">
    <button id="modalClose" class="absolute right-4 top-4 rounded-lg p-1 hover:bg-gradient-to-r from-emerald-400 to-cyan-400 font-bold transition-all duration-300 hover:text-white hover:mb-[8px] hover:shadow-md shadow-indigo-400">
      <span class="material-symbols-rounded">close</span>
    </button>

    <h3 id="modalTitle" class="text-xl font-semibold mb-4">Add Budget</h3>

    <form id="budgetForm" class="space-y-4">
      <div>
        <label class="block text-sm font-medium text-slate-700 mb-2">Expense Category</label>
        <select id="budgetCategory" class="mt-1 w-full rounded-lg border p-2" required>
          <option value="">Select an expense category</option>
        </select>
        <p class="text-xs text-gray-500 mt-1">Pick one of your existing expense categories for this budget.</p>
      </div>

      <div>
        <label class="block text-sm font-medium text-slate-700">Limit amount (₱)</label>
        <input id="budgetLimit" type="number" min="0" step="0.01" class="mt-1 w-full rounded-lg border p-2" placeholder="e.g., 10000" required />
      </div>

      <div class="flex justify-end gap-3">
        <button type="button" id="cancelBtn" class="px-4 py-2 bg-gray-200 rounded-md hover:bg-gradient-to-r from-red-800 to-pink-500 transition-all duration-300 hover:text-white hover:shadow-md shadow-indigo-400 hover:font-semibold rounded-xl">Cancel</button>
        <button type="submit" id="saveBtn" class="px-4 py-2 bg-lime-500 text-white rounded-md hover:bg-gradient-to-r from-emerald-400 to-cyan-400 transition-all duration-300 hover:text-white hover:shadow-md shadow-indigo-400 hover:font-semibold">Save</button>
      </div>
    </form>
  </div>
</div>

<!-- Delete confirm -->
<div id="deleteOverlay" class="hidden fixed inset-0 z-50 flex items-center justify-center">
  <div class="absolute inset-0 bg-black/30"></div>
  <div class="relative bg-white rounded-2xl p-6 z-60 w-[92%] max-w-sm shadow-2xl">
    <h4 class="text-lg font-semibold mb-2">Delete Budget</h4>
    <p class="text-sm text-slate-600 mb-4">Are you sure you want to delete this budget?</p>
    <div class="flex justify-end gap-3">
      <button id="cancelDeleteBtn" class="px-4 py-2 bg-gray-200 rounded-md">Cancel</button>
      <button id="confirmDeleteBtn" class="px-4 py-2 bg-red-500 text-white rounded-md">Delete</button>
    </div>
  </div>
</div>

<!-- Template for empty state inside grid -->
<template id="emptyStateTpl">
  <div class="col-span-1 md:col-span-2 lg:col-span-3 bg-white rounded-xl p-6 text-center text-slate-500 shadow">No budgets yet — click the Add button to create one.</div>
</template>

<!-- Add New Button (bottom-right) -->
<div class="group fixed bottom-6 right-6 z-[900]">
  <button id="floatingBudgetBtn" data-budget-modal-trigger data-tooltip="Add New" class="bg-lime-500 rounded-full hover:bg-gradient-to-r from-emerald-400 to-cyan-400 font-bold w-16 h-16 flex items-center justify-center transition-all duration-300 hover:text-white hover:mb-[8px] hover:shadow-xl shadow-indigo-400 cursor-pointer" type="button">
    <span class="material-symbols-rounded text-3xl">add</span>
  </button>
  <div class="absolute bottom-full mb-2 left-1/2 -translate-x-1/2 opacity-0 group-hover:opacity-100 transition-all duration-200 pointer-events-none">
    <span class="bg-white text-black tracking-[1.5px] text-sm font-semibold py-1 px-3 rounded-lg shadow-lg whitespace-nowrap">Add New</span>
  </div>
</div>

<script>
/* 
   State (in-memory)
    */
let budgets = []; // { id, name, limit, spent }
function getMonthKey(date) {
  return `${date.getFullYear()}-${String(date.getMonth() + 1).padStart(2, '0')}`;
}
let currentDate = new Date();
let currentMonthKey = getMonthKey(currentDate);


// API HELPER FUNCTIONS
// These functions use fetch API to communicate with the backend


/**
 * Load all budgets from the API for the current month
 * Fetches budgets from the server and displays them on the page
 */
async function loadBudgets() {
  try {
    // Send GET request to API with month filter
    const response = await fetch(`../api/budgets.php?month=${currentMonthKey}`, {
      method: 'GET',
      headers: { 'Content-Type': 'application/json' },
      credentials: 'include' // Include session cookies
    });
    
    // Check if user is logged in
    if (redirectIfUnauthorized(response)) return;
    
    // Convert response to JSON
    const result = await response.json();
    
    // Check if request was successful
    if (result.success) {
      //Store budgets and display them
      budgets = result.data || [];
      renderBudgets(); // Display budgets on page
      checkBudgetAlerts(); // Check for budget warnings
    } else {
      console.error('Error loading budgets:', result.message);
    }
  } catch (error) {
    // Handle network or other errors
    console.error('Error loading budgets:', error);
  }
}


async function saveBudget(data, isEdit = false) {
  try {
    // Build API URL
    let url = '../api/budgets.php';
    if (isEdit && data.id) {
      url += '?id=' + data.id; // Add ID for update requests
    }
    
    // Determine HTTP method (POST for create, PUT for update)
    const method = isEdit ? 'PUT' : 'POST';
    
    // Send request to API
    const response = await fetch(url, {
      method: method,
      headers: { 'Content-Type': 'application/json' },
      credentials: 'include', // Include session cookies
      body: JSON.stringify(data) // Convert data to JSON string
    });
    
    // Check if user is logged in
    if (redirectIfUnauthorized(response)) return null;
    
    // Step 5: Convert response to JSON
    const result = await response.json();
    
    //Check if request was successful
    if (result.success) {
      return result.data; // Return saved budget data
    } else {
      // Show friendly error message
      const errorMsg = result.message || 'An error occurred while saving the budget';
      showNotification(errorMsg, 'danger');
      return null;
    }
  } catch (error) {
    // Handle network or other errors
    console.error('Error saving budget:', error);
    showNotification('Error saving budget. Please try again.', 'danger');
    return null;
  }
}

async function deleteBudget(id) {
  try {
    // Send DELETE request to API with budget ID
    const response = await fetch('../api/budgets.php?id=' + id, {
      method: 'DELETE',
      headers: { 'Content-Type': 'application/json' },
      credentials: 'include' // Include session cookies
    });
    
    // Check if user is logged in
    if (redirectIfUnauthorized(response)) return false;
    
    //Convert response to JSON
    const result = await response.json();
    
    // Check if request was successful
    if (result.success) {
      return true;
    } else {
      const errorMsg = result.message || 'An error occurred while deleting the budget';
      showNotification(errorMsg, 'danger');
      return false;
    }
  } catch (error) {
    // Handle network or other errors
    console.error('Error deleting budget:', error);
    showNotification('Error deleting budget. Please try again.', 'danger');
    return false;
  }
}
let editingId = null;
let deletingId = null;

/* 
   DOM refs
    */
const menuToggle = document.querySelector(".menuToggle");
const sideBar = document.querySelector(".sideBar");
const txtLabels = document.querySelectorAll(".sideBar-text");
const dropdownIcon = document.querySelector(".dropdownIcon");
const dashdropDown = document.querySelector(".dashdropDown");
const dashBtn = document.querySelector(".dashBtn");
const main = document.querySelector("main");

const dateDisplay = document.querySelector('.dateDisplay');
const prevBtn = document.querySelector('.prevBtn');
const nextBtn = document.querySelector('.nextBtn');

const totalBudgetAmount = document.getElementById('totalBudgetAmount');
const totalSpentAmount = document.getElementById('totalSpentAmount');

const budgetsGrid = document.getElementById('budgetsGrid');
const emptyTpl = document.getElementById('emptyStateTpl');

const budgetModalTriggers = document.querySelectorAll('[data-budget-modal-trigger]');
const modalOverlay = document.getElementById('modalOverlay');
const modalPanel = document.getElementById('modalPanel');
const modalBackdrop = document.getElementById('modalBackdrop');
const modalClose = document.getElementById('modalClose');
const modalTitle = document.getElementById('modalTitle');
const budgetForm = document.getElementById('budgetForm');
const budgetCategoryEl = document.getElementById('budgetCategory');
const budgetLimitEl = document.getElementById('budgetLimit');
const cancelBtn = document.getElementById('cancelBtn');

const deleteOverlay = document.getElementById('deleteOverlay');
const confirmDeleteBtn = document.getElementById('confirmDeleteBtn');
const cancelDeleteBtn = document.getElementById('cancelDeleteBtn');

function redirectIfUnauthorized(response) {
  if (response && response.status === 401) {
    window.location.href = './login.php';
    return true;
  }
  return false;
}

/* 
   Stacking Notifications
  */
const notificationContainer = document.createElement('div');
notificationContainer.className = 'fixed top-4 right-4 z-[9999] flex flex-col-reverse items-end gap-2 w-auto max-w-[90vw] sm:max-w-sm';
document.body.appendChild(notificationContainer);

function showNotification(message, type = 'info') {
  const colors = {
    info: 'bg-blue-500',
    warning: 'bg-amber-500',
    danger: 'bg-red-500'
  };

  const note = document.createElement('div');
  note.className = `
    ${colors[type]} text-white px-4 py-2 rounded-lg shadow-lg w-fit max-w-full
    transform translate-x-8 opacity-0 transition-all duration-500 ease-out
  `;
  note.textContent = message;

  notificationContainer.prepend(note);

  // Slide in
  requestAnimationFrame(() => {
    note.classList.remove('translate-x-8', 'opacity-0');
    note.classList.add('translate-x-0', 'opacity-100');
  });

  // Slide out
  setTimeout(() => {
    note.classList.remove('translate-x-0', 'opacity-100');
    note.classList.add('translate-x-8', 'opacity-0');
    setTimeout(() => note.remove(), 500);
  }, 4500);
}

/* CSS Keyframes*/
const style = document.createElement('style');
style.textContent = `
  .notification-enter {
    opacity: 0;
    transform: translateX(24px);
  }
  .notification-enter-active {
    opacity: 1;
    transform: translateX(0);
    transition: all 0.4s ease-out;
  }
  .notification-exit {
    opacity: 1;
    transform: translateX(0);
  }
  .notification-exit-active {
    opacity: 0;
    transform: translateX(24px);
    transition: all 0.4s ease-in;
  }
`;
document.head.appendChild(style);


/*
   Helpers
   */
function uid() { return 'b_' + Math.random().toString(36).slice(2,9); }

function currency(n) {
  return '₱ ' + Number(n||0).toLocaleString(undefined, {minimumFractionDigits:2, maximumFractionDigits:2});
}

/* gradient based on spent ratio (spent / limit) */
function gradientForSpentRatio(ratio) {
  if (!isFinite(ratio)) return 'linear-gradient(90deg, #ef4444 0%, #ef4444 100%)';

  if (ratio <= 0.5) {
    return 'linear-gradient(90deg, #10b981 0%, #34d399 100%)';
  } else if (ratio < 1) {
    return 'linear-gradient(90deg, #10b981 0%, #f59e0b 100%)';
  } else {
    return 'linear-gradient(90deg, #10b981 0%, #f59e0b 50%, #ef4444 100%)';
  }
}

/* sanitize text for injection */
function escapeHtml(unsafe) {
  return String(unsafe)
    .replace(/&/g, "&amp;")
    .replace(/</g, "&lt;")
    .replace(/>/g, "&gt;")
    .replace(/"/g, "&quot;")
    .replace(/'/g, "&#039;");
}

/*
   Render & update
   */
function updateTotals() {
  const totalLimit = budgets.reduce((s, b) => s + Number(b.limit || 0), 0);
  const totalSpent = budgets.reduce((s, b) => s + Number(b.spent || 0), 0);
  totalBudgetAmount.textContent = currency(totalLimit);
  totalSpentAmount.textContent = currency(totalSpent);
}

function renderBudgets() {
  budgetsGrid.innerHTML = '';

  if (budgets.length === 0) {
    budgetsGrid.appendChild(emptyTpl.content.cloneNode(true));
    updateTotals();
    return;
  }

  budgets.forEach(b => {
    const spent = Number(b.spent);
    const limit = Number(b.limit);
    const spentRatio = limit > 0 ? Math.min(1, spent / limit) : 0;
    const percentage = Math.round(spentRatio * 100);
    const remaining = Math.max(0, limit - spent);

    const card = document.createElement('article');
    card.className = 'bg-white rounded-xl p-4 shadow flex flex-col justify-between';

    card.innerHTML = `
      <div class="flex items-start justify-between gap-3 mb-4">
        <div>
          <h3 class="text-lg font-semibold">${escapeHtml(b.name)}</h3>
          <div class="text-sm text-slate-500">Limit: <span class="font-medium">${currency(limit)}</span></div>
          <div class="text-sm text-slate-500">Spent: <span class="font-medium">${currency(spent)}</span></div>
        </div>
        <div class="flex flex-col items-end gap-2">
          <div class="text-xs text-slate-500">Remaining</div>
          <div class="text-lg font-bold">${currency(remaining)}</div>
        </div>
      </div>

      <div class="mb-3">
        <div class="w-full bg-slate-100 rounded-full h-4 overflow-hidden">
          <div class="progress-fill h-4 rounded-full" 
               style="width:${(spentRatio*100).toFixed(2)}%; background:${gradientForSpentRatio(spentRatio)}">
          </div>
        </div>
        <div class="flex justify-between mt-2 text-xs text-slate-500">
          <div>${percentage}% spent</div>
          <div>${currency(spent)} / ${currency(limit)}</div>
        </div>
      </div>

      <div class="flex gap-2 justify-end">
        <button data-id="${b.id}" class="editBtn inline-flex items-center gap-2 px-3 py-1.5 border rounded text-slate-700 hover:bg-gradient-to-r from-emerald-400 to-cyan-400 transition-all duration-300 hover:text-white hover:shadow-md shadow-indigo-400 hover:font-semibold rounded-xl">
          <span class="material-symbols-rounded">edit</span> Edit
        </button>
        <button data-id="${b.id}" class="deleteBtn inline-flex items-center gap-2 px-3 py-1.5 bg-red-50 text-red-600 border border-red-100 rounded hover:bg-gradient-to-r from-red-800 to-pink-500 transition-all duration-300 hover:text-white hover:shadow-md shadow-indigo-400 hover:font-semibold rounded-xl">
          <span class="material-symbols-rounded">delete</span> Delete
        </button>
      </div>
    `;

    card.querySelector('.editBtn').addEventListener('click', () => openModalForEdit(b.id));
    card.querySelector('.deleteBtn').addEventListener('click', () => openDeleteConfirm(b.id));

    budgetsGrid.appendChild(card);
  });

  updateTotals();
}

/*
   Notifications Logic
    */
function checkBudgetAlerts() {
  const monthNames = ["January", "February", "March", "April", "May", "June", 
                     "July", "August", "September", "October", "November", "December"];
  
  budgets.forEach(b => {
    if (b.limit <= 0) return;
    const ratio = b.spent / b.limit;
    const monthDisplay = b.month ? (() => {
      const [year, month] = b.month.split('-').map(Number);
      return `${monthNames[month - 1]} ${year}`;
    })() : '';
    const monthText = monthDisplay ? ` (${monthDisplay})` : '';
    
    if (ratio > 1) {
      showNotification(`🚨 ${b.name}${monthText} has exceeded its budget limit!`, 'danger');
    } else if (ratio === 1) {
      showNotification(`⚠️ ${b.name}${monthText} has reached its budget limit!`, 'warning');
    } else if (ratio >= 0.8) {
      showNotification(`⚠️ ${b.name}${monthText} is nearing its budget limit (${Math.round(ratio*100)}% spent).`, 'warning');
    }
  });
}


// Load expense categories for budget modal
async function loadExpenseCategories() {
  try {
    const response = await fetch('../api/categories.php?type=Expense', {
      method: 'GET',
      headers: { 'Content-Type': 'application/json' },
      credentials: 'include'
    });
    if (redirectIfUnauthorized(response)) return;
    const result = await response.json();
    if (result.success && result.data) {
      budgetCategoryEl.innerHTML = '<option value="">Select an expense category</option>';
      result.data.forEach(cat => {
        const option = document.createElement('option');
        option.value = cat.id;
        option.textContent = cat.name;
        budgetCategoryEl.appendChild(option);
      });
    }
  } catch (error) {
    console.error('Error loading categories:', error);
  }
}

/*
   Modal behavior (Add / Edit)
   */
async function openModal(addMode = true) {
  // Load expense categories when opening modal
  await loadExpenseCategories();
  
  modalOverlay.classList.remove('hidden');
  setTimeout(() => modalPanel.classList.add('show'), 10);

  if (addMode) {
    modalTitle.textContent = 'Add Budget';
    budgetForm.reset();
    editingId = null;
    // Clear category selection
    if (budgetCategoryEl) {
      budgetCategoryEl.value = '';
    }
  }
}

function closeModal() {
  modalPanel.classList.remove('show');
  setTimeout(() => modalOverlay.classList.add('hidden'), 180);
  editingId = null;
  budgetForm.reset();
}

async function openModalForEdit(id) {
  const b = budgets.find(x => x.id === id);
  if (!b) return;
  editingId = id;
  
  // Load categories first
  await loadExpenseCategories();
  
  modalTitle.textContent = 'Edit Budget';
  budgetLimitEl.value = Number(b.limit).toFixed(2);
  
  // Select the category from budget's category_id
  if (b.category_id) {
    budgetCategoryEl.value = b.category_id;
  } else {
    budgetCategoryEl.value = '';
  }
  
  openModal(false);
}

/* 
   Delete confirm
   */
function openDeleteConfirm(id) {
  deletingId = id;
  deleteOverlay.classList.remove('hidden');
}
function closeDeleteConfirm() {
  deletingId = null;
  deleteOverlay.classList.add('hidden');
}

/*
   Form submit (create / update)
   */
budgetForm.addEventListener('submit', async (e) => {
  e.preventDefault();
  const categoryId = parseInt(budgetCategoryEl.value);
  const limit = parseFloat(budgetLimitEl.value) || 0;

  if (!categoryId) { 
    showNotification('Please select an expense category', 'warning'); 
    return; 
  }
  if (limit < 0) { 
    showNotification('Budget limit must be 0 or greater', 'warning'); 
    return; 
  }

  // Get category name
  const categoryResponse = await fetch(`../api/categories.php?id=${categoryId}`, {
    method: 'GET',
    headers: { 'Content-Type': 'application/json' },
    credentials: 'include'
  });
  if (redirectIfUnauthorized(categoryResponse)) {
    closeModal();
    return;
  }
  const categoryResult = await categoryResponse.json();
  if (!categoryResult.success || !categoryResult.data) {
    showNotification('Category not found. Please select a valid category.', 'danger');
    return;
  }
  const categoryName = categoryResult.data.name;

  const isEdit = !!editingId;
  let targetMonth = currentMonthKey;
  if (isEdit) {
    const existing = budgets.find(b => b.id === editingId);
    if (existing && existing.month) {
      targetMonth = existing.month;
    }
  }
  const data = { name: categoryName, limit, month: targetMonth, category_id: categoryId };
  if (isEdit) {
    data.id = editingId;
  }

  const saved = await saveBudget(data, isEdit);
  if (saved) {
    // Budget is now saved with category_id stored in budgets table
    // No need to link categories separately
    await loadBudgets();
    closeModal();
    checkBudgetAlerts(); // Trigger notifications after saving
  }
});

/* delete confirm handlers */
confirmDeleteBtn.addEventListener('click', async () => {
  if (!deletingId) return closeDeleteConfirm();
  const deleted = await deleteBudget(deletingId);
  if (deleted) {
    await loadBudgets();
    closeDeleteConfirm();
  }
});
cancelDeleteBtn.addEventListener('click', closeDeleteConfirm);

/*
   UI events & sidebar + date system
   */
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

const monthNames = ["January","February","March","April","May","June","July","August","September","October","November","December"];

function updateDateDisplay(animated = true) {
  const month = monthNames[currentDate.getMonth()];
  const year = currentDate.getFullYear();
  if (!animated) {
    dateDisplay.textContent = `${month} ${year}`;
    return;
  }
  dateDisplay.classList.add('opacity-0', 'translate-y-1');
  setTimeout(() => {
    dateDisplay.textContent = `${month} ${year}`;
    dateDisplay.classList.remove('translate-y-1');
    dateDisplay.classList.remove('opacity-0');
  }, 200);
}

function refreshBudgets(animated = true) {
  currentMonthKey = getMonthKey(currentDate);
  updateDateDisplay(animated);
  loadBudgets();
}

updateDateDisplay(false);

prevBtn.addEventListener('click', (e) => {
  currentDate.setMonth(currentDate.getMonth() - (e.shiftKey ? 12 : 1));
  updateDateDisplay(true);
  refreshBudgets(true);
});
nextBtn.addEventListener('click', (e) => {
  currentDate.setMonth(currentDate.getMonth() + (e.shiftKey ? 12 : 1));
  updateDateDisplay(true);
  refreshBudgets(true);
});

// Attach event listeners to all budget modal triggers
const openAddBtn = document.getElementById('floatingBudgetBtn');
if (openAddBtn) {
  openAddBtn.addEventListener('click', () => { 
    editingId = null; 
    openModal(true); 
  });
}

modalBackdrop.addEventListener('click', closeModal);
modalClose.addEventListener('click', closeModal);
cancelBtn.addEventListener('click', (e) => { e.preventDefault(); closeModal(); });

document.addEventListener('keydown', (e) => {
  if (e.key === 'Escape') {
    if (!modalOverlay.classList.contains('hidden')) closeModal();
    if (!deleteOverlay.classList.contains('hidden')) closeDeleteConfirm();
  }
});

document.addEventListener('click', () => {
  document.querySelectorAll('.optionsMenu').forEach(m => m.classList.add('hidden'));
});

/* 
   Initialize
    */
// Load username and account balance
async function loadUserInfo() {
  try {
    // Load username
    const userResponse = await fetch('../api/users.php', {
      method: 'GET',
      headers: { 'Content-Type': 'application/json' },
      credentials: 'include'
    });
    if (redirectIfUnauthorized(userResponse)) return;
    if (userResponse.ok) {
      const userResult = await userResponse.json();
      if (userResult.success && userResult.data) {
        const username = userResult.data.username || 'User';
        const welcomeEl = document.getElementById('welcomeUsername');
        if (welcomeEl) welcomeEl.textContent = `Hello ${username}!`;
      }
    }
    
    // Load account balance
    const accountsResponse = await fetch('../api/accounts.php', {
      method: 'GET',
      headers: { 'Content-Type': 'application/json' },
      credentials: 'include'
    });
    if (redirectIfUnauthorized(accountsResponse)) return;
    if (accountsResponse.ok) {
      const accountsResult = await accountsResponse.json();
      if (accountsResult.success && accountsResult.data) {
        const totalBalance = accountsResult.data.reduce((sum, acc) => sum + (parseFloat(acc.value) || 0), 0);
        // Update any balance display elements if they exist
      }
    }
  } catch (error) {
    console.error('Error loading user info:', error);
  }
}

window.addEventListener('DOMContentLoaded', () => {
  loadUserInfo();
  refreshBudgets(false);
});
</script>
</body>
</html>
