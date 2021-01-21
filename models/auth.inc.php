<?php

/**
 * Fetches a user from the database by a given email adress
 *
 * @param string $mail E-Mail adress to identify the user
 * @return array  $user The selected user or empty array
 */
function getUserByMail($mail){
    global $pdo;

    $statement = $pdo->prepare('SELECT * FROM users WHERE usr_email = :ph_usr_email');
    $statement->execute([
        'ph_usr_email' => $mail
    ]);

    // Get first data row, false if no entry was found
    $user = $statement->fetch(PDO::FETCH_ASSOC);
    if ($statement->errorInfo()[2]) {
        logger('Error while fetching category', $statement->errorInfo()[2]);
    }

    return $user;
}