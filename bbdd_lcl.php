<?php
if (! hies()){
    saltaa('login.php');
}

$lsalta = false; $saltab = false; $ptda = NULL; $ptdab = NULL; $agrupa = NULL; $agrupab = NULL;
$laref = NULL; $ncontainer = '1'; $cntr = ""; $codmagat = ""; $actviaje = NULL; $actbarco = NULL; $codcli = "";
$eladmitase = '';

$elstatus = '';
$contmp = conexioi();
$confirmada = 0;
$loque = 'SELECT claudef, claudeffcl FROM prefer';
$fconspr = mysqli_query($contmp,$loque);
if ($prefer = mysqli_fetch_array($fconspr)) {
}
$loque = 'SELECT * FROM lcl WHERE codi="'.$laptda.'"';
$fcons = mysqli_query($contmp,$loque);
if ($ptda = mysqli_fetch_array($fcons)) {
    $loquest = 'SELECT status, statusa FROM lclagrupa WHERE codi="'.$laptda.'"';
    $fconsst = mysqli_query($contmp,$loquest);
    if ($status = mysqli_fetch_array($fconsst)) {
        $elstatus = ($langles)?$status['statusa']:$status['status'];
    }
    $eladmitase = $ptda['admitase'];
    if (($_SESSION['usr_tct'])?true:($ptda['codcli'] == $_SESSION['usr_codcli'])){
        $loque = 'SELECT * FROM lclb WHERE codi="'.$laptda.'"';
        $fconsb = mysqli_query($contmp,$loque);
        if ($ptdab = mysqli_fetch_array($fconsb)) {
            if ($ptda['codcli']){
                $loque_cl = 'SELECT * FROM clients WHERE codi="'.$ptda['codcli'].'"';
                $fconscl = mysqli_query($contmp,$loque_cl);
                if ($clients = mysqli_fetch_array($fconscl)) {
                    $codcli = $ptda['codcli'];
                }
            }
            //
            $laref = ($ptda['refade'])?$ptda['refade']:$ptda['ref'];
            if($laref)
                {
                $loque = 'SELECT * FROM agrupa WHERE ref="'.$laref.'"';
                $fconsc = mysqli_query($contmp,$loque);
                if ($agrupa = mysqli_fetch_array($fconsc)) {
                    if ($agrupa['cocarga']){
                        $loqueal = 'SELECT * FROM almacen WHERE codi="'.$laptda.'"';
                        $fconsbal = mysqli_query($contmp,$loqueal);
                        if ($almacen = mysqli_fetch_array($fconsbal)) {
                            if ($almacen['admitase']){
                                $eladmitase = $almacen['admitase'];
                            }
                        }
                    }
                    $loquev = 'SELECT * FROM via WHERE ref="'.$laref.'"';
                    $fconsdv = mysqli_query($contmp,$loquev);
                    if ($via = mysqli_fetch_array($fconsdv)) {
                        if ($via['sn'] == 'SI'){
                            $confirmada = 1;
                        }
                    }
                    $loque = 'SELECT * FROM agrupab WHERE ref="'.$laref.'"';
                    $fconsd = mysqli_query($contmp,$loque);
                    if ($agrupab = mysqli_fetch_array($fconsd)) {
                        $loque = 'SELECT * FROM viajes WHERE codi="'.$agrupa['codi'].'"';
                        $fconse = mysqli_query($contmp,$loque);
                        if ($viajes = mysqli_fetch_array($fconse)) {
                            $actviaje = $viajes['codi'];
                            $loque = 'SELECT * FROM barcos WHERE codi="'.$agrupa['codbarco'].'"';
                            $fconse = mysqli_query($contmp,$loque);
                            if ($barcos = mysqli_fetch_array($fconse)) {
                                $actbarco = $barcos['codi'];
                                $lsalta = false;
                            }
                            else{$_SESSION['missatge']="ERROR : BARCOS !";$lsaltab=true;}
                        }
                        else{$_SESSION['missatge']="ERROR : VIAJES !";$lsaltab=true;}
                    }
                    else{$_SESSION['missatge']="ERROR : AGRUPAB !";$lsaltab=true;}
                    // Busquem el CNTR i el magatzem ...
                    switch ($ptda['container']) {
                        case 'A': $ncontainer='1'; $codmagat = $agrupa['depot1']; break;
                        case 'B': $ncontainer='2'; $codmagat = $agrupa['depot2'];  break;
                        case 'C': $ncontainer='3'; $codmagat = $agrupa['depot3'];  break;
                    }
                    if ($agrupa['cocarga'] && $agrupab['cdepot']){
                        $codmagat = $agrupab['cdepot'];
                    }
                    if ($ptda['coddepot']){
                        $codmagat = $ptda['coddepot'];
                    }
                    ///
                    if ($laref){
                        $cntr = str_replace('.', '',$agrupa['refcon'.$ncontainer]);
                        $cntr = str_replace('-', '',$cntr);
                    }
                    if ($codmagat){
                        $loque = 'SELECT * FROM depot WHERE codi="'.$codmagat.'"';
                        $fcons2 = mysqli_query($contmp,$loque);
                        if ($depot = mysqli_fetch_array($fcons2)) {
                            if (strstr($depot['descrip'],"DETERMINAR")){
                                $codmagat = NULL;
                            }
                        }
                        else{$codmagat = NULL;}
                    }
                    else{$codmagat = NULL;}
                }
                else{$_SESSION['missatge']="ERROR : AGRUPA !";$lsaltab=true;}
            }
            else{
                $lsalta = false;
            }
        }
        else{$_SESSION['missatge']="ERROR : LCLB !";$lsaltab=true;}
    }
    else{$lsalta=true;}
}
else{$lsalta=true;}
if ((! estct()) && ($codcli != $_SESSION['usr_codcli'])){
    saltaa('login.php');
}
?>