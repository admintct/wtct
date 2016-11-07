<?php
    include_once 'sempre.php';
    include_once 'enviaemail.php';
    $cos = '<p>'.$_REQUEST['eldetall'].'</p></br><p>'.str_replace(chr(13),'</p><p>', $_REQUEST['message']).'</p>';
    $ptda = $_REQUEST['ptda'];
    $tema = $_REQUEST['eltitol'].', Ref. '.$ptda.' - '.$_SESSION['usr_nomcli'];
    if ($cos && $tema && $ptda){
        $proces = retvar('proces');
        $email_cc = $_SESSION['usr_email'];
        $nom_cc = $_SESSION['usr_nomuser'].' - '.$_SESSION['usr_nomcli'];
        $email_dequi = $GLOBALS['$emailimport'];
        $nom_dequi = $_SESSION['usr_nomuser'].' - '.$_SESSION['usr_nomcli'];
        $emailx = $GLOBALS['$emailexport'];
        $yourname = 'TCT SL';
        if ($proces == "CERTIFICAT"){
            trackweb('PETICION DE CERTIFICADO','CERTIFICATE REQUEST',$cos,$ptda,'E');
        }
        $que = enviaemail($emailx,$yourname,$tema,$cos,html_entity_decode($cos),"",$email_dequi,$nom_dequi,$nom_cc,$email_cc);
        if ($que){
            $_SESSION['missatge'] = $que;
        }
        else{
            // tot ok
            $_SESSION['missatge'] = (($langles)?'email send.':'email enviado.');
        }
        $_SESSION['misatge_noborra'] = '*';
        //         enviaemail($aquin,$nomaqui="TCT Web User",$subjecte="MAIL FROM TCT",$elhtml="MAIL FROM TCT",$eltxte="MAIL FROM TCT",$elsadjunts="",$efrom="info@tct.es",$nomfrom="TCT SL"){
        saltaa('ptda_export.php?siscon_param='.$ptda);
    }
    else{
        saltaa('export_my_bookings.php');
    }
?>