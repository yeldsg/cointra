<?php if (session_status() === PHP_SESSION_NONE) { session_start(); } if (empty($_SESSION['user_id'])) { header('Location: ./login.php'); exit; } ?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width,initial-scale=1" />
<script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@24,400,0,0"/>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Prociono&display=swap" rel="stylesheet">
<?php include __DIR__ . '/head-meta.php'; ?>
<title>Transactions Ledger</title>
<style>
   *{font-family:"Prociono";}

  .sideBar { transition: all 0.32s cubic-bezier(.2,.9,.2,1); }
  html, body { overflow-x: hidden; }

 
  .sideBar ::-webkit-scrollbar { width: 0.05px; }
  .sideBar ::-webkit-scrollbar-track { background: transparent; }
  .sideBar ::-webkit-scrollbar-thumb { background: rgba(132,204,22,0.22); border-radius: 10px; }
  .sideBar ::-webkit-scrollbar-thumb:hover { background: rgba(132,204,22,0.4); }

 /*For preventing currency or value overflow inside their cards */
  .currency-value {
    display: inline-block;
    word-break: break-word;
    font-size: clamp(0.9rem, 2.2vw, 1.05rem);
    line-height: 1.05;
    overflow-wrap: anywhere;
    text-align: right;
    min-width: 90px;
  }

  .tx-row-accent { border-top-left-radius: 0.5rem; border-bottom-left-radius: 0.5rem; }

  .optionsMenu { max-width: 14rem; right: 0; left: auto; }

  .fade-slide {
    transition: opacity .18s ease, transform .18s ease;
    opacity: 0; transform: translateY(4px);
  }
  .fade-slide.show { opacity: 1; transform: translateY(0); }

  /* Modal vertical slide */
  .modal-panel { transform: translateY(8px); transition: transform .22s cubic-bezier(.2,.9,.2,1), opacity .18s ease; opacity: 0; }
  .modal-panel.show { transform: translateY(0); opacity: 1; }

  /* small helper to keep category select from stretching too wide on mobile */
  .card-inline-select { min-width: 140px; max-width: 220px; }

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

<!-- Sidebar -->
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
<!-- Main -->
<main class="flex-1 ml-16 transition-all duration-300 ease-in-out p-6" id="mainContent">
  <!-- Header -->
  <div class="grid gap-4 grid-cols-1">
    <div class="welcomeUser bg-gradient-to-r from-lime-500 to-gray-700 rounded-xl shadow-xl p-6 flex items-center justify-between">
      <div>
        <h1 id="welcomeUsername" class="text-xl font-bold text-white">Hello User!</h1>
        <p class="text-gray-100 mt-1 text-sm">Welcome back — here are your transactions.</p>
      </div>
      <div class="text-right">
        <div class="text-gray-100 font-semibold text-sm">All Accounts</div>
        <div id="allAccountsBalance" class="currency-value font-bold text-3xl text-white">₱ 00,000.00</div>
      </div>
    </div>

  </div>

  <!-- Totals -->
  <div class="grid gap-4 mt-8 grid-cols-1 lg:grid-cols-3">
    <div class="bg-white rounded-xl p-4 shadow-xl">
      <h2 class="font-bold text-gray-800">Expenses</h2>
      <div id="totalExpenses" class="currency-value font-bold text-xl mt-2 text-red-600">₱0.00</div>
    </div>
    <div class="bg-white rounded-xl p-4 shadow-xl">
      <h2 class="font-bold text-gray-800">Income</h2>
      <div id="totalIncome" class="currency-value font-bold text-xl mt-2 text-green-700">₱0.00</div>
    </div>
    <div class="bg-white rounded-xl p-4 shadow-xl">
      <h2 class="font-bold text-gray-800">Total</h2>
      <div id="ovrlTotal" class="currency-value font-bold text-xl mt-2 text-gray-800">₱0.00</div>
    </div>
  </div>

  <!-- Ledger Title -->
  <div class="mt-10">
    <div class="bg-white rounded-xl p-4 shadow-lg shadow-lime-200/50 text-center">
      <h1 class="text-2xl font-bold text-gray-800">Transaction Records</h1>
    </div>
  </div>

  <!-- Ledger (grouped by date) -->
  <section id="transactionRecords" class="mt-6 space-y-6">
    <!-- JS will populate date groups and rows here -->
  </section>
</main>

