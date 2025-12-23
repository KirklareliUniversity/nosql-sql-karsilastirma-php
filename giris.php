<?php
include 'includes/veri.php';
session_start();

$error = null;
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $pass = $_POST['password'] ?? '';
    if ($pass === $authPassword) {
        $_SESSION['authed'] = true;
        header('Location: ozet.php');
        exit;
    } else {
        $error = "Parola hatalı.";
    }
}
?>
<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Giriş - <?php echo $projectDetails['title']; ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-4">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h5 class="mb-3 text-center">Giriş Yap</h5>
                    <?php if ($error): ?>
                        <div class="alert alert-danger py-2"><?php echo $error; ?></div>
                    <?php endif; ?>
                    <form method="post">
                        <div class="mb-3">
                            <label class="form-label">Parola</label>
                            <input type="password" name="password" class="form-control" required>
                        </div>
                        <button type="submit" class="btn btn-primary w-100">Giriş</button>
                    </form>
                    <p class="text-center text-muted small mt-3 mb-0">
                        Demo parola: <?php echo htmlspecialchars($authPassword, ENT_QUOTES, 'UTF-8'); ?>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
