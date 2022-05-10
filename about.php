<?php
/**
 * Quintessence Fraternity Home Screen
 */
if (!session_id()) {
    session_start();
}

require __DIR__ . '/bootstrap.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <!-- TITLE-->
    <title><?php echo $site->name; ?></title>
    <!-- FAV ICON -->
    <link rel="shortcut icon" href="<?php echo $site->url; ?>/images/favicon.ico" type="text/css" />
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Enhance the leadership abilities of men by refining their character through the framework of Friendship, Justice and Learning.">
    <meta name="author" content="<?php echo $site->name; ?>">
    <!-- BOOTSTRAP CSS -->
    <link rel="stylesheet" href="<?php echo $site->url; ?>/css/bootstrap.min.css" type="text/css" />
    <!-- FONTAWESOME CSS -->
    <link rel="stylesheet" href="<?php echo $site->url; ?>/css/font-awesome.min.css" type="text/css" />
    <!-- OWL CAROUSEL CSS -->
    <link rel="stylesheet" href="<?php echo $site->url; ?>/css/owl.carousel.min.css" type="text/css" />
    <!-- ANIMATE CSS -->
    <link rel="stylesheet" href="<?php echo $site->url; ?>/css/animate.min.css" type="text/css" />
    <!-- LIGHTBOX CSS -->
    <link rel="stylesheet" href="<?php echo $site->url; ?>/css/lightbox.min.css" type="text/css" />
    <!-- YTPLAYER CSS -->
    <link rel="stylesheet" href="<?php echo $site->url; ?>/css/mb.YTPlayer.min.css" type="text/css" />
    <!-- FLATICON CSS -->
    <link rel="stylesheet" href="<?php echo $site->url; ?>/css/flaticon.css" type="text/css" />
    <!-- BOOTSTRAP VALIDATOR CSS -->
    <link rel="stylesheet" href="<?php echo $site->url; ?>/css/validator.min.css" type="text/css" />
    <!-- GOOGLE FONTS  -->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,600,700,300,100,900|Poppins:400,500'
        rel='stylesheet' type='text/css' />
    <!-- THEME STYLE CSS -->
    <link rel="stylesheet" href="<?php echo $site->url; ?>/css/style.css" type="text/css" />
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
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                        data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand primary-logo" href="<?php echo $site->url; ?>/">
                        <h1 style="color:#fff">LOGO</h1>
                    </a>
                    <a class="navbar-brand sticky-logo" href="<?php echo $site->url; ?>/">
                        <h1 style="color:#fff;">LOGO</h1>
                    </a>
                </div>
                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav pull-right">
                        <li><a href="<?php echo $site->url; ?>/">Home</a></li>
                        <li class="active"><a href="#">About</a></li>
                        <li><a href="<?php echo $site->url; ?>/#gallery">Gallery</a></li>
                        <li><a href="<?php echo $site->url; ?>/#contact">Contact</a></li>
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
                                    <h1 class="section-title-divider animated zoomIn">
                                        About<br /><span class="primary-color">Quintessence Fraternity</span></h1>
                                </div>
                                <a class="btn btn-default btn-xl" href="#content"><i class="fa fa-arrow-down"></i></a>
                                <!-- THEME DEFAULT BUTTON -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <!-- Theme Header End -->

        <section id="content">
            <div class="container">
                <div class="row">
                    <div class="col-md-10">
                        <div class="col-inner">
                            <div class="section-sub-title">
                                <h3 class="under-line">Quintessence Fraternity History</h3>
                            </div>
                            <p>Quintessence Fraternity of Nigeria was founded in 1989 on the campus of University of
                                Nigeria, Nsukka Branch, and in 1991 on the campus of University of Nigeria, Enugu
                                Branch. The story of its founding by 3 determined men set the stage for the growth and
                                success of one of the country’s premier fraternal organizations.</p>
                            <p>Having a vision to establish an association which shall enhance an academic, social and
                                cultural development, the founding members successfully birthed a fraternity of which
                                some of its core aims are to have members live in harmony, unity and love of one
                                indivisible association, free of political or sinister ideology.</p>
                            <p>Quintessence Fraternity’s story has been building on itself since 1989 and, indeed, the
                                Fraternity has changed dramatically since that time.</p>
                            <p>Our founders’ dream was simple — to enhance the leadership abilities of men by refining
                                their character through the framework of Friendship, Justice and Learning.</p>
                        </div>
                    </div>
                </div>
                <div id="aims_and_objectives" class='row'>
                    <div class="col-md-10">
                        <div class="col-inner">
                            <div class="section-sub-title">
                                <h3 class="under-line">Aims and Objectives</h3>
                            </div>
                            <ul class="list-group">
                                <li class="list-group-item media border-0">
                                    <i class="tio record_outlined c-orange mr-2"></i>
                                    <div class="media-body">
                                        Integrating individuals who are projecting the same ideology and
                                        precepts as well as maintaining a high standard of academic excellence.
                                    </div>
                                </li>
                                <li class="list-group-item media border-0">
                                    <i class="tio record_outlined c-aquamarine mr-2"></i>
                                    <div class="media-body">
                                        Giving financial and academic help to members in need.
                                    </div>
                                </li>
                                <li class="list-group-item media border-0">
                                    <i class="tio record_outlined c-red mr-2"></i>
                                    <div class="media-body">
                                        Helping uplift and maintain the moral standard of our members as well as
                                        an esteemed social awareness.
                                    </div>
                                </li>

                                <li class="list-group-item media border-0">
                                    <i class="tio record_outlined c-red mr-2"></i>
                                    <div class="media-body">
                                        Promoting healthy business relationships among our members.
                                    </div>
                                </li>

                                <li class="list-group-item media border-0">
                                    <i class="tio record_outlined c-aquamarine mr-2"></i>
                                    <div class="media-body">
                                        Exploring and discovering talents and creativity among our members.
                                    </div>
                                </li>

                                <li class="list-group-item media border-0">
                                    <i class="tio record_outlined c-orange mr-2"></i>
                                    <div class="media-body">
                                        Creating a congenial atmosphere whereby members will be guided and
                                        directed on how to disburse funds.
                                    </div>
                                </li>

                                <li class="list-group-item media border-0">
                                    <i class="tio record_outlined c-red mr-2"></i>
                                    <div class="media-body">
                                        Helping in the development go the university and its environs.
                                    </div>
                                </li>

                                <li class="list-group-item media border-0">
                                    <i class="tio record_outlined c-aquamarine mr-2"></i>
                                    <div class="media-body">
                                        Helping not only members who are in a financial mess but as well as those who
                                        are academically backward or handicapped.

                                    </div>
                                </li>

                            </ul>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-10">
                        <div class="col-inner">
                            <div class="section-sub-title">
                                <h3 class="under-line">Charitable projects</h3>
                            </div>
                            <p>Quintessence Fraternity engages in charity projects every now and then. The most notable
                                being the charity drives organized by the two campuses during the Perfection
                                Night/Induction Week.</p>
                            <p>The Perfection Night is a night that signifies the end of a tenure and the induction of
                                new members.</p>
                            <p>Before this night, Quintessence Fraternity organizes a massive charity drive which serves
                                as a token of appreciation to the society; this includes visits to the motherless babies
                                homes, disabled peoples’ homes, organizing students scholarship events, among many
                                others.</p>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-10">
                        <div class="col-inner">
                            <div class="section-sub-title">
                                <h3 class="under-line">Organizational Structure</h3>
                            </div>

                            <p>The organizational structure of Quintessence Fraternity has been created in a way that
                                meets the needs of members at every level. This structure has been the solid structure
                                on which QF’s foundation remains unshakable.</p>
                            <p>The organizational structure is divided into a group of 3;</p>
                            <ul>
                                <li>The National Body</li>
                                <li>The Cell Body</li>
                                <li>The Student Body.</li>
                            </ul>
                            <hr />

                            <p><b>The National Body</b> is the collective body made up of members who have graduated
                                from the university. This body is governed by The National Executive Committee made up
                                of; The National President, The National Secretary, The National Treasurer, The National
                                Financial Secretary and The National Director of Functions.</p>
                            <p>This Executive Committee work together for the greater good and organization of
                                Quintessence Fraternity.</p>

                            <hr />

                            <p><b>The Cell Body</b> is the body made up of graduate members in different states of the
                                country. These cells make up The National Body and is governed by a State Executive
                                Committee particular to that cell, with the same positions occupied as the National
                                Executive Committee, but in this case, State.</p>

                            <hr />
                            <p><b>The Student Body</b> which is regarded as the most important body, is the body made up
                                of undergraduate members. This body is regarded as the most important because it is
                                where most, if not all mission statements and visions of the Fraternity are carried out.
                                This body breeds the new generation of members who will eventually find their places in
                                respective cells and The National Body.</p>
                            <p>The Student Body is governed by 6 major offices which are; The office of the Mayor, The
                                office of the Deputy Mayor, The office of the Chancellor, The office of the Head of
                                Finance, The office of the Director of Public Relations and The office of the Director
                                of Functions.</p>
                            <p>Special offices include; The office of the Disciplinary Committee Chairman and The office
                                of the Disciplinary Committee Secretary.</p>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-10">
                        <div class="col-inner">
                            <div class="section-sub-title">
                                <h3 class="under-line">Importance of Quintessence Fraternity in the Life of a Young
                                    Undergraduate</h3>
                            </div>

                            <p>There are many benefits to joining Quintessence Fraternity. This could range from higher
                                achievements to personal and professional gains. Joining Quintessence Fraternity creates
                                opportunities for meaningful connections. These lasting friendships provide a family
                                away from home and a solid university community.</p>

                            <p>Quintessence Fraternity members are active on campus. With over 65% of the fraternity
                                members active in at least one additional on-campus activity. As a member you can
                                understand how to form relationships, sustain commitments and create a vibrant
                                university community. Also, as a member of Quintessence Fraternity, you are granted
                                access to a network of successful and connected individuals. Being a member can allow
                                you to interact with alumni who have been through similar experiences and have succeeded
                                in similar career fields. Connections occur not only within the university walls, but
                                also nationally and internationally.</p>

                            <p>Within the fraternity community, student members have the opportunity to create a legacy
                                that will be passed down to future students.</p>

                            <p>Being a member of Quintessence Fraternity helps to create a more fulfilling experience
                                while at college by providing a wide variety of experiences. Quintessence Fraternity
                                offers a family atmosphere that exceeds ordinary friendships - often lasting a lifetime.
                            </p>

                            <p>Finally, the Quintessence Fraternity experience is rich with opportunities to practice
                                everyday leadership. Members are granted the opportunity to hold offices and leadership
                                positions while fine tuning the following skills:</p>
                            ◦ Budgeting <br />
                            ◦ Personnel Issues<br />
                            ◦ Event Planning<br />
                            ◦ Accountability<br />
                            ◦ Communication<br />
                            ◦ Diverse Constituency<br />
                            ◦ Leading Teams<br />
                            ◦ Time Management<br />
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Footer Start -->
        <footer class="footer padding-tb-30 primary-section-bg section-typo-white">
            <div class="container">
                <div class="row text-center margin-bottom-20">
                    <div class="col-md-12">
                        <ul class="nav navbar-nav footer-social">
                            <li><a href="#" class="social-facebook"><i class="fa fa-facebook"></i></a></li>
                            <li><a href="#" class="social-twitter"><i class="fa fa-twitter"></i></a></li>
                            <li><a href="#" class="social-pinterest"><i class="fa fa-pinterest-p"></i></a>
                            </li>
                            <li><a href="#" class="social-instagram"><i class="fa fa-instagram"></i></a></li>
                            <li><a href="#" class="social-google-plus"><i class="fa fa-google-plus"></i></a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="row text-center">
                    <div class="col-md-12">
                        <p class="copyright-text">Copyright &copy; <?php echo date('Y'); ?> Quintessence Fraternity |
                            All Rights Reserved.</a></p>
                    </div>
                </div>
            </div>
            <a href="#" class="back-to-top" id="back-to-top"><i class="fa fa-angle-up"></i></a>
        </footer>
        <!-- Footer End -->
    </div>

    <!-- JQUERY LIBRARY -->
    <script src="<?php echo $site->url; ?>/js/jquery.min.js"></script>
    <!-- BOOTSTRAP JS -->
    <script src="<?php echo $site->url; ?>/js/bootstrap.min.js"></script>
    <!-- OWL CAROUSEL JS -->
    <script src="<?php echo $site->url; ?>/js/owl.carousel.min.js"></script>
    <!-- APPEARS JS -->
    <script src="<?php echo $site->url; ?>/js/jquery.appear.js"></script>
    <!-- EASING JS -->
    <script src="<?php echo $site->url; ?>/js/jquery.easing.min.js"></script>
    <!-- STELLAR JS -->
    <script src="<?php echo $site->url; ?>/js/jquery.stellar.min.js"></script>
    <!-- COUNTER JS -->
    <script src="<?php echo $site->url; ?>/js/jquery.counterup.min.js"></script>
    <!-- ISOTOPE JS -->
    <script src="<?php echo $site->url; ?>/js/isotope.pkgd.min.js"></script>
    <!-- LIGHTBOX JS -->
    <script src="<?php echo $site->url; ?>/js/lightbox.min.js"></script>
    <!-- YTPLAYER JS -->
    <script src="<?php echo $site->url; ?>/js/jquery.mb.YTPlayer.min.js"></script>
    <!-- BOOTSTRAP VALIDATOR JS -->
    <script src="<?php echo $site->url; ?>/js/validator.min.js"></script>
    <!-- THEME JS -->
    <script src="<?php echo $site->url; ?>/js/theme.js"></script>
</body>

</html>