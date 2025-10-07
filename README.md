# To-Do App (Full Stack Application)

## Overview

This project is a full-stack **To-Do Application** built using modern web technologies.  
It allows users to manage daily tasks efficiently with full CRUD (Create, Read, Update, Delete) functionality.

The project runs on Docker using **Docker Compose** with three main services:

- Frontend (Vue.js)
- Backend (PHP API)
- Database (MySQL)

---

## Technologies Used

### Frontend
- Vue.js
- Axios (for API requests)

### Backend
- PHP (API endpoints)
- Docker (containerized backend)

### Database
- MySQL (containerized database)

---

## Setup Instructions

### Step 1: Clone the Repository
```bash
git clone https://github.com/dilmiishara/To-Do.git
cd To-Do
```

### Step 2: Build and Run the Containers
From the project root folder, run:
```bash
docker-compose up --build
```

### Step 3: Access the Application
Frontend: http://localhost:8080
Backend API: http://localhost:8000/api/get.php
Database: MySQL (port 3306)

## Project Structure
```bash
To-Do/
│
├── frontend/         # Vue.js application
├── backend/          # PHP API files
├── docker-compose.yml
└── README.md
```

## Features
Add new tasks
Update existing tasks
Delete tasks
Fetch and display tasks dynamically from the database
Responsive UI with Vue.js
