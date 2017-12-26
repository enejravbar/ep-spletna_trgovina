<?php
/**
 * Created by PhpStorm.
 * User: miha
 * Date: 26.12.2017
 * Time: 21:19
 */

class Email {

    private $prejemnik;
    private $posiljatelj = "ep.projekt2017@gmail.com";
    private $zadeva;
    private $vsebina;

    function __construct($prejemnik, $zadeva, $vsebina) {
        $this->prejemnik = $prejemnik;
        $this->zadeva = $zadeva;
        $this->vsebina = $vsebina;
    }

    /**
     * @return string
     */
    public function getPosiljatelj() {
        return $this->posiljatelj;
    }

    /**
     * @param string $posiljatelj
     */
    public function setPosiljatelj($posiljatelj) {
        $this->posiljatelj = $posiljatelj;
    }

    /**
     * @return mixed
     */
    public function getZadeva() {
        return $this->zadeva;
    }

    /**
     * @param mixed $zadeva
     */
    public function setZadeva($zadeva) {
        $this->zadeva = $zadeva;
    }

    /**
     * @return mixed
     */
    public function getVsebina() {
        return $this->vsebina;
    }

    /**
     * @param mixed $vsebina
     */
    public function setVsebina($vsebina) {
        $this->vsebina = $vsebina;
    }

    /**
     * @return mixed
     */
    public function getPrejemnik() {
        return $this->prejemnik;
    }

    /**
     * @param mixed $prejemnik
     */
    public function setPrejemnik($prejemnik) {
        $this->prejemnik = $prejemnik;
    }
    
}