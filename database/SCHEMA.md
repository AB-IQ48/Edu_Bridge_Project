# EduBridge — Complete MySQL Schema

This document describes the full relational schema for Users, Roles, Profiles, Documents, and Scores.

---

## Entity Relationship Overview

```
roles (1) ─────────────< users (N)
    │                        │
    │                        ├── assigned_counsellor_profile_id ──> counsellor_profiles (1)
    │                        │
    │                        ├── counsellor_profiles (0..1) [counsellor only]
    │                        ├── student_profiles (0..1) [student only]
    │                        ├── visa_scores (N) [student only]
    │                        └── student_documents (N) [student only]
    │
counsellor_profiles (1) ───< documents (N)  [counsellor verification docs]
counsellor_profiles (1) ───< users (N)        [assigned students]
```

---

## Tables

### 1. `roles`

| Column     | Type         | Attributes        | Description        |
|-----------|--------------|-------------------|--------------------|
| id        | BIGINT UNSIGNED | PK, AUTO_INCREMENT | Primary key        |
| name      | VARCHAR(50)  | UNIQUE, NOT NULL  | Role name (e.g. student, counsellor, administrator) |
| created_at | TIMESTAMP   | NULL              | Created at         |
| updated_at | TIMESTAMP   | NULL              | Updated at         |

**Indexes:** PRIMARY (id), UNIQUE (name)

---

### 2. `users`

| Column                         | Type             | Attributes        | Description                    |
|--------------------------------|------------------|-------------------|--------------------------------|
| id                             | BIGINT UNSIGNED  | PK, AUTO_INCREMENT | Primary key                    |
| role_id                        | BIGINT UNSIGNED  | FK, NOT NULL      | References roles.id            |
| assigned_counsellor_profile_id | BIGINT UNSIGNED  | FK, NULL          | References counsellor_profiles.id (students only) |
| name                           | VARCHAR(255)     | NOT NULL          | Full name                      |
| email                          | VARCHAR(255)     | UNIQUE, NOT NULL  | Email address                  |
| email_verified_at               | TIMESTAMP        | NULL              | Email verification timestamp   |
| password                       | VARCHAR(255)     | NOT NULL          | Hashed password                |
| remember_token                 | VARCHAR(100)     | NULL              | Remember me token              |
| created_at                     | TIMESTAMP        | NULL              | Created at                     |
| updated_at                     | TIMESTAMP        | NULL              | Updated at                     |

**Indexes:** PRIMARY (id), UNIQUE (email), INDEX (role_id), INDEX (assigned_counsellor_profile_id)  
**Foreign keys:** role_id → roles(id), assigned_counsellor_profile_id → counsellor_profiles(id) ON DELETE SET NULL

---

### 3. `counsellor_profiles` (Profiles — Counsellor)

| Column               | Type             | Attributes        | Description                    |
|----------------------|------------------|-------------------|--------------------------------|
| id                   | BIGINT UNSIGNED  | PK, AUTO_INCREMENT | Primary key                    |
| user_id              | BIGINT UNSIGNED  | FK, UNIQUE, NOT NULL | References users.id (one profile per user) |
| organization_name     | VARCHAR(255)     | NOT NULL          | Company / agency name          |
| experience_years     | SMALLINT UNSIGNED| DEFAULT 0         | Years of experience            |
| verification_status  | ENUM             | DEFAULT 'pending' | pending, approved, rejected     |
| created_at           | TIMESTAMP        | NULL              | Created at                     |
| updated_at           | TIMESTAMP        | NULL              | Updated at                     |

**Indexes:** PRIMARY (id), UNIQUE (user_id)  
**Foreign keys:** user_id → users(id) ON DELETE CASCADE

---

### 4. `student_profiles` (Profiles — Student)

| Column           | Type             | Attributes        | Description                    |
|------------------|------------------|-------------------|--------------------------------|
| id               | BIGINT UNSIGNED  | PK, AUTO_INCREMENT | Primary key                    |
| user_id          | BIGINT UNSIGNED  | FK, UNIQUE, NOT NULL | References users.id           |
| intended_country | VARCHAR(100)     | NULL              | Target study destination       |
| degree_level     | VARCHAR(50)      | NULL              | e.g. undergraduate, postgraduate |
| notes            | TEXT             | NULL              | Additional profile notes        |
| created_at       | TIMESTAMP        | NULL              | Created at                     |
| updated_at       | TIMESTAMP        | NULL              | Updated at                     |

