<p align="center">
  <img src="screenshots/cover.png" alt="Irancell CRM" width="100%">
</p>

<h1 align="center">Irancell CRM & Admin Panel</h1>

<p align="center">
Customer Relationship Management System for Bale, Eitaa and Future Messaging Platforms
</p>

<p align="center">

![PHP](https://img.shields.io/badge/PHP-8.x-777BB4?style=for-the-badge&logo=php)
![MySQL](https://img.shields.io/badge/MySQL-4479A1?style=for-the-badge&logo=mysql&logoColor=white)
![JavaScript](https://img.shields.io/badge/JavaScript-F7DF1E?style=for-the-badge&logo=javascript&logoColor=black)
![HTML5](https://img.shields.io/badge/HTML-E34F26?style=for-the-badge&logo=html5&logoColor=white)
![CSS3](https://img.shields.io/badge/CSS-1572B6?style=for-the-badge&logo=css3&logoColor=white)

</p>

---

# 📌 Overview

This project is a complete **Customer Relationship Management (CRM)** system developed for an Irancell sales center.

The system collects customer registrations from multiple messaging platforms such as **Bale** and **Eitaa**, stores them in a centralized MySQL database, and allows operators to manage customers through a modern web-based administration panel.

The architecture has been designed so new messaging platforms can easily be integrated in the future.

---

# ✨ Features

### Mini App

- Customer registration
- Mobile number verification
- Desired number registration
- MySQL storage
- Automatic status management

### CRM Dashboard

- Dashboard with statistics
- Customer management
- Customer details
- Customer editing
- Customer search
- Platform filtering
- Status filtering
- Excel export
- Authentication system
- Responsive admin interface

---

# 🛠 Technology Stack

- PHP
- MySQL
- JavaScript
- HTML5
- CSS3

---

# 📂 Project Structure

```
irancellApp/

├── admin/
│   ├── dashboard.php
│   ├── customers.php
│   ├── customer.php
│   ├── customer_add.php
│   ├── customer_edit.php
│   ├── export_excel.php
│   └── includes/
│
├── lib/
│
├── screenshots/
│
├── index.php
├── submit.php
├── config.example.php
├── .gitignore
└── README.md
```

---

# 📸 Screenshots


## login

![](screenshots/login.png)

---

## Dashboard

![](screenshots/dashboard.png)

---

## Customers

![](screenshots/customers.png)

---

## Customer Details

![](screenshots/customer-details.png)

---

## Add Customer

![](screenshots/customer-add.png)

---

## Mini App

![](screenshots/miniapp.png)

---


# 🚀 Installation

Clone the repository

```bash
git clone https://github.com/mfazelkh99/irancell-crm.git
```

Open project directory

```bash
cd irancell-crm
```

Create your configuration file

```
config.php
```

Copy values from

```
config.example.php
```

Fill your own

- Database credentials
- Bot Token
- Admin credentials

Import your MySQL database.

Run the project using your preferred PHP server.

---

# 🔒 Security

Sensitive information is intentionally excluded from this repository.

Examples include:

- Database credentials
- Bot Token
- Admin Password
- Admin Username

Use **config.example.php** as a template.

---

# 🚧 Roadmap

- Notes system
- Customer activity history
- Multi-admin support
- Customer tags
- Advanced reports
- Charts & analytics
- Multi-platform integration
- REST API

---

# 💡 Future Platforms

This CRM has been designed to support additional messaging platforms such as:

- Telegram
- WhatsApp
- Rubika
- Gap
- Web Forms
- Future custom integrations

---

# 👨‍💻 Author

**Mohammad Fazel khorrami**

Software Engineer

Building CRM Systems • Python Bots • Full Stack Web Applications

GitHub

https://github.com/mfazelkh99

---

⭐ If you like this project, consider giving it a star.