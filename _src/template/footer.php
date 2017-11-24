    <!-- footer -->

    <footer class="footer" role="contentinfo">

      <?php
      $currentLanguage  = pll_current_language('slug');
      if($currentLanguage == 'en') { ?>
        <div class="swip-footer">
          <div class="container">
            <h2>Are you curious?</h2>
            <p class="sub-title">
              Join us in our network, discover exciting projects and share your ideas:
            </p>
            <div class="network-button">
              <a class="signup2" data-toggle="modal" data-target="#modal-signup" href="#">JOIN THE NETWORK</a>            
            </div>
            <div class="col25 logo-col">
              <div class="footer-logo">
                <div class="logo pull-left">
                  <a href="<?php echo home_url(); ?>">
                    <img src="<?php bloginfo('template_directory') ?>/img/Logo_horizontal_white_small.png" alt="">
                  </a>
                </div>
              </div>
            </div>
            <div class="col25 left-col">
            <?php wp_nav_menu(array('menu'=>'Footer menu EN')); ?>
            </div>
            <div class="col25 middle-col">
              <div class="community">
                <h5>Community</h5>
                <ul class="reg-ul">
                  <li>
                    <a class="login" data-toggle="modal" data-target="#modal-login"  href="#">Login</a>
                  </li>
                  <li>
                    <a class="signup1" data-toggle="modal" data-target="#modal-signup" href="#">Sign up</a>
                  </li>
                </ul>
                <?php wp_nav_menu(array('menu'=>'Footer menu3 EN')); ?>
              </div>
            </div>
              <div class="col25 right-col">
                <div class="legal">
                  <h5>Legal</h5>
                  <?php wp_nav_menu(array('menu'=>'Footer menu4 EN')); ?>
                </div>
              </div>
            </div>
        </div>
      <?php }else{ ?>

        <div class="swip-footer">
          <div class="container">
            <h2><?php pll_e('Are you curious?') ?></h2>
            <p class="sub-title">
              Doe mee met ons netwerk, ontdek spannende projecten en deel uw ideeën:
            </p>
            <div class="network-button">
                <a class="signup2" data-toggle="modal" data-target="#modal-signup" href="#">KOM BIJ HET NETWERK</a>              
            </div>
            <div class="col25 logo-col">
              <div class="footer-logo">
                <div class="logo pull-left">
                  <a href="<?php echo home_url(); ?>">
                    <img src="<?php bloginfo('template_directory') ?>/img/Logo_horizontal_white_small.png" alt="">
                  </a>
                </div>
              </div>
            </div>
            <div class="col25 left-col">
            <?php wp_nav_menu(array('menu'=>'Footer menu DE')); ?>
            </div>
            <div class="col25 middle-col">
              <div class="community">
                <h5>Gemeenschap</h5>
                <ul class="reg-ul">
                  <li>
                    <a class="login" data-toggle="modal" data-target="#modal-login"  href="#">ANMELDEN</a>
                  </li>
                  <li>
                    <a class="signup1" data-toggle="modal" data-target="#modal-signup" href="#">REGISTRIEREN</a>
                  </li>
                </ul>
                <?php wp_nav_menu(array('menu'=>'Footer menu3 DE')); ?>
              </div>
            </div>
              <div class="col25 right-col">
                <div class="legal">
                  <h5>Legaal</h5>
                  <?php wp_nav_menu(array('menu'=>'Footer menu4 DE')); ?>
                </div>
              </div>
            </div>
        </div>


    <?php	} ?>

    <?php
    $currentLanguage  = pll_current_language('slug');
    if($currentLanguage == 'en') { ?>
      <p class="copyright">
        Copyright &copy; <?php echo date('Y'); ?> swip.world Inc. All rights reserved.
      </p>
    <?php }else{ ?>
      <p class="copyright">
        Auteursrechten &copy; <?php echo date('Y'); ?> swip.world Inc. Alle rechten voorbehouden.
      </p>
  <?php	} ?>

    </footer>
    <!-- /footer -->

    </div>
    <!-- /wrapper -->

    <?php wp_footer(); ?>
    <script type="text/javascript">
      jQuery(document).ready(function(){
        $('#modal-signup, #modal-login').on('show.bs.modal', function (e) {
          $('.main, .wr, footer').addClass('blur');
        });
        $('#modal-signup, #modal-login').on('hide.bs.modal', function (e) {
          $('.main, .wr, footer').removeClass('blur');
        });
      });

      jQuery(window).load(function(){
        var cssLink = document.createElement("link");
        cssLink.href = "/style.css";
        cssLink.rel = "stylesheet";
        cssLink.type = "text/css";
        frames['frameSingup'].document.body.appendChild(cssLink);
      })

    </script>
  </body>
</html>





