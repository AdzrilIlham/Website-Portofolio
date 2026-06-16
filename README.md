# Portfolio - Full-Stack Application

A modern portfolio application built with **React.js** (frontend) and **Laravel** (backend + admin panel).

## Tech Stack

- **Frontend:** React.js, Vite, Framer Motion, Axios
- **Backend:** Laravel 11, PHP, MySQL, Laravel Sanctum
- **Admin Panel:** Laravel Blade, Alpine.js, Tailwind CSS

## Project Structure

```
Portofolio/
├── backend/          # Laravel API + Admin Panel
│   ├── app/
│   ├── database/
│   ├── routes/
│   ├── resources/views/
│   └── ...
└── frontend/         # React.js Portfolio
    ├── src/
    ├── public/
    └── ...
```

## Quick Start

### Prerequisites

- PHP 8.2+
- MySQL
- Composer
- Node.js 18+

### Backend Setup

```bash
cd backend

# Install dependencies
composer install

# Configure environment
cp .env.example .env
php artisan key:generate

# Edit .env with your database credentials
# DB_DATABASE=portfolio
# DB_USERNAME=root
# DB_PASSWORD=

# Create database and run migrations
mysql -u root -e "CREATE DATABASE portfolio"
php artisan migrate --seed

# Create storage symlink
php artisan storage:link

# Start server
php artisan serve
```

### Frontend Setup

```bash
cd frontend

# Install dependencies
npm install

# Start dev server
npm run dev
```

### Access

- **Portfolio:** http://localhost:5173
- **Admin Panel:** http://localhost:8000/admin/login
- **API:** http://localhost:8000/api

### Default Admin Credentials

- **Email:** admin@admin.com
- **Password:** password

## API Endpoints

### Public (no auth)

| Method | Endpoint | Description |
|--------|----------|-------------|
| GET | `/api/profile` | Get profile |
| GET | `/api/skills` | Get all skills |
| GET | `/api/projects` | Get all projects |
| GET | `/api/experiences` | Get all experiences |

### Admin (Sanctum auth)

| Method | Endpoint | Description |
|--------|----------|-------------|
| POST | `/api/admin/login` | Login |
| POST | `/api/admin/logout` | Logout |
| PUT | `/api/admin/profile` | Update profile |
| GET/POST/PUT/DELETE | `/api/admin/skills` | Manage skills |
| GET/POST/PUT/DELETE | `/api/admin/projects` | Manage projects |
| GET/POST/PUT/DELETE | `/api/admin/experiences` | Manage experiences |

## Features

### Public Portfolio
- Dark mode theme with cyan/purple accents
- Responsive design (mobile-first)
- Smooth scroll and Framer Motion animations
- Loading skeletons while data loads
- Sections: Hero, About, Skills, Projects, Experience, Contact

### Admin Panel
- Dashboard with content statistics
- Profile management with photo upload
- Skills CRUD with category filtering
- Projects CRUD with image upload and tech stack tags
- Experiences CRUD with work/education types
- Dark theme UI with Tailwind CSS

## License

MIT
