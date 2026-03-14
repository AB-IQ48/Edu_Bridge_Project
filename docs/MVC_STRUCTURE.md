# EduBridge — Laravel MVC Base Structure

This document describes the Model–View–Controller layout for the application, aligned with the schema in `database/SCHEMA.md`.

---

## 1. Models (M)

All models live in `app/Models/`. They map to the MySQL tables and define relationships.

| Model | Table | Description |
|-------|--------|--------------|
| **Role** | `roles` | User roles (student, counsellor, administrator). |
| **User** | `users` | Authenticated users; belongs to Role, optional CounsellorProfile / StudentProfile and assigned CounsellorProfile. |
| **CounsellorProfile** | `counsellor_profiles` | One per counsellor user; has many Documents and assigned Students. |
| **StudentProfile** | `student_profiles` | One per student user; intended country, degree level, notes. |
| **Document** | `documents` | Counsellor-uploaded verification documents; belongs to CounsellorProfile. |
| **StudentDocument** | `student_documents` | Student-uploaded documents; belongs to User (student). |
| **VisaScore** | `visa_scores` | Visa readiness scores; belongs to User (student). |

### Key relationships

- **User** → `role()`, `counsellorProfile()`, `studentProfile()`, `visaScores()`, `assignedCounsellorProfile()`, `studentDocuments()`
- **CounsellorProfile** → `user()`, `documents()`, `assignedStudents()`
- **StudentProfile** → `user()`
- **Document** → `counsellorProfile()`
- **StudentDocument** → `user()`
- **VisaScore** → `student()`
- **Role** → `users()`

---

## 2. Controllers (C)

Controllers are in `app/Http/Controllers/` and `app/Http/Controllers/Auth/`.

| Controller | Purpose | Main actions |
|------------|---------|--------------|
| **Auth\LoginController** | Login / logout | `create`, `store`, `destroy` |
| **Auth\RegisterStudentController** | Student registration | `create`, `store` |
| **Auth\RegisterCompanyController** | Counsellor (company) registration | `create`, `store` |
| **DashboardController** | Post-login redirect by role | `__invoke` |
| **AdminController** | Admin panel; review profiles & documents | `index`, `reviewProfile`, `reviewDocument` |
| **CounsellorController** | Counsellor dashboard and profile | `index`, `edit`, `update` |
| **CounsellorListingController** | Public list of verified counsellors; student attach/detach | `index`, `attach`, `detach` |
| **DocumentController** | Counsellor documents (resource) | `index`, `create`, `store`, `show` |
| **ScoreController** | Student visa scores (resource) | `index`, `create`, `store`, `show` |
| **StudentController** | Student dashboard and profile | `index`, `profile` |

---

## 3. Views (V)

Views are in `resources/views/`, organised by feature. Layouts and shared components are in `resources/views/layout/`.

### Layouts

- **layout/header.blade.php** — Main app layout (header, nav, footer, styles).
- **layout/auth.blade.php** — Auth pages layout (login, register).

### Public / marketing

- **index.blade.php** — Homepage (hero, how it works, verification, visa readiness, testimonials, FAQ, CTA).
- **pages/how-it-works.blade.php**, **verification.blade.php**, **visa-readiness.blade.php**, **for-you.blade.php**, **faq.blade.php** — Info pages.

### Auth

- **auth/login.blade.php**
- **auth/register_student.blade.php**, **auth/register_company.blade.php**

### Dashboard & role-specific

- **dashboard.blade.php** — Role-based redirect.
- **admin/index.blade.php** — Admin review queue.
- **counsellor/index.blade.php**, **counsellor/edit.blade.php** — Counsellor dashboard and profile edit.
- **student/index.blade.php**, **student/profile.blade.php** — Student dashboard and profile.
- **counsellors/listing.blade.php** — Verified counsellors list and attach/detach.

### Documents & scores

- **documents/index.blade.php**, **documents/create.blade.php**, **documents/show.blade.php**
- **scores/index.blade.php**, **scores/create.blade.php**, **scores/show.blade.php**

