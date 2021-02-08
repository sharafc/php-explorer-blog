<?php

/**
 * User interface
 *
 * @interface
 */
interface UserInterface
{
    public function __construct($firstname, $lastname, $email, $password, $city, $id);

    public function fetchFromDB(PDO $pdo);

    public function getUsr_id();
    public function setUsr_id($usr_id);
    public function getUsr_firstname();
    public function setUsr_firstname($usr_firstname);
    public function getUsr_lastname();
    public function setUsr_lastname($usr_lastname);
    public function getUsr_email();
    public function setUsr_email($usr_email);
    public function getUsr_city();
    public function setUsr_city($usr_city);
    public function getUsr_password();
    public function setUsr_password($usr_password);
}
