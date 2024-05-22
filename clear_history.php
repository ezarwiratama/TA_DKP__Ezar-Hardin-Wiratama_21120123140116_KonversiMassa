<?php
session_start();

// Hapus riwayat dari session
unset($_SESSION['history']);

// Redirect kembali ke halaman riwayat
header("Location: history.php");
exit();
?>
