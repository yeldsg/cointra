<?php if (session_status() === PHP_SESSION_NONE) { session_start(); } if (empty($_SESSION['user_id'])) { header('Location: ./login.php'); exit; } ?>
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
<body class = "min-h-screen flex overflow-y-auto">
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

<!--Start of main content-->
<main class="flex-1 ml-16 transition-all duration-300 ease-in-out p-6">
<!--Main Content Gridding Set-Up-->
<div class="grid gap-4 grid-cols-1 xl:grid-cols-2">
<!--Welcome message & Date System-->
<div class="welcomeUser bg-gradient-to-r from-lime-500 to-gray-700 rounded-xl shadow-xl p-6 flex flex-col sm:flex-row items-center justify-between">
<div>
        <h1 id="welcomeUsername" class="text-xl font-bold text-white">Hello User!</h1>
<p class="text-gray-100 text-sm mt-1">Welcome back to your dashboard.</p>
</div>
<!-- Date System (Fixed spacing, responsive layout) -->
<div class="flex flex-col items-center sm:items-end justify-center w-full mt-4 sm:mt-0 gap-2">

  <!-- Top: Date Display + Navigation Buttons -->
  <div class="flex flex-wrap justify-center sm:justify-end w-full">
    <div class="flex items-center justify-center sm:justify-end flex-nowrap gap-2 bg-lime-40 p-2 rounded-lg shadow-inner w-auto mx-auto">
      <!--Previous date button-->
      <button
        class="prevBtn bg-lime-500 text-white rounded-xl hover:bg-white font-bold py-2 px-2
               transition-all duration-300 hover:text-lime-500 border-[2px]"
      >
        <span class="material-symbols-rounded">chevron_left</span>
      </button>

      <!--Date Text-->
      <div
        class="dateDisplay text-white font-semibold text-base sm:text-lg min-w-[120px] sm:min-w-[150px]
               text-center select-none transition-all duration ease-in-out"
      ></div>

      <!--Next Date Button-->
      <button
        class="nextBtn bg-lime-500 text-white rounded-xl hover:bg-white font-bold py-2 px-2
               transition-all duration-300 hover:text-lime-500 border-[2px]"
      >
        <span class="material-symbols-rounded">chevron_right</span>
      </button>
    </div>
  </div>

  <!-- Bottom: Date Type Selector -->
<div class="flex justify-center w-full">
  <select
    class="dateType bg-lime-500 text-white rounded-xl hover:bg-white font-bold py-2 px-2
               transition-all duration-300 hover:text-lime-500 border-[2px] cursor-pointer focus:outline-none focus:ring-2 focus:ring-lime-500
           text-sm sm:text-base mx-auto block"
  >
    <option value="daily" selected>Daily</option>
    <option value="weekly">Weekly</option>
    <option value="monthly">Monthly</option>
  </select>
</div>
</div>

</div>
<!--Total Balance Chart-->
<div class="bg-white rounded-xl shadow-xl p-4">
    <h5 class="text-lg font-bold text-gray-800 mb-3">Expenses Statistics</h5>
    <p class="expenseStats text-md font-bold text-gray-800 mb-3">Total Amount: ₱0.00</p>
    <div class="relative w-full aspect-[2/1] sm:aspect-[3/1] lg:aspect-[4/1]">
        <canvas class = "balanceChart"></canvas>
    </div>
</div>

</div>
<!--Expenses Container-->
<div class="grid gap-4 mt-10 grid-cols-1 xl:grid-cols-3">
<div class="bg-white rounded-xl border-lime-300 shadow-lg shadow-lime-200/50 p-4">
  <h1 class="text-lg font-bold text-gray-800 mb-3">Expenses</h1>
  <h6 class="expenseTtl text-lg font-bold text-gray-800 mb-3">₱0.00</h6>
</div>
<!--Income Container-->
<div class="bg-white rounded-xl border-lime-300 shadow-lg shadow-lime-200/50 p-4">
  <h1 class="text-lg font-bold text-gray-800 mb-3">Income</h1>
  <h6 class="incomeTtl text-lg font-bold text-gray-800 mb-3">₱0.00</h6>
</div>
<!--Total Container-->
<div class="bg-white rounded-xl border-lime-300 shadow-lg shadow-lime-200/50 p-4">
  <h1 class="text-lg font-bold text-gray-800 mb-3">Total</h1>
  <h6 class="ovrlTtl text-lg font-bold text-gray-800 mb-3">₱0.00</h6>