<!-- Floating Add Button -->
<div class="group fixed bottom-6 right-6 z-[999]">
  <button id="openAddTransaction" data-tooltip="Add New"
    class="bg-lime-500 rounded-full hover:bg-gradient-to-r from-emerald-400 to-cyan-400 font-bold w-16 h-16 flex items-center justify-center transition-all duration-300 hover:text-white hover:mb-[8px] hover:shadow-xl shadow-indigo-400">
    <span class="material-symbols-rounded text-3xl">add</span>
  </button>
  <div class="absolute bottom-full mb-2 left-1/2 -translate-x-1/2 opacity-0 group-hover:opacity-100 transition-all duration-200 pointer-events-none">
    <span class="bg-white text-black text-sm font-semibold py-1 px-3 rounded-lg shadow-lg whitespace-nowrap">Add New</span>
  </div>
</div>

<!-- Add Transaction Modal -->
<div id="addTransactionOverlay" class="hidden fixed inset-0 z-[1000] flex items-center justify-center px-4">
  <div id="addBackdrop" class="absolute inset-0 bg-black/30"></div>

  <div class="modal-panel relative w-[80%] max-w-lg bg-white/70 backdrop-blur-lg rounded-2xl shadow-2xl p-4 md:p-6" role="dialog" aria-modal="true" aria-labelledby="modalTitle">
    <button id="closeAdd" class="absolute right-4 top-4 p-2 rounded bg-white/30 hover:bg-white">
      <span class="material-symbols-rounded">close</span>
    </button>

    <h3 id="modalTitle" class="text-center text-xl font-semibold text-gray-800 mb-4">Add Transaction</h3>

    <form id="addForm" class="flex flex-col gap-3">
      <div class="flex gap-2">
        <input id="month" type="number" min="1" max="12" placeholder="MM" required class="w-1/3 p-2 rounded border">
        <input id="day" type="number" min="1" max="31" placeholder="DD" required class="w-1/3 p-2 rounded border">
        <input id="year" type="number" min="1900" placeholder="YYYY" required class="w-1/3 p-2 rounded border">
      </div>

      <label>
        <span class="text-sm font-semibold">Type</span>
        <select id="typeSelect" class="mt-1 w-full rounded p-2 border">
          <option value="Expense">Expense</option>
          <option value="Income">Income</option>
        </select>
      </label>

      <label>
        <span class="text-sm font-semibold">Category</span>
        <select id="categorySelect" class="mt-1 w-full rounded p-2 border"></select>
      </label>

      <label>
        <span class="text-sm font-semibold">Account</span>
        <select id="accountSelect" class="mt-1 w-full rounded p-2 border" required>
          <option value="">-- Select Account --</option>
        </select>
      </label>

      <label>
        <span class="text-sm font-semibold">Transaction Name</span>
        <input id="txName" type="text" required class="mt-1 w-full rounded p-2 border">
      </label>

      <label>
        <span class="text-sm font-semibold">Value (₱)</span>
        <input id="txValue" type="number" min="0" step="0.01" required class="mt-1 w-full rounded p-2 border">
      </label>

      <div class="flex justify-end gap-3 mt-2">
        <button type="button" id="cancelAdd" class="px-4 py-2 rounded bg-gray-200">Cancel</button>
        <button type="submit" class="px-4 py-2 rounded bg-lime-500 text-white">Save</button>
      </div>
    </form>
  </div>
</div>

<!-- Confirm Delete Modal -->
<div id="confirmOverlay" class="hidden fixed inset-0 z-[1100] flex items-center justify-center px-4">
  <div id="confirmBackdrop" class="absolute inset-0 bg-black/30"></div>
  <div class="relative w-full max-w-sm bg-white rounded-2xl shadow-2xl p-6">
    <h3 class="text-xl font-semibold text-gray-800 mb-3 text-center">Delete Transaction</h3>
    <p id="confirmText" class="text-center text-gray-700 mb-6">Are you sure?</p>
    <div class="flex justify-center gap-4">
      <button id="cancelDelete" class="px-4 py-2 bg-gray-200 rounded">Cancel</button>
      <button id="confirmDelete" class="px-4 py-2 bg-gradient-to-r from-emerald-400 to-cyan-400 text-white rounded">Delete</button>
    </div>
  </div>
</div>

<script>
var fallbackCategories = {
  Income: ["Salary", "Bonus", "Investment", "Other"],
  Expense: ["Food", "Bills", "Transport", "Shopping", "Other"]
};

