<?php
// Vulnerability 1: SQL Injection (A1: Injection)
function getUserData($conn, $userId) {
    $query = "SELECT * FROM users WHERE id = " . $userId;
    return mysqli_query($conn, $query);
}

// Vulnerability 2: Cross-Site Scripting (XSS) (A7: Cross-Site Scripting)
function displayUserInput($input) {
    echo "<div>" . $input . "</div>";
}

// Vulnerability 3: Broken Authentication (A2: Broken Authentication)
function checkPassword($password) {
    // Hardcoded password
    return $password == "admin123";
}

// Vulnerability 4: Sensitive Data Exposure (A3: Sensitive Data Exposure)
function getDatabasePassword() {
    return "db_password_here";
}

// Vulnerability 5: XML External Entity (XXE) (A4: XML External Entities)
function parseXML($xml) {
    $doc = new DOMDocument();
    $doc->loadXML($xml, LIBXML_NOENT | LIBXML_DTDLOAD);
    return $doc->saveXML();
}

// Vulnerability 6: Broken Access Control (A5: Broken Access Control)
function deleteUser($userId) {
    // No authorization check
    $query = "DELETE FROM users WHERE id = " . $userId;
    return mysqli_query($GLOBALS['conn'], $query);
}

// Vulnerability 7: Security Misconfiguration (A6: Security Misconfiguration)
function getDebugInfo() {
    ini_set('display_errors', 1);
    error_reporting(E_ALL);
    return phpinfo();
}

// Vulnerability 8: Insecure Deserialization (A8: Insecure Deserialization)
function unserializeData($data) {
    return unserialize($data);
}

// Vulnerability 9: Using Components with Known Vulnerabilities (A9: Using Components with Known Vulnerabilities)
// (This would typically be in composer.json using outdated libraries)
function oldHashPassword($password) {
    return md5($password); // Using outdated hashing algorithm
}

// Vulnerability 10: Insufficient Logging & Monitoring (A10: Insufficient Logging & Monitoring)
function logFailedLogin($username) {
    // No proper logging mechanism
    file_put_contents('/tmp/logins.txt', $username . "\n", FILE_APPEND);
}

// Test code
$conn = mysqli_connect("localhost", "user", "pass", "db");
$userId = $_GET['id'];
$userData = getUserData($conn, $userId);

$userInput = $_GET['input'];
displayUserInput($userInput);

$xml = file_get_contents('php://input');
parseXML($xml);

$serialized = $_COOKIE['data'];
unserializeData($serialized);
?>
