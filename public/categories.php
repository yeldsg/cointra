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
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<style>
*{font-family: "Prociono";}
  .sideBar { transition: all 0.32s cubic-bezier(.2,.9,.2,1); }
  html, body { overflow-x: hidden; }

  /* Integrated scrollbar if options do not fit in screen */
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
<body class = "min-h-screen flex overflow-x-hidden overflow-y-auto">
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

<!--Start of main content-->
<main class="flex-1 ml-16 transition-all duration-300 ease-in-out p-6" id="mainContent">
  <!--Main Content Gridding Set-Up-->
  <div class="grid gap-4 grid-cols-1">
    <!--Welcome message & Date System-->
    <div class="welcomeUser bg-gradient-to-r from-lime-500 to-gray-700 rounded-xl shadow-xl p-6 flex items-center justify-between">
      <div>
        <h1 id="welcomeUsername" class="text-xl font-bold text-white">Hello User!</h1>
        <p class="text-gray-100 mt-1 text-sm">Welcome back to your Categories.</p>
      </div>
      <div class="text-right">
        <div class="text-gray-100 font-semibold text-sm">All Accounts</div>
        <div id="allAccountsBalance" class="currency-value font-bold text-3xl text-white">₱ 00,000.00</div>
      </div>
      <!--Date Display Alignment-->
    </div>
  </div>
  <!--Total Budget Container & Content-->
  <div class="grid gap-4 mt-10 grid-cols-1 xl:grid-cols-2">
    <div class="bg-white rounded-xl border-lime-200 shadow-xl shadow-indigo-400/50 p-4 inset-ring-2 inset-ring-lime-700/50 inset-shadow-sm/100 inset-shadow-cyan-300/50">
      <h1 class="text-center text-shadow-lg xl:text-2xl font-bold text-gray-800 mb-3 md:text-lg">Expenses so Far</h1>
      <h6 id="totalExpenses" class="text-center text-shadow-lg xl:text-xl font-bold text-gray-800 mb-3 md:text-lg">₱ 00,000.00</h6>
    </div>
    <!--Total Spent Container & Content-->
    <div class="bg-white rounded-xl border-lime-200 shadow-xl shadow-indigo-400/50 p-4 inset-ring-2 inset-ring-lime-700/50 inset-shadow-sm/100 inset-shadow-cyan-300/50">
      <h1 class="text-center text-shadow-lg xl:text-2xl font-bold text-gray-800 mb-3 md:text-lg">Income so Far</h1>
      <h6 id="totalIncome" class="text-center text-shadow-lg xl:text-xl font-bold text-gray-800 mb-3 md:text-lg">₱ 00,000.00</h6>
    </div>
  </div>

  <!--Start of Budget Categories Container-->
  <!--Income Categories-->
  <div class="flex-1 p-6 overflow-y-auto">
    <!--Budget Categories gridding set-up-->
    <div class="grid gap-4 mt-10 grid-cols-1">
      <div class="bg-white rounded-xl shadow-lg shadow-lime-200/50 p-4">
        <h1 class="text-center text-xl font-bold text-gray-800 mb-3">Income Categories</h1>
      </div>
    </div>
    <!--Income Categories Grid(grid set-up)-->
<div id="incomeCategories" class="grid gap-4 mt-10 grid-cols-1 md:grid-cols-2 lg:grid-cols-4">
  <!-- New income cards added dynamically here -->
</div>

    <!--Expense Categories-->
    <!--Budget Categories gridding set-up-->
    <div class="grid gap-4 mt-10 grid-cols-1">
      <div class="bg-white rounded-xl shadow-lg shadow-lime-200/50 p-4">
        <h1 class="text-center text-xl font-bold text-gray-800 mb-3">Expense Categories</h1>
      </div>
    </div>
    <!--Expense Grid Set-Up(grid set-up)-->
   <div id="expenseCategories" class="grid gap-4 mt-10 grid-cols-1 md:grid-cols-2 lg:grid-cols-4">
  <!-- New income cards added dynamically here -->
</div>
  </div>
</main>

