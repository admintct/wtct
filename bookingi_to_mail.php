<?php
/* function posatr($eti,$desc,$condicio=false,$estil1='',$estil2='',$encode=1){
    $ftorna = '';
    if ($encode){
    }
    if (($condicio)?$desc:true){
        $ftorna = '<tr><td'.(($estil1)?' style="'.$estil1.'"':'').'>'.htmlentities($eti,null,'UTF-8').'</td>'.
                '<td'.(($estil2)?' style="'.$estil2.'"':'').'>'.htmlentities($desc,null,'UTF-8').'</td></tr>';
    }
    return $ftorna;
} */

$em_col1 = 'text-align:right;padding:2px 10px 2px 0px;valign:top;';
$em_col2 = 'text-align:left;padding:2px 2px 2px 10px;';

$elbarco = trim($df_lcle['elbarco']['val']);
if (empty($elbarco)){
    $buf = texteweb('TEX_EMAIL_BOOKXI');
}
else{
    $buf = texteweb('TEX_EMAIL_BOOK_I');
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
    $tira .= posatr((($langles)?(($esagent)?'Agent':'Client'):(($esagent)?'Agente':'Cliente')),((hies())?(($_SESSION['usr_codcli'])?$_SESSION['usr_nomcli']:$_SESSION['usr_nomage']):$df_lcl['empresa']['val']),false,$em_col1,$em_col2); 
    if ($df_lcle['fpod']['val'] != 'BARCELONA'){
        $tira .= posatr(ladesc($df_lcle['fpod']),$df_lcle['fpod']['val'],false,$em_col1,$em_col2); 
    }
    $tira .= posatr(ladesc($df_lcle['port']),$df_lcle['port']['val'],false,$em_col1,$em_col2); 
    if (empty($elbarco)){
        $tira .= posatr((($langles)?'Estimated ETD':'ETD deseada'),$laetsvol,false,$em_col1,$em_col2); 
    }
    else{
        $tira .= posatr(ladesc($df_lcle['elbarco']),$df_lcle['elbarco']['val'],false,$em_col1,$em_col2); 
        $tira .= posatr(ladesc($df_lcle['laets']),DTOC($df_lcle['laets']['val']),false,$em_col1,$em_col2); 
    }
    if (! empty($elbarco)){
        $tira .= posatr(ladesc($df_lcle['cutoff']),DTOC($df_lcle['cutoff']['val']),false,$em_col1,$em_col2); 
        $tira .= posatr(ladesc($df_lcle['laeta']),DTOC($df_lcle['laeta']['val']),false,$em_col1,$em_col2); 
        $tira .= posatr(ladesc($df_lcle['elviaje']),$df_lcle['elviaje']['val'],false,$em_col1,$em_col2);
    }
    $tira .= posatr(ladesc($df_lcle['oftct']),$df_lcle['oftct']['val'],true,$em_col1,$em_col2);
    $tira .= posatr(ladesc($df_lcle['suref']),$df_lcle['suref']['val'],true,$em_col1,$em_col2);
    $tira .= posatr(ladesc($df_lcle['lclfcl']),($df_lcle['lclfcl']['val']=='1')?'LCL':'FCL',false,$em_col1,$em_col2);
    if (! hies()){
        $tira .= posatr(ladesc($df_lcle['elpic']),$df_lcle['elpic']['val'],false,$em_col1,$em_col2);
        $tira .= posatr(ladesc($df_lcle['empresa']),$df_lcle['empresa']['val'],true,$em_col1,$em_col2);
        $tira .= posatr(ladesc($df_lcle['adreca']),$df_lcle['adreca']['val'],true,$em_col1,$em_col2);
        $tira .= posatr(ladesc($df_lcle['nif']),$df_lcle['nif']['val'],true,$em_col1,$em_col2);
        $tira .= posatr(ladesc($df_lcle['telefon']),$df_lcle['telefon']['val'],true,$em_col1,$em_col2);
        $tira .= posatr(ladesc($df_lcle['emailbook']),$df_lcle['emailbook']['val'],true,$em_col1,$em_col2);
    }
    $tira .= posatr(ladesc($df_lcle['fechaentrega']),$df_lcle['fechaentrega']['val'],false,$em_col1,$em_col2);
    if (($df_lcle['lclfcl']['val']=='2')){
        $tira .= posatr(ladesc($df_lcle['rollocntr']),  cr_to_br($df_lcle['rollocntr']['val']),true,$em_col1,$em_col2); 
    }
    $tira .= posatr(ladesc($df_lcle['bultos']),$df_lcle['bultos']['val'].' '.$df_lcle['tipobult']['val'],false,$em_col1,$em_col2); 
    $tira .= posatr(ladesc($df_lcle['kilos']),$df_lcle['kilos']['val'].' Kgs',false,$em_col1,$em_col2); 
    $tira .= posatr(ladesc($df_lcle['cbmmax']),$df_lcle['cbmmax']['val'].' m3',false,$em_col1,$em_col2); 
    $tira .= posatr(ladesc($df_lcle['rollomides']),  cr_to_br($df_lcle['rollomides']['val']),true,$em_col1,$em_col2); 
    $tira .= posatr(ladesc($df_lcle['remontable']),sino($df_lcle['remontable']['val']=='1'),false,$em_col1,$em_col2); 
    $tira .= posatr(ladesc($df_lcle['mercancia']),cr_to_br($df_lcle['mercancia']['val']),false,$em_col1,$em_col2); 
    $tira .= posatr(ladesc($df_lcle['marcas']),cr_to_br($df_lcle['marcas']['val']),false,$em_col1,$em_col2); 
    $tira .= posatr(ladesc($df_lcle['hscode']),cr_to_br($df_lcle['hscode']['val']),false,$em_col1,$em_col2); 
    $tira .= posatr('IMO',sino($df_lcle['volimo']['val']),false,$em_col1,$em_col2); 
    if ($df_lcle['volimo']['val']){
        $tira .= posatr(ladesc($df_lcle['rolloimo']),cr_to_br($df_lcle['rolloimo']['val']),false,$em_col1,$em_col2); 
    }
    
    $tira .= posatr(ladesc($df_lcle['incoterm']),  $df_lcle['incoterm']['val'],false,$em_col1,$em_col2); 
    if ($df_lcle['incoterm']['val'] == "EXW"){
        $tira .= posatr(ladesc($df_lcle['dirrecull']),cr_to_br($df_lcle['dirrecull']['val']),true,$em_col1,$em_col2); 
    }

    $tira .= posatr(ladesc($df_lcle['volentreg']),sino($df_lcle['volentreg']['val']=='1'),false,$em_col1,$em_col2); 
    if ($df_lcle['volentreg']['val']){
        $tira .= posatr(ladesc($df_lcle['direntreg']),  cr_to_br($df_lcle['direntreg']['val']),false,$em_col1,$em_col2); 
        $tira .= posatr(ladesc($df_lcle['dataentrega']),DTOC($df_lcle['dataentrega']['val']),false,$em_col1,$em_col2);
        $tira .= posatr(ladesc($df_lcle['telentreg']),  $df_lcle['telentreg']['val'],false,$em_col1,$em_col2); 
        $tira .= posatr(ladesc($df_lcle['picentreg']),  $df_lcle['picentreg']['val'],false,$em_col1,$em_col2); 
        $tira .= posatr(ladesc($df_lcle['horarientreg']),  $df_lcle['horarientreg']['val'],false,$em_col1,$em_col2); 
        $tira .= posatr(ladesc($df_lcle['refentreg']),  $df_lcle['refentreg']['val'],false,$em_col1,$em_col2); 
    }
    $tira .= posatr(ladesc($df_lcle['voldesglos']),sino($df_lcle['voldesglos']['val']=='1'),false,$em_col1,$em_col2); 
    if ($df_lcle['voldesglos']['val']){
        $tira .= posatr(ladesc($df_lcle['rollodesglos']),  cr_to_br($df_lcle['rollodesglos']['val']),false,$em_col1,$em_col2); 
    }

    $tira .= posatr('SHIPPER',$df_lcle['shipper']['val'],false,$em_col1,$em_col2);
    $tira .= posatr('CONSIGNEE',$df_lcle['consignee']['val'],false,$em_col1,$em_col2);
    $tira .= posatr('NOTIFY',$df_lcle['notify']['val'],false,$em_col1,$em_col2);
    
    $tira .= posatr(ladesc($df_lcle['rollo']),  cr_to_br($df_lcle['rollo']['val']),true,$em_col1,$em_col2); 
    
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
                $nounom = 'i'.$codialta .'-'.$nfetsadj.'-'.basename($_FILES[$quinfit]["name"]);
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
                            texok("Sorry, only JPG, JPEG, PNG & GIF BMP PDF XLS XLSX DOC DOCX TXT CSV XML files are allowed.");
                            $uploadOk = 0;
                        }
                        else{
//echo 'target :'.$target_file.'*';                            
                            if (move_uploaded_file($_FILES[$quinfit]["tmp_name"], $target_file)) {
//echo "The file ". basename( $_FILES[$quinfit]["name"]). " has been uploaded. to ".$target_file."*";
                                $calif = retvar('calif'.$i);
                                $tiraadjunts .= '<li>' . $nounom . (($calif)?' ('.$calif.') ':'').'</li>';
                                $elsadjunts .= (($elsadjunts)?'|':'') . $target_file;
                            } else {
                                texok("Sorry, there was an error uploading your file.");
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

    
    $cos = str_replace('***booking***', $tira, $buf);
    include_once 'enviaemail.php';
    $que = enviaemail($df_lcle['emailbook']['val'],$df_lcle['emailbook']['val'],'IMPORT BOOKING - '.(($_SESSION['usr_nomcli'])?$_SESSION['usr_nomcli']:$_SESSION['usr_nomage']),$cos,html_entity_decode($cos),$elsadjunts,$GLOBALS['$emailimport'],'TCT SL','TCT SL',$GLOBALS['$emailimport'],'');
    if ($que){
        $_SESSION['missatge'] = ' <p>'.$que.'</p>';
    }
    else {
        $_SESSION['missatge'] = ' <p>'.(($langles)?'Email send.':'Email enviado.').'</p>';
        $_SESSION['misatge_noborra'] = 1;
    } 
?>

