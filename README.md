# Elometrics

Elometrics is a web application for organizing chess training. Coaches can manage workspaces, students, and training sessions, and share access with other users through workspace roles.

## Features

### Welcome page and authentication

- Simple welcome page with the application name and links to log in or register.
- Signed-in users can access their workspaces from the welcome page.
- User registration and login.
- Unique usernames to identify users when adding workspace members.

### Workspaces

- Create, view, edit, and delete workspaces.
- Organize workspaces by status: active, paused, or archived.
- View owned workspaces separately from shared workspaces.
- Show the number of students in each workspace.
- Paginate the workspace list.

### Workspace membership

- Owners can add registered users by username and assign a role.
- Owners can remove members.
- Members can leave a workspace.
- Access and actions are controlled by workspace permissions.
- Available member roles are defined in a PHP enum and displayed with Spanish labels.

Membership is assigned directly; there is currently no pending invitation or acceptance flow. The owner is stored separately from the workspace members.

| Role | View workspace | Manage training sessions | Manage members | Edit or delete workspace |
| --- | --- | --- | --- | --- |
| Owner | Yes | Yes | Yes | Yes |
| Coach | Yes | Yes | No | No |
| Student | Yes | No | No | No |
| Viewer | Yes | No | No | No |

### Students

- Add students to a workspace.
- List and remove students.
- Student records are currently separate from registered user accounts.

The Student membership role grants workspace access to a registered user; it does not automatically link that user to a student record.

### Training sessions

- Create, view, edit, and delete training sessions.
- Store a title, scheduled date and time, optional notes, and an optional link.
- Assign a category: tactics, strategy, openings, endgames, or games.
- Track session status: pending, completed, or cancelled.

## Tech stack

- PHP and Laravel 13
- Blade and Livewire
- Laravel Breeze for authentication
- Tailwind CSS
- MySQL for application data
- Pest for automated tests
- Composer and npm for dependency management

## Local installation

### Requirements

- PHP and the extensions required by the project's `composer.json`
- Composer
- Node.js and npm compatible with the project's frontend dependencies
- MySQL
- Git

### 1. Clone the repository

The current development version is available on the `dev` branch.

```bash
git clone --branch dev https://github.com/imjrbarreto/elometrics.git
cd elometrics
```

### 2. Install dependencies

```bash
composer install
npm install
```

### 3. Configure the environment

```bash
cp .env.example .env
php artisan key:generate
```

Create a MySQL database named `elometrics` and update the database settings in `.env` with your local credentials:

```dotenv
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=elometrics
DB_USERNAME=your_database_user
DB_PASSWORD=your_database_password
```

### 4. Run migrations

```bash
php artisan migrate
```

### 5. Start the application

Start the development environment:

```bash
composer run dev
```

Open [http://localhost:8000](http://localhost:8000) in your browser and register an account.


## Planned improvements

- Add workspace tasks and student interaction.
- Add workspace goals.
- Store chess positions (FEN) and games (PGN) for sessions and tasks.
- Display positions and games using an interactive chessboard.
