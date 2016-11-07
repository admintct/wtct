<?php
    if ($_SESSION['usr_codcli']){
        if (file_exists ($GLOBALS['$logos'].$_SESSION['usr_codcli'].'.'.'jpg')){
            unlink($GLOBALS['$logos'].$_SESSION['usr_codcli'].'.'.'jpg');
        }
        elseif (file_exists ($GLOBALS['$logos'].$_SESSION['usr_codcli'].'.'.'png')){
            unlink($GLOBALS['$logos'].$_SESSION['usr_codcli'].'.'.'png');
        }
        elseif (file_exists ($GLOBALS['$logos'].$_SESSION['usr_codcli'].'.'.'gif')){
            unlink($GLOBALS['$logos'].$_SESSION['usr_codcli'].'.'.'gif');
        }
    }
?>