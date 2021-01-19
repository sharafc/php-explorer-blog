<?php
// Decide with page to link to in meta header, sadly str_contains only works in PHP8
if (strpos($_SERVER["REQUEST_URI"], "dashboard") !== false) {
    $linkTarget = [
        "url" => "/home",
        "image" => "home.svg",
        "title" => "Home"
    ];
} else {
    $linkTarget = [
        "url" => "/dashboard",
        "image" => "dashboard.svg",
        "title" => "Dashboard"
    ];
}

// Handle login and check if account is correct
if (isset($_POST["loginSent"])) {

    foreach ($_POST["login"] as $key => $value) {
        $login[$key] = cleanString($value);
    }

    $error = [
        "useremail" => checkEmail($login["useremail"]),
        "password" => checkInputString($login["password"], 4)
    ];

    // Remove whitespaces and empty values from error array
    $errorMap = array_map('trim', $error);
    $errorMap = array_filter($errorMap);

    if (count($errorMap) === 0) {
        // Make sure we have a db connection
        if (!isset($pdo)) {
            $pdo = dbConnect();
        }

        $statement = $pdo->prepare("SELECT * FROM users WHERE usr_email = :ph_usr_email");
        $statement->execute([
            "ph_usr_email" => $login["useremail"]
        ]);

        // Get first data row, false if no entry was found
        $user = $statement->fetch(PDO::FETCH_ASSOC);
        if ($statement->errorInfo()[2]) {
            logger("Error while fetching category", $statement->errorInfo()[2]);
        }

        if ($user) {
            if (password_verify($login["password"], $user["usr_password"])) {
                // Add values to session and redirect to dashboard
                $_SESSION["id"] = $user["usr_id"];
                $_SESSION["firstname"] = $user["usr_firstname"];
                $_SESSION["lastname"] = $user["usr_lastname"];
                header("Location: /dashboard");
                //session_regenerate_id();
                exit;
            } else { // Passwords do not match
                $errorLogin = "Login credentials incorrect.";
            }
        }
    } else { // Error occured in loginform
        $errorLogin = "Login credentials incorrect.";
    }
}
?>
<header>
    <!-- "Profile" links or login form -->
    <?php if (isset($_SESSION["id"])) : ?>
        <div class="header-meta">
            <?php if (isset($_SESSION["firstname"]) && isset($_SESSION["lastname"])) : ?>
                <span>
                    <img src="<?= DOMAIN_SUB_STRUCTURE ?>/statics/images/avatar.svg"><?= cleanString($_SESSION["firstname"]) ?> <?= cleanString($_SESSION["lastname"]) ?>
                </span>
            <?php endif ?>
            <span>
                <a href="<?= $linkTarget["url"] ?>"><img src="<?= DOMAIN_SUB_STRUCTURE ?>/statics/images/<?= $linkTarget["image"] ?>"><?= $linkTarget["title"] ?></a>
            </span>
            <span>
                <a href="/home/logout"><img src="<?= DOMAIN_SUB_STRUCTURE ?>/statics/images/logout.svg" title="Logout" alt="Logout">Logout</a>
            </span>
        </div>
    <?php else : ?>
        <form action="" method="POST" class="login">
            <input type="hidden" name="loginSent">
            <fieldset>
                <legend>Login</legend>
                <?php if (isset($errorLogin)) : ?>
                    <div class="error"><?= $errorLogin ?></div>
                <?php endif ?>
                <label for="useremail">Username:</label>
                <input type="text" name="login[useremail]" id="useremail">
                <label for="password">Password:</label>
                <input type="password" name="login[password]" id="password">
                <button type="submit">Login</button>
            </fieldset>
        </form>
    <?php endif ?>

    <div class="header-logo col-100">
        <img src="<?= DOMAIN_SUB_STRUCTURE ?>/statics/images/christian_sharaf.png" title="Christian Sharaf" alt="Logo for Christian Sharafs Blog">
        <h1>My absolutely awesome Blog</h1>
    </div>
</header>