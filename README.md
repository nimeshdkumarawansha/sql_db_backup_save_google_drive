

# SQL DB Backup saving google drive folder

This repository contains scripts for backing up your SQL database and saving it to Google Drive.

## Clone Project

Clone Repository

```bash
  https://github.com/nimeshdkumarawansha/sql_db_backup_save_google_drive.git
```

## Getting Started

Create .env file

```bash
cp.env.example .env
```

Copy to .env

```bash
GOOGLE_DRIVE_CLIENT_ID=your-client-id
GOOGLE_DRIVE_CLIENT_SECRET=your-client-secret
GOOGLE_DRIVE_REFRESH_TOKEN=your-refresh-token
GOOGLE_DRIVE_FOLDER_ID=your-folder-id 
```

Install Composer

```bash
compser install
```

Generate key

```bash
php artisan key:generate 
```

Run Project

```bash
php artisan serve 
```

Run data backup command

```bash
php artisan backup:database
```