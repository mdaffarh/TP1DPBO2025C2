<?php
session_start();
require_once 'Petshop.php';

if (!isset($_SESSION['products'])) {
    $_SESSION['products'] = [];
}

// Ambil data produk dari session
$products = [];
if (!empty($_SESSION['products'])) {
    foreach ($_SESSION['products'] as $data) {
        if (is_string($data)) {
            $products[] = unserialize($data);
        }
    }
}

// Tambah produk
if (isset($_POST['add'])) {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $category = $_POST['category'];
    $price = $_POST['price'];

    // Upload gambar
    $imageName = basename($_FILES['image']['name']);
    $imageTmp = $_FILES['image']['tmp_name'];
    $imagePath = "images/" . $imageName;
    move_uploaded_file($imageTmp, $imagePath);

    $product = new Petshop($id, $name, $category, $price, $imageName);

    // Simpan dalam session dalam bentuk serialized object
    $_SESSION['products'][] = serialize($product);

    header("Location: " . $_SERVER['PHP_SELF']);
    exit();
}

// Edit produk
if (isset($_POST['edit'])) {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $category = $_POST['category'];
    $price = $_POST['price'];

    // Upload gambar
    $imageName = basename($_FILES['image']['name']);
    $imageTmp = $_FILES['image']['tmp_name'];
    $imagePath = "images/" . $imageName;
    move_uploaded_file($imageTmp, $imagePath);

    foreach ($_SESSION['products'] as $key => $product) {
        // $product = unserialize($data);
        if ($product->getId() == $id) {
            $updatedProduct = new Petshop($id, $name, $category, $price, $imageName);
            $_SESSION['products'][$key] = serialize($updatedProduct);
        }
    }

    header("Location: " . $_SERVER['PHP_SELF']);
    exit();
}

// Hapus produk
if (isset($_GET['delete_id'])) {
    $deleteId = $_GET['delete_id'];

    foreach ($_SESSION['products'] as $key => $data) {
        $product = unserialize($data);
        if ($product->getId() == $deleteId) {
            unset($_SESSION['products'][$key]);
            break;
        }
    }

    header("Location: " . $_SERVER['PHP_SELF']);
    exit();
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
        </table>
    </div>
</body>

</html>