---

## 4. Routes (web.php)

Summary of named routes and middleware.

| Method | URI | Name | Middleware |
|--------|-----|------|------------|
| GET | `/` | — | — |
| GET | `/how-it-works` | pages.how-it-works | — |
| GET | `/verification` | pages.verification | — |
| GET | `/visa-readiness` | pages.visa-readiness | — |
| GET | `/for-you` | pages.for-you | — |
| GET | `/faq` | pages.faq | — |
| GET | `/counsellors` | counsellors.index | — |
| POST | `/counsellors/detach` | counsellors.detach | auth |
| POST | `/counsellors/{counsellorProfile}/attach` | counsellors.attach | auth |
| GET | `/login` | login | guest |
| POST | `/login` | login.store | guest |
| GET | `/register/student` | register.student | guest |
| POST | `/register/student` | register.student.store | guest |
| GET | `/register/company` | register.company | guest |
| POST | `/register/company` | register.company.store | guest |
| POST | `/logout` | logout | auth |
| GET | `/dashboard` | dashboard | auth |
| GET | `/admin` | admin.index | auth, role:administrator |
| POST | `/admin/profiles/{counsellorProfile}/review` | admin.profiles.review | auth, role:administrator |
| POST | `/admin/documents/{document}/review` | admin.documents.review | auth, role:administrator |
| GET | `/counsellor` | counsellor.index | auth, role:counsellor |
| GET | `/counsellor/profile/edit` | counsellor.profile.edit | auth, role:counsellor |
| PUT | `/counsellor/profile` | counsellor.profile.update | auth, role:counsellor |
| GET/POST etc. | `/documents` (resource) | documents.* | auth, role:counsellor |
| GET | `/student` | student.index | auth, role:student |
| GET | `/student/profile` | student.profile | auth, role:student |
| GET/POST/GET | `/scores`, `/scores/create`, `/scores/{score}` | scores.* | auth, role:student |

---

## 5. Middleware

- **auth** — Require authenticated user.
- **guest** — Redirect authenticated users away from login/register.
- **role:administrator | counsellor | student** — `EnsureUserHasRole` (or equivalent); restrict by role.

---

## 6. Directory layout (relevant parts)

```
app/
├── Http/
│   ├── Controllers/
│   │   ├── Auth/
│   │   │   ├── LoginController.php
│   │   │   ├── RegisterCompanyController.php
│   │   │   └── RegisterStudentController.php
│   │   ├── AdminController.php
│   │   ├── CounsellorController.php
│   │   ├── CounsellorListingController.php
│   │   ├── DocumentController.php
│   │   ├── ScoreController.php
│   │   ├── StudentController.php
│   │   └── DashboardController.php
│   └── Middleware/
│       └── EnsureUserHasRole.php
├── Models/
│   ├── Role.php
│   ├── User.php
│   ├── CounsellorProfile.php
│   ├── StudentProfile.php
│   ├── Document.php
│   ├── StudentDocument.php
│   └── VisaScore.php
database/
├── migrations/
│   ├── ..._create_users_table.php
│   ├── ..._create_roles_table.php
│   ├── ..._add_role_id_to_users_table.php
│   ├── ..._create_counsellor_profiles_table.php
│   ├── ..._add_assigned_counsellor_to_users_table.php
│   ├── ..._create_documents_table.php
│   ├── ..._create_visa_scores_table.php
│   ├── ..._create_student_profiles_table.php
│   └── ..._create_student_documents_table.php
├── seeders/
└── SCHEMA.md
docs/
└── MVC_STRUCTURE.md  (this file)
resources/
└── views/
    ├── layout/
    ├── auth/
    ├── pages/
    ├── admin/
    ├── counsellor/
    ├── counsellors/
    ├── student/
    ├── documents/
    ├── scores/
    ├── index.blade.php
    └── dashboard.blade.php
routes/
└── web.php
```

This is the Laravel MVC base structure for EduBridge, aligned with the MySQL schema (Users, Roles, Profiles, Documents, Scores).
