<!DOCTYPE html>

<html>
<head>
    <meta charset="UTF-8"/>
    <title>Email</title>
</head>


<body>
    <div id="content">
        <h3>Dobrodosel v Spletno prodajalno!</h3>
        <br/>
        <p>Pozdravljen v spletni prodajalni!</p>
        <p>Za registracijo moras potrditi svoj elektronski naslov, kar lahko storis s klikom na spodnjo povezavo:</p>
        <a href="http://localhost<?= BASE_URL ?>api/potrdi/<?= $kljuc ?>">Potrdi elektronski naslov</a>
    </div>
</body>

</html>