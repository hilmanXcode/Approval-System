<?php
session_start();
include 'koneksi.php';

if(!isset($_SESSION['user_id'])){
    header("Location: login.php");
    die();
}

$query = mysqli_query($koneksi, "SELECT * FROM product");

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Online Shop</title>
</head>
<body>
    <a href="keranjang.php">Cek Keranjang Muuu Disini</a>
    <table border="1" cellpadding="20">
        <thead>
            <tr>
                <th>Nama Product</th>
                <th>Stock Product</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach($query as $data){
            ?>
            <tr>
                <td><?= htmlentities($data['nama']) ?></td>
                <td><?= htmlentities($data['stock']) ?></td>
                <td>
                    <a href="keranjang.php?id=<?php echo $data['id']; ?>">Tambahkan Ke Keranjang</a>
                </td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
</body>
</html>