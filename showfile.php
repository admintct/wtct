<?php
    $segueix = false;
    $lsalta = false;
    include_once 'sempre.php';
    if (isset($_REQUEST['fid']) && $_REQUEST['fid']){
        $contmp = conexioi();
        if ($_REQUEST['origen'] == "DOCS"){
            $loque = 'SELECT * FROM docs WHERE unic="'.$_REQUEST['fid'].'"';
        }
        elseif($_REQUEST['origen'] == "TRACK" || $_REQUEST['origen'] == "TRACK-D"){
            $loque = 'SELECT * FROM track WHERE unic="'.$_REQUEST['fid'].'"';
        }
        $fcons = mysqli_query($contmp,$loque);
        $archivo = "";
        $nomreal = "";
        if ($xdocs = mysqli_fetch_array($fcons)) {
            if (isset($_SESSION['usr_tct']) && $_SESSION['usr_tct']){
                $segueix = true;
            }
            elseif ($_REQUEST['origen'] == "DOCS" || $_REQUEST['origen'] == "TRACK" || $_REQUEST['origen'] == "TRACK-D"){
                switch ($_REQUEST['deon']) {
                    case "AI":$segueix = true;break;
                    case "AE":$segueix = true;break;
                    case "PE":
                        if (esagent()){
                            $segueix = ptda_age(trim($xdocs['codi']),'e');
                        }
                        else{
                            $loque = 'SELECT codcli FROM lcl WHERE codi="'.trim($xdocs['codi']).'"';
                            $fconsc = mysqli_query($contmp,$loque);
                            if ($hoes = mysqli_fetch_array($fconsc)) {
                                $segueix = ($hoes['codcli'] == $_SESSION['usr_codcli']);
                            }
                        }
                        break;
                    case "PI":
                        if (esagent()){
                            $segueix = ptda_age(trim($xdocs['codi']),'i');
                        }
                        else{
                            $loque = 'SELECT codcli FROM lcle WHERE codi="'.trim($xdocs['codi']).'"';
                            $fconsc = mysqli_query($contmp,$loque);
                            if ($hoes = mysqli_fetch_array($fconsc)) {
                                $segueix = ($hoes['codcli'] == $_SESSION['usr_codcli']);
                            }
                        }
                        break;
                    default:$segueix = false;
                    break;
                }
            }
            if ($segueix){
                if ($_REQUEST['origen'] == "DOCS"){
                    $xdocs['ext'] = strtolower($xdocs['ext']);
                    $archivo = trim($_REQUEST['elnom']).".".$xdocs['ext'];
                    $nomreal = $xdocs['unic'].'.'.$xdocs['ext'];
                    $filename = $GLOBALS['$dirdocs'].$xdocs['eldir'].'/'.$nomreal;
                }
                elseif($_REQUEST['origen'] == "TRACK"){
                    $nomreal = strtolower(trim($_REQUEST['elnom']));
                    $archivo = $nomreal;
                    $filename = $GLOBALS['$dirateamil'].$nomreal;
                }
                elseif($_REQUEST['origen'] == "TRACK-D"){
                    $nomreal = strtolower(trim($_REQUEST['elnom']));
                    $archivo = $nomreal;
                    $filename = $GLOBALS['$dirdocs'].$nomreal;
                }
//echo $archivo."---".$nomreal;
                if ($filename){
                    if (file_exists($filename)) {
                        $fileInfo = pathinfo($filename);
                        $fileExtension = $fileInfo['extension'];
                        switch ($fileExtension) {
                            case 'pdf':
                                header('Content-Type: application/pdf');
                                header('Expires: 0');
                                header('Cache-Control: must-revalidate');
                                header('Pragma: public');
                                break;
                            case 'jpg':
                            case 'png':
                            case 'gif':
                            case 'bmp':
                                header('Content-Type: image/'.$fileExtension);
                                header('Expires: 0');
                                header('Cache-Control: must-revalidate');
                                header('Pragma: public');
                                break;
                            default:
                                break;
                        }
                        ob_clean();
                        flush();
                        readfile($filename);
                        exit;
                    }
                }
                else{
                    $_SESSION['missatge']="*FICHERO ".$GLOBALS['$dirdocs']."-".$GLOBALS['$onestara']."-".$filename."NO ENCONTRADO.";
                    saltaa("index.php");
                }
            }
            else{$salta = true;}
        }
        else{$salta = true;}
    }
    else{$salta = true;}
    
    if ($lsalta){
        $_SESSION['missatge']="ACCION NO AUTORIZADA.";
        if (hies()){
            saltaa("index.php");
        }
        else{
            saltaa("login.php");
        }
    }
?>

