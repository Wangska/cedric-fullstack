# 🚀 Coolify Deployment Guide - Clinic Management System

## 📋 **Prerequisites**

1. **Coolify instance** running and accessible
2. **MySQL database** (can be external or managed by Coolify)
3. **Git repository** with your code (GitHub, GitLab, etc.)
4. **Domain name** (optional, can use Coolify's provided domain)

## 🗄️ **Database Setup**

### **Option 1: External MySQL Database (Recommended)**
- Use your existing TablePlus database
- Ensure it's accessible from Coolify's servers
- Use the connection details you provided:
  ```
  DB_HOST=joccwsg44gwo0oc0s8g48ko0
  DB_DATABASE=default
  DB_USERNAME=root
  DB_PASSWORD=0439VpH3ybiZZdDmbFH7mI1PXBBSSGfMwh96BdMEcBGGYH5gJsIFZAiTAfCwNJGz
  DB_PORT=3306
  ```

### **Option 2: Coolify Managed Database**
- Create a MySQL service in Coolify
- Import your database schema
- Use the internal connection details

## 🐳 **Docker Configuration**

The application includes:
- ✅ **Dockerfile** - Ready for containerization
- ✅ **Environment variables** - Database configuration
- ✅ **PHP 8.2** with Apache
- ✅ **Required extensions** - PDO, MySQL, GD, etc.
- ✅ **Composer dependencies** - mPDF for PDF generation

## 🚀 **Deployment Steps**

### **Step 1: Prepare Your Repository**

1. **Push your code to Git:**
   ```bash
   git add .
   git commit -m "Add Coolify deployment configuration"
   git push origin main
   ```

2. **Verify these files are in your repository:**
   - `Dockerfile`
   - `.dockerignore`
   - `composer.json`
   - `includes/db_connect.php` (updated with env vars)

### **Step 2: Create Application in Coolify**

1. **Login to Coolify**
2. **Click "New Application"**
3. **Select "Git Repository"**
4. **Connect your Git provider** (GitHub/GitLab)
5. **Select your repository**
6. **Choose "Dockerfile" as build method**

### **Step 3: Configure Environment Variables**

In Coolify's application settings, add these environment variables:

```env
# Database Configuration
DB_CONNECTION=mysql
DB_HOST=joccwsg44gwo0oc0s8g48ko0
DB_DATABASE=default
DB_USERNAME=root
DB_PASSWORD=0439VpH3ybiZZdDmbFH7mI1PXBBSSGfMwh96BdMEcBGGYH5gJsIFZAiTAfCwNJGz
DB_PORT=3306

# Application Configuration
APP_NAME="Clinic Management System"
APP_ENV=production
APP_DEBUG=false
```

### **Step 4: Database Import**

1. **Access your TablePlus database**
2. **Export your database schema and data:**
   ```sql
   -- Use the provided SQL file: database/clinic_management_system (10-4).sql
   ```
3. **Import the SQL file** into your database
4. **Verify all tables are created:**
   - `users`
   - `faculty`
   - `imported_patients`
   - `appointments`
   - `logs`
   - And other tables from your schema

### **Step 5: Deploy Application**

1. **Click "Deploy" in Coolify**
2. **Wait for build to complete** (5-10 minutes)
3. **Check build logs** for any errors
4. **Verify application is running**

### **Step 6: Configure Domain (Optional)**

1. **Go to application settings**
2. **Add custom domain** (if you have one)
3. **Or use Coolify's provided domain**
4. **Configure SSL certificate**

## 🔧 **Post-Deployment Configuration**

### **File Permissions**
The application needs write access to:
- `uploads/` directory
- `email_logs/` directory

### **Email Configuration**
If you need email functionality, add these environment variables:
```env
MAIL_HOST=your-smtp-host
MAIL_PORT=587
MAIL_USERNAME=your-email
MAIL_PASSWORD=your-password
MAIL_ENCRYPTION=tls
```

### **PDF Generation**
The application uses mPDF for PDF reports. This is already configured in the Dockerfile.

## 🧪 **Testing Your Deployment**

### **1. Basic Functionality Test**
- Visit your application URL
- Test the login system
- Verify database connectivity

### **2. User Role Testing**
- **Admin Login:** Test admin dashboard access
- **Staff Login:** Test doctor/nurse dashboard
- **Student Login:** Test student portal
- **Faculty Login:** Test faculty portal

### **3. Feature Testing**
- Create appointments
- View patient records
- Generate reports
- Test PDF export functionality

## 🚨 **Troubleshooting**

### **Common Issues:**

1. **Database Connection Failed**
   - Verify environment variables are correct
   - Check database server accessibility
   - Ensure database exists

2. **File Upload Issues**
   - Check file permissions
   - Verify upload directory exists
   - Check PHP upload limits

3. **PDF Generation Errors**
   - Verify mPDF is installed
   - Check PHP memory limits
   - Verify file paths

4. **Session Issues**
   - Check session configuration
   - Verify session storage
   - Clear browser cache

### **Debug Steps:**

1. **Check application logs** in Coolify
2. **Verify environment variables** are set correctly
3. **Test database connection** manually
4. **Check file permissions**
5. **Verify all dependencies** are installed

## 📊 **Monitoring & Maintenance**

### **Health Checks**
- Set up health check endpoints
- Monitor application performance
- Check database connectivity

### **Backups**
- Regular database backups
- Application file backups
- Environment configuration backup

### **Updates**
- Keep PHP and dependencies updated
- Monitor security updates
- Test updates in staging first

## 🎯 **Production Optimizations**

### **Performance**
- Enable PHP OPcache
- Configure proper caching
- Optimize database queries
- Use CDN for static assets

### **Security**
- Use HTTPS only
- Implement proper authentication
- Regular security updates
- Database access restrictions

## 📱 **Access Your Application**

After successful deployment:
- **Production URL:** `https://your-domain.com`
- **Admin Dashboard:** `https://your-domain.com/admin/dashboard.php`
- **Staff Dashboard:** `https://your-domain.com/staff/dashboard.php`
- **Student Portal:** `https://your-domain.com/patient/profile.php`
- **Faculty Portal:** `https://your-domain.com/faculty/profile.php`

## 🎉 **Success Checklist**

- ✅ Application builds successfully
- ✅ Database connection works
- ✅ All user roles can login
- ✅ File uploads work
- ✅ PDF generation works
- ✅ Email functionality works (if configured)
- ✅ SSL certificate is active
- ✅ Application is accessible from internet

---

**Your Clinic Management System is now live on Coolify!** 🚀

*Need help? Check the troubleshooting section or contact support.*
