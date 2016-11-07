<?php

include_once 'sempre.php';

$email = nohack($_REQUEST["email"]);
if (validateemail($email)) {
    
    include_once 'enviaemail.php';
    $eltema = texteweb('OK_SUBSCRIU_NEWS',1);
    $cos = texteweb('OK_SUBSCRIU_NEWS');
    $que = enviaemail($email,((isset($_SESSION['usr_nomuser']) && $_SESSION['usr_nomuser'])?$_SESSION['usr_nomuser']:$email),
            $eltema,$cos,html_entity_decode($cos),'',$GLOBALS['$email_web'],'TCT SL','TCT SL',$GLOBALS['$email_web'],'');
    if ($que){
        $_SESSION['missatge'] = ' <p>'.$que.'</p>';
    }
    else {
        $_SESSION['missatge'] = ' <p>'.(($langles)?'Email send.':'Email enviado.').'</p>';
        $_SESSION['missatge_literal'] = texteweb('TX_SUBSCRIU_NEWS');
        $_SESSION['missatge_dibuix'] = "fa-comment";
        $_SESSION['misatge_noborra'] = 1;
        $_SESSION['missatge_to_php'] = "index.php";
        $_SESSION['missatge_boto'] = "Ok";
        $_SESSION['missatge_notitol'] = 0;
    }
    saltaa('missatge.php');
}
else{
    // es bo i cal mirar i ja el tenim ...
    // SI no el tenim el guardo ...
    $emailErr = "Invalid email format"; 
    $_SESSION['missatge'] = ($langles)?'Invalid email.':'email incorrecto';
    $_SESSION['missatge_literal'] = ($langles)?'Try again.':'Int&eacute;ntelo de nuevo.';
    $_SESSION['missatge_to_php'] = "index.php";
    $_SESSION['missatge_dibuix'] = "fa-remove";
    $_SESSION['missatge_boto'] = "Ok";
    $_SESSION['missatge_notitol'] = 0;
    saltaa('missatge.php');
}
?>