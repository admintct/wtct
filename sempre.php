<?php
    /* Declaracions a incloure SEMPRE a les planes */ 

    include_once 'lesvars.php';
    ini_set('display_errors', $GLOBALS['$mostraerrors']);
    // Per evitar que demani recarregar dades ..
    session_cache_limiter('private, must-revalidate');
    session_cache_expire(60);
    /// ***
    session_start();
    include_once 'milib.php';
    // Si es per usuaris loguejats i no està loguejat, salta al index.php
    $asda = isset($amblog);
    if ((isset($amblog) && ($amblog)) && ((! isset($_SESSION['usr_codi'])) || (empty($_SESSION['usr_codi'])) )) {
        $amblog = 0;
        saltaa('index.php');
    }
    if ((isset($ambcodusr) && ($ambcodusr)) && ((! isset($_SESSION['usr_codcli'])) || (empty($_SESSION['usr_codcli']))) && ((! isset($_SESSION['usr_codage'])) || (empty($_SESSION['usr_codage'])))) {
        if ($_SESSION['usr_tct'] != '1'){
            $ambcodusr = 0;
            saltaa('index.php');
        }
    }
    // Si es privada i no es usuari de TCT, salta al index.php
    if ((isset($GLOBALS['privada']) && $GLOBALS['privada']) && ((! isset($_SESSION['usr_tct'])) || (empty($_SESSION['usr_tct'])) )) {
        $GLOBALS['privada'] = 0;
        saltaa('index.php');
    }
    triaidioma();
    if (isset($_REQUEST['changelanguage'])){
        $_REQUEST['changelanguage'] = strtoupper($_REQUEST['changelanguage']);
        if ($_REQUEST['changelanguage'] != $GLOBALS['$idioma']){
            $cidioma = (($_REQUEST['changelanguage'] === "ES")?"ES":"EN");
            $GLOBALS['$idioma'] = $cidioma;
            $_SESSION['$idioma'] = $cidioma;
            setcookie("triaidioma", $cidioma,  time() + (10 * 365 * 24 * 60 * 60)); // posem la cookie per que no expiri
            triaidioma();
            
            include_once 'enviaemail.php';
/*            $a = enviaemail("sadftonitells@gmail.com","Tonet","Hola Xaval !",$elhtml="<html></html><head></head><body><b>Hola</b> xaval !</body></html>","Hola que tal","");
            if (! empty($a)){
                echo $a."<br>";
            } */
        }
    }
    esangles();
    $langles = $GLOBALS['$langles'];
    $crlf = $GLOBALS['$crlf'];
?>