<!--Landing Page-->
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.5.0/css/all.min.css" crossorigin="anonymous" referrerpolicy="no-referrer">
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@24,400,0,0"/>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Prociono&display=swap" rel="stylesheet">
<?php include __DIR__ . '/head-meta.php'; ?>
<title>Cointra</title>
<style>
  * {
    font-family: "Prociono";
    letter-spacing: 1.2px;
  }

  @keyframes slideDown {
    from {
      opacity: 0;
      transform: translateY(-10px);
    }
    to {
      opacity: 1;
      transform: translateY(0);
    }
  }

  @keyframes slideUp {
    from {
      opacity: 1;
      transform: translateY(0);
    }
    to {
      opacity: 0;
      transform: translateY(-10px);
    }
  }

  .dropdown-enter {
    animation: slideDown 0.25s ease-out forwards;
  }

  .dropdown-exit {
    animation: slideUp 0.25s ease-in forwards;
  }

  .material-symbols-rounded.md-48 {
    font-size: 48px;
  }

  .modal-show {
    display: flex !important;
    animation: fadeIn 0.3s ease-out forwards;
  }

  @keyframes fadeIn {
    from {
      opacity: 0;
      transform: scale(0.95);
    }
    to {
      opacity: 1;
      transform: scale(1);
    }
  }

  @keyframes fadeOut {
    from {
      opacity: 1;
      transform: scale(1);
    }
    to {
      opacity: 0;
      transform: scale(0.95);
    }
  }
</style>
</head>

<body class="bg-gradient-to-b from-green-200 via-white to-green-500 to-white text-green-900">
<header class="relative w-full flex flex-wrap items-center justify-between py-4 md:px-12 border-b border-green-300 bg-gradient-to-br from-white via-lime-50/60 to-lime-100/40">
  <!-- Left Section: Logo + Title -->
  <div class="flex items-center">
    <img src="../assets/cointra-logo.png" alt="Cointra Logo" class="h-12 w-auto md:h-18 select-none">
    <h1 class="text-3xl font-semibold ml-2">Coint<span class="text-green-500">r</span>a</h1>
  </div>

  <!-- Center Nav (hidden on mobile & tablet) -->
  <nav class="hidden lg:flex items-center gap-8 text-green-700">
    <a href="#features" class="text-md font-semibold">Features</a>
    <a href="#whyUs" class="text-md font-semibold">Why Us?</a>
  </nav>

  <!-- Mobile Dropdown Menu (hidden by default) -->
  <nav
    id="mobile-menu"
    class="hidden absolute right-4 top-[70px] w-40 bg-white border border-green-300 rounded-lg shadow-lg flex flex-col text-green-700 z-50"
  >
    <a href="#features" class="px-4 py-2 hover:bg-green-100 transition text-center">Features</a>
    <a href="#whyUs" class="px-4 py-2 hover:bg-green-100 transition text-center">Why Us?</a>
  </nav>

  <!-- Hamburger (shows on mobile & tablet) -->
  <button id="menu-trigger" class="lg:hidden border border-green-600 px-3 py-1 rounded-lg relative z-50">
    <span class="material-symbols-rounded">menu</span>
  </button>

  <!-- Buttons: right on desktop, under logo on mobile -->
  <div class="w-full lg:w-auto flex flex-col sm:flex-row w-[10px] lg:flex-row gap-3 mt-4 lg:mt-0 lg:ml-6 lg:justify-end">
    <a href="./sign-up.php">
      <button class="border border-green-600 px-4 py-2 hover:bg-green-400 font-bold rounded-lg transition-all duration-300 hover:text-white">
      Sign Up
    </button>
    </a>
    <a href="./login.php">
        <button class="border border-green-600 px-4 py-2 hover:bg-green-400 font-bold rounded-lg transition-all duration-300 hover:text-white">
      Log In
    </button>
    </a>
</header>

<!-- Hero Section -->
<section class="text-center mt-16 mb-16 bg-gradient-to-br from-white via-lime-50/60 to-lime-100/40 py-12 px-6 rounded-2xl mx-4 md:mx-8">
  <h2 class="text-4xl font-bold">Cointra:<br>Equality in your Equity</h2>
  <p class="mt-4 text-green-400 max-w-lg mx-auto">
    Amidst your financial struggles, Cointra will provide to you all that you require in your equity-clad escapades.
  </p>
