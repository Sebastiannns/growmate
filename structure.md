# SKILL.md — GrowMate Laravel 12 Project

# PROJECT OVERVIEW

Project Name: GrowMate
Type: Mental Health & Academic Productivity Platform for University Students
Platform: Web Application (Mobile First Responsive Design)
Framework: Laravel 12
Database: MySQL (phpMyAdmin)
Architecture: MVC (Model View Controller)
Frontend Style: Modern Mobile UI inspired by native mobile applications

---

# MAIN OBJECTIVE

Build a responsive website based on the provided mobile prototype designs.

The UI/UX must follow the uploaded prototype images closely while adapting them into a Laravel web application.

The system focuses on:

* Mental health support
* Mood tracking
* Academic productivity
* Student consultation
* Community interaction
* AI support features

---

# IMPORTANT DEVELOPMENT RULES

* Use Laravel 12
* Use MySQL database
* Use Blade templating
* Use Tailwind CSS
* Mobile-first responsive design
* Clean code structure
* Use middleware for authentication and role management
* Use Eloquent ORM
* Use migration & seeder
* Use MVC properly
* Keep UI similar to uploaded prototype
* Optimize for smartphone screens first
* Responsive for tablet and desktop

---

# USER ROLES

## 1. Mahasiswa (Student)

Features:

* Register/Login
* Mood tracker
* Academic task management
* Focus timer
* Consultation booking
* Community discussion
* Profile management
* AI chat assistant
* Study materials
* Mental health journal

## 2. Konselor

Features:

* Login
* Manage consultation schedules
* View consultation requests
* Manage student consultation notes
* Publish mental health articles

## 3. Admin

Features:

* Manage all users
* Manage articles
* Manage consultation data
* Manage community/forum
* Dashboard analytics
* Monitor platform activity

---

# PROTOTYPE REFERENCES

The UI must follow these uploaded prototype screens:

* halaman awal.png
* opsi.png
* masuk.png
* buat akun.png
* data pribadi.png
* timer.png
* mood.png
* otp.png
* beranda.png
* profil.png
* edit profil.png
* comun.png
* detil comun.png
* konsul.png
* Materi belajar.png
* chat Ai.png
* jadwal konsultasi.png

Use these prototype images as primary UI references.

---

# UI/UX STYLE GUIDE

## Design Style

* Soft modern UI
* Rounded corners
* Clean spacing
* Minimalist layout
* Comfortable reading experience
* Mobile app feeling

## Main Colors

* Pastel blue
* White
* Soft gray
* Light purple accents

## Typography

Recommended:

* Poppins
  or
* Inter

## UI Components

* Bottom navigation
* Floating action buttons
* Card-based layout
* Mobile containers
* Progress bars
* Emoji mood cards
* Soft shadows
* Rounded inputs

---

# MAIN FEATURES

# AUTHENTICATION

## Pages

* Landing Page
* Login
* Register
* OTP Verification
* Forgot Password

## Authentication System

* Laravel Breeze or Laravel Jetstream
* Session Authentication
* Middleware protection
* Role-based access

---

# DASHBOARD

## Student Dashboard

Display:

* Daily mood
* Upcoming tasks
* Study progress
* Motivation quotes
* Consultation reminders
* Focus timer shortcut

---

# MOOD TRACKER

## Features

* Select mood emoji
* Mood notes/journal
* Daily mood history
* Mood statistics
* Mood calendar

## Mood Examples

* Happy
* Sad
* Angry
* Anxious
* Tired
* Motivated

---

# FOCUS TIMER

## Features

* Pomodoro timer
* Start/Pause/Reset
* Focus sessions
* Productivity tracking

---

# TASK MANAGEMENT

## Features

* Add task
* Edit task
* Delete task
* Deadline reminder
* Status tracking

---

# COMMUNITY FORUM

## Features

* Community posts
* Discussion comments
* Like/reaction system
* Sharing experiences

---

# CONSULTATION SYSTEM

## Features

* Consultation booking
* Schedule management
* Student-consultant interaction
* Consultation status

---

# AI CHAT FEATURE

## Features

* AI motivational assistant
* Mental support chatbot
* Productivity assistant

UI should follow:

* chat Ai.png

---

# STUDY MATERIALS

## Features

* Upload materials
* View learning materials
* Material categories
* Download files

---

# PROFILE SYSTEM

## Features

* Edit profile
* Upload avatar
* Academic information
* Mood history
* Productivity statistics

---

# DATABASE STRUCTURE

## TABLES

### users

* id
* role
* name
* email
* password
* avatar
* created_at

### moods

* id
* user_id
* mood
* note
* created_at

### tasks

* id
* user_id
* title
* description
* deadline
* status

### consultations

* id
* student_id
* counselor_id
* topic
* consultation_date
* status
* notes

### materials

* id
* title
* category
* file
* description

### communities

* id
* user_id
* title
* content

### comments

* id
* community_id
* user_id
* comment

---

# LARAVEL STRUCTURE

## Controllers

* AuthController
* DashboardController
* MoodController
* TaskController
* ConsultationController
* CommunityController
* ProfileController
* TimerController
* MaterialController
* AIChatController

---

# MIDDLEWARE

Use middleware for:

* auth
* guest
* role:admin
* role:student
* role:counselor

---

# FRONTEND REQUIREMENTS

## Use:

* Blade Components
* Tailwind CSS
* Alpine.js

## Optional:

* Livewire
* Chart.js
* SweetAlert

---

# RESPONSIVE DESIGN RULES

The website MUST:

* prioritize smartphone screens
* look like a native mobile app
* use max-width containers
* have smooth spacing
* support desktop responsiveness

Recommended mobile width:
390px–430px

---

# CODING STANDARDS

* Use clean architecture
* Use reusable Blade components
* Use proper route naming
* Use validation on all forms
* Use RESTful resource controllers
* Avoid duplicated code
* Use service classes if needed

---

# FILE ORGANIZATION

## Resources

/resources/views/

* auth/
* dashboard/
* mood/
* task/
* consultation/
* community/
* profile/
* components/

## Public

/public/assets/

## Routes

/routes/web.php

---

# PRIORITY DEVELOPMENT ORDER

## PHASE 1

* Authentication
* Role middleware
* Dashboard UI

## PHASE 2

* Mood tracker
* Task management
* Profile system

## PHASE 3

* Consultation system
* Community forum
* Study materials

## PHASE 4

* AI Chat
* Notifications
* Analytics

---

# FINAL GOAL

The final result must feel like:

* a modern mobile application
* but built using Laravel web technology

The system should provide:

* emotional support
* academic productivity
* community interaction
* healthy student lifestyle management

The UI must stay faithful to the uploaded GrowMate prototype.
