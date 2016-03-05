<?php
/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use common\widgets\Alert;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
    <head>
        <meta charset="<?= Yii::$app->charset ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <?= Html::csrfMetaTags() ?>
        <title><?= Html::encode($this->title) ?></title>

        <!-- theme resources -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link href='http://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
        <link href='http://fonts.googleapis.com/css?family=Lato:300,400,700,900' rel='stylesheet' type='text/css'>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">

        <link rel="stylesheet" type="text/css" href="<?= FRONTENDURL; ?>/css/bootstrap.min.css" media="screen">	
        <link rel="stylesheet" type="text/css" href="<?= FRONTENDURL; ?>/css/jquery.bxslider.css" media="screen">
        <link rel="stylesheet" type="text/css" href="<?= FRONTENDURL; ?>/css/font-awesome.css" media="screen">
        <link rel="stylesheet" type="text/css" href="<?= FRONTENDURL; ?>/css/magnific-popup.css" media="screen">
        <link rel="stylesheet" type="text/css" href="<?= FRONTENDURL; ?>/css/animate.css" media="screen">
        <!-- REVOLUTION BANNER CSS SETTINGS -->
        <link rel="stylesheet" type="text/css" href="<?= FRONTENDURL; ?>/css/settings.css" media="screen"/>
        <link rel="stylesheet" type="text/css" href="<?= FRONTENDURL; ?>/css/style.css" media="screen">
        <?php $this->head() ?>
    </head>
    <body>
        <?php $this->beginBody() ?>

        <!-- Container -->
        <div id="container">

            <!-- Header
                ================================================== -->
            <header class="clearfix">
                <div class="logo">
                    <a href="<?= FRONTENDURL; ?>"><img src="<?= FRONTENDURL; ?>/images/logo.png" alt=""></a>
                </div>

                <a class="elemadded responsive-link" href="#">Menu</a>

                <nav class="nav-menu">
                    <ul class="menu-list">
                        <li><a class="active" href="index">Home</a></li>
                        <?php if (Yii::$app->user->isGuest) { ?>

                            <li><a class="mobile-auth" href="<?= FRONTENDURL; ?>/signin">Sign In</a></li>
                            <li><a class="mobile-auth" href="<?= FRONTENDURL; ?>/register">Register</a></li>

                        <?php } else { ?>

                            <li><a class="mobile-auth" href="<?= FRONTENDURL; ?>/logout" data-method="post"><?= 'Logout (' . Yii::$app->user->identity->username . ')'; ?></a></li>             

                        <?php }
                        ?>

                        <li><a href="<?= DOMAINURL?>/site/about">About</a></li>
                        <li><a href="<?= DOMAINURL?>/site/contact">Contact</a></li>
                    </ul>
                </nav>

            </header>
            <!-- End Header -->


            <!-- content 
                    ================================================== -->
            <div id="content">
                <div class="inner-content">
                    <div class="top-line">
                        <div class="container">
                            <div class="row">
                                <div class="col-sm-8">
                                    <ul class="info-list">
                                        <li>
                                            <p><i class="fa fa-phone"></i>Call us <span>1234 - 5678 - 9012</span></p>
                                        </li>
                                        <li>
                                            <p><i class="fa fa-clock-o"></i>Working time <span>08:00 - 20:00</span></p>
                                        </li>
                                        <li>
                                            <p><i class="fa fa-envelope"></i>Writte us <span>nunforest@gmail.com</span></p>
                                        </li>
                                    </ul>
                                </div>	
                                <div class="col-sm-4">
                                    <ul class="social-icons">
                                        <?php if (Yii::$app->user->isGuest) { ?>

                                            <li><a class="signin" href="<?= FRONTENDURL; ?>/signin">Sign In</a></li>
                                            <li><a class="register" href="<?= FRONTENDURL; ?>/register">Register</a></li>

                                        <?php } else { ?>               

                                            <li><a class="signin" href="<?= FRONTENDURL; ?>/logout" data-method="post"><?= 'Logout (' . Yii::$app->user->identity->username . ')'; ?></a></li>
                                        <?php }
                                        ?>


                                    </ul>
                                </div>	
                            </div>
                        </div>
                    </div>   
                    <?= $content ?>

                    <!-- footer 
                                ================================================== -->
                    <footer>
                        <div class="up-footer">
                            <div class="container">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="footer-widget">
                                            <h2>About Us</h2>
                                            <p>Lorem ipsum dolor sit amet, consectetur adipi sicing elit, sed do eiusmod
                                                tempor incididunt ut labore et dolore magna.</p>
                                            <img src="<?= FRONTENDURL; ?>/images/footer-logo.png" alt="">
                                        </div>
                                    </div>
                                   <!-- <div class="col-md-4">
                                        <div class="footer-widget">
                                            <h2>Flickr widget</h2>
                                            <ul class="flickr">
                                                <li><a href="#"><img src="<?= FRONTENDURL; ?>/upload/flickr/1.jpg" alt=""></a></li>
                                                <li><a href="#"><img src="<?= FRONTENDURL; ?>/upload/flickr/4.jpg" alt=""></a></li>
                                                <li><a href="#"><img src="<?= FRONTENDURL; ?>/upload/flickr/5.jpg" alt=""></a></li>
                                                <li><a href="#"><img src="<?= FRONTENDURL; ?>/upload/flickr/6.jpg" alt=""></a></li>
                                                <li><a href="#"><img src="<?= FRONTENDURL; ?>/upload/flickr/7.jpg" alt=""></a></li>
                                                <li><a href="#"><img src="<?= FRONTENDURL; ?>/upload/flickr/8.jpg" alt=""></a></li>
                                            </ul>
                                        </div>
                                    </div> -->
                                    <div class="col-md-4 pull-right">
                                        <div class="footer-widget info-widget">
                                            <h2>Info</h2>
                                            <p class="first-par">You can contact or visit us during working time.</p>
                                            <p><span>Tel: </span> 1234 - 5678 - 9012</p>
                                            <p><span>Email: </span> support@flatbuild.com</p>
                                            <p><span>W.Hours: </span> 8:00 a.m - 17:00 a.m</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <p class="copyright">
                            &copy; Copyright 2016. "TransGO" by Nunforest. All rights reserved.
                        </p>
                    </footer>
                    <!-- End footer -->
                </div> <!-- End Inner content -->
            </div>
        </div>
    </div>


    <?php $this->endBody() ?>
    <!-- End Container -->

    
    <script type="text/javascript" src="<?= FRONTENDURL; ?>/js/jquery.migrate.js"></script>
    <script type="text/javascript" src="<?= FRONTENDURL; ?>/js/jquery.bxslider.min.js"></script>
    <script type="text/javascript" src="<?= FRONTENDURL; ?>/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="<?= FRONTENDURL; ?>/js/jquery.imagesloaded.min.js"></script>
    <script type="text/javascript" src="<?= FRONTENDURL; ?>/js/jquery.magnific-popup.min.js"></script>
    <script type="text/javascript" src="<?= FRONTENDURL; ?>/js/jquery.isotope.min.js"></script>
    <script type="text/javascript" src="<?= FRONTENDURL; ?>/js/retina-1.1.0.min.js"></script>
    <script type="text/javascript" src="<?= FRONTENDURL; ?>/js/plugins-scroll.js"></script>
    <!-- SLIDER REVOLUTION 4.x SCRIPTS  -->
    <script type="text/javascript" src="<?= FRONTENDURL; ?>/js/jquery.themepunch.tools.min.js"></script>
    <script type="text/javascript" src="<?= FRONTENDURL; ?>/js/jquery.themepunch.revolution.min.js"></script>
    <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&amp;sensor=false"></script>
    <script type="text/javascript" src="<?= FRONTENDURL; ?>/js/gmap3.min.js"></script>
    <script type="text/javascript" src="<?= FRONTENDURL; ?>/js/script.js"></script>

    <!-- Revolution slider -->
    <script type="text/javascript">

        jQuery(document).ready(function () {

            jQuery('.tp-banner').show().revolution(
                    {
                        dottedOverlay: "none",
                        delay: 10000,
                        startwidth: 1140,
                        startheight: 560,
                        hideThumbs: 200,
                        thumbWidth: 100,
                        thumbHeight: 50,
                        thumbAmount: 5,
                        navigationType: "bullet",
                        touchenabled: "on",
                        onHoverStop: "off",
                        swipe_velocity: 0.7,
                        swipe_min_touches: 1,
                        swipe_max_touches: 1,
                        drag_block_vertical: false,
                        parallax: "mouse",
                        parallaxBgFreeze: "on",
                        parallaxLevels: [7, 4, 3, 2, 5, 4, 3, 2, 1, 0],
                        keyboardNavigation: "off",
                        navigationHAlign: "center",
                        navigationVAlign: "bottom",
                        navigationHOffset: 0,
                        navigationVOffset: 40,
                        shadow: 0,
                        spinner: "spinner4",
                        stopLoop: "off",
                        stopAfterLoops: -1,
                        stopAtSlide: -1,
                        shuffle: "off",
                        autoHeight: "off",
        forceFullWidth: "off",
                        hideThumbsOnMobile: "off",
                        hideNavDelayOnMobile: 1500,
                        hideBulletsOnMobile: "off",
                        hideArrowsOnMobile: "off",
                        hideThumbsUnderResolution: 0,
                        hideSliderAtLimit: 0,
                        hideCaptionAtLimit: 0,
                        hideAllCaptionAtLilmit: 0,
                        startWithSlide: 0,
                        fullScreenOffsetContainer: ".header"
                    });

        });	//ready

    </script>
</body>
</html>
<?php $this->endPage() ?>
