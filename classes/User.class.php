<?php

/**
 * User object
 *
 * @class
 */
class User implements UserInterface
{

    private $usr_id;
    private $usr_firstname;
    private $usr_lastname;
    private $usr_email;
    private $usr_city;
    private $usr_password;

    public function __construct($firstname, $lastname, $email, $password, $city, $id)
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
     * @return User $user The user object populated with data from the database
     */
    public function fetchFromDB(PDO $pdo)
    {
        $query = 'SELECT * FROM user WHERE usr_email = :ph_usr_email';
        $map = [
            'ph_usr_email' => $this->getUsr_email()
        ];
        $statement = $pdo->prepare($query);
        $statement->execute($map);

        $user = $statement->fetch(PDO::FETCH_ASSOC);
        if ($statement->errorInfo()[2]) {
            logger('Could not fetch User from database', $statement->errorInfo()[2]);
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
     *
     * @return  self
     */
    public function setUsr_id($usr_id)
    {
        $this->usr_id = $usr_id;

        return $this;
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
     *
     * @return  self
     */
    public function setUsr_firstname($usr_firstname)
    {
        $this->usr_firstname = $usr_firstname;

        return $this;
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
     *
     * @return  self
     */
    public function setUsr_lastname($usr_lastname)
    {
        $this->usr_lastname = $usr_lastname;

        return $this;
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
     *
     * @return  self
     */
    public function setUsr_email($usr_email)
    {
        $this->usr_email = $usr_email;

        return $this;
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
     *
     * @return  self
     */
    public function setUsr_city($usr_city)
    {
        $this->usr_city = $usr_city;

        return $this;
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
     *
     * @return  self
     */
    public function setUsr_password($usr_password)
    {
        $this->usr_password = $usr_password;

        return $this;
    }
}
