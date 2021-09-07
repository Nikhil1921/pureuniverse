<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="base_url" content="<?= base_url() ?>">
    <title><?= APP_NAME ?> | <?= ucfirst($title) ?></title>
    <?= link_tag('assets/images/favicon.png', 'png', 'image/x-icon') ?>
	<?= link_tag('assets/images/favicon.png', 'icon', 'image/x-icon') ?>
    <?= link_tag('assets/css/bootstrap.min.css', 'stylesheet', 'text/css') ?>
    <?= link_tag('assets/css/font-awesome.min.css', 'stylesheet', 'text/css') ?>
    <?= link_tag('assets/css/flaticon-set.css', 'stylesheet', 'text/css') ?>
    <?= link_tag('assets/css/magnific-popup.css', 'stylesheet', 'text/css') ?>
    <?= link_tag('assets/css/owl.carousel.min.css', 'stylesheet', 'text/css') ?>
    <?= link_tag('assets/css/owl.theme.default.min.css', 'stylesheet', 'text/css') ?>
    <?= link_tag('assets/css/animate.css', 'stylesheet', 'text/css') ?>
    <?= link_tag('assets/css/bootsnav.css', 'stylesheet', 'text/css') ?>
    <?= link_tag('assets/css/style.css?v=1.0.1', 'stylesheet', 'text/css') ?>
    <?= link_tag('assets/css/responsive.css', 'stylesheet', 'text/css') ?>
    <?= link_tag('assets/css/custom.css?v=1.0.7', 'stylesheet', 'text/css') ?>
    <!-- ========== Google Fonts ========== -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Poppins:400,500,600,700,800" rel="stylesheet">
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-YYXWS5JYSW"></script>
    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());

      gtag('config', 'G-YYXWS5JYSW');
    </script>