</section>

<!-- Feature Cards -->
<section id="features" class="overflow-x-auto px-8 pb-20">
  <div class="flex space-x-6 max-w-full w-max">
    <div class="border border-green-300 rounded-xl p-6 bg-yellow-50 hover:shadow-lg transition flex flex-col items-center justify-center text-center min-w-[250px]">
      <span class="material-symbols-rounded text-5xl text-green-600 mb-4 md-48">database</span>
      <h3 class="font-semibold text-lg mb-2 leading-tight">Personal<br>Savings</h3>
      <p class="text-sm text-green-700 max-w-xs">Keep track of what’s going in and what’s coming out.</p>
    </div>

    <div class="border border-green-300 rounded-xl p-6 bg-yellow-50 hover:shadow-lg transition flex flex-col items-center justify-center text-center min-w-[250px]">
      <span class="material-symbols-rounded text-5xl text-green-600 mb-4 md-48">wallet</span>
      <h3 class="font-semibold text-lg mb-2 leading-tight">Money<br>Budgeting</h3>
      <p class="text-sm text-green-700 max-w-xs">Ensures you keep a fine track of your boundaries within your personal savings and what you desire to spend it on.</p>
    </div>

    <div class="border border-green-300 rounded-xl p-6 bg-yellow-50 hover:shadow-lg transition flex flex-col items-center justify-center text-center min-w-[250px]">
      <span class="material-symbols-rounded text-5xl text-green-600 mb-4 md-48">forum</span>
      <h3 class="font-semibold text-lg mb-2 leading-tight">Community<br>Forum</h3>
      <p class="text-sm text-green-700 max-w-xs">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
    </div>

    <div class="border border-green-300 rounded-xl p-6 bg-yellow-50 hover:shadow-lg transition flex flex-col items-center justify-center text-center min-w-[250px]">
      <span class="material-symbols-rounded text-5xl text-green-600 mb-4 md-48">pie_chart</span>
      <h3 class="font-semibold text-lg mb-2 leading-tight">Monthly<br>Analysis</h3>
      <p class="text-sm text-green-700 max-w-xs">Keep track of your spendings and savings with our trusty logs.</p>
    </div>
  </div>
</section>

<!-- Budget Section -->
<section class="flex flex-col md:flex-row items-stretch w-full">
  <!-- Left Text Section -->
  <div class="flex-1 bg-green-200 flex flex-col justify-center p-10 md:p-16 space-y-4">
    <div class="w-10 h-2 rounded-full bg-yellow-500"></div>
    <p class="text-green-900 text-lg leading-relaxed">
      Budget smarter, not harder.<br>
      Organize your money easily,<br>
      without using pen and paper.
    </p>
  </div>

  <!-- Right Image Section -->
  <div class="flex-1 flex">
    <img src="../assets/business-woman-hand-holding-coins-stack-desk-concept-saving-money-finance-accounting_34152-1519.jpg"
  alt="Budget smarter"
  class="w-full h-full object-cover select-none"
/>

  </div>
</section>

<!-- Info Grid Section -->
<section class="bg-gradient-to-b from-green-100 to-white py-20 px-6 md:px-20 space-y-24">

  <!-- First Row -->
  <div class="space-y-8">
    <span class="inline-block bg-yellow-200 text-green-900 text-sm font-semibold px-4 py-1.5 rounded-full">
      Budget Better
    </span>

    <div class="grid md:grid-cols-2 gap-10 items-start">
      <!-- Left Column -->
      <div class="space-y-6 text-center md:text-left">
        <h3 class="text-2xl md:text-3xl font-semibold text-green-900 leading-snug">
          Cointra provides suitable quality<br>
          of life options for your financial excursions!
        </h3>
        <img src="../assets/istockphoto-168533973-612x612.jpg" alt="" class="w-full aspect-[3/3] rounded-xl mx-auto md:mx-0">
      </div>

      <!-- Right Column -->
      <div class="space-y-6 text-center  mt-[5px] md:text-left">
        <p class="text-base text-green-800">
          Giving suggestions in which works best whether what comes in and out of your budget.
        </p>
        <img src="../assets/istockphoto-1406601888-612x612.jpg" alt="" class="w-full aspect-[16/9] rounded-xl mx-auto md:mx-0">
        <img src="../assets/istockphoto-638120502-612x612.jpg" alt="" class="w-full aspect-[16/9] rounded-xl mx-auto md:mx-0">
      </div>
    </div>
  </div>


