<?php
// Database connection for all includes
try {
	// Use environment variables for database connection
	$host = $_ENV['DB_HOST'] ?? 'localhost';
	$dbname = $_ENV['DB_DATABASE'] ?? 'clinic_management_system';
	$username = $_ENV['DB_USERNAME'] ?? 'root';
	$password = $_ENV['DB_PASSWORD'] ?? '';
	$port = $_ENV['DB_PORT'] ?? '3306';
	
	$dsn = "mysql:host=$host;port=$port;dbname=$dbname;charset=utf8mb4";
	$db = new PDO($dsn, $username, $password);
	$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (Exception $e) {
	die('Database connection error: ' . $e->getMessage());
}
?>