</div>
</div>
<!--Start of Overview Container-->
<div class="flex-1 p-6 overflow-y-auto"> 
<!--Overview gridding set-up-->
<div class="grid gap-4 mt-10 grid-cols-1">
<div class="bg-white rounded-xl shadow-lg shadow-lime-200/50 p-4">
<h1 class="text-center text-xl font-bold text-gray-800 mb-3">Overview</h1>
</div>
</div>
<!--Donut, Progress Chart Container and Income vs. Expense Charts(grid set-up)-->
<div class="grid gap-4 mt-10 grid-cols-1">
<!--Container Set-up for Charts-->  
<div class = "bg-white rounded-xl border-lime-300 shadow-lg shadow-lime-200/50 p-4 w-full sm:aspect-[2/1] lg:aspect-[4/1]">
<!--Label for Donut Chart-->  
  <h2 class="text-lg font-bold mb-3">Expenses Breakdown</h2>
<!--Container and calling out of charts from their respective script-->  
<div class="relative w-full h-[250px]">
<canvas class = "donutChart"></canvas>
</div>
</div>

<div class = "bg-white rounded-xl border-lime-300 shadow-lg shadow-lime-200/50 p-4 w-full sm:aspect-[2/1] lg:aspect-[4/1]">
<h2 class="text-lg font-bold mb-3">Expense Progress</h2>
<div class="relative w-full h-[250px]">
<canvas class = "progressChart"></canvas>
</div>
</div>

<div class="relative bg-white rounded-xl border-lime-300 shadow-lg shadow-lime-200/50 p-4 w-full sm:aspect-[2/1] lg:aspect-[4/1]">
<h2 class="text-lg font-bold mb-3">Income vs Expense</h2>
<div class="relative w-full h-[250px]">
<canvas class="incomeExpenseChart"></canvas>
</div>
</div>
</div>
</div>
</main>

<script>
var menuToggle = document.querySelector(".menuToggle");
var sideBar = document.querySelector(".sideBar");
var txtLabels = document.querySelectorAll(".sideBar-text");
var dropdownIcon = document.querySelector(".dropdownIcon");
var dashdropDown = document.querySelector(".dashdropDown");
var dashBtn = document.querySelector(".dashBtn");
var main = document.querySelector("main");

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

var dateDisplay = document.querySelector(".dateDisplay");
var prevBtn = document.querySelector(".prevBtn");
var nextBtn = document.querySelector(".nextBtn");
var dateTypeSelect = document.querySelector(".dateType");

var currentDate = new Date();
var monthNames = [
  "January", "February", "March", "April", "May", "June",
  "July", "August", "September", "October", "November", "December"
];

function getWeekRange(date) {
  var start = new Date(date);
  var day = start.getDay();
  var diff = start.getDate() - day + (day === 0 ? -6 : 1);
  start.setDate(diff);
  var end = new Date(start);
  end.setDate(start.getDate() + 6);
  return { start: start, end: end };
}

function updateDateDisplay(animated) {
  if (animated === undefined) {
    animated = true;
  }
  var type = dateTypeSelect.value;
  var displayText = "";

  if (type === "daily") {
    var day = currentDate.getDate();
    var month = monthNames[currentDate.getMonth()];
    var year = currentDate.getFullYear();
    displayText = month + " " + day + ", " + year;
  } else if (type === "weekly") {
    var weekRange = getWeekRange(currentDate);
    var start = weekRange.start;
    var end = weekRange.end;
    var startMonth = monthNames[start.getMonth()];
    var endMonth = monthNames[end.getMonth()];
    var startDay = start.getDate();
    var endDay = end.getDate();
    var year = currentDate.getFullYear();

    if (startMonth === endMonth) {
      displayText = startMonth + " " + startDay + "–" + endDay + ", " + year;
    } else {
      displayText = startMonth + " " + startDay + " – " + endMonth + " " + endDay + ", " + year;
    }
  } else if (type === "monthly") {
    var month = monthNames[currentDate.getMonth()];
    var year = currentDate.getFullYear();
    displayText = month + " " + year;
  }

  if (!animated) {
    dateDisplay.textContent = displayText;
    return;
  }

  dateDisplay.classList.add("opacity-0", "translate-y-1");
  setTimeout(function() {
    dateDisplay.textContent = displayText;
    dateDisplay.classList.remove("translate-y-1", "opacity-0");
  }, 200);
}