</head>
<body>
    <!-- Preloader Start -->
    <div class="se-pre-con"></div>
    <!-- Preloader Ends -->
    <?php if (!isset($removeHeader)): ?>
    <header id="home">
        <nav class="navbar navbar-default navbar-sticky bootsnav">
            <div class="top-bar-area address-two-lines bg-dark text-light show-hide">
                <div class="container">
                    <div class="row">
                        <div class="col-xs-6 address-info hide-thing">
                            <div class="info box">
                                <ul>
                                    <li>
                                        <span><i class="fas fa-envelope-open"></i> Email</span>
                                        <a href="mailto:info@pureuniverse.live">info@pureuniverse.live</a>
                                    </li>
                                    <li>
                                        <span><i class="fas fa-phone"></i> Contact</span>
                                        <a href="tel:1800 202 2002">1800 202 2002</a>
                                        <!-- <br> -->/
                                        <a href="tel:9179 48926874">+9179 48926874</a>
                                        <!-- <br> -->/
                                        <a href="tel:9179 48986418">+9179 48986418</a>
                                    </li>
                                    <!-- <li><div id="google_translate_element"></div></li> -->
                                </ul>
                            </div>
                        </div>
                        <div class="user-login text-right col-sm-6">
                        <?php if(!$this->session->user_id): ?>
                            <a class="popup-with-form" href="#register-form">
                                <i class="fas fa-edit"></i> Register For Exam
                            </a>
                            <a  class="popup-with-form" href="#login-form">
                                <i class="fas fa-user"></i> Login
                            </a>
                            <a class="popup-with-form" href="#check-otp-form" id="otp-form" style="display:none;"></a>
                        <?php else: ?>
                            <a class="" href="<?= base_url('profile') ?>">
                                <i class="fas fa-edit"></i> Start Exam
                            </a>
                            <a  class="" href="<?= base_url('logout') ?>">
                                <i class="fas fa-user"></i> LogOut
                            </a>
                        <?php endif ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-menu">
                        <i class="fa fa-bars"></i>
                    </button>
                    <a class="navbar-brand" href="<?= base_url() ?>">
                        <?= img(['src' => 'assets/img/pure_uni.png', 'class' => "logo"]) ?>
                    </a>
                </div>
                <div class="collapse navbar-collapse" id="navbar-menu">
                    <ul class="nav navbar-nav navbar-right" data-in="#" data-out="#">
                        <li><a href="<?= base_url() ?>">Home</a></li>
                        <li><a target="_blank" href="https://imvs.live/">IMVS</a></li>
                        <li class="dropdown">
                            <a href="javascript:" class="dropdown-toggle active" data-toggle="dropdown">About IMVS</a>
                            <ul class="dropdown-menu animated" style="display: none; opacity: 1;">
                                <li><a href="<?= base_url('discipline') ?>">Discipline</a></li>
                                <li><a href="<?= base_url('courage') ?>">Courage</a></li>
                                <li><a href="<?= base_url('self-resprct') ?>">Self-Respect</a></li>
                                <li><a href="<?= base_url('honesty') ?>">Honesty</a></li>
                                <li><a href="<?= base_url('morals') ?>">Ethics & Morals</a></li>
                            </ul>
                        </li>
                        <li><a href="<?= base_url('exam-table') ?>">About Exam</a></li>
                        <li class="dropdown"><a href="javascript:" class="dropdown-toggle active" data-toggle="dropdown">Sample Paper</a>
                            <ul class="dropdown-menu animated" style="display: none; opacity: 1;">
                                <li><a href="<?= base_url('sample-one') ?>">Sample Paper1</a></li>
                                <li><a href="<?= base_url('sample-two') ?>">Sample Paper2</a></li>
                            </ul>
                        </li>
                        <li><a href="<?= base_url('media') ?>">Media</a></li>
                        <li><a href="<?= base_url('gallery') ?>">Gallery</a></li>
                        <li><a href="<?= base_url('career') ?>">Career</a></li>
                        <li><a href="<?= base_url('faq') ?>">Faq</a></li>
                        <li><a href="<?= base_url('contact') ?>">Contact</a></li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>
    
    <form id="register-form" action="<?= base_url('register') ?>" class="mfp-hide white-popup-block about-area" method="post">
        <div class="col-md-12">
            <center>
                <?= img('assets/img/pure_uni.png') ?>
                <h4>Register a new account</h4>
            </center>
            <div class="col-sm-12" id="resigter-errors"></div>
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label >Your Name:</label>
                        <input class="form-control" placeholder="Enter Name*" name="name" type="text">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Your Email:</label>
                        <input class="form-control" placeholder="Enter Email*" name="email" type="email">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Your Date of Birth:</label>
                        <input onchange="getCategory(this.value)" class="form-control" type="date" placeholder="Enter Date of Birth" name="dob" id="dob-change">
                        <span class="text-danger" id="exam-error" style="display:none;">You are not eligible for the exam</span>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label>Your Address:</label>
                        <input class="form-control" placeholder="Enter Address*" name="address" type="textarea">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Select Country</label>
                        <select class="form-control" name="country" id="country" data-dependent="state" onchange="getStates(this)">
                            <option disabled selected>Select Country</option>
                            <?php foreach($this->main->getall('countries', 'id, name', ['is_deleted' => 0]) as $country): ?>
                                <option value="<?= e_id($country['id']) ?>"><?= $country['name'] ?></option>
                            <?php endforeach ?>
                        </select>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Select state:</label>
                        <select class="form-control" name="state" id="state" data-dependent="city" onchange="getCities(this)" readonly="">
                            <option readonly value="" selected> Select state</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Select city:</label>
                        <select class="form-control" name="city" id="city" readonly="">
                            <option readonly value="" selected> Select city</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Your Mobile:</label>
                        <input class="form-control" placeholder="Enter Mobile*" maxlength="10" name="mobile" type="text">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Create Password:</label>
                        <input class="form-control" placeholder="Enter Password*" name="password" type="password">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Voucher Code:</label>
                        <input class="form-control" onfocusout="checkVoucher(this)" placeholder="Enter voucher code" name="voucher" id="voucher" type="text">
                        <span></span>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label>Select Exam Category:</label>
                        <select class="form-control" name="exams" id="exm_cat" onchange="getMonths(this)" readonly="">
                            <option readonly value="" selected> Select Exam Category</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label>Select Month</label>
                        <select class="form-control" name="month" id="months" readonly="" onchange="getPapers(this)">
                            <option disabled selected>Select Month</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label>Select Exam Paper Date</label>
                        <select class="form-control" name="exam_date" id="exm_date" data-dependent="exam_lang" onchange="getLang(this)" readonly="">
                            <option disabled selected>Select Exam Paper Date</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label>Select Exam Language</label>
                        <select class="form-control" name="exam_lang" id="exam_lang" readonly="">
                            <option disabled selected>Select Exam Language</option>
                        </select>
                    </div>
                </div>
                <div class="">
                    <label for="copy">
                        <input type="checkbox" name="extra" id="copy">Want a copy of Physical Certificate? (60/-Rs. Charge of Courier)
                    </label>
                </div>
                <div class="">
                    <label for="terms">
                        <input type="checkbox" id="terms" name="terms">Accept Terms & Condition
                        <br>
                        <span class="text-danger" id="show-terms-error">Please accept terms & conditions</span>
                    </label>
                </div>
                <div class="">
                    <div class="bottom-info" >
                        <ul>
                            <li>
                                Fees: <span id="new_price">0</span> Rs 
                            </li>
                            +
                            <li>
                                Gst:18%
                            </li>
                            =
                            <li>
                                Total:<span id="new_gst_price">0</span> Rs
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-12">
                    <button type="submit">
                        Sign up
                    </button>
                </div>
            </div>
        </div>
    </form>
    <form method="post" id="login-form" action="<?= base_url('login') ?>" class="mfp-hide white-popup-block-small">
        <div class="col-sm-12">
            <center>
                <?= img('assets/img/pure_uni.png') ?>
                <h4>login to your registered account!</h4>
            </center>
            <div class="row">
                <div class="col-sm-12 text-danger" id="login-errors"></div>
                <div class="col-md-12">
                    <div class="form-group">
                        <input class="form-control" placeholder="Email*" type="email" name="email">
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <input class="form-control" placeholder="Password*" type="password" name="password">
                    </div>
                </div>
                <div class="col-md-12">
                    <button type="submit">
                        Login
                    </button>
                </div>
            </div>
            <p class="link-bottom"><a class="popup-with-form" href="#forgot-password-form">Lost your password?</a></p>
            <p class="link-bottom">Not a member yet? <a class="popup-with-form" href="#register-form">Register now</a></p>
        </div>
    </form>
    <form method="post" id="forgot-password-form" action="<?= base_url('forgot-password') ?>" class="mfp-hide white-popup-block-small">
        <div class="col-md-12">
            <center>
                <?= img('assets/img/pure_uni.png') ?>
                <h4>Enter Your Registered Email</h4>
            </center>
            <div class="row">
                <div class="col-sm-12 text-danger" id="forgot-errors"></div>
                <div class="col-md-12">
                    <div class="form-group">
                        <input class="form-control" placeholder="Email*" type="email" name="email">
                    </div>
                </div>
                <div class="col-md-12">
                    <button type="submit">
                        Submit
                    </button>
                </div>
            </div>
        </div>
    </form>
    <form method="post" id="check-otp-form" action="<?= base_url('check-otp') ?>" class="mfp-hide white-popup-block-small">
        <div class="col-md-12">
            <center>
                <?= img('assets/img/pure_uni.png') ?>
                <h4>Enter Recieved OTP</h4>
            </center>
            <input class="form-control" id="check-email" placeholder="Email*" type="hidden" name="email" readonly />
            <div class="row">
                <div class="col-sm-12 text-danger" id="check-otp-errors"></div>
                <div class="col-md-12">
                    <div class="form-group">
                        <input class="form-control" placeholder="OTP*" type="text" maxlength="4" name="otp" />
                    </div>
                </div>
                <div class="col-md-12">
                    <button type="submit">
                        Submit
                    </button>
                </div>
            </div>
        </div>
    </form>
    <?php endif ?>
    <?php if (isset($breadcrumb)): ?>
        <div class="breadcrumb-area shadow dark text-center bg-fixed text-light" style="background-image: url(<?= base_url('assets/img/banner/10.jpg') ?>);">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <h1><?= $title ?></h1>
                        <ul class="breadcrumb">
                            <li><a href="<?= base_url() ?>"><i class="fas fa-home"></i> Home</a></li>
                            <li class="active"><?= $title ?></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    <?php endif ?>
    <?= $contents ?>
    <?php if (!isset($removeHeader)): ?>
    <footer class="bg-dark default-padding-top text-light">
        <div class="container">
            <div class="row">
                <div class="f-items">
                    <div class="col-md-3 col-sm-6 item">
                        <div class="f-item link">
                            <h4>useful Links</h4>
                            <div class="row">
                                <div class="col-sm-6">
                                    <ul>
                                        <li>
                                            <a href="<?= base_url() ?>">Home</a>
                                        </li>
                                        <li>
                                            <a href="<?= base_url('about') ?>">About</a>
                                        </li>
                                        <li>
                                            <a href="<?= base_url('contact') ?>">Contact</a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="col-sm-6">
                                    <ul>
                                        <li><a href="<?= base_url('blog') ?>">Blog</a></li>
                                        <li><a href="<?= base_url('franchise') ?>">Franchise</a></li>
                                        <li><a href="<?= base_url('privacy') ?>">Privacy Policy</a></li>
                                        <li><a href="<?= base_url('disclaimer') ?>">Disclaimer</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 item">
                        <div class="f-item">
                            <div class="f-item address">
                                <h4>Head Office</h4>
                                <ul>
                                    <li>
                                        <i class="fas fa-envelope"></i> 
                                        <p>Email <span><a href="mailto:info@pureuniverse.live">info@pureuniverse.live</a></span></p>
                                    </li>
                                    <li>
                                        <i class="fas fa-map"></i> 
                                        <p>Office <br>Block-B, 02, Ville Paradise, Naukuchaital Nainital 263163, India</p>
                                    </li>
                                </ul>
                                
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 item">
                        <div class="f-item">
                            <div class="f-item address">
                                <h4>Regional Head Office </h4>
                                <ul>
                                    <li>
                                        <i class="fas fa-envelope"></i> 
                                        <p>Email <span><a href="mailto:info@pureuniverse.live">info@pureuniverse.live</a></span></p>
                                    </li>
                                    <li>
                                        <i class="fas fa-map"></i> 
                                        <p>Office <br>Block-A, 602-603,<br> Shilp Aaron, Opposit 'ARMIEDA', <br>Sindhubhavan Road, Bodakdev, Ahmedabad.380 054.</p>
                                    </li>
                                </ul>
                                
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 item">
                        <div class="f-item">
                            <div class="f-item address">
                                <h4>International center</h4>
                                <ul>
                                    <li>
                                        <i class="fas fa-envelope"></i> 
                                        <p>Email <span><a href="mailto:info@pureuniverse.live">info@pureuniverse.live</a></span></p>
                                    </li>
                                    <li>
                                        <i class="fas fa-map"></i> 
                                        <p>Office <br>711-Bentgrass dr aberdeen,<br> MD 21001, USA</p>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="social">
                        <ul>
                            <li>
                                <a target="_blank" href="https://www.facebook.com/IMVSpureuniverse"><i class="fab fa-facebook-f"></i></a>
                            </li>
                            <li>
                                <a target="_blank" href="https://www.instagram.com/IMVSpureuniverse/"><i class="fab fa-instagram"></i></a>
                            </li>
                            <li>
                                <a target="_blank" href="https://www.youtube.com/channel/UC9eIsHZbyljsQJBdV4FU_AA"><i class="fab fa-youtube"></i></a>
                            </li>
                            <li>
                                <a target="_blank" href="https://www.linkedin.com/company/pureuniverse"><i class="fab fa-linkedin"></i></a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer-bottom">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="col-md-6">
                            <p>&copy; Copyright 2021. All Rights Reserved by <a href="javascript:">Pure Universe</a></p>
                        </div>
                        <div class="col-md-6 text-right link">
                            <ul>
                                <li>
                                    <a href="<?= base_url('terms') ?>">Terms & Refund of user</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <?php endif ?>
    <!-- <script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
    <script>
    function googleTranslateElementInit() {
        new google.translate.TranslateElement({
            pageLanguage: 'en'
        }, 'google_translate_element');
    }
    </script> -->
    <script src="<?= base_url('assets/js/jquery-1.12.4.min.js') ?>"></script>
    <script src="<?= base_url('assets/js/bootstrap.min.js') ?>"></script>
    <script src="<?= base_url('assets/js/equal-height.min.js') ?>"></script>
    <script src="<?= base_url('assets/js/jquery.appear.js') ?>"></script>
    <script src="<?= base_url('assets/js/jquery.easing.min.js') ?>"></script>
    <script src="<?= base_url('assets/js/jquery.magnific-popup.min.js') ?>"></script>
    <script src="<?= base_url('assets/js/modernizr.custom.13711.js') ?>"></script>
    <script src="<?= base_url('assets/js/owl.carousel.min.js') ?>"></script>
    <script src="<?= base_url('assets/js/wow.min.js') ?>"></script>
    <script src="<?= base_url('assets/js/isotope.pkgd.min.js') ?>"></script>
    <script src="<?= base_url('assets/js/imagesloaded.pkgd.min.js') ?>"></script>
    <script src="<?= base_url('assets/js/count-to.js') ?>"></script>
    <script src="<?= base_url('assets/js/loopcounter.js') ?>"></script>
    <script src="<?= base_url('assets/js/bootsnav.js') ?>"></script>
    <script src="<?= base_url('assets/js/jquery.validate.min.js') ?>"></script>
    <script src="<?= base_url('assets/js/main.js?v=1.0.2') ?>"></script>
    <script src="<?= base_url('assets/js/custom.js?v=1.0.7') ?>"></script>
    <!--Start of Tawk.to Script-->
    <?php if (!isset($removeHeader)): ?>
    <script type="text/javascript">
        var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
        (function(){
            var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
            s1.async=true;
            s1.src='https://embed.tawk.to/611b52ecd6e7610a49b08953/1fd9bnrdc';
            s1.charset='UTF-8';
            s1.setAttribute('crossorigin','*');
            s0.parentNode.insertBefore(s1,s0);
        })();
    </script>
    <?php endif ?>
    <!--End of Tawk.to Script-->
</body>
</html>