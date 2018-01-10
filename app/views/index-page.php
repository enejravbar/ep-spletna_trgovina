<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8"/>
        <title>Forum</title>
        <link rel="stylesheet" type="text/css" href="<?= CSS_URL . "style.css" ?>"/>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    </head>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script>
        //test redirekcij
        function doAjax() {
            var req = new XMLHttpRequest();
            req.open("GET", "https://localhost/pstorm/ep-spletna_trgovina/api/izdelki", true);
            req.addEventListener("load", function(){
                res = req.responseText;
                res = JSON.parse(res);
                console.log(res);
            });
            req.send();
        }

    </script>

    <body>
    <!--
        <div id="izdelki">
            <?php foreach ($izdelki as $izdelek): ?>
                <div>
                    <h3><?= $izdelek["ime"] ?></h3>
                    <p><?= $izdelek["opis"] ?></p>
                    <p><?= $izdelek["cena"] ?></p>
                </div>
            <?php endforeach; ?>
        </div>
        -->
    <?= isset($_SESSION["trenutni_uporabnik"])? var_dump($_SESSION["trenutni_uporabnik"]): "Uporabnik ni prijavljen!" ?>
    <?= isset($_SESSION["certifikat"])? var_dump($_SESSION["certifikat"]): "" ?>
    <button onclick="doAjax()">Do Ajax</button>
    <a href="<?= BASE_URL . "prijava" ?>">Prijava za stranke</a><br/>
    <br/>
    <a href="<?= BASE_URL . "osebje/prijava" ?>">Prijava za osebje</a>
    </body>

</html>