function changeDate(direction) {
  var type = dateTypeSelect.value;

  if (type === "daily") {
    currentDate.setDate(currentDate.getDate() + direction);
  } else if (type === "weekly") {
    currentDate.setDate(currentDate.getDate() + 7 * direction);
  } else if (type === "monthly") {
    currentDate.setMonth(currentDate.getMonth() + direction);
  }

  updateDateDisplay(true);
  updateChartsForDate();
  updateExpenseDisplay();
}

prevBtn.addEventListener("click", function() {
    changeDate(-1);
});
nextBtn.addEventListener("click", function() {
    changeDate(1);
});
dateTypeSelect.addEventListener("change", function() {
    updateDateDisplay(false);
    updateChartsForDate();
    updateExpenseDisplay();
});

// Initialize display
updateDateDisplay(false);

//Charts Configuration
Chart.defaults.color = "#4b5563";
Chart.defaults.font.size = 14;
Chart.defaults.font.weight = "bold";
Chart.defaults.font.family = "Inter, sans-serif";
Chart.defaults.maintainAspectRatio = false;

var balanceChartInstance = null;
var donutChartInstance = null;
var progressChartInstance = null;
var incomeExpenseChartInstance = null;

var allTransactions = [];

// Initialize charts
function initCharts() {
  //Balance Stats. Chart
  balanceChartInstance = new Chart(document.querySelector(".balanceChart"), {
  type: "bar",
  data: {
      labels: [],
    datasets: [{
        label: "Expenses",
        data: [],
      borderColor: "#84cc16",
      backgroundColor: "#84cc16",
      borderRadius: 12,
      tension: 0.4,
      fill: true,
      pointRadius: 4,
      pointBackgroundColor: "#84cc16"
    }]
  },
  options: {
    responsive: true,
    scales: { y: { beginAtZero: true } },
    plugins: { legend: { display: false } }
  }
});

//Doughnut Chart
  donutChartInstance = new Chart(document.querySelector(".donutChart"), {
  type: "doughnut",
  data: {
      labels: [],
    datasets: [{
        label: "Expenses",
        data: [],
      borderColor: "#84cc16",
        backgroundColor: [
          "#84cc16", "#a3e635", "#bef264", "#d9f99d", "#ecfccb",
          "#fef08a", "#fde047", "#facc15", "#eab308", "#ca8a04"
        ],
      borderRadius: 3
    }]
  },
options: {
responsive: true,
      plugins: { 
        legend: {
          position: "right"
        }
      }
}
});
//Progress Chart Customization
  progressChartInstance = new Chart(document.querySelector(".progressChart"), {
  type: "bar",
  data: {
    labels: [],
      datasets: [{
        label: "Amount",
        data: [],
      borderColor: "#84cc16",
        backgroundColor: "#84cc16",
      borderRadius: 12,
      borderWidth: 1,
      barPercentage: 0.25,
      categoryPercentage: 2,
      tension: 0.4,
      fill: true,
      pointRadius: 4,
      pointBackgroundColor: "#84cc16"
    }]
  },
  options: {
    responsive: true,
     indexAxis: "y",
    scales: {
        x: { 
          beginAtZero: true,
          grid: { display: false, drawBorder: false }
        },
        y: { 
          beginAtZero: true,
          grid: { display: false, drawBorder: false }
        }
      },
      plugins: { legend: { position: "right" } }
  }
});

//Income vs. Expense Chart Config.
  incomeExpenseChartInstance = new Chart(document.querySelector(".incomeExpenseChart"), {
  type: "bar",
  data: {
      labels: [],
    datasets: [
      {
        label: "Income",
          data: [],
        backgroundColor: "#84cc16",
        borderRadius: 6
      },
      {
        label: "Expense",
          data: [],
        backgroundColor: "#d9f99d",
        borderRadius: 6
      }
    ]
  },
  options: {
    responsive: true,
    scales: { y: { beginAtZero: true } },
    plugins: { legend: { position: "bottom" } }
  }
});
}

// Initialize charts on page load
initCharts();

var ExpsTtl = 0;
var IncmTtl = 0;
var TotalTtl = 0;
var expsStats = 0;

