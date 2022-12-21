<?php
session_start();
error_reporting(0);
include 'koneksi.php';
if(!isset($_SESSION['user_id'])){
    header("Location: login.php");
    die();
}
$user_id = $_SESSION['user_id'];
if(isset($_GET['id'])){
    $id = $_GET['id'];
    if($id != ""){
        $buyed = 1;
        $query = mysqli_query($koneksi, "SELECT * FROM product WHERE id='$id'");
        $data = mysqli_fetch_array($query, MYSQLI_ASSOC);
        if($query){
            $product = $data['nama'];
            $sql = mysqli_query($koneksi, "INSERT INTO keranjang (user_id, id_product, product, buyed, invoiced) VALUES ('$user_id', '$id', '$product', '$buyed', 0)");

            if($sql){
                header("Location: keranjang.php");
            }
            else {
                echo "Gagal Menambahkan data keranjang";
            }
        }
        else {
            echo "Gagal Mengambil Data Product";
        }
    }
}
else {
    $query = mysqli_query($koneksi, "SELECT * FROM keranjang WHERE user_id='$user_id'");
    // $data = mysqli_fetch_array($query, MYSQLI_ASSOC);
    $num = mysqli_num_rows($query);
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Keranjang</title>
</head>
<body>
    <?php
    $x = 1;
    foreach($query as $data){
    if($data['invoiced'] == 0){
    ?>
    <h4>Product <?= $x++ ?></h4>
    <form action="proses.php" method="POST">
        <input type="hidden" name="id_keranjang" value="<?= htmlentities($data['id']); ?>">
        <input type="hidden" name="id" value="<?= htmlentities($data['id_product']); ?>">
        Nama Product : <input type="text" name="product" value="<?= htmlentities($data['product']); ?>" readonly></input>
        <br>
        <br>
        Banyak Di Beli : <a onclick="decreament()">-</a> <input style="width: 50px;" type="number" name="buyed" value="<?= htmlentities($data['buyed']); ?>" id="buyed" readonly></input> <a onclick="increment()">+</a>
        <br>
        <br>
        <button type="submit" name="keranjang">checkout</button>
    </form>
    <?php } ?>
    <?php } ?>
    <?php
    if($data['invoiced'] == 1){
    ?>
    <h3>Ada Barang Yang Belum Di Bayar Nihhhh</h3>
    <a href="invoice.php">Bayar Sekarang Ahh</a>
    <?php } ?>
    <script>
        const buyed = document.getElementById("buyed");
        const increment = () => {
            buyed.value++;
        }
        const decreament = () => {
            if(buyed.value == 1){
                
            }
            else {
                buyed.value--;
            }
            
        }
    </script>
</body>
</html>