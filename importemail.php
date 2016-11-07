<?php
    include_once 'sempre.php';
    include_once 'enviaemail.php';
    //******
    $ptda = $_REQUEST['ptda'];
    // Adjunts ******************************
    $tira = '';
    $tiraadjunts = '';
    $elsadjunts = '';
    $nfetsadj = 0;
    $nfitxers = retvar('nfitxers');
    $target_dir = $GLOBALS['$dirdocsupload'];
    for ($i = 1; $i <= ($nfitxers+1); $i++) {
        $quinfit = 'fitxer'.$i;
        if (isset($_FILES[$quinfit])){
            if ($_FILES[$quinfit]['tmp_name']){
                $nfetsadj++;
                $nounom = 'i'.$ptda .'-'.$nfetsadj.'-'.basename($_FILES[$quinfit]["name"]);
                $target_file = $target_dir . $nounom;
                $uploadOk = 1;
                $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
                if (! file_exists($target_file)) {            
                    if ($_FILES[$quinfit]["size"] > 500000000) {
                        // Es massa gran ...
                    }
                    else{
                        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
                        && $imageFileType != "gif" && $imageFileType != "pdf" && $imageFileType != "bmp"
                        && $imageFileType != "xls" && $imageFileType != "xlsx" && $imageFileType != "doc"
                        && $imageFileType != "docx" && $imageFileType != "txt" && $imageFileType != "csv" 
                        && $imageFileType != "xml") {
                            echo "Sorry, only JPG, JPEG, PNG & GIF BMP PDF XLS XLSX DOC DOCX TXT CSV XML files are allowed.";
                            $uploadOk = 0;
                        }
                        else{
                            if (move_uploaded_file($_FILES[$quinfit]["tmp_name"], $target_file)) {
                                // echo "The file ". basename( $_FILES[$quinfit]["name"]). " has been uploaded.";
                                $calif = retvar('calif'.$i);
                                $tiraadjunts .= '<li>' . $nounom . (($calif)?' ('.$calif.') ':'').'</li>';
                                $elsadjunts .= (($elsadjunts)?'|':'') . $target_file;
                            } else {
                                echo "Sorry, there was an error uploading your file.";
                            }                            
                        }
                    }
                }
            }
        }
    }
    if ($tiraadjunts){
        $tira .= '<div style="padding:15px 0px 10px 0px;"><b>'.(($langles)?'Attached files : ':'Ficheros adjuntos : ').'</b><ul>'.$tiraadjunts.'</ul></div>';
    }
    /// FI dels adjunts
    
    $tema = $_REQUEST['eltitol'].' Ref. '.$ptda.' - '.$_SESSION['usr_nomcli'];
    $cos = '<p>'.$_REQUEST['eldetall'].'</p></br><p>'.str_replace(chr(13),'</p><p>', $_REQUEST['message']).'</p>'.$tira;
    if ($cos && $tema && $ptda){
        $email_cc = $_SESSION['usr_email'];
        $nom_cc = $_SESSION['usr_nomuser'].' - '.$_SESSION['usr_nomcli'];
        $email_dequi = $GLOBALS['$emailimport'];
        $nom_dequi = $_SESSION['usr_nomuser'].' - '.$_SESSION['usr_nomcli'];
        $emailx = $GLOBALS['$emailimport'];
        $yourname = 'TCT SL';
        trackweb($tema,$tema,$cos,$ptda,'I');
        $que = enviaemail($emailx,$yourname,$tema,$cos,html_entity_decode($cos),$elsadjunts,$email_dequi,$nom_dequi,$nom_cc,$email_cc);
        if ($que){
            $_SESSION['missatge'] = $que;
        }
        else{
            // tot ok
            $_SESSION['missatge'] = (($langles)?'email send.':'email enviado.');
        }
        $_SESSION['misatge_noborra'] = '*';
        //         enviaemail($aquin,$nomaqui="TCT Web User",$subjecte="MAIL FROM TCT",$elhtml="MAIL FROM TCT",$eltxte="MAIL FROM TCT",$elsadjunts="",$efrom="info@tct.es",$nomfrom="TCT SL"){
        saltaa('ptda_import.php?siscon_param='.$ptda);
    }
    else{
        saltaa('import_my_bookings.php');
    }
?>