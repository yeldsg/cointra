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
<title>Accounts Ledger</title>
<style>
  *{font-family:"Prociono";}
  .currency-value { display:inline-block; word-break:break-word; font-size:clamp(0.9rem,2.2vw,1.05rem); line-height:1.05; overflow-wrap:anywhere; text-align:right; min-width:90px; }

  .tx-row-accent { border-top-left-radius: 0.5rem; border-bottom-left-radius: 0.5rem; }
  .optionsMenu { max-width: 14rem; right: 0; left: auto; }
  .card-icon { width:48px; height:48px; display:flex; align-items:center; justify-content:center; border-radius:8px; }
  .modal-panel { transform: translateY(8px); transition: transform .22s cubic-bezier(.2,.9,.2,1), opacity .18s ease; opacity: 0; }
  .modal-panel.show { transform: translateY(0); opacity: 1; }

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
<!-- Main -->
<main class="flex-1 ml-16 transition-all duration-300 ease-in-out p-6" id="mainContent">
  <!-- Header -->
  <div class="grid gap-4 grid-cols-1">
    <div class="welcomeUser bg-gradient-to-r from-lime-500 to-gray-700 rounded-xl shadow-xl p-6 flex items-center justify-between">
      <div>
        <h1 class="text-xl font-bold text-white">Hello User!</h1>
        <p class="text-gray-100 mt-1 text-sm">Manage your accounts below.</p>
      </div>
      <div class="text-right">
        <div class="text-gray-100 font-semibold text-sm">Overall Balance</div>
        <div id="overallBalance" class="currency-value font-bold text-3xl text-white">₱ 0.00</div>
      </div>
    </div>
  </div>

  <!-- Accounts header -->
  <div class="mt-8">
    <div class="bg-white rounded-xl p-4 shadow-xl text-center">
      <h1 class="text-2xl font-bold text-gray-800">Accounts</h1>
      <p class="text-sm text-gray-500 mt-1">Add bank accounts, wallets, cards — each account shows icon, name, and balance.</p>
    </div>
  </div>

  <!-- Accounts grid -->
  <section class="mt-6">
    <div id="accountCards" class="grid gap-4 mt-6 grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4"></div>
  </section>

<div class="grid place-items-center mt-10">
<button id="openAddCategory" data-tooltip="Add New" class="flex items-center justify-center gap-2 bg-lime-500 rounded-full px-5 py-3 font-bold text-black hover:bg-gradient-to-r from-emerald-400 to-cyan-400 hover:shadow-xl shadow-indigo-400 transition-all duration-300 text-base hover:text-white transition-all sm:text-lg md:text-xl">
<span class="material-symbols-rounded text-2xl sm:text-3xl">add</span>
<span class="hidden sm:inline">Add New Account</span>
</button>
<div class="absolute bottom-full mb-3 left-1/2 -translate-x-1/2 opacity-0 group-hover:opacity-100 
bg-white text-black text-sm font-semibold py-1 px-3 rounded-lg shadow-md 
transition-all duration-300 whitespace-nowrap pointer-events-none">
Add New
</div>
</div>
</main>

