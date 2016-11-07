
<?php
/* 
 * Declaració de les variables
 */
$GLOBALS['$versio']="30/09/2015";
$GLOBALS['$crlf'] = chr(13).chr(10);
$crlf = $GLOBALS['$crlf'];

/* COlors */
$GLOBALS['red']='#ff0000';

// Base de dades
$GLOBALS['$nivellderegistre'] = 3; // 0 : res, 1 : actuvitat important, 2 : Planes visitades, 3 : TOT

//$GLOBALS['$smptserver'] = "ssl://authsmtp.eteum.com"; // servidor smpt pel e-mail
$GLOBALS['$claumestra'] = "12345"; // password smtp perl e-mail
$GLOBALS['$smptserver'] = "172.20.8.2"; // servidor smpt pel e-mail
$GLOBALS['$smtpuser'] = ""; // usuari smtp perl e-mail
$GLOBALS['$smtpass'] = ""; // password smtp perl e-mail
$GLOBALS['$email_support'] = "support@tct.es"; // password smtp perl e-mail
$GLOBALS['$email_web'] = "support@tct.es"; // password smtp perl e-mail
$GLOBALS['$serialize'] = "????"; // 
$GLOBALS['$emailimport'] = 'support@tct.es';
$GLOBALS['$emailexport'] = 'support@tct.es';

$GLOBALS['$email_web'] = 'customerservice@tct.es'; // password smtp perl e-mail
$GLOBALS['$emailimport'] = 'importservice@tct.es';
$GLOBALS['$emailexport'] = 'exportservice@tct.es';

$GLOBALS['logoemail'] = '<img style="margin-bottom: 50px;" title="TCT, SL" alt="TCT, SL" src="http://www.tct.es/logo/MASTER%20LOGO%20LINEA%2015.jpg" align="top"><br>';

$GLOBALS['$Kcrlf'] = chr(0x0D).chr(0x0A);

$GLOBALS['$ajquery'] = "";
$GLOBALS['$onestara'] = "local";
$GLOBALS['$admitase'] = "";
$GLOBALS['$bl'] = "";
$GLOBALS['$xweb'] = "";
$GLOBALS['$mostraerrors'] = 1;

$elos = PHP_OS;
$hostname = gethostname();

if (strtoupper(substr($elos, 0, 3)) === 'WIN') {
    $GLOBALS['$onestara'] = "local";
} else {
    if ($hostname === 'potetu'){
        $GLOBALS['$onestara'] = "potetu";
    }
    else{
       $GLOBALS['$onestara'] = "web";
    }
}

$onestaara = $GLOBALS['$onestara'];

//$onestaara = "potetu";

