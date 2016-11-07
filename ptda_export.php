<?php
    $GLOBALS['amblog'] = 1;
    include_once 'sempre.php';
    include 'htmldoctipe.php';
    if (hies()){
        if(isset($_REQUEST['siscon_param']) && $_REQUEST['siscon_param']){
            $anterior = retvar('anterior');
            $seguent = retvar('seguent');
            $laptda = $_REQUEST['siscon_param'];
            if ($anterior || $seguent){
                $quemes = ($_SESSION['usr_codcli'])?' AND codcli="'.$_SESSION['usr_codcli'].'"':'';
                $laptda = skip((($anterior)?1:-1),'lclagrupa','codi',$laptda,$quemes);
            }
            include 'bbdd_lcl.php';
        }
        else{saltaa('index.php');}
        if ($lsalta){saltaa('login.php');}
}
    else{$lsalta=true;}
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
            menutct();
            $elhref_torna = 'onClick="window.location.href=\'export_my_bookings.php?laptda='.$laptda.'\';"';
            // -- Page Title -->
            pagetitle("Mis Bookings : EXPORT",nom_usroagent(),"My Bookings : EXPORT",nom_usroagent(),"bookings",$elhref_torna); 
            guardaquefan("PARTIDA EXPORT","CONSULTA",$laptda);
        ?>
            <div class="container">
                <div class="row" style="padding: 10px 0px 20px 0px;">
                    <div class="col-xs-2 text-left" style="padding: 20px;">
                        <button  name="totes" class="btn btn-primary" value="back" <?php echo $elhref_torna;?>><?php echo ($langles)?'Back':'Volver'; ?></button>
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
                            echo '<div class="panel-heading">'.(($langles)?'Shipment Code ':'Partida C&oacute;digo ').'<b><span style="color:darkorange;">'.$ptda['codi'].(($elstatus)?' - '.$elstatus.' ':'').'</span></b> '.(($_SESSION['usr_tct'])?' / '.(miratct()).'<a href="agr_export.php?siscon_param='.$ptda['ref'].'">'.$ptda['ref'].'</a>'.(($agrupa['cocarga'])?' CO':''):'').'</div>';
                                echo '<div class="panel-body"><div class="row">';
                                    echo '<div class="container-fluid col-md-4">'; // Primera columna
                                        echo eti_mas_dato(($langles)?"Shipment":'Partida',($ptda['fcl'])?'FCL':'LCL');
                                        if (empty($_SESSION['usr_codcli'])){echo eti_mas_dato("Cliente",$ptda['client'],"ralla_abaix");}
                                        if ($ptda['refcil']){
                                            echo eti_mas_dato("Ref. Cli.",$ptda['refcil']);
                                        }
                                        if($laref){echo eti_mas_dato("POL",($actviaje)?$viajes['pol']:'');}
                                        $quemes = ""; $elbl = "";
                                        if ($ptda['bl']){
                                            if (empty($ptdab['refbl']) && (! $ptda['fcl'])){
                                                // Puc fer el H/BL
                                                $elbl .= '<div>';
                                                $elbl .= '<a href="bl.php?id='.$laptda.'&com=2"><span style="font-size:1.6em;"  data-toggle="tooltip" title="'.(($GLOBALS['$langles'])?'Download file':'Descargar Fichero').'"><i class="fa fa-download"></i></span></a>';
                                                $elbl .= '<a href="bl.php?id='.$laptda.'&com=1" target="_blank">';
                                                $elbl .= '<span style="font-size:1.6em;padding:15px;"  data-toggle="tooltip" title="'.(($GLOBALS['$langles'])?'Show file':'Ver Fichero').'"><i class="fa fa-eye"></i></span></a>';
                                                $elbl .= '</div>';
                                                // POt validar si no ha passat mes d¡un dia de la sortida
                                                $avui = date_create(date('Y-m-d'));
                                                $sortidamesu = date_create($agrupa['ets']);
                                                $sortidamesu->modify('+1 day');
                                                if ($ptdab['blokclient'] == '0' && ($avui <= $sortidamesu)){
                                                    // Pot demanar modificacions
                                                    $quemes = '<div style="padding:8px 0px 8px 0px;">'
                                                            . '<button type="submit" id="valida" name="valida" class="btn btn-primary btn-group btn-group-justified" onClick="okbl(\''.$laptda.'\');return true;" value="'.$laptda.'" style="padding-bottom:15px;"><i class="fa fa-thumbs-up" style="padding-right:20px;"></i> '.
                                                            (($langles)?'Confirm BL':'Confirmar BL').'</button>'
                                                            .'<div style="padding:8px 0px 0px 0px;">'
//                                                            .'<form action="modbl.php" method="post" target="_blank">'
                                                            .'<form action="form_bl.php" method="post">'
                                                            .html_input_hidden('laptda',$laptda)
                                                            . '<button type="submit" id="modificabl" name="modificabl" class="btn btn-primary btn-group btn-group-justified" value="'.$laptda.'"><i class="fa fa-envelope" style="padding-right:20px;"></i> '.
                                                            (($langles)?'Request Changes':'Solicitar Modificaciones').'</button>'
                                                            .'</form>'
                                                            . '</div></div>';
                                                }
                                            }
                                            echo eti_mas_dato("BL",(($ptda['bl'])?$ptda['bl'].' - '.(($ptdab['express'] || ($ptda['copbl'] == 0))?'EXPRESS':'ORIGINAL'):'').$elbl.$quemes);
                                        }
                                        echo eti_mas_dato("POD",$ptda['fdescpunt'],"");
                                        echo eti_mas_dato("FPOD",$ptda['descpunt'],"ralla_abaix");
                                            echo eti_mas_dato('Shipper',$ptda['shiper'],'ptda_separa_after','');
                                            echo eti_mas_dato('Consignee',$ptda['consignee']);
                                            echo eti_mas_dato('Notify',$ptda['notifyparty'],($ptda['lcle'])?'ralla_abaix':'');
                                        if(($ptda['lcle'])){
                                            echo eti_mas_dato('T/S','<a href="ptda_import.php?siscon_param='.$ptda['lcle'].'">'.$ptda['lcle'].'</a>','ptda_separa_after','');
                                        }
                                    ?>
                                    <?php
                                    echo '</div>';
                                    echo '<div class="col-md-4">'; // Segona columna
                                        $separara = '';
                                        if ($ptda['imo']){
                                            echo eti_mas_dato('<span style="color:red;">IMO</span>',(($langles)?'YES':'SI'));
                                            echo eti_mas_dato('CLASS',$ptda['imo']);
                                            echo eti_mas_dato('UN',$ptdab['onus'],"ralla_abaix");
                                            $separara = 'ptda_separa_after';
                                        }
                                        echo eti_mas_dato(($langles)?'Pakcages':'Bultos',trim($ptda['bultos'])." ".$ptda['tipobult'],$separara);
                                        $separara = '';
                                        echo eti_mas_dato('KGs',number_format($ptda['pes'],2 )." Kgs");
                                        echo eti_mas_dato('CBM',number_format($ptda['cbm'],3 )." M3");
                                        echo eti_mas_dato(($langles)?'Goods':'Mercanc&iacute;a',(($ptda['mmercancia'])?$ptda['mmercancia']:$ptda['mercancia']));
                                        echo eti_mas_dato(($langles)?'Marks':'Marcas',(($ptda['mmarcas'])?$ptda['mmarcas']:$ptda['marcas']),($codmagat)?'':'ralla_abaix');
                                        if (DTOC($ptda['fentrada'])){
                                            echo eti_mas_dato(($langles)?'Warehouse receipt':'Entrada Alnacén',DTOC($ptda['fentrada']));
                                        }
                                        // Data de recollida
                                        $quinaveu = DTOC($ptdab['trans_data']);
                                        $conec = conexioi();
                                        if ($conec){
                                            $quevol = 'SELECT dataok FROM lclotro WHERE lcl="'.$ptda['codi'].'" and confac="029"';
                                            $fconstmp = mysqli_query($conec,$quevol );
                                            if ($lclotro = mysqli_fetch_array($fconstmp)) {
                                                $tmpd = DTOC($lclotro['dataok']);
                                                if ($tmpd){
                                                    $quinaveu = $tmpd;
                                                }
                                            }
                                        }
                                        if ($quinaveu){
                                            echo eti_mas_dato(($langles)?'Pick up date':'Fecha de Recogida',$quinaveu);
                                        }
                                        // 
                                        if ($codmagat){
                                            $infomagat = '<span id="cons_depot" onClick = "cons_fitxa(\'DEPOT\',\''.$codmagat.'\',\'E\');"><span style="font-size:1.5em;"><i class="fa fa-info-circle"></i></span>';
                                            echo eti_mas_dato(($langles)?'Warehouse':'Almac&eacute;n',$infomagat.' '.$depot['descrip'].'</span>',"ralla_abaix");
                                        }
                                        if (!esagent()){
                                            $_SESSION['dadesexport'] = "Ref. ".$ptda['codi'].(($ptda['mercancia'])?' - <i>'.$ptda['mercancia'].'</i>':'').', '.(($langles)?'Destination':'Destino').' : '.$ptda['descpunt'].", ".(($langles)?'Bulks : ':'Bultos : ').$ptda['bultos'].
                                                    ', KGs : '.number_format($ptda['pes'],2).', CBM : '.number_format($ptda['cbm'],3).'</br>';
                                            echo '<div class="row text-left" style="padding-top:3px;">';
                                                echo '<div class="col-xs-2">';
                                                echo '</div>';
                                                echo '<div class="col-xs-12 ptda_separa_after">';
                                                    echo '<form action="emailptdae.php" method="post"><div class="certificados btn-group btn-block">';
                                                            echo html_input_hidden('siscon_param',$laptda);
                                                            echo '<button type="submit" name="totes" class="col-xs-11 btn-xs btn-default btn-sm" value="cretifica"><span class="amb_blau"><b>'.(($langles)?'Certificate request':'Solicitar certificado').'</b></span></button>';
                                                            echo '<div style="padding-top:10px;" class="col-xs-6">';
                                                                echo '<div><input id="cerdoc" name="cerdoc" type="checkbox" value="0"><label>'.(($langles)?'Documents':'Envío Documentación').'</label></div>';
                                                                echo '<div><input id="cerflag" name="cerflag" type="checkbox" value="0"><label>'.(($langles)?'Flag':'Bandera').'</label></div>';
                                                                echo '<div><input id="cerflet" name="cerflet" type="checkbox" value="0"><label>'.(($langles)?'Freight':'Flete').'</label></div>';
                                                            echo '</div>';
                                                            echo '<div style="padding-top:10px;" class="col-xs-4">';
                                                                echo '<div><input id="cerblack" name="cerblack" type="checkbox" value="0"><label>Black List</label></div>';
                                                                echo '<div><input id="cerage" name="cerage" type="checkbox" value="0"><label>'.(($langles)?'Age':'Edad').'</label></div>';
                                                                echo '<div><input id="cerruta" name="cerruta" type="checkbox" value="0"><label>'.(($langles)?'Route':'Ruta').'</label></div>';
                                                            echo '</div>';
                                                    echo '</div></form>';
                                                echo '</div>';
                                            echo '</div>';
                                        }
                                    echo '</div>';
                                    echo '<div class="col-md-4">'; // Tercera columna
                                        echo eti_mas_dato(($langles)?'Vessel':'Barco',(($ptda['refade'])?$ptda['bl_barco']:$agrupa['descbarco']));
                                        if ($confirmada || $ptda['fcl']){
                                            echo eti_mas_dato('CNTR',$cntr);
                                        }
                                        if($laref){echo eti_mas_dato(($langles)?'Voyage':'Viaje',($actviaje)?$viajes['viaje']:'');}
                                        echo eti_mas_dato('ETS',DTOC(($ptda['refade'])?$ptda['bl_ets']:$agrupa['ets']));
                                        echo eti_mas_dato('ETA',DTOC(($ptda['refade'])?$ptda['dataedad']:$agrupa['eta']));
                                        echo eti_mas_dato('','',"ralla_abaix");
                                        if ($laref){
                                            echo eti_mas_dato('','','ptda_separa_after','',(($langles)?'DATA CUSTOMS':'DATOS DE DESPACHO'));
                                            if ($codmagat){
                                                echo eti_mas_dato('Aduana Ubicación',$depot['codiaduana']);
                                                echo eti_mas_dato(($langles)?'Warehouse Code':'Código Almacén',$depot['aduanasalida']);
                                            }
                                            echo eti_mas_dato('Aduana de Salida',$agrupab['aduanaout']);
                                            echo eti_mas_dato(($langles)?'Flag':'Bandera',($actbarco)?$barcos['pais']:'');
                                            if($viajes['carpeta']){echo eti_mas_dato('Carpeta',$viajes['carpeta']);}
                                            if($viajes['escala']){echo eti_mas_dato('Escala',$viajes['escala']);}
                                            if ($ptda['fcl']){
                                                echo eti_mas_dato('Muelle',$viajes['descterm']);
                                            }
                                            if ($codmagat){
                                                $infomagat = '<span id="cons_depot" onClick = "cons_fitxa(\'DEPOT\',\''.$codmagat.'\',\'E\');"><span style="font-size:1.5em;"><i class="fa fa-info-circle"></i></span> ';
                                                echo eti_mas_dato(($langles)?'Warehouse':'Almac&eacute;n',$infomagat.$depot['descrip']);
                                                if ($agrupa && empty($ptda['admitase']) && $depot['lnuestroadmitase']){
                                                    echo '<form action="admitase.php" method="post"><button type="submit" name="admitase" class="btn btn-primary btn-group btn-group-justified" value="'.$laptda.'"><i class="fa fa-download" style="padding-right:20px;"></i> ADMITASE</button></form>';
                                                }
                                            }
                                            if ($ptda['admitase']){
                                                echo eti_mas_dato('CR',$ptda['admitase']);
                                            }
                                            /// DOCS
                                            $loquedocs = 'SELECT * FROM docs WHERE natur="PE" and codi="'.$ptda['codi'].'" ORDER BY calif';
                                            $fconsdoc = mysqli_query($contmp,$loquedocs);
                                            while($xdocs = mysqli_fetch_array($fconsdoc)) {
                                                $diu = un_doc($xdocs['unic'],  strtolower($xdocs['ext']),$GLOBALS['$dirdocs'].'/'.$xdocs['ext'].'/',$xdocs['unic'],"PE","","DOCS",'',false,false);
                                                switch (trim($xdocs['calif'])) {
                                                    case 'CR CLIENTE':
                                                        echo eti_mas_dato("CR",'<table class="taula centered">'.$diu.'</table>');
                                                        break;
                                                    case 'DAE':
                                                        echo eti_mas_dato('DAE','<table class="taula centered">'.$diu.'</table>');
                                                        break;
                                                    case 'AUTORIZACION':
                                                        echo eti_mas_dato("AUTORIZACION",'<table class="taula centered">'.$diu.'</table>');
                                                        break;
                                                    case 'CARTA DE CRÉDITO':
                                                        echo eti_mas_dato("CARTA DE CREDITO",'<table class="taula centered">'.$diu.'</table>');
                                                        break;
                                                    case 'CARTA DE PORTE':
                                                        echo eti_mas_dato("CARTA DE PORTE",'<table class="taula centered">'.$diu.'</table>');
                                                        break;
                                                    case 'ALBARAN TRANSPORTE':
                                                        echo eti_mas_dato("ALBARAN TRANSPORTE",'<table class="taula centered">'.$diu.'</table>');
                                                        break;
                                                    case 'DOC. IMO':
                                                        echo eti_mas_dato("DGD",'<table class="taula centered">'.$diu.'</table>');
                                                        break;
                                                    case 'DUA':
                                                        echo eti_mas_dato("DUA",'<table class="taula centered">'.$diu.'</table>');
                                                        break;
                                                    case 'ASENTAMIENTO':
                                                        echo eti_mas_dato("ASENTAMIENTO",'<table class="taula centered">'.$diu.'</table>');
                                                        break;
                                                    case 'SEGURO':
                                                        echo eti_mas_dato("SEGURO",'<table class="taula centered">'.$diu.'</table>');
                                                        break;
                                                    default:
                                                        break;
                                                }
                                            }
                                            // FI DOCS
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
            $eltipus="PE";
            $elcodi = $ptda['codi'];
            include 'tracking.php';
            // tracking($ptda['codi'],'PE',$contmp);

            // <!-- Footer -->
            include 'footer.php';
            include_once 'htmljavascript.php';
            htmljavascript('','wow'); 
        ?>
        <script src="assets/js/okbl.js"></script>;
    </body>
</html>