<!-- Add Account Modal -->
<div id="addCategoryModalOverlay" class="hidden fixed inset-0 z-[1000] flex items-center justify-center">
  <div id="addCategoryBackdrop" class="absolute inset-0 bg-black/30 backdrop-blur-md transition-opacity"></div>

  <div id="addCategoryModal" class="modal-panel relative w-[92%] max-w-3xl bg-white/90 rounded-2xl shadow-2xl ring-1 ring-white/40 p-4 md:p-6">
    <button id="closeAddModal" class="absolute right-4 top-4 bg-white/30 hover:bg-white/60 text-gray-700 p-2 rounded-md transition">
      <span class="material-symbols-rounded">close</span>
    </button>

    <h3 id="modalHeading" class="text-center text-xl md:text-2xl font-semibold text-gray-800 mb-4">Add New Account</h3>

    <div class="flex flex-col md:flex-row gap-4">
      <!-- Left: icon picker (preset dropdown) -->
      <div class="md:w-1/2 w-full flex flex-col">
        <label class="text-sm font-semibold text-gray-700 mb-2">Choose an icon</label>
        <select id="iconSelect" class="p-2 rounded-lg border bg-white/90">
          <!-- Preset options: use Material Symbols names -->
          <option value="account_balance">Bank</option>
          <option value="credit_card">Card</option>
          <option value="savings">Savings</option>
          <option value="wallet">Wallet</option>
          <option value="account_circle">Profile</option>
          <option value="cash">Cash</option>
          <option value="store">Store</option>
          <option value="attach_money">Money</option>
          <option value="local_atm">ATM</option>
          <option value="payments">Payments</option>
        </select>
        <p class="text-xs text-gray-600 mt-2">Choose from commonly used icons (Material Symbols).</p>
      </div>

      <!-- Right: form -->
      <div class="md:w-1/2 w-full">
        <form id="addCategoryForm" class="flex flex-col gap-3 h-full">
          <label class="block">
            <span class="text-sm font-semibold text-gray-700">Account Name</span>
            <input id="categoryName" type="text" required class="mt-1 w-full rounded-lg p-2 border border-gray-300 focus:ring-2 focus:ring-lime-400 outline-none bg-white/95" placeholder="e.g., 'BPI Savings'">
          </label>

          <label class="block">
            <span class="text-sm font-semibold text-gray-700">Initial Balance (₱)</span>
            <input id="accountValue" type="number" step="0.01" min="0" value="0" required class="mt-1 w-full rounded-lg p-2 border border-gray-300 focus:ring-2 focus:ring-lime-400 outline-none bg-white/95">
          </label>

          <div class="mt-auto flex justify-end gap-3 pt-2">
            <button type="button" id="cancelAddCategory" class="px-4 py-2 rounded-lg bg-gray-200 hover:bg-gray-300">Cancel</button>
            <button type="submit" id="submitAddCategory" class="px-4 py-2 rounded-lg bg-lime-500 text-white hover:bg-lime-600">Add</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- Confirmation Modal -->
<div id="confirmDeleteOverlay" class="hidden fixed inset-0 z-[1100] flex items-center justify-center">
  <div id="confirmBackdrop" class="absolute inset-0 bg-black/30 backdrop-blur-sm transition-opacity"></div>

  <div id="confirmBox" class="relative w-[90%] max-w-sm bg-white/80 backdrop-blur-md rounded-2xl shadow-2xl ring-1 ring-lime-300/50 p-6 transform scale-95 transition-all duration-300">
    <h3 class="text-xl font-semibold text-gray-800 mb-3 text-center">Delete Account</h3>
    <p id="confirmMessage" class="text-gray-700 text-center mb-6">Are you sure you want to delete this account?</p>

    <div class="flex justify-center gap-4">
      <button id="cancelDeleteBtn" class="px-4 py-2 bg-gray-200 hover:bg-gray-300 rounded-lg transition">Cancel</button>
      <button id="confirmDeleteBtn" class="px-4 py-2 bg-gradient-to-r from-emerald-400 to-cyan-400 text-white font-semibold rounded-lg hover:shadow-md transition">Delete</button>
    </div>
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
/* 
   Accounts data + DOM refs
  */
const accountContainer = document.getElementById('accountCards');
const overallBalanceEl = document.getElementById('overallBalance');

let accounts = []; // { id, name, icon, value }
let editingAccount = null;
let accountToDelete = null;
let currentUsername = 'User';
const ICON_ALIASES = {
  cash: 'payments',
  money: 'attach_money',
  atm: 'local_atm'
};

function resolveIconName(icon) {
  const trimmed = (icon || '').trim();
  if (!trimmed) return 'account_balance';
  return ICON_ALIASES[trimmed] || trimmed;
}

/* Utility */
function formatCurrency(n) { return '₱ ' + Number(n || 0).toLocaleString(undefined, { minimumFractionDigits:2, maximumFractionDigits:2 }); }

/* Load user profile */
async function loadUserProfile() {
  try {
    const response = await fetch('../api/users.php', {
      method: 'GET',
      headers: { 'Content-Type': 'application/json' },
      credentials: 'include'
    });
    if (response.status === 401) {
      window.location.href = './login.php';
      return;
    }
    if (response.ok) {
      const result = await response.json();
      if (result.success && result.data) {
        currentUsername = result.data.username || 'User';
        document.querySelector('.welcomeUser h1').textContent = `Hello ${currentUsername}!`;
      }
    }
  } catch (error) {
    console.error('Error loading user profile:', error);
  }
}


