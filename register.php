<?php
header("Access-Control-Allow-Origin: *");
header('Content-Type: application/json; charset=UTF-8');
require_once 'connexion.php';

// creation de compte
try {
    //code...
    if (isset($_POST['email']) && isset($_POST['password'])) {
        $email = $_POST['email'];
        $password = $_POST['password'];
        // crypter le mot de passe
        $password = password_hash($password, PASSWORD_DEFAULT);

        $sql  = "INSERT INTO users (email, password) VALUES (?, ?)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$email, $password]);

        echo json_encode([
            "success" => true,
            "message" => "Account created successfully"
        ]);
    } else {
        echo json_encode([
            "success" => false,
            "message" => "Email and password are required"
        ]);
    }
} catch (PDOException $e) {
    echo json_encode([
        "success" => false,
        "message" => "Database error: " . $e->getMessage()
    ]);
}