switch ($onestaara){
    case "web":
        //web
        $GLOBALS['$mostraerrors'] = 0;
        $GLOBALS['$ruta']="www.tct.es"; // Nom del domini
        $GLOBALS['$domain']="www.tct.es"; // Nom del domini
        $GLOBALS['$pbase_host']="localhost"; // Nom del host
        $GLOBALS['$pbase_nom']="siscon"; // Nom de la Base de dades
        $GLOBALS['$pbase_user']="root"; // usuari de la Base de dades
        $GLOBALS['$pbase_clau']="nocsis"; // clau del usuario de la BBDD
        $GLOBALS['$pdir_import']="tmp/"; // directori d'importació de dades
        $GLOBALS['$motorsmtp']="1"; // motor smtp amb SSL local
        $GLOBALS['$dirdocsupload'] = "/home/COPIES/DOC_SIS/DOCS/UPLOAD/";
        $GLOBALS['$logos'] = "ALOGOS/";
        $GLOBALS['$dirdocs'] = "/home/COPIES/DOC_SIS/DOCS/";
        $GLOBALS['$admitase'] = "/home/COPIES/DOC_SIS/DOCS/admitase.pdf";
        $GLOBALS['$bl'] = "/home/COPIES/DOC_SIS/DOCS/bl_web.pdf";
        $GLOBALS['$dirateamil'] = '/home/comu/general/scx/api_tct/ATTACH/';
        $GLOBALS['$xweb'] = "/home/comu/general/scx/xweb.dbf";
        
        break;
    case "local":
        $GLOBALS['$mostraerrors'] = 1;
        $GLOBALS['$ruta']="localhost/tctw"; // Nom del domini
        $GLOBALS['$domain']="localhost/tctw"; // Nom del domini
        $GLOBALS['$pbase_host']="172.20.9.44"; // Nom del host
//$GLOBALS['$pbase_host']="www.tct.es"; // Nom del host
        $GLOBALS['$pbase_nom']="siscon"; // Nom de la Base de dades
        $GLOBALS['$pbase_user']="root"; // usuari de la Base de dades
        $GLOBALS['$pbase_clau']="nocsis"; // clau del usuario de la BBDD
        $GLOBALS['$pdir_import']="tmp/"; // directori d'importació de dades
        $GLOBALS['$motorsmtp']="1"; // sense motor smtp local
        $GLOBALS['$dirdocsupload'] = "file:///T:/DOCS/UPLOAD/";
        $GLOBALS['$logos'] = "ALOGOS/";
        $GLOBALS['$dirdocs'] = 'file:///T:/DOCS/';
        $GLOBALS['$admitase'] = 'file:///T:/DOCS/admitase.pdf';
        $GLOBALS['$bl'] = 'file:///T:/DOCS/bl_web.pdf';
        $GLOBALS['$xweb'] = "file:///C:/SC9/xweb.dbf";
        $GLOBALS['$dirateamil'] = 'file:///S:/SCX/API_TCT/ATTACH/';
//        $GLOBALS['$smptserver'] = ""; // servidor smpt pel e-mail
        break;
    case "potetu":
        $GLOBALS['$mostraerrors'] = 1;
        $GLOBALS['$ruta']="http://localhost/WWW/tctw"; // Nom del domini
        $GLOBALS['$domain']="http://localhost/WWW/tctw/"; // Nom del domini
        $GLOBALS['$pbase_host']="localhost"; // Nom del host
//$GLOBALS['$pbase_host']="www.tct.es"; // Nom del host
        $GLOBALS['$pbase_nom']="siscon"; // Nom de la Base de dades
        $GLOBALS['$pbase_user']="root"; // usuari de la Base de dades
        $GLOBALS['$pbase_clau']="nocsis"; // clau del usuario de la BBDD
        $GLOBALS['$pdir_import']="tmp/"; // directori d'importació de dades
        $GLOBALS['$motorsmtp']="1"; // sense motor smtp local
        $GLOBALS['$dirdocsupload'] = "file:///T:/DOCS/UPLOAD/";
        $GLOBALS['$logos'] = "ALOGOS/";
        $GLOBALS['$dirdocs'] = 'file:///T:/DOCS/';
        $GLOBALS['$admitase'] = 'file:///T:/DOCS/admitase.pdf';
        $GLOBALS['$bl'] = 'file:///T:/DOCS/bl_web.pdf';
        $GLOBALS['$xweb'] = "file:///C:/SC9/xweb.dbf";
        $GLOBALS['$dirateamil'] = 'file:///S:/SCX/API_TCT/ATTACH/';
//        $GLOBALS['$smptserver'] = ""; // servidor smpt pel e-mail
        break;
    default :
        echo "<br/>ERROR DE LOCALIZACION : WEB / WINDOWS / UBUNTU<br/>";
        break;
}
$GLOBALS['$destiemail']="info@tct.es"; // on envia
$GLOBALS['$elsupport']="support@tct.es"; // on envia


$GLOBALS['$domain'] = "tct.es"; // el domini sense http://www.
$GLOBALS['$ample']="1000"; // amplada de la plana
$GLOBALS['$idioma']="ES"; // Idioma de la Web

$GLOBALS['$langles']=0; // Idioma de la Web

?>