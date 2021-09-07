<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="contact-info-area default-padding">
    <div class="container">
        <div class="row">
            <div class="contact-info">
                <div class="site-heading text-center">
                    <h2>International Center</h2>
                </div>
                <div class="col-md-4 col-sm-4">
                    <div class="item">
                        <div class="icon">
                            <i class="fas fa-mobile-alt"></i>
                        </div>
                        <div class="info">
                            <h4>Call Us</h4>
                            <span><a href="tel:1800 202 2002">1800 202 2002</a></span>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-sm-4">
                    <div class="item">
                        <div class="icon">
                            <i class="fas fa-map-marker-alt"></i>
                        </div>
                        <div class="info">
                            <h4>Address</h4>
                            <span>711-Bentgrass dr aberdeen, MD 21001, USA</span>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-sm-4">
                    <div class="item">
                        <div class="icon">
                            <i class="fas fa-envelope"></i>
                        </div>
                        <div class="info">
                            <h4>Email Us</h4>
                            <span><a href="mailto:info@pureuniverse.live">info@pureuniverse.live</a></span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="contact-info">
                <div class="site-heading text-center">
                    <h2>Head Office Address</h2>
                </div>
                <div class="col-md-4 col-sm-4">
                    <div class="item">
                        <div class="icon">
                            <i class="fas fa-mobile-alt"></i>
                        </div>
                        <div class="info">
                            <h4>Call Us</h4>
                            <span><a href="tel:1800 202 2002">1800 202 2002</a></span>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-sm-4">
                    <div class="item">
                        <div class="icon">
                            <i class="fas fa-map-marker-alt"></i>
                        </div>
                        <div class="info">
                            <h4>Address</h4>
                            <span>Block-B, 02, Ville Paradise, Naukuchaital Nainital 263163, India</span>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-sm-4">
                    <div class="item">
                        <div class="icon">
                            <i class="fas fa-envelope"></i>
                        </div>
                        <div class="info">
                            <h4>Email Us</h4>
                            <span><a href="mailto:info@pureuniverse.live">info@pureuniverse.live</a></span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="contact-info">
                <div class="site-heading text-center">
                    <h2>Regional  Head Office</h2>
                </div>
                <div class="col-md-4 col-sm-4">
                    <div class="item">
                        <div class="icon">
                            <i class="fas fa-mobile-alt"></i>
                        </div>
                        <div class="info">
                            <h4>Call Us</h4>
                            <span><a href="tel:1800 202 2002">1800 202 2002</a></span>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-sm-4">
                    <div class="item">
                        <div class="icon">
                            <i class="fas fa-map-marker-alt"></i>
                        </div>
                        <div class="info">
                            <h4>Address</h4>
                            <span>Block-A, 602-603, Shilp Aaron, Opposit 'ARMIEDA', Sindhubhavan Road, Bodakdev, Ahmedabad.380 054.</span>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-sm-4">
                    <div class="item">
                        <div class="icon">
                            <i class="fas fa-envelope"></i>
                        </div>
                        <div class="info">
                            <h4>Email Us</h4>
                            <span><a href="mailto:info@pureuniverse.live">info@pureuniverse.live</a></span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="seperator col-md-12">
                <span class="border"></span>
            </div>
            <div class="maps-form">
                <div class="col-md-6 maps">
                    <h3>Our Location</h3>
                    <div class="google-maps">
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3671.5801514494165!2d72.50723031444257!3d23.03918292148967!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x395e9b4f44c998cb%3A0x8afafa525cf69145!2sShilp%20Aaron!5e0!3m2!1sen!2sin!4v1625472411637!5m2!1sen!2sin"loading="lazy"></iframe>
                    </div>
                </div>
                <div class="col-md-6 form">
                    <div class="heading">
                        <h3>Contact Us</h3>
                        <p>
                            Want to get in touch ? We would love to hear from you. here's how you can reach us...
                        </p>
                    </div>
                    <form action="" method="POST" class="contact-form">
                        <div class="col-md-12">
                            <div class="row">
                                <div class="form-group">
                                    <input class="form-control" id="name" name="name" placeholder="Name" type="text" value="<?= $user['name'] ?>">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="row">
                                <div class="form-group">
                                    <input class="form-control" id="email" name="email" placeholder="Email*" type="email" value="<?= $user['email'] ?>">
                                    <span class="alert-error"></span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="row">
                                <div class="form-group">
                                    <input class="form-control" id="phone" name="phone" placeholder="Phone" type="text" value="<?= $user['mobile'] ?>">
                                    <span class="alert-error"></span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="row">
                                <div class="form-group comments">
                                    <textarea class="form-control" id="comments" name="comments" placeholder="Tell Me About Courses *"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="row">
                                <button type="submit">
                                Send Message <i class="fa fa-paper-plane"></i>
                                </button>
                            </div>
                        </div>
                        <div class="col-md-12 alert-notification">
                            <div id="message" class="alert-msg"></div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>