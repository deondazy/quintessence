<?php
/**
 * Quintessence Fraternity Home Screen
 */
if (!session_id()) {
    session_start();
}

require __DIR__ . '/bootstrap.php';
?><!DOCTYPE html>
<html lang="en">
    <head>
        <!-- TITLE-->
        <title><?php echo $site->name; ?></title>
        <!-- FAV ICON -->
        <link rel="shortcut icon" href="" type="text/css" />
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="Enhance the leadership abilities of men by refining their character through the framework of Friendship, Justice and Learning.">
        <meta name="author" content="<?php echo $site->name; ?>">
        <!-- BOOTSTRAP CSS -->
        <link rel="stylesheet" href="css/bootstrap.min.css" type="text/css" />
        <!-- FONTAWESOME CSS -->
        <link rel="stylesheet" href="css/font-awesome.min.css" type="text/css" />
        <!-- OWL CAROUSEL CSS -->
        <link rel="stylesheet" href="css/owl.carousel.min.css" type="text/css" />
        <!-- ANIMATE CSS -->
        <link rel="stylesheet" href="css/animate.min.css" type="text/css" />
        <!-- LIGHTBOX CSS -->
        <link rel="stylesheet" href="css/lightbox.min.css" type="text/css" />
        <!-- YTPLAYER CSS -->
        <link rel="stylesheet" href="css/mb.YTPlayer.min.css" type="text/css" />
        <!-- FLATICON CSS -->
        <link rel="stylesheet" href="css/flaticon.css" type="text/css" />
        <!-- BOOTSTRAP VALIDATOR CSS -->
        <link rel="stylesheet" href="css/validator.min.css" type="text/css" />
        <!-- GOOGLE FONTS  -->
        <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,600,700,300,100,900|Poppins:400,500' rel='stylesheet' type='text/css' />
        <!-- THEME STYLE CSS -->
        <link rel="stylesheet" href="css/style.css" type="text/css" />
        <!-- Latest IE rendering engine & Chrome Frame Meta Tags -->
        <!--[if IE]>
        <meta http-equiv='X-UA-Compatible' content='IE=edge,chrome=1'>
        <![endif]-->
    </head>
    <body data-spy="scroll" data-offset="62">
    
        <!-- Page Loader -->
        <div class="page-loader"></div>
        
        <div class="main-wrap">
        
            <!-- Fixed Navbar -->
            <nav class="navbar navbar-sticky navbar-transparent">
                <!-- Navbar Transparent Class: navbar-transparent -->
                <div class="container">
                    <!-- Brand and toggle get grouped for better mobile display -->
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        </button>
                        <a class="navbar-brand primary-logo" href="<?php echo $site->url; ?>/"><h1 style="color:#fff">LOGO</h1></a>
                        <a class="navbar-brand sticky-logo" href="<?php echo $site->url; ?>/"><h1 style="color:#fff;">LOGO</h1></a>
                    </div>
                    <!-- Collect the nav links, forms, and other content for toggling -->
                    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                        <ul class="nav navbar-nav pull-right">
                            <li class="active"><a href="#home">Home</a></li>
                            <li><a href="#about">About</a></li>
                            <li><a href="#gallery">Gallery</a></li>
                            <li><a href="#contact">Contact</a></li>
                            <li><a href="<?php echo $site->url; ?>/dashboard/auth/login/">Sign in</a></li>
                            <li><a href="<?php echo $site->url; ?>/dashboard/auth/register/">Sign up</a></li>
                        </ul>
                    </div>
                    <!-- /.navbar-collapse -->
                </div>
                <!-- /.container-fluid -->
            </nav>
            <!-- Theme Header Start -->
            <header id="home" class="full-height bg-img" data-src="<?php echo $site->url; ?>/images/bg/main-demo.jpg">
                <div class="overlay"></div>
                <div class="container">
                    <div class="row">
                        <div class="col-sm-8 col-sm-offset-2 text-center">
                            <div class="header-content">
                                <div class="header-content-inner">
                                    <div class="section-title">
                                        <h1 class="section-title-divider animated zoomIn"><span class="primary-color">Quintessence</span> Fraternity</h1>
                                        <p>Enhance the leadership abilities of men by refining their character through the
                                            framework of Friendship, Justice and Learning.</p>
                                    </div>
                                    <a class="btn btn-default btn-xl" href="#about">Learn More</a> <!-- THEME DEFAULT BUTTON -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </header>
            <!-- Theme Header End -->
            <!-- About Section -->
            <section id="about" class="section-parallax section-typo-white" data-stellar-background-ratio="0.5">
                   <span class="overlay-section-bg primary-section-bg"></span>
                <div class="container">
                    <div class="row">
                        <div class="col-sm-10 col-sm-offset-1 text-center">
                            <div class="section-title dark-text">
                                <h2 class="section-title-divider">Quintessence Fraternity History</h2>
                                <!-- SECTION TITLE -->
                                <p>
                                    Quintessence Fraternity of Nigeria was founded in 1989 on the campus of
                                        University of Nigeria, Nsukka Branch, and in 1991 on the campus of University of
                                        Nigeria, Enugu Branch.
                                </p>
                                <p>
                                    The story of its founding by 3 determined men set the stage for the growth and
                                    success of one of the country’s premier fraternal organizations.
                                </p>
                                <p>Having a vision to establish an association which shall enhance an academic,
                                    social and cultural development, the founding members successfully birthed a
                                    fraternity of which some of its core aims are to have members live in harmony,
                                    unity and love of one indivisible association, free of political or sinister
                                    ideology.</p>
                            </div>
                            <a class="btn btn-default btn-xl btn-bg-white" href="<?php echo $site->url; ?>/about/">Learn More</a> <!-- THEME DEFAULT BUTTON WITH WHITE BACKGROUND -->
                        </div>
                    </div>
                </div>
            </section>
            <!-- Who we are -->
            <section>
                <div class="container">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="col-inner">
                                <div class="section-sub-title">
                                    <h3 class="under-line">Aims and Objectives</h3>
                                </div>
                                <p>
                                    Of the numerous aims and objectives Quintessence Fraternity employs to its daily
                                        running to further better the organization, here are a few of them but not
                                        limited to;
                                </p>
                            </div>
                            <div class="col-inner">
                                <ul class="star-list">
                                    <li>Integrating individuals who are projecting the same ideology and
                                        precepts as well as maintaining a high standard of academic excellence.</li>
                                    <li>Giving financial and academic help to members in need.</li>
                                    <li>Helping uplift and maintain the moral standard of our members as well as
                                        an esteemed social awareness.</li>
                                    <li>Promoting healthy business relationships among our members.</li>
                                    <li>Exploring and discovering talents and creativity among our members.</li>
                                    <li>Creating a congenial atmosphere whereby members will be guided and
                                        directed on how to disburse funds.</li>
                                </ul>
                            </div>
                            <a class="btn btn-default btn-xl btn-normal margin-top-20" href="<?php echo $site->url; ?>/about/#aims_and_objectives">Read More</a> <!-- THEME DEFAULT BUTTON WITH NORMAL STYLE -->
                        </div>
                        <div class="col-md-6 hidden-sm hidden-xs media">
                            <img alt="" src="images/about.jpg" class="img-responsive" />
                        </div>
                    </div>
                </div>
            </section>
            <!-- About Section End-->
            <!-- Support Section Start -->
            <section class="section-parallax" data-src="images/bg/3.jpg" data-stellar-background-ratio="0.5">
                <div class="overlay-2"></div>
                <span class="overlay-section-bg black-section-bg"></span>
                <div class="container section-typo-white">
                    <div class="row">
                        <div class="col-sm-10 col-sm-offset-1 text-center">
                            <h2 class="inline-content"><span>Sign in to join the coversation</span></h2>
                            <!-- SECTION TITLE -->
                            <a class="btn btn-default btn-xl btn-inline" href="<?php echo $site->url; ?>/dashboard/auth/register/">Sign in</a>
                        </div>
                    </div>
                </div>
            </section>
            <!-- Support Section End -->
            
            <!-- Gallery Start -->
            <section id="portfolio">
                <div class="container text-center">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="section-title">
                                <h2 class="section-title-divider primary-divider">Gallery</h2>
                                <!-- SECTION TITLE -->
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="grid" data-gutter="20" data-col="3">
                                <div class="portfolio-item element-item digital web-design">
                                    <img alt="" src="images/instagram/1.jpg" class="img-responsive" />
                                    <div class="portfolio-content">
                                        <div class="portfolio-content-inner">
                                            <div class="portfolio-inner">
                                                <p class="portfolio-popup"><a class="link-white" href="images/instagram/1.jpg" data-lightbox="portfolio" data-title="Landing Page"><span class="fa fa-arrows-alt"></span></a></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="portfolio-item element-item creative web-design">
                                    <img alt="" src="images/instagram/2.jpg" class="img-responsive" />
                                    <div class="portfolio-content">
                                        <div class="portfolio-content-inner">
                                            <div class="portfolio-inner">
                                                <p class="portfolio-popup"><a class="link-white" href="images/instagram/2.jpg" data-lightbox="portfolio" data-title="Awesome Design"><span class="fa fa-arrows-alt"></span></a></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="portfolio-item element-item digital creative mobile-app">
                                    <img alt="" src="images/instagram/10.jpg" class="img-responsive" />
                                    <div class="portfolio-content">
                                        <div class="portfolio-content-inner">
                                            <div class="portfolio-inner">
                                                <p class="portfolio-popup"><a class="link-white" href="images/instagram/10.jpg" data-lightbox="portfolio" data-title="Code Clear"><span class="fa fa-arrows-alt"></span></a></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="portfolio-item element-item digital mobile-app">
                                    <img alt="" src="images/instagram/4.jpg" class="img-responsive" />
                                    <div class="portfolio-content">
                                        <div class="portfolio-content-inner">
                                            <div class="portfolio-inner">
                                                <p class="portfolio-popup"><a class="link-white" href="images/instagram/4.jpg" data-lightbox="portfolio" data-title="User Dashboard"><span class="fa fa-arrows-alt"></span></a></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="portfolio-item element-item creative web-design">
                                    <img alt="" src="images/instagram/5.jpg" class="img-responsive" />
                                    <div class="portfolio-content">
                                        <div class="portfolio-content-inner">
                                            <div class="portfolio-inner">
                                                <p class="portfolio-popup"><a class="link-white" href="images/instagram/5.jpg" data-lightbox="portfolio" data-title="Vector Mask"><span class="fa fa-arrows-alt"></span></a></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="portfolio-item element-item digital creative">
                                    <img alt="" src="images/instagram/6.jpg" class="img-responsive" />
                                    <div class="portfolio-content">
                                        <div class="portfolio-content-inner">
                                            <div class="portfolio-inner">
                                                <p class="portfolio-popup"><a class="link-white" href="images/instagram/6.jpg" data-lightbox="portfolio" data-title="Break Traffic"><span class="fa fa-arrows-alt"></span></a></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="portfolio-item element-item web-design mobile-app">
                                    <img alt="" src="images/instagram/7.jpg" class="img-responsive" />
                                    <div class="portfolio-content">
                                        <div class="portfolio-content-inner">
                                            <div class="portfolio-inner">
                                                <p class="portfolio-popup"><a class="link-white" href="images/instagram/7.jpg" data-lightbox="portfolio" data-title="Mockup Design"><span class="fa fa-arrows-alt"></span></a></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="portfolio-item element-item creative mobile-app">
                                    <img alt="" src="images/instagram/8.jpg" class="img-responsive" />
                                    <div class="portfolio-content">
                                        <div class="portfolio-content-inner">
                                            <div class="portfolio-inner">
                                                <p class="portfolio-popup"><a class="link-white" href="images/instagram/8.jpg" data-lightbox="portfolio" data-title="Team Lead"><span class="fa fa-arrows-alt"></span></a></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="portfolio-item element-item digital web-design">
                                    <img alt="" src="images/instagram/9.jpg" class="img-responsive" />
                                    <div class="portfolio-content">
                                        <div class="portfolio-content-inner">
                                            <div class="portfolio-inner">
                                                <p class="portfolio-popup"><a class="link-white" href="images/instagram/9.jpg" data-lightbox="portfolio" data-title="Phototgraphy"><span class="fa fa-arrows-alt"></span></a></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <a class="btn btn-default btn-xl btn-normal margin-top-20" href="https://instagram.com/qfn.official/">View More On Instagram</a>
                        </div>
                    </div>
                </div>
            </section>
            <!-- Gallery End -->
            
            <!-- Counter Section Start -->
            <section class="section-parallax padding-bottom-50" data-src="images/bg/3.jpg" data-stellar-background-ratio="0.5">
                <span class="overlay-section-bg primary-section-bg"></span>
                <div class="container section-typo-white">
                    <div class="row text-center">
                        <div class="col-md-3 col-sm-6">
                            <div class="counter-wrap">
                                <span class="counter-icon">
                                <i class="flaticon-user"></i>
                                </span>
                                <h3 class="counter" data-counter="9894">
                                    9894
                                </h3>
                                <span class="counter-text">
                                Members
                                </span>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-6">
                            <div class="counter-wrap">
                                <span class="counter-icon">
                                <i class="flaticon-wallet"></i>
                                </span>
                                <h3 class="counter" data-counter="400">
                                    400
                                </h3>
                                <span class="counter-text">
                                Completed Projects
                                </span>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-6">
                            <div class="counter-wrap">
                                <span class="counter-icon">
                                <i class="flaticon-trophy"></i>
                                </span>
                                <h3 class="counter" data-counter="73">
                                    73
                                </h3>
                                <span class="counter-text">
                                Winning Awards
                                </span>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-6">
                            <div class="counter-wrap">
                                <span class="counter-icon">
                                <i class="flaticon-star"></i>
                                </span>
                                <h3 class="counter" data-counter="580">
                                    580
                                </h3>
                                <span class="counter-text">
                                User Reviews
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- Counter Section End -->
            <!-- Our Works Section Start -->
            <section id="portfolio">
                <div class="container text-center">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="section-title">
                                <h2 class="section-title-divider primary-divider">Organizational Structure</h2>
                                <!-- SECTION TITLE -->
                                <p>
                                    The organizational structure of Quintessence Fraternity has been created in
                            a way that meets the needs of members at every level. This structure has
                            been the solid structure on which QF’s foundation remains unshakable.
                                </p>
                                <p>The organizational structure is divided into a group of 3;</p>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="portfolio-button-set margin-bottom-30">
                                <div class="tabbed">
                                    <input type="radio" id="tab1" name="css-tabs" checked>
                                    <input type="radio" id="tab2" name="css-tabs">
                                    <input type="radio" id="tab3" name="css-tabs">
                                    
                                    <ul class="tabs">
                                        <li class="tab"><label for="tab1">The National Body</label></li>
                                        <li class="tab"><label for="tab2">The Cell Body</label></li>
                                        <li class="tab"><label for="tab3">The Student Body</label></li>
                                    </ul>

                                    <div class="tab-content">
                                        <h4>The National Body</h4>
                                            <p>The National Body is the collective body made up of members who have graduated from the university. This body is governed by The National Executive Committee made up of; The National President, The National Secretary, The National Treasurer, The National Financial Secretary and The National Director of Functions.</p>
                                                
                                            <p>This Executive Committee work together for the greater good and organization of Quintessence Fraternity.</p>
                                    </div>
                                    
                                    <div class="tab-content">
                                        <h4>The Cell Body</h4>
                                            <p>The Cell Body is the body made up of graduate members in different states of the country. These cells make up The National Body and is governed by a State Executive Committee particular to that cell, with the same positions occupied as the National Executive Committee, but in this case, State.</p>
                                    </div>
                                    
                                    <div class="tab-content">
                                        <h4>The Student Body</h4>
                                            <p>The Student Body which is regarded as the most important body, is the body made up of undergraduate members. This body is regarded as the most important because it is where most, if not all mission statements and visions of the Fraternity are carried out. This body breeds the new generation of members who will eventually find their places in respective cells and The National Body.</p>
                                            <p>The Student Body is governed by 6 major offices which are; The office of the Mayor, The office of the Deputy Mayor, The office of the Chancellor, The office of the Head of Finance, The office of the Director of Public Relations and The office of the Director of Functions.</p>
                                            <p>Special offices include; The office of the Disciplinary Committee Chairman and The office of the Disciplinary Committee Secretary.</p>
                                    </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- Our Works Section End -->

            <hr />
            
            <!-- Contact Section Start -->
            <section class="contact-section" id="contact">
                <div class="container">
                    <div class="row text-center">
                        <div class="col-sm-8 col-sm-offset-2">
                            <div class="section-title">
                                <h2 class="section-title-divider primary-divider">Contact Us</h2>
                                <!-- SECTION TITLE -->
                                <p>
                                    For enquieries and more
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="row text-center">
                        <div class="col-sm-4">
                            <div class="contact-adress">
                                <p class="contact-icons"><i class="fa fa-map-marker primary-color"></i></p>
                                <div class="padding-tb-20">
                                    <p>
                                        Enugu
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="contact-mail">
                                <p class="contact-icons"><i class="fa fa-envelope-o primary-color"></i></p>
                                <div class="padding-tb-20">
                                    <p>info@quintessence.com</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="contact-number">
                                <p class="contact-icons"><i class="fa fa-phone primary-color"></i></p>
                                <div class="padding-tb-20">
                                    <p>
                                        +1234 5678 910<br />
                                        +1234 5679 910
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row text-center">
                        <div class="contact-form">
                            <p id="contact-status-msg" class="hide"></p>
                            <form id="contact-form" class="contact-form">
                                <div class="col-md-4 col-md-offset-2 padding-bottom-20">
                                    <div class="form-group">
                                        <input id="name" class="form-control" name="name" autocomplete="off" placeholder="Name" data-bv-field="name" type="text" />
                                    </div>
                                </div>
                                <div class="col-md-4 padding-bottom-20">
                                    <div class="form-group">
                                        <input id="email" class="form-control" name="email" autocomplete="off" placeholder="E-mail" data-bv-field="email" type="email">
                                    </div>
                                </div>
                                <span class="clearfix"></span>
                                <div class="contact-message col-md-8 col-md-offset-2">
                                    <div class="form-group margin-bottom-0">
                                        <textarea id="message" class="form-control textarea" rows="3" name="message" placeholder="Message" data-bv-field="message"></textarea>
                                    </div>
                                </div>
                                <div class="col-md-12 padding-top-30">
                                    <button type="submit" class="btn btn-default btn-xl btn-normal margin-top-20 contact-btn">Send a Message</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </section>
            <!-- Contact Section End -->
            <!-- Footer Start -->
            <footer class="footer padding-tb-30 primary-section-bg section-typo-white">
                <div class="container">
                    <div class="row text-center margin-bottom-20">
                        <div class="col-md-12">
                            <ul class="nav navbar-nav footer-social">
                                <li><a href="#" class="social-facebook"><i class="fa fa-facebook"></i></a></li>
                                <li><a href="#" class="social-twitter"><i class="fa fa-twitter"></i></a></li>
                                <li><a href="#" class="social-pinterest"><i class="fa fa-pinterest-p"></i></a></li>
                                <li><a href="#" class="social-instagram"><i class="fa fa-instagram"></i></a></li>
                                <li><a href="#" class="social-google-plus"><i class="fa fa-google-plus"></i></a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="row text-center">
                        <div class="col-md-12">
                            <p class="copyright-text">Copyright &copy; <?php echo date('Y'); ?> Quintessence Fraternity | All Rights Reserved.</a></p>
                        </div>
                    </div>
                </div>
                <a href="#" class="back-to-top" id="back-to-top"><i class="fa fa-angle-up"></i></a>
            </footer>
            <!-- Footer End -->
        
        </div><!-- .main-wrap -->
        
        <!-- JQUERY LIBRARY -->
        <script src="js/jquery.min.js"></script>
        <!-- BOOTSTRAP JS -->
        <script src="js/bootstrap.min.js"></script>
        <!-- OWL CAROUSEL JS -->
        <script src="js/owl.carousel.min.js"></script>
        <!-- APPEARS JS -->
        <script src="js/jquery.appear.js"></script>
        <!-- EASING JS -->
        <script src="js/jquery.easing.min.js"></script>
        <!-- STELLAR JS -->
        <script src="js/jquery.stellar.min.js"></script>
        <!-- COUNTER JS -->
        <script src="js/jquery.counterup.min.js"></script>
        <!-- ISOTOPE JS -->
        <script src="js/isotope.pkgd.min.js"></script>
        <!-- LIGHTBOX JS -->
        <script src="js/lightbox.min.js"></script>
        <!-- YTPLAYER JS -->
        <script src="js/jquery.mb.YTPlayer.min.js"></script>
        <!-- BOOTSTRAP VALIDATOR JS -->
        <script src="js/validator.min.js"></script>
        <!-- THEME JS -->
        <script src="js/theme.js"></script>
    </body>
</html>

