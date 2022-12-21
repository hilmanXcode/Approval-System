<?php
session_start();
include 'koneksi.php';

if(!isset($_SESSION['user_id'])){
    header("Location: login.php");
    die();
}

$id = $_SESSION['user_id'];

if(isset($_GET['id'])){
    $id = $_GET['id'];
    if($id != ""){
        $query = mysqli_query($koneksi, "SELECT * FROM invoice WHERE id='$id'");
        $data = mysqli_fetch_array($query, MYSQLI_ASSOC);
    }
    else {
        echo "Huuuu";
    }
}
else {
    $query = mysqli_query($koneksi, "SELECT * FROM invoice WHERE user_id='$id'");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice</title>
</head>
<body>
    <?php
    if(isset($_GET['id'])){
        if($data['confirm'] == 0){
    ?>
    <form action="proses.php" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="id_invoice" value="<?= $_GET['id']; ?>">
        <h3>Silahkan Kirim Bukti Transfer Ke No. 11223311233</h3>
        <label for="bukti_pembayaran">Upload Bukti</label>
        <input type="file" name="bukti_pembayaran">
        <br>
        <br>
        <button type="submit" name="invoice_proc">Submit</button>
    </form>
    <?php }
    else {
    ?>
    <h3>Kamu Sudah Bayar Barang Ini Sayyy</h3>
    <?php } ?>
    <?php }
    else {
    
    foreach($query as $data){
    ?>
    <h3>Nama Product : <?= $data['product']; ?></h3>
    <h3>Status : <?php
        if($data['confirm'] == 0){
            if($data['bukti'] != ""){
                echo "Pending";
            }
            else {
                echo "Not Payed";
            }
        }
        else {
            echo "<font color='green'>Payed!!, Mohon Menunggu Paket Anda Sampai</font>";
        }
    ?></h3>
    <h3>Kuantitas : <?= $data['buyed']; ?></h3>
    <hr>
    <?php
    if($data['confirm'] == 0){
        if($data['bukti'] != ""){
    ?>
    <h3>Pesan : Mohon Menunggu Admin Mengkonfirmasi pesanan anda</h3>
    <hr>
    <?php }
    else { ?>
    <a href="invoice.php?id=<?= $data['id']; ?>">Pay Noww</a>
    <hr>
    <?php } ?>
    <?php } ?>
    <?php } ?>
    <?php } ?>
</body>
</html>