</section>

<!-- Growth Section-->
<section class="relative w-full bg-gradient-to-b from-green-50 to-green-100 overflow-hidden">
  
  <!-- Text Overlay -->
<h1 class="text-3xl md:text-4xl font-semibold leading-tight">
Smart Finances.<br>
For Your Smarter Future.
</h1> 
  <!-- Background Image -->
  <div class="relative w-full h-[400px] md:h-[500px]">
    <img 
      src="../assets/StockCake-Teamwork_in_office_1762825765.jpg" 
      alt="Team collaboration" 
      class="w-full h-full object-cover rounded-md"
    />

    <!-- Floating Info Card -->
    <div class="absolute bottom-[-60px] left-6 md:left-20 bg-yellow-100 shadow-lg p-6 w-[90%] md:w-[350px]"> 
      <h2 id="whyUs" class="font-semibold text-lg text-green-900 mb-2">Why We Do This</h2>
      <p class="text-sm text-green-800 mb-4 leading-relaxed">
        Our goal with Cointra is to help those who face hurdles financially by ensuring that their budgeting is easier, smarter, and more powerful.
        Finances are deeply important.
      </p>
    </div>
  </div>

  <!-- Supporting Text Row -->
  <div class="flex flex-col md:flex-row justify-between items-start md:items-center mt-28 md:mt-32 px-6 md:px-20 space-y-8 md:space-y-0">
    <div class="max-w-xl">
      <h2 class="text-2xl md:text-3xl font-semibold text-green-900 leading-snug">
        Helping You<br>Grow With Every Step.
      </h2>
      <p class="text-green-800 mt-3 text-base leading-relaxed">
        As technology advances, so does the design we use. We strive to better the financial future of entrepreneurs and ourselves.
      </p>
    </div>
  </div>

 <!-- Footer -->
<footer class="bg-green-900 text-green-100 mt-20 py-10 px-8 md:px-20">
  <div class="grid grid-cols-1 md:grid-cols-3 gap-10">
    <!-- Left Column -->
    <div>
      <img src="../assets/cointra-logo.png" alt="Cointra Logo" class="h-10 w-auto mb-3 select-none">
      <p class="text-sm font-semibold uppercase tracking-wide">Contact us</p>
      <p class="text-sm text-green-200 mb-2">LET’S DISCUSS YOUR VISION WITH US</p>
      <a href="mailto:officialcointra8888@gmail.com" class="inline-flex items-center gap-2 bg-lime-400 text-white px-4 py-2 rounded-full text-sm hover:bg-green-400 transition">
        <span class="material-symbols-rounded text-base">mail</span>
        officialcointra8888@gmail.com
      </a>
      <p class="text-xs text-green-200 mt-3">Phone: 0919 292 876</p>
    </div>

    <!-- Right Section (Quick Links + Information) -->
    <div class="md:col-span-2 flex flex-col md:flex-row md:justify-end md:gap-16 gap-8">
      <!-- Quick Links -->
      <div>
        <h4 class="font-semibold mb-3">Quick Links</h4>
        <ul class="space-y-2 text-sm">
          <li><a href="#" class="hover:text-green-400 transition">Home</a></li>
          <li><a href="#faq" class="hover:text-green-400 transition">FAQs</a></li>
        </ul>
      </div>

      <!-- Information -->
      <div>
        <h4 class="font-semibold mb-3">Information</h4>
        <ul class="space-y-2 text-sm">
          <li><a href="#terms" class="hover:text-green-400 transition">Terms of Service</a></li>
          <li><a href="#privacy" id="privacyCheck" class="hover:text-green-400 transition">Privacy Policy</a></li>
          <li><a href="#cookies" id ="cookiesCheck" class="hover:text-green-400 transition">Cookies</a></li>
        </ul>
      </div>
    </div>
  </div>

  <!-- Social Icons -->
  <div class="border-t border-green-700 mt-10 pt-6 flex justify-end space-x-6 text-xl">
    <a href="https://www.facebook.com/share/1BRFqDTuuB/" target="_blank" rel="noopener noreferrer" class="hover:text-green-400 transition" aria-label="Facebook">
      <i class="fab fa-facebook-f"></i>
    </a>
    <a href="https://www.instagram.com/coin_traofficial?igsh=aW0weWN4aHFrOGQ3" target="_blank" rel="noopener noreferrer" class="hover:text-green-400 transition" aria-label="Instagram">
      <i class="fab fa-instagram"></i>
    </a>
  </div>
