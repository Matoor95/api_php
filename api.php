<?php
header("Access-Control-Allow-Origin: *");
header('Content-Type: application/json; charset=UTF-8');

require_once 'connexion.php';

//code...
try {
    //code...
    $sql="SELECT id, libelle, prix, description  FROM produits";
    $stmt=$pdo->query($sql);
    $produits=$stmt->fetchAll(PDO::FETCH_ASSOC);

    http_response_code(200);
    echo json_encode([
        "success"=>true,
        "produits"=>$produits
    ]);
} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode([
        "success"=>false,
        "message"=>"Erreur de connexion a la base de donnees ". $e->getMessage()
    ]);

    //throw $th;
}