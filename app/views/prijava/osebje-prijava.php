<!DOCTPYE html>

<html>

<head>
    <meta charset="UTF-8"/>
    <title>Stran za osebje - prijava</title>
</head>

<body>
<h2>Login page</h2>
<form action="<?= BASE_URL . "osebje/prijava" ?>" method="post">
    <input type="text" name="email" value="<?= $email ?>" readonly/>
    <input type="password" name="geslo" required/>
    <button type="submit">Prijava</button>
</form>
</body>

</html>