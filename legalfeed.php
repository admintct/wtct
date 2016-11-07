<?php
    $langles = $GLOBALS['$langles'];
    echo '<div class="col-sm-7 footer-copyright wow fadeIn">';
    echo '<p>2015-'.date('Y').' &reg; TCT SL - <a href="notalegal.php">'.(($langles)?'Legal Notes':'Cl&aacute;usulas legales').'</a> - '.
            '<a href="cookies.php">Cookies</a> - '.
            '<a href="aboutus.php">'.(($langles)?'About us':'Quienes somos').'</a> '.
            '- <a href="mailto:support@tct.es?Subject='.(($langles)?'Site support':'Soporte de la web').'">'.(($langles)?'Site support':'Soporte de la web').'</a> '.
            '- <a href="contact.php">'.(($langles)?'Contact us':'Cont&aacute;ctenos').'</a></p>';
    echo '</div>';
?>