function loadExpenseData() {
  var xhr = new XMLHttpRequest();
  xhr.open('GET', '../api/transactions.php', true);
  xhr.setRequestHeader('Content-Type', 'application/json');
  xhr.withCredentials = true;
  
  xhr.onreadystatechange = function() {
    if (xhr.readyState === 4 && xhr.status === 200) {
      try {
        var result = JSON.parse(xhr.responseText);
        
        if (result.success && result.data) {
          allTransactions = [];
          for (var dateKey in result.data) {
            if (result.data.hasOwnProperty(dateKey)) {
              var dateGroup = result.data[dateKey];
              if (Array.isArray(dateGroup)) {
                for (var i = 0; i < dateGroup.length; i++) {
                  var tx = dateGroup[i];
                  var newTx = {};
                  for (var key in tx) {
                    if (tx.hasOwnProperty(key)) {
                      newTx[key] = tx[key];
                    }
                  }
                  newTx.date = dateKey;
                  newTx.amount = tx.value || tx.amount || 0;
                  allTransactions.push(newTx);
                }
              }
            }
          }
          
          updateChartsForDate();
          updateExpenseDisplay();
        }
      } catch (error) {
        console.error('Error loading expense data:', error);
      }
    }
  };
  
  xhr.send();
}

function getTransactionsForPeriod() {
  var type = dateTypeSelect.value;
  var filtered = [];
  
  for (var i = 0; i < allTransactions.length; i++) {
    var tx = allTransactions[i];
    var txDate = new Date(tx.date + 'T00:00:00');
    var include = false;
    
    if (type === 'daily') {
      include = txDate.toDateString() === currentDate.toDateString();
    } else if (type === 'weekly') {
      var weekRange = getWeekRange(currentDate);
      var start = weekRange.start;
      var end = weekRange.end;
      include = txDate >= start && txDate <= end;
    } else if (type === 'monthly') {
      include = txDate.getMonth() === currentDate.getMonth() && 
                txDate.getFullYear() === currentDate.getFullYear();
    }
    
    if (include && tx.type === 'Expense') {
      filtered.push(tx);
    }
  }
  
  return filtered;
}

function generateDateLabels() {
  var type = dateTypeSelect.value;
  var labels = [];
  
  if (type === 'daily') {
    labels.push(currentDate.toLocaleDateString('en-US', { month: 'short', day: 'numeric' }));
  } else if (type === 'weekly') {
    var weekRange = getWeekRange(currentDate);
    var start = weekRange.start;
    var end = weekRange.end;
    for (var d = new Date(start); d <= end; d.setDate(d.getDate() + 1)) {
      labels.push(d.toLocaleDateString('en-US', { month: 'short', day: 'numeric' }));
    }
  } else if (type === 'monthly') {
    var year = currentDate.getFullYear();
    var month = currentDate.getMonth();
    var daysInMonth = new Date(year, month + 1, 0).getDate();
    for (var day = 1; day <= daysInMonth; day++) {
      labels.push(day.toString());
    }
  }
  
  return labels;
}