var transactions = {};
var editing = null;
var toDelete = null;
var apiCategories = { Income: [], Expense: [] };
var apiAccounts = [];

function loadTransactions() {
  var xhr = new XMLHttpRequest();
  xhr.open('GET', '../api/transactions.php', true);
  xhr.setRequestHeader('Content-Type', 'application/json');
  
  xhr.onreadystatechange = function() {
    if (xhr.readyState === 4 && xhr.status === 200) {
      var result = JSON.parse(xhr.responseText);
      if (result.success) {
        transactions = result.data || {};
        renderTransactions();
        updateTotals();
      }
    }
  };
  xhr.send();
}

function saveTransaction(data, isEdit, callback) {
  if (typeof isEdit === 'function') {
    callback = isEdit;
    isEdit = false;
  }
  if (isEdit === undefined) {
    isEdit = false;
  }
  
  var url = '../api/transactions.php';
  if (isEdit && data.id) {
    url += '?id=' + data.id;
  }
  var method = isEdit ? 'PUT' : 'POST';
  
  var xhr = new XMLHttpRequest();
  xhr.open(method, url, true);
  xhr.setRequestHeader('Content-Type', 'application/json');
  
  xhr.onreadystatechange = function() {
    if (xhr.readyState === 4) {
      if (xhr.status === 200) {
        var result = JSON.parse(xhr.responseText);
        if (result.success) {
          if (result.data && result.data.warning) {
            showNotification('⚠️ ' + result.data.warning, 'warning');
          }
          if (callback) {
            callback(result.data);
          }
        } else {
          showNotification('❌ ' + result.message, 'danger');
          if (callback) {
            callback(null);
          }
        }
      } else {
        var errorMessage = 'Error saving transaction. Please try again.';
        try {
          var errorResult = JSON.parse(xhr.responseText);
          if (errorResult.message) {
            errorMessage = errorResult.message;
          }
        } catch (e) {
        }
        showNotification('❌ ' + errorMessage, 'danger');
        if (callback) {
          callback(null);
        }
      }
    }
  };
  
  xhr.send(JSON.stringify(data));
}

function deleteTransaction(id, callback) {
  var xhr = new XMLHttpRequest();
  xhr.open('DELETE', '../api/transactions.php?id=' + id, true);
  xhr.setRequestHeader('Content-Type', 'application/json');
  
  xhr.onreadystatechange = function() {
    if (xhr.readyState === 4) {
      if (xhr.status === 200) {
        var result = JSON.parse(xhr.responseText);
        if (result.success) {
          loadAccountsFromAPI(function() {
            loadUserInfo(function() {
              if (callback) {
                callback(true);
              }
            });
          });
        } else {
          alert('Error: ' + result.message);
          if (callback) {
            callback(false);
          }
        }
      } else {
        alert('Error deleting transaction. Please try again.');
        if (callback) {
          callback(false);
        }
      }
    }
  };
  xhr.send();
}

const menuToggle = document.querySelector(".menuToggle");
const sideBar = document.querySelector(".sideBar");
const txtLabels = document.querySelectorAll(".sideBar-text");
const dropdownIcon = document.querySelector(".dropdownIcon");
const dashdropDown = document.querySelector(".dashdropDown");
const dashBtn = document.querySelector(".dashBtn");
const main = document.querySelector("main");

menuToggle.addEventListener("click", function() {
  var Collapsed = sideBar.getAttribute("collapsed") === "true";
  sideBar.classList.toggle("w-56", Collapsed);
  sideBar.classList.toggle("w-16", !Collapsed);
  main.classList.toggle("ml-56", Collapsed);
  main.classList.toggle("ml-16", !Collapsed);
  for (var i = 0; i < txtLabels.length; i++) {
    txtLabels[i].classList.toggle("hidden", !Collapsed);
  }
  sideBar.setAttribute("collapsed", Collapsed ? "false" : "true");
  dropdownIcon.classList.toggle("hidden", !Collapsed);
  if (!Collapsed) {
    dashdropDown.classList.remove("show");
    dropdownIcon.classList.remove("rotate-icon");
  }
});

dashBtn.addEventListener("click", function() {
  var Collapsed = sideBar.getAttribute("collapsed") === "true";
  if (Collapsed) {
    menuToggle.click();
  }
  var openDash = dashdropDown.classList.contains("show");
  dashdropDown.classList.toggle("show", !openDash);
  dropdownIcon.classList.toggle("rotate-icon", !openDash);
});

