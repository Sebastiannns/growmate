# FIGMA-DESIGN.md

# GROWMATE DESIGN SYSTEM

This document defines the UI/UX system for GrowMate based on the provided mobile prototype designs.

The interface must closely follow the uploaded Figma prototype images while adapting them into a responsive Laravel web application.

---

# DESIGN STYLE

## Main Design Concept

GrowMate uses a:

* Soft modern UI
* Mobile-first layout
* Minimalist interface
* Calm mental wellness aesthetic
* Student productivity application style

The UI should feel:

* Comfortable
* Friendly
* Safe
* Motivational
* Non-stressful
* Clean and modern

---

# DEVICE FRAME

## Primary Mobile Screen

Width:
390px

Height:
896px

Design Type:

* iPhone-style mobile layout
* Mobile app inspired interface
* Responsive web adaptation

Responsive Rule:

* max-width: 430px
* centered mobile container
* preserve mobile proportions on desktop

---

# MAIN COLOR SYSTEM

## Primary Colors

Primary Blue:
#94BBFA

Background:
#FFFFFF

Soft Gray Text:
rgba(0, 0, 0, 0.39)

Primary Text:
#000000

Border Color:
#E5E7EB

Success Color:
#A7F3D0

Danger Color:
#FCA5A5

Warning Color:
#FDE68A

---

# TYPOGRAPHY SYSTEM

## Font Family

Poppins

---

## Heading Style

Font Weight:
600

Font Size:
16px

Line Height:
24px

Usage:

* Hero text
* Dashboard titles
* Card headings
* Important labels

---

## Body Text Style

Font Weight:
400

Font Size:
13px

Line Height:
20px

Usage:

* Description text
* Supporting information
* Secondary labels

---

# BUTTON SYSTEM

## Primary Button

Background:
#94BBFA

Text Color:
#FFFFFF

Border Radius:
8px

Height:
46px

Style:

* Rounded modern button
* Comfortable tap target
* Full width mobile button

Typography:

* Font Family: Poppins
* Font Weight: 600
* Font Size: 12px

---

# SPACING SYSTEM

## Layout Spacing

Horizontal Padding:
24px

Card Padding:
16px

Gap Between Components:
8px – 24px

Section Spacing:
32px

---

# CARD SYSTEM

## Card Style

Background:
#FFFFFF

Border Radius:
16px – 24px

Shadow:
Soft subtle shadow

Recommended:
box-shadow: 0 4px 20px rgba(0,0,0,0.05);

Card Style Feel:

* Soft
* Floating
* Minimal
* Comfortable

---

# LAYOUT RULES

Use:

* Flexbox
* Column layout
* Rounded sections
* Consistent spacing
* Mobile safe area

Avoid:

* Sharp corners
* Heavy borders
* Crowded UI
* Overly dark layouts

---

# MAIN SCREENS

## 1. Landing Page

Reference:

* halaman awal.png

Contains:

* Hero illustration
* Motivational text
* CTA button
* Centered onboarding layout

Design Feel:

* Calm
* Welcoming
* Inspirational

---

## 2. Authentication Pages

References:

* opsi .png
* masuk.png
* buat akun.png
* otp.png
* data pribadi.png

UI Style:

* Rounded inputs
* Soft blue buttons
* Minimal forms
* Comfortable spacing

---

## 3. Dashboard

Reference:

* beranda.png

Contains:

* Mood summary
* Productivity widgets
* Daily motivation
* Quick actions
* Study progress

Design Feel:

* Productive
* Positive
* Organized

---

## 4. Mood Tracker

References:

* mood.png
* riwayat mood.png

Contains:

* Mood emoji selection
* Mood journal
* Mood history
* Emotional tracking

Design Feel:

* Emotional safety
* Calm interaction
* Personal reflection

---

## 5. Focus Timer

Reference:

* timer.png

Contains:

* Pomodoro timer
* Focus controls
* Session progress

Design Feel:

* Clean
* Minimal
* Focus-oriented

---

## 6. Community Forum

References:

* comun.png
* detil comun.png
* detil comun (2).png

Contains:

* Community posts
* User discussions
* Interaction cards
* Comment sections

Design Feel:

* Friendly
* Collaborative
* Student community

---

## 7. Consultation System

References:

* konsul.png
* jadwal konsultasi.png

Contains:

* Consultation booking
* Schedule cards
* Counselor information
* Session management

Design Feel:

* Trustworthy
* Comfortable
* Professional

---

## 8. AI Chat

Reference:

* chat Ai.png

Contains:

* Chat bubbles
* AI assistant interaction
* Motivational support

Design Feel:

* Friendly AI
* Safe interaction
* Modern chatbot UI

---

## 9. Learning Materials

Reference:

* Materi belajar.png

Contains:

* Material cards
* Categories
* Study resources
* Educational content

Design Feel:

* Educational
* Organized
* Easy navigation

---

## 10. Profile System

References:

* profil.png
* edit profil.png

Contains:

* User profile
* Activity history
* Personal settings
* Edit profile forms

Design Feel:

* Personal
* Clean
* Organized

---

## 11. To Do List

Reference:

* to do list.png

Contains:

* Task cards
* Progress tracking
* Productivity management
* Deadlines

Design Feel:

* Structured
* Productive
* Easy management

---

# NAVIGATION STYLE

Use:

* Bottom navigation bar
* Rounded floating navigation
* Mobile app interaction style

Navigation Icons:

* Home
* Mood
* Community
* Consultation
* Profile

---

# ANIMATION STYLE

Use:

* Soft transitions
* Smooth hover effects
* Gentle scaling
* Fade animations

Avoid:

* Aggressive animations
* Excessive motion

---

# IMPLEMENTATION RULES

Frontend Stack:

* Blade Laravel
* Tailwind CSS
* Alpine.js

Recommended Tailwind Classes:

* rounded-2xl
* shadow-sm
* flex
* flex-col
* gap-4
* px-6
* py-4
* text-center

---

# FINAL UI GOAL

The final interface should feel like:

* a modern iOS productivity app
* a mental wellness platform
* a student support ecosystem

The UI must prioritize:

* emotional comfort
* readability
* simplicity
* mobile experience
* soft modern aesthetics
