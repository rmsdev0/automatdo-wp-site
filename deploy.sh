cat > deploy.sh << 'EOF'
#!/bin/bash

# ===========================================
# Deploy script for automatdo WordPress theme
# ===========================================

# Configuration
SERVER_USER="ubuntu"
SERVER_HOST="16.58.81.95"
SERVER_PATH="/var/www/html/wp-content/themes/automatdo"
SSH_KEY="~/.ssh/lightsail.pem"

# Colors for output
RED='\033[0;31m'
GREEN='\033[0;32m'
YELLOW='\033[1;33m'
NC='\033[0m'

# Check if server is configured
if [ "$SERVER_HOST" = "YOUR_SERVER_IP" ]; then
    echo -e "${RED}Error: Please configure SERVER_HOST in deploy.sh${NC}"
    exit 1
fi

# Get script directory (theme root)
SCRIPT_DIR="$(cd "$(dirname "${BASH_SOURCE[0]}")" && pwd)"

echo -e "${YELLOW}Deploying theme to ${SERVER_HOST}...${NC}"

# Dry run first to show what will change
echo -e "${YELLOW}Files to sync:${NC}"
rsync -avz --dry-run --delete \
    --exclude '.git' \
    --exclude '.gitignore' \
    --exclude 'deploy.sh' \
    --exclude 'README.md' \
    --exclude 'DEPLOYMENT.md' \
    --exclude 'node_modules' \
    --exclude '.DS_Store' \
    -e "ssh -i ${SSH_KEY}" \
    "${SCRIPT_DIR}/" \
    "${SERVER_USER}@${SERVER_HOST}:${SERVER_PATH}/"

# Confirm deployment
echo ""
read -p "Proceed with deployment? (y/n) " -n 1 -r
echo ""

if [[ $REPLY =~ ^[Yy]$ ]]; then
    rsync -avz --delete \
        --exclude '.git' \
        --exclude '.gitignore' \
        --exclude 'deploy.sh' \
        --exclude 'README.md' \
        --exclude 'DEPLOYMENT.md' \
        --exclude 'node_modules' \
        --exclude '.DS_Store' \
        -e "ssh -i ${SSH_KEY}" \
        "${SCRIPT_DIR}/" \
        "${SERVER_USER}@${SERVER_HOST}:${SERVER_PATH}/"

    # Fix permissions
    echo -e "${YELLOW}Fixing permissions...${NC}"
    ssh -i ${SSH_KEY} ${SERVER_USER}@${SERVER_HOST} "sudo chown -R www-data:www-data ${SERVER_PATH} && sudo chmod -R 755 ${SERVER_PATH}"

    echo -e "${GREEN}Deployment complete!${NC}"
else
    echo -e "${RED}Deployment cancelled.${NC}"
fi
EOF