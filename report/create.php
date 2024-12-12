<?php
session_start();
require_once '../service/database.php';

if (!isset($_SESSION['id'])) {
    header("Location: ../auth/login.php");
    exit;
}

if (isset($_POST['submit'])) {
    session_start();
    $isi_laporan = $_POST['isi_laporan'];
    $akun_id = $_SESSION['id'];

    $query = "INSERT INTO report (isi_laporan, akun_id) VALUES ('$isi_laporan', '$akun_id')";
    if (mysqli_query($connection, $query)) {
        header('Location: ../index.php');
        exit();
    } else {
        $error = "Error: " . $query . "<br>" . mysqli_error($connection);
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../index.css">
    <style>
@import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:ital,wght@0,200..800;1,200..800&display=swap');
</style>
    <title>Membuat report</title>
</head>

<body class="bg-light">
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow-sm">
                    <div class="card-header bg-success text-white text-center">
                        <h3>Make Report</h3>
                    </div>
                    <div class="card-body">
                        <?php if (isset($error)) : ?>
                            <div class="alert alert-danger" role="alert">
                                <?= $error ?>
                            </div>
                        <?php endif; ?>
                        <form action="create.php" method="post">
                            <div class="mb-3">
                                <label for="isi_laporan" class="form-label">Fill Report</label>
                                <textarea class="form-control" id="isi_laporan" name="isi_laporan" rows="3" required></textarea>
                            </div>
                            <div class="d-grid">
                                <button type="submit" name="submit" class="btn btn-success">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>