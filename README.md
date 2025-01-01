# laravel-project
This repository contains a complete Laravel project built as part of a hands-on learning journey. It demonstrates the implementation of core Laravel features, including routing, controllers, models, database migrations, authentication, and more.

---

## Features  
- Multi-guard authentication for multiple user roles.  
- Role-based access control (RBAC) for different functionalities.  
- RESTful routing and controllers.  
- Database migrations and seeding.  
- Eloquent ORM for database interactions.  
- Blade templating for reusable and dynamic front-end views.  
- Middleware for request handling and access control.  
- Scalable and modular code structure.  

---

## Installation  

Follow these steps to set up the project on your local machine:  

1. **Clone the Repository**  
   ```bash
   https://github.com/orchid06/laravel-project.git
   cd laravel-project

   composer install

   cp .env.example .env

   php artisan key:generate

   php artisan migrate --seed

   php artisan serve
