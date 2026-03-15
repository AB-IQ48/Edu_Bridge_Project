# Admin Dashboard — Login & Redirect

## First-time setup (run this first)

The database must have all tables before you can seed admin users. Run migrations, then the seeder:

```bash
php artisan migrate
php artisan db:seed --class=AdminUserSeeder
```

**Order matters:** run `migrate` first, then `db:seed`. If you run the seeder without migrating, you will get:

`Table 'laravel.roles' doesn't exist`

That means the `roles` table (and likely others) have not been created yet. Fix it by running:

```bash
php artisan migrate
```

Then run the admin seeder again.

---

## How to reach the admin dashboard

1. **After login**  
   Log in at **`/login`** with an administrator account. You are automatically redirected to **`/admin`** (admin dashboard).

2. **From the main site**  
   When logged in as an administrator, the header shows an **Admin** link. Click it to go to **`/admin`**.

3. **Direct URL**  
   Open **`/admin`** in the browser. You must be logged in as an administrator, or you will be sent to the login page.

4. **From the main Dashboard**  
   If you go to **`/dashboard`** as an admin, you are automatically redirected to **`/admin`**.

---

## Dummy admin logins

Seed the database so these accounts exist:

```bash
php artisan migrate
php artisan db:seed --class=AdminUserSeeder
```

If you already ran the seeder before but login fails (e.g. "Invalid email or password"), run the seeder again to reset admin passwords:

```bash
php artisan db:seed --class=AdminUserSeeder
```

Then use any of these to log in at **`/login`**:

| Email                   | Password  |
|-------------------------|-----------|
| admin@edubridge.com     | password  |
| admin2@edubridge.com    | admin123  |
| admin@edubridge.local   | password  |

After login you will be redirected to the admin dashboard at **`/admin`**.

---

## Troubleshooting

### "Table 'laravel.roles' doesn't exist"

Your database has no tables yet (or the project is using the default `laravel` database). Do this:

1. **Create the database** (if needed) in MySQL:
   - Open phpMyAdmin or MySQL CLI.
   - Create a database, e.g. `laravel` or `edubridge`.

2. **Set your database in `.env`:**
   ```env
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=laravel
   DB_USERNAME=root
   DB_PASSWORD=
   ```
   Use the database name you created.

3. **Run migrations** to create all tables (`users`, `roles`, `counsellor_profiles`, etc.):
   ```bash
   php artisan migrate
   ```

4. **Then seed admin users:**
   ```bash
   php artisan db:seed --class=AdminUserSeeder
   ```