<script>
// Sidebar toggle
const menuToggle = document.querySelector(".menuToggle");
const sideBar = document.querySelector(".sideBar");
const txtLabels = document.querySelectorAll(".sideBar-text");
const dropdownIcon = document.querySelector(".dropdownIcon");
const dashdropDown = document.querySelector(".dashdropDown");
const dashBtn = document.querySelector(".dashBtn");
const main = document.querySelector("main");
const incomeCategoriesContainer = document.getElementById('incomeCategories');
const expenseCategoriesContainer = document.getElementById('expenseCategories');
let categoriesCache = [];

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

  // Options Menu (Categories Section)
  // Attach dropdown handlers to all options buttons (existing and future)
  function attachOptionsHandlers(root = document) {
    root.querySelectorAll(".optionsBtn").forEach((btn) => {
      // Avoid attaching duplicate handlers
      if (btn._optionsHandlerAttached) return;
      btn._optionsHandlerAttached = true;

      btn.addEventListener("click", (e) => {
        e.stopPropagation(); // prevent closing immediately
        const container = btn.closest(".relative");
        if (!container) return;
        const menu = container.querySelector(".optionsMenu");
        // Close all other menus first
        document.querySelectorAll(".optionsMenu").forEach((other) => {
          if (other !== menu) other.classList.add("hidden");
        });
        // Toggle current menu
        if (menu) menu.classList.toggle("hidden");
      });
    });
  }

  // Close all dropdowns when clicking anywhere else
  document.addEventListener("click", () => {
    document.querySelectorAll(".optionsMenu").forEach((menu) => {
      menu.classList.add("hidden");
    });
  });

  // initial attach for existing buttons
  attachOptionsHandlers(document);

</script>

<!--Add Button-->
<div class="group fixed bottom-6 right-6 z-[999]">
  <button id="openAddCategory" data-tooltip="Add New"
    class="bg-lime-500 rounded-full hover:bg-gradient-to-r from-emerald-400 to-cyan-400 font-bold w-16 h-16 flex items-center justify-center transition-all duration-300 hover:text-white hover:mb-[8px] hover:shadow-xl shadow-indigo-400">
    <span class="material-symbols-rounded text-3xl">add</span>
  </button>
  <!-- Tooltip ABOVE the button -->
  <div
    class="absolute bottom-full mb-2 left-1/2 -translate-x-1/2 opacity-0 group-hover:opacity-100 transition-all duration-200 pointer-events-none">
    <span class="bg-white tracking-[1.5px] text-black text-sm font-semibold py-1 px-3 rounded-lg shadow-lg whitespace-nowrap">Add New</span>
  </div>
</div>
<!--Message Box/Pop-up for Adding Categories-->
<div id="addCategoryModalOverlay" class="hidden fixed inset-0 z-[1000] flex items-center justify-center">
  <!-- backdrop -->
  <div id="addCategoryBackdrop" class="absolute inset-0 bg-black/70 backdrop-blur-md transition-opacity"></div>

  <!-- modal card -->
  <div id="addCategoryModal"
    class="relative w-[80%] max-w-3xl bg-white/70 backdrop-blur-md rounded-2xl shadow-2xl ring-1 ring-white/40 p-4 md:p-6 transform transition-all">
    <button id="closeAddModal"
      class="absolute right-4 top-4 text-gray-700 p-2 rounded-md transition">
      <span class="material-symbols-rounded">close</span>
    </button>

    <h3 class="text-center text-xl md:text-2xl font-semibold text-gray-800 mb-4">Add New Category</h3>

    <div class="flex flex-col md:flex-row gap-4">
      <!-- Left: icon picker -->
      <div class="md:w-1/2 w-full flex flex-col">
        <label class="text-sm font-semibold text-gray-700 mb-2">Choose an icon</label>
        <div id="iconPicker" class="flex gap-3 overflow-x-auto py-2 px-1"></div>
        <p class="text-xs text-gray-600 mt-2">Scroll left/right — click an icon to select.</p>
      </div>

      <!-- Right: form -->
      <div class="md:w-1/2 w-full">
        <form id="addCategoryForm" class="flex flex-col gap-3 h-full">
          <label class="block">
            <span class="text-sm font-semibold text-gray-700">Category Name</span>
            <input id="categoryName" type="text" required
              class="mt-1 w-full rounded-lg p-2 border border-gray-300 focus:ring-2 focus:ring-lime-400 outline-none bg-white/90">
          </label>

          <label class="block">
            <span class="text-sm font-semibold text-gray-700">Category Type</span>
            <select id="categoryType"
              class="mt-1 w-full rounded-lg p-2 border border-gray-300 focus:ring-2 focus:ring-lime-400 outline-none bg-white/90">
              <option>Income</option>
              <option selected>Expense</option>
            </select>
          </label>

          <div class="mt-auto flex justify-end gap-3 pt-2">
            <button type="button" id="cancelAddCategory"
              class="px-4 py-2 rounded-lg bg-gray-200 hover:bg-gray-300">Cancel</button>
            <button type="submit" class="px-4 py-2 rounded-lg bg-lime-500 text-white hover:bg-lime-600">Add</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- Confirmation Modal -->
