<?php
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
        // Connexion
        if ($_POST['action'] === 'login') {
            $username = $_POST['username'] ?? '';
            $password = $_POST['password'] ?? '';
            if ($username === 'admin' && $password === 'password') {
                $_SESSION['user'] = ['username' => $username];
                $message = "Connexion réussie !";
                header('Location: index'); // Redirection vers la page d'accueil
                exit();
            } else {
                $message = "Identifiants incorrects.";
            }
        }
        // Déconnexion
        elseif ($_POST['action'] === 'logout') {
            unset($_SESSION['user']);
            $message = "Déconnexion réussie !";
        }
        // Gestion des préférences
        elseif ($_POST['action'] === 'set_preferences') {
            $valid_themes = ['light', 'dark', 'grey'];
            $valid_font_sizes = ['small', 'medium', 'large'];

            $theme = $_POST['theme'] ?? 'light';
            $font_size = $_POST['font_size'] ?? 'medium';

            // Vérifier les valeurs sélectionnées
            if (in_array($theme, $valid_themes)) {
                $_SESSION['theme'] = $theme;
            }
            if (in_array($font_size, $valid_font_sizes)) {
                $_SESSION['font_size'] = $font_size;
            }
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
<nav class="navbar fixed-top bg-light">
    <div class="container-fluid">
        <div class="row w-100 align-items-center">
            <!-- Menu Offcanvas -->
            <div class="col-4">
                <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar">
                    <span class="navbar-toggler-icon"></span> Menu
                </button>
                <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
                    <div class="offcanvas-header">
                        <h5 class="offcanvas-title" id="offcanvasNavbarLabel">National Post</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                    </div>
                    <div class="offcanvas-body">
                        <ul class="navbar-nav">
                        <li class="nav-item"><a class="nav-link" href="{{ route('index') }}">Home</a></li>
                            <li class="nav-item"><a class="nav-link" href="article">Articles</a></li>
                            <li class="nav-item"><a class="nav-link" href="recherche">Search</a></li>
                            <hr>
                            <!-- Affichage dynamique des catégories -->
                            <?php foreach ($categories as $category): ?>
                                <li class="nav-item">
                                    <a class="nav-link" href="category?id=<?= $category['id_cat'] ?>">
                                        <?= htmlspecialchars($category['name_cat'], ENT_QUOTES, 'UTF-8') ?>
                                    </a>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Options de présentation : Thème et Taille de police -->
            <div class="col-4 text-end">
                <form method="POST" action="" class="d-inline-block">
                    <input type="hidden" name="action" value="set_preferences">
                    <select name="theme" onchange="this.form.submit()" class="form-select">
                        <option value="light" <?= ($_SESSION['theme'] ?? 'light') === 'light' ? 'selected' : '' ?>>Light</option>
                        <option value="dark" <?= ($_SESSION['theme'] ?? 'light') === 'dark' ? 'selected' : '' ?>>Dark</option>
                        <option value="grey" <?= ($_SESSION['theme'] ?? 'light') === 'grey' ? 'selected' : '' ?>>Grey</option>
                    </select>
                    <select name="font_size" onchange="this.form.submit()" class="form-select">
                        <option value="small" <?= ($_SESSION['font_size'] ?? 'medium') === 'small' ? 'selected' : '' ?>>Small</option>
                        <option value="medium" <?= ($_SESSION['font_size'] ?? 'medium') === 'medium' ? 'selected' : '' ?>>Medium</option>
                        <option value="large" <?= ($_SESSION['font_size'] ?? 'medium') === 'large' ? 'selected' : '' ?>>Large</option>
                    </select>
                </form>
            </div>

            <!-- Connexion / Déconnexion -->
            <div class="col-4 text-end">
                <?php if (isset($_SESSION['user'])): ?>
                    <span class="me-3">Bonjour, <?= htmlspecialchars($_SESSION['user']['username'], ENT_QUOTES, 'UTF-8') ?> !</span>
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
                <form method="POST" action="">
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

<!-- Ajout du style dynamique -->
<style>
    body {
        <?php
            // Application du thème de couleur
            if ($_SESSION['theme'] === 'dark') {
                echo 'background-color: #333; color: #fff;';
            } elseif ($_SESSION['theme'] === 'grey') {
                echo 'background-color: #ccc; color: #333;';
            } else {
                echo 'background-color: #fff; color: #000;';
            }

            // Application de la taille de la police
            if ($_SESSION['font_size'] === 'small') {
                echo 'font-size: 12px;';
            } elseif ($_SESSION['font_size'] === 'large') {
                echo 'font-size: 18px;';
            } else {
                echo 'font-size: 14px;';
            }
        ?>
    }
</style>
