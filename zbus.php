<?php
include_once 'lesvars.php';
session_start();
include_once 'milib.php';
include_once 'taules.php';
$cos = '';
$trobats = 0;
$com = ((isset($_REQUEST['com'])) && $_REQUEST['com'])?nohack($_REQUEST['com']):'';
$com = ($com)?1:0;
$xtab = ((isset($_REQUEST['xtab'])) && $_REQUEST['xtab'])?nohack($_REQUEST['xtab']):'';
$id = ((isset($_REQUEST['id'])) && $_REQUEST['id'])?nohack($_REQUEST['id']):'';
$id2 = ((isset($_REQUEST['id2'])) && $_REQUEST['id2'])?nohack($_REQUEST['id2']):'';
$elmaxim = ((isset($_REQUEST['elmaxim'])) && $_REQUEST['elmaxim'])?nohack($_REQUEST['elmaxim']):'';
$langles = esangles();
if ($com){
    $arr = array ('item1'=>"NOT FOUND.",'item2'=>"NOT FOUND.",'item3'=>$xtab.$id.$id2);
}
else{
    $arr = array ();
}
if ($xtab){
    $mysqli = conexioi();
    if ($mysqli){
        switch ($xtab) {
            case 'pol-voy':
                if ($com){ // Browse
                    $cos .= taules_capsa(array(array('unicweb',0,0,0),array('ETD',1,80,0),array('Cut Off',1,80,0),array((($langles)?'Vessel':'Barco'),1,0,0),array((($langles)?'Voy. No.':'VIaje'),1,0,0),array('TT',1,0,0)),$elmaxim);
                     $loque = 'SELECT * FROM scheweb WHERE ie="I" AND descrip="'.$id.'" ORDER BY etseta';
                     $ftorna = mysqli_query($mysqli,$loque);
                     while ($item = mysqli_fetch_array($ftorna)){
                        $trobats++;
                        $cos .= taules_lina($xtab,array(array($item['unicweb'],0,0),array(DTOC($item['etseta'],true),1,0),array(DTOC($item['closing'],true),1,0),array($item['nombarco'],1,0),array($item['viaje'],1,0),array($item['tt'],1,0)));
                     }
                    $cos .= taules_fi();
                    $arr = array ('item1'=>'POL','item2'=>$id,'item3'=>  $cos);
                }
                else{ // Retorns ...
                    $loque = 'SELECT * FROM scheweb WHERE ie="I" AND unicweb= "'.$id.'"';
                    $ftorna = mysqli_query($mysqli,$loque);
                    $item = mysqli_fetch_array($ftorna);
                    $arr = array ('punt'=>$item['descrip'],'+puntz'=>$item['descrip'],'elviaje'=>$item['viaje'],'+elviajez'=>$item['viaje'],'cutoff'=>$item['closing'],'+cutoffz'=>DTOC($item['closing'],true),'+laetsz'=>DTOC($item['etseta'],true),'laets'=>$item['etseta'],'laeta'=>$item['etseta2'],'+laetaz'=>DTOC($item['etseta2'],true),'+nombarcoz'=>$item['nombarco'],'elbarco'=>$item['nombarco']);
                }
                break;
            case 'pol':
                if ($com){ // Browse
                    $cos .= taules_capsa(array(array('POL',1,200,0)),$elmaxim);
                     $loque = 'SELECT DISTINCT descrip FROM scheweb WHERE ie="I" ORDER BY descrip';
                     $ftorna = mysqli_query($mysqli,$loque);
                     while ($item = mysqli_fetch_array($ftorna)){
                        $trobats++;
                        $cos .= taules_lina($xtab,array(array($item['descrip'],1,0)));
                     }
                    $cos .= taules_fi();
                    $arr = array ('item1'=>'POL','item2'=>'POL','item3'=>  $cos);
                }
                else{ // Retorns ...
                    $loque = 'SELECT descrip, viaje, unicweb, etseta, etseta2, nombarco, closing FROM scheweb WHERE ie="I" AND descrip= "'.$id.'"';
                    $ftorna = mysqli_query($mysqli,$loque);
                    $item = mysqli_fetch_array($ftorna);
                    $arr = array ('punt'=>$id,'+puntz'=>$id,'elviaje'=>$item['viaje'],'+elviajez'=>$item['viaje'],'cutoff'=>$item['closing'],'+cutoffz'=>DTOC($item['closing'],true),'+laetsz'=>DTOC($item['etseta'],true),'laets'=>$item['etseta'],'laeta'=>$item['etseta2'],'+laetaz'=>DTOC($item['etseta2'],true),'+nombarcoz'=>$item['nombarco'],'elbarco'=>$item['nombarco']);
                }
                break;
            case 'fpod-voy':
                if ($com){ // Browse
                    $cos .= taules_capsa(array(array('unicweb',0,0,0),array('ETS',1,80,0),array('Cut Off',1,80,0),array((($langles)?'Vessel':'Barco'),1,0,0),array((($langles)?'Voy. No.':'VIaje'),1,0,0),array('TT',1,0,0)),$elmaxim);
                     $loque = 'SELECT * FROM scheweb WHERE ie="E" AND descrip="'.$id.'" ORDER BY etseta';
                     $ftorna = mysqli_query($mysqli,$loque);
                     while ($item = mysqli_fetch_array($ftorna)){
                        $trobats++;
                        $cos .= taules_lina($xtab,array(array($item['unicweb'],0,0),array(DTOC($item['etseta'],true),1,0),array(DTOC($item['closing'],true),1,0),array($item['nombarco'],1,0),array($item['viaje'],1,0),array($item['tt'],1,0)));
                     }
                    $cos .= taules_fi();
                    $arr = array ('item1'=>'FPOD','item2'=>$id,'item3'=>  $cos);
                }
                else{ // Retorns ...
                    $loque = 'SELECT * FROM scheweb WHERE ie="E" AND unicweb= "'.$id.'"';
                    $ftorna = mysqli_query($mysqli,$loque);
                    $item = mysqli_fetch_array($ftorna);
                    $arr = array ('punt'=>$item['descrip'],'+puntz'=>$item['descrip'],'elviaje'=>$item['viaje'],'+elviajez'=>$item['viaje'],'+cutoffz'=>DTOC($item['closing'],true),'cutoff'=>$item['closing'],'+laetsz'=>DTOC($item['etseta'],true),'laets'=>$item['etseta'],'+nombarcoz'=>$item['nombarco'],'elbarco'=>$item['nombarco']);
                }
                break;
            case 'fpod':
                if ($com){ // Browse
                    $cos .= taules_capsa(array(array('FPOD',1,200,0)),$elmaxim);
                     $loque = 'SELECT DISTINCT descrip FROM scheweb WHERE ie="E" ORDER BY descrip';
                     $ftorna = mysqli_query($mysqli,$loque);
                     while ($item = mysqli_fetch_array($ftorna)){
                        $trobats++;
                        $cos .= taules_lina($xtab,array(array($item['descrip'],1,0)));
                     }
                    $cos .= taules_fi();
                    $arr = array ('item1'=>'FPOD','item2'=>'FPOD','item3'=>  $cos);
                }
                else{ // Retorns ...
                    $imonoperm = "";
                    $loque = 'SELECT imosno FROM punts WHERE descrip= "'.$id.'"';
                    $ftorna = mysqli_query($mysqli,$loque);
                    $item = mysqli_fetch_array($ftorna);
                    $imonoperm = ($item['imosno'])?$item['imosno']:'---';
                    $loque = 'SELECT descrip, viaje, unicweb, etseta, nombarco, closing FROM scheweb WHERE ie="E" AND descrip= "'.$id.'"';
                    $ftorna = mysqli_query($mysqli,$loque);
                    $item = mysqli_fetch_array($ftorna);
                    $arr = array ('punt'=>$id,'+puntz'=>$id,'elviaje'=>$item['viaje'],'+elviajez'=>$item['viaje'],'+cutoffz'=>DTOC($item['closing'],true),'cutoff'=>$item['closing'],'+laetsz'=>DTOC($item['etseta'],true),'laets'=>$item['etseta'],'+nombarcoz'=>$item['nombarco'],'elbarco'=>$item['nombarco'],'+imosno'=>$imonoperm);
                }
                break;
            case 'punt_export':
                if ($com){ // Browse
                    $cos .= taules_capsa(array(array('POD',1,200,0)),$elmaxim);
                    if ($id2){
                        $loque = "SELECT descrip, pais FROM punts WHERE ltarifase AND upper(pais) LIKE '".$id2."' ORDER BY descrip";
                    }
                    else{
                        $loque = "SELECT descrip, pais FROM punts WHERE ltarifase ORDER BY descrip";
                    }
                     $ftorna = mysqli_query($mysqli,$loque);
                     while ($item = mysqli_fetch_array($ftorna)){
                        $trobats++;
                        $cos .= taules_lina($xtab,array(array($item['descrip'],1,0)));
                     }
                    $cos .= taules_fi();
                    $arr = array ('item1'=>'POL','item2'=>'POL','item3'=>  $cos);
                }
                else{ // Retorns ...
                    $loque = 'SELECT pais FROM punts WHERE descrip="'.$id.'"';
                    $ftorna = mysqli_query($mysqli,$loque);
                    $item = mysqli_fetch_array($ftorna);
                    $arr = array ('puntse_punt'=>$id,'puntse_pais'=>$item['pais'],'!formexport'=>1);
                }
                break;
            case 'pais_export':
                if ($com){ // Browse
                    $cos .= taules_capsa(array(array((($langles)?'Country':'País'),1,200,0)),$elmaxim);
                    $loque =  "SELECT DISTINCT pais, ltarifase FROM punts WHERE ltarifase ORDER BY pais";
                     $ftorna = mysqli_query($mysqli,$loque);
                     while ($item = mysqli_fetch_array($ftorna)){
                        $trobats++;
                        $cos .= taules_lina($xtab,array(array($item['pais'],1,0)));
                     }
                    $cos .= taules_fi();
                    $arr = array ('item1'=>'PAIS','item2'=>'País','item3'=>  $cos);
                }
                else{ // Retorns ...
                    $arr = array ('puntse_pais'=>$id,'puntse_punt'=>'');
                }
                break;
            case 'punt_import':
                if ($com){ // Browse
                    $cos .= taules_capsa(array(array('POL',1,200,0)),$elmaxim);
                    if ($id2){
                        $loque = "SELECT descrip, pais FROM punts WHERE ltarifasi AND upper(pais) LIKE '".$id2."' ORDER BY descrip";
                    }
                    else{
                        $loque = "SELECT descrip, pais FROM punts WHERE ltarifasi ORDER BY descrip";
                    }
                     $ftorna = mysqli_query($mysqli,$loque);
                     while ($item = mysqli_fetch_array($ftorna)){
                        $trobats++;
                        $cos .= taules_lina($xtab,array(array($item['descrip'],1,0)));
                     }
                    $cos .= taules_fi();
                    $arr = array ('item1'=>'POL','item2'=>'POL','item3'=>  $cos);
                }
                else{ // Retorns ...
                    $loque = 'SELECT pais FROM punts WHERE descrip="'.$id.'"';
                    $ftorna = mysqli_query($mysqli,$loque);
                    $item = mysqli_fetch_array($ftorna);
                    $arr = array ('puntsi_punt'=>$id,'puntsi_pais'=>$item['pais'],'!formimport'=>1);
                }
                break;
            case 'pais_import':
                if ($com){ // Browse
                    $cos .= taules_capsa(array(array((($langles)?'Country':'País'),1,200,0)),$elmaxim);
                    $loque = "SELECT DISTINCT pais, ltarifasi FROM punts WHERE ltarifasi ORDER BY pais";
                     $ftorna = mysqli_query($mysqli,$loque);
                     while ($item = mysqli_fetch_array($ftorna)){
                        $trobats++;
                        $cos .= taules_lina($xtab,array(array($item['pais'],1,0)));
                     }
                    $cos .= taules_fi();
                    $arr = array ('item1'=>'PAIS','item2'=>'País','item3'=>  $cos);
                }
                else{ // Retorns ...
                    $arr = array ('puntsi_pais'=>$id,'puntsi_punt'=>'');
                }
                break;
            // Per recuperar Shippers, Consignees & Notify de Importació
            case 'notify':
            case 'consignee':
            case 'shipper':
                $n = 0;
                if ($com){ // Browse
                    $cos .= taules_capsa(array(array('Cod.',0,0,0),array(ucfirst($xtab),1,350,0)),$elmaxim);
                    $loque = 'SELECT descrip,unic FROM shipper WHERE tipo="'.$id2.'" AND codcli="'.$id.'" ORDER BY descrip';
//                    $loque = 'SELECT descrip,unic FROM shipper WHERE tipo="'.$id2.'"  ORDER BY descrip';
                     $ftorna = mysqli_query($mysqli,$loque);
                     while ($item = mysqli_fetch_array($ftorna)){
                        if (empty($n) && ($xtab == 'notify')){
                            $cos .= taules_lina($xtab,array(array("1",0,0),array('The same as consignee',1,0)));
                        }
                        $n++;
                        $trobats++;
                        $cos .= taules_lina($xtab,array(array($item['unic'],0,0),array($item['descrip'],1,0)));
                     }
                     if  (empty($n) && ($xtab == 'notify')){
                        $cos .= taules_lina($xtab,array(array("1",0,0),array('The same as consignee',1,0)));
                        $trobats = 1;
                     }
                    $cos .= taules_fi();
                    $arr = array ('item1'=>  strtoupper($xtab),'item2'=>ucfirst($xtab),'item3'=>  $cos);
                }
                else{ // Retorns ...
                    $loque = 'SELECT * FROM shipper WHERE unic="'.$id.'"';
                     $ftorna = mysqli_query($mysqli,$loque);
                     if ($item = mysqli_fetch_array($ftorna)){
                        $trobats++;
                        switch ($xtab) {
                            case 'shipper':
                                $arr = array ('shipper'=>$item['descrip'],'dirship'=>$item['direc'],'pobship'=>$item['pobla'],'zipship'=>$item['zip']
                                    ,'proship'=>$item['provin'],'paisship'=>$item['pais'],'telship'=>$item['tel'],'mailship'=>$item['mail']
                                    ,'picship'=>$item['pic']);
                                break;
                            case 'consignee':
                                $arr = array ('consignee'=>$item['descrip'],'dircons'=>$item['direc'],'pobcons'=>$item['pobla'],'zipcons'=>$item['zip']
                                    ,'procons'=>$item['provin'],'paiscons'=>$item['pais'],'telcons'=>$item['tel'],'mailcons'=>$item['mail']
                                    ,'piccons'=>$item['pic']);
                                break;
                            case 'notify':
                                $arr = array ('notify'=>$item['descrip'],'dirnoty'=>$item['direc'],'pobnoty'=>$item['pobla'],'zipnoty'=>$item['zip']
                                    ,'pronoty'=>$item['provin'],'paisnoty'=>$item['pais'],'telnoty'=>$item['tel'],'mailnoty'=>$item['mail']
                                    ,'picnoty'=>$item['pic']);
                                break;
                        }
                     }
                }
                break;
                // Per recuperar ofertas de Importació
            case 'ofe':
                if ($com){ // Browse
                    $cos .= taules_capsa(array(array('Cod.',1,0,0),array('POL',1,200,0),array((($langles)?'Bultos':'Bultos'),1,0,1),array('KGs',1,0,1),array('CBM',1,0,1)),$elmaxim);

                    if ($id2){$loque = 'SELECT * FROM ofe WHERE codcli="'.$id.'" AND descpol="'.$id2.'" ORDER BY codi DESC';}
                    else{$loque = 'SELECT * FROM ofe WHERE codcli="'.$id.'" ORDER BY codi DESC';}

                     $ftorna = mysqli_query($mysqli,$loque);
                     while ($item = mysqli_fetch_array($ftorna)){
                        $trobats++;
                        $cos .= taules_lina($xtab,array(array($item['codi'],1,0),array($item['descpol'],1,0),array($item['bultos'],1,1),array($item['pes'],1,1),array($item['cbm'],1,1)));
                     }
                    $cos .= taules_fi();
                    $arr = array ('item1'=>'OFERTAS','item2'=>'Ofertas','item3'=>  $cos);
                }
                else{ // Retorns ...
                    $loque = 'SELECT * FROM ofe WHERE codi="'.$id.'"';
                     $ftorna = mysqli_query($mysqli,$loque);
                     if ($item = mysqli_fetch_array($ftorna)){
                        $trobats++;
                        $arr = array ('oftct'=>$item['codi'],'bultos'=>$item['bultos'],'kilos'=>$item['pes'],
                                        'cbmmax'=>$item['cbm'],'mercancia'=> $item['mercancia'],'volimo'=>($item['imo']?1:0),
                                        '*incoterm'=>$item['incoterms'],'*tipobult'=>$item['tipobult']);
                     }
                }
                break;
                // Per recuperar ofertas de Exportació
            case 'ofertas':
                if ($com){ // Browse
                    $cos .= taules_capsa(array(array('Cod.',1,0,0),array('FPOD',1,200,0),array((($langles)?'Bultos':'Bultos'),1,0,1),array('KGs',1,0,1),array('CBM',1,0,1)),$elmaxim);

                    if ($id2){$loque = 'SELECT * FROM ofertas WHERE codcli="'.$id.'" AND descpunt="'.$id2.'" ORDER BY codi DESC';}
                    else{$loque = 'SELECT * FROM ofertas WHERE codcli="'.$id.'" ORDER BY codi DESC';}

                     $ftorna = mysqli_query($mysqli,$loque);
                     while ($item = mysqli_fetch_array($ftorna)){
                        $trobats++;
                        $cos .= taules_lina($xtab,array(array($item['codi'],1,0),array($item['descpunt'],1,0),array($item['bultos'],1,1),array($item['pes'],1,1),array($item['cbm'],1,1)));
                     }
                    $cos .= taules_fi();
                    $arr = array ('item1'=>'OFERTAS','item2'=>'Ofertas','item3'=>  $cos);
                }
                else{ // Retorns ...
                    $loque = 'SELECT * FROM ofertas WHERE codi="'.$id.'"';
                     $ftorna = mysqli_query($mysqli,$loque);
                     if ($item = mysqli_fetch_array($ftorna)){
                        $trobats++;
                        $arr = array ('oftct'=>$item['codi'],'bultos'=>$item['bultos'], '*tipobult'=>$item['tipobult'],
                                        'kilos'=>$item['pes'],'cbmmax'=>$item['cbm'],'mercancia'=> $item['mercancia'],'*incoterm'=>$item['incoterms'],
                                        'volimo'=>($item['imo']?1:0));
                     }
                }
                break;
        default:
                 //$arr = array ('item1'=>'NOT FOUND','item2'=>  'NOT FOUND','item3'=>  '<p>NOT FOUND</p>');
            break;
        }
    }
}
if ($com && ($trobats == 0)){
    $arr = array ('item1'=>'***'.(($langles)?'Not Found':'No encontrado'),'item2'=> (($langles)?'NOT FOUND':'NO ENCONTRADO'),'item3'=>  '<p>'.(($langles)?'Not found':'No Encontrado').'</p>');
}
echo json_encode($arr);
?>