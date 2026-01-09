# Automatdo WordPress Theme

Custom WordPress theme for Automatdo.

## Requirements

- [Local by Flywheel](https://localwp.com/) for local development
- Git
- SSH access to production server

## Project Structure

```
automatdo/
├── assets/
│   ├── css/          # Stylesheets
│   ├── js/           # JavaScript files
│   ├── images/       # Theme images
│   └── audio/        # Audio files
├── template-parts/   # Reusable template components
├── style.css         # Theme metadata & base styles
├── functions.php     # Theme functions & hooks
├── header.php        # Site header
├── footer.php        # Site footer
├── front-page.php    # Homepage template
├── index.php         # Default template
├── single.php        # Single post template
├── home.php          # Blog listing template
├── page-*.php        # Custom page templates
├── deploy.sh         # Deployment script
└── DEPLOYMENT.md     # Full deployment documentation
```

## Local Development

### Setup

1. Clone this repo into your Local site's theme directory:
   ```bash
   cd "/Users/bradya/Local Sites/automatdo/app/public/wp-content/themes"
   git clone git@github.com:YOUR_USERNAME/automatdo.git
   ```

2. Start the site in Local by Flywheel

3. Activate the theme in WordPress Admin → Appearance → Themes

### Development Workflow

1. Start your Local site
2. Edit theme files
3. Refresh browser to see changes
4. Commit when ready:
   ```bash
   git add .
   git commit -m "Your commit message"
   git push origin main
   ```

## Deployment

### Quick Deploy

```bash
./deploy.sh
```

### First-Time Setup

1. Configure `deploy.sh` with your server details:
   ```bash
   SERVER_HOST="your-server-ip"
   SSH_KEY="~/.ssh/lightsail.pem"
   ```

2. See [DEPLOYMENT.md](DEPLOYMENT.md) for full server setup instructions.

## Page Templates

| Template | Purpose |
|----------|---------|
| `front-page.php` | Homepage |
| `page-fitness.php` | Fitness landing page |
| `page-home-services.php` | Home services landing page |
| `page-tpv.php` | TPV landing page |
| `single.php` | Individual blog posts |
| `home.php` | Blog listing page |

## License

Private - All rights reserved.
