<?php

function htmljavascript($quina="",$quevol=""){
    $quevol = "|".$quevol;
    // Sempre
    echo '<!-- Javascript -->'.$GLOBALS['$Kcrlf'];
    echo '<script src="assets/bootstrap/js/bootstrap.min.js"></script>';
    
    // News Scroll
    echo '<script src="assets/js/inewsticker.js"></script>';
    
    echo '<script src="assets/js/bootbox.min.js"></script>';
    if ($GLOBALS['$volgrid']){
        echo '<script src="assets/js/jquery.dataTables.min.js"></script>';
    }
    echo '<script src="assets/js/bootstrap-hover-dropdown.min.js"></script>';

    echo '<script src="assets/js/jquery-ui.js"></script>'; // Autocomplete & Jquery UI
    
    if (strpos($quevol,'wow')){echo '<script src="assets/js/wow.min.js"></script>';}
    echo '<script src="assets/js/retina-1.1.0.min.js"></script>';
    if ($GLOBALS['$elpopup']){
        echo '<script src="assets/js/jquery.magnific-popup.min.js"></script>';
    }
    if ($GLOBALS['$elslide']){
        echo '<script src="assets/js/jquery.backstretch.min.js"></script>';
        echo '<script src="assets/flexslider/jquery.flexslider-min.js"></script>';
    }
//** COMENTAT    echo '<script src="assets/js/jflickrfeed.min.js"></script>';
    if ($GLOBALS['$volmasonry']){
        echo '<script src="assets/js/masonry.pkgd.min.js"></script>';
    }
    if ($GLOBALS['$elgooglemaps']){
        echo '<script src="http://maps.google.com/maps/api/js?sensor=true"></script>';
    }
    echo '<script src="assets/js/jquery.ui.map.min.js"></script>';
    echo '<script src="assets/js/jquery.validate.min.js"></script>';
    switch ($quina) {
        case '???':
            break;
        default:
            echo '<script src="assets/js/scripts.js"></script>';
            break;
    }
    if (isset($_SESSION['missatge']) && ($_SESSION['missatge'])){
        if (isset($_SESSION['misatge_noborra']) && $_SESSION['misatge_noborra']){
            unset($_SESSION['misatge_noborra']);
        }
        else{
            echo '<script type="text/javascript">';
            $loque = nocrlf($_SESSION['missatge']);
            echo 'bootbox.alert("'.  str_replace('"', '\"', $loque).'");';
//            echo 'bootbox.alert("<style>.em_capca {backcolor:rgba(16,63,117,0.10);color=white;font-weight: bold;}</style><div class=\"em_capca\">asdasd</div>");';
            echo '</script>';
            unset($_SESSION['missatge']);
        }
    }
    echo '<script src="assets/js/social.js"></script>';
    echo $GLOBALS['$Kcrlf'];
}
?>