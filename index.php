<?php
require_once("./config/config.inc.php");
require_once("./config/logger_config.inc.php");
require_once("./config/db_config.inc.php");
require_once("./config/form_config.inc.php");

require_once("./utils/logger.inc.php");
require_once("./utils/sessions.inc.php");
require_once("./utils/db.inc.php");

require_once("./utils/form.inc.php");
require_once("./utils/date_time.inc.php");
require_once("./utils/upload_image.inc.php");

require_once("./controllers/auth.php");
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
    <?php require_once("./views/partials/header.php") ?>

    <?php require_once("./utils/router.inc.php") ?>

    <?php require_once("./views/partials/footer.php") ?>
</body>

</html>