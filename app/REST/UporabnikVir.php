<?php

require_once "ViewUtil.php";
require_once "app/models/Uporabniki.php";
require_once "app/service/UporabnikService.php";
require_once "app/models/StatusUporabnik.php";
require_once "app/service/PrijavaService.php";
require_once "app/models/VlogaUporabnik.php";
require_once "app/models/Posta.php";

class UporabnikVir {

    // skupno
    public static function izbrisiUporabnika($id){
        if(PrijavaService::uporabnikJeProdajalec() || PrijavaService::uporabnikJeAdmin()) {
            try {
                UporabnikService::izbrisiUporabnika($id);
                if(PrijavaService::uporabnikJeAdmin()) {
                    LogService::info("admin", "UPORABNIK", "Administrator " .
                        PrijavaService::vrniIdTrenutnegaUporabnika() . " je izbrisal uporabnika $id");
                } else if (PrijavaService::uporabnikJeProdajalec()) {
                    LogService::info("prodajalec", "UPORABNIK", "Prodajalec " .
                        PrijavaService::vrniIdTrenutnegaUporabnika() . " je izbrisal uporabnika $id");
                }
                echo ViewUtil::renderJSON(null, 204);
            } catch(InvalidArgumentException $e){
                echo ViewUtil::renderJSON(["napaka" => $e->getMessage()], 404);
            } catch(Exception $ex){
                echo ViewUtil::renderJSON(["napaka" => $ex->getMessage()], 400);
            }
        } else {
            echo ViewUtil::renderJSON(["napaka" => "Uporabnik nima zadostnih pravic!"], 401);
        }
    }

    public static function posredujPoste() {
        try {
            echo ViewUtil::renderJSON([Posta::getAll()], 200);
        } catch (Exception $e) {
            echo ViewUtil::renderJSON(["napaka" => $e->getMessage()], 400);
        }
    }

    public static function aktivirajUporabnika($id_uporabnika) {
        if(PrijavaService::uporabnikJeProdajalec() || PrijavaService::uporabnikJeAdmin()) {
            try {
                UporabnikService::aktivirajUporabnika($id_uporabnika);

                if(PrijavaService::uporabnikJeAdmin()) {
                    LogService::info("admin", "UPORABNIK", "Administrator " .
                        PrijavaService::vrniIdTrenutnegaUporabnika() . " je aktiviral uporabnika $id_uporabnika");
                } else if (PrijavaService::uporabnikJeProdajalec()) {
                    LogService::info("prodajalec", "UPORABNIK", "Prodajalec " .
                        PrijavaService::vrniIdTrenutnegaUporabnika() . " je aktiviral uporabnika $id_uporabnika");
                }

                echo ViewUtil::renderJSON(null, 204);
            } catch (InvalidArgumentException $e1) {
                echo ViewUtil::renderJSON(["napaka" => $e1->getMessage()], 404);
            } catch (Exception $e2) {
                echo ViewUtil::renderJSON(["napaka" => $e2->getMessage()], 400);
            }
        } else {
            echo ViewUtil::renderJSON(["napaka" => "Uporabnik nima zadostnih pravic!"], 401);
        }
    }

    public static function deaktivirajUporabnika($id_uporabnika) {
        if(PrijavaService::uporabnikJeProdajalec() || PrijavaService::uporabnikJeAdmin()) {
            try {
                UporabnikService::aktivirajUporabnika($id_uporabnika);
                if(PrijavaService::uporabnikJeAdmin()) {
                    LogService::info("admin", "UPORABNIK", "Administrator " .
                        PrijavaService::vrniIdTrenutnegaUporabnika() . " je deaktiviral uporabnika $id_uporabnika");
                } else if (PrijavaService::uporabnikJeProdajalec()) {
                    LogService::info("prodajalec", "UPORABNIK", "Prodajalec " .
                        PrijavaService::vrniIdTrenutnegaUporabnika() . " je deaktiviral uporabnika $id_uporabnika");
                }
                echo ViewUtil::renderJSON(null, 204);
            } catch (InvalidArgumentException $e1) {
                echo ViewUtil::renderJSON(["napaka" => $e1->getMessage()], 404);
            } catch (Exception $e2) {
                echo ViewUtil::renderJSON(["napaka" => $e2->getMessage()], 400);
            }
        } else {
            echo ViewUtil::renderJSON(["napaka" => "Uporabnik nima zadostnih pravic!"], 401);
        }
    }

