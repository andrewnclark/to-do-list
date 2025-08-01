# MLP To-Do List Application

A modern, clean to-do list application built with Laravel 10, Tailwind CSS v4, and Laravel Sail for easy Docker-based development.

## Features

- ✅ Create new tasks
- ✅ Mark tasks as completed
- ✅ Delete tasks
- ✅ Clean, responsive UI with Tailwind CSS v4
- ✅ Service-based architecture with proper separation of concerns
- ✅ Form request validation
- ✅ Comprehensive unit tests

## Tech Stack

- **Backend**: Laravel 10
- **Frontend**: Blade templates with Tailwind CSS v4
- **Database**: MySQL
- **Development Environment**: Laravel Sail (Docker)
- **Build Tool**: Vite
- **Testing**: PHPUnit

## Prerequisites

- Docker Desktop installed and running
- Git
- Composer (for initial setup)

## Installation & Setup

### 1. Clone the Repository

```bash
git clone <repository-url>
cd to-do-list
```

### 2. Install PHP Dependencies

```bash
composer install
```

### 3. Environment Setup

```bash
# Copy the environment file
cp .env.example .env

# Generate application key
php artisan key:generate
```

### 4. Configure Environment Variables

Update your `.env` file with the following database settings:

```env
DB_CONNECTION=mysql
DB_HOST=mysql
DB_PORT=3306
DB_DATABASE=laravel
DB_USERNAME=sail
DB_PASSWORD=password
```

### 5. Start Laravel Sail

```bash
# Start the Docker containers
./vendor/bin/sail up -d

# Or use the alias (after setting it up)
sail up -d
```

### 6. Run Database Migrations

```bash
./vendor/bin/sail artisan migrate
```

### 7. Install Frontend Dependencies & Build Assets

```bash
# Install Node.js dependencies
./vendor/bin/sail npm install

# Build assets for development
./vendor/bin/sail npm run dev

# Or for production
./vendor/bin/sail npm run build
```

### 8. Access the Application

Open your browser and navigate to: `http://localhost`

## Development Workflow

### Running the Development Server

```bash
# Start Sail containers
./vendor/bin/sail up -d

# Watch for file changes (in a separate terminal)
./vendor/bin/sail npm run dev
```

### Running Tests

```bash
# Run all tests
./vendor/bin/sail artisan test

# Run specific test file
./vendor/bin/sail artisan test tests/Unit/TaskServiceTest.php

# Run tests with coverage
./vendor/bin/sail artisan test --coverage
```

### Useful Sail Commands

```bash
# Access the application container
./vendor/bin/sail shell

# Run Artisan commands
./vendor/bin/sail artisan migrate:fresh --seed
./vendor/bin/sail artisan tinker

# View logs
./vendor/bin/sail logs

# Stop containers
./vendor/bin/sail down
```

## Project Structure

```
app/
├── Http/
│   ├── Controllers/
│   │   └── TaskController.php
│   └── Requests/
│       └── StoreTaskRequest.php
├── Models/
│   └── Task.php
├── Services/
│   └── TaskService.php
├── Contracts/
│   └── TaskServiceInterface.php
└── Providers/
    └── TaskServiceProvider.php

resources/
├── views/
│   ├── layouts/
│   │   └── app.blade.php
│   └── tasks/
│       └── index.blade.php
├── css/
│   └── app.css (Tailwind CSS v4)
└── js/
    └── app.js

tests/
└── Unit/
    └── TaskServiceTest.php
```

## Architecture

### Service Layer Pattern
The application uses a service layer pattern with:
- `TaskServiceInterface` - Contract defining the service methods
- `TaskService` - Implementation of the task business logic
- `TaskServiceProvider` - Service container binding

### Form Request Validation
- `StoreTaskRequest` - Handles validation for creating new tasks

### Database Schema
The `tasks` table includes:
- `id` - Primary key
- `description` - Task description (required, max 255 chars)
- `is_completed` - Boolean flag for completion status
- `created_at` / `updated_at` - Timestamps

## Troubleshooting

### Common Issues

1. **Port conflicts**: If port 80 is already in use, update `docker-compose.yml`
2. **Permission issues**: Ensure Docker has proper permissions
3. **Database connection**: Verify MySQL container is running with `sail ps`

### Reset Everything

```bash
# Stop containers and remove volumes
./vendor/bin/sail down -v

# Rebuild and restart
./vendor/bin/sail up -d --build

# Re-run migrations
./vendor/bin/sail artisan migrate:fresh
```

## Contributing

1. Fork the repository
2. Create a feature branch
3. Make your changes
4. Run tests to ensure everything works
5. Submit a pull request

## License

This project is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
   