var tooltip = document.createElement("div");
tooltip.className = "fixed bg-white text-black text-sm font-semibold py-1 px-2 rounded-lg shadow-lg z-50 opacity-0 pointer-events-none transform transition-all duration-300";
document.body.appendChild(tooltip);
document.addEventListener("mouseover", function(a) {
  var tt = a.target.closest("[tooltip]");
  if (!tt) return;
  if (tt.closest(".sideBar") && sideBar.getAttribute("collapsed") !== "true") {
    tooltip.style.opacity = 0;
    return;
  }
  tooltip.textContent = tt.getAttribute("tooltip");
  var r = tt.getBoundingClientRect();
  tooltip.style.left = (r.right + 8) + "px";
  tooltip.style.top = (r.top + r.height / 2) + "px";
  tooltip.style.opacity = 1;
  tooltip.style.transform = "translateY(-50%)";
});

document.addEventListener("mouseout", function(a) {
  var tt = a.target.closest("[tooltip]");
  if (tt) tooltip.style.opacity = 0;
});
var openBtn = document.getElementById('openAddTransaction');
var overlay = document.getElementById('addTransactionOverlay');
var panel = overlay.querySelector('.modal-panel');
var closeBtn = document.getElementById('closeAdd');
var cancelBtn = document.getElementById('cancelAdd');
var addForm = document.getElementById('addForm');
var monthEl = document.getElementById('month');
var dayEl = document.getElementById('day');
var yearEl = document.getElementById('year');
var typeSelect = document.getElementById('typeSelect');
var categorySelect = document.getElementById('categorySelect');
var accountSelect = document.getElementById('accountSelect');
var txName = document.getElementById('txName');
var txValue = document.getElementById('txValue');
var recordsContainer = document.getElementById('transactionRecords');

var confirmOverlay = document.getElementById('confirmOverlay');
var confirmText = document.getElementById('confirmText');
var cancelDelete = document.getElementById('cancelDelete');
var confirmDeleteBtn = document.getElementById('confirmDelete');

function autofillDate() {
  var d = new Date();
  monthEl.value = String(d.getMonth() + 1).padStart(2, '0');
  dayEl.value = String(d.getDate()).padStart(2, '0');
  yearEl.value = String(d.getFullYear());
}

function loadCategoriesFromAPI(callback) {
  var xhr = new XMLHttpRequest();
  xhr.open('GET', '../api/categories.php', true);
  xhr.setRequestHeader('Content-Type', 'application/json');
  
  xhr.onreadystatechange = function() {
    if (xhr.readyState === 4 && xhr.status === 200) {
      var result = JSON.parse(xhr.responseText);
      if (result.success && result.data) {
        apiCategories = { Income: [], Expense: [] };
        for (var i = 0; i < result.data.length; i++) {
          var cat = result.data[i];
          if (cat.type === 'Income') {
            apiCategories.Income.push(cat.name);
          } else if (cat.type === 'Expense') {
            apiCategories.Expense.push(cat.name);
          }
        }
      }
      if (callback) {
        callback();
      }
    } else if (xhr.readyState === 4) {
      if (callback) {
        callback();
      }
    }
  };
  xhr.send();
}

function loadAccountsFromAPI(callback) {
  var xhr = new XMLHttpRequest();
  xhr.open('GET', '../api/accounts.php', true);
  xhr.setRequestHeader('Content-Type', 'application/json');
  
  xhr.onreadystatechange = function() {
    if (xhr.readyState === 4 && xhr.status === 200) {
      var result = JSON.parse(xhr.responseText);
      if (result.success && result.data) {
        apiAccounts = result.data || [];
        accountSelect.innerHTML = '<option value="">-- Select Account --</option>';
        for (var i = 0; i < apiAccounts.length; i++) {
          var acc = apiAccounts[i];
          var option = document.createElement('option');
          option.value = acc.id;
          var balance = parseFloat(acc.value || 0);
          option.textContent = acc.name + ' (₱' + balance.toLocaleString(undefined, {minimumFractionDigits: 2, maximumFractionDigits: 2}) + ')';
          accountSelect.appendChild(option);
        }
      }
      if (callback) {
        callback();
      }
    } else if (xhr.readyState === 4) {
      if (callback) {
        callback();
      }
    }
  };
  xhr.send();
}

