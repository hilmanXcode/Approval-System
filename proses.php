<?php
session_start();
include 'koneksi.php';



if(isset($_POST['add_product'])){
    $nama = $_POST['nama'];
    $stock = $_POST['stock'];

    $query = mysqli_query($koneksi, "INSERT INTO product (nama, stock) VALUES ('$nama', '$stock')");
    if($query){
        header("Location: index.php");
    }
    else {
        echo "Gagal Menambahkan Product";
    }
}
elseif(isset($_POST['add_user'])){
    $username = $_POST['username'];
    $password = $_POST['password'];

    $query = mysqli_query($koneksi, "INSERT INTO users (username, password) VALUES ('$username', '$password')");

    if($query){
        header("Location: login.php");
    }
    else {
        echo "gagal";
    }
}
elseif(isset($_POST['login_check'])){
    $username = $_POST['username'];
    $password = $_POST['password'];

    $query = mysqli_query($koneksi, "SELECT * FROM users WHERE username='$username'");
    $data = mysqli_fetch_array($query, MYSQLI_ASSOC);
    $num = mysqli_num_rows($query);

    if($query){
        if($num != 0){
            if($password == $data['password']){
                header("Location: index.php");
                $_SESSION['user_id'] = $data['id'];
                $_SESSION['username'] = $data['username'];
            }
            else {
                echo "Password yang anda masukkan salah";
            }
        }
        else {
            echo "User dengan username $username tidak ditemukan";
        }
    }
    else {
        echo "Kesalahan sistem";
    }
}
elseif(isset($_POST['keranjang'])){
    $id_keranjang = $_POST['id_keranjang'];
    $user_id = $_SESSION['user_id'];
    $id_product = $_POST['id'];
    $product = $_POST['product'];
    $buyed = $_POST['buyed'];

    $query = mysqli_query($koneksi, "INSERT INTO invoice (id_product, user_id, product, buyed, confirm, bukti) VALUES ('$id_product', '$user_id', '$product', '$buyed', 0, '')");

    if($query){
        $query2 = mysqli_query($koneksi, "UPDATE keranjang SET invoiced=1 WHERE id='$id_keranjang'");
        if($query2){
            header("Location: invoice.php");
        }
    }
    else {
        echo "Gagal Menambahkan data invoice";
    }
}
elseif(isset($_POST['invoice_proc'])){
    $id = $_POST['id_invoice'];
    $foto_name = $_FILES['bukti_pembayaran']['name'];
    $foto_size = $_FILES['bukti_pembayaran']['size'];

    if($foto_size > 2097152){
        echo "Ukuran Gambar Terlalu Besar, Maks. 2MB";
    }
    else {
        if($foto_name != ""){
            $allowedExt = ['png', 'jpg', 'jpeg'];
            $pisahkan_ext = explode('.', $foto_name);
            $ext = strtolower(end($pisahkan_ext));
            $file_tmp = $_FILES['bukti_pembayaran']['tmp_name'];

            $tanggal = md5(date('Y-m-d h:i:s'));

            $foto_name_new = $tanggal.'-'.$foto_name;

            if(in_array($ext, $allowedExt) === true){
                move_uploaded_file($file_tmp, 'bukti/'.$foto_name_new);

                $query = mysqli_query($koneksi, "UPDATE invoice SET bukti='$foto_name_new' WHERE id='$id'");

                if($query){
                    header("Location: invoice.php");
                }
            }
            else {
                echo "Foto pembayaran harus lah ber extensi .png, .jpg, atau .jpeg";
            }
        }
    }
}
?>