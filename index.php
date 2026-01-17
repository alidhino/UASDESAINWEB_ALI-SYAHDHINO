<?php
session_start();
include "koneksi.php"; // pastikan file koneksi ada

$error = "";

// Proses login
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';

    if ($email != "" && $password != "") {

        $result = mysqli_query($conn, "SELECT * FROM users WHERE email='$email'");

        if ($row = mysqli_fetch_assoc($result)) {

            // jika password belum di hash
            if ($password == $row['password']) {

                $_SESSION['email'] = $row['email'];
                $_SESSION['name']  = $row['name'];
                $_SESSION['role']  = $row['role'];

                header("Location: dashboard.php");
                exit;
            } else {
                $error = "Password salah.";
            }
        } else {
            $error = "Email tidak ditemukan.";
        }
    } else {
        $error = "Form tidak boleh kosong.";
    }
}
?>
<!DOCTYPE html>
<html>

<head>
    <title>POLGAN MART - Login</title>
    <style>
        body {
            font-family: Arial;
            background: #f2f2f2;
        }

        .login-card {
            width: 350px;
            margin: 100px auto;
            background: #fff;
            padding: 25px;
            border-radius: 10px;
            box-shadow: 0 0 10px #ccc;
        }

        .form-group {
            margin-bottom: 15px;
        }

        input {
            width: 100%;
            padding: 10px;
        }

        .btn {
            width: 100%;
            padding: 10px;
            background: #3498db;
            color: white;
            border: none;
            border-radius: 5px;
        }

        .btn-reset {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            background: #aaa;
            color: white;
            border: none;
            border-radius: 5px;
        }

        .error {
            background: #ffdddd;
            padding: 10px;
            margin-bottom: 10px;
            color: red;
            border-radius: 5px;
        }

        .footer {
            text-align: center;
            margin-top: 15px;
            font-size: 12px;
            color: #777;
        }
    </style>
</head>

<body>

    <div class="login-card">
        <h2>POLGAN MART</h2>

        <?php if (!empty($error)) echo "<div class='error'>$error</div>"; ?>

        <form method="post" action="">
            <div class="form-group">
                <label>Email</label>
                <input type="email" name="email" placeholder="Masukkan email anda" required>
            </div>

            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" placeholder="Masukkan password" required>
            </div>

            <button type="submit" class="btn">Login</button>
            <button type="reset" class="btn-reset">Batal</button>
        </form>

        <div class="footer">
            <p>© 2026 POLGAN MART</p>
        </div>
    </div>

</body>

</html>
