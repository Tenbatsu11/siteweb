<?php

function verifyUserLogin($username, $password, PDO $pdo) {
    // Préparer la requête SQL pour récupérer l'utilisateur par nom d'utilisateur
    $pdo_prep = $pdo->prepare("SELECT id, username, email, password FROM users WHERE username = :username");
    $pdo_prep->bindValue(':username', $username);
    $pdo_prep->execute();
    $user = $pdo_prep->fetch(PDO::FETCH_ASSOC);

    // Vérifier si l'utilisateur existe et si le mot de passe correspond
    if ($user && password_verify($password, $user['password'])) {
        return $user; // Retourner les informations de l'utilisateur si les identifiants sont corrects
    } else {
        return false; // Retourner false si les identifiants sont incorrects
    }
}
function addUser($username, $email, $password,PDO $pdo) {
    // Hacher le mot de passe avant de le stocker
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Préparer la requête SQL pour insérer un nouvel utilisateur
    $pdo_prep = $pdo->prepare("INSERT INTO users (username, email, password) VALUES (:username, :email, :password)");
    $pdo_prep->bindValue(':username', $username);
    $pdo_prep->bindValue(':email', $email);
    $pdo_prep->bindValue(':password', $hashedPassword);

    // Exécuter la requête et vérifier si l'insertion a réussi
    return $pdo_prep->execute();
}

function verifyUser($user): array|bool
    {
        $error = [];
        if (empty($user['username']) || empty($user['password']) || empty($user['email']) || empty($user['confirm_password'])) {
            $error[] = "Tous les champs sont obligatoires.";
        } elseif (!filter_var($user['email'], FILTER_VALIDATE_EMAIL)) {
            $error[] = "Adresse email invalide.";
        }elseif (strlen($user['password']) < 8) {
            $error[] = "Le mot de passe doit contenir au moins 6 caractères.";
        } elseif ($user['password'] !== $user['confirm_password']) {
            $error[] = "Les mots de passe ne correspondent pas.";
        } else {
            return true;
        }
    }