    public static function posodobiSvojProfil($id_klienta = null) {
        $_PUT = [];
        parse_str(file_get_contents("php://input"), $_PUT);

        if(PrijavaService::uporabnikJePrijavljen()) {

            if($id_klienta == null) {
                $trenutniUporabnik = PrijavaService::vrniTrenutnegaUporabnika();
                $id = $trenutniUporabnik["id"];
            } else {
                $trenutniUporabnik = UporabnikService::vrniEnega($id_klienta);
                $id = $id_klienta;
            }

            switch ($trenutniUporabnik["vloga"]) {
                case VlogaUporabnik::getIdProdaja():
                    self::posodobiProdajalca($id);
                    break;
                case VlogaUporabnik::getIdStranka():
                    self::posodobiSelfStranko($id);
                    break;
                case VlogaUporabnik::getIdAdmin():
                    self::posodobiAdmina($id);
                    break;
            }
        } else {
            echo ViewUtil::renderJSON(["napaka" => "Uporabnik ni prijavljen!"], 401);
        }


    }

    // stranke

    public static function pridobiStranko($id) {
        if(PrijavaService::uporabnikJeProdajalec()) {
            try {
                echo ViewUtil::renderJSON(UporabnikService::vrniStranko($id), 200);
            } catch (InvalidArgumentException $e1) {
                echo ViewUtil::renderJSON(["napaka" => $e1->getMessage()], 404);
            } catch (Exception $e2) {
                echo ViewUtil::renderJSON(["napaka" => $e2->getMessage()], 400);
            }
        } else {
            echo ViewUtil::renderJSON(["napaka" => "Uporabnik nima zadostnih pravic!"], 401);
        }
    }

    public static function pridobiVseStranke() {
        if(PrijavaService::uporabnikJeProdajalec()) {
            if(isset($_GET["stran"])) {
                $stran = $_GET["stran"];
            } else {
                $stran = 1;
            }
            $uporabniki = UporabnikService::vrniVseStranke($stran);
            echo ViewUtil::renderJSON([
                "glava" => [
                    "st_vseh_zadetkov" => $uporabniki["stevec"]["st_zadetkov"],
                    "st_strani" => $uporabniki["stevec"]["st_strani"]
                ],
                "telo" => $uporabniki["uporabniki"]
            ], 200);
        } else {
            echo ViewUtil::renderJSON(["napaka" => "Uporabnik nima zadostnih pravic!"], 401);
        }
    }

    public static function dodajStranko() {
        if(PrijavaService::uporabnikJeProdajalec()) {
            $data = filter_input_array(INPUT_POST, Uporabniki::pravilaZaStranke());
            if(UporabnikService::preveriDaNiPraznihVrednosti($data)){
                try {
                    $uporabnik = UporabnikService::dodajStranko($data);
                    LogService::info("prodajalec", "UPORABNIK", "Prodajalec " .
                        PrijavaService::vrniIdTrenutnegaUporabnika() . " je dodal stranko $uporabnik");
                    echo ViewUtil::renderJSON($uporabnik, 201);
                } catch(InvalidArgumentException $e1) {
                    echo ViewUtil::renderJSON(["napaka" => $e1->getMessage()], 400);
                } catch (Exception $e2) {
                    echo ViewUtil::renderJSON(["napaka" => $e2->getMessage()], 500);
                }
            } else {
                echo ViewUtil::renderJSON(["napaka" => "Niso podane vse vrednosti!"], 400);
            }
        } else {
            echo ViewUtil::renderJSON(["napaka" => "Uporabnik nima zadostnih pravic!"], 401);
        }
    }

