# CourseLink – Student Course Registration System

**Final Project Report (MVP Version)**

**Submitted by:** GROUP 12  
**Course/Assignment:** [Student-course-regsitration]  
**Date:** March 2026

## GROUP MEMBERS
-Sussana Mensah -  052441360135 , 
-Akua Adutwumwaa - 052441360308,
-Golo Edem - 052541360353,
-Sadat Alhassan - 052441360052,

## 1. Project Overview

CourseLink is a simple web-based student course registration system developed as a minimum viable product (MVP) for a class project.

The system allows students to:

- Create an account with profile picture upload
- Log in securely
- View a list of available courses
- Register for courses (with duplicate prevention and credit limit check)
- View their registered courses with total credits
- See and update basic profile information

The application was intentionally kept simple, focusing on core functionality without advanced features such as prerequisites, timetable conflict detection, course approval workflow, admin panel, or payment integration.

## 2. Technology Stack

- **Backend**: PHP (procedural style with mysqli extension)
- **Database**: MySQL / MariaDB (managed via phpMyAdmin)
- **Frontend**: HTML5, CSS3 (responsive design), minimal JavaScript
- **Authentication**: Session-based login with password hashing using password_hash()
- **File handling**: Profile picture upload (stored in server folder uploads/profile/)
- **Icons**: Font Awesome (CDN)
- **Development environment**: XAMPP (Apache + MySQL) on local machine
- **Database name**: courselink_db

## 3. Database Structure

The system uses **one database** named **courselink_db** containing **three tables**:

| Table name    | Purpose                                       | Primary Key | Main Columns                                                                                                    | Relationships                  |
| ------------- | --------------------------------------------- | ----------- | --------------------------------------------------------------------------------------------------------------- | ------------------------------ |
| users         | Stores student accounts                       | id          | full_name, username (UNIQUE), email (UNIQUE), password (hashed), profile_image (varchar path), role, created_at | 1 user → many registrations    |
| courses       | Stores all available courses                  | id          | course_code (UNIQUE), course_title, credit_hours, level, department, description, is_active                     | 1 course → many registrations  |
| registrations | Records which courses each student registered | id          | user_id (FK), course_id (FK), registered_at, status (approved/pending/dropped)                                  | many-to-many (users ↔ courses) |

**Important constraints:**

- UNIQUE index on (user_id, course_id) in registrations → prevents duplicate registrations
- FOREIGN KEY constraints with ON DELETE CASCADE

## 4. System Flow – How It Works (User Journey)

1. **Visitor lands on home page** (index.php)  
   → Sees welcome message, features overview, and buttons:  
    • Register Now → register.php  
    • Login → login.php

2. **Registration** (register.php)  
   → User enters: full name, email, username, password, confirm password, optional profile picture  
   → System validates: required fields, valid email, matching passwords, unique username/email  
   → Hashes password → inserts record into users table  
   → Uploads and saves profile picture if provided  
   → Shows success message with login link

3. **Login** (login.php)  
   → Accepts username OR email + password  
   → Verifies credentials using password_verify()  
   → On success: starts session, stores user data, redirects to dashboard.php  
   → On failure: shows error message

4. **Dashboard** (dashboard.php) – main protected page  
   → Shows personalized welcome + profile picture  
   → Displays real stats pulled from database:  
    • Total registered credits  
    • Number of registered courses  
   → Navigation sidebar links to all main pages

5. **Available Courses** (available-courses.php)  
   → Lists all active courses from courses table  
   → Each course card shows: code, title, credits, level, department, short description  
   → Button logic:  
    • Not yet registered → green “Register Course” button  
    • Already registered → gray disabled “Registered” button  
   → Clicking register → POST to register-course.php

6. **Course Registration** (register-course.php)  
   → Validates:  
    • Course exists and is active  
    • Not already registered by this user  
    • Total credits after registration ≤ 18  
   → If valid → inserts record into registrations (status = 'approved')  
   → Redirects back with success/error flash message

7. **My Registrations** (my-registrations.php)  
   → Shows table of all registered courses  
   → Columns: code, title, credits, level, department, registration date, status  
   → Displays total approved credits at the top  
   → Empty state message + link to browse courses if none registered

8. **Profile** (profile.php)  
   → Displays: full name, username, email, member since, profile picture (large), registration stats  
   → Simple form to upload/update profile picture  
   → Updates users table and session on successful upload

9. **Logout** (logout.php)  
   → Destroys session → redirects to login page

## 5. Security Features Implemented

- Passwords stored as hashes (never plain text)
- All database queries use prepared statements (protection against SQL injection)
- Session-based authentication with redirect checks on protected pages
- File upload validation: allowed types (jpg/png/gif), size limit 2MB
- htmlspecialchars() used when displaying user input

## 6. Limitations of this MVP version

- No password change or email update
- No course drop/withdrawal functionality
- No timetable conflict checking
- No course prerequisites validation
- No registration period restriction
- No admin interface for managing courses/users
- No email verification or password recovery
- Registrations are auto-approved (no pending/review flow)

## 7. Conclusion

The CourseLink MVP successfully implements a complete basic student course registration workflow using PHP and MySQL.  
The system covers user registration & login, course browsing & registration with basic rules, viewing registered courses, and profile management — all within a clean, responsive interface suitable for a class assignment.

The project demonstrates understanding of:

- Session management & authentication
- Database design & CRUD operations
- File uploads
- Form validation & security basics
- Responsive web design principles

This version provides a solid foundation that can be extended with more advanced features in future iterations.

**End of Report**
