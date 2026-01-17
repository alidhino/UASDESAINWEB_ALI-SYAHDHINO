<?php
session_start();
session_unset();  // hapus semua session
session_destroy(); // hapus session login
header("Location: index.php"); // kembali ke login
exit();