</footer>
</section>

<!-- MODALS -->
<!-- Terms of Service Modal -->
<div id="termsModal" class="fixed inset-0 bg-white/70 backdrop-blur-lg rounded-2xl hidden items-center justify-center z-[999] px-4">
  <div class="bg-white rounded-xl max-w-2xl w-full p-6 relative shadow-xl overflow-y-auto max-h-[80vh]">
    <button class="absolute top-3 right-3 text-green-700 hover:text-green-500 text-xl font-bold" id="closeTerms">&times;</button>
    <h2 class="text-2xl font-semibold mb-4 text-green-800">Terms of Service</h2>
    <p class="text-green-700 leading-relaxed text-sm md:text-base space-y-4">
     Last Updated: Nov. 11, 2025 <br><br>
Welcome to Cointra, a finance and budget tracking system with expense categorization for individual users. By accessing or using our website and services, you agree to the following terms:<br><br>
1. Acceptance of Terms<br>
By creating an account or using Cointra, you confirm that you have read, understood, and agreed to these Terms of Service.<br>
<br>
2. Use of Service<br>
Cointra is an academic project created for educational purposes.
Users may log income, expenses, and budget information for personal use only.
You agree not to misuse the system or engage in activities that could disrupt service for others.<br>
<br>
3. User Accounts<br>
You are responsible for safeguarding your account credentials.
Any activity under your account will be considered your responsibility.<br>
<br>
4. Data and Content<br>
You retain ownership of the data you input (income, expenses, categories, goals).
By using the system, you grant Cointra permission to process your data for generating reports, charts, and analysis.<br>
<br>
5. Limitations of Liability<br>
Cointra does not provide professional financial, investment, or legal advice.
We are not liable for any losses or financial decisions made based on the information generated by the system.<br>
<br>
6. Termination<br>
We may suspend or terminate accounts that violate these terms.

    </p>
  </div>
</div>

<!-- FAQs Modal -->
<div id="faqModal" class="fixed inset-0 bg-white/20 backdrop-blur-lg rounded-2xl hidden items-center justify-center z-[999] px-4">
  <div class="bg-white/70 rounded-xl max-w-2xl w-full p-6 relative shadow-xl overflow-y-auto max-h-[80vh]">
    <button class="absolute top-3 right-3 text-green-700 hover:text-green-500 text-xl font-bold" id="closeFAQ">
      <span class="material-symbols-rounded">close</span>
    </button>
    <h2 class="text-2xl font-semibold mb-4 text-green-800">Frequently Asked Questions</h2>
    <div class="text-green-700 justify-center text-sm md:text-base space-y-4">
<p class="text-center">Frequently Asked Questions (FAQs)</p>
About Cointra<br><br>
1. How does Cointra help me? <br>
Cointra provides a service where it helps users track their finances in an effort to promote better financial decisions and encourage financial literacy. <br><br>

2. Practices regarding Security? <br>
Cointra makes sure that your personal information belongs to you and ONLY you. Your privacy is something we value and we take steps to ensure that it's limited to only you. <br><br>

3.  How does Cointra work? <br>

Cointra is a service where budgeting will be more convenient. Simply enter your information regarding where you intend to spend within a timeframe or in general and we’ll help you keep track! <br><br>
    </div>
  </div>
</div>

<!--Privacy Policy-->
<div id="privacyModal" class="hidden fixed inset-0 bg-white/30 backdrop-blur-lg rounded-2xl flex items-center justify-center z-[999] px-4">
  <div class="bg-white/70 rounded-xl max-w-2xl w-full p-6 relative shadow-xl overflow-y-auto max-h-[80vh]">
    <button id="closePrivacy" class="absolute top-3 right-3 text-green-700 hover:text-green-500 text-xl font-bold" id="closePolicy">
      <span class="material-symbols-rounded">close</span>
    </button>
    <h2 class="text-2xl font-semibold mb-4 text-green-800">Privacy Policy</h2>
    <div class="text-green-700 justify-center text-sm md:text-base space-y-4">
