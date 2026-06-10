<?php
// Page accessible only to logged-in admin users and usually navigated from adminpage.php
session_start();

// Check session login
if (!isset($_SESSION['user'])) {
    header('Location: https://localhost/siteweb/Login/login.php');
    exit();
}

// Admin flag - adapt to your session structure. Common keys: $_SESSION['user']['is_admin'] or $_SESSION['is_admin']
$isAdmin = false;
if (isset($_SESSION['user']['is_admin'])) {
    $isAdmin = (bool)$_SESSION['user']['is_admin'];
} elseif (isset($_SESSION['is_admin'])) {
    $isAdmin = (bool)$_SESSION['is_admin'];
}

if (!$isAdmin) {
    die('Accès réservé aux administrateurs.');
}

// Optional: enforce referer came from adminpage.php (best-effort; can be spoofed)
$refererOk = false;
if (isset($_SERVER['HTTP_REFERER'])) {
    $ref = parse_url($_SERVER['HTTP_REFERER']);
    if (isset($ref['path']) && strpos($ref['path'], '/siteweb/assets/templates/adminpage.php') !== false) {
        $refererOk = true;
    }
}

if (!$refererOk) {
    // Not strictly required; you can comment out this block if referer check is too strict
    die('Accès interdit : veuillez passer par la page administration.');
}

require_once(__DIR__ . '/header.php');
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Administration - Zone réservée</title>
</head>
<body>
<main class="container mt-4">
    <h1>Zone d'administration</h1>
    <p>Bienvenue, administrateur <?= htmlspecialchars($_SESSION['user']['username']) ?></p>
    <p>Ici tu peux ajouter des outils réservés aux admins.</p>
</main>

<?php require_once(__DIR__ . '/footer.php'); ?>
</body>
</html>