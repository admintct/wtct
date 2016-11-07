<?php

    if (file_exists ($GLOBALS['$logos'].$_SESSION['usr_codcli'].'.'.'jpg')){
        $lasource = $GLOBALS['$logos'].$_SESSION['usr_codcli'].'.'.'jpg';
        $_SESSION['ellogo'] = $lasource;
    }
    elseif (file_exists ($GLOBALS['$logos'].$_SESSION['usr_codcli'].'.'.'png')){
        $lasource = $GLOBALS['$logos'].$_SESSION['usr_codcli'].'.'.'png';
        $_SESSION['ellogo'] = $lasource;
    }
    elseif (file_exists ($GLOBALS['$logos'].$_SESSION['usr_codcli'].'.'.'gif')){
        $lasource = $GLOBALS['$logos'].$_SESSION['usr_codcli'].'.'.'gif';
        $_SESSION['ellogo'] = $lasource;
    }

?>