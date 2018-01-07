<!DOCTYPE html>

<html>
<head>
    <meta charset="UTF-8"/>
    <title>Napaka pri avtorizaciji</title>
    <link rel="stylesheet" type="text/css" href="<?= CSS_URL . "style.css" ?>"/>
</head>


<body>

    <h2>401: Napaka pri avtorizaciji!</h2>
    <p>
        Niste posredovali veljavnega certifikata, zato se ne morete prijaviti na tej strani.
    </p>
    <p>
        Stranke se lahko prijavite tukaj: <a href="<?= BASE_URL . "prijava" ?>">prijava za stranke</a>.
    </p>
    <p>
        Osebje mora predložiti certifikat, v primeru problema, se obrnite na administratorja!
    </p>

</body>

</html>