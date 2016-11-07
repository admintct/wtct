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
                    case "AE":$segueix = true;break;
                    case "AI":$segueix = true;break;
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
                    $archivo = substr($nomreal,3);
                    $filename = $GLOBALS['$dirateamil'].$nomreal;
                }
                elseif($_REQUEST['origen'] == "TRACK-D"){
                    $nomreal = strtolower(trim($_REQUEST['elnom']));
                    $archivo = substr($nomreal,3);
                    $filename = $GLOBALS['$dirdocs'].$nomreal;
                }
//echo $archivo."---".$nomreal;
                if ($filename){
                    if (file_exists($filename)) {
                        $outname=$archivo;
                        $fileInfo = pathinfo($filename);
                        $fileExtension = $fileInfo['extension'];
                        header('Content-Description: File Transfer');
                        header("Expires: -1");
                        header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
                        switch ($fileExtension) {
                            case 'pdf':
                                header("Content-type: application/pdf");
                                header("Content-Disposition: attachment; filename=".$outname.";\n\n");
                                break;
                            case 'bmp':
                            case 'jpgas':
                            case 'png':
                            case 'gif':
                                header('Content-Type: application/'.$fileExtension);
                                header('Content-Disposition: attachment; filename='.$outname.";\n\n");
                                break;
//                                break;
                            default:
                                header('Content-Type: application/'.$fileExtension);
                                header('Content-Disposition: attachment; filename='.$outname.";\n\n");
                                break;
                        }
                            header('Content-Transfer-Encoding: binary');
                            header("Cache-Control: no-store, no-cache, must-revalidate");
                            header("Cache-Control: post-check=0, pre-check=0");
                            header("Pragma: no-cache");
                        $len = filesize($filename);
                        header("Content-Length: $len;\n");
                        ob_clean();
                        flush();
                        readfile($filename);
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