function populateModalCategorySelect() {
  var type = typeSelect.value;
  var list = [];
  if (apiCategories[type] && apiCategories[type].length > 0) {
    list = apiCategories[type];
  } else if (fallbackCategories[type]) {
    list = fallbackCategories[type];
  }
  categorySelect.innerHTML = '';
  for (var i = 0; i < list.length; i++) {
    var option = document.createElement('option');
    option.value = list[i];
    option.textContent = list[i];
    categorySelect.appendChild(option);
  }
}

function openModal(edit, data) {
  if (edit === undefined) {
    edit = false;
  }
  if (data === undefined) {
    data = null;
  }
  
  editing = null;
  loadCategoriesFromAPI(function() {
    loadAccountsFromAPI(function() {
      populateModalCategorySelect();
      var modalTitle = document.getElementById('modalTitle');
      
      if (!edit) {
        modalTitle.textContent = 'Add Transaction';
        addForm.reset();
        autofillDate();
        accountSelect.value = '';
      } else {
        modalTitle.textContent = 'Edit Transaction';
        monthEl.value = String(data.month).padStart(2, '0');
        dayEl.value = String(data.day).padStart(2, '0');
        yearEl.value = String(data.year);
        typeSelect.value = data.type;
        populateModalCategorySelect();
        categorySelect.value = data.category;
        accountSelect.value = data.account_id || '';
        txName.value = data.name;
        txValue.value = String(data.value);
        editing = {
          id: data.id,
          dateKey: data.dateKey,
          account_id: data.account_id || null,
          type: data.type,
          value: data.value
        };
      }
      overlay.classList.remove('hidden');
      setTimeout(function() {
        panel.classList.add('show');
      }, 10);
    });
  });
}

function closeModal() {
  panel.classList.remove('show');
  setTimeout(function() {
    overlay.classList.add('hidden');
  }, 180);
  addForm.reset();
  editing = null;
}

openBtn.addEventListener('click', function() {
  openModal(false);
});
closeBtn.addEventListener('click', closeModal);
cancelBtn.addEventListener('click', closeModal);
document.getElementById('addBackdrop').addEventListener('click', closeModal);
document.addEventListener('keydown', function(e) {
  if (e.key === 'Escape') {
    if (!overlay.classList.contains('hidden')) {
      closeModal();
    }
    if (!confirmOverlay.classList.contains('hidden')) {
      closeConfirm();
    }
  }
});

function openConfirm(name, data) {
  toDelete = data;
  confirmText.textContent = 'Are you sure you want to delete "' + name + '"?';
  confirmOverlay.classList.remove('hidden');
}

function closeConfirm() {
  confirmOverlay.classList.add('hidden');
  toDelete = null;
}

cancelDelete.addEventListener('click', closeConfirm);
document.getElementById('confirmBackdrop').addEventListener('click', closeConfirm);
confirmDeleteBtn.addEventListener('click', function() {
  if (toDelete) {
    deleteTransaction(toDelete.id, function(deleted) {
      if (deleted) {
        loadTransactions();
        loadAccountsFromAPI(function() {
          loadUserInfo(function() {
            closeConfirm();
          });
        });
      }
    });
  }
});

/*
   Transaction helpers
  */
function uid() { return 't_' + Math.random().toString(36).slice(2,9); }

function formatHumanDate(key) {
  var parts = key.split('-');
  var y = Number(parts[0]);
  var m = Number(parts[1]);
  var d = Number(parts[2]);
  var dt = new Date(y, m - 1, d);
  return dt.toLocaleDateString(undefined, { year: 'numeric', month: 'long', day: 'numeric' });
}

