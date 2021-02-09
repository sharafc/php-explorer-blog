<?php
// Decide with page to link to in meta header, sadly str_contains only works in PHP8
if (strpos($_SERVER['SCRIPT_NAME'], 'dashboard.php') !== false) {
    $linkTarget = [
        'url' => 'index.php',
        'image' => 'home.svg',
        'title' => 'Home'

    ];
} else {
    $linkTarget = [
        'url' => 'dashboard.php',
        'image' => 'dashboard.svg',
        'title' => 'Dashboard'
    ];
}

// Handle login and check if account is correct
if (isset($_POST['loginSent'])) {

    foreach ($_POST['login'] as $key => $value) {
        $login[$key] = cleanString($value);
    }

    $error = [
        'useremail' => checkEmail($login['useremail']),
        'password' => checkInputString($login['password'], 4)
    ];

    // Remove whitespaces and empty values from error array
    $errorMap = array_map('trim', $error);
    $errorMap = array_filter($errorMap);

    if (count($errorMap) === 0) {

        $currentUser = new User();
        $currentUser->setUsr_email($login['useremail']);
        $currentUser = $currentUser->fetchFromDB($pdo);

        if ($currentUser->getUsr_password()) {
            if (password_verify($login['password'], $currentUser->getUsr_password())) {

                // Add values to session and redirect to dashboard
                $_SESSION['id'] = $currentUser->getUsr_id();
                $_SESSION['firstname'] = $currentUser->getUsr_firstname();
                $_SESSION['lastname'] = $currentUser->getUsr_lastname();
                header('Location: dashboard.php');
                exit;
            } else { // Passwords do not match
                $errorLogin = 'Login credentials incorrect.';
            }
        }
    } else { // Error occured in loginform
        $errorLogin = 'Login credentials incorrect.';
    }
}
?>
<header>
    <!-- "Profile" links or login form -->
    <?php if (isset($_SESSION['id'])) : ?>
        <div class="header-meta">
            <?php if (isset($_SESSION['firstname']) && isset($_SESSION['lastname'])) : ?>
                <span>
                    <img src="./css/avatar.svg"><?= cleanString($_SESSION['firstname']) ?> <?= cleanString($_SESSION['lastname']) ?>
                </span>
            <?php endif ?>
            <span>
                <a href="<?= $linkTarget['url'] ?>"><img src="./css/<?= $linkTarget['image'] ?>"><?= $linkTarget['title'] ?></a>
            </span>
            <span>
                <a href="index.php?action=logout"><img src="./css/logout.svg" title="Logout" alt="Logout">Logout</a>
            </span>
        </div>
    <?php else : ?>
        <form action="<?= $_SERVER['SCRIPT_NAME'] ?>" method="POST" class="login">
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
        <img src="./css/christian_sharaf.png" title="Christian Sharaf" alt="Logo for Christian Sharafs Blog">
        <h1>My absolutely awesome and updated Blog</h1>
    </div>
</header>