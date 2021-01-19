<?php
require_once("./config/config.inc.php");
require_once("./config/db.inc.php");

require_once("./utils/logger.inc.php");
require_once("./utils/sessions.inc.php");

require_once("./utils/form.inc.php");
require_once("./utils/date_time.inc.php");
require_once("./utils/upload_image.inc.php");

/*
$message = "Something went wrong while parsing, see: ";
$data = [1,2,3,4,5];

logger($message, $data);
logger($message, $data, LOGGER_WARNING);
logger($message, $data, LOGGER_INFO);
*/
?>

<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <title>Blog | Index</title>
    <link rel="stylesheet" href="<?= DOMAIN_SUB_STRUCTURE ?>/statics/css/main.css">
    <link rel="stylesheet" href="<?= DOMAIN_SUB_STRUCTURE ?>/statics/css/debug.css">
</head>

<body>
    <?php require_once("./views/partials/header.php") ?>

    <?php require_once("./utils/router.inc.php") ?>

    <?php require_once("./views/partials/footer.php") ?>
</body>

</html>