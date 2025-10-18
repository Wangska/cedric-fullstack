<?php
// Simple landing page for Coolify deployment
include 'includes/db_connect.php';
session_start();

// Make database connection variables available globally
$host = $_ENV['DB_HOST'] ?? 'localhost';
$dbname = $_ENV['DB_DATABASE'] ?? 'clinic_management_system';
$username = $_ENV['DB_USERNAME'] ?? 'root';
$password = $_ENV['DB_PASSWORD'] ?? '';
$port = $_ENV['DB_PORT'] ?? '3306';
$dsn = "mysql:host=$host;port=$port;dbname=$dbname;charset=utf8mb4";

// Test database connection
$db_connected = false;
try {
    $test_db = new PDO($dsn, $username, $password);
    $test_db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $db_connected = true;
} catch (Exception $e) {
    $db_error = $e->getMessage();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Clinic Management System</title>
    <script src="https://cdn.tailwindcss.com/3.4.16"></script>
    <style>
        .gradient-text {
            background: linear-gradient(135deg, #FCD34D 0%, #F59E0B 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
    </style>
</head>
<body class="bg-gray-100 min-h-screen flex items-center justify-center">
    <div class="max-w-4xl mx-auto p-8">
        <div class="bg-white rounded-lg shadow-lg p-8">
            <div class="text-center mb-8">
                <h1 class="text-4xl font-bold text-gray-900 mb-4">
                    Clinic Management <span class="gradient-text">System</span>
                </h1>
                <p class="text-xl text-gray-600">St. Cecilia's College</p>
            </div>
            
            <div class="grid md:grid-cols-2 gap-8">
                <!-- Application Status -->
                <div class="bg-green-50 border border-green-200 rounded-lg p-6">
                    <h2 class="text-xl font-semibold text-green-800 mb-4">✅ Application Status</h2>
                    <ul class="space-y-2 text-green-700">
                        <li>✅ PHP is working</li>
                        <li>✅ Application deployed</li>
                        <li>✅ Files accessible</li>
                        <li>✅ Web server running</li>
                    </ul>
                </div>
                
                <!-- Database Status -->
                <div class="bg-blue-50 border border-blue-200 rounded-lg p-6">
                    <h2 class="text-xl font-semibold text-blue-800 mb-4">🗄️ Database Status</h2>
                    <?php if ($db_connected): ?>
                        <ul class="space-y-2 text-blue-700">
                            <li>✅ Database connected</li>
                            <li>✅ Host: <?php echo htmlspecialchars($host); ?></li>
                            <li>✅ Database: <?php echo htmlspecialchars($dbname); ?></li>
                            <li>✅ Port: <?php echo htmlspecialchars($port); ?></li>
                        </ul>
                    <?php else: ?>
                        <ul class="space-y-2 text-red-700">
                            <li>❌ Database connection failed</li>
                            <li>❌ Error: <?php echo htmlspecialchars($db_error ?? 'Unknown error'); ?></li>
                        </ul>
                    <?php endif; ?>
                </div>
            </div>
            
            <!-- Navigation -->
            <div class="mt-8 text-center">
                <a href="admin/dashboard.php" class="bg-blue-600 text-white px-6 py-3 rounded-lg hover:bg-blue-700 transition-colors inline-block mr-4">
                    Admin Dashboard
                </a>
                <a href="staff/dashboard.php" class="bg-green-600 text-white px-6 py-3 rounded-lg hover:bg-green-700 transition-colors inline-block mr-4">
                    Staff Dashboard
                </a>
                <a href="patient/profile.php" class="bg-purple-600 text-white px-6 py-3 rounded-lg hover:bg-purple-700 transition-colors inline-block">
                    Patient Portal
                </a>
            </div>
            
            <!-- Debug Info -->
            <div class="mt-8 bg-yellow-50 border border-yellow-200 rounded-lg p-4">
                <h3 class="text-lg font-semibold text-yellow-800 mb-2">🐛 Debug Information</h3>
                <p class="text-yellow-700 text-sm">
                    <strong>Current Directory:</strong> <?php echo getcwd(); ?><br>
                    <strong>Document Root:</strong> <?php echo $_SERVER['DOCUMENT_ROOT'] ?? 'Unknown'; ?><br>
                    <strong>Script Name:</strong> <?php echo $_SERVER['SCRIPT_NAME'] ?? 'Unknown'; ?><br>
                    <strong>Request URI:</strong> <?php echo $_SERVER['REQUEST_URI'] ?? 'Unknown'; ?>
                </p>
            </div>
        </div>
    </div>
</body>
</html>
