<?php
/**
 * Created by PhpStorm.
 * User: miha
 * Date: 15.1.2018
 * Time: 0:44
 */

class NiIstoGesloException extends Exception {

    public function __construct(string $message, int $code = 0, Throwable $previous = null) {
        parent::__construct($message, $code, $previous);
    }

    public function __toString() {
        return __CLASS__ . ": [{$this->code}]: {$this->message}\n";
    }

}