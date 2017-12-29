<!DOCTYPE html>

<html>
<head>
    <meta charset="UTF-8"/>
    <title>Slika test</title>
    <link rel="stylesheet" type="text/css" href="<?= CSS_URL . "style.css" ?>"/>
</head>


<body>
<form method="POST" action="<?= BASE_URL ?>slika" enctype="multipart/form-data">
    <input type="file" name="img"> <br/>
    <button type="submit" name="submit">Submit</button>
</form>
</body>

</html>