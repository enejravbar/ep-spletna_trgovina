<?php
/**
 * Created by PhpStorm.
 * User: miha
 * Date: 29.12.2017
 * Time: 15:27
 */

require_once "ConfigurationUtil.php";
require_once "app/service/LogService.php";

class FileService {

    const KB = 1024;
    const MB = 1048576;
    const GB = 1073741824;
    const TB = 1099511627776;

    public static function naloziSliko($FILE){

        $LOKACIJA = ConfigurationUtil::getConfByKey("images_root_dir");

        // ime nove datoteke
        $target_file = $LOKACIJA . basename($FILE["name"]);

        // pridobi tip datoteke
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        // preveri ce je datoteka veljavna
        $check = getimagesize($FILE["tmp_name"]);
        if($check !== false){

            if(!file_exists($target_file)){

                if($FILE["size"] <= 10 * self::MB){

                    if(self::jeDovoljenTip($imageFileType)){

                        $status = move_uploaded_file($FILE["tmp_name"], $target_file);

                        if($status){
                            LogService::info("", "UPLOAD", "Slika " . $target_file . " je uploadana!");
                            return TRUE;
                        } else {
                            return FALSE;
                        }
                    } else {
                        throw new InvalidArgumentException("Slika ni v dovoljenem formatu!");
                    }
                } else {
                    throw new Exception("Slika je prevelika!");
                }
            } else {
                throw new InvalidArgumentException("Slika ze obstaja!");
            }
        } else {
            throw new InvalidArgumentException("Podani argument ni slika!");
        }
    }

    public static function izbrisiDatoteko($filename){
        if(file_exists($filename)){
            unlink($filename);
        } else {
            throw new InvalidArgumentException("Ne najdem slike za izbris!");
        }
    }

    public static function zamenjajDatoteko($FILE, $filename){
        self::izbrisiDatoteko($filename);
        self::naloziSliko($FILE);
    }

    private static function jeDovoljenTip($imageFileType){
        $tipi = self::vrniDovoljeneTipe();
        for ($i = 0; $i < count($tipi); $i++){
            if($imageFileType == $tipi[$i]){
                return TRUE;
            }
        }
        return FALSE;
    }

    private static function vrniDovoljeneTipe(){
        return array("jpg", "png", "gif", "jpeg");
    }

}