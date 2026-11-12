<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Generate CSRF Token
function generateCSRFToken() {

    if (empty($_SESSION['csrf_token'])) {
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    }

    return $_SESSION['csrf_token'];
}

// Display CSRF Token in Form
function csrfField() {

    $token = htmlspecialchars(
        generateCSRFToken(),
        ENT_QUOTES,
        'UTF-8'
    );

    return '<input type="hidden" name="csrf_token" value="' . $token . '">';
}

// Verify CSRF Token
function verifyCSRFToken() {

    $token = $_POST['csrf_token'] ?? '';

    if (
        empty($_SESSION['csrf_token']) ||
        !hash_equals($_SESSION['csrf_token'], $token)
    ) {
        die("Invalid request. Please try again.");
    }
}

?>
