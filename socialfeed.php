<?php
    echo '<div class="col-sm-5 footer-social wow fadeIn">';
    echo '<a title="Bookmark : <Ctrl><D>" href="#" id="bookmark-this"><i id="bookmark-this" class="fa fa-star"></i></a>';
    // Linked in
    // echo '<a href="#"><i class="fa fa-linkedin"></i></a>';
    // Google +
    echo '<a href="https://plus.google.com/+TctES" target="_blank" title="Google+"><i class="fa fa-google"></i></a>';
    // YouTube
    echo '<a href="https://www.youtube.com/c/TctES" target="_blank" title="YouTube"><i class="fa fa-youtube"></i></a>';
    // Twitter *******
    // echo '<a href="#"><i class="fa fa-twitter"></i></a>';
    // Per Facebook :*******
    // echo '<a href="#"><i class="fa fa-facebook"></i></a>';
    // Per Skype ********
    // echo '<a href="#"><i class="fa fa-skype"></i></a>'; 
    // Per email ....
    echo '<a title="email" href="mailto:?subject='.(($langles)?'I wanted you to see this site !':'Quiero compartir contigo esta pàgina !').'&amp;body='.(($langles)?'Please, check out this site':'Por vafor, mira esta pàgina : ').' http://www.tct.es." title="Share by Email"><i class="fa fa-envelope"></i></a>';
    echo '</div>';
?>
