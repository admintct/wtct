<?php

/* 
 * Control se sortida
 */
include_once 'sempre.php';

guardaquefan($_SERVER['HTTP_REFERER'],"LOGOUT",$_SESSION['usr_usuari'],""); // Guardem la entrada

$_SESSION['r_login'] = $_SESSION['r_pass1']= $_SESSION['r_pass2']= $_SESSION['r_email'] = $_SESSION['r_name'] = '';
$_SESSION['r_empre'] = $_SESSION['r_tel']= $_SESSION['r_adreca']= $_SESSION['r_notes'] = '';

$_SESSION['usr_codi'] = '';
$_SESSION['usr_usuari'] = '';
$_SESSION['usr_email'] = '';
$_SESSION['usr_nomuser'] = '';
$_SESSION['usr_ip'] = '';
$_SESSION['usr_codcli'] = '';
$_SESSION['usr_nomcli'] = '';
$_SESSION['usr_codage'] = '';
$_SESSION['usr_nomage'] = '';
$_SESSION['usr_tct'] = '';
$_SESSION['usr_admin'] = '';
$_SESSION['usr_rollo'] = '';
$_SESSION['usr_adreca'] = '';
$_SESSION['usr_telefon'] = '';
$_SESSION['usr_clientoagent'] = '';
$_SESSION['usr_forwarder'] = '';
$_SESSION['n_import'] = 0;
$_SESSION['n_export'] = 0;

saltaa('login.php');

?>

