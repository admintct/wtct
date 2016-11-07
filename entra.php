<?php

/* 
 * Control d'accesos a la web
 */
include_once 'sempre.php';
// Si ve de recuperació de password fa el login ...
/*if (isset($_SESSION['loginname']) && isset($_SESSION['password'])){
    $_REQUEST['loginname'] = $_SESSION['loginname'];
    $_REQUEST['password'] = $_SESSION['password'];
} */        

if (isset($_REQUEST['loginname']) && isset($_REQUEST['password'])){
    if (empty($_REQUEST['loginname']) || empty($_REQUEST['password'])){
        $_SESSION['dimelo'] = "*";
        saltaa('login.php');
    }
    else{
        $_SESSION['r_login'] = $_SESSION['r_pass1']= $_SESSION['r_pass2']= $_SESSION['r_email'] = $_SESSION['r_name'] = '';
        $_SESSION['r_empre'] = $_SESSION['r_tel']= $_SESSION['r_adreca']= $_SESSION['r_notes'] = '';
        // Mira si es un usuari bo ...
        $con = conexioi();
        $eluser = trim(nohack($_REQUEST['loginname']));
        $loque = "SELECT * FROM wusuaris WHERE usuari='".$eluser."'";
        $ftorna = mysqli_query($con,$loque);
        if ($fila = mysqli_fetch_array($ftorna)) {
            $elpass = trim(nohack($_REQUEST['password']));
            if ($elpass === trim($fila['pass'])){
                $_SESSION['usr_codi'] = $fila['codi'];
                $_SESSION['usr_usuari'] = $eluser;
                $_SESSION['usr_email'] = $fila['email'];
                $_SESSION['usr_nomuser'] = (empty($fila['nomuser'])?$eluser:$fila['nomuser']);
                $_SESSION['usr_ip'] = getIP();
                $_SESSION['usr_codcli'] = $fila['codcli'];
                $_SESSION['usr_nomcli'] = $fila['nomcli'];
                $_SESSION['usr_tct'] = $fila['tct'];
                $_SESSION['usr_codage'] = $fila['codage'];
                $_SESSION['usr_nomage'] = $fila['nomage'];
                $_SESSION['usr_admin'] = $fila['admin'];
                $_SESSION['usr_rollo'] = $fila['rollo'];
                $_SESSION['usr_adreca'] = $fila['adreca'];
                $_SESSION['usr_telefon'] = $fila['telefon'];
                $_SESSION['usr_forwarder'] = $fila['forwarder'];
                $_SESSION['usr_clientoagent'] = $fila['clientoagent'] + 1;
                $_SESSION['n_import'] = 0;
                $_SESSION['n_export'] = 0;
                if ($_SESSION['usr_clientoagent'] == 1){
                    $_SESSION['usr_codage'] = '';
                    $_SESSION['usr_nomage'] = '';
                }
                elseif ($_SESSION['usr_clientoagent'] == 2){
                    $_SESSION['usr_codcli'] = '';
                    $_SESSION['usr_nomcli'] = '';
                }
                actimpexp(); // mirem les partides d'import i export
                guardaquefan("","LOGIN",$eluser,""); // Guardem la entrada
                saltaa('index.php');
            }
            else{
                // si el password no es bo, tornem a demanar usuari i password
                guardaquefan("LOGIN","TRY LOGIN",$eluser,"PASS ERROR"); // Guardem la entrada
                $_SESSION['dimelo'] = "NO";
                saltaa('login.php');
            }
       }
       else
       {
            $_SESSION['dimelo'] = "NO";
            saltaa('login.php');
       }
        $con->close();
        
    }

}
else{
    $_SESSION['dimelo'] = "*";
    saltaa('login.php');
}

?>

