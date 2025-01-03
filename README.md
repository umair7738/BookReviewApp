# Book Review App

<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## Introduction

Welcome to the **Book Review App**! This is a web application built using **Laravel** for the backend and **Vue.js** for the frontend, designed to allow users to review books, share feedback, and discover great reads.

## Features

- **User Registration & Login**: Allow users to sign up, log in, and manage their accounts.
- **Book Reviews**: Users can review books they've read, share their thoughts, and rate them.
- **Search & Filter**: Search and filter books by categories, authors, and ratings.
- **Responsive Design**: Mobile-friendly design using Bootstrap for a seamless experience across devices.

## Technologies Used

- **Laravel** (Backend)
- **Vue.js** (Frontend)
- **Bootstrap** (UI Framework)
- **MySQL** (Database)
- **npm** (For Frontend Dependencies)

## Prerequisites

Before you begin, make sure you have the following software installed on your system:

- **PHP** >= 7.3
- **Composer**
- **Node.js** (for frontend dependencies)
- **MySQL** or any database of your choice

## Installation


### 1. Clone the Repository
Clone the repository to your local machine:

```bash
git clone https://github.com/umair7738/BookReviewApp.git
cd BookReviewApp
```

### 2. Install Backend Dependencies
Run the following command to install the backend PHP dependencies:
```bash
composer install
```

### 3. Set Up Environment Variables
Copy the .env.example file to .env:
```bash
cp .env.example .env
```

Now, generate the application key:
```bash
php artisan key:generate
```


### 4. Set Up the Database
Make sure you have a MySQL database set up and update the database details in the .env file:

.env file
```bash
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=book_review_app
DB_USERNAME=root
DB_PASSWORD=
```

Run the migrations to create the necessary tables:
```bash
php artisan migrate
```


### 5. Install Frontend Dependencies
Install the required frontend dependencies:
```bash
npm install
```


### 6. Build Frontend Assets
Now, run the following command to build the assets:
```bash
npm run dev
```
This will compile and bundle the frontend assets (CSS, JS).


### 7. Serve the Application
Run the Laravel development server:
```bash
php artisan serve
```
The application will now be accessible at http://127.0.0.1:8000.

Usage
Once the app is up and running, you can visit the homepage to see browse books, log in or register to post reviews.

User Roles
Guest: Can browse books and read reviews.
Registered User: Can post reviews, edit their reviews, delete their reviews.

Contribution Guidelines
We welcome contributions! If you'd like to contribute to this project, please follow these steps:

Fork the repository.
Create a new branch (git checkout -b feature/your-feature-name).
Make your changes.
Commit your changes (git commit -m 'Add new feature').
Push to your forked repository (git push origin feature/your-feature-name).
Create a pull request.
Please ensure your code adheres to the project's coding standards and includes tests where applicable.

## License
The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

Acknowledgements
Laravel - The PHP framework used for building the backend.
Vue.js - The JavaScript framework used for building the frontend.
Bootstrap - Frontend framework for creating responsive designs.
MySQL - The database used for storing application data.
Contact
For any questions or inquiries, feel free to reach out to me on GitHub.


### Explanation of the Sections:

- **Introduction**: Describes what the app is about and the technologies used.
- **Technologies Used**: Lists the tech stack used in the project.
- **Prerequisites**: Lists software dependencies that must be installed to run the app.
- **Installation**: Step-by-step guide on how to set up the app locally.
- **Usage**: Instructions for using the app after installation.
- **Contribution Guidelines**: How others can contribute to the project.
- **License**: Information about the project's license.
- **Acknowledgements**: Acknowledging the open-source tools and frameworks used.
- **Contact**: Provides contact info for questions or support.

You can modify this template further to fit the specific needs of your project.