<?php
if (!isset($_SESSION["user_id"])) {
    header("Location: index.php?page=login");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Apply Loan - Darion Finance</title>

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- DARION DASHBOARD FONT -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@200;300;400;500;600&display=swap" rel="stylesheet">

    <!-- Custom Tailwind Config with Darion Colors -->
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        'inter': ['Inter', 'sans-serif'],
                    },
                    colors: {
                        'darion-bg': '#090c10',
                        'darion-panel': '#161b22',
                        'darion-primary': '#2C7446',
                        'darion-primary-light': '#4a9e86',
                        'darion-slate': '#5e7a7d',
                        'darion-text': '#ffffff',
                        'darion-text-muted': '#8b949e',
                        'darion-gold': '#d4a94e',
                        'darion-red': '#c94646',
                        'darion-glass': 'rgba(22, 27, 34, 0.7)',
                        'darion-border': 'rgba(255, 255, 255, 0.1)',
                    },
                    borderRadius: {
                        'darion-lg': '16px',
                        'darion-sm': '8px',
                    },
                    backdropBlur: {
                        'darion': '10px',
                    }
                }
            }
        }
    </script>

    <!-- Custom CSS for Darion Effects -->
    <style>
        /* Darion Background Effects */
        .darion-bg-effect {
            background-color: #090c10;
            background-image: 
                radial-gradient(circle at 10% 20%, rgba(44, 116, 70, 0.15) 0%, transparent 40%),
                radial-gradient(circle at 90% 80%, rgba(94, 122, 125, 0.1) 0%, transparent 40%);
            min-height: 100vh;
        }

        /* Glassmorphism Effect */
        .glass-card {
            background: rgba(22, 27, 34, 0.7);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.1);
        }

        /* Logo Stipple Effect */
        .logo-stipple {
            width: 32px;
            height: 32px;
            border-radius: 50%;
            background: radial-gradient(circle, #fff 20%, transparent 21%), #161b22;
            background-size: 3px 3px;
            border: 1px solid rgba(255,255,255,0.3);
        }

        /* Input field styling */
        .darion-input {
            background: rgba(22, 27, 34, 0.5);
            border: 1px solid rgba(255, 255, 255, 0.1);
            color: #ffffff;
        }

        .darion-input:focus {
            outline: none;
            border-color: rgba(74, 158, 134, 0.5);
            box-shadow: 0 0 0 2px rgba(74, 158, 134, 0.2);
        }

        /* File input styling */
        .darion-file-input {
            background: rgba(22, 27, 34, 0.3);
            border: 2px dashed rgba(255, 255, 255, 0.1);
            transition: all 0.3s ease;
        }

        .darion-file-input:hover {
            border-color: rgba(74, 158, 134, 0.3);
            background: rgba(22, 27, 34, 0.4);
        }

        /* Custom placeholder color */
        .darion-input::placeholder {
            color: rgba(139, 148, 158, 0.5);
        }
    </style>
</head>

<body class="darion-bg-effect text-darion-text font-inter">

<!-- NAVBAR -->
<nav class="flex items-center justify-between px-6 py-4 bg-darion-panel/70 backdrop-blur-darion fixed top-0 left-0 right-0 z-50 border-b border-darion-border">
    <div class="flex items-center gap-3">
        <div class="logo-stipple"></div>
        <a href="index.php?page=dashboard" class="text-2xl font-light tracking-tight">Darion Finance</a>
    </div>

    <div class="hidden md:flex gap-6 font-medium">
        <a href="index.php?page=apply" class="px-4 py-2 rounded-darion-sm bg-darion-glass text-darion-primary-light border-l-2 border-darion-primary">
            Apply Loan
        </a>
        <a href="index.php?page=status" class="px-4 py-2 rounded-darion-sm hover:bg-darion-glass hover:text-darion-primary-light transition-colors">
            Loan Status
        </a>

        <form action="index.php?page=logout" method="POST" class="flex items-center">
            <input type="hidden" name="action" value="logout">
            <button class="px-4 py-2 rounded-darion-sm hover:bg-red-900/20 hover:text-red-300 text-darion-text-muted transition-colors">
                Logout
            </button>
        </form>
    </div>
</nav>

<div class="h-20"></div>

<!-- PAGE WRAPPER -->
<div class="max-w-4xl mx-auto px-4 py-10">

    <!-- Page Header -->
    <div class="mb-10">
        <div class="flex items-center justify-center gap-3 mb-4">
            <div class="w-12 h-12 bg-darion-primary/20 rounded-full flex items-center justify-center">
                <svg class="w-6 h-6 text-darion-primary-light" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v13m0-13V6a2 2 0 112 2h-2zm0 0V5.5A2.5 2.5 0 109.5 8H12zm-7 4h14M5 12a2 2 0 110-4h14a2 2 0 110 4M5 12v7a2 2 0 002 2h10a2 2 0 002-2v-7"></path>
                </svg>
            </div>
            <h1 class="text-4xl font-light text-center">Apply for Loan</h1>
        </div>
        
        <p class="text-darion-text-muted text-center max-w-2xl mx-auto">
            Complete the form below to submit your loan application. All fields marked with required documents are necessary for processing.
        </p>
    </div>

    <!-- ERROR MESSAGE -->
    <?php if (!empty($_SESSION["error"])): ?>
        <div class="bg-red-900/30 border-l-4 border-darion-red text-red-200 p-4 rounded-darion-sm mb-6">
            <?= $_SESSION["error"]; unset($_SESSION["error"]); ?>
        </div>
    <?php endif; ?>

    <!-- SUCCESS MESSAGE -->
    <?php if (!empty($_SESSION["success"])): ?>
        <div class="bg-darion-primary/20 border-l-4 border-darion-primary-light text-darion-primary-light p-4 rounded-darion-sm mb-6">
            <?= $_SESSION["success"]; unset($_SESSION["success"]); ?>
        </div>
    <?php endif; ?>

    <!-- APPLICATION FORM -->
    <div class="glass-card shadow-xl rounded-darion-lg p-8 border border-darion-border">
        <div class="flex items-center gap-3 mb-6">
            <div class="w-10 h-10 bg-darion-primary/20 rounded-full flex items-center justify-center">
                <svg class="w-5 h-5 text-darion-primary-light" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                </svg>
            </div>
            <h2 class="text-2xl font-medium">Loan Application Form</h2>
        </div>

        <form action="index.php?page=apply" method="POST" enctype="multipart/form-data" class="space-y-8" id="loanApplicationForm">
    <input type="hidden" name="action" value="apply_loan">

    <!-- LOAN TYPE -->
    <div class="space-y-3">
        <label class="font-medium text-darion-text-muted">Loan Type</label>
        <select name="loan_type" required id="loanTypeSelect"
                class="w-full px-4 py-3 darion-input rounded-darion-sm focus:outline-none focus:border-darion-primary/50 transition-colors">
            <option value="" disabled selected class="text-darion-text-muted">Select loan type</option>
            <option value="Personal Loan" class="text-darion-bg">Personal Loan</option>
            <option value="Business Loan" class="text-darion-bg">Business Loan</option>
            <option value="Education Loan" class="text-darion-bg">Education Loan</option>
            <option value="Two Wheeler Loan" class="text-darion-bg">Two Wheeler Loan</option>
            <option value="Re-Loan" class="text-darion-bg">Re-Loan</option>
            <option value="Loan Against Property" class="text-darion-bg">Loan Against Property</option>
        </select>
    </div>

    <!-- LOAN AMOUNT -->
    <div class="space-y-3">
        <label class="font-medium text-darion-text-muted">Requested Loan Amount</label>
        <div class="relative">
            <span class="absolute left-4 top-1/2 transform -translate-y-1/2 text-darion-text-muted">₹</span>
            <input type="number" name="amount" required min="10000"
                   class="w-full pl-10 pr-4 py-3 darion-input rounded-darion-sm focus:outline-none focus:border-darion-primary/50 transition-colors"
                   placeholder="Enter loan amount">
        </div>
        <p class="text-xs text-darion-text-muted">Minimum amount: ₹10,000</p>
    </div>

    <!-- TENURE -->
    <div class="space-y-3">
        <label class="font-medium text-darion-text-muted">Loan Tenure (Months)</label>
        <select name="tenure" required
                class="w-full px-4 py-3 darion-input rounded-darion-sm focus:outline-none focus:border-darion-primary/50 transition-colors">
            <option value="" disabled selected>Select tenure</option>
            <option value="12">12 Months</option>
            <option value="24">24 Months</option>
            <option value="36">36 Months</option>
            <option value="48">48 Months</option>
            <option value="60">60 Months</option>
        </select>
    </div>

    <!-- DYNAMIC FIELDS BASED ON LOAN TYPE -->
    <div id="dynamicFields">
        <!-- Fields will be inserted here based on loan type -->
    </div>

    <!-- PERSONAL DETAILS (Common for all loans) -->
    <div class="pt-6 border-t border-darion-border">
        <div class="flex items-center gap-3 mb-6">
            <div class="w-10 h-10 bg-darion-primary/20 rounded-full flex items-center justify-center">
                <svg class="w-5 h-5 text-darion-primary-light" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                </svg>
            </div>
            <h3 class="text-xl font-medium">Personal Details</h3>
        </div>

        <div class="grid md:grid-cols-2 gap-6">
            <div class="space-y-3">
                <label class="font-medium text-darion-text-muted">Full Name</label>
                <input type="text" name="full_name" required
                       class="w-full px-4 py-3 darion-input rounded-darion-sm focus:outline-none focus:border-darion-primary/50 transition-colors"
                       placeholder="Enter your full name">
            </div>

            <div class="space-y-3">
                <label class="font-medium text-darion-text-muted">Email Address</label>
                <input type="email" name="email" required
                       class="w-full px-4 py-3 darion-input rounded-darion-sm focus:outline-none focus:border-darion-primary/50 transition-colors"
                       placeholder="you@example.com">
            </div>

            <div class="space-y-3">
                <label class="font-medium text-darion-text-muted">Phone Number</label>
                <input type="tel" name="phone" required
                       class="w-full px-4 py-3 darion-input rounded-darion-sm focus:outline-none focus:border-darion-primary/50 transition-colors"
                       placeholder="+91 98765 43210">
            </div>

            <div class="space-y-3">
                <label class="font-medium text-darion-text-muted">Date of Birth</label>
                <input type="date" name="dob" required
                       class="w-full px-4 py-3 darion-input rounded-darion-sm focus:outline-none focus:border-darion-primary/50 transition-colors">
            </div>
        </div>
    </div>

    <!-- EMPLOYMENT DETAILS -->
    <div id="employmentSection" class="pt-6 border-t border-darion-border">
        <div class="flex items-center gap-3 mb-6">
            <div class="w-10 h-10 bg-darion-primary/20 rounded-full flex items-center justify-center">
                <svg class="w-5 h-5 text-darion-primary-light" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                </svg>
            </div>
            <h3 class="text-xl font-medium">Employment Details</h3>
        </div>

        <div class="space-y-6">
            <div class="space-y-3">
                <label class="font-medium text-darion-text-muted">Employment Type</label>
                <select name="employment_type" required
                        class="w-full px-4 py-3 darion-input rounded-darion-sm focus:outline-none focus:border-darion-primary/50 transition-colors">
                    <option value="" disabled selected>Select employment type</option>
                    <option value="Salaried">Salaried</option>
                    <option value="Self-Employed">Self-Employed</option>
                    <option value="Business Owner">Business Owner</option>
                    <option value="Freelancer">Freelancer</option>
                    <option value="Student">Student</option>
                    <option value="Unemployed">Unemployed</option>
                </select>
            </div>

            <div class="grid md:grid-cols-2 gap-6">
                <div class="space-y-3">
                    <label class="font-medium text-darion-text-muted">Monthly Income (₹)</label>
                    <input type="number" name="monthly_income" required
                           class="w-full px-4 py-3 darion-input rounded-darion-sm focus:outline-none focus:border-darion-primary/50 transition-colors"
                           placeholder="Enter monthly income">
                </div>

                <div class="space-y-3">
                    <label class="font-medium text-darion-text-muted">Company/Business Name</label>
                    <input type="text" name="company_name"
                           class="w-full px-4 py-3 darion-input rounded-darion-sm focus:outline-none focus:border-darion-primary/50 transition-colors"
                           placeholder="Enter company or business name">
                </div>
            </div>
        </div>
    </div>

    <!-- DOCUMENTS SECTION -->
    <div class="pt-6 border-t border-darion-border" id="documentsSection">
        <div class="flex items-center gap-3 mb-6">
            <div class="w-10 h-10 bg-darion-primary/20 rounded-full flex items-center justify-center">
                <svg class="w-5 h-5 text-darion-primary-light" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                </svg>
            </div>
            <h3 class="text-xl font-medium">Upload Required Documents</h3>
        </div>
        
        <p class="text-darion-text-muted mb-6 text-sm">
            Please upload clear scanned copies or photos of the following documents. 
            Supported formats: PDF, JPG, PNG (Max 5MB each).
        </p>

        <div class="space-y-6" id="dynamicDocuments">
            <!-- Common Documents for All Loans -->
            <div class="space-y-3">
                <label class="font-medium text-darion-text-muted">Aadhaar Card <span class="text-darion-red">*</span></label>
                <div class="darion-file-input rounded-darion-sm p-4">
                    <input type="file" name="aadhaar" required accept=".pdf,.jpg,.jpeg,.png"
                           class="w-full text-darion-text-muted file:mr-4 file:py-2 file:px-4 file:rounded-darion-sm file:border-0 file:text-sm file:bg-darion-primary/20 file:text-darion-primary-light hover:file:bg-darion-primary/30">
                    <p class="text-xs text-darion-text-muted/70 mt-2">Upload front and back sides in a single PDF or image</p>
                </div>
            </div>

            <div class="space-y-3">
                <label class="font-medium text-darion-text-muted">PAN Card <span class="text-darion-red">*</span></label>
                <div class="darion-file-input rounded-darion-sm p-4">
                    <input type="file" name="pan" required accept=".pdf,.jpg,.jpeg,.png"
                           class="w-full text-darion-text-muted file:mr-4 file:py-2 file:px-4 file:rounded-darion-sm file:border-0 file:text-sm file:bg-darion-primary/20 file:text-darion-primary-light hover:file:bg-darion-primary/30">
                    <p class="text-xs text-darion-text-muted/70 mt-2">Clear photo or scanned copy of PAN card</p>
                </div>
            </div>

            <div class="space-y-3">
                <label class="font-medium text-darion-text-muted">Bank Statement (Last 6 months) <span class="text-darion-red">*</span></label>
                <div class="darion-file-input rounded-darion-sm p-4">
                    <input type="file" name="bankstmt" required accept=".pdf,.jpg,.jpeg,.png"
                           class="w-full text-darion-text-muted file:mr-4 file:py-2 file:px-4 file:rounded-darion-sm file:border-0 file:text-sm file:bg-darion-primary/20 file:text-darion-primary-light hover:file:bg-darion-primary/30">
                    <p class="text-xs text-darion-text-muted/70 mt-2">PDF or image of bank statement showing transactions</p>
                </div>
            </div>

            <!-- Address Proof -->
            <div class="space-y-3">
                <label class="font-medium text-darion-text-muted">Address Proof <span class="text-darion-red">*</span></label>
                <div class="darion-file-input rounded-darion-sm p-4">
                    <input type="file" name="address_proof" required accept=".pdf,.jpg,.jpeg,.png"
                           class="w-full text-darion-text-muted file:mr-4 file:py-2 file:px-4 file:rounded-darion-sm file:border-0 file:text-sm file:bg-darion-primary/20 file:text-darion-primary-light hover:file:bg-darion-primary/30">
                    <p class="text-xs text-darion-text-muted/70 mt-2">Aadhaar, Utility Bill, or Rental Agreement</p>
                </div>
            </div>
        </div>
    </div>

    <!-- DECLARATION -->
    <div class="pt-6 border-t border-darion-border">
        <div class="flex items-start gap-3 p-4 bg-darion-primary/5 rounded-darion-sm border border-darion-primary/20">
            <input type="checkbox" id="declaration" name="declaration" required class="mt-1">
            <label for="declaration" class="text-sm text-darion-text-muted">
                I hereby declare that all information provided in this application is true and correct to the best of my knowledge. 
                I understand that any false information may result in rejection of my loan application. I agree to the 
                <a href="#" class="text-darion-primary-light hover:text-darion-primary">Terms & Conditions</a> and 
                <a href="#" class="text-darion-primary-light hover:text-darion-primary">Privacy Policy</a> of Darion Finance.
            </label>
        </div>
    </div>

    <!-- SUBMIT BUTTON -->
    <button type="submit"
            class="w-full bg-gradient-to-r from-darion-primary to-darion-primary-light text-white font-medium py-4 rounded-darion-sm hover:shadow-lg transition-all duration-300 mt-8 flex items-center justify-center gap-3 group">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
        </svg>
        Submit Loan Application
    </button>
</form>

<!-- JavaScript for Dynamic Form Fields -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    const loanTypeSelect = document.getElementById('loanTypeSelect');
    const dynamicFields = document.getElementById('dynamicFields');
    const dynamicDocuments = document.getElementById('dynamicDocuments');
    const employmentSection = document.getElementById('employmentSection');
    const documentsSection = document.getElementById('documentsSection');

    // Loan type specific fields configuration
    const loanTypeFields = {
        'Personal Loan': [
            {type: 'text', name: 'purpose', label: 'Loan Purpose', placeholder: 'Medical, Travel, Marriage, etc.', required: true},
            {type: 'select', name: 'salary_account', label: 'Salary Account Bank', placeholder: 'Select bank', required: true,
             options: ['State Bank of India', 'HDFC Bank', 'ICICI Bank', 'Axis Bank', 'Kotak Mahindra Bank', 'Other']}
        ],
        'Business Loan': [
            {type: 'text', name: 'business_name', label: 'Business Name', placeholder: 'Enter your business name', required: true},
            {type: 'text', name: 'udyam_number', label: 'Udyam Registration Number', placeholder: 'UDYAM-XX-XX-XXXXXX', required: false},
            {type: 'text', name: 'gst_number', label: 'GST Number', placeholder: '22AAAAA0000A1Z5', required: false},
            {type: 'number', name: 'business_age', label: 'Business Age (Years)', placeholder: 'Enter business age', required: true}
        ],
        'Education Loan': [
            {type: 'text', name: 'institute_name', label: 'Educational Institute', placeholder: 'Enter institute name', required: true},
            {type: 'text', name: 'course_name', label: 'Course Name', placeholder: 'Enter course name', required: true},
            {type: 'number', name: 'course_duration', label: 'Course Duration (Months)', placeholder: 'Enter duration', required: true},
            {type: 'text', name: 'student_id', label: 'Student ID Number', placeholder: 'Enter student ID', required: true}
        ],
        'Two Wheeler Loan': [
            {type: 'text', name: 'vehicle_brand', label: 'Vehicle Brand', placeholder: 'Honda, Hero, TVS, etc.', required: true},
            {type: 'text', name: 'vehicle_model', label: 'Vehicle Model', placeholder: 'Enter model name', required: true},
            {type: 'text', name: 'vehicle_number', label: 'Vehicle Number (if existing)', placeholder: 'MH-12-AB-1234', required: false},
            {type: 'select', name: 'vehicle_type', label: 'Vehicle Type', placeholder: 'Select type', required: true,
             options: ['Motorcycle', 'Scooter', 'Electric Scooter', 'Electric Motorcycle', 'Moped']}
        ],
        'Re-Loan': [
            {type: 'text', name: 'previous_loan_number', label: 'Previous Loan Reference Number', placeholder: 'Enter reference number', required: true},
            {type: 'text', name: 'previous_lender', label: 'Previous Lender Name', placeholder: 'Bank or financial institution', required: true},
            {type: 'number', name: 'previous_loan_amount', label: 'Previous Loan Amount (₹)', placeholder: 'Enter amount', required: true},
            {type: 'select', name: 'repayment_history', label: 'Previous Loan Repayment History', placeholder: 'Select history', required: true,
             options: ['Excellent (No delays)', 'Good (1-2 delays)', 'Average (3-5 delays)', 'Poor (Multiple delays)']}
        ],
        'Loan Against Property': [
            {type: 'text', name: 'property_type', label: 'Property Type', placeholder: 'Residential, Commercial, etc.', required: true},
            {type: 'text', name: 'property_address', label: 'Property Address', placeholder: 'Enter complete address', required: true},
            {type: 'text', name: 'property_value', label: 'Estimated Property Value (₹)', placeholder: 'Enter estimated value', required: true},
            {type: 'select', name: 'property_ownership', label: 'Property Ownership', placeholder: 'Select ownership', required: true,
             options: ['Self-Owned', 'Joint Ownership', 'Inherited', 'Leasehold']}
        ]
    };

    // Loan type specific documents configuration
    const loanTypeDocuments = {
        'Business Loan': [
            {name: 'udyam_certificate', label: 'Udyam Registration Certificate', required: false},
            {name: 'gst_certificate', label: 'GST Registration Certificate', required: false},
            {name: 'business_license', label: 'Business License/Trade License', required: true},
            {name: 'itr_3years', label: 'ITR of Last 3 Years', required: false}
        ],
        'Education Loan': [
            {name: 'admission_letter', label: 'Admission Letter from Institute', required: true},
            {name: 'fee_structure', label: 'Fee Structure Document', required: true},
            {name: 'marksheets', label: 'Previous Marksheets/Certificates', required: true}
        ],
        'Two Wheeler Loan': [
            {name: 'vehicle_quotation', label: 'Vehicle Quotation/Invoice', required: true},
            {name: 'rc_copy', label: 'RC Copy (for existing vehicle)', required: false},
            {name: 'insurance_copy', label: 'Insurance Copy', required: true}
        ],
        'Re-Loan': [
            {name: 'previous_loan_statement', label: 'Previous Loan Statement', required: true},
            {name: 'repayment_track', label: 'Repayment Track Record', required: true},
            {name: 'noc_previous_lender', label: 'NOC from Previous Lender', required: false}
        ],
        'Loan Against Property': [
            {name: 'property_papers', label: 'Property Papers (Registry)', required: true},
            {name: 'property_tax_receipt', label: 'Property Tax Receipt', required: true},
            {name: 'navigational_map', label: 'Site Plan/Navigational Map', required: true},
            {name: 'valuation_report', label: 'Property Valuation Report', required: false}
        ]
    };

    // Function to create form field
    function createField(field) {
        const container = document.createElement('div');
        container.className = 'space-y-3';

        const label = document.createElement('label');
        label.className = 'font-medium text-darion-text-muted';
        label.textContent = field.label;
        if (field.required) {
            const requiredSpan = document.createElement('span');
            requiredSpan.className = 'text-darion-red';
            requiredSpan.textContent = ' *';
            label.appendChild(requiredSpan);
        }
        container.appendChild(label);

        let input;
        if (field.type === 'select') {
            input = document.createElement('select');
            input.name = field.name;
            input.className = 'w-full px-4 py-3 darion-input rounded-darion-sm focus:outline-none focus:border-darion-primary/50 transition-colors';
            if (field.required) input.required = true;

            const defaultOption = document.createElement('option');
            defaultOption.value = '';
            defaultOption.disabled = true;
            defaultOption.selected = true;
            defaultOption.textContent = field.placeholder;
            input.appendChild(defaultOption);

            field.options.forEach(option => {
                const optionElement = document.createElement('option');
                optionElement.value = option;
                optionElement.textContent = option;
                optionElement.className = 'text-darion-bg';
                input.appendChild(optionElement);
            });
        } else {
            input = document.createElement('input');
            input.type = field.type;
            input.name = field.name;
            input.placeholder = field.placeholder;
            input.className = 'w-full px-4 py-3 darion-input rounded-darion-sm focus:outline-none focus:border-darion-primary/50 transition-colors';
            if (field.required) input.required = true;
        }

        container.appendChild(input);
        return container;
    }

    // Function to create document upload field
    function createDocumentField(doc) {
        const container = document.createElement('div');
        container.className = 'space-y-3';

        const label = document.createElement('label');
        label.className = 'font-medium text-darion-text-muted';
        label.textContent = doc.label;
        if (doc.required) {
            const requiredSpan = document.createElement('span');
            requiredSpan.className = 'text-darion-red';
            requiredSpan.textContent = ' *';
            label.appendChild(requiredSpan);
        }
        container.appendChild(label);

        const fileInputContainer = document.createElement('div');
        fileInputContainer.className = 'darion-file-input rounded-darion-sm p-4';

        const input = document.createElement('input');
        input.type = 'file';
        input.name = doc.name;
        if (!doc.required) input.removeAttribute('required');
        input.accept = '.pdf,.jpg,.jpeg,.png';
        input.className = 'w-full text-darion-text-muted file:mr-4 file:py-2 file:px-4 file:rounded-darion-sm file:border-0 file:text-sm file:bg-darion-primary/20 file:text-darion-primary-light hover:file:bg-darion-primary/30';
        if (doc.required) input.required = true;

        const helperText = document.createElement('p');
        helperText.className = 'text-xs text-darion-text-muted/70 mt-2';
        helperText.textContent = 'Supported formats: PDF, JPG, PNG (Max 5MB)';

        fileInputContainer.appendChild(input);
        fileInputContainer.appendChild(helperText);
        container.appendChild(fileInputContainer);

        return container;
    }

    // Function to update form based on selected loan type
    function updateFormFields(loanType) {
        // Clear previous dynamic fields
        dynamicFields.innerHTML = '';

        // Add specific fields for selected loan type
        if (loanTypeFields[loanType]) {
            const fieldsContainer = document.createElement('div');
            fieldsContainer.className = 'grid md:grid-cols-2 gap-6 mb-6';

            loanTypeFields[loanType].forEach(field => {
                fieldsContainer.appendChild(createField(field));
            });

            dynamicFields.appendChild(fieldsContainer);
        }

        // Update employment section visibility
        if (loanType === 'Education Loan' || loanType === 'Two Wheeler Loan') {
            employmentSection.style.display = 'block';
        } else {
            employmentSection.style.display = 'block';
        }

        // Update documents section
        const existingDocuments = document.querySelectorAll('#dynamicDocuments > div');
        existingDocuments.forEach(doc => {
            if (doc.querySelector('input[name="udyam_certificate"], input[name="gst_certificate"], input[name="business_license"], input[name="itr_3years"], input[name="admission_letter"], input[name="fee_structure"], input[name="marksheets"], input[name="vehicle_quotation"], input[name="rc_copy"], input[name="insurance_copy"], input[name="previous_loan_statement"], input[name="repayment_track"], input[name="noc_previous_lender"], input[name="property_papers"], input[name="property_tax_receipt"], input[name="navigational_map"], input[name="valuation_report"]')) {
                doc.remove();
            }
        });

        // Add loan-specific documents
        if (loanTypeDocuments[loanType]) {
            loanTypeDocuments[loanType].forEach(doc => {
                dynamicDocuments.appendChild(createDocumentField(doc));
            });
        }
    }

    // Event listener for loan type change
    loanTypeSelect.addEventListener('change', function() {
        updateFormFields(this.value);
    });

    // Initialize form with first option if preselected
    if (loanTypeSelect.value) {
        updateFormFields(loanTypeSelect.value);
    }
});
</script>

<!-- Custom CSS for File Inputs -->
<style>
.darion-file-input {
    background: rgba(22, 27, 34, 0.5);
    border: 1px solid rgba(255, 255, 255, 0.1);
}

.darion-file-input:hover {
    border-color: rgba(74, 158, 134, 0.3);
}

/* Hide default file input styling and show custom */
.darion-file-input input[type="file"]::-webkit-file-upload-button {
    visibility: hidden;
}

.darion-file-input input[type="file"]::before {
    content: 'Choose File';
    display: inline-block;
    background: rgba(44, 116, 70, 0.2);
    color: #4a9e86;
    padding: 8px 16px;
    border-radius: 8px;
    outline: none;
    white-space: nowrap;
    cursor: pointer;
    font-weight: 500;
    font-size: 14px;
}

.darion-file-input input[type="file"]:hover::before {
    background: rgba(44, 116, 70, 0.3);
}
</style>
    </div>

</div>

<!-- FOOTER -->
<?php include "footer.php"; ?>
</body>
</html>