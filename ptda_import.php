<?php
    $amblog = 1;
    include_once 'sempre.php';
    include 'htmldoctipe.php';
    $showvessel = true;
    $lamain = "";
    $esro = false;
    $lsalta = false; $saltab = false;
    $ptda = NULL; $ptdab = NULL; $viae = NULL; $viaeb = NULL; ; $viajee = NULL; $cdepot = ''; $depot = NULL; $ncontaine = '';
    if (hies()){
        if(isset($_REQUEST['siscon_param']) && $_REQUEST['siscon_param']){
            $lat3 = 0;
            $elconten = "";
            $anterior = retvar('anterior');
            $seguent = retvar('seguent');
            $laptda = $_REQUEST['siscon_param']; 
            if ($anterior || $seguent){
                if (esagent()){
                    $quemes = ($_SESSION['usr_codage'])?' AND codage="'.$_SESSION['usr_codage'].'"':'';
                }
                else{
                    $quemes = ($_SESSION['usr_codcli'])?' AND codcli="'.$_SESSION['usr_codcli'].'"':'';
                }
                $laptda = skip($anterior?1:-1,'lcleviae','codi',$laptda,$quemes);
            }
            $contmp = conexioi();
            $xcodage = '';
            $loque = 'SELECT codage FROM lcleviae WHERE codi="'.$laptda.'"';
            $fcons = mysqli_query($contmp,$loque);
            if ($zz = mysqli_fetch_array($fcons)) {
                $xcodage = $zz['codage'];
            }
            $loque = 'SELECT * FROM lcle WHERE codi="'.$laptda.'"';
            $fcons = mysqli_query($contmp,$loque);
            if ($ptda = mysqli_fetch_array($fcons)) {
//                if (($_SESSION['usr_tct'])?true:(esagent())?:($ptda['codcli'] == $_SESSION['usr_codcli'])){
                if (($_SESSION['usr_tct'])?true:((esagent())?($xcodage == $_SESSION['usr_codage']):($ptda['codcli'] == $_SESSION['usr_codcli']))){
                    $ncontaine = trim(($ptda['ncontaine'])?$ptda['ncontaine']:'1');

                    $loquet3 = 'SELECT fob FROM lcleotro WHERE lcle="'.$ptda['codi'].'" and confac="018"';
                    $fconst3 = mysqli_query($contmp,$loquet3);
                    if ($xxxt3 = mysqli_fetch_array($fconst3)) {
                        $lat3 = $xxxt3['fob'];
                    }
                    $loque = 'SELECT * FROM viae WHERE ref="'.$ptda['ref'].'"';
                    $fconsc = mysqli_query($contmp,$loque);
                    if ($viae = mysqli_fetch_array($fconsc)) {
                        $loque = 'SELECT * FROM viaeb WHERE ref="'.$ptda['ref'].'"';
                        $fconsd = mysqli_query($contmp,$loque);
                        if ($viaeb = mysqli_fetch_array($fconsd)) {
                            $loque = 'SELECT * FROM viajee WHERE codi="'.$viae['codi'].'"';
                            $fconse = mysqli_query($contmp,$loque);
                            if ($viajee = mysqli_fetch_array($fconse)) {
                                $cdepot = $viajee['coddepot'];
                            }
                            $loque = 'SELECT * FROM contens WHERE ref="'.$viae['ref'].$ncontaine.'"';
                            $fconsf = mysqli_query($contmp,$loque);
                            if ($contens = mysqli_fetch_array($fconsf)) {
                                if ($contens['cdepot']){
                                    $cdepot = $contens['cdepot'];
                                }
                            }
                            if ($cdepot){
                                $loque = 'SELECT * FROM depot WHERE codi="'.$cdepot.'"';
                                $fconsg = mysqli_query($contmp,$loque);
                                if ($depot = mysqli_fetch_array($fconsg)) {
                                }
                            }
                        }
                        else{$lsaltab=true;}
                    }
                    else{
                        if ($ptda['ro']){
                            $loque = 'SELECT * FROM ro WHERE codi="'.$laptda.'"';
                            $fconsro = mysqli_query($contmp,$loque);
                            if ($ro = mysqli_fetch_array($fconsro)) {
                                $esro = true;
                            }
                            else{$lsaltab=true;}
                        }
                        else{$lsaltab=true;}
                    }
                }
            }
            else{$lsalta=true;}
        }
        else{$lsalta=true;}
    }
    else{$lsalta=true;}
    
    //if ($lsaltab){saltaa('export_my_bookings.php');}
    if ($lsalta){saltaa('login.php');}
