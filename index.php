<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="index-style.css">
    <title>CRUD PHP OOP</title>
</head>

<body>
    <?php
    include 'db.php';
    include 'produk.php';

    $database = new Database();
    $db = $database->conn;
    $product = new Product($db);

    if ($_POST) {
        $product->nama = $_POST['nama'];
        $product->harga = $_POST['harga'];

        // Proses unggah file/foto
        $target_directory = "uploads/";
        $target_file = $target_directory . basename($_FILES["foto"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        if (move_uploaded_file($_FILES["foto"]["tmp_name"], $target_file)) {
            $product->foto = $target_file;
        } else {
            echo "Maaf, file tidak berhasil diunggah.";
        }

        if ($product->create()) {
            echo "Produk berhasil ditambahkan.";
        } else {
            echo "Gagal menambahkan produk.";
        }
    }
    ?>
    <h1>CRUD PHP</h1>
    <div class="grid-container">
        <div class="grid-item form">
<form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post" enctype="multipart/form-data">
        Nama: <input type="text" name="nama" placeholder="Masukkan Nama Produk" required><br>
        Harga: <input type="number" name="harga" placeholder="Masukkan Harga Produk" required><br>
        Foto: <input type="file" name="foto" id="img" accept="image/*" required><br>
        <input type="submit" value="Tambah Produk" id="tombol">
    </form>
        </div>

        <div class="grid-item hasil">
<h2>Daftar Produk</h2>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Nama</th>
            <th>Harga</th>
            <th>Foto</th>
            <th>Aksi</th>
        </tr>
        <?php
        $result = $product->read();

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>
                        <td>{$row['id']}</td>
                        <td>{$row['nama']}</td>
                        <td>{$row['harga']}</td>
                        <td><img src='{$row['foto']}' alt='Foto Produk' style='width: 100px; height: 100px;'></td>
                        <td>
                            <a href='edit.php?id={$row['id']}'>Edit</a>
                            <a href='delete.php?id={$row['id']}'>Hapus</a>
                        </td>
                      </tr>";
            }
        } else {
            echo "<tr><td colspan='5'>Tidak ada produk.</td></tr>";
        }
        ?>
    </table>
        </div>


    </div>
    

   

    
</body>

</html>
