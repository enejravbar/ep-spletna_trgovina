<!DOCTYPE html>

<html>
<head>
    <meta charset="UTF-8"/>
    <title>Email</title>
</head>


<body>
    <div id="content">
        <h3>Dobrodošel v Spletno prodajalno!</h3>
        <br/>
        <p><?= $ime ?>, pozdravljen v spletni prodajalni!</p>
        <p>Registriral si se z naslednjimi podatki: <br/>
            &#160;&#160;&#160;&#160;Elektronski naslov: <strong><?= $email ?></strong><br/>
            &#160;&#160;&#160;&#160;Geslo: <strong><?= $geslo ?></strong><br/>
        </p>
        <p>Za registracijo moraš potrditi svoj elektronski naslov, kar lahko storiš s klikom na spodnjo povezavo:</p>
        <a href="http://localhost<?= BASE_URL ?>api/potrdi/<?= $kljuc ?>">Potrdi elektronski naslov</a>
    </div>
</body>

</html>