// API HELPER FUNCTIONS
// These functions use fetch API to communicate with the backend
 

/**
 * Load all accounts from the API
 * Fetches accounts from the server and displays them on the page
 */
async function loadAccounts() {
  try {
    //Send GET request to API
    const response = await fetch('../api/accounts.php', {
      method: 'GET',
      headers: { 'Content-Type': 'application/json' },
      credentials: 'include' // Include session cookies
    });
    
    //Check if user is logged in
    if (response.status === 401) {
      window.location.href = './login.php';
      return;
    }
    
    // Convert response to JSON
    const result = await response.json();
    
    // Check if request was successful
    if (result.success) {
      // Store accounts and display them
      accounts = result.data || [];
      renderAccounts(); // Display accounts on page
    } else {
      console.error('Error loading accounts:', result.message);
    }
  } catch (error) {
    // Handle network or other errors
    console.error('Error loading accounts:', error);
  }
}

async function saveAccount(data, isEdit = false, accountId = null) {
  try {
    // Build API URL
    let url = '../api/accounts.php';
    if (isEdit && accountId) {
      url += '?id=' + accountId; // Add ID for update requests
    }
    
    //Determine HTTP method (POST for create, PUT for update)
    const method = isEdit ? 'PUT' : 'POST';
    
    //Send request to API
    const response = await fetch(url, {
      method: method,
      headers: { 'Content-Type': 'application/json' },
      credentials: 'include', // Include session cookies
      body: JSON.stringify(data) // Convert data to JSON string
    });
    
    // Check if user is logged in
    if (response.status === 401) {
      window.location.href = './login.php';
      return null;
    }
    
    //Check if request was successful
    if (!response.ok) {
      // Try to get error message from response
      const text = await response.text();
      try {
        const errorData = JSON.parse(text);
        alert('Error: ' + (errorData.message || 'Failed to save account'));
      } catch {
        alert('Error: Failed to save account. Server returned: ' + response.status);
      }
      return null;
    }
    
    //Convert response to JSON
    const result = await response.json();
    
    //Check if request was successful
    if (result.success) {
      return result.data; // Return saved account data
    } else {
      alert('Error: ' + (result.message || 'Failed to save account'));
      return null;
    }
  } catch (error) {
    // Handle network or other errors
    console.error('Error saving account:', error);
    alert('Error saving account: ' + error.message);
    return null;
  }
}


async function deleteAccount(id) {
  try {
    // Send DELETE request to API with account ID
    const response = await fetch(`../api/accounts.php?id=${id}`, {
      method: 'DELETE',
      headers: { 'Content-Type': 'application/json' },
      credentials: 'include' // Include session cookies
    });
    
    //Check if user is logged in
    if (response.status === 401) {
      window.location.href = './login.php';
      return false;
    }
    
    // Convert response to JSON
    const result = await response.json();
    
    // Check if request was successful
    if (result.success) {
      return true;
    } else {
      alert('Error: ' + result.message);
      return false;
    }
  } catch (error) {
    // Handle network or other errors
    console.error('Error deleting account:', error);
    alert('Error deleting account. Please try again.');
    return false;
  }
}
/*
   Modal controls (open/close)
  */
const openAddCategory = document.getElementById('openAddCategory');
const addCategoryOverlay = document.getElementById('addCategoryModalOverlay');
const addCategoryModal = document.getElementById('addCategoryModal');
const addCategoryBackdrop = document.getElementById('addCategoryBackdrop');
const closeAddModal = document.getElementById('closeAddModal');
const cancelAddCategory = document.getElementById('cancelAddCategory');
const addCategoryForm = document.getElementById('addCategoryForm');

openAddCategory.addEventListener('click', () => openModal(false));
closeAddModal.addEventListener('click', closeModal);
cancelAddCategory.addEventListener('click', closeModal);
addCategoryBackdrop.addEventListener('click', closeModal);
document.addEventListener('keydown', (e) => {
  if (e.key === 'Escape') {
    if (!addCategoryOverlay.classList.contains('hidden')) closeModal();
    if (!confirmDeleteOverlay.classList.contains('hidden')) closeConfirmModal();
  }
});