**Indexes:** PRIMARY (id), UNIQUE (user_id)  
**Foreign keys:** user_id → users(id) ON DELETE CASCADE

---

### 5. `documents` (Counsellor verification documents)

| Column                 | Type             | Attributes        | Description                    |
|------------------------|------------------|-------------------|--------------------------------|
| id                     | BIGINT UNSIGNED  | PK, AUTO_INCREMENT | Primary key                    |
| counsellor_profile_id   | BIGINT UNSIGNED  | FK, NOT NULL      | References counsellor_profiles.id |
| document_name          | VARCHAR(255)     | NOT NULL          | Display name of document      |
| document_path          | VARCHAR(500)     | NOT NULL          | Storage path (e.g. local disk) |
| status                 | ENUM             | DEFAULT 'pending' | pending, approved, rejected   |
| created_at             | TIMESTAMP        | NULL              | Created at                     |
| updated_at             | TIMESTAMP        | NULL              | Updated at                     |

**Indexes:** PRIMARY (id), INDEX (counsellor_profile_id)  
**Foreign keys:** counsellor_profile_id → counsellor_profiles(id) ON DELETE CASCADE

---

### 6. `student_documents` (Student-uploaded documents)

| Column       | Type             | Attributes        | Description                    |
|--------------|------------------|-------------------|--------------------------------|
| id           | BIGINT UNSIGNED  | PK, AUTO_INCREMENT | Primary key                    |
| user_id      | BIGINT UNSIGNED  | FK, NOT NULL      | References users.id (student)  |
| document_name| VARCHAR(255)     | NOT NULL          | Display name                   |
| document_path| VARCHAR(500)     | NOT NULL          | Storage path                   |
| document_type| VARCHAR(50)      | NULL              | e.g. transcript, financial_proof, passport |
| status       | ENUM             | DEFAULT 'pending' | pending, approved, rejected   |
| created_at   | TIMESTAMP        | NULL              | Created at                     |
| updated_at   | TIMESTAMP        | NULL              | Updated at                     |

**Indexes:** PRIMARY (id), INDEX (user_id)  
**Foreign keys:** user_id → users(id) ON DELETE CASCADE

---

### 7. `visa_scores` (Scores)

| Column             | Type             | Attributes        | Description                    |
|--------------------|------------------|-------------------|--------------------------------|
| id                 | BIGINT UNSIGNED  | PK, AUTO_INCREMENT | Primary key                    |
| student_id         | BIGINT UNSIGNED  | FK, NOT NULL      | References users.id            |
| education_score    | TINYINT UNSIGNED | DEFAULT 0         | Academic eligibility (0–100)   |
| financial_score    | TINYINT UNSIGNED | DEFAULT 0         | Financial proof (0–100)       |
| documentation_score| TINYINT UNSIGNED | DEFAULT 0         | Document completeness (0–100) |
| total_score        | TINYINT UNSIGNED | DEFAULT 0         | Overall visa readiness (0–100) |
| created_at         | TIMESTAMP        | NULL              | Created at                     |
| updated_at         | TIMESTAMP        | NULL              | Updated at                     |

**Indexes:** PRIMARY (id), INDEX (student_id)  
**Foreign keys:** student_id → users(id) ON DELETE CASCADE

---

## Summary

| Table               | Purpose                                      |
|---------------------|----------------------------------------------|
| roles               | User roles (student, counsellor, administrator) |
| users               | All users; links to role and optional assigned counsellor |
| counsellor_profiles | One per counsellor user; org, experience, verification |
| student_profiles    | One per student user; intended country, degree level |
| documents           | Files uploaded by counsellors (verification) |
| student_documents   | Files uploaded by students (applications)    |
| visa_scores         | Visa readiness scores per student            |

All tables use `created_at` and `updated_at` timestamps. Foreign keys enforce referential integrity; cascades are used where appropriate (e.g. delete user → delete their profiles and scores).
