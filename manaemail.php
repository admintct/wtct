<?php
    include_once 'sempre.php';
    include_once 'enviaemail.php';
    
    if(isset($_REQUEST['name']) && isset($_REQUEST['email']) && $_REQUEST['name'] && $_REQUEST['email']){
        $nom_cc = "";
        $email_cc = "";
        $misatgepost = ((isset($_REQUEST['$misatgepost']))?texteweb($_REQUEST['$misatgepost'],1):'');
        $email_dequi = $GLOBALS['$email_web'];
        $nom_dequi = "TCT SL";
        $emailx = (isset($_REQUEST['$email']))?nohack($_REQUEST['$email']):$_SESSION['usr_email'];
        $yourname = (isset($_REQUEST['name']))?nohack($_REQUEST['name']):$_SESSION['usr_nomuser'];
        $tema = nohack($_REQUEST['subject']).((hies())?' - '.$_SESSION['usr_nomcli']:'');
        $cos = str_replace(chr(13),'</br>',nohack($_REQUEST['message']));
        $aqui = "";
        if (isset($_REQUEST['aqui']) && $_REQUEST['aqui']){
            $aqui = strtoupper($_REQUEST['aqui']);
            switch ($aqui) {
                case 'TCT':
                    $email_cc = $emailx;
                    $nom_cc = $yourname;
                    $email_dequi = $GLOBALS['$email_web'];
                    $nom_dequi = "TCT - WEB";
                    $emailx = $GLOBALS['$email_web'];
                    $yourname = 'TCT SL';
                    break;
                case 'EXPORT':
                    $email_cc = $emailx;
                    $nom_cc = $yourname;
                    $email_dequi = $GLOBALS['$email_web'];
                    $nom_dequi = "TCT - WEB";
                    $emailx = $GLOBALS['$email_web'];
                    $yourname = 'TCT SL';
                    $contmp = conexioi();
                    $loque = 'SELECT nom, diremail, web_export_trafic FROM usuaris WHERE web_export_trafic';
                    $fcons = mysqli_query($contmp,$loque);
                    $n = 0;
                    while ($fmail = mysqli_fetch_array($fcons)) {
                        if ($n == 0){
                            $emailx = "";
                            $yourname = "";
                        }
                        $emailx .= trim($fmail['diremail'])."|";
                        $yourname .= trim($fmail['nom'])."|";
                    }
                    $_SESSION['missatge_to_php'] = 'tanca.php';
                    break;
                default:
                    $email_cc = $emailx;
                    $nom_cc = $yourname;
                    $email_dequi = $GLOBALS['$email_web'];
                    $nom_dequi = "TCT - WEB";
                    $emailx = $GLOBALS['$email_web'];
                    $yourname = 'TCT SL';
                    break;
            }
        }
        include_once 'enviaemail.php';
        $que = enviaemail($emailx,$yourname,$tema,$cos,html_entity_decode($cos),"",$email_dequi,$nom_dequi,$nom_cc,$email_cc);
        if ($que){
            $_SESSION['missatge'] = $que;
        }
        else{
            // tot ok
            $_SESSION['missatge'] = (isset($_REQUEST['misatgepost']))?nohack($_REQUEST['misatgepost']):(($langles)?'email send.':'email enviado.');
        }
//         enviaemail($aquin,$nomaqui="TCT Web User",$subjecte="MAIL FROM TCT",$elhtml="MAIL FROM TCT",$eltxte="MAIL FROM TCT",$elsadjunts="",$efrom="info@tct.es",$nomfrom="TCT SL"){
        saltaa('missatge.php');
    }
    else{
//        saltaa('index.php');
    }
?>