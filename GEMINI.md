# Vinylskivor Förteckning - Developer Guide

This `GEMINI.md` provides context and instructions for AI agents (and developers) working on the Vinylskivor Förteckning project.

## Project Overview

**Vinylskivor Förteckning** is a Laravel-based application for managing a vinyl record collection. It features integration with the **Discogs API** to automatically populate artist and record data, including images.

*   **URL:** https://vinyl.bokbindaregatan.se (Production)
*   **Framework:** Laravel 11 (PHP 8.2+)
*   **Frontend:** Livewire 3.5, Tailwind CSS 3.4, Blade Templates
*   **Database:** SQLite (Default)
*   **Asset Bundling:** Vite

## Tech Stack & Key Dependencies

*   **Backend:**
    *   `laravel/framework`: Core framework.
    *   `livewire/livewire`: Full-stack framework for dynamic UIs.
    *   `laravel/sanctum`: API authentication.
    *   `maatwebsite/excel`: Excel export/import.
    *   `spatie/laravel-sitemap`: Sitemap generation.
    *   `verifiedjoseph/ntfy-php-library`: Notifications.
*   **Frontend:**
    *   `tailwindcss`: Utility-first CSS framework.
    *   `blade-ui-kit/blade-icons` & `owenvoke/blade-fontawesome`: Icons.
    *   `vite`: Build tool.
*   **Dev Tools:**
    *   `barryvdh/laravel-debugbar`: Debugging toolbar.
    *   `laradumps/laradumps`: Debugging helper.
    *   `laravel/pint`: PHP code style fixer.
    *   `prettier`: Code formatter (with Blade plugin).

## Directory Structure

*   **`app/Livewire/`**: Contains the main UI logic. Key components:
    *   `VinylTable.php`: Likely the main list view of records.
    *   `ArtistShow.php`: Artist details view.
    *   `DiscogsManager.php`: Component for managing Discogs data syncing.
*   **`app/Console/Commands/`**: Custom Artisan commands, primarily for Discogs integration:
    *   `DiscogsDataPopulate.php`: Fetches data for artists/records.
    *   `DiscogsDataRefresh.php`: Updates existing data.
*   **`app/Models/`**: Eloquent models (`Artist`, `Record`, `User`).
*   **`database/migrations/`**: Database schema definitions.
*   **`resources/views/`**: Blade templates.

## Development Workflow

### Prerequisites
*   PHP 8.2+
*   Node.js & NPM
*   Composer
*   SQLite driver for PHP

### Installation

```bash
composer install
npm install
cp .env.example .env
php artisan key:generate
touch database/database.sqlite
php artisan migrate --seed
```

### Running the Application

The project uses a convenience script to run backend, queue, and frontend servers simultaneously:

```bash
composer dev
```

This runs:
1.  `php artisan serve` (Server)
2.  `php artisan queue:listen` (Queue Worker - important for background jobs)
3.  `npm run dev` (Vite)

### Database Management

*   **Migration:** `php artisan migrate`
*   **Seeding:** `php artisan db:seed`
*   **Reset:** `php artisan migrate:fresh --seed`

### Discogs Integration

The application syncs with Discogs. Key commands:

```bash
php artisan discogs:populate      # Populate missing data
php artisan discogs:populate --force # Force update all
```
*Note: The populate command includes a 1.5s delay to respect Discogs API rate limits.*

## Coding Conventions

*   **PHP:** Follows Laravel standards (PSR-12). Use `laravel/pint` to fix style issues.
*   **CSS:** Use Tailwind CSS utility classes in Blade files.
*   **Livewire:** Use Livewire components for interactive UI elements instead of raw Vue/React/jQuery.

## Common Tasks

*   **Adding a new Feature:**
    1.  Create a Livewire component: `php artisan make:livewire FeatureName`
    2.  Define the view in `resources/views/livewire/feature-name.blade.php`
    3.  Add logic in `app/Livewire/FeatureName.php`
*   **Running Tests:**
    ```bash
    php artisan test
    ```
