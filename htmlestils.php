
<?php

function htmlestils($quina,$elwow=1,$elslide=0,$elpopup=0,$elgooglemaps=0,$volcaptcha=0,$volgrid=0,$volmasonry=0){
//    echo '<script src="assets/js/jquery-1.11.3.min.js"></script>';
    echo '<script src="assets/js/jquery-2.2.0.min.js"></script>';
    
    $GLOBALS['$elwow'] = $elwow;
    $GLOBALS['$elslide'] = $elslide;
    $GLOBALS['$elpopup'] = $elpopup;
    $GLOBALS['$elgooglemaps'] = $elgooglemaps;
    $GLOBALS['$volcaptcha'] = $volcaptcha;
    $GLOBALS['$volgrid'] = $volgrid;
    $GLOBALS['$volmasonry'] = $volmasonry;
    $GLOBALS['def_vas_javascript'] = "";
    
    if ($volcaptcha){
        echo "<script src='https://www.google.com/recaptcha/api.js'></script>";
    }
    $GLOBALS['def_vas_javascript'] = '<input type="hidden" id="elwow" value='.$elwow.'>'.
            '<input type="hidden" id="elslide" value='.$elslide.'></input>'.
            '<input type="hidden" id="elpopup" value='.$elpopup.'></input>'.
            '<input type="hidden" id="elgooglemaps" value='.$elgooglemaps.'></input>'.
            '<input type="hidden" id="vollagrid" value='.$volgrid.'></input>'.
            '<input type="hidden" id="volmasonry" value='.$volmasonry.'></input>'.
            (isset($_REQUEST['siscon_param']) && ($_REQUEST['siscon_param'])?'<input type="hidden" id="siscon_param" value='.$_REQUEST['siscon_param'].'></input>':'');
    
    echo '<!-- CSS -->'.$GLOBALS['$Kcrlf'];
    echo '<link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Open+Sans:400italic,400">';
    echo '<link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Droid+Sans">';
    echo '<link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Lobster">';
    echo '<link rel="stylesheet" href="assets/bootstrap/css/bootstrap.css">'; // NECESARI
    echo '<link rel="stylesheet" href="assets/font-awesome/css/font-awesome.min.css">';
    echo '<link rel="stylesheet" href="assets/css/animate.css">';
    
    echo '<link rel="stylesheet" href="assets/css/jquery-ui.css">'; // Autocomplete
    
    if ($elpopup){
        echo '<link rel="stylesheet" href="assets/css/magnific-popup.css">';
    }
    if ($elslide){
        echo '<link rel="stylesheet" href="assets/flexslider/flexslider.css">';
    }
    if ($volgrid){
        ECHO '<link  rel="stylesheet" href="assets/css/jquery.dataTables.css">';
    }
    echo '<link rel="stylesheet" href="assets/css/form-elements.css">';
    echo '<link rel="stylesheet" href="assets/css/style.css">';
    echo '<link rel="stylesheet" href="assets/css/media-queries.css">';
    echo $GLOBALS['$Kcrlf'];
    //    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    //    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    echo '<!--[if lt IE 9]>'.$GLOBALS['$Kcrlf'];
        echo '<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>'.$GLOBALS['$Kcrlf'];
        echo '<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>'.$GLOBALS['$Kcrlf'];
    echo '<![endif]-->'.$GLOBALS['$Kcrlf'];

    echo '<!-- Favicon and touch icons -->'.$GLOBALS['$Kcrlf'];
    echo '<link rel="shortcut icon" href="assets/ico/favicon.ico">';
    echo '<link rel="apple-touch-icon-precomposed" sizes="144x144" href="assets/ico/apple-touch-icon-144-precomposed.png">';
    echo '<link rel="apple-touch-icon-precomposed" sizes="114x114" href="assets/ico/apple-touch-icon-114-precomposed.png">';
    echo '<link rel="apple-touch-icon-precomposed" sizes="72x72" href="assets/ico/apple-touch-icon-72-precomposed.png">';
    echo '<link rel="apple-touch-icon-precomposed" href="assets/ico/apple-touch-icon-57-precomposed.png">';
    
    switch ($quina) {
        case 'index':
            break;
        default:
            break;
    }
    echo $GLOBALS['$Kcrlf'];
}
?>