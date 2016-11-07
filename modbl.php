<?php
    include_once 'sempre.php';
    include 'htmldoctipe.php';
    include 'enviaemail.php';
    function diferents($a,$b,$quin='1'){
        $a = trim($a);
        $b = trim($b);
        if ($a == $b || (empty($a) && empty($b))){
            return '';
        }
        else{
            switch ($quin) {
                case '1':
                        return '<span style="color:#103F75; background-color: yellow;"><b>';
                    break;
                case '2':
                        return ((empty($b))?'<i>'.(($GLOBALS['$langles'])?'***EMPTY***':'***VACIO***').'</i>':'').'</b></span>';
                    break;
                default:
                    break;
            }
        }
    }
    
    $laptda = retvar('ptda');
    if ($laptda){
        $shipper = trim(retvar('shipper'));
        $xshipper = trim(retvar('xshipper'));
        $consignee = trim(retvar('consignee'));
        $xconsignee = trim(retvar('xconsignee'));
        $notify = trim(retvar('notify'));
        $xnotify = trim(retvar('xnotify'));
        $por = trim(retvar('por'));
        $xpor = trim(retvar('xpor'));
        $pol = trim(retvar('pol'));
        $xpol = trim(retvar('xpol'));
        $pod = trim(retvar('pod'));
        $xpod = trim(retvar('xpod'));
        $delivery = trim(retvar('delivery'));
        $xdelivery = trim(retvar('xdelivery'));
        $payable = trim(retvar('payable'));
        $xpayable = trim(retvar('xpayable'));
        $numbls = trim(retvar('numbls'));
        $xnumbls = trim(retvar('xnumbls'));
        $blno = trim(retvar('blno'));
        $marks = trim(retvar('marks'));
        $xmarks = trim(retvar('xmarks'));
        $units = trim(retvar('units'));
        $xunits = trim(retvar('xunits'));
        $goods = trim(retvar('goods'));
        $xgoods = trim(retvar('xgoods'));
        $kgs = trim(retvar('kgs'));
        $xkgs = trim(retvar('xkgs'));
        $volume = trim(retvar('volume'));
        $xvolume = trim(retvar('xvolume'));
        $wm = trim(retvar('wm'));
        $xwm = trim(retvar('xwm'));
        $rate = trim(retvar('rate'));
        $xrate = trim(retvar('xrate'));
        $tfreight = trim(retvar('tfreight'));
        $xtfreight = trim(retvar('xtfreight'));
        $message = trim(retvar('message'));
        // Guardem la modificació a MODBL
        $quefa = 'INSERT INTO modbl (ptda, shipper, consignee, notify,por,pol,pod, delivery, payable, numbls, marks, units, goods, kgs, volume, wm, rate, tfreight, message)'.
                'VALUES ("'.$laptda.'","'.$shipper.'","'.$consignee.'","'.$notify.'","'.$por.'","'.$pol.'","'.$pod.'","'.$delivery.'","'.$payable.'"'.
                ',"'.$numbls.'","'.$marks.'","'.$units.'","'.$goods.'","'.$kgs.'","'.$volume.'","'.$wm.'","'.$rate.'","'.$tfreight.'","'.$message.'")';
        $xcon = conexioi();
        if ($xcon){
            $fconstmp = mysqli_query($xcon,$quefa);
        }
        // Creem la taula pel email ...
        $em_col1 = 'text-align:right;padding:5px 2px 5px 10px;valign:top;';
        $em_col2 = 'text-align:left;padding:5px 10px 5px 2px;';
        // background-color: transparent;
        $tira = '<div style=";align:top;text-align:left;"><table style="border:black 1px solid;border-spacing:0;width:400px;margin-left:auto; margin-right:auto; ">';
        $tira .= '<th style="background-color:rgb(16,63,117);color:white;font-weight: bold;padding:10px">Ref. '.$laptda.(($_SESSION['usr_codcli'])?' / '.$_SESSION['usr_codcli']:'').'</th><th style="background-color:rgb(16,63,117);color:white;font-weight: bold;padding:10px""></th>';
        if ($shipper || $xshipper){$tira .= posatr('Shipper',diferents($xshipper,$shipper,'1').crtocr($shipper,chr(13)).diferents($xshipper,$shipper,'2'),false,$em_col1,$em_col2);}
        if ($consignee || $xconsignee){$tira .= posatr('Consigenee',diferents($xconsignee,$consignee,'1').crtocr($consignee,chr(13)).diferents($xconsignee,$consignee,'2'),false,$em_col1,$em_col2);}
        if ($notify || $xnotify){$tira .= posatr('Notify Party',diferents($xnotify,$notify,'1').crtocr($notify,chr(13)).diferents($xnotify,$notify,'2'),false,$em_col1,$em_col2);}
        if ($por || $xpor){$tira .= posatr('Place of receipt',diferents($xpor,$por,'1').$por.diferents($xpor,$por,'2'),false,$em_col1,$em_col2);}
        if ($pol || $xpol){$tira .= posatr('Port of landing',diferents($xpol,$pol,'1').$pol.diferents($xpol,$pol,'2'),false,$em_col1,$em_col2);}
        if ($pod || $xpod){$tira .= posatr('Port of discharge',diferents($xpod,$pod,'1').$pod.diferents($xpod,$pod,'2'),false,$em_col1,$em_col2);}
        if ($delivery || $xdelivery){$tira .= posatr('Place of ddelivery',diferents($xdelivery,$delivery,'1').$delivery.diferents($xdelivery,$delivery,'2'),false,$em_col1,$em_col2);}
        if ($payable || $xpayable){$tira .= posatr('Freight payable at',diferents($xpayable,$payable,'1').$payable.diferents($xpayable,$payable,'2'),false,$em_col1,$em_col2);}
        if ($numbls || $xnumbls){$tira .= posatr('Numb. of origin. B/L\'s',diferents($xnumbls,$numbls,'1').crtocr($numbls,chr(13)).diferents($xnumbls,$numbls,'2'),false,$em_col1,$em_col2);}
        if ($marks || $xmarks){$tira .= posatr('Marks & numbers',diferents($xmarks,$marks,'1').crtocr($marks,chr(13)).diferents($xmarks,$marks,'2'),false,$em_col1,$em_col2);}
        if ($goods || $xgoods){$tira .= posatr('Goods',diferents($xgoods,$goods,'1').crtocr($goods,chr(13)).diferents($xgoods,$goods,'2'),false,$em_col1,$em_col2);}
        if ($kgs || $xkgs){$tira .= posatr('Gross weight',diferents($xkgs,$kgs,'1').crtocr($kgs,chr(13)).diferents($xkgs,$kgs,'1'),false,$em_col1,$em_col2);}
        if ($volume || $xvolume){$tira .= posatr('Volume',diferents($xvolume,$volume,'1').$volume.diferents($xvolume,$volume,'2'),false,$em_col1,$em_col2);}
        if ($wm || $xwm){$tira .= posatr('W/M',diferents($xwm,$wm,'1').$wm.diferents($xwm,$wm,'2'),false,$em_col1,$em_col2);}
        if ($rate || $xrate){$tira .= posatr('Rate',diferents($xrate,$rate,'1').$rate.diferents($xrate,$rate,'2'),false,$em_col1,$em_col2);}
        if ($tfreight || $xtfreight){$tira .= posatr('Total Freight',diferents($xtfreight,$tfreight,'1').$tfreight.diferents($xtfreight,$tfreight,'2'),false,$em_col1,$em_col2);}
        $tira .= '</table><div>';
//$_SESSION['tmp'] = $tira;
        //
        $tmp = texteweb('OK_MOD_HBL',0);
        $locualo = 'EXPORT BL '.(($langles)?' modify request':' petición de modificación');
        $cos = '<div>'.$tira.'</div><p>&nbsp;</p><div><p>'.$tmp.'</p></div></br></br>';
        $_SESSION['missatge'] = '';
        trackweb('PETICION DE MODIFICACIONES DE H/BL','EXPORT BL : MODIFY REQUEST','',$laptda,'E');
        $que = enviaemail($GLOBALS['$email_web'],'TCT SL - EXPORT',$locualo.' - TCT SL',$cos,html_entity_decode($cos),'',$GLOBALS['$email_web'],'TCT SL',$_SESSION['usr_nomuser'].' - '.$_SESSION['usr_nomcli'],$_SESSION['usr_email'],'');
        if ($que){
            $_SESSION['missatge'] = ' <p>'.$que.'</p>';
        }
        else{
            $_SESSION['missatge'] = '<p>'.$tmp.'</p><p>'.(($langles)?'Email send.':'Email enviado.').'</p>';
            $_SESSION['misatge_noborra'] = 0;
        }
        // Retornem a la partida
        saltaa('ptda_export.php?siscon_param='.$laptda);
    }
    else{
        saltaa('login.php');
    }
?>
