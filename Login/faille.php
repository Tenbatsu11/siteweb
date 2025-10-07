<?php

$option = [
    pdo::ATTR_ERRMODE => pdo::ERRMODE_EXCEPTION
];


//Connexion a la bdd

require_once '../libs/pdo.php';

$username = htmlspecialchars($_POST['username'], ENT_QUOTES, 'UTF-8');
$password = htmlspecialchars($_POST['password'], ENT_QUOTES, 'UTF-8');

//requete preparée

$pdo_prep = $pdo->prepare("SELECT id, username, email, password from users where username = :username");
$pdo_prep->bindValue(':username', $username);
$pdo_prep->execute();
$user = $pdo_prep->fetch(PDO::FETCH_ASSOC);


if($user && password_verify($password, $user['password']))
{
    return $user;
} else {
    echo "Nom d'utilisateur ou mot de passe incorrect !";
}
?>