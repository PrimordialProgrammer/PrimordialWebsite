<?php
$DB_SERVER = 'localhost';
$DB_USERNAME = 'root';
$DB_PASSWORD = '';
$DB_DATABASE = 'db_wbapp';

try {
    $conn = new PDO("mysql:host=$DB_SERVER;dbname=$DB_DATABASE", $DB_USERNAME, $DB_PASSWORD);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}
?>
