# Laravel Job Board

A simple and functional Job Board application built with Laravel. It allows job seekers to browse and apply for jobs, while employers can post and manage job listings.

## 📸 Screenshots

1. Homepage  
![Homepage](https://github.com/aiymnn/Laravel-job-board/blob/a20a7a61863c2761530049b05c64b254127eec44/screenshots/Homepage.png)

2. User Application Jobs  
![User Application Jobs](https://github.com/aiymnn/Laravel-job-board/blob/a20a7a61863c2761530049b05c64b254127eec44/screenshots/UserApplicationJobs.png)

3. User Job Posts  
![User Job Posts](https://github.com/aiymnn/Laravel-job-board/blob/a20a7a61863c2761530049b05c64b254127eec44/screenshots/UserJobPosts.png)

---

## ✨ Features

- User registration & login
- Job browsing with filters (category, salary range, experience)
- Job application with CV upload (PDF only)
- Employer registration
- Employers can create, edit, soft-delete, and manage job listings
- Employers can view job applicants and download their CVs
- Authorization policies for job actions
- File storage using custom `private` disk
- Uses Laravel Policies, Middleware, and Resource Controllers

---

## 🛠️ Tech Stack

- Laravel 12
- Blade Templates
- Tailwind CSS
- SQLite / MySQL (configurable)
- Laravel File Storage

---

## 👥 Roles & Permissions

- **Guest**  
  - Can browse jobs only.
  - Must register/login to apply.

- **Job Seeker (User)**  
  - Can apply to jobs (with CV upload).
  - Can view their applied jobs.

- **Employer**  
  - Can post, edit, and soft-delete jobs.
  - Can view applicants and download their CVs.
  - Requires "employer" role during registration.

---

> ⚠️ This project is not deployed. To test it locally, clone the repository and follow the installation steps. You will also need to set up a local database (e.g. MySQL or SQLite) and update the `.env` file accordingly.

> 🛠 This project uses Laravel's default local setup. If you're using DBeaver, make sure your database connection matches the `.env` DB settings.


## 📦 Installation

```bash
# Clone the repository
git clone https://github.com/aiymnn/Laravel-job-board.git

cd Laravel-job-board

# Install dependencies
composer install

# Create environment file
cp .env.example .env

# Generate application key
php artisan key:generate

# Run migrations
php artisan migrate

# Start the server
php artisan serve

