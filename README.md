# CoinTra

**A full-stack personal finance web app for tracking income, expenses, budgets and accounts.**

CoinTra helps users manage their money in one place. Users can organize spending into categories, set monthly budgets, record income and expenses across multiple accounts, and export their records. Budget limits are enforced automatically, and every change is recorded in an activity history.

![PHP](https://img.shields.io/badge/PHP-777BB4?logo=php&logoColor=white)
![MySQL](https://img.shields.io/badge/MySQL-4479A1?logo=mysql&logoColor=white)
![JavaScript](https://img.shields.io/badge/JavaScript-F7DF1E?logo=javascript&logoColor=black)
![Tailwind CSS](https://img.shields.io/badge/Tailwind_CSS-06B6D4?logo=tailwindcss&logoColor=white)
![Chart.js](https://img.shields.io/badge/Chart.js-FF6384?logo=chartdotjs&logoColor=white)

---

## Features

- **Authentication:** sign up and log in with a username or email; passwords are hashed with PHP's `password_hash`
- **Accounts:** track balances across multiple accounts (for example, wallet, bank or e-wallet); balances update automatically with every transaction
- **Categories:** organize income and expenses into custom categories
- **Monthly budgets:** set a spending limit per category; expenses that would go over the limit are blocked with a warning
- **Transactions:** record income and expenses; the Income and Expense pages include charts that summarize them
- **Activity history:** an audit log of every create, update and delete
- **Export:** download transactions for a selected month as CSV, or as a printable report that can be saved as PDF
- **User profile:** display name, birthday, profile picture and banner
- **Data management:** clear transaction records or reset all data
- **Installable:** includes a web app manifest

## Architecture

The front end and back end are separated by a JSON REST API.

- **`public/`** contains the pages. They use JavaScript `fetch` calls to talk to the API.
- **`api/`** contains the REST endpoints. Each one handles `GET`, `POST`, `PUT` and `DELETE` and returns JSON.
- **`config/`** contains the database connection (PDO) and session helpers.

Every API endpoint requires a logged-in session and only returns the current user's data. All queries use PDO prepared statements to prevent SQL injection.

## Tech Stack

| Area | Technology |
|---|---|
| Front end | HTML, Tailwind CSS, JavaScript, Chart.js |
| Back end | PHP 8 (REST API, PDO) |
| Database | MySQL |
| Local development | Laragon |

## Project Structure

```
CoinTra/
├── api/                    # REST API endpoints
│   ├── auth.php                # Sign up, login, logout, password reset
│   ├── accounts.php
│   ├── budgets.php
│   ├── categories.php
│   ├── transactions.php
│   ├── history.php             # Activity log
│   ├── export.php              # CSV and printable PDF export
│   ├── users.php               # Profile
│   └── maintenance.php         # Clear or reset data
├── config/
│   └── Database.php        # PDO connection and session helpers
├── public/                 # Pages (start at landing.php)
├── assets/                 # Images and logo
├── uploads/                # User-uploaded profile pictures (not committed)
└── database_schema.sql     # MySQL schema
```

## Getting Started

### Prerequisites

- PHP 8 and MySQL, for example through [Laragon](https://laragon.org) or XAMPP

### Installation

1. Clone the repository into your web server folder (for Laragon, `C:\laragon\www`):
   ```bash
   git clone https://github.com/yeldsg/cointra.git
   ```
2. Create a MySQL database named `cointra` and import `database_schema.sql` (for example, through phpMyAdmin or HeidiSQL).
3. If your MySQL login is not `root` with no password, update the settings in `config/Database.php`.
4. Open `http://localhost/cointra/public/landing.php` in your browser.

### First Use

1. Create an account with **Sign Up**.
2. Add your **categories**, then your **accounts**, then a **budget**.
3. You can now record transactions on the **Transactions** page.

## Known Limitations

- **Password reset is for local demonstration only.** It checks the email address but does not send a verification code, so it should not be used on a public server without adding email verification.
- The app is designed to run locally and has not been deployed.

## About This Project

CoinTra was built as a team project for a web development course (September – December 2025). I worked on it as a **Full-Stack Developer**.

## Author

**Kathrina Marhiel Zamora** · BS Information Technology, Pampanga State University
GitHub: [@yeldsg](https://github.com/yeldsg)
