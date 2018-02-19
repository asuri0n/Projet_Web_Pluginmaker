<!DOCTYPE html>
<html>
<head>
        <title><?= WEB_TITLE ?> - <?= $title ?></title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" type="text/css" href="<?php echo WEBROOT ?>css/bootstrap.css"/>
        <link rel="stylesheet" type="text/css" href="<?php echo WEBROOT ?>css/prettyPhoto.css"/>
        <link rel="stylesheet" type="text/css" href="<?php echo WEBROOT ?>css/rticons.css"/>
        <link rel="stylesheet" type="text/css" href="<?php echo WEBROOT ?>css/settings.css"/>
        <link rel="stylesheet" type="text/css" href="<?php echo WEBROOT ?>css/font-awesome.min.css"/>
        <link rel="stylesheet" type="text/css" href="<?php echo WEBROOT ?>css/js-image-slider.css"/>
        <link rel="stylesheet" type="text/css" href="<?php echo WEBROOT ?>css/preset.css"/>
        <link rel="stylesheet" type="text/css" href="<?php echo WEBROOT ?>css/style.css"/>
        <link rel="stylesheet" type="text/css" href="<?php echo WEBROOT ?>css/responsive.css"/>
        <link rel="stylesheet" type="text/css" href="<?php echo WEBROOT ?>css/animate.css"/>
        <link rel="stylesheet" type="text/css" href="<?php echo WEBROOT ?>css/jquery.toast.min.css"/>
        <link rel="stylesheet" type="text/css" href="<?php echo WEBROOT ?>css/perso.css"/>

        <script type="text/javascript" src="<?php echo WEBROOT ?>js/jquery.js"></script>
        <script type="text/javascript" src="<?php echo WEBROOT ?>js/jquery.toast.min.js"></script>
    <script type="text/javascript" src="<?php echo WEBROOT ?>js/functions.js"></script>
        <link rel="stylesheet" type="text/css" href="<?php echo WEBROOT ?>css/stepper.css"/>

        <link rel="icon" href="images/favicon.ico">
        <!--[if lt IE 9]>
            <script src="<?php echo WEBROOT ?><?php echo WEBROOT ?>js/html5shiv.js"></script>
        <![endif]-->
    </head>
    <body>
        <div class="boxWrapper">
            <?php include 'includes/header.php'; ?>

			<?php echo $content; ?>

            <?php include 'includes/footer.php'; ?>
        </div>
        <script type="text/javascript" src="<?php echo WEBROOT ?>js/bootstrap.js"></script>
        <script type="text/javascript" src="<?php echo WEBROOT ?>js/jquery.prettyPhoto.js"></script>
        <script type="text/javascript" src="<?php echo WEBROOT ?>js/mixer.js"></script>
        <script type="text/javascript" src="<?php echo WEBROOT ?>js/appear.js"></script>
        <script type="text/javascript" src="<?php echo WEBROOT ?>js/circle-progress.js"></script>
        <script type="text/javascript" src="<?php echo WEBROOT ?>js/modernizr.custom.js"></script>
        <script type="text/javascript" src="<?php echo WEBROOT ?>js/directionHover.js"></script>
        <script type="text/javascript" src="<?php echo WEBROOT ?>js/js-image-slider.js"></script>
        <script type="text/javascript" src="<?php echo WEBROOT ?>js/jquery.themepunch.tools.min.js"></script>
        <script type="text/javascript" src="<?php echo WEBROOT ?>js/jquery.themepunch.revolution.min.js"></script>
        <script type="text/javascript" src="<?php echo WEBROOT ?>js/wow.min.js"></script>
        <script type="text/javascript" src="<?php echo WEBROOT ?>js/theme.js"></script>
        <script type="text/javascript" src="<?php echo WEBROOT ?>js/stepper.js"></script>
        <?php include 'includes/notification.php'; ?>
    </body>
</html>