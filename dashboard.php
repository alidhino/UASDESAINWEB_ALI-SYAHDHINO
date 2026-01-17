<?php
session_start();
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Dashboard POLGANMART</title>
    <style>
        body {
            margin: 0;
            font-family: Arial;
            background: #f4f4f4;
        }

        /* Sidebar */
        .sidebar {
            width: 220px;
            height: 100vh;
            background: #2c3e50;
            color: white;
            position: fixed;
            top: 0;
            left: 0;
        }

        .sidebar h2 {
            text-align: center;
            padding: 20px 0;
            border-bottom: 1px solid rgba(255, 255, 255, 0.2);
        }

        .sidebar a {
            display: block;
            color: white;
            padding: 12px 20px;
            text-decoration: none;
        }

        .sidebar a:hover {
            background: #34495e;
        }

        /* Header */
        .header {
            height: 60px;
            background: white;
            padding: 10px 20px;
            margin-left: 220px;
            display: flex;
            justify-content: flex-end;
            align-items: center;
            border-bottom: 1px solid #ddd;
        }

        .profile-btn {
            cursor: pointer;
            padding: 8px 15px;
            border-radius: 20px;
            background: #3498db;
            color: white;
        }

        /* Dropdown */
        .dropdown {
            position: relative;
            display: inline-block;
        }

        .dropdown-content {
            display: none;
            position: absolute;
            right: 0;
            background: white;
            min-width: 150px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.2);
            border-radius: 5px;
        }

        .dropdown-content a {
            display: block;
            padding: 10px;
            text-decoration: none;
            color: #333;
        }

        .dropdown-content a:hover {
            background: #f0f0f0;
        }

        /* Content */
        .content {
            margin-left: 220px;
            padding: 20px;
        }
    </style>
</head>

<body>

    <div class="sidebar">
        <h2>Dashboard</h2>
        <a href="dashboard.php?page=home">Home</a>
        <a href="listproduct.php">List Produk</a>
        <a href="#">Customer</a>
        <a href="#">Transaksi</a>
        <a href="#">Laporan</a>
    </div>

    <div class="header">
        <div class="dropdown">
            <div class="profile-btn" onclick="toggleMenu()">Profile ▾</div>
            <div class="dropdown-content" id="profileMenu">
                <a href="profil.php">My Profile</a>
                <a href="logout.php">Logout</a>
            </div>
        </div>
    </div>

    <div class="content">
        <?php
        $page = $_GET['page'] ?? 'home';
        $file = "pages/$page.php";

        if (file_exists($file)) {
            include $file;
        } else {
            echo "<h2>Welcome Dashboard</h2>";
        }
        ?>
    </div>
    <?php include 'koneksi.php';
    $data = mysqli_query($conn, "SELECT * FROM barang");
    ?>

    <style>
        .card {
            background: white;
            padding: 20px;
            border-radius: 6px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .card-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 15px;
        }

        .btn {
            padding: 8px 12px;
            text-decoration: none;
            border-radius: 4px;
            color: white;
            font-size: 14px;
        }

        .btn-tambah {
            background: #27ae60;
        }

        .btn-edit {
            background: #2980b9;
        }

        .btn-hapus {
            background: #c0392b;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            padding: 10px;
            border-bottom: 1px solid #ddd;
            text-align: center;
        }

        .php th {}
    </style>

    <div class="card">
        <div class="card-header">
            <h3>List Produk</h3>
            <a href="dashboard.php?page=tambah" class="btn btn-tambah">+ Tambah Produk</a>
        </div>
        <table>
            <tr>
                <th>No</th>
                <th>Kode</th>
                <th>Nama Produk</th>
                <th>Kategori</th>
                <th>Harga</th>
                <th>Stok</th>
                <th>Satuan</th>
                <th>Aksi</th>
            </tr> <?php $no = 1;
                    while ($row = mysqli_fetch_assoc($data)) {
                    ?>
                <tr>
                    <td><?= $no++; ?></td>
                    <td><?= $row['kode_barang']; ?></td>
                    <td><?= $row['nama_barang']; ?></td>
                    <td><?= $row['kategori']; ?></td>
                    <td>Rp <?= number_format($row['harga'], 0, ',', '.'); ?></td>
                    <td><?= $row['stok']; ?></td>
                    <td><?= $row['satuan']; ?></td>
                    <td>
                        <a href="dashboard.php?page=edit&id=<?= $row['id_barang']; ?>" class="btn btn-edit">Edit</a>
                        <a href="dashboard.php?page=hapus&id=<?= $row['id_barang']; ?>" class="btn btn-hapus"
                            onclick="return confirm('Yakin hapus data?')">
                            Hapus
                        </a>
                    </td>
                </tr>
            <?php } ?>
        </table>
    </div>


    <script>
        function toggleMenu() {
            var menu = document.getElementById("profileMenu");
            menu.style.display = (menu.style.display === "block") ? "none" : "block";
        }

        // Menutup dropdown jika klik di luar
        window.onclick = function(event) {
            if (!event.target.matches('.profile-btn')) {
                document.getElementById("profileMenu").style.display = "none";
            }
        }
    </script>

</body>

</html>
