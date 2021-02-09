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