<div id="confirmDeleteOverlay" class="hidden fixed inset-0 z-[1100] flex items-center justify-center">
  <div id="confirmBackdrop" class="absolute inset-0 bg-black/30 backdrop-blur-sm transition-opacity"></div>

  <div id="confirmBox"
    class="relative w-[90%] max-w-sm bg-white/80 backdrop-blur-md rounded-2xl shadow-2xl ring-1 ring-lime-300/50 p-6 transform scale-95 transition-all duration-300">
    <h3 class="text-xl font-semibold text-gray-800 mb-3 text-center">Delete Category</h3>
    <p id="confirmMessage" class="text-gray-700 text-center mb-6">Are you sure you want to delete this category?</p>

    <div class="flex justify-center gap-4">
      <button id="cancelDeleteBtn"
        class="px-4 py-2 bg-gray-200 hover:bg-gray-300 rounded-lg transition">Cancel</button>
      <button id="confirmDeleteBtn"
        class="px-4 py-2 bg-gradient-to-r from-emerald-400 to-cyan-400 text-white font-semibold rounded-lg hover:shadow-md transition">Delete</button>
    </div>
  </div>
</div>


<script>
  // Modal & Icon Picker Logic 
  const openAddCategory = document.getElementById('openAddCategory');
  const addCategoryOverlay = document.getElementById('addCategoryModalOverlay');
  const addCategoryModal = document.getElementById('addCategoryModal');
  const addCategoryBackdrop = document.getElementById('addCategoryBackdrop');
  const closeAddModal = document.getElementById('closeAddModal');
  const cancelAddCategory = document.getElementById('cancelAddCategory');
  const addCategoryForm = document.getElementById('addCategoryForm');
  const iconPicker = document.getElementById('iconPicker');

  let selectedIcon = 'category';
  let editMode = false; // determines whether we're editing or adding
  let editingCard = null; // stores the card being edited
  const confirmDeleteOverlay = document.getElementById('confirmDeleteOverlay');
  const confirmBox = document.getElementById('confirmBox');
  const confirmMessage = document.getElementById('confirmMessage');
  const cancelDeleteBtn = document.getElementById('cancelDeleteBtn');
  const confirmDeleteBtn = document.getElementById('confirmDeleteBtn');
  const confirmBackdrop = document.getElementById('confirmBackdrop');
  let cardToDelete = null;

  function openConfirmModal(card, name) {
    cardToDelete = card;
    confirmMessage.textContent = `Are you sure you want to delete "${name}"?`;
    confirmDeleteOverlay.classList.remove('hidden');
    setTimeout(() => confirmBox.style.transform = 'scale(1)', 10);
  }

  function closeConfirmModal() {
    confirmBox.style.transform = 'scale(0.95)';
    setTimeout(()=> confirmDeleteOverlay.classList.add('hidden'), 160);
    cardToDelete = null;
  }

  cancelDeleteBtn.addEventListener('click', closeConfirmModal);
  confirmBackdrop.addEventListener('click', closeConfirmModal);
  document.addEventListener('keydown', (e) => {
    if (e.key === 'Escape' && !confirmDeleteOverlay.classList.contains('hidden')) closeConfirmModal();
  });

  confirmDeleteBtn.addEventListener('click', async () => {
    if (!cardToDelete) return closeConfirmModal();
    const categoryId = cardToDelete.dataset.categoryId;
    if (!categoryId) {
      closeConfirmModal();
      return;
    }
    const deleted = await deleteCategory(categoryId);
    if (deleted) {
      await loadCategories();
    }
    closeConfirmModal();
  });


  // API HELPER FUNCTIONS
  // These functions use fetch API to communicate with the backend


  /**
   * Load all categories from the API
   * Fetches categories from the server and displays them on the page
   */
  async function loadCategories() {
    try {
      // Send GET request to API
      const response = await fetch('../api/categories.php', {
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
        // Store categories and display them
        categoriesCache = Array.isArray(result.data) ? result.data : [];
        renderCategories(); // Display categories on page
      } else {
        console.error('Error loading categories:', result.message);
      }
    } catch (error) {
      // Handle network or other errors
      console.error('Error loading categories:', error);
    }
  }

  function renderCategories() {
    incomeCategoriesContainer.innerHTML = '';
    expenseCategoriesContainer.innerHTML = '';

    if (!categoriesCache.length) {
      incomeCategoriesContainer.innerHTML = `<div class="text-center text-gray-500 col-span-full">No categories yet — click + to add one.</div>`;
      expenseCategoriesContainer.innerHTML = `<div class="text-center text-gray-500 col-span-full">No categories yet — click + to add one.</div>`;
      return;
    }

    categoriesCache.forEach(cat => {
      const target = cat.type === 'Income' ? incomeCategoriesContainer : expenseCategoriesContainer;
      const card = createCategoryCard(cat);
      target.appendChild(card);
    });

    attachOptionsHandlers(document);
  }

 
  async function saveCategory(data, isEdit = false) {
    try {
      //  Build API URL
      let url = '../api/categories.php';
      if (isEdit && data.id) {
        url += '?id=' + data.id; // Add ID for update requests
      }
      
      // Determine HTTP method (POST for create, PUT for update)
      const method = isEdit ? 'PUT' : 'POST';
      
      //  Send request to API
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
      
      // Check if request was successful
      if (!response.ok) {
        // Try to get error message from response
        const text = await response.text();
        try {
          const errorData = JSON.parse(text);
          alert('Error: ' + (errorData.message || 'Failed to save category'));
        } catch {
          alert('Error: Failed to save category. Server returned: ' + response.status);
        }
        return null;
      }
      
      //  Convert response to JSON
      const result = await response.json();
      
      // Check if request was successful
      if (result.success) {
        return result.data; // Return saved category data
      } else {
        alert('Error: ' + (result.message || 'Failed to save category'));
        return null;
      }
    } catch (error) {
      // Handle network or other errors
      console.error('Error saving category:', error);
      alert('Error saving category: ' + error.message);
      return null;
    }
  }

 
  async function deleteCategory(id) {
    try {
      //  Send DELETE request to API with category ID
      const response = await fetch('../api/categories.php?id=' + id, {
        method: 'DELETE',
        headers: { 'Content-Type': 'application/json' },
        credentials: 'include' // Include session cookies
      });
      
      // Check if user is logged in
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
      console.error('Error deleting category:', error);
      alert('Error deleting category. Please try again.');
      return false;
    }
  }

  const availableIcons = [
    "savings","category","shopping_cart","home","store","receipt_long","credit_card",
    "restaurant","fastfood","local_grocery_store","flight","directions_car","pets",
    "music_note","fitness_center","sports_esports","work","event","medical_services",
    "child_friendly","school","chair","receipt","account_balance"
  ];

  // Create icon button
  function createIconButton(iconName) {
    const btn = document.createElement('button');
    btn.type = 'button';
    btn.className = "relative flex-shrink-0 p-2 rounded-lg ring-1 ring-lime-300/70 hover:ring-lime-500 hover:bg-lime-50 transition focus:outline-none";
    btn.setAttribute('aria-label', iconName);
    btn.innerHTML = `
      <span class="material-symbols-rounded text-2xl">${iconName}</span>
      <div class="absolute bottom-full left-1/2 -translate-x-1/2 mb-2 opacity-0 pointer-events-none transition-opacity duration-150">
        <span class="bg-white text-black text-xs font-semibold py-1 px-2 rounded-md shadow-md whitespace-nowrap">${iconName}</span>
      </div>
    `;

    btn.addEventListener('click', (e) => {
      e.stopPropagation();
      selectedIcon = iconName;
      iconPicker.querySelectorAll('button').forEach(b => {
        b.classList.remove('bg-lime-300','ring-2','ring-lime-600','scale-105');
      });
      btn.classList.add('bg-lime-300','ring-2','ring-lime-600','scale-105');
    });
    btn.addEventListener('mouseenter', () => btn.querySelector('div').style.opacity = '1');
    btn.addEventListener('mouseleave', () => btn.querySelector('div').style.opacity = '0');
    return btn;
  }

  availableIcons.forEach(iconName => {
    const ib = createIconButton(iconName);
    if (iconName === selectedIcon)
      ib.classList.add('bg-lime-300','ring-2','ring-lime-600','scale-105');
    iconPicker.appendChild(ib);
  });

  // Modal Control 
  openAddCategory.addEventListener('click', () => openModal());
  closeAddModal.addEventListener('click', closeModal);
  cancelAddCategory.addEventListener('click', closeModal);
  addCategoryBackdrop.addEventListener('click', closeModal);
  document.addEventListener('keydown', e => {
    if (e.key === 'Escape' && !addCategoryOverlay.classList.contains('hidden')) closeModal();
  });

  function openModal(edit = false, card = null) {
    editMode = edit;
    editingCard = card;
    addCategoryOverlay.classList.remove('hidden');
    setTimeout(() => addCategoryModal.style.transform = 'translateY(0) scale(1)', 10);

    const title = addCategoryModal.querySelector('h3');
    const submitBtn = addCategoryForm.querySelector('button[type="submit"]');
    if (editMode) {
      title.textContent = 'Edit Category';
      submitBtn.textContent = 'Save Changes';
      const nameField = document.getElementById('categoryName');
      const typeField = document.getElementById('categoryType');
      const cardName = card.querySelector('h2').textContent;
      const iconName = card.querySelector('.material-symbols-rounded').textContent;
      nameField.value = cardName;
      selectedIcon = iconName;
      iconPicker.querySelectorAll('button').forEach(b => {
        b.classList.remove('bg-lime-300','ring-2','ring-lime-600','scale-105');
        if (b.getAttribute('aria-label') === iconName)
          b.classList.add('bg-lime-300','ring-2','ring-lime-600','scale-105');
      });
      const typeParent = card.closest('#incomeCategories') ? 'Income' : 'Expense';
      typeField.value = typeParent;
    } else {
      title.textContent = 'Add New Category';
      submitBtn.textContent = 'Add';
      addCategoryForm.reset();
      resetIconSelection();
    }
  }

  function closeModal() {
    addCategoryOverlay.classList.add('hidden');
    addCategoryModal.style.transform = 'translateY(6px) scale(0.995)';
    addCategoryForm.reset();
    resetIconSelection();
    selectedIcon = 'category';
    editMode = false;
    editingCard = null;
  }

  function resetIconSelection() {
    iconPicker.querySelectorAll('button').forEach(b => {
      b.classList.remove('bg-lime-300','ring-2','ring-lime-600','scale-105');
      if (b.getAttribute('aria-label') === 'category')
        b.classList.add('bg-lime-300','ring-2','ring-lime-600','scale-105');
    });
  }

  // Category Card Creation 
  function createCategoryCard(category) {
    const { id, name, icon, type } = category;
    const card = document.createElement('div');
    card.className = "relative bg-white rounded-xl border-lime-200 shadow-xl shadow-indigo-400/50 p-4 flex items-center gap-4";
    card.dataset.categoryId = id;
    card.dataset.categoryType = type;

    const iconWrap = document.createElement('div');
    iconWrap.className = "flex items-center justify-center w-12 h-12 rounded-lg ring-1 ring-lime-300/70 bg-white";
    iconWrap.innerHTML = `<span class="material-symbols-rounded text-2xl">${icon || 'category'}</span>`;

    const content = document.createElement('div');
    content.className = "flex-1";
    content.innerHTML = `<h2 class="text-lg font-bold">${name}</h2>`;

    const actions = document.createElement('div');
    actions.className = "relative";
    actions.innerHTML = `
      <button class="optionsBtn text-2xl text-black focus:outline-none hover:bg-gradient-to-r from-emerald-400 to-cyan-400 font-bold py-2 px-2 rounded-full transition-all duration-300 hover:text-white hover:shadow-xl shadow-indigo-500">
        <span class="material-symbols-rounded">more_horiz</span>
      </button>
      <div class="optionsMenu hidden absolute right-0 bg-white text-black rounded-md shadow-lg border border-indigo-600 w-40 py-2 z-10">
        <button class="editBtn w-full text-left text-sm text-black px-4 py-2 hover:bg-gradient-to-r from-emerald-400 to-cyan-400 font-bold rounded-md transition-all duration-300 hover:text-white hover:shadow-xl shadow-indigo-500">
          <span class="material-symbols-rounded text-lg">edit</span> Edit
        </button>
        <button class="deleteBtn w-full text-left text-sm text-black px-4 py-2 hover:bg-gradient-to-r from-emerald-400 to-cyan-400 font-bold rounded-md transition-all duration-300 hover:text-white hover:shadow-xl shadow-indigo-500">
          <span class="material-symbols-rounded text-lg">delete</span> Delete
        </button>
      </div>
    `;

    card.append(iconWrap, content, actions);
    attachOptionsHandlers(card);

    // Edit & Delete handlers
    actions.querySelector('.editBtn').addEventListener('click', (e) => {
      e.stopPropagation();
      actions.querySelector('.optionsMenu').classList.add('hidden');
      openModal(true, card);
    });

   actions.querySelector('.deleteBtn').addEventListener('click', (e) => {
  e.stopPropagation();
  actions.querySelector('.optionsMenu').classList.add('hidden');

 openConfirmModal(card, name);
});



    return card;
  }

  // Form Submission
  addCategoryForm.addEventListener('submit', async (e) => {
    e.preventDefault();
    const name = document.getElementById('categoryName').value.trim();
    const type = document.getElementById('categoryType').value;
    if (!name) return;

    const isEdit = editMode && editingCard;
    const data = { name, type, icon: selectedIcon || 'category' };
    
    if (isEdit) {
      data.id = editingCard.dataset.categoryId;
    }

    const saved = await saveCategory(data, isEdit);
    if (saved) {
      await loadCategories();
      closeModal();
    }
  });

  // Ensure options handlers apply to new cards
  setTimeout(() => {
    if (typeof attachOptionsHandlers === 'function') attachOptionsHandlers(document);
  }, 50);

  // Load username and account balance
  async function loadUserInfo() {
    try {
      // Load username
      const userResponse = await fetch('../api/users.php', {
        method: 'GET',
        headers: { 'Content-Type': 'application/json' },
        credentials: 'include'
      });
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
      if (accountsResponse.ok) {
        const accountsResult = await accountsResponse.json();
        if (accountsResult.success && accountsResult.data) {
          const totalBalance = accountsResult.data.reduce((sum, acc) => sum + (parseFloat(acc.value) || 0), 0);
          const balanceEl = document.getElementById('allAccountsBalance');
          if (balanceEl) balanceEl.textContent = `₱ ${totalBalance.toLocaleString(undefined, {minimumFractionDigits: 2, maximumFractionDigits: 2})}`;
        }
      }
    } catch (error) {
      console.error('Error loading user info:', error);
    }
  }

  // Load categories from API on page load
  // Load transaction totals
  async function loadTransactionTotals() {
    try {
      const response = await fetch('../api/transactions.php', {
        method: 'GET',
        headers: { 'Content-Type': 'application/json' },
        credentials: 'include'
      });
      const result = await response.json();
      
      if (result.success && result.data) {
        let totalExpenses = 0;
        let totalIncome = 0;
        
        Object.values(result.data).forEach(dateGroup => {
          if (Array.isArray(dateGroup)) {
            dateGroup.forEach(tx => {
              if (tx.type === 'Expense') {
                totalExpenses += parseFloat(tx.value || 0);
              } else if (tx.type === 'Income') {
                totalIncome += parseFloat(tx.value || 0);
              }
            });
          }
        });
        
        const expensesEl = document.getElementById('totalExpenses');
        const incomeEl = document.getElementById('totalIncome');
        
        if (expensesEl) {
          expensesEl.textContent = `₱ ${totalExpenses.toLocaleString(undefined, { minimumFractionDigits: 2, maximumFractionDigits: 2 })}`;
        }
        if (incomeEl) {
          incomeEl.textContent = `₱ ${totalIncome.toLocaleString(undefined, { minimumFractionDigits: 2, maximumFractionDigits: 2 })}`;
        }
      }
    } catch (error) {
      console.error('Error loading transaction totals:', error);
    }
  }

  window.addEventListener('DOMContentLoaded', () => {
    loadUserInfo();
    loadCategories();
    loadTransactionTotals();
  });
</script>


</body>
</html>
