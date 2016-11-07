<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

include_once 'sempre.php';
$_SESSION['quediu']= (($langles)?'Some fields that are mandatory are empty':'Algunos campos que son obligatorios están vacíos').'.';
/* camps : obliga_loginname, password, password_again, email, companyname, telefon, adreca, lesnotes */

if (isset($_REQUEST['obliga_loginname'])){
    $lacaptcha = nohack($_REQUEST['g-recaptcha-response']);
    $obliga_loginname = nohack($_REQUEST['obliga_loginname']);
    $_SESSION['r_login'] = $obliga_loginname;
    $password = nohack($_REQUEST['password']);
    $_SESSION['r_pass1'] = $password;
    $password_again = nohack($_REQUEST['password_again']);
    $_SESSION['r_pass2'] = $password_again;
    $email = nohack($_REQUEST['email']);
    $_SESSION['r_email'] = $email;
    $yourname = nohack($_REQUEST['yourname']);
    $_SESSION['r_name'] = $yourname;
    $companyname = nohack($_REQUEST['companyname']);
    $_SESSION['r_empre'] = $companyname;
    $telefon = nohack($_REQUEST['telefon']);
    $_SESSION['r_tel'] = $telefon;
    $adreca = nohack($_REQUEST['adreca']);
    $_SESSION['r_adreca'] = $adreca;
    $lesnotes = nohack($_REQUEST['lesnotes']);
    $_SESSION['r_notes'] = $lesnotes;
    if (empty($lacaptcha)){
        $_SESSION['quediu']= (($langles)?'Please, check "i\'m not a robot"':'Por favor marque "No soy un robot"').'.';
        saltaa('registre.php');
    }
    else
    {
        if (! empty($obliga_loginname)){
            $_SESSION['quediu']= '';
            // Mirem si el usuari ja existeix 
            $con = conexioi();
            if ($con){
                $loque = "SELECT * FROM wusuaris WHERE usuari='".$obliga_loginname."'";
                $ftorna = mysqli_query($con,$loque);
                if ($fila = mysqli_fetch_array($ftorna)) {
                    // El usuari ja hi es
                    $con->close();
                    $_SESSION['quediu']= (($langles)?'The user already exists. Select another user name':'El usuario ya existe. Selecciona otro nombre de usuario').'.';
                    saltaa('registre.php');
                }
                else{
                    $loque = "SELECT * FROM wusuaris WHERE email='".$email."'";
                    $ftorna = mysqli_query($con,$loque);
                    if ($fila = mysqli_fetch_array($ftorna)) {
                        // El usuari ja hi es
                        $con->close();
                        $_SESSION['quediu']= (($langles)?'A Registered user with the same EMAIL ALREADY EXISTS':'YA EXISTE un usuario dado de alta con el mismo EMAIL').'.';
                        saltaa('registre.php');
                    }
                    else
                    {
                        // Fem l'alta
                        // Donem les gràcies
                        $_SESSION['missatge'] = 'OK_REGISTRO';
                        $_SESSION['missatge_literal'] = 0;
                        $_SESSION['missatge_to_php'] = "login.php";
                        $_SESSION['missatge_dibuix'] = "fa-pencil";
                        $_SESSION['missatge_boto'] = "Ok";
                        $_SESSION['missatge_notitol'] = 0;
                        // Cal fer el alta ...
                        $loque = 'INSERT INTO wusuaris (usuari,pass,email,nomuser,nomcli,telefon,adreca,rollo) '.
                                 'VALUES ("'.$obliga_loginname.'","'.$password.'","'.$email.'","'.$yourname.'","'.$companyname.'","'.$telefon.'","'.$adreca.'","'.$lesnotes.'")';
                        $ftorna = mysqli_query($con,$loque);
                        if ($ftorna) {
                            $_SESSION['r_login'] = $_SESSION['r_pass1']= $_SESSION['r_pass2']= $_SESSION['r_email'] = $_SESSION['r_name'] = '';
                            $_SESSION['r_empre'] = $_SESSION['r_tel']= $_SESSION['r_adreca']= $_SESSION['r_notes'] = '';
                            
                            // Cal enviar el email ...
                            $tema = $yourname.', '.texteweb("OK_REG_EMAIL", 1);
                            $cos = str_replace("%u%",$obliga_loginname,texteweb("OK_REG_EMAIL", 0));
                            include_once 'enviaemail.php';
                            enviaemail($email,$yourname,$tema,$cos,html_entity_decode($cos),"",$GLOBALS['$email_web'],"TCT SL","TCT SL",$GLOBALS['$email_web']);
                            saltaa('missatge.php');
                        }
                        else{
                            saltaa('index.php');
                        }
                    }
                }
            }
            else{saltaa('index.php');
            }
        }
    }
}
else{
        $_SESSION['dimelo'] = "*";
        saltaa('registre.php');
}
 ?>