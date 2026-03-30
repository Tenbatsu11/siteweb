<?php
session_start();
if (!isset($_SESSION['user'])) {
    header('Location: https://localhost/siteweb/Login/login.php');
    exit();
} else {
    require_once(__DIR__ . '/assets/templates/header.php');
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Desktop App - Kumiai</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
        <link rel="stylesheet" href="/siteweb/assets/css/override-boostrap.css">
    </head>
    <body>
        <main class="fade-in">
            <div class="container">
                <h1>Bienvenue sur l'application de bureau de Kumiai, <?= htmlspecialchars($_SESSION['user']['username']) ?>!</h1>
                <p>Cette application vous permet d'accéder à toutes les fonctionnalités de Kumiai directement depuis votre bureau.</p>
                <ul>
                    <li><strong>Accès rapide:</strong> Ouvrez l'application pour accéder instantanément à vos leçons, exercices et statistiques.</li>
                    <li><strong>Notifications:</strong> Recevez des notifications pour les nouveaux contenus, les rappels d'étude et les mises à jour importantes.</li>
                    <li><strong>Utilisation:</strong> L'application pour ordinateur est concçue pour être utilisée en parallèle avec le jeu Kumiai GO</li>
                </ul>
            </div>
            <div class="container mt-4">
                <h2>Comment installer l'application de bureau ?</h2>
                <p>Pour installer l'application de bureau de Kumiai, suivez ces étapes :</p>
                <ol>
                    <li><strong>Téléchargez l'installateur:</strong>Cliquez sur ce lien de téléchargement : <a href="link/to/your/download/file" download>Télécharger</a> </li>
                    <li><strong>Exécutez l'installateur:</strong> Ouvrez le fichier téléchargé et suivez les instructions à l'écran pour installer l'application.</li>
                    <li><strong>Connectez-vous:</strong> Une fois l'installation terminée, ouvrez l'application et connectez-vous avec vos identifiants Kumiai pour accéder à votre compte.</li>
                </ol>
        </main>
        <?php
    require_once(__DIR__ . '/assets/templates/footer.php');
    ?>
    </body>
</html>