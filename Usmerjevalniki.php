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
require_once "app/REST/NarociloVir.php";
require_once "app/REST/NarociloIzdelekVir.php";
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
            "/^narocila$/" => function($method) {
                if($method == "GET") {
                    NarocilaController::prikaziNarocila();
                }
            },
            "/^narocila\/(\d+)$/" => function($method, $id) {
                if($method == "GET") {
                    NarocilaController::prikaziEnoNarocilo($id);
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
            "/^api\/poste$/" => function($method) {
                if($method == "GET") {
                    UporabnikVir::posredujPoste();
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
            "/^api\/potrdi\/(.+)$/" => function($method, $kljuc) {
                if ($method == "GET") {
                    UporabnikService::potrdiUporabnika($kljuc);
                    ViewUtil::redirect(BASE_URL);
                }
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
            "/^api\/izdelki\/(\d+)\/slike\/(\d+)$/" => function($method, $id_slike) {
                switch ($method) {
                    case "DELETE":
                        //izbrisi sliko
                        IzdelekVir::izbrisiSlikoIzdelka($id_slike);
                        break;
                }
            },
            "/^api\/izdelki\/(\d+)\/slike$/" => function($method, $id) {
                if($method == "POST") {
                    IzdelekVir::dodajSlikoIzdelka($id);
                }
            },
            "/^api\/izdelki\/index$/" => function($method) {
                if($method == "GET") {
                    IzdelekVir::getForIndex();
                }
            },
            "/^api\/izdelki\/(\d+)\/aktiviraj$/" => function($method, $id) {
                if($method == "PUT") {
                    IzdelekVir::aktivirajIzdelek($id);
                }
            },
            "/^api\/izdelki\/(\d+)\/deaktiviraj$/" => function($method, $id) {
                if($method == "PUT") {
                    IzdelekVir::deaktivirajIzdelek($id);
                }
            },
            "/^api\/izdelki\/vsi$/" => function($method) {
                if($method == "GET") {
                    IzdelekVir::getAllAll();
                }
            },
            // status
            "/^api\/status$/" => function($method) {
                if($method == "GET") {
                    IzdelekVir::getStatuseIzdelkov();
                }
            },
            // kategorije
            "/^api\/kategorije$/" => function($method) {
                if ($method == "GET") {
                    KategorijaVir::pridobiVse();
                }
            },
            "/^api\/kategorije\/(\d+)\/izdelki$/" => function($method, $id) {
                if ($method == "GET") {
                    KategorijaVir::pridobiVseIzdelkeIzKategorije($id);
                }
            },
            // slike
            "/^api\/slike\/izdelek\/(\d+)$/" => function($method, $id) {
                if($method == "POST"){
                    SlikaVir::shraniSliko($id);
                }
            },
            "/^api\/slike\/(\d+)$/" => function($method, $id) {
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
            // narocila
            "/^api\/narocila$/" => function($method) {
                if ($method == "GET") {
                    Narocila::getAll();
                }
            },
            "/^api\/narocila\/stranka$/" => function($method) {
                if($method == "GET") {
                    NarociloVir::dobiNarocilaKupca();
                }
            },
            "/^api\/narocila\/(\d+)\/podrobnosti$/" => function($method, $id_narocila) {
                if ($method == "GET") {
                    NarociloIzdelekVir::dobiIzdelkeNarocila($id_narocila);
                }
            },
            "/^api\/narocila\/neobdelana$/" => function($method) {
                if ($method == "GET") {
                    NarociloVir::dobiNeobdelanaNarocila();
                }
            },
            "/^api\/narocila\/potrjena$/" => function($method) {
                if ($method == "GET") {
                    NarociloVir::dobiPotrjenaNarocila();
                }
            },
            "/^api\/narocila\/(\d+)\/potrdi$/" => function($method, $id_narocila) {
                if ($method == "PUT") {
                    NarociloVir::potrdiNarocilo($id_narocila);
                }
            },
            "/^api\/narocila\/(\d+)\/preklici$/" => function($method, $id_narocila) {
                if ($method == "PUT") {
                    NarociloVir::prekliciNarocilo($id_narocila);
                }
            },
            "/^api\/narocila\/(\d+)\/storniraj$/" => function($method, $id_narocila) {
                if ($method == "PUT") {
                    NarociloVir::stornirajNarocilo($id_narocila);
                }
            },
            "/^api\/narocila\/oddaj$/" => function($method) {
                if ($method == "POST") {
                    NarociloVir::oddajNarocilo();
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
