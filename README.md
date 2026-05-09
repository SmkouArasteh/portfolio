<p align="center">
  <img src="https://img.shields.io/badge/PHP-8.2-777BB4?style=for-the-badge&logo=php&logoColor=white" alt="PHP 8.2">
  <img src="https://img.shields.io/badge/Laravel-11-FF2D20?style=for-the-badge&logo=laravel&logoColor=white" alt="Laravel 11">
  <img src="https://img.shields.io/badge/Filament-3-FFAF00?style=for-the-badge&logo=filament&logoColor=black" alt="Filament 3">
  <img src="https://img.shields.io/badge/Tailwind_CSS-3-06B6D4?style=for-the-badge&logo=tailwind-css&logoColor=white" alt="Tailwind CSS 3">
  <img src="https://img.shields.io/badge/Alpine.js-3-8BC0D0?style=for-the-badge&logo=alpine.js&logoColor=black" alt="Alpine.js 3">
  <br>
  <img src="https://img.shields.io/badge/MySQL-4479A1?style=for-the-badge&logo=mysql&logoColor=white" alt="MySQL">
  <img src="https://img.shields.io/badge/License-MIT-yellow?style=for-the-badge" alt="MIT License">
  <img src="https://img.shields.io/github/stars/SmkouArasteh/portfolio?style=for-the-badge&logo=github" alt="GitHub Stars">
  <img src="https://img.shields.io/github/issues/SmkouArasteh/portfolio?style=for-the-badge&logo=github" alt="GitHub Issues">
  <img src="https://img.shields.io/github/forks/SmkouArasteh/portfolio?style=for-the-badge&logo=github" alt="GitHub Forks">
</p>

# Portfolio

A personal portfolio website built with **Laravel 11**, **Filament 3**, **Tailwind CSS** and **Alpine.js**.  
It features a powerful admin panel to manage content and a modern, animated frontend to showcase your work.

> 🚧 This project is actively being improved. New features will be added over time.

---

## ✨ Features

- **Admin Panel** (Filament) – full control over your portfolio content
- **Projects** – create, tag and display your best work
- **Experiences & Education** – timeline views on the frontend
- **Skills** – visual percentage bars
- **About Me** – personal info, resume download, social links
- **Contact Form** – visitors can send messages directly
- **Site Settings** – update logo, favicon, meta tags, social media links from the panel
- **Fully responsive** – built with Tailwind CSS
- **Animations** – subtle animations powered by Alpine.js & AOS

---

## 🛠 Tech Stack

| Technology | Usage |
|------------|-------|
| ![PHP](https://img.shields.io/badge/PHP-8.2-777BB4?logo=php) | Backend language |
| ![Laravel](https://img.shields.io/badge/Laravel-11-FF2D20?logo=laravel) | Backend framework |
| ![Filament](https://img.shields.io/badge/Filament-3-FFAF00?logo=filament) | Admin panel |
| ![Tailwind CSS](https://img.shields.io/badge/Tailwind_CSS-3-06B6D4?logo=tailwind-css) | Frontend styling |
| ![Alpine.js](https://img.shields.io/badge/Alpine.js-3-8BC0D0?logo=alpine.js) | Frontend interactions |
| ![MySQL](https://img.shields.io/badge/MySQL-4479A1?logo=mysql) | Database (default) |

---

## 📋 Requirements

- PHP **8.2** or higher
- [Composer](https://getcomposer.org)
- [Node.js](https://nodejs.org) + NPM
- MySQL (or any [Laravel-supported database](https://laravel.com/docs/11.x/database))

---

## ⚙️ Installation (Local)

1. **Clone the repository**
   ```bash
   git clone https://github.com/SmkouArasteh/portfolio.git
   cd portfolio
   ```

2. **Install PHP dependencies**
   ```bash
   composer install
   ```

3. **Create environment file**
   ```bash
   cp .env.example .env
   ```

4. **Configure your database**  
   Open `.env` and set your MySQL credentials:
   ```
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=your_database
   DB_USERNAME=your_username
   DB_PASSWORD=your_password
   ```

5. **Generate application key**
   ```bash
   php artisan key:generate
   ```

6. **Run database migrations**
   ```bash
   php artisan migrate
   ```

7. **Create the storage symbolic link**
   ```bash
   php artisan storage:link
   ```

8. **Install and build frontend assets**
   ```bash
   npm install
   npm run build
   ```

9. **Create an admin user for Filament**
   ```bash
   php artisan make:filament-user
   ```

10. **Start the development server**
    ```bash
    php artisan serve
    ```

Now visit `http://localhost:8000` for the main site and `/admin` for the admin panel.

---

## 🖥 Usage

- Log into `/admin` with your admin credentials.
- Fill in your personal information under **About Me**.
- Go to **Settings** to update the site name, logo, favicon, social links and meta tags.
- Add your projects, skills, experiences and education.  
  All content will appear on the frontend automatically.

---

## 🌐 Deployment

For production, follow Laravel's [deployment guide](https://laravel.com/docs/11.x/deployment).  
Make sure to set `APP_ENV=production` and `APP_DEBUG=false` in your `.env`.

---

## 📌 To-Do / Planned Improvements

- [ ] Add blog / articles section
- [ ] Complete SEO tools (sitemap, Open Graph)
- [ ] Add testimonials management
- [ ] Add frontend project pages (list and single)
- [ ] Dark mode toggle

---

## 📄 License

This project is open-sourced under the [MIT license](https://opensource.org/licenses/MIT).

---

## 🙏 Acknowledgements

- [Laravel](https://laravel.com)
- [Filament](https://filamentphp.com)
- [Tailwind CSS](https://tailwindcss.com)
- [Alpine.js](https://alpinejs.dev)
- [AOS](https://michalsnik.github.io/aos/) for scroll animations