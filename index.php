<?php
include 'config.php';

$result = $conn->query("SELECT * FROM products");
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Toko Online</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h2>Daftar Produk</h2>
    <div class="product-container">
        <?php while ($row = $result->fetch_assoc()) { ?>
            <div class="product">
                <img src="<?= $row['image']; ?>" alt="<?= $row['name']; ?>">
                <h3><?= $row['name']; ?></h3>
                <p>Rp <?= number_format($row['price'], 0, ',', '.'); ?></p>
                <button onclick='addToCart(<?= json_encode($row); ?>)'>Tambah ke Keranjang</button>
            </div>
        <?php } ?>
    </div>

    <a href="cart.html">Lihat Keranjang</a>

    <script>
        function addToCart(product) {
            let cart = JSON.parse(localStorage.getItem("cart")) || [];
            cart.push(product);
            localStorage.setItem("cart", JSON.stringify(cart));
            alert("Produk ditambahkan ke keranjang!");
        }
    </script>
</body>
</html>
