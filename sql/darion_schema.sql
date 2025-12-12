-- darion_schema.sql
CREATE DATABASE IF NOT EXISTS darion_finance CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE darion_finance;

-- USERS
CREATE TABLE users (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(150) NOT NULL,
  email VARCHAR(255) UNIQUE,
  phone VARCHAR(20) NOT NULL,
  password VARCHAR(255) NOT NULL,
  role ENUM('user','admin') DEFAULT 'user',
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;

-- CONSENT LOGS
CREATE TABLE consent_logs (
  id INT AUTO_INCREMENT PRIMARY KEY,
  user_id INT NOT NULL,
  consent_text TEXT NOT NULL,
  consent_type VARCHAR(50),
  accepted_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  ip_address VARCHAR(45),
  FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
) ENGINE=InnoDB;

-- LOAN APPLICATIONS
CREATE TABLE loan_applications (
  id INT AUTO_INCREMENT PRIMARY KEY,
  user_id INT NOT NULL,
  loan_type VARCHAR(100),
  requested_amount DECIMAL(14,2),
  business_name VARCHAR(255),
  status ENUM('submitted','documents_verified','missing_documents','processing','sent_to_ruloans','sent_to_bank','sanctioned','rejected') DEFAULT 'submitted',
  ruloans_ref VARCHAR(255) DEFAULT NULL,
  sanctioned_amount DECIMAL(14,2) DEFAULT NULL,
  remarks TEXT,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  updated_at TIMESTAMP NULL,
  FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
) ENGINE=InnoDB;

-- DOCUMENTS
CREATE TABLE loan_documents (
  id INT AUTO_INCREMENT PRIMARY KEY,
  application_id INT NOT NULL,
  doc_type VARCHAR(100),
  file_path VARCHAR(500),
  uploaded_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  verified TINYINT(1) DEFAULT 0,
  FOREIGN KEY (application_id) REFERENCES loan_applications(id) ON DELETE CASCADE
) ENGINE=InnoDB;

-- STATUS UPDATES
CREATE TABLE status_updates (
  id INT AUTO_INCREMENT PRIMARY KEY,
  application_id INT NOT NULL,
  old_status VARCHAR(100),
  new_status VARCHAR(100),
  changed_by INT NULL, -- admin user id
  note TEXT,
  changed_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (application_id) REFERENCES loan_applications(id) ON DELETE CASCADE
) ENGINE=InnoDB;

-- COMMISSION PAYMENTS
CREATE TABLE commission_payments (
  id INT AUTO_INCREMENT PRIMARY KEY,
  application_id INT NOT NULL,
  user_id INT NOT NULL,
  sanctioned_amount DECIMAL(14,2),
  commission_amount DECIMAL(14,2),
  paid TINYINT(1) DEFAULT 0,
  payment_gateway VARCHAR(50) DEFAULT NULL,
  payment_reference VARCHAR(255) DEFAULT NULL,
  paid_at TIMESTAMP NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (application_id) REFERENCES loan_applications(id) ON DELETE CASCADE,
  FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
) ENGINE=InnoDB;

-- ADMIN USERS
INSERT INTO users (name,email,phone,password,role) VALUES ('Admin','admin@darion.local','0000000000', '$2y$10$EXAMPLE_HASH_REPLACE', 'admin');

-- ACTIVITY LOGS
CREATE TABLE activity_logs (
  id INT AUTO_INCREMENT PRIMARY KEY,
  user_id INT NULL,
  action VARCHAR(255),
  details TEXT,
  ip_address VARCHAR(45),
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;


ALTER TABLE users 
ADD COLUMN email_verified TINYINT(1) DEFAULT 0,
ADD COLUMN email_otp VARCHAR(10) DEFAULT NULL,
ADD COLUMN otp_expires_at DATETIME NULL;

CREATE TABLE support_messages (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    name VARCHAR(255),
    email VARCHAR(255),
    message TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);


ALTER TABLE loan_documents
ADD COLUMN tenure INT NULL,
ADD COLUMN purpose VARCHAR(255) NULL,

-- Personal loan specific
ADD COLUMN salary_account VARCHAR(100) NULL,

-- Business loan fields
ADD COLUMN business_name VARCHAR(255) NULL,
ADD COLUMN udyam_number VARCHAR(50) NULL,
ADD COLUMN gst_number VARCHAR(50) NULL,
ADD COLUMN business_age INT NULL,

-- Education loan fields
ADD COLUMN institute_name VARCHAR(255) NULL,
ADD COLUMN course_name VARCHAR(255) NULL,
ADD COLUMN course_duration INT NULL,
ADD COLUMN student_id VARCHAR(100) NULL,

-- Two Wheeler Loan
ADD COLUMN vehicle_brand VARCHAR(100) NULL,
ADD COLUMN vehicle_model VARCHAR(100) NULL,
ADD COLUMN vehicle_number VARCHAR(100) NULL,
ADD COLUMN vehicle_type VARCHAR(50) NULL,

-- Re-loan fields
ADD COLUMN previous_loan_number VARCHAR(100) NULL,
ADD COLUMN previous_lender VARCHAR(255) NULL,
ADD COLUMN previous_loan_amount DECIMAL(12,2) NULL,
ADD COLUMN repayment_history VARCHAR(50) NULL,

-- Loan Against Property
ADD COLUMN property_type VARCHAR(50) NULL,
ADD COLUMN property_address TEXT NULL,
ADD COLUMN property_value VARCHAR(50) NULL,
ADD COLUMN property_ownership VARCHAR(50) NULL,

-- Personal details
ADD COLUMN full_name VARCHAR(255) NULL,
ADD COLUMN user_email VARCHAR(255) NULL,
ADD COLUMN phone VARCHAR(20) NULL,
ADD COLUMN dob DATE NULL,

-- Employment details
ADD COLUMN employment_type VARCHAR(50) NULL,
ADD COLUMN monthly_income DECIMAL(12,2) NULL,
ADD COLUMN company_name VARCHAR(255) NULL;
