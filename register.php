<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buat Akun Baru</title>
</head>
<body>
    <form action="proses.php" method="POST">
        <label for="username">username</label>
        <input type="text" name="username">
        <br>
        <br>
        <label for="password">password</label>
        <input type="password" name="password">
        <br>
        <br>
        <button type="submit" name="add_user">Submit</button>
    </form>
</body>
</html>