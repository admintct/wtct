<?php

include_once 'sempre.php';
//print_r($_REQUEST['newpassword']);
if (isset($_REQUEST['newpassword']) && (! empty($_REQUEST['newpassword']))){
    $elbo = 0;
    $quin = substr($_REQUEST['newpassword'],27);
    $quines = (int) camp($quin,1,'t');
    $perset = (int) (camp($quin,2,"@")/7);
    if ($quines === $perset){
        $elbo = $quines;
    }
    if(empty($elbo)){
        $_SESSION['dimelo'] = "";
        saltaa('login.php');
    }
    else{
        // Cal mirar que el usuari existeix
        $con = conexioi();
        $loque = "SELECT * FROM wusuaris WHERE codi=".$elbo;
        $ftorna = mysqli_query($con,$loque);
        if ($fila = mysqli_fetch_array($ftorna)) {
            // Mostra la pantalla de recuperar password
            $con->close();
            $_SESSION['relogin_pass'] = $elbo;
            saltaa('repassinput.php');
        }
        else{
            $con->close();
            $_SESSION['dimelo'] = "";
            saltaa('login.php');
        }
    }
}
else{
    $_SESSION['dimelo'] = "";
    saltaa('login.php');
}

?>