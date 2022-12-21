<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Product's</title>
</head>
<body>
    <form action="proses.php" method="POST">
        <label for="nama">Nama Produk</label>
        <input type="text" name="nama">
        <br>
        <br>
        <label for="stock">Stock Product</label>
        <input type="number" name="stock">
        <br>
        <br>
        <button type="submit" name="add_product">Submit</button>
    </form>
</body>
</html>