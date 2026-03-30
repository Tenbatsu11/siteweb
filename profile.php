<?php
session_start();
if (!isset($_SESSION['user'])) {
    header('Location: https://localhost/siteweb/Login/login.php');
    exit();
}

require_once(__DIR__ . '/libs/pdo.php');
require_once(__DIR__ . '/libs/user.php');

$message = '';
$error = '';

// Traiter la modification du nom d'utilisateur
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['new_username'])) {
    try {
        $newUsername = trim($_POST['new_username']);
        $userId = $_SESSION['user']['id'];
        $currentUsername = $_SESSION['user']['username'];

        // Valider le nouveau nom d'utilisateur
        $validationResult = validateNewUsername($newUsername, $currentUsername, $userId, $pdo);
        
        if ($validationResult === true) {
            // Mettre à jour le nom d'utilisateur
            if (updateUsername($userId, $newUsername, $pdo)) {
                $_SESSION['user']['username'] = $newUsername;
                $message = "Nom d'utilisateur modifié avec succès!";
            } else {
                $error = "Une erreur est survenue lors de la modification du nom d'utilisateur.";
            }
        } else {
            // $validationResult est un tableau d'erreurs
            $error = implode("<br>", $validationResult);
        }
    } catch (Exception $e) {
        $error = "Erreur: Une erreur inattendue est survenue. Veuillez réessayer plus tard.";
    }
}

require_once(__DIR__ . '/assets/templates/header.php');
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Profile - Kumiai</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
        <link rel="stylesheet" href="/siteweb/assets/css/override-boostrap.css">
    </head>
    <body>
        <main class="fade-in">
            <div class="container mt-4">
                <h1>Votre Profil</h1>
                
                
                <?php if (!empty($message)): ?>
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <?= htmlspecialchars($message) ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php endif; ?>

                <?php if (!empty($error)): ?>
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <?= $error ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php endif; ?>

            
                <div class="card mb-4">
                    <div class="card-header">
                        <h5 class="mb-0">Informations de Compte</h5>
                    </div>
                    <div class="card-body">
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <strong>Nom d'utilisateur:</strong>
                                <p><?= htmlspecialchars($_SESSION['user']['username']) ?></p>
                            </div>
                            <div class="col-md-6">
                                <strong>Email:</strong>
                                <p><?= htmlspecialchars($_SESSION['user']['email']) ?></p>
                            </div>
                        </div>
                    </div>
                </div>

                
                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0">Modifier le Nom d'Utilisateur</h5>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="">
                            <div class="mb-3">
                                <label for="new_username" class="form-label">Nouveau nom d'utilisateur</label>
                                <input 
                                    type="text" 
                                    class="form-control" 
                                    id="new_username" 
                                    name="new_username" 
                                    placeholder="Entrez votre nouveau nom d'utilisateur"
                                    pattern="[a-zA-Z0-9_]{3,20}"
                                    title="Le nom d'utilisateur doit contenir entre 3 et 20 caractères (lettres, chiffres, underscores uniquement)"
                                    required
                                >
                                <small class="form-text text-muted">
                                    Le nom d'utilisateur doit:
                                    <ul class="mt-2">
                                        <li>Contenir entre 3 et 20 caractères</li>
                                        <li>Ne contenir que des lettres, chiffres et underscores</li>
                                    </ul>
                                </small>
                            </div>
                            <button type="submit" class="btn btn-primary">Modifier le nom d'utilisateur</button>
                        </form>
                    </div>
                </div>
            </div>
        </main>
        <?php
    require_once(__DIR__ . '/assets/templates/footer.php');
    ?>
    </body>
</html>