<?php 
  // Ambil data produk untuk dropdown
  $sql_produk = "SELECT * FROM produk";
  $result_produk = $conn->query($sql_produk);

  // Ambil data sales untuk dropdown
  $sql_sales = "SELECT * FROM sales";
  $result_sales = $conn->query($sql_sales);

  // Penanganan pencarian berdasarkan produk, sales, dan bulan
  $search_produk = "";
  $search_sales = "";
  $search_bulan = "";

  $sql = "SELECT leads.*, sales.nama_sales, produk.nama_produk 
          FROM leads 
          JOIN sales ON leads.id_sales = sales.id_sales 
          JOIN produk ON leads.id_produk = produk.id_produk";

  // Check if searching
  if (isset($_POST['search'])) {
      $search_produk = htmlspecialchars($_POST['search_produk']);
      $search_sales = htmlspecialchars($_POST['search_sales']);
      $search_bulan = htmlspecialchars($_POST['search_bulan']); 

      $conditions = [];
      if (!empty($search_produk)) {
          $conditions[] = "leads.id_produk LIKE '%$search_produk%'";
      }
      if (!empty($search_sales)) {
          $conditions[] = "sales.nama_sales LIKE '%$search_sales%'";
      }
      if (!empty($search_bulan)) {
          $conditions[] = "MONTH(leads.tanggal) = '$search_bulan'";
      }

      if (count($conditions) > 0) {
          $sql .= " WHERE " . implode(' AND ', $conditions);
      }

    }
    $sql .= " ORDER BY leads.id_leads";

  $result = $conn->query($sql);