function createTransactionRow(tx) {
  var row = document.createElement('div');
  row.className = "relative flex items-center justify-between p-3 rounded-lg shadow-sm border bg-white";

  var accent = document.createElement('div');
  accent.className = "tx-row-accent absolute left-0 top-0 " + (tx.type === 'Income' ? 'bg-green-500' : 'bg-red-500');
  accent.style.width = '4px';
  accent.style.height = '100%';

  var left = document.createElement('div');
  left.className = "flex flex-col ml-3";
  var title = document.createElement('div');
  title.className = "font-semibold text-gray-800";
  title.textContent = tx.name;
  var metaWrap = document.createElement('div');
  metaWrap.className = "flex items-center gap-3 text-xs text-gray-500";

  var categoryText = document.createElement('button');
  categoryText.type = 'button';
  categoryText.className = "text-xs text-gray-500 hover:text-gray-700 focus:outline-none";
  categoryText.textContent = tx.category;
  categoryText.setAttribute('aria-label', 'Edit category');

  var inlineSelect = document.createElement('select');
  inlineSelect.className = "card-inline-select hidden text-sm p-1 rounded border text-gray-700";
  var categoryList = fallbackCategories[tx.type] || fallbackCategories.Expense;
  for (var i = 0; i < categoryList.length; i++) {
    var option = document.createElement('option');
    option.value = categoryList[i];
    option.textContent = categoryList[i];
    if (categoryList[i] === tx.category) {
      option.selected = true;
    }
    inlineSelect.appendChild(option);
  }

  categoryText.addEventListener('click', function(e) {
    e.stopPropagation();
    inlineSelect.classList.toggle('hidden');
    categoryText.classList.toggle('hidden');
    inlineSelect.focus();
  });

  inlineSelect.addEventListener('blur', function() {
    inlineSelect.classList.add('hidden');
    categoryText.classList.remove('hidden');
    var newVal = inlineSelect.value;
    tx.category = newVal;
    categoryText.textContent = newVal;
  });

  var dot = document.createElement('span');
  dot.textContent = '•';
  dot.className = 'text-xs text-gray-400';
  var typeLabel = document.createElement('span');
  typeLabel.className = 'text-xs text-gray-500';
  typeLabel.textContent = tx.type;

  metaWrap.appendChild(categoryText);
  metaWrap.appendChild(inlineSelect);
  metaWrap.appendChild(dot);
  metaWrap.appendChild(typeLabel);

  left.appendChild(title);
  left.appendChild(metaWrap);

  var right = document.createElement('div');
  right.className = "flex items-center gap-3";

  var amount = document.createElement('div');
  amount.className = "font-bold " + (tx.type === 'Income' ? 'text-green-700' : 'text-red-700') + " currency-value";
  var value = Number(tx.value);
  amount.textContent = '₱ ' + value.toLocaleString(undefined, {minimumFractionDigits: 2, maximumFractionDigits: 2});

  var actions = document.createElement('div');
  actions.className = "relative";
  actions.innerHTML = '<button class="optionsBtn text-2xl text-black focus:outline-none hover:bg-gradient-to-r from-emerald-400 to-cyan-400 font-bold py-2 px-2 rounded-full transition-all duration-300 hover:text-white hover:shadow-xl shadow-indigo-500"><span class="material-symbols-rounded">more_horiz</span></button><div class="optionsMenu hidden absolute right-0 bg-white text-black rounded-md shadow-lg border border-indigo-600 w-40 py-2 z-10"><button class="editBtn w-full text-left text-sm text-black px-4 py-2 hover:bg-gradient-to-r from-emerald-400 to-cyan-400 font-bold rounded-md transition-all duration-300 hover:text-white hover:shadow-xl shadow-indigo-500"><span class="material-symbols-rounded text-lg">edit</span> Edit</button><button class="deleteBtn w-full text-left text-sm text-black px-4 py-2 hover:bg-gradient-to-r from-emerald-400 to-cyan-400 font-bold rounded-md transition-all duration-300 hover:text-white hover:shadow-xl shadow-indigo-500"><span class="material-symbols-rounded text-lg">delete</span> Delete</button></div>';

  row.appendChild(accent);
  row.appendChild(left);
  right.appendChild(amount);
  right.appendChild(actions);
  row.appendChild(right);

  var optBtn = actions.querySelector('.optionsBtn');
  var optMenu = actions.querySelector('.optionsMenu');
  
  optBtn.addEventListener('click', function(ev) {
    ev.stopPropagation();
    var allMenus = document.querySelectorAll('.optionsMenu');
    for (var i = 0; i < allMenus.length; i++) {
      if (allMenus[i] !== optMenu) {
        allMenus[i].classList.add('hidden');
      }
    }
    optMenu.classList.toggle('hidden');
  });

  actions.querySelector('.editBtn').addEventListener('click', function(ev) {
    ev.stopPropagation();
    optMenu.classList.add('hidden');
    var dateParts = tx.dateKey.split('-');
    openModal(true, {
      id: tx.id,
      dateKey: tx.dateKey,
      month: Number(dateParts[1]),
      day: Number(dateParts[2]),
      year: Number(dateParts[0]),
      type: tx.type,
      category: tx.category,
      name: tx.name,
      value: tx.value,
      account_id: tx.account_id
    });
  });

  actions.querySelector('.deleteBtn').addEventListener('click', function(ev) {
    ev.stopPropagation();
    optMenu.classList.add('hidden');
    openConfirm(tx.name, { dateKey: tx.dateKey, id: tx.id });
  });

  row.addEventListener('click', function() {
    optMenu.classList.add('hidden');
  });

  return row;
}

