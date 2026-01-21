# CRUD & Data Recap System - CodeIgniter 4

A web-based application built with **CodeIgniter 4** designed for efficient data management and reporting. This system features a complete CRUD (Create, Read, Update, Delete) workflow and a Data Recap module for summarizing information.

---

## 🚀 Key Features

* **CRUD Operations:** Seamlessly add, view, edit, and delete records.
* **Data Recap:** Specialized module to aggregate and summarize data for reports.
* **MVC Architecture:** Clean and organized code structure using the Model-View-Controller pattern.
* **Built-in Security:** Protection against CSRF, XSS, and SQL Injection via CodeIgniter 4's security suite.

---

## 🛠️ Tech Stack

* **Framework:** [CodeIgniter 4.x](https://codeigniter.com/)
* **Language:** PHP 7.4+ (Compatible with PHP 8.x)
* **Database:** MySQL / MariaDB
* **Styling:** HTML5, CSS3 (Bootstrap/Tailwind)

---

## ⚙️ Installation & Setup

### 1. Prerequisites
Ensure you have the following installed:
* Web Server (Apache/Nginx)
* PHP 7.4 or higher
* MySQL/MariaDB
* [Composer](https://getcomposer.org/) (optional but recommended)

### 2. Clone the Repository
```bash
git clone [https://github.com/your-username/your-repo-name.git](https://github.com/your-username/your-repo-name.git)
cd your-repo-name
```
### 3. Database Configuration
Open your database manager (e.g., phpMyAdmin).

Create a new database named: db_uas.

Import the provided .sql file (if available) into the database.

To link the database to the system: Open the configuration file located at: app/Config/Database.php

Update the $default array settings:
```bash
PHP
public array $default = [
    'DSN'          => '',
    'hostname'     => 'localhost',
    'username'     => 'root',         // Your DB username
    'password'     => '',             // Your DB password
    'database'     => 'db_uas',       // Must match your DB name
    'DBDriver'     => 'MySQLi',
    'DBPrefix'     => '',
    'pConnect'     => false,
    'DBDebug'      => true,
    'charset'      => 'utf8mb4',
    'DBCollat'     => 'utf8mb4_general_ci',
    'swapPre'      => '',
    'encrypt'      => false,
    'compress'     => false,
    'strictOn'     => false,
    'failover'     => [],
    'port'         => 3306,
    'numberNative' => false,
];
```
### 4. Running the Project
Use the built-in CodeIgniter server:

Bash
php spark serve
Open your browser and navigate to: http://localhost:8080

## 📁 Project Structure
app/Controllers: Contains the logic for CRUD and Data Recap.

app/Models: Handles interactions with the db_uas database.

app/Views: Contains the frontend user interface.

app/Config/Database.php: The primary file for database connection settings.

## 🤝 Contributing
If you'd like to contribute, please fork the repository and use a feature branch. Pull requests are warmly welcome.
