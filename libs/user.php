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

function verifyUser($user, PDO $pdo): array|bool
    {
        $error = [];
        if (isset($user['username'])) {
            if (strlen($user['username']) < 3 || strlen($user['username']) > 20) {
                $error["username"] = "Le nom d'utilisateur doit contenir entre 3 et 20 caractères.";
            } elseif (!preg_match('/^[a-zA-Z0-9_]+$/', $user['username'])) {
                $error["username"] = "Le nom d'utilisateur ne peut contenir que des lettres, des chiffres et des underscores.";
            }
        } else {
            $error["username"] = "Le nom d'utilisateur est requis.";
        }

        if (isset($user['email'])) {
            if (!filter_var($user['email'], FILTER_VALIDATE_EMAIL) || strlen($user['email']) > 50) {
                $error["email"] = "L'adresse email n'est pas valide.";
            } else {
                // Vérifier si l'email est déjà utilisé
                $pdo_prep = $pdo->prepare("SELECT email FROM users WHERE email = :email");
                $pdo_prep->bindValue(':email', $user['email']);
                $pdo_prep->execute();

                if ($pdo_prep->rowCount() > 0) {
                    $error["email"] = "Cet email est déjà utilisé.";
                }
            }
        } else {
            $error["email"] = "L'adresse email est requise.";
        }

        if (isset($user['password'])) {
            if (strlen($user['password']) < 6) {
                $error["password"] = "Le mot de passe doit contenir au moins 6 caractères.";
            }
        } else {
            $error["password"] = "Le mot de passe est requis.";
        }

        if (isset($user['confirm_password'])) {
            if ($user['password'] !== $user['confirm_password']) {
                $error["confirm_password"] = "Les mots de passe ne correspondent pas.";
            }
        } else {
            $error["confirm_password"] = "La confirmation du mot de passe est requise.";
        }

        if (empty($error)) {
            return true;
        } else {
            return $error;
        }
    }