    public static function posodobiSelfStranko($id) {
        if(PrijavaService::uporabnikJeStranka()) {
            $_PUT = [];
            parse_str(file_get_contents("php://input"), $_PUT);
            $data = filter_var_array($_PUT, Uporabniki::pravilaZaStranke());
            
            if(UporabnikService::preveriDaNiPraznihVrednosti($data)) {
                $data["id"] = $id;
                try {
                    $uporabnik = UporabnikService::posodobiStranko($data);
                    LogService::info("prodajalec", "UPORABNIK", "Prodajalec " .
                        PrijavaService::vrniIdTrenutnegaUporabnika() . " je posodobil stranko" . $uporabnik["id"]);
                    echo ViewUtil::renderJSON($uporabnik, 200);
                } catch (InvalidArgumentException $e1) {
                    echo ViewUtil::renderJSON(["napaka" => $e1->getMessage()], 404);
                } catch (Exception $e2) {
                    echo ViewUtil::renderJSON(["napaka" => $e2->getMessage()], 400);
                }
            } else if(UporabnikService::preveriDaNiPraznihVrednostiPreskociGeslo($data)) {
                $data["id"] = $id;
                try {
                    $uporabnik = UporabnikService::posodobiStranko($data);
                    echo ViewUtil::renderJSON($uporabnik, 200);
                } catch (InvalidArgumentException $e1) {
                    echo ViewUtil::renderJSON(["napaka" => $e1->getMessage()], 404);
                } catch (Exception $e2) {
                    echo ViewUtil::renderJSON(["napaka" => $e2->getMessage()], 400);
                }
            } else {
                echo ViewUtil::renderJSON(["napaka" => "Nekateri atributi manjkajo!"], 400);
            }
        } else {
            echo ViewUtil::renderJSON(["napaka" => "Uporabnik nima zadostnih pravic!"], 401);
        }
    }

    public static function posodobiStranko($id) {
        if(PrijavaService::uporabnikJeProdajalec()) {
            $_PUT = [];
            parse_str(file_get_contents("php://input"), $_PUT);
            $data = filter_var_array($_PUT, Uporabniki::pravilaZaStranke());

            if(UporabnikService::preveriDaNiPraznihVrednosti($data)) {
                $data["id"] = $id;
                try {
                    $uporabnik = UporabnikService::posodobiStranko($data);
                    LogService::info("prodajalec", "UPORABNIK", "Prodajalec " .
                        PrijavaService::vrniIdTrenutnegaUporabnika() . " je posodobil stranko" . $uporabnik["id"]);
                    echo ViewUtil::renderJSON($uporabnik, 200);
                } catch (InvalidArgumentException $e1) {
                    echo ViewUtil::renderJSON(["napaka" => $e1->getMessage()], 404);
                } catch (Exception $e2) {
                    echo ViewUtil::renderJSON(["napaka" => $e2->getMessage()], 400);
                }
            } else if(UporabnikService::preveriDaNiPraznihVrednostiPreskociGeslo($data)) {
                $data["id"] = $id;
                try {
                    $uporabnik = UporabnikService::posodobiStranko($data);
                    echo ViewUtil::renderJSON($uporabnik, 200);
                } catch (InvalidArgumentException $e1) {
                    echo ViewUtil::renderJSON(["napaka" => $e1->getMessage()], 404);
                } catch (Exception $e2) {
                    echo ViewUtil::renderJSON(["napaka" => $e2->getMessage()], 400);
                }
            } else {
                echo ViewUtil::renderJSON(["napaka" => "Nekateri atributi manjkajo!"], 200);
            }
        } else {
            echo ViewUtil::renderJSON(["napaka" => "Uporabnik nima zadostnih pravic!"], 401);
        }
    }

    public static function posodobiStrankoAndroid($id) {
        $_PUT = [];
        parse_str(file_get_contents("php://input"), $_PUT);
        $data = filter_var_array($_PUT, Uporabniki::pravilaZaStranke());

        if(UporabnikService::preveriDaNiPraznihVrednosti($data)) {
            $data["id"] = $id;
            try {
                $uporabnik = UporabnikService::posodobiStranko($data);
                echo ViewUtil::renderJSON($uporabnik, 200);
            } catch (InvalidArgumentException $e1) {
                echo ViewUtil::renderJSON(["napaka" => $e1->getMessage()], 404);
            } catch (Exception $e2) {
                echo ViewUtil::renderJSON(["napaka" => $e2->getMessage()], 400);
            }
        } else if(UporabnikService::preveriDaNiPraznihVrednostiPreskociGeslo($data)) {
            $data["id"] = $id;
            try {
                $uporabnik = UporabnikService::posodobiStranko($data);
                echo ViewUtil::renderJSON($uporabnik, 200);
            } catch (InvalidArgumentException $e1) {
                echo ViewUtil::renderJSON(["napaka" => $e1->getMessage()], 404);
            } catch (Exception $e2) {
                echo ViewUtil::renderJSON(["napaka" => $e2->getMessage()], 400);
            }
        } else {
            echo ViewUtil::renderJSON(["napaka" => "Nekateri atributi manjkajo!"], 200);
        }
    }

