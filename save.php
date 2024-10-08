<?php 
require('connection.php');

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Ambil data dari form
        $tanggal = htmlspecialchars($_POST['tanggal']);
        $sales = htmlspecialchars($_POST['sales']);
        $leadname = htmlspecialchars($_POST['leadname']);
        $produk = htmlspecialchars($_POST['produk']);
        $whatsapp = htmlspecialchars($_POST['whatsapp']);
        $kota = htmlspecialchars($_POST['kota']);

        $sql = "INSERT INTO leads (tanggal, id_sales, nama_lead, id_produk, no_wa, kota) VALUES ('$tanggal', '$sales', '$leadname', '$produk', '$whatsapp', '$kota')";
        if ($conn->query($sql) === TRUE) {
            header("Location: index.php");
        } else {
            echo "<script>alert('Error: " . $sql . " " . $conn->error . "'); window.location.href='index.php';</script>";
        }
    }