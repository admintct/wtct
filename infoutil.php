<?php
    $langles = $GLOBALS['$langles'];
    echo '<div class="col-sm-3 footer-box wow fadeInUp">';
    echo '<h4>'.(($langles)?'Useful information':'Informaci&oacute;n &Uacute;til').'</h4>';
    echo '<div class="footer-box-text footer-box-text-subscribe">';
        echo '<p><a href="sitemap.php">'.(($langles)?'Sitemap':'Mapa del sitio').'</a></p>';
        echo '<p><a href="links.php">'.(($langles)?'Links of interest':'Enlaces de interés').'</a></p>';
        echo '<p><a href="aboutus.php">'.(($langles)?'Working Time & Holidays':'Horarios y Festivos').'</a></p>';
//        echo '<p><a href="incoterms.php">Incoterms</a></p>';
        echo '<p><a href="cntrsize.php">CNTRs</a> - <a href="incoterms.php">Incoterms</a></p>';
        echo '<p><a href="distancia.php">'.(($langles)?'Distance calculation':'Cálculo de distancias').'</a></p>';
    echo '</div>';
    echo '</div>';
?>