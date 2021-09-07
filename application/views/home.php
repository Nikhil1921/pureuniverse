<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="banner-area content-top-heading text-normal heading-weight-600">
    <div id="bootcarousel" class="carousel slide animate_text" data-ride="carousel">
        <div class="carousel-inner text-light">
            <div class="item active">
               <video width="100%" autoplay="" loop>
                  <source src="assets/video/slider-finl.mp4" type="" >
               </video>
            </div>
            <!-- <div class="item">
                <div class="">
                    <?= img('assets/img/banner/29.jpeg') ?> 
                </div>
            </div> -->
        </div>
        <!-- <a class="left carousel-control shadow" href="#bootcarousel" data-slide="prev">
            <i class="fa fa-angle-left"></i>
            <span class="sr-only">Previous</span>
        </a>
        <a class="right carousel-control shadow" href="#bootcarousel" data-slide="next">
            <i class="fa fa-angle-right"></i>
            <span class="sr-only">Next</span>
        </a> -->
    </div>
</div>
<div class="about-area default-padding">
   <div class="container">
      <div class="row">
         <div class="about-info">
            <div class="col-md-6 thumb">
                <?= img('assets/img/about.jpg') ?> 
            </div>
            <div class="col-md-6 info">
               <h5>Introduction</h5>
               <h2>Welcome to the Pure Universe</h2>
               <h4>IMVS (Inner Moral Value System) is the foundation of ethical and moral education.</h4>
               <p>
                  Real education is what enriches students with honesty, compassion, patience, and a sense of responsibility. 
               </p>
               <p>
                  We can stoutly say that people with tons of degrees and many recognitions will still be left far behind the people enriched with values. People with values will achieve more than what people with only academics knowledge has achieved in their life, Ever! 
               </p>
               <a href="<?= base_url('about') ?>" class="btn btn-dark border btn-md">Read More</a>
            </div>
         </div>
         <div class="seperator col-md-12">
            <span class="border"></span>
         </div>
      </div>
   </div>
</div>
<div class="testimonials-area carousel-shadow default-padding bg-dark text-light">
   <div class="container">
      <div class="row">
         <div class="site-heading text-center">
            <div class="col-md-12 ">
               <h2>WHY IMVS?</h2>
               <p>
                  We are getting in touch with many  universities, and renowned companies around the globe, and we are receiving great responses from them because all of them are looking for honest and sincere students/employees.
               </p>
               <p>
                  IMVS certification will help our child a lot, and it will bring out the purity of their heart. Along with that, this certification will create a different and discrete presence wherever the person.
               </p>
            </div>
         </div>
      </div>
      <div class="row">
         <div class="col-md-12">
            <div class="clients-review-carousel owl-carousel owl-theme">
               <div class="item">
                  <div class="col-md-12 info">
                     <p>“Oh, dear! Even the sun fades in the light of truth.”</p>
                  </div>
               </div>
               <div class="item">
                  <div class="col-md-12 info">
                     <p>
                        “Universities are turning out highly skilled barbarians because we don’t provide a framework of values to young people, who more and more are searching for it.”
                     </p>
                     <h4>– Steven Muller, President, Johns Hopkins University</h4>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
<div class="wcs-area bg-dark text-light">
   <div class="container-full">
      <div class="row">
         <div class="col-md-6 thumb bg-cover" style="background-image: url(<?= base_url('assets/img/banner/16.jpg') ?>);"></div>
         <div class="col-md-6 content">
            <div class="site-heading text-left">
               <h2>GOALS OF IMVs</h2>
            </div>
            <div class="item">
               <div class="icon">
                  <i><?= img('assets/img/icon/mision.png') ?></i>
               </div>
               <div class="info goal-info">
                  <p>As the name suggests - Inner Moral Value System, We at IMVS are here to evaluate how the person make choices based on different situations in  life.</p>
                  <br>
                  <h4>
                     Our goal is to develop the 6 Cs:
                  </h4>
                  <ul>
                     <li>
                        <span>★ Character</span>
                     </li>
                     <li>
                        <span>★ Conviction</span>
                     </li>
                     <li>
                        <span>★ Courage</span> 
                     </li>
                     <li>
                        <span>★ Commitment</span>
                     </li>
                     <li>
                        <span>★ Courtesy</span>
                     </li>
                     <li>
                        <span>★ Competence</span>
                     </li>
                  </ul>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
<div id="featured-courses" class="featured-courses-area left-details default-padding">
   <div class="container">
      <div class="row">
         <div class="item">
            <div class="col-md-5">
               <div>
                   <?= img(['src' => 'assets/img/courses/f1.jpg', 'height' => '720']) ?>
               </div>
            </div>
            <div class="col-md-7 info site-heading text-left tab-pane" >
               <h2>“The first duty of a university is to teach wisdom, not trade; character, not technicalities.” - Winston Churchill</h2>
               <p>
                  We want to minimize the gap between today’s education system and reality. 
               </p>
               <p>To  on the path of perfection, you must have to give an online exam( IMVS).</p>
               <div class="info title">
                  <div class="table-responsive">
                     <table class="table table-striped">
                        <thead>
                           <tr>
                              <th>AGE GROUP</th>
                              <th>EXAM NAME</th>
                              <th>DURATION</th>
                           </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($cats as $cat): ?>
                            <tr>
                              <td>Age <?= $cat['age']; ?> years</td>
                              <td><?= $cat['cat_name']; ?></td>
                              <td><?= $cat['time_duration']; ?> Minutes</td>
                            </tr>
                            <?php endforeach ?>
                        </tbody>
                     </table>
                  </div>
               </div>
               <div class="info">
                  <h4>We will conduct a multiple-choice examination. It will help to evaluate and develope the life skills. </h4>
                  <ul>
                     <li>
                        <i class="fas fa-check-double"></i> 
                        <span>Choosing truth over anything</span>
                     </li>
                     <li>
                        <i class="fas fa-check-double"></i> 
                        <span>The importance of honesty in life</span>
                     </li>
                     <li>
                        <i class="fas fa-check-double"></i> 
                        <span>How the attitude towards life can change everything</span> 
                     </li>
                     <li>
                        <i class="fas fa-check-double"></i> 
                        <span>How your actions define your character</span>
                     </li>
                     <li>
                        <i class="fas fa-check-double"></i> 
                        <span>Having a new perspective. For example - What are the other choices we have than those fixed in our minds?</span>
                     </li>
                  </ul>
                  <a href="#register-form" class="btn btn-theme effect btn-md popup-with-form" data-animation="animated slideInUp">Register Now</a>  
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
<?php if($this->input->server('HTTP_HOST') != 'localhost'): ?>
<div class="">
   <div class="container">
      <div class="col-md-12 info site-heading text-center tab-pane" >
         <h2 style="font-size: 45px;">The Words From Eminent Human</h2>
      </div>
      <div class="item col-sm-4">
         <iframe width="100%" height="300" src="https://www.youtube.com/embed/k8t0Z924iNE" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
      </div>
      <div class="item col-sm-4">
         <iframe width="100%" height="300" src="https://www.youtube.com/embed/MBUR7qls7DY" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
      </div>
      <div class="item col-sm-4">
         <iframe width="100%" height="300" src="https://www.youtube.com/embed/NmRBMlwAi7Y" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
      </div>
      <div class="item col-sm-4">
         <iframe width="100%" height="300" src="https://youtube.com/embed/2jJRmPv-sp0" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
      </div>
      <div class="item col-sm-4">
         <iframe width="100%" height="300" src="https://www.youtube.com/embed/-LhrG77X2dE" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
      </div>
   </div>
</div>
<?php endif ?>