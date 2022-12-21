<?php
session_start();
include 'koneksi.php';

$query = mysqli_query($koneksi, "SELECT * FROM invoice WHERE bukti !=''");
$num = mysqli_num_rows($query);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Approve A Invoice | Admin Dashboard</title>
</head>
<body>
    <table border="1" cellpadding="1">
        <thead>
            <tr>
                <th>Nama Pembeli</th>
                <th>Product</th>
                <th>Bukti Pembayaran</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach($query as $data){
                $id = $data['user_id'];
                $sql = mysqli_query($koneksi, "SELECT * FROM users WHERE id='$id'");
                $user = mysqli_fetch_array($sql, MYSQLI_ASSOC);
                if($data['confirm'] == 0){
                ?>
            <form action="proses.php" method="POST" enctype="multipart/form-data">
            <tr>
                <input type="hidden" name="id_invoice" value="<?= $data['id']; ?>">
                <td><?= htmlentities($user['username']); ?></td>
                <td><?= htmlentities($data['product']); ?></td>
                <td><img src="bukti/<?= $data['bukti']; ?>" alt="bukti pembayaran" width="450" height="450"></td>
                <td>
                    <button type="submit" name="approv_invoice">Approve</button>
                    <button type="submit" name="decline_invoice">Decline</button>
                </td>
            </tr>
            </form>
            <?php } ?>
            <?php } ?>
            <?php
            if($num == 0){
            ?>
            <font color="red">Tidak Ada Invoice Untuk Hari Ini</font>
            <?php } ?>
        </tbody>
    </table>
</body>
</html>