This section will help you understand how Cointra uses and protects the data you provide to us whenever you visit and use our services. 
<br><br>
<p class="text-center">What Data We Collect:</p>
-Contact Information <br>
-Name, Email and Everyday expenses <br>
-Other information, obliging to interest and preferences <br> <br>

<p class="text-center">Why do we collect your Data?</p>
We collect data in order to personalize and provide more quality of life updates for our services. Data provided from users is a cornerstone on how we can continue rolling out quality for the betterment of our service.
Cointra’s committed to safeguarding your data and fighting tooth and nail to make sure it’s out of reach for anyone else. We implement the latest technologies and hotfixes, keeping an eye out for more security updates in order to provide for our clients. <br> <br>

<p class="text-center">If at Some Point...</p>
You wish to restrict the data you provide us. It can be done via the following; <br>
If you are signing up for us or filling out forms, make sure to keep an eye out for fields that are optional in order to maximize your anonymity to us. <br>
Cointra will not sell, distribute or leverage your information with third parties unless we have your permission. If you have changed your mind regarding data you have already shared with us. Feel free to reach out with us and we will happily adjust. <br>

</div>
</div>
</div>

<!--Cookie Modal (Footer)-->
<div id="cookieModal" class="hidden fixed inset-0 bg-white/30 backdrop-blur-lg rounded-2xl flex items-center justify-center z-[999] px-4">
  <div class="bg-white/80 rounded-xl max-w-2xl w-full p-6 relative shadow-xl overflow-y-auto max-h-[80vh]">
    <button id="closeCookies" class="absolute top-3 right-3 text-green-700 hover:text-green-500 text-xl font-bold" id="closePolicy">
      <span class="material-symbols-rounded">close</span>
    </button>
    <h2 class="text-2xl font-semibold mb-4 text-green-800">We use Cookies</h2>
    <div class="text-green-700 justify-center text-sm md:text-base space-y-4">
This section will help you understand how Cointra uses and protects the data you provide to us whenever you visit and use our services. 
<br><br>
<p class="text-lg">Accept All Cookies:</p>
Giving us permission to use all types of cookies on your device <br> <br>

<p class="text-lg">Decline Cookies: </p>
Reject all cookies that would-be implemented<br> <br>

</div>
</div>
</div>

<!--Cookies-->
<div id="cookies" class="fixed inset-0 bg-white/30 backdrop-blur-lg hidden flex items-center justify-center z-[999] px-4">
<div class="bg-white/80 rounded-xl max-w-xl w-full p-6 relative shadow-xl text-green-900 max-h-[90vh] overflow-y-auto">
<h2 class="text-xl font-semibold mb-2">We Use Cookies</h2>
<p class="text-sm mb-4">
      Cookies help us personalize your experience by allowing our site to adjust to your preferences. 
      These small data files also give us a helpful insights to support our analytics and improve more
      for the website functions.
</p>
<div class="flex justify-end gap-3">
  <!-- Reject Cookies Button with Tooltip -->
  <div class="relative group">
    <button id="reject" class="px-4 py-2 border border-red-500 rounded-lg hover:bg-red-500 transition-all duration-300 ease-in-out hover:text-white font-semibold">
      Reject Cookies
    </button>
    <span class="absolute bottom-full mb-2 left-1/2 -translate-x-1/2 bg-gray-800 text-white text-xs rounded py-1 px-2 opacity-0 group-hover:opacity-100 transition-opacity duration-300 pointer-events-none">
      Reject all non-essential cookies
    </span>
  </div>

  <!-- Accept Cookies Button with Tooltip -->
  <div class="relative group">
    <button id="accept" class="px-4 py-2 border border-lime-500 rounded-lg hover:bg-green-500 transition-all duration-300 ease-in-out hover:text-white font-semibold">
      Accept All Cookies
    </button>
    <span class="absolute bottom-full mb-2 left-1/2 -translate-x-1/2 bg-gray-800 text-white text-xs rounded py-1 px-2 opacity-0 group-hover:opacity-100 transition-opacity duration-300 pointer-events-none">
      Accept all cookies including analytics
    </span>
  </div>
