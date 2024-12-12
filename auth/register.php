<?php
session_start();
if (isset($_SESSION['id'])) {
    header("Location: ../index.php");
    exit;
}
require_once '../service/database.php';

if (isset($_POST['submit'])) {
    global $connection;
    $email = $_POST['email'];
    $password = $_POST['password'];
    $password2 = $_POST['password2'];

    // Validation
    $errors = [];
    if (empty($email)) {
        $errors[] = "email is required.";
    }
    if (empty($password)) {
        $errors[] = "Password is required.";
    }
    if ($password !== $password2 ) {
        echo "<script>
        alert('Password Is Not Same!');
        </script>";
        return;
    }

    $password = password_hash($password, PASSWORD_DEFAULT);
    $password2 = password_hash($password2, PASSWORD_DEFAULT);

    if (empty($errors)) {
        // Check if email already exists
        $check_query = "SELECT * FROM akun WHERE email = '$email'";
        $check_result = mysqli_query($connection, $check_query);

        if (mysqli_num_rows($check_result) > 0) {
            $errors[] = "email already exists.";
        } else {
            $query = "INSERT INTO akun (email, password, is_admin) VALUES ('$email', '$password', false)";
            if (mysqli_query($connection, $query)) {
                header('Location: login.php');
                exit();
            } else {
                echo "Error: " . $query . "<br>" . mysqli_error($connection);
            }
        }
    }
}

?>
<!DOCTYPE html>
<html lang="en" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../index.css">
    <style>
@import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:ital,wght@0,200..800;1,200..800&display=swap');
</style>
    <title>Register</title>
    <style>
        body {
            background-color: #f8fafc;
        }

        .card {
            margin-top: 100px;
        }
        a{
            display: block;
            margin: 10px;
            margin-left: 12.5rem;
            text-decoration: none;
        }
    </style>
</head>

<body class="bg-dark">
    <?php
    if (!empty($errors)) {
        foreach ($errors as $error) {
            echo "<div class='alert alert-danger'>$error</div>";
        }
    }
    ?>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header bg-success text-white">
                        <h3 class="text-center">Register</h3>
                    </div>
                    <div class="card-body">
                        <form action="register.php" method="post">
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="text" class="form-control" id="email" name="email" required>
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" class="form-control" id="password" name="password" required>
                            </div>
                            <div class="mb-3">
                                <label for="password2" class="form-label">Confirm Password</label>
                                <input type="password" class="form-control" id="password2" name="password2">
                            </div>
                            <div class="d-grid">
                                <button type="submit" name="submit" class="btn btn-success">Register</button>
                            </div>
                        </form>
                    </div>
                    <div class="btn-login ">
                        <a href="login.php">Go To Login if you have Account</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>