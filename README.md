# DeviceHub - Community Resource Sharing Platform

## Overview
DeviceHub is a platform that connects people, enabling users to share and borrow devices and equipment easily. The application supports device management, studio management, reservations, and loans, while offering a dashboard for users to manage their interactions efficiently.

---

## Key Features
- **Device Management**: Add, update, and manage devices and their types.
- **Studios Management**: Manage studios with details and images.
- **Reservations**: Create and manage reservations for available devices or studios.
- **Loans**: Create and track the status of borrowed devices.
- **Dashboard**: Overview of key statistics and quick actions.
- **Community**: Promotes sharing resources and collaboration.

---

## Installation
1. Clone the repository: `git clone <repository-url>`
2. Navigate to the project directory: `cd DeviceHub`
3. Install dependencies: `composer install && npm install`
4. Set up the `.env` file with your database and app configurations.
5. Run migrations: `php artisan migrate`
6. Start the application: `php artisan serve`

---

## Directory Structure

- **`app/`**: Core application logic.
- **`resources/views/`**: Blade templates for frontend pages.
  - **`devices/`**: Views related to device management (authored by Anna Shevchenko).
  - **`device-types/`**: Views for device type management (authored by Anna Shevchenko).
  - **`loans/`**: Views for loan management (authored by Anna Shevchenko).
  - **`dashboard.blade.php`**: Dashboard page (authored by Anna Shevchenko).
  - **`studios/`**: Views for studio management (authored by Veronika Novikova).
  - **`reservations/`**: Views for reservation management (authored by Veronika Novikova).
  - **`home.blade.php`**: Home page layout and content (authored by Veronika Novikova).
- **`public/`**: Public assets such as images, CSS, and JS.
- **`routes/`**: Defines all application routes.
  - **`web.php`**: Key routes for web views.
- **`database/migrations/`**: Database schema definitions.

---

## Authors
- **Anna Shevchenko**: Devices, Device Types, Loans, Dashboard Pages
- **Veronika Novikova**: Studios, Reservations, Home Pages

---

## License
This project is licensed under the MIT License. See the `LICENSE` file for details.
