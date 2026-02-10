<?php
header("Access-Control-Allow-Origin: *");
header('Content-Type: application/json; charset=UTF-8');
require_once 'connexion.php';

try {
    if (isset($_POST['email']) && isset($_POST['password'])) {
        $email    = $_POST['email'];
        $password = $_POST['password'];

        // ✅ 1. Récupérer l'utilisateur par email seulement (requête préparée)
        $sql  = "SELECT * FROM users WHERE email = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        // ✅ 2. Vérifier le mot de passe avec password_verify()
        if ($user && password_verify($password, $user['password'])) {
            http_response_code(200);
            echo json_encode([
                "success" => true,
                "message" => "Login successful",
                "user"    => $user
            ]);
        } else {
            http_response_code(400);
            echo json_encode([
                "success" => false,
                "message" => "Email ou mot de passe invalide"
            ]);
        }
    } else {
        http_response_code(400);
        echo json_encode([
            "success" => false,
            "message" => "Email et mot de passe requis"
        ]);
    }
} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode([
        "success" => false,
        "message" => "Erreur base de données : " . $e->getMessage()
    ]);
}