<?php
    include_once 'sempre.php';
    if ((! isset($_SESSION['relogin_pass'])) || (empty($_SESSION['relogin_pass']))){
        $_SESSION['dimelo'] = "";
        saltaa('login.php');
    }
    elseif (($_REQUEST['password'] === $_REQUEST['password_again']) && (! empty($_REQUEST['password']))){
        // Guardem el password i fem el login ...
        $loquefan = 'UPDATE wusuaris SET pass="'.$_REQUEST['password'].'" WHERE codi='.$_SESSION['usr_codi'];
        $confan = conexioi();
        if ($confan){
            $ftorna = mysqli_query($confan,$loquefan);
            $confan->close();
        }
        // Saltem al index
        $_SESSION['dimelo'] = "";
        $_SESSION['loginname'] = $_SESSION['usr_usuari'];
        $_SESSION['password'] = $_REQUEST['password'];
        saltaa('index.php');
    }
    else{
        $_SESSION['dimelo'] = "";
        saltaa('login.php');
    }
?>
