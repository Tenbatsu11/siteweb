<?php
/*
require_once '../libs/pdo.php';

//accès au formulaire d'insription
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = htmlspecialchars(trim($_POST['username']));
    $email = htmlspecialchars(trim($_POST['email']));
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    if (empty($username) || empty($email) || empty($password) || empty($confirm_password)) {
        echo "Tous les champs sont obligatoires.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Adresse email invalide.";
    } elseif ($password !== $confirm_password) {
        echo "Les mots de passe ne correspondent pas.";
    } else {
        //email deja utilise
        $pdo_prep = $pdo->prepare("SELECT email FROM users WHERE email = :email");
        $pdo_prep->bindValue(':email', $email);
        $pdo_prep->execute();

        if ($pdo_prep->rowCount() > 0) {
            echo "Cet email est déjà utilisé.";
        } else {
            //Hacher le mot de passe
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);

            //Insérer dans la DB
            $pdo_prep = $pdo->prepare("INSERT INTO users (id, username, email, password) VALUES (UUID(), ?, ?, ?)");
            if ($pdo_prep->execute([$username, $email, $hashed_password])) {
                echo "Inscription réussie !";
            } else {
                echo "Erreur lors de l'inscription.";
            }
        }
    }
} else {
    echo "Erreur lors de la demande d'accès.";
}
?>