function renderTransactions() {
  recordsContainer.innerHTML = '';
  var dateKeys = Object.keys(transactions);
  dateKeys.sort(function(a, b) {
    return new Date(b) - new Date(a);
  });
  
  if (dateKeys.length === 0) {
    var empty = document.createElement('div');
    empty.className = 'text-center text-gray-500';
    empty.textContent = 'No transactions yet — click + to add one.';
    recordsContainer.appendChild(empty);
    return;
  }
  
  for (var i = 0; i < dateKeys.length; i++) {
    var dateKey = dateKeys[i];
    var group = document.createElement('div');
    group.className = 'bg-transparent';

    var header = document.createElement('div');
    header.className = 'flex items-center justify-between mb-3';
    var title = document.createElement('h3');
    title.className = 'text-lg font-bold text-gray-800';
    title.textContent = formatHumanDate(dateKey);
    header.appendChild(title);

    var list = document.createElement('div');
    list.className = 'grid gap-3';

    for (var j = 0; j < transactions[dateKey].length; j++) {
      var tx = transactions[dateKey][j];
      var row = createTransactionRow(tx);
      list.appendChild(row);
    }

    group.appendChild(header);
    group.appendChild(list);
    recordsContainer.appendChild(group);
  }
}

/* Add / remove helpers */
function addTransactionObj(dateKey, obj) {
  if (!transactions[dateKey]) transactions[dateKey] = [];
  transactions[dateKey].push(obj);
}
function removeTransaction(dateKey, id) {
  if (!transactions[dateKey]) return;
  transactions[dateKey] = transactions[dateKey].filter(t => t.id !== id);
  if (transactions[dateKey].length === 0) delete transactions[dateKey];
  renderTransactions();
  updateTotals();
}

var notificationContainer = document.createElement('div');
notificationContainer.className = 'fixed top-4 right-4 z-[9999] flex flex-col-reverse items-end gap-2 w-auto max-w-[90vw] sm:max-w-sm';
document.body.appendChild(notificationContainer);

function showNotification(message, type) {
  if (!type) {
    type = 'info';
  }
  
  var colors = {
    info: 'bg-blue-500',
    warning: 'bg-amber-500',
    danger: 'bg-red-500'
  };

  var note = document.createElement('div');
  note.className = colors[type] + ' text-white px-4 py-2 rounded-lg shadow-lg w-fit max-w-full transform translate-x-8 opacity-0 transition-all duration-500 ease-out';
  note.textContent = message;

  notificationContainer.insertBefore(note, notificationContainer.firstChild);

  setTimeout(function() {
    note.classList.remove('translate-x-8', 'opacity-0');
    note.classList.add('translate-x-0', 'opacity-100');
  }, 10);

  setTimeout(function() {
    note.classList.remove('translate-x-0', 'opacity-100');
    note.classList.add('translate-x-8', 'opacity-0');
    setTimeout(function() {
      note.remove();
    }, 500);
  }, 4500);
}

/*
   Budget Alerts Logic
   */
