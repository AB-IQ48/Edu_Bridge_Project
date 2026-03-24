-- EduBridge — MySQL Schema Reference
-- This file is for documentation/reference only. Do not run as-is (table order and FKs
-- depend on Laravel migration order). Use: php artisan migrate

-- =============================================================================
-- ROLES
-- =============================================================================
CREATE TABLE roles (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(50) NOT NULL UNIQUE,
    created_at TIMESTAMP NULL,
    updated_at TIMESTAMP NULL
);

-- =============================================================================
-- USERS
-- =============================================================================
CREATE TABLE users (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    role_id BIGINT UNSIGNED NOT NULL,
    assigned_counsellor_profile_id BIGINT UNSIGNED NULL,
    name VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL UNIQUE,
    email_verified_at TIMESTAMP NULL,
    password VARCHAR(255) NOT NULL,
    remember_token VARCHAR(100) NULL,
    created_at TIMESTAMP NULL,
    updated_at TIMESTAMP NULL,
    INDEX (role_id),
    INDEX (assigned_counsellor_profile_id),
    FOREIGN KEY (role_id) REFERENCES roles(id),
    FOREIGN KEY (assigned_counsellor_profile_id) REFERENCES counsellor_profiles(id) ON DELETE SET NULL
);

-- =============================================================================
-- COUNSELLOR PROFILES
-- =============================================================================
CREATE TABLE counsellor_profiles (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    user_id BIGINT UNSIGNED NOT NULL UNIQUE,
    organization_name VARCHAR(255) NOT NULL,
    experience_years SMALLINT UNSIGNED DEFAULT 0,
    verification_status ENUM('pending', 'approved', 'rejected') DEFAULT 'pending',
    created_at TIMESTAMP NULL,
    updated_at TIMESTAMP NULL,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);

-- =============================================================================
-- STUDENT PROFILES
-- =============================================================================
CREATE TABLE student_profiles (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    user_id BIGINT UNSIGNED NOT NULL UNIQUE,
    intended_country VARCHAR(100) NULL,
    degree_level VARCHAR(50) NULL,
    notes TEXT NULL,
    created_at TIMESTAMP NULL,
    updated_at TIMESTAMP NULL,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);

-- =============================================================================
-- DOCUMENTS (Counsellor verification)
-- =============================================================================
CREATE TABLE documents (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    counsellor_profile_id BIGINT UNSIGNED NOT NULL,
    document_name VARCHAR(255) NOT NULL,
    document_path VARCHAR(500) NOT NULL,
    status ENUM('pending', 'approved', 'rejected') DEFAULT 'pending',
    created_at TIMESTAMP NULL,
    updated_at TIMESTAMP NULL,
    INDEX (counsellor_profile_id),
    FOREIGN KEY (counsellor_profile_id) REFERENCES counsellor_profiles(id) ON DELETE CASCADE
);

-- =============================================================================
-- STUDENT DOCUMENTS
-- =============================================================================
CREATE TABLE student_documents (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    user_id BIGINT UNSIGNED NOT NULL,
    document_name VARCHAR(255) NOT NULL,
    document_path VARCHAR(500) NOT NULL,
    document_type VARCHAR(50) NULL,
    status ENUM('pending', 'approved', 'rejected') DEFAULT 'pending',
    created_at TIMESTAMP NULL,
    updated_at TIMESTAMP NULL,
    INDEX (user_id),
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);

-- =============================================================================
-- VISA SCORES
-- =============================================================================
CREATE TABLE visa_scores (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    student_id BIGINT UNSIGNED NOT NULL,
    education_score TINYINT UNSIGNED DEFAULT 0,
    financial_score TINYINT UNSIGNED DEFAULT 0,
    documentation_score TINYINT UNSIGNED DEFAULT 0,
    total_score TINYINT UNSIGNED DEFAULT 0,
    created_at TIMESTAMP NULL,
    updated_at TIMESTAMP NULL,
    INDEX (student_id),
    FOREIGN KEY (student_id) REFERENCES users(id) ON DELETE CASCADE
);

-- Note: In a real DB, users.assigned_counsellor_profile_id references counsellor_profiles,
-- so counsellor_profiles must be created before adding that FK to users. Laravel migrations
-- handle this order.