</div>
</div>
</div>
<script>
const menuTrigger = document.getElementById("menu-trigger");
const mobileMenu = document.getElementById("mobile-menu");

// Open/close menu
menuTrigger.addEventListener("click", (e) => {
  e.stopPropagation();
  if (mobileMenu.classList.contains("hidden")) {
    mobileMenu.classList.remove("hidden");
    mobileMenu.classList.remove("dropdown-exit");
    mobileMenu.classList.add("dropdown-enter");
  } else {
    mobileMenu.classList.remove("dropdown-enter");
    mobileMenu.classList.add("dropdown-exit");
    setTimeout(() => {
      mobileMenu.classList.add("hidden");
    }, 200);
  }
});

// Close menu when clicking outside
document.addEventListener("click", (e) => {
  if (!mobileMenu.classList.contains("hidden") && !mobileMenu.contains(e.target) && !menuTrigger.contains(e.target)) {
    mobileMenu.classList.remove("dropdown-enter");
    mobileMenu.classList.add("dropdown-exit");
    setTimeout(() => {
      mobileMenu.classList.add("hidden");
    }, 200);
  }
});

// --- Modal Logic ---
const termsModal = document.getElementById("termsModal");
const faqModal = document.getElementById("faqModal");
const privacyModal = document.getElementById("privacyModal");
const cookieModal = document.getElementById("cookieModal");
const cookiesCheck = document.getElementById("cookiesCheck");
const privacyCheck = document.getElementById("privacyCheck");
const closePrivacy = document.getElementById("closePrivacy");
const closeTerms = document.getElementById("closeTerms");
const closeFAQ = document.getElementById("closeFAQ");

// Open modals when links are clicked
document.querySelectorAll('a[href="#terms"], a[href="#faq"]').forEach(link => {
  link.addEventListener("click", e => {
    e.preventDefault();
    if (link.href.includes("#terms")) {
      termsModal.classList.add("modal-show");
    } else {
      faqModal.classList.add("modal-show");
    } 
  });
});

// Close modals
closeTerms.addEventListener("click", () => termsModal.classList.remove("modal-show"));
closeFAQ.addEventListener("click", () => faqModal.classList.remove("modal-show"));

// Close by clicking outside
[termsModal, faqModal].forEach(modal => {
  modal.addEventListener("click", e => {
    if (e.target === modal) modal.classList.remove("modal-show");
  });
});
//Privacy Modal
privacyCheck.addEventListener("click", (a) => {
  a.preventDefault();
  privacyModal.classList.remove("hidden");
  privacyModal.classList.add("modal-show");
});

closePrivacy.addEventListener("click", () => {
  privacyModal.classList.add("hidden");
  privacyModal.classList.remove("modal-show");
});
//Cookie Modal (Footer)
cookiesCheck.addEventListener("click", (a) => {
  a.preventDefault();
  cookieModal.classList.remove("hidden");
  cookieModal.classList.add("modal-show");
});

closeCookies.addEventListener("click", () => {
  cookieModal.classList.add("hidden");
  cookieModal.classList.remove("modal-show");
});
//Cookies logic
const cookies = document.getElementById("cookies");
const accept = document.getElementById("accept");
const reject = document.getElementById("reject");

function cookieSet(name, value, days) {
  const day = new Date();
  day.setTime(day.getTime() + (days*24*60*60*1000));
  document.cookie = `${name}=${value};path=/;expires=${day.toUTCString()}`;
}

function cookieGet(name) {
  const cookies = document.cookie.split(';');
  for (let cookie of cookies) {
    const [key, value] = cookie.trim().split('=');
    if (key === name) return value;
  }
  return null;
}


window.addEventListener('DOMContentLoaded', () => {
if(!localStorage.getItem("cookiesAccepted")) {
  setTimeout(() => {
    cookies.classList.remove("hidden");
  },10000)
} 
});

accept.addEventListener("click", () => {
  cookieSet("acceptedCookies", "true", 365);
  cookies.classList.add("hidden");
});

reject.addEventListener("click", () => {
  cookieSet("acceptedCookies", "false", 365);
  cookies.classList.add("hidden");
});
</script>
</body>
</html>
