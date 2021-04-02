<?php
require_once('../config/config.inc.php');
require_once('../config/autoLoader_config.inc.php');
require_once('../config/logger_config.inc.php');
require_once('../config/db_config.inc.php');
require_once('../config/form_config.inc.php');

require_once('Utils/logger.inc.php');
require_once('Utils/sessions.inc.php');
require_once('Utils/db.inc.php');

require_once('Utils/form.inc.php');
require_once('Utils/date_time.inc.php');
require_once('Utils/upload_image.inc.php');

require_once('Controller/auth.php');

use Utils\Router;

// Autoloader
require_once('Utils/AutoLoader.php');
spl_autoload_register('Utils\AutoLoader::load');
?>

<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <title>Blog | Index</title>
    <link rel="stylesheet" href="<?= DOMAIN_SUB_STRUCTURE ?>/statics/css/main.css">
    <link rel="stylesheet" href="<?= DOMAIN_SUB_STRUCTURE ?>/statics/css/logger.css">
</head>

<body>
    <?php require_once('../templates/partials/header.php') ?>

    <?php $router = new Router(); ?>

    <?php require_once('Utils/router.inc.php') ?>

    <?php require_once('../templates/partials/footer.php') ?>
</body>

</html>