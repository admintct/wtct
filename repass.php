<?php

/* 
 * Solicitut de password nou
 */
include_once 'sempre.php';

if (isset($_REQUEST['email']) && isset($_REQUEST['email'])){
    // Mira si es un usuari bo ...
    $con = conexioi();
    $eluser = trim(nohack($_REQUEST['email']));
    $loque = "SELECT * FROM wusuaris WHERE email='".$eluser."'";
    $ftorna = mysqli_query($con,$loque);
    if ($fila = mysqli_fetch_array($ftorna)) {
        // enviem el email
        include_once 'enviaemail.php';
        $c = getIP();
        $ellink = "http://localhost/tctw/repassonva.php?newpassword=NWPASS".generateRandomString(20).'@'.trim($fila['codi']).'t6xxz@'.($fila['codi']*7)."@".$c."@".generateRandomString(20);
        $eltexte = "";
        $eltextet = "";
        if ($langles){
            $eltexte = 'Dear user,<br><br>In order to recover your password, acces to : ';
            $eltextet = 'Dear user,\n\nIn order to recover your password, acces to : ';
        }
        else{
            $eltexte = 'Apreciado usuario,<br><br>Para recuperar su password acceda a : ';
            $eltextet = 'Apreciado usuario,\n\nPara recuperar su password acceda a : ';
        }
        $eltexte .= '<a href="'.$ellink.'">'.$ellink . "</a><br><br>";
        $eltextet .= $ellink . "\n\n";
        
        $n = enviaemail($eluser,$fila['nomuser'],utf8_decode((($langles)?'TCT - Password recovery':'TCT - Recuperación de password')),$eltexte,$eltextet,"");
        if ($n){
            $_SESSION['dimelo'] = (($langles)?'Not found any user with this email.':'No se ha encontrado ningún usuario con este email.');
            saltaa('nopass.php');
        }
        else{
            saltaa('okpass.php');
        }
   }
   else
   {
        $_SESSION['dimelo'] = (($langles)?'Not found any user with this email.':'No se ha encontrado ningún usuario con este email.');
        saltaa('nopass.php');
   }
}
else{
    $_SESSION['dimelo'] = "";
    saltaa('nopass.php');
}

?>

