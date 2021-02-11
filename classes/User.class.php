<?php

/**
 * Represents a User with all its entities
 * A User is needed to log in and create blogposts
 *
 * @implements UserInterface
 *
 * @author Christian Sharaf
 * @copyright 2021 Christian Sharaf
 * @version 1.0.0
 */
class User implements UserInterface
{
    private $usr_id;
    private $usr_firstname;
    private $usr_lastname;
    private $usr_email;
    private $usr_city;
    private $usr_password;

    /**
     * @construct
     *
     * @param string $firstname Firstname of a User
     * @param string $lastname Lastname of a User
     * @param string $email E-Mail adress of a User
     * @param string $password Hashed password of a User
     * @param string $city City of a User
     * @param integer $id User Id from the database
     */
    public function __construct($firstname = NULL, $lastname = NULL, $email = NULL, $password = NULL, $city = NULL, $id = NULL)
    {
        $this->setUsr_firstname($firstname);
        $this->setUsr_lastname($lastname);
        $this->setUsr_email($email);
        $this->setUsr_password($password);
        $this->setUsr_city($city);
        $this->setUsr_id($id);

        if (DEBUG_CC) {
            echo "<h3 class='debugClass hint'><b>Line " . __LINE__ .  "</b>: Call of " . __METHOD__ . "()  (<i>" . basename(__FILE__) . "</i>)</h3>\r\n";
        }
    }

    /**
     * Fetch a user from the database and populate the object with the fetched data
     *
     * @param PDO $pdo The PHP database object
     * @return void
     */
    public function fetchFromDB(PDO $pdo)
    {
        if (DEBUG_C) {
            echo "<h3 class='debugClass'><b>Line  " . __LINE__ .  "</b>: Call to " . __METHOD__ . "() (<i>" . basename(__FILE__) . "</i>)</h3>\r\n";
        }

        $query = 'SELECT * FROM user
                  WHERE usr_email = :ph_usr_email';
        $map = [
            'ph_usr_email' => $this->getUsr_email()
        ];
        $statement = $pdo->prepare($query);
        $statement->execute($map);

        $result = $statement->fetch(PDO::FETCH_ASSOC);
        if ($statement->errorInfo()[2]) {
            logger('Could not fetch User from database', $statement->errorInfo()[2]);
            if (DEBUG_DB) {
                echo "<p class='debug err'><b>Line " . __LINE__ . "</b>: " . $statement->errorInfo()[2] . " <i>(" . basename(__FILE__) . ")</i></p>\r\n";
            }
        }

        if ($result) {
            $this->setUsr_firstname($result['usr_firstname']);
            $this->setUsr_lastname($result['usr_lastname']);
            $this->setUsr_email($result['usr_email']);
            $this->setUsr_password($result['usr_password']);
            $this->setUsr_city($result['usr_city']);
            $this->setUsr_id($result['usr_id']);
        }
    }

    /**
     * Get the value of usr_id
     */
    public function getUsr_id()
    {
        return $this->usr_id;
    }

    /**
     * Set the value of usr_id
     */
    public function setUsr_id($usr_id)
    {
        $this->usr_id = $usr_id;
    }

    /**
     * Get the value of usr_firstname
     */
    public function getUsr_firstname()
    {
        return $this->usr_firstname;
    }

    /**
     * Set the value of usr_firstname
     */
    public function setUsr_firstname($usr_firstname)
    {
        $this->usr_firstname = $usr_firstname;
    }

    /**
     * Get the value of usr_lastname
     */
    public function getUsr_lastname()
    {
        return $this->usr_lastname;
    }

    /**
     * Set the value of usr_lastname
     */
    public function setUsr_lastname($usr_lastname)
    {
        $this->usr_lastname = $usr_lastname;
    }

    /**
     * Get the value of usr_email
     */
    public function getUsr_email()
    {
        return $this->usr_email;
    }

    /**
     * Set the value of usr_email
     */
    public function setUsr_email($usr_email)
    {
        $this->usr_email = $usr_email;
    }

    /**
     * Get the value of usr_city
     */
    public function getUsr_city()
    {
        return $this->usr_city;
    }

    /**
     * Set the value of usr_city
     */
    public function setUsr_city($usr_city)
    {
        $this->usr_city = $usr_city;
    }

    /**
     * Get the value of usr_password
     */
    public function getUsr_password()
    {
        return $this->usr_password;
    }

    /**
     * Set the value of usr_password
     */
    public function setUsr_password($usr_password)
    {
        $this->usr_password = $usr_password;
    }
}
