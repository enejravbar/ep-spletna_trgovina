<?php

require_once "ViewUtil.php";
// servisi
require_once "app/service/EmailService.php";
require_once "app/service/LogService.php";
require_once "app/service/UporabnikService.php";
require_once "app/service/FileService.php";
// controllers
require_once "app/controllers/IndexController.php";
require_once "app/controllers/LoginController.php";
require_once "app/controllers/AdminController.php";
require_once "app/controllers/IzdelekController.php";
require_once "app/controllers/KosaricaController.php";
require_once "app/controllers/NarocilaController.php";
require_once "app/controllers/ProdajaController.php";
require_once "app/controllers/ProfilController.php";
// REST viri
require_once "app/REST/SlikaVir.php";
require_once "app/REST/IzdelekVir.php";
require_once "app/REST/PrijavaVir.php";
require_once "app/REST/UporabnikVir.php";
require_once "app/REST/KategorijaVir.php";
require_once "app/REST/KosaricaVir.php";
// debug (to be deleted in production)
require_once "app/models/Slika.php";


class Usmerjevalniki {

    public static function getRouters(){
        return [
            // ------------------- POGLEDI --------------------------------
            // ********** NAVIGACIJA **********
            // glavna stran
            "/^$/" => function() {
                IndexController::index();
            },
            // prijava, odjava, registracija za stranke za PHP aplikacijo
            "/^prijava$/" => function($method){
                switch($method) {
                    case "POST":
                        //login user
                        LoginController::prijaviStranko();
                        break;
                    default:
                        //load login page
                        LoginController::prikaziPrijavnoStran();
                        break;
                }
            },
            "/^odjava$/" => function() {
                LoginController::odjaviUporabnika();
            },
            "/^registracija$/" => function($method) {
                switch ($method) {
                    case "POST":
                        LoginController::registrirajStranko();
                        break;
                    default:
                        LoginController::prikaziRegistracijskoStran();
                        break;
                }
            },
            // profil za trenutnega uporabnika
            "/^profil$/" => function($method){
                switch($method) {
                    case "PUT":
                        //posodobi
                        break;
                    default:
                        ProfilController::PrikaziUrejanjeProfila();
                        break;
                }
            },
            //kosarica
            "/^kosarica$/" => function($method) {
                switch($method){
                    case "POST":
                        //dodaj v kosarico
                        break;
                    default:
                        KosaricaController::prikaziKosarico();
                        break;
                }
            },
            "/^blagajna$/" => function($method) {
                switch ($method) {
                    default:
                        KosaricaController::naBlagajno();
                        break;
                }
            },
            "/^izdelki$/" => function($method) {
                if($method == "GET") {
                    IzdelekController::prikaziSeznamIzdelkov();
                }
            },
            "/^izdelki\/(\d+)$/" => function($method, $id) {
                if($method == "GET") {
                    IzdelekController::prikaziPodrobnostIzdelka($id);
                }
            },
            // ************** PRODAJALEC ***************+
            //pregled strank
            "/^prodaja\/stranke$/" => function($method) {
                switch ($method) {
                    default:
                        ProdajaController::prikaziSeznamStrank();
                        break;
                }
            },
            // dodajanje stranke
            "/^prodaja\/stranke\/novo$/" => function($method) {
                switch ($method) {
                    default:
                        ProdajaController::prikaziDodajanjeStrank();
                        break;
                }
            },
            //urejanje stranke
            "/^prodaja\/stranke\/(\d+)\/uredi$/" => function($method, $id){
                switch ($method) {
                    default:
                        ProdajaController::prikaziUrejanjeStrank($id);
                        break;
                }
            },
            //pregled narocil
            "/^prodaja\/narocila$/" => function($method) {
                switch ($method) {
                    default:
                        ProdajaController::prikaziSeznamNarocil();
                        break;
                }
            },
            //pregled narocila
            "/^prodaja\/narocila\/(\d+)$/" => function($method, $id) {
                switch ($method) {
                    default:
                        ProdajaController::prikaziPodrobnostNarocil($id);
                        break;
                }
            },
            //pregled izdelkov
            "/^prodaja\/izdelki$/" => function($method) {
                switch ($method) {
                    default:
                        ProdajaController::prikaziSeznamIzdelkov();
                        break;
                }
            },
            //dodajanje izdelkov
            "/^prodaja\/izdelki\/novo$/" => function($method) {
                switch ($method){
                    default:
                        ProdajaController::prikaziDodajanjeIzdelkov();
                        break;
                }
            },
            //urejanje izdelkov
            "/^prodaja\/izdelki\/(\d+)\/uredi$/" => function($method, $id) {
                switch ($method){
                    default:
                        ProdajaController::prikaziUrejanjeIzdelkov($id);
                        break;
                }
            },
            // ********** ADMIN ************
            "/^admin$/" => function($method) {
                switch ($method) {
                    default:
                        AdminController::prikaziSeznamProdajalcev();
                        break;
                }
            },
            "/^admin\/novo$/" => function($method) {
                switch ($method) {
                    default:
                        AdminController::prikaziDodajanjeProdajalcev();
                        break;
                }
            },
            "/^admin\/(\d+)\/uredi$/" => function($method, $id){
                switch ($method){
                    default:
                        AdminController::prikaziUrejanjeProdajalcev($id);
                        break;
                }
            },
            //prijava za osebje s certifikatom
            "/^osebje\/prijava$/" => function($method){
                switch ($method){
                    case "POST":
                        LoginController::prijaviOsebje();
                        break;
                    default:
                        LoginController::prikaziPrijavnoStranZaOsebje();
                        break;
                }
            },
            // ---------------------------- REST ---------------------------------------
            // profil
            "/^api\/profil$/" => function($method) {
                switch ($method) {
                    case "PUT":
                        UporabnikVir::posodobiSvojProfil();
                        break;
                    default:
                        PrijavaVir::pridobiTrenutnegaUporabnika();
                        break;
                }
            },
            "/^api\/profil\/(\d+)$/" => function($method, $id) {
                if($method == "PUT") {
                    UporabnikVir::posodobiSvojProfil($id);
                }
            },
            // stranke
            "/^api\/stranke$/" => function($method) {
                switch ($method) {
                    case "POST":
                        UporabnikVir::dodajStranko();
                        break;
                    default:
                        // GET parameter ?stran=x, x = 1..n, default: x=1
                        UporabnikVir::pridobiVseStranke();
                        break;
                }
            },
            "/^api\/stranke\/(\d+)$/" => function($method, $id) {
                switch ($method) {
                    case "PUT":
                        UporabnikVir::posodobiStranko($id);
                        break;
                    case "DELETE":
                        UporabnikVir::izbrisiUporabnika($id);
                        break;
                    default:
                        UporabnikVir::pridobiStranko($id);
                        break;
                }
            },
            //potrditev stranke
            "/^api\/potrdi\/(.+)$/" => function($method, $kljuc){
                UporabnikService::potrdiUporabnika($kljuc);
                ViewUtil::redirect(BASE_URL);
            },
            // prodajalci
            "/^api\/prodajalci$/" => function($method) {
                switch ($method) {
                    case "POST":
                        UporabnikVir::dodajProdajalca();
                        break;
                    default:
                        // GET parameter ?stran=x, x = 1..n, default: x=1
                        UporabnikVir::pridobiVseProdajalce();
                        break;
                }
            },
            "/^api\/prodajalci\/(\d+)$/" => function($method, $id) {
                switch ($method) {
                    case "PUT":
                        UporabnikVir::posodobiProdajalca($id);
                        break;
                    case "DELETE":
                        UporabnikVir::izbrisiUporabnika($id);
                        break;
                    default:
                        UporabnikVir::pridobiProdajalca($id);
                        break;
                }
            },
            // uporabniki
            "/^api\/uporabniki\/(\d+)\/aktiviraj$/" => function($method, $id) {
                if($method == "PUT") {
                    UporabnikVir::aktivirajUporabnika($id);
                }
            },
            "/^api\/uporabniki\/(\d+)\/deaktiviraj$/" => function($method, $id) {
                if($method == "PUT") {
                    UporabnikVir::deaktivirajUporabnika($id);
                }
            },
            // izdelki
            "/^api\/izdelki\/(\d+)$/" => function($method, $id = null){
                switch($method){
                    case "PUT":
                        IzdelekVir::posodobi($id);
                        break;
                    case "DELETE":
                        IzdelekVir::izbrisi($id);
                        break;
                    default:
                        IzdelekVir::get($id);
                        break;
                }
            },
            "/^api\/izdelki$/" => function($method){
                switch($method) {
                    case "POST":
                        IzdelekVir::shrani();
                        break;
                    default:
                        IzdelekVir::getAll();
                        break;
                }
            },
            "/^api\/izdelki\/(\d+)\/slike\/(\d+)$/" => function($method, $id_izdelka, $id_slike) {
                switch ($method) {
                    case "POST" :
                        //dodaj sliko
                        IzdelekVir::dodajSlikoIzdelka($id_izdelka);
                        break;
                    case "DELETE":
                        //izbrisi sliko
                        IzdelekVir::izbrisiSlikoIzdelka($id_slike);
                        break;
                }
            },
            "/^api\/izdelki\/index$/" => function($method) {
                if($method == "GET") {
                    IzdelekVir::getForIndex();
                }
            },
            // kategorije
            "/^api\/kategorije$/" => function($method){
                KategorijaVir::pridobiVse();
            },
            "/^api\/kategorije\/(\d+)\/izdelki$/" => function($method, $id){
                KategorijaVir::pridobiVseIzdelkeIzKategorije($id);
            },
            // slike
            "/^api\/slike\/izdelek\/(\d+)$/" => function($method, $id){
                if($method == "POST"){
                    SlikaVir::shraniSliko($id);
                }
            },
            "/^api\/slike\/(\d+)$/" => function($method, $id){
                switch ($method){
                    case "DELETE":
                        SlikaVir::izbrisiSliko($id);
                        break;
                    default:
                        SlikaVir::prikaziSliko($id);
                        break;
                }
            },
            // kosarica
            "/^api\/kosarica$/" => function($method) {
                switch ($method) {
                    case "POST":
                        KosaricaVir::dodajIzdelekVKosarico();
                        break;
                    case "PUT":
                        KosaricaVir::spremeniKolicinoIzdelkaVKosarici();
                        break;
                    default:
                        KosaricaVir::dobiKosarico();
                        break;
                }
            },
            "/^api\/kosarica\/(\d+)$/" => function($method, $id_stranke) {
                if($method == "DELETE") {
                    KosaricaVir::izprazniKosarico($id_stranke);
                }
            },
            "/^api\/kosarica\/izdelek\/(\d+)$/" => function($method, $id_izdelka) {
                if($method == "DELETE") {
                    KosaricaVir::odstraniIzdelekIzKosarice($id_izdelka);
                }
            },
            // ********** ANDROID ************
            // android login
            "/^api\/android\/prijava$/" => function($method){
                if($method == "POST") {
                    PrijavaVir::prijaviUporabnika();
                }
            },
            "/^api\/android\/stranke\/(\d+)$/" => function($method, $id){
                switch ($method) {
                    case "PUT":
                        UporabnikVir::posodobiStrankoAndroid($id);
                        break;
                    default:
                        UporabnikVir::posredujUporabnikaZSeznamomPost($id);
                        break;
                }

            },
            // ------------------------ TEST -------------------------
            "/^api\/test\/stranke$/" => function($method) {
                UporabnikVir::pridobiVseStranke();
            },
            "/^api\/test\/prodajalci/" => function($method) {
                UporabnikVir::pridobiVseProdajalce();
            },
            "/^api\/test\/izdelki$/" => function($method) {
                IzdelekVir::testirajDodajanjeIzdelka();
            },
            "/^test\/izdelek\/(\d+)$/" => function($method, $id) {
                echo Slika::pridobiStevilkoSlike(["izdelek_id" => $id]);
            },
            //test image
            "/^slika\/preview$/" => function(){
                echo ViewUtil::render("app/views/slika-preview.php", [
                    "slika_url" => "data/images/in-flames-desktop.jpg"
                ]);
            },
            "/^slika\/test$/" => function($method){
                if($method == "POST"){
                    //shrani sliko
                    if(isset($_POST["submit"])){
                        try {
                            FileService::naloziSliko($_FILES["img"], "testna_slika123");
                            echo ViewUtil::renderJSON(["msg" => "Uspeh!"], 200);
                        } catch(InvalidArgumentException $e){
                            echo ViewUtil::renderJSON(["napaka" => $e->getMessage()], 400);
                        } catch(Exception $ex) {
                            echo ViewUtil::renderJSON(["napaka" => $ex->getMessage()], 400);
                        }
                    } else {
                        echo ViewUtil::renderJSON(["napaka" => "tukaj sem"], 400);
                    }
                } else {
                    echo ViewUtil::render("app/views/slika.php");
                }
            },
            "/^test_log$/" => function() {
                LogService::info("", "test", "To je sporocilo za logirat vse");
                LogService::error("prodajalec", "test", "To je sporocilo za logirat prodajalce");
                LogService::warning("admin", "test", "To je sporocilo za logirat admine");
            },
            "/^test_register$/" => function() {
                UporabnikService::dodajUporabnika(null);
            },
            //testni routi
            "/^test_mail$/" => function() {
                $email = new Email(
                    "miha_jamsek@windowslive.com",
                    "Zadeva",
                    "app/views/confirmation-email.php",
                    ["kljuc" => "kljuc123", "ime" => "Janez", "email" => "janez@gmail.com", "geslo" => "abc123"]
                );
                try {
                    EmailService::posljiEmail($email);
                } catch (Exception $e){
                    echo $e;
                }
            }
        ];
    }

    public static function handleRouters($routers, $path){
        foreach($routers as $pattern => $controller){
            if(preg_match($pattern, $path, $params)){
                try {
                    $params[0] = $_SERVER["REQUEST_METHOD"];
                    $controller(...$params);
                } catch(InvalidArgumentException $iae){
                    ViewUtil::handleError404();
                } catch(Exception $e) {
                    ViewUtil::displayError($e);
                }

                exit();
            }
        }
    }

}