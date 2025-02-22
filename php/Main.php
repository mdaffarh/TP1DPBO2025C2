<?php
session_start();
require_once 'Petshop.php';

// inisialisasi session jika belum ada
if (!isset($_SESSION['products'])) {
    $_SESSION['products'] = [];
}

// ambil data produk dari session dan unserialize agar bisa digunakan sebagai objek
$products = [];
if (!empty($_SESSION['products'])) {
    foreach ($_SESSION['products'] as $data) {
        if (is_string($data)) {
            $products[] = unserialize($data);
        }
    }
}

// tambah produk baru
if (isset($_POST['add'])) {
    // ambil setiap data
    $id = $_POST['id'];
    $name = $_POST['name'];
    $category = $_POST['category'];
    $price = $_POST['price'];

    // upload gambar
    $imageName = basename($_FILES['image']['name']);
    $imageTmp = $_FILES['image']['tmp_name'];
    $imagePath = "images/" . $imageName;
    move_uploaded_file($imageTmp, $imagePath);

    // buat objek produk baru dan simpan dalam session
    $product = new Petshop($id, $name, $category, $price, $imageName);
    $_SESSION['products'][] = serialize($product);

    header("Location: " . $_SERVER['PHP_SELF']);
    exit();
}

// edit produk
if (isset($_POST['edit'])) {
    // ambil setiap data
    $id = $_POST['id'];
    $name = $_POST['name'];
    $category = $_POST['category'];
    $price = $_POST['price'];

    // upload gambar baru
    $imageName = basename($_FILES['image']['name']);
    $imageTmp = $_FILES['image']['tmp_name'];
    $imagePath = "images/" . $imageName;
    move_uploaded_file($imageTmp, $imagePath);

    // update data produk yang sesuai dengan ID
    foreach ($products as $key => $product) {
        if ($product->getId() == $id) {
            // hapus gambar lama jika ada
            $oldImage = "images/" . $product->getImage();
            if (file_exists($oldImage)) {
                unlink($oldImage);
            }

            // update produk menggunakan setter
            $product->setName($name);
            $product->setCategory($category);
            $product->setPrice($price);
            $product->setImage($imageName);

            // simpan kembali dalam session
            $_SESSION['products'][$key] = serialize($product);
        }
    }

    header("Location: " . $_SERVER['PHP_SELF']);
    exit();
}

// hapus produk berdasarkan ID
if (isset($_GET['delete_id'])) {
    $deleteId = $_GET['delete_id'];

    foreach ($products as $key => $product) {
        if ($product->getId() == $deleteId) {
            // hapus gambar
            $imagePath = "images/" . $product->getImage();
            if (file_exists($imagePath)) {
                unlink($imagePath);
            }

            // hapus produk dari session
            unset($_SESSION['products'][$key]);

            // Reset indeks array agar ID tetap berurutan
            $_SESSION['products'] = array_values($_SESSION['products']);
            break;
        }
    }

    // Refresh halaman setelah menghapus
    header("Location: " . $_SERVER['PHP_SELF']);
    exit();
}

// cari produk berdasarkan nama
$searchResults = $products;
if (isset($_POST['search'])) {
    $searchQuery = trim($_POST['search_query']);
    $searchResults = [];

    // gilter produk yang mengandung kata kunci pencarian
    foreach ($products as $product) {
        if (stripos($product->getName(), $searchQuery) !== false) {
            $searchResults[] = $product;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Petshop Dudul Miaw-Miaw</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }

        table,
        th,
        td {
            border: 1px solid black;
        }

        th,
        td {
            padding: 8px;
            text-align: left;
        }

        img {
            max-width: 100px;
            height: auto;
        }
    </style>
</head>

<body>
    <h2>Petshop Dudul Miaw-miaw</h2>
    <!-- form tambah data -->
    <div>
        <h3>Tambah Data</h3>
        <form method="POST" enctype="multipart/form-data">
            <input type="number" name="id" placeholder="ID Produk" required>
            <input type="text" name="name" placeholder="Nama Produk" required>
            <input type="text" name="category" placeholder="Kategori Produk" required>
            <input type="number" name="price" placeholder="Harga Produk" required>
            <input type="file" name="image" required>
            <button type="submit" name="add">Submit</button>
        </form>
    </div>
    <!-- form edit data -->
    <div>
        <h3>Edit Data</h3>
        <form method="POST" enctype="multipart/form-data">
            <select name="id" required>
                <option value="" selected disabled>Pilih Produk</option>
                <?php foreach ($products as $product): ?>
                    <option value="<?= $product->getId(); ?>"><?= $product->getName(); ?></option>
                <?php endforeach; ?>
            </select>
            <input type="text" name="name" placeholder="Nama Produk" required>
            <input type="text" name="category" placeholder="Kategori Produk" required>
            <input type="number" name="price" placeholder="Harga Produk" required>
            <input type="file" name="image" required>
            <button type="submit" name="edit">Submit</button>
        </form>
    </div>

    <!-- daftar produk -->
    <div>
        <h3>Daftar Produk</h3>
        <table>
            <tr>
                <th>ID</th>
                <th>Nama</th>
                <th>Kategori</th>
                <th>Harga</th>
                <th>Gambar</th>
                <th>Action</th>
            </tr>

            <?php foreach ($products as $product): ?>
                <tr>
                    <td><?= $product->getId(); ?></td>
                    <td><?= $product->getName(); ?></td>
                    <td><?= $product->getCategory(); ?></td>
                    <td><?= $product->getPrice(); ?></td>
                    <td>
                        <img src="images/<?= $product->getImage(); ?>" alt="<?= $product->getName(); ?>">
                    </td>
                    <td>
                        <a href="?delete_id=<?= $product->getId(); ?>" onclick="return confirm('Apakah Anda yakin ingin menghapus produk ini?')">Hapus</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>
    </div>

    <!-- cari produk -->
    <div class="">
        <div>
            <h3>Cari Produk</h3>
            <form method="POST">
                <input type="text" name="search_query" placeholder="Cari berdasarkan nama">
                <button type="submit" name="search">Cari</button>
            </form>
        </div>
        <table>
            <?php if (empty($searchResults)): ?>
                <tr>
                    <td colspan="6">Produk tidak ditemukan</td>
                </tr>
            <?php else: ?>
                <?php foreach ($searchResults as $product): ?>
                    <tr>
                        <td><?= htmlspecialchars($product->getId()); ?></td>
                        <td><?= htmlspecialchars($product->getName()); ?></td>
                        <td><?= htmlspecialchars($product->getCategory()); ?></td>
                        <td><?= htmlspecialchars($product->getPrice()); ?></td>
                        <td>
                            <img src="images/<?= htmlspecialchars($product->getImage()); ?>" alt="<?= htmlspecialchars($product->getName()); ?>">
                        </td>
                        <td>
                            <a href="?delete_id=<?= $product->getId(); ?>" onclick="return confirm('Apakah Anda yakin ingin menghapus produk ini?')">Hapus</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>

        </table>
    </div>
</body>

</html>