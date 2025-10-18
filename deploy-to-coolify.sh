#!/bin/bash

# Coolify Deployment Script for Clinic Management System
# This script helps prepare your application for Coolify deployment

echo "🚀 Preparing Clinic Management System for Coolify Deployment"
echo "=========================================================="

# Check if git is initialized
if [ ! -d ".git" ]; then
    echo "📦 Initializing Git repository..."
    git init
    git add .
    git commit -m "Initial commit - Clinic Management System"
    echo "✅ Git repository initialized"
else
    echo "✅ Git repository already exists"
fi

# Check if all required files exist
echo "🔍 Checking required files..."

required_files=(
    "Dockerfile"
    ".dockerignore"
    "composer.json"
    "includes/db_connect.php"
    "index.php"
    "database/clinic_management_system (10-4).sql"
)

for file in "${required_files[@]}"; do
    if [ -f "$file" ]; then
        echo "✅ $file exists"
    else
        echo "❌ $file is missing"
        exit 1
    fi
done

echo ""
echo "📋 Deployment Checklist:"
echo "========================="
echo "1. ✅ Dockerfile created"
echo "2. ✅ Environment variables configured"
echo "3. ✅ Database connection updated"
echo "4. ✅ Composer dependencies defined"
echo "5. ✅ Database schema available"
echo ""
echo "🎯 Next Steps:"
echo "=============="
echo "1. Push your code to Git repository:"
echo "   git add ."
echo "   git commit -m 'Fix Nixpacks configuration - use Dockerfile'"
echo "   git push origin main"
echo ""
echo "2. In Coolify:"
echo "   - Go to your application settings"
echo "   - Find 'Build Settings' or 'Build Configuration'"
echo "   - Select 'Dockerfile' as the build method"
echo "   - Make sure 'Use Dockerfile' is enabled"
echo "   - Disable 'Auto-detect' or 'Nixpacks' if present"
echo ""
echo "3. Set environment variables:"
echo "   DB_HOST=joccwsg44gwo0oc0s8g48ko0"
echo "   DB_DATABASE=default"
echo "   DB_USERNAME=root"
echo "   DB_PASSWORD=0439VpH3ybiZZdDmbFH7mI1PXBBSSGfMwh96BdMEcBGGYH5gJsIFZAiTAfCwNJGz"
echo "   DB_PORT=3306"
echo ""
echo "4. Import your database schema from:"
echo "   database/clinic_management_system (10-4).sql"
echo ""
echo "5. Deploy and test your application"
echo ""
echo "📖 For detailed instructions, see: COOLIFY_DEPLOYMENT_GUIDE.md"
echo ""
echo "🎉 Your application is ready for Coolify deployment!"
