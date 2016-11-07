<?php

//function tracking($elcodi="999999",$eltipus="XX",$contmp){
    $langles = $GLOBALS['$langles'];
    // TRAKING
    echo'<div class="container">';
    echo '<div class="row" style="padding: 10px 0px 20px 0px;">';
    echo '<div class="col-md-12">';
    echo'<div class="panel panel-primary">';
    echo '<div class="panel-heading">TRACK & TRACE</div>';
    echo '<div class="panel-body wow fadeInDown"><div class="row">';
    echo '<div class="container-fluid col-md-4">'; // Primera columna
    switch ($eltipus) {
        case 'PI':
            if (DTOC($viae['ets'])){
                echo eti_mas_dato(DTOC($viae['ets']),"ETD");
            }
            break;
        default:
            break;
    }
    $loque = 'SELECT * FROM track WHERE codi="'.$elcodi.'" AND tipus="'.$eltipus.'" ORDER BY dt';
    $fcons1 = mysqli_query($contmp,$loque);
    while ($track = mysqli_fetch_array($fcons1)) {
        if (($track['privat'])?estct():true){
            $segueix = true;
            $volcandau = false;
            switch ($eltipus) {
                case 'PE':
                    if ($ptdab['doblebl']){
                        if (strpos($track['calif'], "NVIO COPIA DE BL") !== false) {
                            if ($_SESSION['usr_clientoagent'] == '1'){
                               $segueix = false;
                            }
                            else{
                                if ($_SESSION['usr_clientoagent'] == '3'){
                                    $volcandau = true;
                                }
                            }
                        }
                    }
                    break;
                case 'PI':
                    break;
            }
            if ($segueix){
                // Adjunt
                $trfets = 0;
                $quepinta = "";
                if ($track['cadjunt'] && (! esagent())){
                    $aradj = explode(';',$track['adjunt']);
                    $son = count($aradj);
                    for($i=0;$i<$son;$i++){
                        if ($aradj[$i]){
                            $n = stripos($aradj[$i],'ATTACH\\');
                            $k = stripos($aradj[$i],'DOCS\\');
                            $nomfit = "";
                            $eldir = "";
                            if ($n){
                                $ctmp = substr($aradj[$i],$n+7);
                                $art = explode('\\',$ctmp);
                                $nomfit = strtolower($art[0]."/".str_ireplace(';','',$art[1]));
                                $eldir = $GLOBALS['$dirateamil'];
                                $origen = "TRACK";
                            }
                            elseif($k){
                                $ctmp = substr($aradj[$i],$k+5);
                                $art = explode('\\',$ctmp);
                                $nomfit = strtolower($art[0]."/".str_ireplace(';','',$art[1]));
                                $eldir = $GLOBALS['$dirdocs'];
                                $origen = "TRACK-D";
                            }
                            if ($nomfit){
                                $trfets++;
                                $quepinta .= un_doc($track['unic'],'',$eldir,$art[0]."/".$art[1],$track['tipus'],(($trfets=="1")?'>P':''),$origen,$track['calif']);
    //echo '*'.$nomfit.'*' ;                                                   
                            }
                        }
                    }
                }
                if ($trfets){
                    $quepinta .= un_doc('','','','','','>D');
                }
                // Fi del Adjunt
                // Hi ha email ?
                $quemes = '<span>';
                if ($track['tema']){
                    $elonclick = (esagent())?'':'onClick = "emailcli(\''.$track['unic'].'\');"';
                    $quemes = '<span id="zzz" '.$elonclick.' data-toggle="tooltip" title="'.(($langles)?'email text':'Texto del email').'">'.(esagent()?'':'<i class="fa fa-envelope"></i> ');
                }
                IF ($track['privat'] || $volcandau){
                    $quemes = miratct(). $quemes;
                }
                echo eti_mas_dato(date(($langles)?'m/d/y':'d/m/y', strtotime($track['dt'])),'<div>'.$quemes.(($track['descrip'])?$track['descrip']:$track['calif']).'</span></div>'.(($trfets)?'<div>'.$quepinta.'</div>':''));
            }
        }
    }
    switch ($eltipus) {
    case 'PI':
        if (DTOC($ptda['data_surt_depot'])){
            echo eti_mas_dato(DTOC($ptda['data_surt_depot'],false, false),(($langles)?'PICKUP DATE':'SALIDA ALMAC&Eacute;N'));
        }
        break;
    default:
        break;
    }
    echo '</div>';
        echo '<div class="container-fluid col-md-4">';
            switch ($eltipus) {
                case 'PI':
                    if ($ptda['lvuidat']){
//                        $loquedocs = 'SELECT * FROM docs WHERE natur="PI" and codi="'.$ptda['codi'].'" AND calif="FOTOS" '.((esagent())?' || calif="FOTO AGENTE"':'').' ORDER BY calif';
                        $loquedocs = 'SELECT * FROM docs WHERE natur="PI" and codi="'.$ptda['codi'].'" AND (calif="FOTOS" or calif="FOTO AGENTE") ORDER BY calif';
                        $fconsdoc = mysqli_query($contmp,$loquedocs);
                        while($xdocs = mysqli_fetch_array($fconsdoc)) {
                            // $diu = un_doc($xdocs['unic'],  strtolower($xdocs['ext']),$GLOBALS['$dirdocs'].'/'.$xdocs['ext'].'/',$xdocs['unic'],"","","DOCS",'',false,false);
                            $fitxer = $GLOBALS['$dirdocs'].$xdocs['eldir'].'/'.$xdocs['unic'].'.'.strtolower($xdocs['ext']);
                            $b = 'assets/img/camera.png';
                            $mostra = '<img src="'.$b.'" ALT="PHOTO'.$xdocs['unic'].'">';
                            $elhref = 'showfile.php?fid='.trim($xdocs['unic']).'&deon='.$eltipus.'&elnom='.$xdocs['unic'].'&origen=DOCS';
                            echo '<a href="'.$elhref.'" target="_blank">'.$mostra.'</a>';
                        }
                    }
                    break;
                default:
                    break;
            }
        echo '</div>';
        echo '<div class="container-fluid col-md-4">';
            $loquetrw = 'SELECT * FROM trackweb WHERE ie="'.(($eltipus=='PI')?'I':'E').'" and ptda="'.$ptda['codi'].'" ORDER BY data';
            $fconstrw = mysqli_query($contmp,$loquetrw);
            while($trackweb = mysqli_fetch_array($fconstrw)) {
                $quemes = '';
                if ($trackweb['rollo']){
                    $quemes = '<span id="zzz" onClick = "wemailcli(\''.$trackweb['codi'].'\');"><i class="fa fa-envelope"></i> ';
                }
                echo eti_mas_dato(DTOC($trackweb['data']),$quemes.(($langles)?$trackweb['descrip']:$trackweb['descripa']));                
            }
        echo '</div>';
    echo '</div>';
    echo '</div></div></div></div></div>'; 
    // fi TRAKING


?>