    // prodajalci

    public static function pridobiVseProdajalce() {
        if(PrijavaService::uporabnikJeAdmin()) {
            if(isset($_GET["stran"])) {
                $stran = $_GET["stran"];
            } else {
                $stran = 1;
            }
            $uporabniki = UporabnikService::vrniVseProdajalce($stran);
            echo ViewUtil::renderJSON([
                "glava" => [
                    "st_vseh_zadetkov" => $uporabniki["stevec"]["st_zadetkov"],
                    "st_strani" => $uporabniki["stevec"]["st_strani"]
                ],
                "telo" => $uporabniki["uporabniki"]
            ], 200);
        } else {
            echo ViewUtil::renderJSON(["napaka" => "Uporabnik nima zadostnih pravic!"], 401);
        }
    }

    public static function pridobiProdajalca($id) {
        if(PrijavaService::uporabnikJeAdmin()) {
            try {
                echo ViewUtil::renderJSON(UporabnikService::vrniProdajalca($id), 200);
            } catch (InvalidArgumentException $e1) {
                echo ViewUtil::renderJSON(["napaka" => $e1->getMessage()], 404);
            } catch (Exception $e2) {
                echo ViewUtil::renderJSON(["napaka" => $e2->getMessage()], 400);
            }
        } else {
            echo ViewUtil::renderJSON(["napaka" => "Uporabnik nima zadostnih pravic!"], 401);
        }
    }

    public static function dodajProdajalca() {
        if(PrijavaService::uporabnikJeAdmin()) {
            $data = filter_input_array(INPUT_POST, Uporabniki::pravilaZaProdajalce());
            if(UporabnikService::preveriDaNiPraznihVrednosti($data)){
                try {
                    $uporabnik = UporabnikService::dodajProdajalca($data);
                    LogService::info("admin", "UPORABNIK", "Administrator " .
                        PrijavaService::vrniIdTrenutnegaUporabnika() . " je dodal prodajalca " . $uporabnik["id"]);
                    echo ViewUtil::renderJSON($uporabnik, 201);
                } catch(InvalidArgumentException $e1) {
                    echo ViewUtil::renderJSON(["napaka" => $e1->getMessage()], 400);
                } catch (Exception $e2) {
                    echo ViewUtil::renderJSON(["napaka" => $e2->getMessage()], 500);
                }
            } else {
                echo ViewUtil::renderJSON(["napaka" => "Niso podane vse vrednosti!"], 400);
            }
        } else {
            echo ViewUtil::renderJSON(["napaka" => "Uporabnik nima zadostnih pravic!"], 401);
        }
    }

    public static function posodobiProdajalca($id) {
        if(PrijavaService::uporabnikJeAdmin()) {
            $_PUT = [];
            parse_str(file_get_contents("php://input"), $_PUT);
            $data = filter_var_array($_PUT, Uporabniki::pravilaZaProdajalce());

            if(UporabnikService::preveriDaNiPraznihVrednosti($data)) {
                $data["id"] = $id;
                try {
                    $uporabnik = UporabnikService::posodobiProdajalca($data);
                    LogService::info("admin", "UPORABNIK", "Admin " .
                        PrijavaService::vrniIdTrenutnegaUporabnika() . " je posodobil prodajalca " . $uporabnik["id"]);
                    echo ViewUtil::renderJSON($uporabnik, 200);
                } catch (InvalidArgumentException $e1) {
                    echo ViewUtil::renderJSON(["napaka" => $e1->getMessage()], 404);
                } catch (Exception $e2) {
                    echo ViewUtil::renderJSON(["napaka" => $e2->getMessage()], 400);
                }
            } else if(UporabnikService::preveriDaNiPraznihVrednostiPreskociGeslo($data)) {
                $data["id"] = $id;
                try {
                    $uporabnik = UporabnikService::posodobiProdajalca($data);
                    LogService::info("admin", "UPORABNIK", "Admin " .
                        PrijavaService::vrniIdTrenutnegaUporabnika() . " je posodobil prodajalca " . $uporabnik["id"]);
                    echo ViewUtil::renderJSON($uporabnik, 200);
                } catch (InvalidArgumentException $e1) {
                    echo ViewUtil::renderJSON(["napaka" => $e1->getMessage()], 404);
                } catch (Exception $e2) {
                    echo ViewUtil::renderJSON(["napaka" => $e2->getMessage()], 400);
                }
            } else {
                echo ViewUtil::renderJSON(["napaka" => "Nekateri atributi manjkajo!"], 200);
            }
        } else {
            echo ViewUtil::renderJSON(["napaka" => "Uporabnik nima zadostnih pravic!"], 401);
        }
    }

