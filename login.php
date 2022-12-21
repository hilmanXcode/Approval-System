<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
    <center>
        <h1>Halaman Login</h1>
        <form action="proses.php" method="POST">
            <label for="username">username</label>
            <input type="text" name="username">
            <br>
            <br>
            <label for="password">password</label>
            <input type="password" name="password">
            <br>
            <br>
            <button type="submit" name="login_check">Login</button>
        </form>
    </center>
</body>
</html>