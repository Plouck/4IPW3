<?php
// Activer l'affichage des erreurs PHP pour le débogage
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Connexion à la base de données
$pdo = new PDO('mysql:host=127.0.0.1;dbname=press_2024_v03', 'root', '');

// Requête pour récupérer les catégories
$stmt = $pdo->query("SELECT id_cat, name_cat FROM t_category");
$categories = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Démarrage de la session
session_start();

// Message à afficher après la requête POST
$message = "";

// Gestion des actions de connexion/déconnexion et préférences
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['action'])) {
        if ($_POST['action'] === 'login') {
            $username = $_POST['username'] ?? '';
            $password = $_POST['password'] ?? '';
            if ($username === 'admin' && $password === 'password') {
                $_SESSION['user'] = ['username' => $username];
                $message = "Connexion réussie !";
                // Redirection vers la page d'accueil après la connexion réussie
                header('Location: index.php');
                exit(); // N'oublie pas de mettre exit() après la redirection
            } else {
                $message = "Identifiants incorrects.";
            }
        } elseif ($_POST['action'] === 'logout') {
            unset($_SESSION['user']);
            $message = "Déconnexion réussie !";
        } elseif ($_POST['action'] === 'set_preferences') {
            $_SESSION['theme'] = $_POST['theme'] ?? 'light';
            $_SESSION['font_size'] = $_POST['font_size'] ?? 'medium';
        }
    }
}
?>

<!-- Affichage du message de confirmation -->
<?php if ($message): ?>
    <div class="alert alert-info" role="alert">
        <?= htmlspecialchars($message); ?>
    </div>
<?php endif; ?>

<!-- Barre de Navigation -->
<header>
    <nav class="navbar fixed-top bg-light">
        <div class="container-fluid">
            <div class="row w-100 align-items-center">
                <!-- Menu Offcanvas -->
                <div class="col-4">
                    <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar">
                        <span class="navbar-toggler-icon"></span> Section
                    </button>
                    <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
                        <div class="offcanvas-header">
                            <h5 class="offcanvas-title" id="offcanvasNavbarLabel">National Post</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                        </div>
                        <div class="offcanvas-body">
                            <ul class="navbar-nav">
                                <li class="nav-item"><a class="nav-link" href="./index.php">Home</a></li>
                                <li class="nav-item"><a class="nav-link" href="./article.php">Article</a></li>
                                <li class="nav-item"><a class="nav-link" href="./recherche.php">Search</a></li>
                                
                                <!-- Affichage dynamique des catégories -->
                                <?php foreach ($categories as $category): ?>
                                    <li class="nav-item">
                                        <a class="nav-link" href="category.php?id=<?= $category['id_cat']; ?>">
                                            <?= htmlspecialchars($category['name_cat']); ?>
                                        </a>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- Options de présentation : Thème et Taille de police -->
                <div class="col-4 text-end">
                    <form method="POST" class="d-inline-block">
                        <input type="hidden" name="action" value="set_preferences">
                        <!-- Sélection du thème -->
                        <select name="theme" onchange="this.form.submit()" class="form-select" aria-label="Sélection du thème">
                            <option value="light" <?= (isset($_SESSION['theme']) && $_SESSION['theme'] === 'light') ? 'selected' : ''; ?>>Light</option>
                            <option value="dark" <?= (isset($_SESSION['theme']) && $_SESSION['theme'] === 'dark') ? 'selected' : ''; ?>>Dark</option>
                            <option value="grey" <?= (isset($_SESSION['theme']) && $_SESSION['theme'] === 'grey') ? 'selected' : ''; ?>>Grey</option>
                        </select>

                        <!-- Sélection de la taille de la police -->
                        <select name="font_size" onchange="this.form.submit()" class="form-select" aria-label="Sélection de la taille de la police">
                            <option value="small" <?= (isset($_SESSION['font_size']) && $_SESSION['font_size'] === 'small') ? 'selected' : ''; ?>>Small</option>
                            <option value="medium" <?= (isset($_SESSION['font_size']) && $_SESSION['font_size'] === 'medium') ? 'selected' : ''; ?>>Medium</option>
                            <option value="large" <?= (isset($_SESSION['font_size']) && $_SESSION['font_size'] === 'large') ? 'selected' : ''; ?>>Large</option>
                        </select>
                    </form>
                </div>

                <!-- Connexion / Déconnexion -->
                <div class="col-4 text-end">
                    <?php if (isset($_SESSION['user'])): ?>
                        <span class="me-3">Bonjour, <?= htmlspecialchars($_SESSION['user']['username']); ?> !</span>
                        <form method="POST" style="display:inline;">
                            <input type="hidden" name="action" value="logout">
                            <button type="submit" class="btn btn-outline-danger">Se déconnecter</button>
                        </form>
                    <?php else: ?>
                        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#loginModal">Se connecter</button>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </nav>

    <!-- Modal de connexion -->
    <div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="loginModalLabel">Connexion</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST">
                        <input type="hidden" name="action" value="login">
                        <div class="mb-3">
                            <label for="username" class="form-label">Nom d'utilisateur</label>
                            <input type="text" name="username" id="username" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Mot de passe</label>
                            <input type="password" name="password" id="password" class="form-control" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Se connecter</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

</header>
