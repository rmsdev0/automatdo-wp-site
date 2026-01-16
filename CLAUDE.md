# CLAUDE.md

This file provides guidance to Claude Code (claude.ai/code) when working with code in this repository.

## Project Overview

This is a custom WordPress theme for Automatdo, an AI voice agent company. The theme runs on Local by Flywheel for development and deploys to AWS Lightsail (Ubuntu + Nginx + PHP + MySQL).

## Common Commands

### Local Development
- Start the site via Local by Flywheel application
- Access at `http://automatdo.local`
- Changes to theme files appear immediately on browser refresh

### Deployment
```bash
./deploy.sh          # Deploy theme to production (rsync to AWS Lightsail)
```

### Git Workflow
```bash
git add .
git commit -m "message"
git push origin main
```

## Architecture

### Theme Structure
- **functions.php** - Central hub for theme setup, script/style enqueueing, SEO enhancements, and WordPress hooks
- **front-page.php** - Homepage with hero, features, audio player, and voice demo widget
- **page-*.php** - Industry-specific landing pages (TPV, fitness, home-services, contact)
- **template-parts/** - Reusable sections (solutions, testimonials, CTA)
- **assets/css/** - Page-specific stylesheets loaded conditionally based on page template
- **assets/js/** - Page-specific JavaScript, including voice-demo.js for WebSocket-based voice agent

### CSS/JS Loading Pattern
Stylesheets and scripts are conditionally loaded per page template in `functions.php:automatdo_scripts()`:
- `landing.css/js` - Base styles, loaded on all pages
- `voice-demo.css/js` - Front page only, handles WebSocket voice demo
- `tpv.css/js`, `fitness.css/js`, etc. - Loaded only on their respective page templates
- `blog.css/js` - Blog listing and single post pages

### Voice Demo Widget (front page)
The voice demo (`assets/js/voice-demo.js`) connects to a WebSocket server for real-time voice agent interaction:
- Supports multiple AI providers (OpenAI GPT-4o Realtime, xAI Grok)
- Multiple agent personas (TPV verification, fitness, home services, contact center)
- WebSocket endpoint configured via `wp_localize_script` in functions.php
- Uses AudioWorklet for microphone input processing

### SEO Implementation
- JSON-LD schema for Organization, SoftwareApplication, Article, BreadcrumbList, and WebSite
- Yoast SEO integration with default Open Graph image fallbacks
- Article schema automatically added to blog posts

### Deployment Architecture
Theme-only deployment via rsync. WordPress core, plugins, and database are managed separately on production. The deploy script:
1. Shows dry-run of changes
2. Asks for confirmation
3. Rsyncs to `/var/www/html/wp-content/themes/automatdo` on Lightsail
4. Fixes ownership to www-data

## Key Configuration

### Voice Demo WebSocket
In `functions.php`, the WebSocket endpoint is set via `voiceDemoConfig`:
- Development: `ws://localhost:8000/browser-voice-agent`
- Production: Change to `wss://app.automatdo.com/browser-voice-agent`

### Typography
- Headings: Fraunces (serif)
- Body: Instrument Sans (sans-serif)
- Brand color: #d4a530 (gold)
