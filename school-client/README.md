# School Client – Laravel SPA

Client Laravel SPA per a l'API **school-ddd** (PHP · DDD · REST).

## Funcionalitats

- **OAuth 2.0** via GitHub o Google (Laravel Socialite)
- **CRUD complet** de Teachers, Students i Subjects
- **Assign teacher** a una subject
- **Dashboard** amb resum de dades
- **Tests de funcionalitat** dels endpoints de l'API

---

## Requisits

- PHP 8.2+
- Composer
- L'API `school-ddd` en marxa (per defecte a `http://localhost:8000`)
- Una **GitHub OAuth App** o **Google OAuth App**

---

## Instal·lació pas a pas

### 1. Clonar i instal·lar dependències

```bash
git clone https://github.com/el-teu-usuari/school-client.git
cd school-client
composer install
```

### 2. Configurar l'entorn

```bash
cp .env.example .env
php artisan key:generate
```

Editar `.env`:

```env
API_BASE_URL=http://localhost:8000   # URL de l'API school-ddd

GITHUB_CLIENT_ID=xxx
GITHUB_CLIENT_SECRET=xxx
GITHUB_REDIRECT_URI=http://localhost:8001/auth/github/callback
```

### 3. Base de dades (SQLite – només per sessions)

```bash
touch database/database.sqlite
php artisan migrate
```

### 4. Arrancar el servidor

```bash
php artisan serve --port=8001
```

Obre http://localhost:8001

---

## Crear l'OAuth App a GitHub

1. Ves a https://github.com/settings/developers
2. "New OAuth App"
3. **Homepage URL**: `http://localhost:8001`
4. **Callback URL**: `http://localhost:8001/auth/github/callback`
5. Copia el Client ID i genera el Client Secret → posa'ls al `.env`

---

## Executar els tests

```bash
# Requereix que l'API school-ddd estigui en marxa
php artisan test --filter ApiEndpointsTest
```

Sortida esperada:

```
PASS  Tests\Feature\ApiEndpointsTest
✓ it gets all teachers
✓ it creates a teacher
✓ it gets a single teacher
✓ it updates a teacher
✓ it deletes a teacher
✓ it gets all students
✓ it creates a student
✓ it gets a single student
✓ it updates a student
✓ it deletes a student
✓ it gets all subjects
✓ it creates a subject
✓ it gets a single subject
✓ it updates a subject
✓ it assigns a teacher to a subject
✓ it deletes a subject
```

---

## Estructura de commits (GitHub)

```
feat: setup Laravel project and OAuth dependencies
feat: OAuth authentication via GitHub and Google (Socialite)
feat: ApiService HTTP client connected to school-ddd API
feat: teachers CRUD – controller, routes and Blade views
feat: students CRUD – controller, routes and Blade views
feat: subjects CRUD with teacher assignment
test: feature tests for all API endpoints (teachers, students, subjects)
```

---

## Estructura del projecte

```
app/
├── Http/Controllers/
│   ├── AuthController.php       ← OAuth login/callback/logout
│   ├── DashboardController.php
│   ├── TeacherController.php
│   ├── StudentController.php
│   └── SubjectController.php
├── Models/User.php              ← Model amb camps OAuth
├── Services/ApiService.php      ← HTTP Client → school-ddd API
└── Providers/AppServiceProvider.php

routes/web.php                   ← Totes les rutes
resources/views/
├── layouts/app.blade.php
├── welcome.blade.php
├── dashboard.blade.php
├── teachers/{index,create,show,edit}.blade.php
├── students/{index,create,show,edit}.blade.php
└── subjects/{index,create,show,edit}.blade.php

tests/Feature/ApiEndpointsTest.php   ← Tests d'integració
```