?>
<html lang="<?php echo(($langles)?'en':'es');?>">
    <head>
        <?php
        // Meta
        include_once 'htmlmeta.php';
        htmlmeta('login');
        // CSS
        include_once 'htmlestils.php';
        htmlestils('',1,0,0,0,0,1); // nom de pantalla, wow, 0 slide, 0 popup, 0 google maps, Captcha, grid

        ?>
    </head>
    <body>
        <?php 
            // <!-- Top menu -->
            $showvessel = ($viaeb)?($viaeb['nomostra']==0):$ptda['ro'];
            menutct();
            $elhref_torna = 'onClick="window.location.href=\'import_my_bookings.php\';"';
            // -- Page Title -->
            pagetitle("Mis Bookings : IMPORT",nom_usroagent(),"My Bookings : IMPORT",nom_usroagent(),"bookings",$elhref_torna); 
            guardaquefan("PARTIDA IMPORT","CONSULTA",$laptda);
        ?>
            <div class="container">
                <div class="row" style="padding: 10px 0px 20px 0px;">
                    <div class="col-xs-2 text-left" style="padding: 20px;">
                        <button type="submit" name="totes" class="btn btn-primary" value="back" <?php echo $elhref_torna;?>><?php echo ($langles)?'Back':'Volver'; ?></button>
                    </div>
                    <form>
                    <div class="col-xs-8 text-left" style="padding: 20px;"></div>
                        
                    <div class="col-xs-2 text-right" style="padding: 20px;">
                        <?php echo html_input_hidden('siscon_param',$laptda); ?>
                        <button type="submit" name="anterior" class="btn btn-primary" value="anterior"><i class="fa fa-arrow-left"></i></button>
                        <button type="submit" name="seguent" class="btn btn-primary" value="seguent"><i class="fa fa-arrow-right"></i></button>
                    </div>
                    </form>
                    
                    <div class="col-md-12">
                        <div class="panel panel-primary">
                            <?php
                            echo '<div class="panel-heading">Ref. <b><span style="color:darkorange;">'.$ptda['codi'].'</span></b>'.(($_SESSION['usr_tct'])?' / '.(miratct()).(($esro)?'R.O.':'').'<a href="agr_import.php?siscon_param='.$ptda['ref'].'">'.$ptda['ref'].'</a>'.(($viae['cocarga'])?' CO':''):'').'</div>';
                                echo '<div class="panel-body"><div class="row">';
                                    echo '<div class="container-fluid col-md-4">'; // Primera columna
                                        if (empty($_SESSION['usr_codcli'])){echo eti_mas_dato(miratct()."Cliente",$ptda['client'],"ralla_abaix");}
                                        echo eti_mas_dato((($langles)?'Shipment':'Partida'),(($ptda['fcl'])?'FCL':'LCL'));
                                        if ($ptda['refcli']){
                                            echo eti_mas_dato((($langles)?'Your Ref.':'Su Ref.'),$ptda['refcli']);
                                        }
                                        echo eti_mas_dato('POL',$ptda['descpol'].(($ptda['por'])?' ('.$ptda['por'].')':''));
                                        echo eti_mas_dato('Incoterm',$ptda['incoterms'],(($ptda['bl'])?'':"ralla_abaix"));
                                        if ($ptda['bl']){
                                            echo eti_mas_dato((($langles)?"BL No.":'No. BL'),$ptda['bl'].(($ptda['bl'])? ' - <font color="#103F75"><b>'.(($ptda['surrender'])?'Surrender':'Original'):'').'</b></font>');
                                            $loquedocs = 'SELECT * FROM docs WHERE natur="PI" and codi="'.$ptda['codi'].'" ORDER BY calif';
                                            $fconsdoc = mysqli_query($contmp,$loquedocs);
                                            while($xdocs = mysqli_fetch_array($fconsdoc)) {
                                                $diu = un_doc($xdocs['unic'],  strtolower($xdocs['ext']),$GLOBALS['$dirdocs'].'/'.$xdocs['ext'].'/',$xdocs['unic'],"PI","","DOCS",'',false,false);
                                                switch ($xdocs['calif']) {
                                                    case 'HBL':
                                                        echo eti_mas_dato("BL",'<table class="taula centered">'.$diu.'</table>');
                                                        break;
                                                    case 'FRA. COMERCIAL':
                                                        echo eti_mas_dato((($langles)?'Invoice':'Fra. Comercial'),'<table class="taula centered">'.$diu.'</table>');
                                                        break;
                                                    case 'PACKING LIST':
                                                        echo eti_mas_dato("Packing List",'<table class="taula centered">'.$diu.'</table>');
                                                        break;
                                                    case 'DUA IMPORTACION':
                                                        echo eti_mas_dato("DUA",'<table class="taula centered">'.$diu.'</table>');
                                                        break;
                                                    case 'LEVANTE IMPORTACION':
                                                        echo eti_mas_dato("LEVANTE",'<table class="taula centered">'.$diu.'</table>');
                                                        break;
                                                    case 'SEGURO':
                                                        echo eti_mas_dato("SEGURO",'<table class="taula centered">'.$diu.'</table>');
                                                        break;
                                                    case 'ALBARAN TRANSPORTE':
                                                        echo eti_mas_dato("ALBARAN TRANSPORTE",'<table class="taula centered">'.$diu.'</table>');
                                                        break;
                                                    case 'TRANSITO':
                                                        echo eti_mas_dato("TRANSITO",'<table class="taula centered">'.$diu.'</table>');
                                                        break;
                                                    case 'DOC. IMO':
                                                        echo eti_mas_dato("DGD",'<table class="taula centered">'.$diu.'</table>');
                                                        break;
                                                    default:
                                                        break;
                                                }
                                            }
                                            echo eti_mas_dato((($langles)?'Received':'Recibido'),sino($ptda['recblori']),"ralla_abaix");
                                        }
                                        echo eti_mas_dato("Shipper",$ptda['descship'],'ptda_separa_after');
                                        echo eti_mas_dato("Consignee",$ptda['descnee']);
                                        echo eti_mas_dato("Notify Party",$ptda['descparty'],(($ptda['reexpe'] || $ptda['lcl'])?'ralla_abaix':''));
                                        if ($ptda['reexpe']){
                                            $aonreexpe = '';
                                            $loqueree = 'SELECT * FROM reexpe WHERE codi="'.$ptda['reexpe'].'"';
                                            $fconsree = mysqli_query($contmp,$loqueree);
                                            if ($xreexpe = mysqli_fetch_array($fconsree)) {
                                                $aonreexpe = $xreexpe['desti'];
                                            }
                                            echo eti_mas_dato("INLAND Ref.",$ptda['reexpe'].(($ptda['desctte'])?' - '.$ptda['desctte']:''),'ptda_separa_after');
                                            if ($xreexpe['rollodesti']){
                                                echo eti_mas_dato(($langles)?'Destination':'Destino',  str_replace(Chr(10), '</br>',$xreexpe['rollodesti']));
                                            }
                                            if (DTOC($xreexpe['data'])){
                                                echo eti_mas_dato(($langles)?'Delivery Date':'Fecha TTE.', DTOC($xreexpe['data']));
                                            }
                                        }
                                        elseif($ptda['lcl']){
                                            echo eti_mas_dato('Ref. T/S','<a href="ptda_export.php?siscon_param='.$ptda['lcl'].'">'.$ptda['lcl'].'</a>','ptda_separa_after');
                                        }
                                        
                                    ?>
                                    <?php
                                    echo '</div>';
                                    echo '<div class="col-md-4">'; // Segona columna
                                        $separara = '';
                                        if ($ptda['imo']){
                                            echo eti_mas_dato('<span style="color:red;">IMO</span>',(($langles)?'YES':'SI'));
                                            echo eti_mas_dato('CLASS',$ptda['cimo']);
                                            $separara = 'ptda_separa_after';
                                        }
                                        echo eti_mas_dato(($langles)?'Package':'Bultos',trim($ptda['bultos']).(($ptda['fcl'])?'':" ".$ptda['tipobult']),$separara);
                                        if ($ptda['fcl']){
                                            echo eti_mas_dato('CNTRs',(($ptda['fcl20'])?$ptda['fcl20'].'x20" ':'').(($ptda['fcl40'])?$ptda['fcl40'].'x40" ':''));
                                        }
                                        $separara = '';
                                        echo eti_mas_dato('KGs',number_format($ptda['pes'],2 )." Kgs");
                                        if (empty($ptda['fcl'])){
                                            echo eti_mas_dato('CBM',number_format($ptda['cbm'],3 )." M3");
                                        }
