# Automatdo WordPress Deployment Guide

This guide covers deploying the Automatdo WordPress theme from Local by Flywheel to AWS Lightsail.

---

## Table of Contents

1. [Architecture Overview](#architecture-overview)
2. [Local Development](#local-development)
3. [AWS Lightsail Setup](#aws-lightsail-setup)
4. [Server Configuration (LEMP Stack)](#server-configuration-lemp-stack)
5. [WordPress Installation](#wordpress-installation)
6. [SSL Certificate (HTTPS)](#ssl-certificate-https)
7. [Domain Configuration](#domain-configuration)
8. [Deploying the Theme](#deploying-the-theme)
9. [Database Management](#database-management)
10. [Ongoing Workflow](#ongoing-workflow)
11. [Troubleshooting](#troubleshooting)

---

## Architecture Overview

```
┌─────────────────────────────────────────────────────────────────┐
│                        LOCAL (Development)                       │
├─────────────────────────────────────────────────────────────────┤
│  Local by Flywheel                                              │
│  └── automatdo site                                             │
│      └── wp-content/themes/automatdo/  ← Git repo (this folder) │
└─────────────────────────────────────────────────────────────────┘
                              │
                              │ git push (GitHub)
                              │ ./deploy.sh (rsync to server)
                              ▼
┌─────────────────────────────────────────────────────────────────┐
│                     PRODUCTION (AWS Lightsail)                   │
├─────────────────────────────────────────────────────────────────┤
│  Ubuntu 22.04 + Nginx + PHP 8.x + MySQL                         │
│  └── /var/www/html/                                             │
│      ├── wp-admin/         (WordPress core)                     │
│      ├── wp-includes/      (WordPress core)                     │
│      ├── wp-content/                                            │
│      │   ├── themes/                                            │
│      │   │   └── automatdo/  ← Deployed via rsync               │
│      │   ├── plugins/        (installed via WP admin)           │
│      │   └── uploads/        (media files)                      │
│      └── wp-config.php                                          │
└─────────────────────────────────────────────────────────────────┘
```

### What Lives Where

| Component | Local | Production | Version Controlled |
|-----------|-------|------------|-------------------|
| WordPress Core | Local manages | Installed manually | No |
| Plugins | Install in WP Admin | Install in WP Admin | No |
| Theme (automatdo) | Edit locally | Deploy via rsync | Yes |
| Database | Local dev data | Production content | No |
| Uploads (media) | Local testing | Production only | No |

---

## Local Development

### Prerequisites
- [Local by Flywheel](https://localwp.com/) installed
- Git installed
- SSH key for Lightsail

### Workflow

1. **Start the Local site**
   - Open Local by Flywheel
   - Start the "automatdo" site
   - Access at `http://automatdo.local` (or your configured URL)

2. **Edit theme files**
   ```
   /Users/bradya/Local Sites/automatdo/app/public/wp-content/themes/automatdo/
   ```
   - Use your preferred editor (VS Code, etc.)
   - Changes appear immediately on refresh

3. **Commit changes**
   ```bash
   cd "/Users/bradya/Local Sites/automatdo/app/public/wp-content/themes/automatdo"
   git add .
   git commit -m "Your commit message"
   git push origin main
   ```

4. **Deploy to production**
   ```bash
   ./deploy.sh
   ```

---

## AWS Lightsail Setup

### Step 1: Create a Lightsail Instance

1. Log into [AWS Lightsail Console](https://lightsail.aws.amazon.com/)
2. Click **Create instance**
3. Select:
   - **Region**: Choose closest to your users (e.g., us-east-1)
   - **Platform**: Linux/Unix
   - **Blueprint**: OS Only → **Ubuntu 22.04 LTS**
4. Choose instance plan:
   - **$5/month** (1 GB RAM, 1 vCPU) - sufficient for a single WordPress site
   - Can upgrade later if needed
5. Name your instance: `automatdo-production`
6. Click **Create instance**

### Step 2: Attach a Static IP

Static IPs prevent your IP from changing on instance restart.

1. Go to **Networking** tab on your instance
2. Click **Attach static IP**
3. Create a new static IP, name it `automatdo-ip`
4. Attach to your instance

**Note**: Static IPs are free while attached to a running instance.

### Step 3: Configure Firewall

1. In the **Networking** tab, scroll to **IPv4 Firewall**
2. Ensure these rules exist:
   - SSH (22) - for deployment
   - HTTP (80) - for web traffic
   - HTTPS (443) - for SSL

### Step 4: Download SSH Key

1. Go to **Account** (top right) → **SSH keys**
2. Download the default key for your region
3. Set up the key locally:
   ```bash
   # Move key to SSH directory
   mv ~/Downloads/LightsailDefaultKey-us-east-1.pem ~/.ssh/lightsail.pem

   # Set correct permissions (required)
   chmod 400 ~/.ssh/lightsail.pem
   ```

### Step 5: Connect to Your Instance

```bash
ssh -i ~/.ssh/lightsail.pem ubuntu@YOUR_STATIC_IP
```

Replace `YOUR_STATIC_IP` with your actual static IP address.

---

## Server Configuration (LEMP Stack)

Run these commands after SSH'ing into your server.

### Update System

```bash
sudo apt update && sudo apt upgrade -y
```

### Install Nginx

```bash
sudo apt install -y nginx
sudo systemctl enable nginx
sudo systemctl start nginx
```

### Install MySQL

```bash
sudo apt install -y mysql-server
sudo systemctl enable mysql
sudo systemctl start mysql

# Secure the installation
sudo mysql_secure_installation
```

When prompted:
- Set root password: Yes (choose a strong password)
- Remove anonymous users: Yes
- Disallow root login remotely: Yes
- Remove test database: Yes
- Reload privilege tables: Yes

### Install PHP

```bash
sudo apt install -y php-fpm php-mysql php-xml php-mbstring php-curl php-zip php-gd php-imagick php-intl
```

### Create WordPress Database

```bash
sudo mysql
```

In the MySQL prompt:
```sql
CREATE DATABASE wordpress DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
CREATE USER 'wpuser'@'localhost' IDENTIFIED BY 'YOUR_SECURE_DB_PASSWORD';
GRANT ALL PRIVILEGES ON wordpress.* TO 'wpuser'@'localhost';
FLUSH PRIVILEGES;
EXIT;
```

**Important**: Replace `YOUR_SECURE_DB_PASSWORD` with a strong password. Save this password - you'll need it for WordPress setup.

### Configure Nginx

```bash
sudo nano /etc/nginx/sites-available/default
```

Replace the entire contents with:

```nginx
server {
    listen 80;
    listen [::]:80;
    server_name YOUR_DOMAIN_OR_IP;
    root /var/www/html;
    index index.php index.html index.htm;

    # Security headers
    add_header X-Frame-Options "SAMEORIGIN" always;
    add_header X-Content-Type-Options "nosniff" always;
    add_header X-XSS-Protection "1; mode=block" always;

    # Max upload size (for WordPress media uploads)
    client_max_body_size 64M;

    location / {
        try_files $uri $uri/ /index.php?$args;
    }

    location ~ \.php$ {
        include snippets/fastcgi-php.conf;
        fastcgi_pass unix:/var/run/php/php8.3-fpm.sock;
        fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name;
        include fastcgi_params;
    }

    # Deny access to sensitive files
    location ~ /\.ht {
        deny all;
    }

    location = /wp-config.php {
        deny all;
    }

    # Cache static files
    location ~* \.(js|css|png|jpg|jpeg|gif|ico|svg|woff|woff2)$ {
        expires 30d;
        add_header Cache-Control "public, immutable";
    }
}
```

Replace `YOUR_DOMAIN_OR_IP` with your domain or static IP.

### Configure PHP

Increase upload limits for WordPress:

```bash
sudo nano /etc/php/8.3/fpm/php.ini
```

Find and update these values:
```ini
upload_max_filesize = 64M
post_max_size = 64M
memory_limit = 256M
max_execution_time = 300
```

### Restart Services

```bash
sudo systemctl restart nginx
sudo systemctl restart php8.3-fpm
```

### Verify Setup

```bash
# Check Nginx status
sudo systemctl status nginx

# Check PHP-FPM status
sudo systemctl status php8.3-fpm

# Test Nginx configuration
sudo nginx -t
```

---

## WordPress Installation

### Download WordPress

```bash
cd /var/www/html

# Remove default files
sudo rm -rf *

# Download and extract WordPress
sudo wget https://wordpress.org/latest.tar.gz
sudo tar -xzf latest.tar.gz
sudo mv wordpress/* .
sudo rm -rf wordpress latest.tar.gz

# Set permissions
sudo chown -R www-data:www-data /var/www/html
sudo find /var/www/html -type d -exec chmod 755 {} \;
sudo find /var/www/html -type f -exec chmod 644 {} \;
```

### Create wp-config.php

```bash
sudo cp wp-config-sample.php wp-config.php
sudo nano wp-config.php
```

Update these lines:
```php
define( 'DB_NAME', 'wordpress' );
define( 'DB_USER', 'wpuser' );
define( 'DB_PASSWORD', 'YOUR_SECURE_DB_PASSWORD' );
define( 'DB_HOST', 'localhost' );
```

Generate new security keys at https://api.wordpress.org/secret-key/1.1/salt/ and replace the placeholder keys in wp-config.php.

Add these lines before "That's all, stop editing!":
```php
/* Custom settings */
define( 'WP_MEMORY_LIMIT', '256M' );
define( 'DISALLOW_FILE_EDIT', true );  // Disable theme/plugin editor in admin
```

### Complete WordPress Setup

1. Visit `http://YOUR_STATIC_IP` in your browser
2. Complete the WordPress installation wizard:
   - Site Title: Your site name
   - Username: Choose an admin username (not "admin")
   - Password: Use a strong password
   - Email: Your email address
3. Log into WordPress admin at `http://YOUR_STATIC_IP/wp-admin`

### Install Plugins

Install any plugins you need via **Plugins → Add New**:
- Yoast SEO (or your preferred SEO plugin)
- Any other plugins used on your local site

---

## SSL Certificate (HTTPS)

### Install Certbot

```bash
sudo apt install -y certbot python3-certbot-nginx
```

### Obtain Certificate

**Note**: You must have a domain pointing to your server before this step.

```bash
sudo certbot --nginx -d yourdomain.com -d www.yourdomain.com
```

Follow the prompts:
- Enter email address
- Agree to terms
- Choose whether to redirect HTTP to HTTPS (recommended: Yes)

### Auto-Renewal

Certbot automatically sets up renewal. Test it:

```bash
sudo certbot renew --dry-run
```

---

## Domain Configuration

### Option A: Using a Domain Registrar (Recommended)

1. In your domain registrar (Namecheap, GoDaddy, Cloudflare, etc.):
2. Create DNS records:
   - **A Record**: `@` → Your Lightsail Static IP
   - **A Record**: `www` → Your Lightsail Static IP

3. Wait for DNS propagation (can take up to 48 hours, usually faster)

### Option B: Using Lightsail DNS

1. In Lightsail, go to **Networking** → **Create DNS zone**
2. Add your domain
3. Create A records pointing to your static IP
4. Update your domain registrar's nameservers to Lightsail's

### Update WordPress URLs

After setting up your domain:

1. Log into WordPress admin
2. Go to **Settings → General**
3. Update:
   - WordPress Address (URL): `https://yourdomain.com`
   - Site Address (URL): `https://yourdomain.com`
4. Save changes

---

## Deploying the Theme

### First-Time Setup

1. Update `deploy.sh` with your server details:
   ```bash
   cd "/Users/bradya/Local Sites/automatdo/app/public/wp-content/themes/automatdo"
   nano deploy.sh
   ```

2. Update these variables:
   ```bash
   SERVER_USER="ubuntu"
   SERVER_HOST="YOUR_STATIC_IP"  # or your domain
   SERVER_PATH="/var/www/html/wp-content/themes/automatdo"
   SSH_KEY="~/.ssh/lightsail.pem"
   ```

3. Create the theme directory on the server:
   ```bash
   ssh -i ~/.ssh/lightsail.pem ubuntu@YOUR_STATIC_IP \
     "sudo mkdir -p /var/www/html/wp-content/themes/automatdo && sudo chown -R ubuntu:www-data /var/www/html/wp-content/themes/automatdo"
   ```

### Deploy

```bash
cd "/Users/bradya/Local Sites/automatdo/app/public/wp-content/themes/automatdo"
./deploy.sh
```

The script will:
1. Show a dry-run of files to sync
2. Ask for confirmation
3. Rsync files to the server

### Activate Theme

1. Log into WordPress admin on production
2. Go to **Appearance → Themes**
3. Activate the "Automatdo" theme

---

## Database Management

### Export from Production (for local development)

On your local machine:
```bash
# SSH into server and export
ssh -i ~/.ssh/lightsail.pem ubuntu@YOUR_STATIC_IP \
  "cd /var/www/html && sudo -u www-data wp db export - --allow-root" > production-backup.sql

# Import to Local (run in Local site shell or use Local's database tool)
wp db import production-backup.sql
wp search-replace 'https://yourdomain.com' 'http://automatdo.local'
```

### Export from Local (for initial production setup)

```bash
# In Local's site shell
wp db export local-export.sql
```

Then import to production (be careful - this overwrites production data):
```bash
scp -i ~/.ssh/lightsail.pem local-export.sql ubuntu@YOUR_STATIC_IP:/tmp/
ssh -i ~/.ssh/lightsail.pem ubuntu@YOUR_STATIC_IP
cd /var/www/html
sudo -u www-data wp db import /tmp/local-export.sql
sudo -u www-data wp search-replace 'http://automatdo.local' 'https://yourdomain.com'
rm /tmp/local-export.sql
```

### Backup Production Database

Set up automated backups:

```bash
# SSH into server
ssh -i ~/.ssh/lightsail.pem ubuntu@YOUR_STATIC_IP

# Create backup script
sudo nano /home/ubuntu/backup-db.sh
```

Add:
```bash
#!/bin/bash
BACKUP_DIR="/home/ubuntu/backups"
mkdir -p $BACKUP_DIR
cd /var/www/html
sudo -u www-data wp db export "$BACKUP_DIR/wordpress-$(date +%Y%m%d-%H%M%S).sql"
# Keep only last 7 backups
ls -t $BACKUP_DIR/*.sql | tail -n +8 | xargs -r rm
```

```bash
chmod +x /home/ubuntu/backup-db.sh

# Add to crontab (runs daily at 3am)
crontab -e
# Add this line:
0 3 * * * /home/ubuntu/backup-db.sh
```

---

## Ongoing Workflow

### Daily Development

1. Start Local site
2. Make theme changes
3. Test locally
4. Commit and push:
   ```bash
   git add .
   git commit -m "Description of changes"
   git push origin main
   ```
5. Deploy:
   ```bash
   ./deploy.sh
   ```

### Adding New Plugins

1. Install and test plugin locally first
2. Install same plugin on production via WP Admin
3. Configure plugin settings on production

### Updating WordPress Core

1. Update in Local first, test thoroughly
2. Update on production via WP Admin → Updates
3. Or via SSH:
   ```bash
   ssh -i ~/.ssh/lightsail.pem ubuntu@YOUR_STATIC_IP
   cd /var/www/html
   sudo -u www-data wp core update
   sudo -u www-data wp plugin update --all
   ```

---

## Troubleshooting

### Can't Connect via SSH

```bash
# Check your key permissions
ls -la ~/.ssh/lightsail.pem
# Should show: -r--------

# Fix if needed
chmod 400 ~/.ssh/lightsail.pem

# Test connection with verbose output
ssh -v -i ~/.ssh/lightsail.pem ubuntu@YOUR_STATIC_IP
```

### Deploy Script Permission Denied

```bash
# The ubuntu user needs write access to the theme directory
ssh -i ~/.ssh/lightsail.pem ubuntu@YOUR_STATIC_IP \
  "sudo chown -R ubuntu:www-data /var/www/html/wp-content/themes/automatdo"
```

### Nginx 502 Bad Gateway

PHP-FPM might not be running:
```bash
sudo systemctl status php8.3-fpm
sudo systemctl restart php8.3-fpm
sudo systemctl restart nginx
```

### WordPress White Screen

Check PHP error logs:
```bash
sudo tail -f /var/log/nginx/error.log
sudo tail -f /var/log/php8.3-fpm.log
```

Enable WordPress debug mode temporarily:
```php
// In wp-config.php
define( 'WP_DEBUG', true );
define( 'WP_DEBUG_LOG', true );
define( 'WP_DEBUG_DISPLAY', false );
```

Then check `/var/www/html/wp-content/debug.log`

### File Upload Errors

Check Nginx and PHP limits:
```bash
# Nginx
grep client_max_body_size /etc/nginx/sites-available/default

# PHP
grep -E "upload_max_filesize|post_max_size" /etc/php/8.3/fpm/php.ini
```

### Database Connection Error

```bash
# Test MySQL is running
sudo systemctl status mysql

# Test credentials
mysql -u wpuser -p wordpress
# Enter your password when prompted
```

---

## Quick Reference

### SSH to Server
```bash
ssh -i ~/.ssh/lightsail.pem ubuntu@YOUR_STATIC_IP
```

### Deploy Theme
```bash
cd "/Users/bradya/Local Sites/automatdo/app/public/wp-content/themes/automatdo"
./deploy.sh
```

### WP-CLI on Server
```bash
cd /var/www/html
sudo -u www-data wp <command>
```

### Restart Services
```bash
sudo systemctl restart nginx
sudo systemctl restart php8.3-fpm
sudo systemctl restart mysql
```

### View Logs
```bash
# Nginx access log
sudo tail -f /var/log/nginx/access.log

# Nginx error log
sudo tail -f /var/log/nginx/error.log

# PHP errors
sudo tail -f /var/log/php8.3-fpm.log
```

---

## Estimated Costs

| Service | Monthly Cost |
|---------|-------------|
| Lightsail Instance (1GB) | $5 |
| Static IP | Free (while attached) |
| Data Transfer (first 2TB) | Free |
| **Total** | **~$5/month** |

---

## Security Checklist

- [ ] Strong WordPress admin password
- [ ] Unique database password
- [ ] SSH key authentication only (disable password auth)
- [ ] SSL certificate installed
- [ ] WordPress file editor disabled (`DISALLOW_FILE_EDIT`)
- [ ] Regular backups configured
- [ ] Keep WordPress, themes, and plugins updated
