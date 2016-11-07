<?php

$em_col1 = 'text-align:right;padding:2px 10px 2px 0px;valign:top;';
$em_col2 = 'text-align:left;padding:2px 2px 2px 10px;';

$buf = texteweb('GRACIAS_COTIZA');
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
    $tira .= posatr((($langles)?(($esagent)?'Agent':'Client'):(($esagent)?'Agente':'Cliente')),$df_rq['empresa']['val'],false,$em_col1,$em_col2); 

    $tira .= posatr(ladesc($df_rq['elpic']),$df_rq['elpic']['val'],true,$em_col1,$em_col2);
    $tira .= posatr(ladesc($df_rq['telefon']),$df_rq['telefon']['val'],true,$em_col1,$em_col2);
    $tira .= posatr(ladesc($df_rq['email']),$df_rq['email']['val'],true,$em_col1,$em_col2);
    $tira .= posatr(ladesc($df_rq['eltipo']),$df_rq['eltipo']['val'],true,$em_col1,$em_col2);
    $tira .= posatr(ladesc($df_rq['pol']),$df_rq['pol']['val'],true,$em_col1,$em_col2);
    $tira .= posatr(ladesc($df_rq['pod']),$df_rq['pod']['val'],true,$em_col1,$em_col2);
    $tira .= posatr(ladesc($df_rq['placeod']),$df_rq['placeod']['val'],true,$em_col1,$em_col2);

    $tira .= posatr('IMO',sino($df_rq['volimo']['val']),false,$em_col1,$em_col2); 
    if ($df_rq['volimo']['val']){
        $tira .= posatr(ladesc($df_rq['rolloimo']),cr_to_br($df_rq['rolloimo']['val']),false,$em_col1,$em_col2); 
    }
    $tira .= posatr(ladesc($df_rq['mercancia']),cr_to_br($df_rq['mercancia']['val']),false,$em_col1,$em_col2); 
    $tira .= posatr(ladesc($df_rq['incoterm']),  $df_rq['incoterm']['val'],false,$em_col1,$em_col2); 
    $tira .= posatr(ladesc($df_rq['lclfcl']),($df_rq['lclfcl']['val']=='1')?'LCL':'FCL',false,$em_col1,$em_col2);
    if (($df_rq['lclfcl']['val']=='2')){
        $tira .= posatr(ladesc($df_rq['rollocntr']),  cr_to_br($df_rq['rollocntr']['val']),true,$em_col1,$em_col2); 
        $tira .= posatr(ladesc($df_rq['adreca']),cr_to_br($df_rq['adreca']['val']),false,$em_col1,$em_col2); 
    }
    else{
        $tira .= posatr(ladesc($df_rq['bultos']),$df_rq['bultos']['val'].' '.$df_rq['tipobult']['val'],false,$em_col1,$em_col2); 
        $tira .= posatr(ladesc($df_rq['kilos']),$df_rq['kilos']['val'].' Kgs',false,$em_col1,$em_col2); 
        $tira .= posatr(ladesc($df_rq['cbmmax']),$df_rq['cbmmax']['val'].' m3',false,$em_col1,$em_col2); 
        $tira .= posatr(ladesc($df_rq['rollomides']),  cr_to_br($df_rq['rollomides']['val']),true,$em_col1,$em_col2); 
    }

    $tira .= posatr(ladesc($df_rq['rollo']),  cr_to_br($df_rq['rollo']['val']),true,$em_col1,$em_col2); 
    
    $tira .= '</table><div>';

    $cos = $buf.'</br></br><p>'.$tira.'</p>';
    $elsadjunts = '';
    include_once 'enviaemail.php';
    $que = enviaemail($df_rq['email']['val'],$df_rq['email']['val'],(($langles)?'QUOTATION REQUEST':'SOLICITUD DE COTIZACION').' - '.$df_rq['empresa']['val'],$cos,html_entity_decode($cos),$elsadjunts,$GLOBALS['$email_web'],'TCT SL','TCT SL',$GLOBALS['$email_web'],'');
    if ($que){
        $_SESSION['missatge'] = ' <p>'.$que.'</p>';
    }
    else {
        $_SESSION['missatge'] = ' <p>'.(($langles)?'Email send.':'Email enviado.').'</p>';
        $_SESSION['misatge_noborra'] = 1;
    } 
?>

