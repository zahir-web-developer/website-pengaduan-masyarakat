<?php
session_start();
if (isset($_SESSION['id'])) {
    header("Location: ../index.php");
    exit;
}
if (isset($_POST['login'])) {
    session_start();
    require_once '../service/database.php';
    $email = $_POST['email'];
    $password = $_POST['password'];

    $query = "SELECT * FROM akun WHERE email = '$email'";
    $result = mysqli_query($connection, $query);

    if (mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);
        if (password_verify($password, $row['password']))
        $_SESSION['email'] = $email;
        $_SESSION['id'] = $row['id'];
        if ($row['is_admin'] == true or $row['is_admin'] == 1) {
            $_SESSION['is_admin'] = true;
            header('Location: ../admin/index.php');
            exit();
        } else {
            $_SESSION['is_admin'] = false;
            header('Location: ../index.php');
            exit();
        }
    } else {
        $error = "Username atau password salah";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../index.css">
    <style>
@import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:ital,wght@0,200..800;1,200..800&display=swap');
</style>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        a{
            display: block;
            margin: 10px;
            margin-left: 11rem;
            text-decoration: none;
        }
    </style>

    <title>Login</title>
</head>

<body class="d-flex align-items-center min-vh-100 bg-light bg-dark">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-5">
                <?php if (isset($error)): ?>
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <?php echo $error ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php endif; ?>
                <div class="card shadow-sm">
                    <div class="card-header bg-success text-white text-center">
                        <h3>Login</h3>
                    </div>
                    <div class="card-body">
                        <form action="login.php" method="POST">
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="text" class="form-control" id="email" name="email" required>
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" class="form-control" id="password" name="password" required>
                            </div>
                            <div class="d-grid">
                                <button type="submit" name="login" class="btn btn-success">Login</button>
                            </div>
                        </form>
                    </div>
                    <div class="btn-login ">
                        <a href="register.php">Make Your Account First</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>