function openModal(edit=false, account=null) {
  editingAccount = edit && account ? { ...account } : null;
  document.getElementById('modalHeading').textContent = edit ? 'Edit Account' : 'Add New Account';
  const submitBtn = document.getElementById('submitAddCategory');
  submitBtn.textContent = edit ? 'Save Changes' : 'Add';
  addCategoryForm.reset();

  // if edit, prefill
  if (editingAccount) {
    document.getElementById('categoryName').value = editingAccount.name;
    document.getElementById('iconSelect').value = resolveIconName(editingAccount.icon);
    document.getElementById('accountValue').value = Number(editingAccount.value).toFixed(2);
  } else {
    // defaults
    document.getElementById('iconSelect').value = 'account_balance';
    document.getElementById('accountValue').value = '0.00';
  }

  addCategoryOverlay.classList.remove('hidden');
  setTimeout(()=> addCategoryModal.classList.add('show'), 10);
}

function closeModal() {
  addCategoryModal.classList.remove('show');
  setTimeout(()=> addCategoryOverlay.classList.add('hidden'), 160);
  addCategoryForm.reset();
  editingAccount = null;
}

/*
   Options handlers (per card)
   */
function attachOptionsHandlers(root=document) {
  root.querySelectorAll(".optionsBtn").forEach((btn) => {
    if (btn._attached) return;
    btn._attached = true;
    btn.addEventListener('click', (ev) => {
      ev.stopPropagation();
      const container = btn.closest('.relative');
      if (!container) return;
      const menu = container.querySelector('.optionsMenu');
      document.querySelectorAll('.optionsMenu').forEach(m => { if (m !== menu) m.classList.add('hidden'); });
      menu.classList.toggle('hidden');
    });
  });

  // edit buttons
  root.querySelectorAll(".editBtn").forEach(b => {
    if (b._editAttached) return;
    b._editAttached = true;
    b.addEventListener('click', (ev) => {
      ev.stopPropagation();
      const card = b.closest('.account-card');
      if (!card) return;
      const id = parseInt(card.getAttribute('data-id'), 10);
      const acc = accounts.find(a => Number(a.id) === id);
      if (acc) openModal(true, acc);
      card.querySelector('.optionsMenu').classList.add('hidden');
    });
  });

  // delete buttons
  root.querySelectorAll(".deleteBtn").forEach(b => {
    if (b._delAttached) return;
    b._delAttached = true;
    b.addEventListener('click', (ev) => {
      ev.stopPropagation();
      const card = b.closest('.account-card');
      if (!card) return;
      const id = parseInt(card.getAttribute('data-id'), 10);
      const acc = accounts.find(a => Number(a.id) === id);
      if (acc) openConfirmModal(card, acc);
      card.querySelector('.optionsMenu').classList.add('hidden');
    });
  });
}

/* 
   Create account card DOM
   */
function createAccountCard(account) {
  const card = document.createElement('div');
  card.className = "relative bg-white rounded-xl border-lime-200 shadow-xl shadow-indigo-400/50 p-4 flex items-center gap-4 account-card";
  card.setAttribute('data-id', String(account.id));

  const iconWrap = document.createElement('div');
  iconWrap.className = "card-icon flex items-center justify-center w-12 h-12 rounded-lg ring-1 ring-lime-300/70 bg-white";
  iconWrap.innerHTML = `<span class="material-symbols-rounded text-2xl">${resolveIconName(account.icon)}</span>`;

  const content = document.createElement('div');
  content.className = "flex-1";
  content.innerHTML = `<h2 class="text-lg font-bold">${account.name}</h2>
                       <div class="text-sm text-gray-500 mt-1 currency-value">${formatCurrency(account.value)}</div>`;

  const actions = document.createElement('div');
  actions.className = "relative";
  actions.innerHTML = `
    <button class="optionsBtn text-2xl text-black focus:outline-none hover:bg-gradient-to-r from-emerald-400 to-cyan-400 font-bold py-2 px-2 rounded-full transition-all duration-300 hover:text-white hover:shadow-xl shadow-indigo-500">
      <span class="material-symbols-rounded">more_horiz</span>
    </button>
    <div class="optionsMenu hidden absolute right-0 bg-white text-black rounded-md shadow-lg border border-indigo-600 w-40 py-2 z-10">
      <button class="editBtn w-full text-left text-sm text-black px-4 py-2 hover:bg-gradient-to-r from-emerald-400 to-cyan-400 font-bold rounded-md transition-all duration-300 hover:text-white"> 
        <span class="material-symbols-rounded text-lg">edit</span> Edit
      </button>
      <button class="deleteBtn w-full text-left text-sm text-black px-4 py-2 hover:bg-gradient-to-r from-emerald-400 to-cyan-400 font-bold rounded-md transition-all duration-300 hover:text-white"> 
        <span class="material-symbols-rounded text-lg">delete</span> Delete
      </button>
    </div>`;

  card.append(iconWrap, content, actions);
  attachOptionsHandlers(card);
  return card;
}