function updateChartsForDate() {
  var transactions = getTransactionsForPeriod();
  var type = dateTypeSelect.value;
  
  var labels = generateDateLabels();
  var balanceData = [];
  for (var i = 0; i < labels.length; i++) {
    var label = labels[i];
    var sum = 0;
    
    if (type === 'daily') {
      for (var j = 0; j < transactions.length; j++) {
        sum += parseFloat(transactions[j].amount) || 0;
      }
    } else if (type === 'weekly') {
      var dateIndex = labels.indexOf(label);
      var weekRange = getWeekRange(currentDate);
      var start = weekRange.start;
      var checkDate = new Date(start);
      checkDate.setDate(start.getDate() + dateIndex);
      for (var j = 0; j < transactions.length; j++) {
        var tx = transactions[j];
        var txDate = new Date(tx.date + 'T00:00:00');
        if (txDate.toDateString() === checkDate.toDateString()) {
          sum += parseFloat(tx.amount) || 0;
        }
      }
    } else {
      var day = parseInt(label);
      for (var j = 0; j < transactions.length; j++) {
        var tx = transactions[j];
        var txDate = new Date(tx.date + 'T00:00:00');
        if (txDate.getDate() === day) {
          sum += parseFloat(tx.amount) || 0;
        }
      }
    }
    balanceData.push(sum);
  }
  
  if (balanceChartInstance) {
    balanceChartInstance.data.labels = labels;
    balanceChartInstance.data.datasets[0].data = balanceData;
    balanceChartInstance.update();
  }
  
  var categoryMap = {};
  for (var i = 0; i < transactions.length; i++) {
    var tx = transactions[i];
    var cat = tx.category || 'Uncategorized';
    categoryMap[cat] = (categoryMap[cat] || 0) + (parseFloat(tx.amount) || 0);
  }
  
  var donutLabels = [];
  var donutData = [];
  for (var key in categoryMap) {
    if (categoryMap.hasOwnProperty(key)) {
      donutLabels.push(key);
      donutData.push(categoryMap[key]);
    }
  }
  
  if (donutChartInstance) {
    donutChartInstance.data.labels = donutLabels.length ? donutLabels : ['No expenses'];
    donutChartInstance.data.datasets[0].data = donutData.length ? donutData : [0];
    donutChartInstance.update();
  }
  
  var sortedCategories = [];
  for (var key in categoryMap) {
    if (categoryMap.hasOwnProperty(key)) {
      sortedCategories.push([key, categoryMap[key]]);
    }
  }
  for (var i = 0; i < sortedCategories.length - 1; i++) {
    for (var j = i + 1; j < sortedCategories.length; j++) {
      if (sortedCategories[j][1] > sortedCategories[i][1]) {
        var temp = sortedCategories[i];
        sortedCategories[i] = sortedCategories[j];
        sortedCategories[j] = temp;
      }
    }
  }
  sortedCategories = sortedCategories.slice(0, 5);
  
  if (progressChartInstance) {
    var progressLabels = [];
    var progressData = [];
    for (var i = 0; i < sortedCategories.length; i++) {
      progressLabels.push(sortedCategories[i][0]);
      progressData.push(sortedCategories[i][1]);
    }
    progressChartInstance.data.labels = progressLabels;
    progressChartInstance.data.datasets[0].data = progressData;
    progressChartInstance.update();
  }
  
  var incomeTransactions = [];
  for (var i = 0; i < allTransactions.length; i++) {
    var tx = allTransactions[i];
    var txDate = new Date(tx.date + 'T00:00:00');
    var include = false;
    
    if (type === 'daily') {
      include = txDate.toDateString() === currentDate.toDateString();
    } else if (type === 'weekly') {
      var weekRange = getWeekRange(currentDate);
      var start = weekRange.start;
      var end = weekRange.end;
      include = txDate >= start && txDate <= end;
    } else if (type === 'monthly') {
      include = txDate.getMonth() === currentDate.getMonth() && 
                txDate.getFullYear() === currentDate.getFullYear();
    }
    
    if (include) {
      incomeTransactions.push(tx);
    }
  }
  
  var incomeData = [];
  for (var i = 0; i < labels.length; i++) {
    var label = labels[i];
    var sum = 0;
    
    if (type === 'daily') {
      for (var j = 0; j < incomeTransactions.length; j++) {
        if (incomeTransactions[j].type === 'Income') {
          sum += parseFloat(incomeTransactions[j].amount) || 0;
        }
      }
    } else if (type === 'weekly') {
      var dateIndex = labels.indexOf(label);
      var weekRange = getWeekRange(currentDate);
      var start = weekRange.start;
      var checkDate = new Date(start);
      checkDate.setDate(start.getDate() + dateIndex);
      for (var j = 0; j < incomeTransactions.length; j++) {
        var tx = incomeTransactions[j];
        if (tx.type === 'Income') {
          var txDate = new Date(tx.date + 'T00:00:00');
          if (txDate.toDateString() === checkDate.toDateString()) {
            sum += parseFloat(tx.amount) || 0;
          }
        }
      }
    } else {
      var day = parseInt(label);
      for (var j = 0; j < incomeTransactions.length; j++) {
        var tx = incomeTransactions[j];
        if (tx.type === 'Income') {
          var txDate = new Date(tx.date + 'T00:00:00');
          if (txDate.getDate() === day) {
            sum += parseFloat(tx.amount) || 0;
          }
        }
      }
    }
    incomeData.push(sum);
  }
  
  var expenseData = [];
  for (var i = 0; i < labels.length; i++) {
    var label = labels[i];
    var sum = 0;
    
    if (type === 'daily') {
      for (var j = 0; j < transactions.length; j++) {
        sum += parseFloat(transactions[j].amount) || 0;
      }
    } else if (type === 'weekly') {
      var dateIndex = labels.indexOf(label);
      var weekRange = getWeekRange(currentDate);
      var start = weekRange.start;
      var checkDate = new Date(start);
      checkDate.setDate(start.getDate() + dateIndex);
      for (var j = 0; j < transactions.length; j++) {
        var tx = transactions[j];
        var txDate = new Date(tx.date + 'T00:00:00');
        if (txDate.toDateString() === checkDate.toDateString()) {
          sum += parseFloat(tx.amount) || 0;
        }
      }
    } else {
      var day = parseInt(label);
      for (var j = 0; j < transactions.length; j++) {
        var tx = transactions[j];
        var txDate = new Date(tx.date + 'T00:00:00');
        if (txDate.getDate() === day) {
          sum += parseFloat(tx.amount) || 0;
        }
      }
    }
    expenseData.push(sum);
  }
  
  if (incomeExpenseChartInstance) {
    incomeExpenseChartInstance.data.labels = labels;
    incomeExpenseChartInstance.data.datasets[0].data = incomeData;
    incomeExpenseChartInstance.data.datasets[1].data = expenseData;
    incomeExpenseChartInstance.update();
  }
  
  ExpsTtl = 0;
  for (var i = 0; i < transactions.length; i++) {
    ExpsTtl += parseFloat(transactions[i].amount) || 0;
  }
  
  IncmTtl = 0;
  for (var i = 0; i < incomeTransactions.length; i++) {
    if (incomeTransactions[i].type === 'Income') {
      IncmTtl += parseFloat(incomeTransactions[i].amount) || 0;
    }
  }
  
  TotalTtl = IncmTtl - ExpsTtl;
  expsStats = ExpsTtl;
}

