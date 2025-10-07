<?php
$option = [
    pdo::ATTR_ERRMODE => pdo::ERRMODE_EXCEPTION
];

try {
    $config= parse_ini_file($_SERVER["DOCUMENT_ROOT"]."/siteweb/.env");
    $pdo = new PDO("mysql:dbname={$config["db_name"]};host={$config["db_host"]};charset=utf8mb4",$config["db_user"], $config["db_password"], $option);
} catch (PDOException $e) {
    die("Erreur de connexion : " . $e->getMessage());
}

?>