async function checkBudgetAlerts(transactionMonth = null) {
  try {
    // Use transaction month if provided, otherwise use current month
    let monthKey;
    if (transactionMonth) {
      monthKey = transactionMonth;
    } else {
      const now = new Date();
      monthKey = `${now.getFullYear()}-${String(now.getMonth() + 1).padStart(2, '0')}`;
    }
    
    const response = await fetch(`../api/budgets.php?month=${monthKey}`, {
      method: 'GET',
      headers: { 'Content-Type': 'application/json' },
      credentials: 'include'
    });
    
    if (!response.ok) {
      console.error('Failed to fetch budgets:', response.status);
      return;
    }
    
    const result = await response.json();
    if (!result.success || !result.data || result.data.length === 0) {
      return;
    }
    
    const monthNames = ["January", "February", "March", "April", "May", "June", 
                       "July", "August", "September", "October", "November", "December"];
    
    result.data.forEach(b => {
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
  } catch (error) {
    console.error('Error checking budget alerts:', error);
  }
}

addForm.addEventListener('submit', function(e) {
  e.preventDefault();
  var m = String(monthEl.value).padStart(2, '0');
  var d = String(dayEl.value).padStart(2, '0');
  var y = String(yearEl.value);
  var dateKey = y + '-' + m + '-' + d;
  var type = typeSelect.value;
  var category = categorySelect.value;
  if (!category) {
    if (type === 'Income') {
      category = fallbackCategories.Income[0];
    } else {
      category = fallbackCategories.Expense[0];
    }
  }
  var accountId = accountSelect.value ? parseInt(accountSelect.value) : null;
  var name = txName.value.trim();
  var value = parseFloat(txValue.value);
  
  if (!name || isNaN(value) || !accountId) {
    alert('Please fill all required fields: name, value, and account.');
    return;
  }

  var isEdit = editing && editing.id;
  var data = {
    type: type,
    category: category,
    name: name,
    value: value,
    dateKey: dateKey,
    account_id: accountId
  };
  if (isEdit) {
    data.id = editing.id;
  }

  saveTransaction(data, isEdit, function(saved) {
    if (saved) {
      loadTransactions();
      loadAccountsFromAPI(function() {
        loadUserInfo(function() {
          closeModal();
        });
      });
    }
  });
});

typeSelect.addEventListener('change', populateModalCategorySelect);

document.addEventListener('click', function(ev) {
  var menus = document.querySelectorAll('.optionsMenu');
  for (var i = 0; i < menus.length; i++) {
    menus[i].classList.add('hidden');
  }
});

function loadUserInfo(callback) {
  var xhr = new XMLHttpRequest();
  xhr.open('GET', '../api/users.php', true);
  xhr.setRequestHeader('Content-Type', 'application/json');
  
  xhr.onreadystatechange = function() {
    if (xhr.readyState === 4 && xhr.status === 200) {
      var userResult = JSON.parse(xhr.responseText);
      if (userResult.success && userResult.data) {
        var username = userResult.data.username || 'User';
        var welcomeEl = document.getElementById('welcomeUsername');
        if (welcomeEl) {
          welcomeEl.textContent = 'Hello ' + username + '!';
        }
      }
      
      var accountsXhr = new XMLHttpRequest();
      accountsXhr.open('GET', '../api/accounts.php', true);
      accountsXhr.setRequestHeader('Content-Type', 'application/json');
      
      accountsXhr.onreadystatechange = function() {
        if (accountsXhr.readyState === 4 && accountsXhr.status === 200) {
          var accountsResult = JSON.parse(accountsXhr.responseText);
          if (accountsResult.success && accountsResult.data) {
            var totalBalance = 0;
            for (var i = 0; i < accountsResult.data.length; i++) {
              totalBalance += parseFloat(accountsResult.data[i].value || 0);
            }
            var balanceEl = document.getElementById('allAccountsBalance');
            if (balanceEl) {
              balanceEl.textContent = '₱ ' + totalBalance.toLocaleString(undefined, {minimumFractionDigits: 2, maximumFractionDigits: 2});
            }
          }
        }
        if (callback) {
          callback();
        }
      };
      accountsXhr.send();
    } else if (xhr.readyState === 4) {
      if (callback) {
        callback();
      }
    }
  };
  xhr.send();
}

window.addEventListener('DOMContentLoaded', function() {
  loadUserInfo(function() {
    autofillDate();
    loadCategoriesFromAPI(function() {
      populateModalCategorySelect();
      loadTransactions();
    });
  });
});

window.addEventListener('resize', function() {
  var menus = document.querySelectorAll('.optionsMenu');
  for (var i = 0; i < menus.length; i++) {
    menus[i].classList.add('hidden');
  }
});

function updateTotals() {
  var totalIncome = 0;
  var totalExpenses = 0;
  var dateKeys = Object.keys(transactions);
  
  for (var i = 0; i < dateKeys.length; i++) {
    var dayList = transactions[dateKeys[i]];
    for (var j = 0; j < dayList.length; j++) {
      var tx = dayList[j];
      if (tx.type === "Income") {
        totalIncome += Number(tx.value);
      } else if (tx.type === "Expense") {
        totalExpenses += Number(tx.value);
      }
    }
  }
  
  document.getElementById("totalIncome").textContent = '₱ ' + totalIncome.toLocaleString(undefined, { minimumFractionDigits: 2 });
  document.getElementById("totalExpenses").textContent = '₱ ' + totalExpenses.toLocaleString(undefined, { minimumFractionDigits: 2 });
  document.getElementById("ovrlTotal").textContent = '₱ ' + (totalIncome - totalExpenses).toLocaleString(undefined, { minimumFractionDigits: 2 });
}

</script>
</body>
</html>