function updateExpenseDisplay() {
  var expenseTtlEl = document.querySelector(".expenseTtl");
  var incomeTtlEl = document.querySelector(".incomeTtl");
  var ovrlTtlEl = document.querySelector(".ovrlTtl");
  var expenseStatsEl = document.querySelector(".expenseStats");
  
  if (expenseTtlEl) expenseTtlEl.textContent = "₱" + ExpsTtl.toLocaleString(undefined, {minimumFractionDigits: 2, maximumFractionDigits: 2});
  if (incomeTtlEl) incomeTtlEl.textContent = "₱" + IncmTtl.toLocaleString(undefined, {minimumFractionDigits: 2, maximumFractionDigits: 2});
  if (ovrlTtlEl) ovrlTtlEl.textContent = "₱" + TotalTtl.toLocaleString(undefined, {minimumFractionDigits: 2, maximumFractionDigits: 2});
  if (expenseStatsEl) expenseStatsEl.textContent = "Total Amount: ₱" + expsStats.toLocaleString(undefined, {minimumFractionDigits: 2, maximumFractionDigits: 2});
}

function emptyData(labels) {
  var result = [];
  for (var i = 0; i < labels.length; i++) {
    result.push(0);
  }
  return result;
}

function loadUserInfo() {
  var xhr = new XMLHttpRequest();
  xhr.open('GET', '../api/users.php', true);
  xhr.setRequestHeader('Content-Type', 'application/json');
  xhr.withCredentials = true;
  
  xhr.onreadystatechange = function() {
    if (xhr.readyState === 4 && xhr.status === 200) {
      try {
        var userResult = JSON.parse(xhr.responseText);
        if (userResult.success && userResult.data) {
          var username = userResult.data.username || 'User';
          var welcomeEl = document.getElementById('welcomeUsername');
          if (welcomeEl) welcomeEl.textContent = "Hello " + username + "!";
        }
      } catch (error) {
        console.error('Error loading user info:', error);
      }
    }
  };
  
  xhr.send();
  
  var accountsXhr = new XMLHttpRequest();
  accountsXhr.open('GET', '../api/accounts.php', true);
  accountsXhr.setRequestHeader('Content-Type', 'application/json');
  accountsXhr.withCredentials = true;
  
  accountsXhr.onreadystatechange = function() {
    if (accountsXhr.readyState === 4 && accountsXhr.status === 200) {
      try {
        var accountsResult = JSON.parse(accountsXhr.responseText);
        if (accountsResult.success && accountsResult.data) {
          var totalBalance = 0;
          for (var i = 0; i < accountsResult.data.length; i++) {
            totalBalance += parseFloat(accountsResult.data[i].value) || 0;
          }
          var balanceEl = document.querySelector('.ovrlTtl');
          if (balanceEl) balanceEl.textContent = "₱" + totalBalance.toLocaleString(undefined, {minimumFractionDigits: 2, maximumFractionDigits: 2});
        }
      } catch (error) {
        console.error('Error loading accounts:', error);
      }
    }
  };
  
  accountsXhr.send();
}

window.addEventListener('DOMContentLoaded', function() {
  loadUserInfo();
  loadExpenseData();
});
</script>

</body>
</html>
