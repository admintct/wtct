<?php $langles = $GLOBALS['$langles']; ?>
<!-- FOOTER -->
<footer>
    <div class="container peu-abaix">
        <div class="row">
            <?php 
                include 'breaking_news.php'; 
                include 'subscriu.php'; 
                include 'infoutil.php';
            ?>
            <div class="col-sm-3 footer-box wow fadeInDown">
                <h4><?php echo (($langles)?'Contact Us':'Cont&aacute;ctenos'); ?></h4>
                <div class="footer-box-text footer-box-text-contact">
                    <p><i class="fa fa-map-marker"></i><?php echo (($langles)?'Address':'Direcci&oacute;n'); ?> : Carrer de l'Atlàntic, 112 - 120 (Z.A.L) 08040 - Barcelona, Spain</p>
                    <p><i class="fa fa-phone"></i><?php echo (($langles)?'Phone':'Tel&eacute;fono'); ?>: +34 93 268 40 25</p>
                    <p><i class="fa fa-envelope"></i> Email: <a href="contact.php">customerservice@tct.es</a></p>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12 wow fadeIn">
                <div class="footer-border"></div>
            </div>
        </div>
        <div class="row">
            <?php
                include 'legalfeed.php';
                include 'socialfeed.php';
            ?>
        </div>
    </div>
</footer>
