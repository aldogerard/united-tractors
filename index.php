<?php
    require('connection.php');
    require('select.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    <title>Document</title>
</head>

<body>

    <div class="container">

        <div class="wrapper">


            <h1 class="title">Welcome to add leads</h1>

            <form action="save.php" method="post">
                <div class="form-wrapper">
                    <div class="input-section">
                        <label for="tanggal">Date</label>
                        <input type="date" id="tanggal" name="tanggal" required>
                    </div>

                    <div class="input-section">
                        <label for="sales">Sales</label>
                        <select name="sales" id="sales">
                            <option value="">Select sales</option>
                            <option value="1">Sales 1</option>
                            <option value="2">Sales 2</option>
                            <option value="3">Sales 3</option>
                        </select>
                    </div>

                    <div class="input-section">
                        <label for="leadname">Lead name</label>
                        <input type="text" id="leadname" name="leadname" placeholder="Enter lead name" required />
                    </div>

                    <div class="input-section">
                        <label for="produk">Product</label>
                        <select name="produk" id="produk">
                            <option value="">Select product</option>
                            <option value="1">Cipta Residence 2</option>
                            <option value="2">The Rich</option>
                            <option value="3">Namorambe City</option>
                            <option value="4">Grand Banten</option>
                            <option value="5">Turi Mansion</option>
                            <option value="6">Cipta Residence 1</option>
                        </select>
                    </div>

                    <div class="input-section">
                        <label for="whatsapp">Whatsapp number</label>
                        <input type="text" id="whatsapp" name="whatsapp" required placeholder="Enter whatsapp number" />
                    </div>

                    <div class="input-section">
                        <label for="kota">City</label>
                        <input type="text" id="kota" name="kota" required placeholder="Enter city" />
                    </div>

                    <div class="button-section">

                        <input type="reset" value="Reset" class="reset">
                        <input type="submit" value="Submit" class="submit">
                    </div>
                </div>
            </form>

            <div class="wrapper">
                <h2 class="title">Data Leads</h2>

                <form method="post">
                    <div class="search-wrapper">

                        <div class="input-section">
                            <select class="form-select" name="search_produk">
                                <option value="">Select product</option>
                                <?php
              $result_produk->data_seek(0); // Reset pointer ke awal
              while ($produk = $result_produk->fetch_assoc()) { ?>
                                <option value="<?= $produk['id_produk'] ?>"
                                    <?= $search_produk == $produk['id_produk'] ? 'selected' : '' ?>>
                                    <?= $produk['nama_produk'] ?>
                                </option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="input-section">
                            <select class="form-select" name="search_sales">
                                <option value="">Select sales</option>
                                <?php
              $result_sales->data_seek(0); // Reset pointer ke awal
              while ($sales = $result_sales->fetch_assoc()) { ?>
                                <option value="<?= $sales['id_sales'] ?>"
                                    <?= $search_sales == $sales['id_sales'] ? 'selected' : '' ?>>
                                    <?= $sales['nama_sales'] ?>
                                </option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="input-section">
                            <select class="form-select" name="search_bulan">
                                <option value="">Select month</option>
                                <?php for ($i = 1; $i <= 12; $i++) { ?>
                                <option value="<?= $i ?>" <?= $search_bulan == $i ? 'selected' : '' ?>>
                                    <?= date('F', mktime(0, 0, 0, $i, 1)) ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="input-section btn-section">
                            <button class="submit search" type="submit" name="search">Search</button>
                        </div>
                    </div>
                </form>


                <?php if ($result->num_rows > 0) { ?>
                <div class="table-container">
                    <table>
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Id</th>
                                <th>Date</th>
                                <th>Sales</th>
                                <th>Lead name</th>
                                <th>Product</th>
                                <th>Whatsapp number</th>
                                <th>City</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
            // Fetch data per baris
            $no = 1;
            while ($row = $result->fetch_assoc()) {
                $id_leads = str_pad($row['id_leads'], 3, '0', STR_PAD_LEFT);
                echo "<tr>";
                echo "<td>" . $no++ . "</td>";
                echo "<td>" . $id_leads . "</td>";
                // echo "<td>" . htmlspecialchars($row['id_leads']) . "</td>";
                echo "<td>" . htmlspecialchars($row['tanggal']) . "</td>";
                echo "<td>" . htmlspecialchars($row['nama_sales']) . "</td>";
                echo "<td>" . htmlspecialchars($row['nama_lead']) . "</td>";
                echo "<td>" . htmlspecialchars($row['nama_produk']) . "</td>";
                echo "<td>" . htmlspecialchars($row['no_wa']) . "</td>";
                echo "<td>" . htmlspecialchars($row['kota']) . "</td>";
                echo "</tr>";
            }
            ?>
                        </tbody>
                    </table>
                </div>

                <?php } else { ?>
                <div class="result-wrapper">
                    <h1>No result</h1>
                </div>
                <?php } ?>
            </div>

        </div>
</body>

</html>