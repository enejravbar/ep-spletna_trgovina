<?php
/**
 * Created by PhpStorm.
 * User: miha
 * Date: 13.1.2018
 * Time: 13:20
 */

class UserExistsException extends Exception {

    public function __construct(string $message, int $code = 0, Throwable $previous = null) {
        parent::__construct($message, $code, $previous);
    }

    public function __toString() {
        return __CLASS__ . ": [{$this->code}]: {$this->message}\n";
    }

}