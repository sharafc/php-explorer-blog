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

    public function __construct($firstname = NULL, $lastname = NULL, $email = NULL, $password = NULL, $city = NULL, $id = NULL)
    {
        $this->setUsr_firstname($firstname);
        $this->setUsr_lastname($lastname);
        $this->setUsr_email($email);
        $this->setUsr_password($password);
        $this->setUsr_city($city);
        $this->setUsr_id($id);
    }

    /**
     * Fetch a user from the database and populate the object with the fetched data
     *
     * @param PDO $pdo
     * @return User|NULL $user The user object populated with data from the database or NULL if no user was found
     */
    public function fetchFromDB(PDO $pdo)
    {
        $query = 'SELECT * FROM user WHERE usr_email = :ph_usr_email';
        $map = [
            'ph_usr_email' => $this->getUsr_email()
        ];
        $statement = $pdo->prepare($query);
        $statement->execute($map);

        $result = $statement->fetch(PDO::FETCH_ASSOC);
        if ($statement->errorInfo()[2]) {
            logger('Could not fetch User from database', $statement->errorInfo()[2]);
        }

        // Initialise emmpty User to fill or returnas empty object
        $user = new User();

        if ($result) {
            $user->setUsr_firstname($result['usr_firstname']);
            $user->setUsr_lastname($result['usr_lastname']);
            $user->setUsr_email($result['usr_email']);
            $user->setUsr_password($result['usr_password']);
            $user->setUsr_city($result['usr_city']);
            $user->setUsr_id($result['usr_id']);
        }

        return $user;
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
