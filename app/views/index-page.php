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

    <body>
        <div id="izdelki">
            <?php foreach ($izdelki as $izdelek): ?>
                <div>
                    <h3><?= $izdelek["ime"] ?></h3>
                    <p><?= $izdelek["opis"] ?></p>
                    <p><?= $izdelek["cena"] ?></p>
                </div>
            <?php endforeach; ?>
        </div>
    </body>

</html>