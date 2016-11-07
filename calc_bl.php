<?php

        switch ($_SESSION['usr_clientoagent']) {
            case '1': // Client
                $ptdab['masterohbl']='1';
                break;
            case '2': // Agent
                $ptdab['masterohbl']='2';
                break;
            case '3': // Tct
                $ptdab['masterohbl']='1';
                break;
            default:
                break;
        }
        
        // Calculem les variables d'impresió
        
        $zzz = (($ptda['fcl'])?($pta['lpartrest']?($ptda['npartrest']):true):true);
        $mimerc = (($zzz)?$ptda['mmercancia']:$ptda['fmmercancia']);
        if (! empty($ptda['mmercancia2'])){
            $mimerc .= $crlf.$crlf.((($ptdab['doblebl']) && ($ptdab['masterohbl']=='1'))?$ptdab['mmercancia2']:$ptda['mmercancia2']);
        }
        $ctmp = "";
        switch ($ptda['ocenamarine']) {
            case "2": $ctmp = "OCEAN"; break;
            case "3": $ctmp = "MARINE"; break;
        default:
            break;
        }
//        $elshipper = (($ptdab['doblebl'] && ($ptdab['masterohbl']=='2')))?$ptdab['shipb']:$ptda['shiper'];
        $elshipper = (($zzz)?(($ptdab['doblebl'] && ($ptdab['masterohbl']=='2'))?$ptdab['shipb']:$ptda['shiper']):$ptdab['fshipper']);
        $elconsig = (($zzz)?(($ptdab['doblebl'] && ($ptdab['masterohbl']=='2'))?$ptdab['consigb']:$ptda['consignee']):$ptdab['fconsignee']);
        $elnotify = (($ptdab['doblebl'] && ($ptdab['masterohbl']=='2'))?$ptdab['notifyb']:$ptda['notifyparty']);
        $oceanvessel = (($ptda['lade'])?$ptda['bl_barco']:$ptda['descbarco']);
        $payable = (($ptdab['doblebl'] && ($ptdab['masterohbl']=='2'))?(($ptdab['originodesti']=='1')?"ORIGIN":"DESTINATION"):(($ptdab['precobl']=='1')?"ORIGIN":"DESTINATION"));
        $n = ($ptdab['doblebl'] && ($ptdab['masterohbl']=='2'))?$ptdab['copbl']:$ptda['copbl'];
        include_once 'iretnum.php';
        $ncopies = trim($n).'/'.  strtoupper(iretnum($n));
        $numbl = trim(($ptda['npartrest']=='2')?$ptda['bl2']:$ptda['bl']).(($ptdab['doblebl'] && ($ptdab['masterohbl']=='2'))?'/1':'').$ptdab['bl_nomes'];
//        $paquets = (($ptda['fcl'])?((($zzz)?$ptda['munitats']:$ptda['fmunitats'])):$ptda['bultos'].(($ptdab['ltipobult'])?" "+trim(rtipobul(lcl.tipobult)):''));
        $paquets = (($ptda['fcl'])?((($zzz)?$ptda['munitats']:$ptda['fmunitats'])):$ptda['bultos'].(($ptdab['ltipobult'])?" "+trim($ptda['tipobult']):''));
        $gross = "";
        if ($ptda['fcl']){
            $gross = (($zzz)?$ptda['impbl']:$ptda['fimpbl']);
        }
        else{
            $gross = $ptda['pes'];
            $dec = $gross - (int) $gross;
            $gross = ($dec==0)?number_format($gross,0,',','.'):number_format($gross,3,',','.');
        }
        $cntr = ($ptda['container']=="A")?$agrupa['refcon1']:(($ptda['container']=="B")?$agrupa['refcon2']:$agrupa['refcon3']);
        $seal = "";
        if ($ptdab['blseal']){
            $seal = "SEAL : ".(($ptda['container']=="A")?$agrupa['precinto1']:(($ptda['container']=="b")?$agrupa['precinto2']:$agrupa['precinto3']));
        }
        $elwm = '';
        if (! ($ptda['fcl'] || $ptda['noblwm'])){
            $elwm = number_format($ptda['bl_cbm'],3,',','.');
        }
        $elrate = '';
        if ($ptda['bl_ldetalle']){
            $elrate = number_format($ptda['bl_detalle'],0,',','.').' '.$ptda['divisa'];
        }
        $totalfreight = '';
        if ($ptda['bl_ltotal']){
            $totalfreight = $totalf;
        }

        $totalf = $ptda['divisa']." ".trim(number_format($ptda['fletbrut'],2,',','.'))." ".(($ptda['precoex']==1)?"PREPAID":(($ptda['precoex']==2)?"COLLECT":"EXWORKS"));
//        $placeanddate = ($ptdab['blfmdobcn']?'Barcelona':(PROPER(Lcl.bl_pol))).", "+date('d/m/y',$ptda['databl']);
        $placeanddate = (($ptdab['blfmdobcn'])?'Barcelona':$ptda['bl_pol']).", ".date('d/m/y',strtotime($ptda['databl']));
        $clausules = (($ptda['fcl'])?trim($prefer['claudeffcl']):trim($prefer['claudef'])).$crlf;
        if ($ptda['bl_claus1']){$clausules .= tornacamp($contmp, 'rollo', 'clausula', 'codi', $ptda['bl_claus1']).$crlf;}
        if ($ptda['bl_claus2']){$clausules .= tornacamp($contmp, 'rollo', 'clausula', 'codi', $ptda['bl_claus2']).$crlf;}
        if ($ptda['bl_claus3']){$clausules .= tornacamp($contmp, 'rollo', 'clausula', 'codi', $ptda['bl_claus3']).$crlf;}
        $codagent = "";
        if (($ptdab['doblebl'] && ($ptdab['masterohbl']=='2'))){
            $codagent = $ptda['cod_ro'];
        }
        else{
            if($ptda['bl_agnogen']){
                $codagent = $ptda['bl_codage'];
                if (empty($codagent)){
                    $codagent = $ptda['bl_codage2'];
                }
            }
            else{
                $codagent = $agrupa['codage'];
            }
        }
        $pintagent = "";
        if ($codagent){
            $loque = 'SELECT * FROM agents WHERE codi="'.$codagent.'"';
            $fconsag = mysqli_query($contmp,$loque);
            if ($agents = mysqli_fetch_array($fconsag)) {
                $pintagent .= trim($agents['nom']).$crlf.
                                trim($agents['domage']).$crlf.
                                trim($agents['domage2']).$crlf.
                                trim($agents['cpage']).' '.trim($agents['pobage']).', '.trim($agents['pais']).$crlf.
                                'PIC : '.trim($agents['contactoe']).$crlf.
                                'Tel.: '.trim($agents['telage1']).$crlf.
                                'Fax.: '.trim($agents['faxage1']).$crlf;
            }

        }

?>