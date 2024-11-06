<!DOCTYPE html>
<html lang="en">

<!-- Mirrored from htmlbeans.com/html/schon/contact-us2.html by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 16 Apr 2023 13:56:51 GMT -->
<head>
  <!-- set the encoding of your site -->
  <meta charset="utf-8">
  <!-- set the viewport width and initial-scale on mobile devices -->
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Contact Us</title>
  <?php
  $filepath = realpath(dirname(__FILE__));
  include $filepath . '/web-links.php';
  ?>
</head>
<body>
  <!-- main container of all the page elements -->
  <div id="wrapper">
    <!-- Page Loader -->
    <div id="pre-loader" class="loader-container">
      <div class="loader">
        <img src="images/svg/rings.svg" alt="loader">
      </div>
    </div>
    <div class="w1">
      <!-- mt header style4 start here -->
    <?include $filepath . '/navbar.php';?>
      <!-- mt header style4 end here -->
      <!-- mt side menu start here -->
      <div class="mt-side-menu">
        <!-- mt holder start here -->
        <div class="mt-holder">
          <a href="#" class="side-close"><span></span><span></span></a>
          <strong class="mt-side-title">MY ACCOUNT</strong>
          <!-- mt side widget start here -->
          <div class="mt-side-widget">
            <header>
              <span class="mt-side-subtitle">SIGN IN</span>
              <p>Welcome back! Sign in to Your Account</p>
            </header>
            <form action="#">
              <fieldset>
                <input type="text" placeholder="Username or email address" class="input">
                <input type="password" placeholder="Password" class="input">
                <div class="box">
                  <span class="left"><input class="checkbox" type="checkbox" id="check1"><label for="check1">Remember Me</label></span>
                  <a href="#" class="help">Help?</a>
                </div>
                <button type="submit" class="btn-type1">Login</button>
              </fieldset>
            </form>
          </div>
          <!-- mt side widget end here -->
          <div class="or-divider"><span class="txt">or</span></div>
          <!-- mt side widget start here -->
          <div class="mt-side-widget">
            <header>
              <span class="mt-side-subtitle">CREATE NEW ACCOUNT</span>
              <p>Create your very own account</p>
            </header>
            <form action="#">
              <fieldset>
                <input type="text" placeholder="Username or email address" class="input">
                <button type="submit" class="btn-type1">Register</button>
              </fieldset>
            </form>
          </div>
          <!-- mt side widget end here -->
        </div>
        <!-- mt holder end here -->
      </div><!-- mt side menu end here -->
      <!-- mt search popup start here -->
      <div class="mt-search-popup">
        <div class="mt-holder">
          <a href="#" class="search-close"><span></span><span></span></a>
          <div class="mt-frame">
            <form action="#">
              <fieldset>
                <input type="text" placeholder="Search...">
                <span class="icon-microphone"></span>
                <button class="icon-magnifier" type="submit"></button>
              </fieldset>
            </form>
          </div>
        </div>
      </div><!-- mt search popup end here -->
      <!-- Main of the Page -->
      <main id="mt-main">
        <!-- Mt Contact Banner of the Page -->
        <section class="mt-contact-banner wow fadeInUp" data-wow-delay="0.4s" style="background-image: url(images/img06.jpg);">
          <div class="container">
            <div class="row">
              <div class="col-xs-12 text-center">
                <h1>CONTACT</h1>
                <nav class="breadcrumbs">
                  <ul class="list-unstyled">
                    <li><a href="index.html">Home <i class="fa fa-angle-right"></i></a></li>
                    <li><a href="#">Contact</a></li>
                  </ul>
                </nav>
              </div>
            </div>
          </div>
        </section><!-- Mt Contact Banner of the Page -->
        <!-- Mt Contact Detail of the Page -->
        <section class="mt-contact-detail content-info wow fadeInUp" data-wow-delay="0.4s">
          <div class="container-fluid">
            <div class="row">
              <div class="col-xs-12 col-sm-8">
                <div class="txt-wrap">
                  <h2>schön. chair maker</h2>
                  <p>Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut <br>enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut <br>aliquip ex ea commodo consequat. </p>
                </div>
                <ul class="list-unstyled contact-txt">
                  <li>
                    <strong>Address</strong>
                    <address>Suite 18B, 148 Connaught Road <br>Central <br>New Yankee</address>
                  </li>
                  <li>
                    <strong>Phone</strong>
                    <a href="#">+1 (555) 333 22 11</a>
                  </li>
                  <li>
                    <strong>E_mail</strong>
                    <a href="#">info@schon.chair</a>
                  </li>
                </ul>
              </div>
              <div class="col-xs-12 col-sm-4">
                <h2>Have a question?</h2>
                <!-- Contact Form of the Page -->
                <form action="#" class="contact-form">
                  <fieldset>
                    <input type="text" class="form-control" placeholder="Name">
                    <input type="email" class="form-control" placeholder="E-Mail">
                    <input type="text" class="form-control" placeholder="Subject">
                    <textarea class="form-control" placeholder="Message"></textarea>
                    <button class="btn-type3" type="submit">Send</button>
                  </fieldset>
                </form>
                <!-- Contact Form of the Page end -->
              </div>
            </div>
          </div>
        </section><!-- Mt Contact Detail of the Page end -->
        <!-- Mt Map Holder of the Page -->
        <div class="mt-map-holder wow fadeInUp" data-wow-delay="0.4s" data-lat="52.392363" data-lng="1.480408" data-zoom="8">
          <div class="map-logo">
            <a href="#"><img src="images/map-logo.png" alt="Schon"></a>
          </div>
        </div><!-- Mt Map Holder of the Page end -->
      </main>
      <!-- footer of the Page -->
      <footer id="mt-footer" class="montserrat style6 wow fadeInUp" data-wow-delay="0.4s">
        <!-- Footer Holder of the Page -->
        <div class="footer-holder">
          <div class="container">
            <div class="row">
              <nav class="col-xs-12 col-sm-8">
                <!-- Footer Nav of the Page -->
                <div class="nav-widget-1 f-nav">
                  <h3 class="f-widget-heading heading">PRODUCTS</h3>
                  <ul class="list-unstyled f-widget-nav">
                    <li><a href="#">All</a></li>
                    <li><a href="#">Chairs</a></li>
                    <li><a href="#">Sofas</a></li>
                    <li><a href="#">Living</a></li>
                    <li><a href="#">Bedroom</a></li>
                    <li><a href="#">Tables</a></li>
                    <li><a href="#">New</a></li>
                  </ul>
                </div>
                <!-- Footer Nav of the Page end -->
                <!-- Footer Nav of the Page -->
                <div class="nav-widget-1 f-nav">
                  <h3 class="f-widget-heading heading">COSTOMER</h3>
                  <ul class="list-unstyled f-widget-nav">
                    <li><a href="#">FAQ</a></li>
                    <li><a href="#">Support</a></li>
                    <li><a href="#">Repair Center</a></li>
                  </ul>
                </div>
                <!-- Footer Nav of the Page end -->
                <!-- Footer Nav of the Page -->
                <div class="nav-widget-1 f-nav">
                  <h3 class="f-widget-heading heading">PAGES</h3>
                  <ul class="list-unstyled f-widget-nav">
                    <li><a href="#">Home</a></li>
                    <li><a href="#">Contact</a></li>
                    <li><a href="#">Product</a></li>
                    <li><a href="#">About</a></li>
                    <li><a href="#">Terms</a></li>
                  </ul>
                </div>
                <!-- Footer Nav of the Page end -->
                <!-- Footer Nav of the Page -->
                <div class="nav-widget-1 f-nav">
                  <h3 class="f-widget-heading heading">SOCIALS</h3>
                  <ul class="list-unstyled f-widget-nav">
                    <li><a href="#">twitter</a></li>
                    <li><a href="#">facebook</a></li>
                    <li><a href="#">google+</a></li>
                    <li><a href="#">pinterest</a></li>
                  </ul>
                </div>
                <!-- Footer Nav of the Page end -->
              </nav>
              <div class="col-xs-12 col-sm-4 text-right">
                <!-- F Widget About of the Page -->
                <div class="f-widget-about">
                  <div class="logo">
                    <a href="#"><img src="images/logo2.png" alt="Schon"></a>
                  </div>
                  <ul class="list-unstyled address-list align-right">
                    <li><i class="fa fa-map-marker"></i><address>Suite 18B, 148 Connaught Road Central <br>New Yankee</address></li>
                    <li><i class="fa fa-phone"></i><a href="tel:15553332211">+1 (555) 333 22 11</a></li>
                    <li><i class="fa fa-envelope-o"></i><a href="mailto:&#105;&#110;&#102;&#111;&#064;&#115;&#099;&#104;&#111;&#110;&#046;&#099;&#104;&#097;&#105;&#114;">&#105;&#110;&#102;&#111;&#064;&#115;&#099;&#104;&#111;&#110;&#046;&#099;&#104;&#097;&#105;&#114;</a></li>
                  </ul>
                </div>
                <!-- F Widget About of the Page end -->
              </div>
            </div>
          </div>
        </div>
        <!-- Footer Holder of the Page end -->
        <!-- Footer area of the Page -->
        <div class="footer-area">
          <div class="container">
            <div class="row">
              <div class="col-xs-12 text-center">
                <div class="bank-card-2 align-center copy-right">
                  <img src="images/bank-card2.png" alt="bank-card">
                </div>
                <p>Copyright <a href="index.html">schön</a>. All right recerved</p>
              </div>
            </div>
          </div>
        </div>
        <!-- Footer area of the Page end -->
      </footer>
      <!-- footer of the Page end -->
    </div>
    <span id="back-top" class="fa fa-arrow-up"></span>
  </div>
  <!-- include jQuery -->
  <script src="js/jquery.js"></script>
  <!-- include jQuery -->
  <script src="js/plugins.js"></script>
  <!-- include jQuery -->
  <script src="js/jquery.main.js"></script>
  <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js"></script>
</body>

<!-- Mirrored from htmlbeans.com/html/schon/contact-us2.html by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 16 Apr 2023 13:56:52 GMT -->
</html>