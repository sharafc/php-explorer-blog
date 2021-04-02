<?php
use Utils\GenericHelper;
?>
<header>
    <!-- "Profile" links or login form -->
    <?php if (isset($_SESSION['id'])) : ?>
        <div class="header-meta">
            <?php if (isset($_SESSION['firstname']) && isset($_SESSION['lastname'])) : ?>
                <span>
                    <img src="<?= DOMAIN_SUB_STRUCTURE ?>/statics/images/avatar.svg"><?= GenericHelper::cleanString($_SESSION['firstname']) ?> <?= GenericHelper::cleanString($_SESSION['lastname']) ?>
                </span>
            <?php endif ?>
            <span>
                <a href="<?= $linkTarget['url'] ?>"><img src="<?= DOMAIN_SUB_STRUCTURE ?>/statics/images/<?= $linkTarget['image'] ?>"><?= $linkTarget['title'] ?></a>
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