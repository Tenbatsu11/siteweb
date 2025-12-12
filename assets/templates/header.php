 <?php
    session_start();
    /**
    // Global error handler
 set_error_handler(function($errno, $errstr, $errfile, $errline)  {
    echo "Une erreur est survenue." . PHP_EOL;
    //Fails Gracefully
    if ($errno === E_WARNING) {
        exit();
    }
 });
     */
    ?>

 <!DOCTYPE html>
 <html lang="fr">

 <head>
     <meta charset="UTF-8" />
     <meta name="viewport" content="width=device-width, initial-scale=1.0" />
     <title>Kumiai GO Learn</title>
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
     <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
     <link rel="stylesheet" href="/siteweb/assets/css/override-boostrap.css">
 </head>
 <header class="d-flex flex-wrap align-items-center justify-content-center justify-content-md-between py-3 mb-4 border-bottom">
     <div class="col-md-3 mb-2 mb-md-0">
         <a href="https://localhost/siteweb/index.php" class="d-inline-flex link-body-emphasis text-decoration-none">
             <img width="80" src="/siteweb/assets/images/logo-kumiai-unique.png">
         </a>
     </div>
     <ul class="nav col-12 col-md-auto mb-2 justify-content-center mb-md-0">
         <li><a href="https://localhost/siteweb/index.php" class="nav-link px-2 link-secondary">Home</a></li>
         <li><a href="https://localhost/siteweb/kanjihome.php" class="nav-link px-2">Kanjis</a></li>
         <li><a href="https://localhost/siteweb/vocabulairehome.php" class="nav-link px-2">Vocabulaire</a></li>
         <li><a href="https://localhost/siteweb/getstarted.php" class="nav-link px-2">Bien Commencer</a></li>
         <li><a href="#" class="nav-link px-2">About us</a></li>
     </ul>

     <div class="col-md-3 text-end">
         <?php if (isset($_SESSION['user'])): ?>
             <span class="me-2">Bonjour, <?= htmlspecialchars($_SESSION['user']['username']) ?></span>
             <a href="https://localhost/siteweb/logout.php" class="btn btn-outline-primary me-2">Logout</a>
         <?php else: ?>
             <a class="btn btn-outline-primary me-2" href="https://localhost/siteweb/Login/login.php">Connexion</a>
             <a class="btn btn-primary btn-outline-primary me-2" href="https://localhost/siteweb/register/registerpage.php">Inscription</a>
         <?php endif; ?>
     </div>
 </header>