/* 
   Render accounts list + overall balance
  */
function renderAccounts() {
  accountContainer.innerHTML = '';
  if (accounts.length === 0) {
    accountContainer.innerHTML = `<div class="text-center text-gray-500 col-span-full">No accounts yet — click + to add one.</div>`;
    overallBalanceEl.textContent = formatCurrency(0);
    return;
  }

  accounts.forEach(acc => {
    accountContainer.appendChild(createAccountCard(acc));
  });

  // recalc overall balance
  const total = accounts.reduce((s, a) => s + Number(a.value || 0), 0);
  overallBalanceEl.textContent = formatCurrency(total);
}

/*
   Add / Edit form behavior
   */
// Form submit handler - uses the saveAccount helper function
addCategoryForm.addEventListener('submit', async (e) => {
  e.preventDefault();
  
  // Get form data
  const name = document.getElementById('categoryName').value.trim();
  const icon = document.getElementById('iconSelect').value || 'account_balance';
  const value = parseFloat(document.getElementById('accountValue').value) || 0;

  // Validate input
  if (!name) return alert('Please enter an account name.');

  // Prepare account data
  const accountData = { name, icon, value };
  const isEdit = editingAccount !== null;
  const accountId = editingAccount ? editingAccount.id : null;

  // Save account using helper function
  const saved = await saveAccount(accountData, isEdit, accountId);
  
  if (saved) {
    // Reload accounts and close modal
    await loadAccounts();
    closeModal();
  }
});

/* 
   Edit flow wiring helper
   */
const iconSelect = document.getElementById('iconSelect');

/* 
   Confirm delete modal behavior
  */
const confirmDeleteOverlay = document.getElementById('confirmDeleteOverlay');
const confirmBox = document.getElementById('confirmBox');
const confirmMessage = document.getElementById('confirmMessage');
const cancelDeleteBtn = document.getElementById('cancelDeleteBtn');
const confirmDeleteBtn = document.getElementById('confirmDeleteBtn');

function openConfirmModal(cardEl, accountObj) {
  accountToDelete = accountObj;
  confirmMessage.textContent = `Are you sure you want to delete "${accountObj.name}"?`;
  confirmDeleteOverlay.classList.remove('hidden');
  setTimeout(()=> confirmBox.style.transform = 'scale(1)', 10);
}

function closeConfirmModal() {
  confirmBox.style.transform = 'scale(0.95)';
  setTimeout(()=> confirmDeleteOverlay.classList.add('hidden'), 160);
  accountToDelete = null;
}

cancelDeleteBtn.addEventListener('click', closeConfirmModal);
document.getElementById('confirmBackdrop').addEventListener('click', closeConfirmModal);

// Delete confirmation handler - uses the deleteAccount helper function
confirmDeleteBtn.addEventListener('click', async () => {
  if (!accountToDelete) return closeConfirmModal();
  
  // Delete account using helper function
  const deleted = await deleteAccount(accountToDelete.id);
  
  if (deleted) {
    // Reload accounts and close modal
    await loadAccounts();
    closeConfirmModal();
  }
});

/* 
   Global behaviors
   */
document.addEventListener('click', () => {
  document.querySelectorAll('.optionsMenu').forEach(m => m.classList.add('hidden'));
});

window.addEventListener('resize', () => {
  document.querySelectorAll('.optionsMenu').forEach(m => m.classList.add('hidden'));
});

// Load data on page load
document.addEventListener('DOMContentLoaded', () => {
  loadUserProfile();
  loadAccounts();
});

</script>
</body>
</html>