//                                        echo eti_mas_dato(($langles)?'Goods':'Mercanc&iacute;a',(($ptda['mmercancia'])?$ptda['mmercancia']:$ptda['mercancia']));
                                        echo eti_mas_dato(($langles)?'Goods':'Mercanc&iacute;a',$ptda['mercancia']);
                                        if($ptda['npart']>0){
                                            // Desglós
                                            $k = 0;
                                            $loquedes = 'SELECT codi, npart FROM lcle WHERE bl="'.$ptda['bl'].'" ORDER BY npart';
                                            $fconsdes = mysqli_query($contmp,$loquedes);
                                            $lesaltres = "";
                                            while ($xdes = mysqli_fetch_array($fconsdes)) {
                                                $k++;
                                                $esaquesta = ($xdes['codi'] == $ptda['codi']);
                                                if ($k == 1){
                                                    $lamain = (($esaquesta)?'<b>':'').'<a href="ptda_import.php?siscon_param='.$xdes['codi'].'">'.$xdes['codi'].'</a>'.(($esaquesta)?'</b>':'');
                                                }
                                                else{
                                                    $lesaltres .= (($esaquesta)?'<b>':'').(($lesaltres)?', ':'').'<a href="ptda_import.php?siscon_param='.$xdes['codi'].'">'.$xdes['codi'].'</a>'.(($esaquesta)?'</b>':'');
                                                }
                                            }
                                             echo eti_mas_dato(($langles)?'Break Down':'Desglose',$lamain.' - '.(($langles)?'Main':'Principal').'</br>'.$lesaltres);
                                        }
                                        if($ptda['ptdaarancel']){
                                            echo eti_mas_dato('HS Code',$ptda['ptdaarancel']);
                                        }
                                        echo eti_mas_dato(($langles)?'Marks':'Marcas',$ptda['marcas']);
                                        if ($cdepot){
                                            $ames = (($depot['notavis'])?'<small></br><p  style="padding-top:8px;">'.(($depot['notavis'])?'<b>*</b> ':'').trim($depot['notavis']).'</p></small>':'');
                                            $infomagat = '<span id="cons_depot" onClick = "cons_fitxa(\'DEPOT\',\''.$cdepot.'\',\'I\');"><span style="font-size:1.5em;" data-toggle="tooltip" title="'.(($langles)?'Warehouse Information':'Informaci&oacute;n del Depot').'"><i class="fa fa-info-circle"></i></span>';
                                            echo eti_mas_dato(($langles)?'Warehouse':'Almac&eacute;n',$infomagat.' '.$depot['descrip'].'</span>'.$ames);
                                        }
                                    echo '</div>';                                        
                                    echo '<div class="col-md-4">'; // Tercera columna
                                        if ($showvessel){ 
                                            echo eti_mas_dato(($langles)?'Vessel':'Barco',(($esro)?$ro['barco']:$viae['nombarco']));
//                                            if (empty($esro) && ($viajee['viaje'])){
                                            if ($viajee['viaje']){
                                                echo eti_mas_dato(($langles)?'Voyage':'Viaje',$viajee['viaje']);
                                            }
                                            // CNTR
                                            $nmostra = ($ptda['ncontaine'])?$ptda['ncontaine']:1;
                                            $quemostra = $viae['contain'.$nmostra];
                                            if ($quemostra){
                                                $elconten = $quemostra;
                                                if ($quemostra != '.'){
                                                    echo eti_mas_dato('CNTR',$quemostra);
                                                }
                                            }
                                            // FI cntr
                                            echo eti_mas_dato('ETD',DTOC(($esro)?$ro['ets']:$viae['ets']));
                                            echo eti_mas_dato('ETA',DTOC(($esro)?$ro['eta']:$viae['eta']),"ralla_abaix");
                                            if ($viajee['pod']){
                                                echo eti_mas_dato("POD",$viajee['pod'],'ptda_separa_after');
                                            }
                                            echo eti_mas_dato("FPOD",$ptda['descdesti'],(($viajee['pod'])?'':'ptda_separa_after'));
                                            if ($ptda['desctte']){
                                                echo eti_mas_dato(($langles)?'Delivery':'TTE.',  $ptda['desctte']);
                                            }
                                        }
                                        $avui = date('Y-m-d');
                                        $nohasortit = empty(DTOC($ptda['data_surt_depot']));
                                        if ($ptda['npart'] == '1'){
                                            echo eti_mas_dato("",'<h3>'.(($langles)?'BREAK DOWN':'DESGLOSE').'</h3>');
                                        }
                                        else{
                                            // En els FCLs no es mostra el vuidad.
                                            if ($ptda['fcl'] == 0){
                                                if (DTOC($ptda['data_depot_vuit'])){
                                                    echo eti_mas_dato((($langles)?'Unstuff. D.':'F. Vaciado'),DTOC($ptda['data_depot_vuit']));
                                                    if ($depot['nabandono']){
                                                        $nuevafecha = strtotime ( '+'.($depot['nabandono']-1).' day' , strtotime ($ptda['data_depot_vuit']) ) ;
                                                        $datalim = date('Y-m-d',$nuevafecha);

                                                        $pintadata = DTOC(date('Y-m-j', $nuevafecha ));
                                                        $marca = DTOC($datalim);
                                                        $marca2 = '';
                                                        if (($ptda['npart'] != "1") && $nohasortit && ($avui > $datalim)){
    //                                                        $marca = '<div class="wow shake"><font color="red"><b>'.DTOC($avui).'***'.DTOC(date_create($nuevafecha)).'***';
    //                                                        $marca = '<div class="wow shake"><font color="red"><b>'.DTOC($avui).' - '.$pintadata;
                                                            $marca = '<div class="wow shake"><font color="red"><b>'.DTOC($datalim);
                                                            $marca2 = '</font></b></div>';
                                                        }
                                                        echo eti_mas_dato((($depot['notavis'])?'* ':'').(($langles)?'Warehouse date limit':'Plazo de Permanencia'),$marca.$marca2);
                                                    }
                                                }
                                                else{
                                                    if (DTOC($viae['prevvuit'])){
                                                        echo eti_mas_dato((($langles)?'Unstuff. D.':'F. Vaciado'),DTOC($viae['prevvuit']).' - '.(($langles)?'Expected':'Previsita'));
                                                    }
                                                }
                                            }
                                            if (DTOC($ptda['dataentregue'])){
                                                $marca = '';
                                                $marca2 = '';
                                                if (($ptda['npart'] != "1") && $nohasortit && $avui > $ptda['dataentregue']){
                                                    $marca = '<div class="wow shake"><font color="red"><b>';
                                                    $marca2 = '</font></b></div>';
                                                }
                                                $pintadata = DTOC($ptda['dataentregue']);
//                                                echo eti_mas_dato((($langles)?'Storages validity':'Validez Almacenajes'),$marca.DTOC($ptda['dataentregue']).$marca2);
                                                echo eti_mas_dato((($langles)?'Storages validity':'Validez Almacenajes'),$marca.$pintadata.$marca2);
                                            }
                                            if (DTOC($ptda['data_surt_depot'])){
                                                echo eti_mas_dato((($langles)?'Pickup D.':'F. Salida'),'<b><font color="darkgreen">'.DTOC($ptda['data_surt_depot'],false,false).'</font></b>');
                                            }
                                            echo eti_mas_dato('','',"ralla_abaix");
                                            $diu = '';
                                            $loquedocs = 'SELECT * FROM docs WHERE natur="AI" and codi="'.$ptda['ref'].'" AND calif="CUENTA CORRIENTE"';
                                            $fconsdoc = mysqli_query($contmp,$loquedocs);
                                            while($xdocs = mysqli_fetch_array($fconsdoc)) {
                                                if ($elconten == $xdocs['cntr'] ) {
                                                    $hrefdown = '<a href="downfile.php?fid='.$xdocs['unic'].'&amp;deon=AI&amp;elnom='.$xdocs['unic'].'&amp;origen=DOCS"><i style="font-size:1.6em;" class="fa fa-download"></i></a>';
                                                    $hrefsee = '<a target="_blank" href="showfile.php?fid='.$xdocs['unic'].'&amp;deon=AI&amp;elnom='.$xdocs['unic'].'&amp;origen=DOCS"><i style="font-size:1.6em;" class="fa fa-eye"></i></a>';
                                                    $diu = '<span style="padding:0px 10px 0px 10px;"> '.$hrefdown.' </span><span> '.$hrefsee.' </span>';
                                                }
                                            }
                                            echo eti_mas_dato('Cta/Cte','<span>'.$ptda['ctacte'].'/'.$ptda['ctactennn'].' - </span>'.$diu,'ptda_separa_after');
                                            echo eti_mas_dato((($langles)?'Ubication code':'Ubicaci&oacute;n'),$viajee['cod_id2'].$viajee['digitterm']);
                                            if ($ptda['flet'] && $viae['okprefac']){
                                                echo eti_mas_dato(($langles)?'Freight':'Flete',$ptda['flet'].' '.$ptda['divisa']);
                                            }
                                            if ($lat3 && $viae['okprefac']){
                                                echo eti_mas_dato('T3',$lat3.' EUR');
                                            }
                                        }
                                        if (($ptda['npart'] != '1') && empty(DTOC($ptda['data_surt_depot']))){
                                            echo eti_mas_dato('','',"ralla_abaix");
                                                $_SESSION['dadesimport'] = "Ref. ".$ptda['codi'].(($ptda['mercancia'])?' - <i>'.$ptda['mercancia'].'</i>':'').', POL : '.$ptda['descpol'].", ".(($langles)?'Bulks : ':'Bultos : ').$ptda['bultos'].
                                                        ', KGs : '.$ptda['pes'].'</br>';
                                            ?>
                            <div style="padding-left:20px;">
                            <?php
                                if ($ptda['fcl'] == '0'){
                                    ?>
                                    <div class="row text-left" style="padding-top:5px;">
                                        <div btn-group btn-block">
                                             <button type="button" name="totes" class="col-sm-5 btn-xs btn-default btn-sm" value="mailpalet" onclick="window.location.href='emailptdai.php?ptda=<?php echo $ptda['codi'];?>&op=1';"><span class="amb_blau"><b>Solicitar desglose</b></span></button>
                                        </div>
                                    </div>
                                    <div class="row text-left" style="padding-top:3px;">
                                        <div class=" btn-group btn-block">
                                            <button type="button" name="totes" class="col-sm-5 btn-xs btn-default btn-sm" value="mailpalet" onclick="window.location.href='emailptdai.php?ptda=<?php echo $ptda['codi'];?>&op=21';"><span class="amb_blau"><b>Solicitar paletizado</b></span></button>
                                            <button type="button" name="totes" class="col-sm-4 btn-xs btn-default btn-sm" value="maildesglos2" onclick="window.location.href='emailptdai.php?ptda=<?php echo $ptda['codi'];?>&op=22';"><span class="amb_blau"><b>+ Presupuesto</b></span></button>
                                        </div>
                                    </div>
                                    <?php
                                }
                            ?>
                            <div class="row text-left" style="padding-top:3px;">
                                <div class=" btn-group btn-block">
                                    <button type="button" name="totes" class="col-sm-5 btn-xs btn-default btn-sm" value="mailpalet" onclick="window.location.href='emailptdai.php?ptda=<?php echo $ptda['codi'];?>&op=31';"><span class="amb_blau"><b>Solicitar posicionado</b></span></button>
                                    <button type="button" name="totes" class="col-sm-4 btn-xs btn-default btn-sm" value="maildesglos2" onclick="window.location.href='emailptdai.php?ptda=<?php echo $ptda['codi'];?>&op=32';"><span class="amb_blau"><b>+ Presupuesto</b></span></button>
                                </div>
                            </div>
                            </div>
                                             <?php
                                            }
                                    echo '</div>';
                                echo '</div></div>';
                            echo '</div>';
                            ?>
                        </div>
                    </div>
                </div>
            </div>

        <?php 
            $eltipus="PI";
            $elcodi = $ptda['codi'];
            include 'tracking.php';
            //  tracking($ptda['codi'],'PI',$contmp);
            // <!-- Footer -->
            include 'footer.php';
            include_once 'htmljavascript.php';
            htmljavascript('','wow'); 
        ?>
    </body>
</html>