    // admin
    private static function posodobiAdmina($id) {
        if(PrijavaService::uporabnikJeAdmin()) {
            $_PUT = [];
            parse_str(file_get_contents("php://input"), $_PUT);
            $data = filter_var_array($_PUT, Uporabniki::pravilaZaAdmina());

            if(UporabnikService::preveriDaNiPraznihVrednosti($data)) {
                $data["id"] = $id;
                try {
                    $uporabnik = UporabnikService::posodobiAdmina($data);
                    echo ViewUtil::renderJSON($uporabnik, 200);
                } catch (InvalidArgumentException $e1) {
                    echo ViewUtil::renderJSON(["napaka" => $e1->getMessage()], 404);
                } catch (Exception $e2) {
                    echo ViewUtil::renderJSON(["napaka" => $e2->getMessage()], 400);
                }
            } else if(UporabnikService::preveriDaNiPraznihVrednostiPreskociGeslo($data)) {
                $data["id"] = $id;
                try {
                    $uporabnik = UporabnikService::posodobiAdmina($data);
                    echo ViewUtil::renderJSON($uporabnik, 200);
                } catch (InvalidArgumentException $e1) {
                    echo ViewUtil::renderJSON(["napaka" => $e1->getMessage()], 404);
                } catch (Exception $e2) {
                    echo ViewUtil::renderJSON(["napaka" => $e2->getMessage()], 400);
                }
            } else {
                echo ViewUtil::renderJSON(["napaka" => "Nekateri atributi manjkajo!"], 200);
            }
        } else {
            echo ViewUtil::renderJSON(["napaka" => "Uporabnik nima zadostnih pravic!"], 401);
        }
    }

    // android
    public static function posredujUporabnikaZSeznamomPost($id){
        try {
            echo ViewUtil::renderJSON(UporabnikService::vrniUporabnikaSSeznamomPost($id), 200);
        } catch(InvalidArgumentException $e){
            echo ViewUtil::renderJSON(["napaka" => $e->getMessage()], 400);
        }
    }

    // ostalo
    public static function pridobiVse(){
        echo ViewUtil::renderJSON(UporabnikService::vrniVse(), 200);
    }

    public static function pridobiEnega($id){
        try {
            echo ViewUtil::renderJSON(UporabnikService::vrniEnega($id), 200);
        } catch(InvalidArgumentException $e){
            echo ViewUtil::renderJSON(["napaka" => $e->getMessage()], 404);
        }
    }

    public static function dodajUporabnika(){
        $data = filter_input_array(INPUT_POST, Uporabniki::getRules());

        if(ViewUtil::checkValues($data)){
            try {
                $uporabnik = UporabnikService::dodajUporabnika($data);
                echo ViewUtil::renderJSON($uporabnik, 201);
            } catch(InvalidArgumentException $e){
                echo ViewUtil::renderJSON(["napaka" => $e->getMessage()], 404);
            } catch (Exception $ex){
                echo ViewUtil::renderJSON(["napaka" => $ex->getMessage()], 400);
            }
        }
    }

    public static function posodobiUporabnika($id){
        $_PUT = [];
        parse_str(file_get_contents("php://input"), $_PUT);
        $data = filter_var_array($_PUT, Uporabniki::getRules());

        if(self::checkPUTValues($data)){
            $data["id"] = $id;
            try {
                UporabnikService::posodobiUporabnika($data);
                echo ViewUtil::renderJSON(UporabnikService::vrniEnega($id), 200);
            }catch(InvalidArgumentException $e){
                echo ViewUtil::renderJSON(["napaka" => $e->getMessage()], 404);
            } catch(Exception $ex){
                echo ViewUtil::renderJSON(["napaka" => $ex->getMessage()], 400);
            }
        } else {
            echo ViewUtil::renderJSON(["napaka" => "Missing values!"], 400);
        }
    }

    private static function checkPUTValues($input){
        if(empty($input)){
            return FALSE;
        }
        $result = TRUE;
        foreach ($input as $key => $value){
            if($key != "geslo"){
                $result = $result && $value != false;
            }
        }
        return $result;
    }

}
