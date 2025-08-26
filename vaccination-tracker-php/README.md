# Vaccination Tracker (PHP + SQLite)

Three panels: **Patient**, **Healthcare**, **Admin**.

## Quick Start
1. Put this folder in your PHP server (XAMPP `htdocs`, etc.).
2. Open `/public/` in browser, e.g. `http://localhost/vaccination-tracker-php/public/`.
3. On first run, SQLite DB is created automatically with seed data.

### Default Accounts
- Admin: `admin@example.com` / `admin123`
- Healthcare: `nurse@example.com` / `nurse123`

Patients should register via `/public/register.php`.

## Features
- Patient: register/login, dashboard of doses, change hospital for scheduled dose, demo scheduler.
- Healthcare: dashboard shows stock at assigned hospital, record vaccinations (deducts stock), today's report.
- Admin: manage hospitals, vaccines, user roles, assign hospitals.

## Notes
- Uses SQLite by default (`data/app.db`). No external DB setup required.
- CSRF protection on POST actions, session-based auth.
- Bootstrap 5 UI from CDN.
