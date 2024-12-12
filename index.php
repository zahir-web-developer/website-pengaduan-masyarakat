<?php
session_start();
include './service/database.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
@import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:ital,wght@0,200..800;1,200..800&display=swap');
</style>
    <link rel="stylesheet" href="index.css">
    <title>Website E-REPORT</title>
</head>
<body class="bg-secondary">
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="./index.php">E-REPORT</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <?php if (!isset($_SESSION['id'])) { ?>
                        <li class="nav-item">
                            <a class="nav-link" href="./auth/login.php">Login</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="./auth/register.php">Register</a>
                        </li>
                        <li>
                            <h3 style="color: #fff; margin-left: 28rem;">Let's Report Anything!</h3>
                        </li>
                    <?php } else { ?>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Report
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item" href="./akun/self.php">My Report</a></li>
                                <li><a class="dropdown-item" href="./report/create.php">Make Report</a></li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="./auth/logout.php">Logout</a>
                        </li>
                        <?php if ($_SESSION['is_admin'] == 1) { ?>
                            <li class="nav-item">
                                <a class="nav-link" href="./admin/index.php">Admin</a>
                            </li>
                            <li>
                                <h3 style="color: #fff; margin-left: 28rem;">Let's Report Anything!</h3>
                            </li>
                        <?php } ?>
                    <?php } ?>
                </ul>
            </div>
        </div>
    </nav>
    <div class="container mt-5">
        <div class="alert alert-info">
            <?= $pemberitahuan ?>
        </div>
        <div class="row">
            <div class="col-md-6 bg-dark text-light py-auto">
                <h1 class="text-center my" style="font-family:'Plus Jakarta Sans'; margin-top: 4rem;">Welcome <br><?= $_SESSION['email'] ?? '' ?> <br>in E-REPORT Website</h1>
            </div>
            <div class="col-md-6 bg-image text-white"
            style="background-image: url('image/annie-spratt-QckxruozjRg-unsplash.jpg'); height: 300px; background-size: cover; background-position: center;">
            </div>
        </div>

        <div class="d-grid gap-2 col-6 mx-auto mt-4">
            <a class="btn btn-danger" href="./report/create.php">Make Report</a>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>