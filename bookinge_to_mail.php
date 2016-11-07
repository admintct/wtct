<?php
include_once 'milib.php';

$em_col1 = 'text-align:right;padding:2px 10px 2px 0px;valign:top;';
$em_col2 = 'text-align:left;padding:2px 2px 2px 10px;';

$elbarco = trim($df_lcl['elbarco']['val']);
if (empty($elbarco)){
    $buf = texteweb('TEX_EMAIL_BOOKXE');
}
else{
    $buf = texteweb('TEX_EMAIL_BOOK_E');
}
$tira .= '<div style=";align:top;text-align:left;"><table style="border:black 1px solid;border-spacing:0;background-color: transparent;width:400px;margin-left:auto; margin-right:auto; ">';
$elcodi = "";
$esagent = false;
if (hies()){
    if ($_SESSION['usr_codcli']){
        $elcodi = ' / CL-'.$_SESSION['usr_codcli'];
    }
    elseif($_SESSION['usr_codage']){
        $elcodi = ' / AG-'.$_SESSION['usr_codage'];
        $esagent = true;
    }
}
$tira .= '<th style="background-color:rgb(16,63,117);color:white;font-weight: bold;padding:10px">Ref. '.$codialta.$elcodi.'</th><th style="background-color:rgb(16,63,117);color:white;font-weight: bold;padding:10px""></th>';
    $tira .= posatr((($langles)?(($esagent)?'Agent':'Client'):(($esagent)?'Agente':'Cliente')),((hies())?(($_SESSION['usr_nomcli'])?$_SESSION['usr_nomcli']:$_SESSION['usr_nomage']):$df_lcl['empresa']['val']),false,$em_col1,$em_col2); 
    $tira .= posatr(ladesc($df_lcl['port']),$df_lcl['port']['val'],false,$em_col1,$em_col2); 
    if ($df_lcl['elbarco']['val']){
        $tira .= posatr(ladesc($df_lcl['elbarco']),$df_lcl['elbarco']['val'],false,$em_col1,$em_col2); 
    }
    $tira .= posatr(ladesc($df_lcl['laets']),DTOC($df_lcl['laets']['val']),false,$em_col1,$em_col2); 
    $tira .= posatr(ladesc($df_lcl['cutoff']),DTOC($df_lcl['cutoff']['val']),false,$em_col1,$em_col2); 
    $tira .= posatr(ladesc($df_lcl['elviaje']),$df_lcl['elviaje']['val'],false,$em_col1,$em_col2);
    $tira .= posatr(ladesc($df_lcl['oftct']),$df_lcl['oftct']['val'],true,$em_col1,$em_col2);
    $tira .= posatr(ladesc($df_lcl['suref']),$df_lcl['suref']['val'],true,$em_col1,$em_col2);
    $tira .= posatr(ladesc($df_lcl['lclfcl']),($df_lcl['lclfcl']['val']=='1')?'LCL':'FCL',false,$em_col1,$em_col2);
    if (! hies()){
        $tira .= posatr(ladesc($df_lcl['elpic']),$df_lcl['elpic']['val'],false,$em_col1,$em_col2);
        $tira .= posatr(ladesc($df_lcl['empresa']),$df_lcl['empresa']['val'],true,$em_col1,$em_col2);
        $tira .= posatr(ladesc($df_lcl['adreca']),$df_lcl['adreca']['val'],true,$em_col1,$em_col2);
        $tira .= posatr(ladesc($df_lcl['nif']),$df_lcl['nif']['val'],true,$em_col1,$em_col2);
        $tira .= posatr(ladesc($df_lcl['telefon']),$df_lcl['telefon']['val'],true,$em_col1,$em_col2);
        $tira .= posatr(ladesc($df_lcl['emailbook']),$df_lcl['emailbook']['val'],true,$em_col1,$em_col2);
    }
    if ($df_lcl['bloriexpr']['val']){
        $tira .= posatr(ladesc($df_lcl['bloriexpr']),($df_lcl['bloriexpr']['val']=='1')?'ORIGINAL':'EXPRESS',false,$em_col1,$em_col2);
    }
    $tira .= posatr(ladesc($df_lcl['shipper']),$df_lcl['shipper']['val'],false,$em_col1,$em_col2);
    $tira .= posatr(ladesc($df_lcl['consignee']),$df_lcl['consignee']['val'],false,$em_col1,$em_col2);
    $tira .= posatr(ladesc($df_lcl['notify']),$df_lcl['notify']['val'],false,$em_col1,$em_col2);

    $tira .= posatr(ladesc($df_lcl['fechaentrega']),$df_lcl['fechaentrega']['val'],false,$em_col1,$em_col2);
    if (($df_lcl['lclfcl']['val']=='2')){
        $tira .= posatr(ladesc($df_lcl['rollocntr']),  cr_to_br($df_lcl['rollocntr']['val']),true,$em_col1,$em_col2); 
    }
    $tira .= posatr(ladesc($df_lcl['bultos']),$df_lcl['bultos']['val'].' '.$df_lcl['tipobult']['val'],false,$em_col1,$em_col2); 
    $tira .= posatr(ladesc($df_lcl['kilos']),$df_lcl['kilos']['val'].' Kgs',false,$em_col1,$em_col2); 
    $tira .= posatr(ladesc($df_lcl['cbmmax']),$df_lcl['cbmmax']['val'].' m<sup>3</sup>',false,$em_col1,$em_col2); 
    $tira .= posatr(ladesc($df_lcl['rollomides']),  cr_to_br($df_lcl['rollomides']['val']),true,$em_col1,$em_col2); 
    $tira .= posatr(ladesc($df_lcl['remontable']),sino($df_lcl['remontable']['val']=='1'),false,$em_col1,$em_col2); 
    $tira .= posatr(ladesc($df_lcl['mercancia']),cr_to_br($df_lcl['mercancia']['val']),false,$em_col1,$em_col2); 
    $tira .= posatr(ladesc($df_lcl['marcas']),cr_to_br($df_lcl['marcas']['val']),false,$em_col1,$em_col2); 
    $tira .= posatr(ladesc($df_lcl['hscode']),cr_to_br($df_lcl['hscode']['val']),false,$em_col1,$em_col2); 
    $tira .= posatr('IMO',sino($df_lcl['volimo']['val']),false,$em_col1,$em_col2); 
    if ($df_lcl['volimo']['val']){
        $tira .= posatr(ladesc($df_lcl['rolloimo']),cr_to_br($df_lcl['rolloimo']['val']),false,$em_col1,$em_col2); 
    }
    
    $tira .= posatr(ladesc($df_lcl['volrecull']),sino($df_lcl['volrecull']['val']=='1'),false,$em_col1,$em_col2); 
    if ($df_lcl['volrecull']['val']){
        $tira .= posatr(ladesc($df_lcl['dirrecull']),  cr_to_br($df_lcl['dirrecull']['val']),false,$em_col1,$em_col2); 
        $tira .= posatr(ladesc($df_lcl['datarecull']),DTOC($df_lcl['datarecull']['val']),false,$em_col1,$em_col2);
        $tira .= posatr(ladesc($df_lcl['telrecull']),  $df_lcl['telrecull']['val'],false,$em_col1,$em_col2); 
        $tira .= posatr(ladesc($df_lcl['picrecull']),  $df_lcl['picrecull']['val'],false,$em_col1,$em_col2); 
        $tira .= posatr(ladesc($df_lcl['horarirecull']),  $df_lcl['horarirecull']['val'],false,$em_col1,$em_col2); 
        $tira .= posatr(ladesc($df_lcl['refrecull']),  $df_lcl['refrecull']['val'],false,$em_col1,$em_col2); 
    }
    $tira .= posatr(ladesc($df_lcl['incoterm']),  $df_lcl['incoterm']['val'],false,$em_col1,$em_col2); 
    $tira .= posatr(ladesc($df_lcl['direntrega']),cr_to_br($df_lcl['direntrega']['val']),true,$em_col1,$em_col2); 
    $tira .= posatr(ladesc($df_lcl['insdespacho']),  $df_lcl['insdespacho']['val'],false,$em_col1,$em_col2); 
    $tira .= posatr(ladesc($df_lcl['despachacli']),($df_lcl['despachacli']['val']=='1')?(($esagent)?'Agent':'Cliente'):'TCT',false,$em_col1,$em_col2);
    if (! esagent()){
        $tira .= posatr(ladesc($df_lcl['asentamiento']),($df_lcl['asentamiento']['val']=='1')?(($esagent)?'Agent':'Cliente'):'TCT',false,$em_col1,$em_col2);
    }
    if ($df_lcl['insurance']['val']){
        $tira .= posatr(ladesc($df_lcl['insurance']),sino($df_lcl['insurance']['val']),false,$em_col1,$em_col2); 
    }
    if ($df_lcl['envdocs']['val']){
        $tira .= posatr(ladesc($df_lcl['envdocs']),sino($df_lcl['envdocs']['val']),false,$em_col1,$em_col2); 
    }
    if ($df_lcl['documents']['val'] || $df_lcl['flag']['val'] || $df_lcl['freight']['val'] || $df_lcl['blacklist']['val'] || $df_lcl['age']['val'] || $df_lcl['route']['val']){
        $tira .= posatr('<b>'.(($langles)?'Certificate request':'Solicita certificados').'</b>','',false,$em_col1,$em_col2); 
        if ($df_lcl['documents']['val']){
            $tira .= posatr(ladesc($df_lcl['documents']),sino($df_lcl['documents']['val']),false,$em_col1,$em_col2); 
        }
        if ($df_lcl['flag']['val']){
            $tira .= posatr(ladesc($df_lcl['flag']),sino($df_lcl['flag']['val']),false,$em_col1,$em_col2); 
        }
        if ($df_lcl['freight']['val']){
            $tira .= posatr(ladesc($df_lcl['freight']),sino($df_lcl['freight']['val']),false,$em_col1,$em_col2); 
        }
        if ($df_lcl['blacklist']['val']){
            $tira .= posatr(ladesc($df_lcl['blacklist']),sino($df_lcl['blacklist']['val']),false,$em_col1,$em_col2); 
        }
        if ($df_lcl['age']['val']){
            $tira .= posatr(ladesc($df_lcl['age']),sino($df_lcl['age']['val']),false,$em_col1,$em_col2); 
        }
        if ($df_lcl['route']['val']){
            $tira .= posatr(ladesc($df_lcl['route']),sino($df_lcl['route']['val']),false,$em_col1,$em_col2); 
        }
    }

    $tira .= posatr(ladesc($df_lcl['rollo']),  cr_to_br($df_lcl['rollo']['val']),true,$em_col1,$em_col2); 
    
    $tira .= '</table><div>';
    // Adjunts ******************************
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
                $nounom = 'e'.$codialta .'-'.$nfetsadj.'-'.basename($_FILES[$quinfit]["name"]);
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
    include_once 'enviaemail.php';
    $cos = str_replace('***booking***', $tira, $buf);
    ///
    $que = enviaemail($df_lcl['emailbook']['val'],$df_lcl['emailbook']['val'],'EXPORT BOOKING - '.(($_SESSION['usr_nomcli'])?$_SESSION['usr_nomcli']:$_SESSION['usr_nomage']),$cos,html_entity_decode($cos),$elsadjunts,$GLOBALS['$emailexport'],'TCT SL','TCT SL',$GLOBALS['$emailexport'],'');
    if ($que){
        $_SESSION['missatge'] = ' <p>'.$que.'</p>';
    }
    else {
        $_SESSION['missatge'] = ' <p>'.(($langles)?'Email send.':'Email enviado.').'</p>';
        $_SESSION['misatge_noborra'] = 1;
    }
?>

