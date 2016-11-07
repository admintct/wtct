<?php
    $GLOBALS['amblog'] = 0;
    include_once 'sempre.php';
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
        
        $port = retvar('punt');
        
        $conec = conexioi();
        if ($conec){
            // Si el port no es bo, tornem a demanar dades ...
            $df_rq = array(
                'empresa' => array('tipo'=>'C','desc' => array('es'=>'Empresa','en'=>'Company'),'val'=>retvar('empresa')),
                'elpic' => array('tipo'=>'C','desc' => array('es'=>'PIC','en'=>'Contacto'),'val'=>retvar('elpic')),
                'telefon' => array('tipo'=>'C','desc' => array('es'=>'Teléfono','en'=>'Phone'),'val'=>retvar('telefon')),
                'email' => array('tipo'=>'C','desc' => array('es'=>'email','en'=>'email'),'val'=>retvar('email')),
                'eltipo' => array('tipo'=>'T','desc' => array('es'=>'Tipo de Envío','en'=>'Shipment Type'),'val'=>retvar('eltipo')),
                'pol' => array('tipo'=>'C','desc' => array('es'=>'Puerto de carga','en'=>'Port of Landing'),'val'=>retvar('pol')),
                'pod' => array('tipo'=>'C','desc' => array('es'=>'Puerto de descarga','en'=>'Port of Discharge'),'val'=>retvar('pod')),
                'placeod' => array('tipo'=>'C','desc' => array('es'=>'Lugar de entrega','en'=>'Place of Delivery'),'val'=>retvar('placeod')),
                'volimo' => array('tipo'=>'L','desc' => array('es'=>'IMO','en'=>'IMO'),'val'=>isset($_REQUEST['volimo'])),
                'mercancia' => array('tipo'=>'C','desc' => array('es'=>'Mercancía','en'=>'Commodity'),'val'=>retvar('mercancia')),
                'lclfcl' => array('tipo'=>'RB','desc' => array('es'=>'Tipo','en'=>'Type'),'val'=>((retvar('lclfcl')<2)?1:2)),
                'adreca' => array('tipo'=>'M','desc' => array('es'=>'Dirección','en'=>'Address'),'val'=>null),
                'bultos' => array('tipo'=>'N','desc' => array('es'=>'Bultos','en'=>'Bulks'),'val'=>retvar('bultos')),
                'tipobult' => array('tipo'=>'T','desc' => array('es'=>'Tipo de Bultos','en'=>'Kind of Bulks'),'val'=>retvar('tipobult')),
                'kilos' => array('tipo'=>'N','desc' => array('es'=>'Peso','en'=>'Weight'),'val'=>retvar('kilos')),
                'cbmmax' => array('tipo'=>'N','desc' => array('es'=>'CBM','en'=>'CBM'),'val'=>retvar('cbmmax')),
                'mesuressino' => array('tipo'=>'L','desc' => array('es'=>'Medidas','en'=>'Measures'),'val'=>isset($_REQUEST['mesuressino'])),
                'incoterm' => array('tipo'=>'T','desc' => array('es'=>'INCOTERM','en'=>'INCOTERM'),'val'=>retvar('incoterm')),
                'rollo' => array('tipo'=>'M','desc' => array('es'=>'Notas','en'=>'Notes'),'val'=>null),
                'rollocntr' => array('tipo'=>'M','desc' => array('es'=>'CNTRs','en'=>'CNTRs'),'val'=>null),
                'rollomides' => array('tipo'=>'M','desc' => array('es'=>'Medidas','en'=>'Measures'),'val'=>null),
                'codcli' => array('tipo'=>'C','desc' => array('es'=>'Cod. Cliente','en'=>'Cod. Client'),'val'=>((hies())?(($_SESSION['usr_codcli'])?$_SESSION['usr_codcli']:$_SESSION['usr_codage']):'')),
                'rolloimo' => array('tipo'=>'M','desc' => array('es'=>'IMOs','en'=>'IMOs'),'val'=>null)
            );
            if(hies()){
                if (empty($df_rq['empresa']['val'])){$df_rq['empresa']['val'] = nom_usroagent();}
                if (empty($df_rq['telefon']['val'])){$df_rq['telefon']['val'] = $_SESSION['usr_telefon'];}
                if (empty($df_rq['elpic']['val'])){$df_rq['elpic']['val'] = $_SESSION['usr_nomuser'];}
                if (empty($df_rq['elpic']['val'])){$df_rq['elpic']['val'] = $_SESSION['usr_nomuser'];}
                if (empty($df_rq['email']['val'])){$df_rq['email']['val'] = $_SESSION['usr_email'];}
            }
            //*****
            $grava = (isset($_REQUEST['comfirmar']));
            if ($grava){
                $textecntr = '';
                $elscntrs = array();
                $textedimensio = '';
                $detmides = array();
                $texteimo = '';
                $detimos = array();
                // Guardem la cotització
                // Guardo Els CNTRs
                if ($df_rq['lclfcl']['val'] == '2'){
                    $ncntr = retvar('ncntr');
                    for ($i = 0;$i <= $ncntr; $i++) {
                        $n = $i+1;
                        array_push($elscntrs, array(retvar('ucntr'.$n),retvar('tipofcl'.$n)));
                        $textecntr .= $elscntrs[$i][0]." x ".$elscntrs[$i][1].$crlf;
                    }
                }
                // Guardo les mides
                if ($df_rq['mesuressino']['val']){
                    $nmides = retvar('nmides');
                    for ($i = 0;$i <= $nmides; $i++) {
                        $n = $i+1;
                        array_push($detmides, array(retvar('nbult'.$n),retvar('l'.$n),retvar('w'.$n),retvar('h'.$n),(isset($_REQUEST[('rm'.$n)]))?'1':'0'));
                        $textedimensio .= $detmides[$i][0]." ".ladesc($df_rq['bultos'])." : ".$detmides[$i][1].' x '.$detmides[$i][2].' x '.
                                        $detmides[$i][3].(($detmides[$i][4])?' Remontable':'').$crlf;
                    }
                }
                // Guardo els IMOs
                if ($df_rq['volimo']['val']){
                    $nimos = retvar('nimos');
                    for ($i = 0;$i <= $nimos; $i++) {
                        $n = $i+1;
                        array_push($detimos, array(retvar('classe'.$n),retvar('onu'.$n),retvar('pg'.$n)));
                        $texteimo .= 'IMO : '.$detimos[$i][0].", ONU : ".$detimos[$i][1].' PG : '.$detimos[$i][2].$crlf;
                    }
                }
                // Ara ho grava
                $df_rq['rollocntr']['val'] = $textecntr;
                $df_rq['rollomides']['val'] = $textedimensio;
                $df_rq['rolloimo']['val'] = $texteimo;
                $quevol = "INSERT INTO cotiza (`codi`) VALUES (NULL);";
                $fcons = mysqli_query($conec,$quevol);
                $codialta = $conec->insert_id;
                // Guardar
                $opera = fesupdate($df_rq);
                $quevol = 'UPDATE cotiza SET '.$opera.' WHERE codi='.$codialta; 
                $fcons = mysqli_query($conec,$quevol);
                // Ara ho envia per email 
                $_SESSION['missatge'] ='';
                $tira = '';
                guardaquefan("COTIZACION","COTIZACION",$port,"REF: ".$codialta);
                include_once 'cotiza_to_mail.php';
                // Ara posa que ha fet el booking
                // Ara torna als bookings de importació
                $_SESSION['missatge'] .= texteweb('GRACIAS_COTIZA','').'</br>'.$tira;
                saltaa('index.php'); 
            }
        }
        ?>
    </head>
    <body>
        <?php 
            // <!-- Top menu -->
            menutct();
            // -- Page Title -->
            
            pagetitle("Solicitud de Cotización",nom_usroagent(),"Quotation request",nom_usroagent(),"",'',''); 
        ?>
            <div class="container">
                <div class="row" style="padding: 15px 0px 20px 0px;">
                    <div class="col-md-12">
                        <div id="elpanell" class="panel panel-primary">
                            <?php
                            
                            echo '<div class="panel-heading"><h5>'.(($langles)?'QUOTATION REQUEST':'SOLICITUD DE COTIZACIÓN').'</h5></div>';
                                echo '<form role="form" id="bookingi" action="cotiza.php" method="POST" enctype="multipart/form-data" data-fv-framework="bootstrap"
                                        data-fv-icon-valid="glyphicon glyphicon-ok"
                                        data-fv-icon-invalid="glyphicon glyphicon-remove"
                                        data-fv-icon-validating="glyphicon glyphicon-refresh">'; 
                                    echo '<div class="panel-body"><div class="row">';
                                        echo '<div class="container-fluid col-md-4">'; // Primera columna
                                        // DATOS DE CONTACTO == DATOS DE CONTACTO ==DATOS DE CONTACTO ==DATOS DE CONTACTO ==DATOS DE CONTACTO ==
                                        echo '<div class="amplia">';
                                        echo '<div class="row separa_titol"><b>'.(($langles)?'Contact details':'Datos de Contacto').'</b></div>';
                                        echo entrada(ladesc($df_rq['empresa']),'empresa','T',ladesc($df_rq['empresa']),$df_rq['empresa']['val'],true);
                                        echo entrada('PIC','elpic','T','Persona de Contacto',$df_rq['elpic']['val'],true);
                                        echo entrada(ladesc($df_rq['telefon']),'telefon','T','Tel.',$df_rq['telefon']['val']);
                                        echo entrada('email','email','E','email de Contacto',$df_rq['email']['val'],true);
                                        echo '</div>';
                                        // INSTRUCCIONES === INSTRUCCIONES === INSTRUCCIONES === INSTRUCCIONES === INSTRUCCIONES ===
                                        echo '</div>';

                                        // Segona columna ** Segona columna ** Segona columna ** Segona columna ** Segona columna ** Segona columna **
                                        echo '<div class="col-md-4">'; 
                                        echo '<div class="row separa_titol"><b>'.(($langles)?'SHIPMEN DETAILS':'DETALLES DEL EMBARQUE').'</b></div>';
                                        echo entrada(ladesc($df_rq['eltipo']),'eltipo','SEL','eltipo','',false,'',0,fa_input_select('','','',$df_rq['eltipo']['val'],(($langles)?array('','Ocean freight','Airfreight','Land Transportation','Logistics service','Customs clearance'):array('','Marítimo','Aéreo','Terrestre','Servicios Logísticos','Despacho')),'eltipo','',true,4));
                                        echo entrada(ladesc($df_rq['pol']),'pol','T','POL',$df_rq['pol']['val'],true);
                                        echo entrada(ladesc($df_rq['pod']),'pod','T','POD',$df_rq['pod']['val'],true);
                                        echo entrada(ladesc($df_rq['placeod']),'placeod','T',ladesc($df_rq['placeod']),$df_rq['placeod']['val']);

                                        echo entrada('<b style="color:orangered;">IMO</b>','volimo','CK','imo',$df_rq['volimo']['val'],false,'|NOPRIMERA|',0,'',0,'','imosino();');
                                        // Recollida
//                                        echo '<div id="comimo" class="col-xs-12 milabel text-left" style="padding:5px;background-color:darkorange;white-space:nowrap;" >';
                                        echo '<div id="comimo" class="col-xs-12 milabel text-left" style="display:none;padding:5px;background-color:darkorange;white-space:nowrap;" >';
                                             echo html_input_hidden('nimos','0',true);
                                             echo '<table id="taulamimo" border="1" class="taula12"><thead><tr style="font-size:0.8em;">';
                                             echo '<th style="width: 30%">'.(($langles)?'CLASS':'CLASE').'</th><th style="width: 30%">'.(($langles)?'UN':'ONU').'</th><th style="width: 30%">PG</th><th onclick="mesmimo();" style="width: 10%;text-align:center;"><i class="fa fa-plus"></i></th>';
                                             echo '</tr></thead>';
                                             echo '<tr id="row_imo_">';
                                             echo '<td><input type="text" name="classe1" placeholder="Classe"></dt>';
                                             echo '<td><input type="text" name="onu1" placeholder="ONU"></td>';
                                             echo '<td><input type="text" name="pg1" placeholder="PG"></td>';
                                             echo '<td onclick="borraimos();" style="text-align:center;"><i class="fa fa-remove"></i></td>';
                                             
                                             echo '</tr></table>';
                                        echo '</div>';
                                        // Fi Recollida
                                        
                                        
                                        echo entrada(ladesc($df_rq['mercancia']),'mercancia','T',ladesc($df_rq['mercancia']),$df_rq['mercancia']['val'],true);
                                        echo entrada(ladesc($df_rq['lclfcl']),'lclfcl','RB','',$df_rq['lclfcl']['val'],false,'',3,fa_radio_button('lclfcl',array('LCL'=>1,'FCL'=>2),$df_rq['lclfcl']['val'],'funlclfcl'),0);
                                        echo entrada('INCOTERM','incoterm','SEL','incoterm','T',false,'',0,fa_input_select('','','',$df_rq['incoterm']['val'],array('','EXW','FCA','FAS','FOB','CPT','CIP','CFR','CIF','DAT','DAP','DDP'),'incoterm','cambiainco()',true,4));
    ?>
    <?php
                                        echo '</div>';
                                        // Tercera columna // Tercera columna// Tercera columna// Tercera columna// Tercera columna
                                        echo '<div class="col-md-4">'; 
                                        echo '<div class="row separa_titol"><b> &nbsp;</b></div>';
                                        // FCL *** FCL *** FCL *** FCL *** FCL *** FCL *** FCL *** FCL *** FCL *** FCL ***
                                        echo '<div class="amplia" id="divfcl" style="margin-bottom:15px;display:none;">';
                                        echo '<div class="row ptda-separa">';
                                            echo '<div class="col-xs-3 milabel text-right"><label>FCL</label></div>';
                                            echo '<div class="col-xs-9 milabel text-right">';
                                            
                                             echo html_input_hidden('ncntr','0',true);
                                             echo '<table id="taulafcl" border="1" class="taula12"><thead><tr style="font-size:0.8em;">';
                                             echo '<th style="width: 40%">CNTRs</th><th style="width: 40%"></th><th style="width: 20%;text-align:center;"><span onclick="mescntr();"><i class="fa fa-plus"></i></span></th>';
                                             echo '</tr></thead>';
                                             echo '<tr id="row_fcl_">';
                                             echo '<td><input style="text-align:right;" type="text" name="ucntr1" placeholder="No"></td>';
                                             echo '<td style="color:rgba(16,63,117,1.00);">'.fa_input_select('','','','',array('   ','20 BOX','40 BOX','40 HC','20 RFR','20 OT','40 OT','20 FR','40 FR'),'tipofcl1','').'</td>';
                                             echo '<td onclick="borrafcl();" style="text-align:center;color:orangered;"><i class="fa fa-remove"></i></td>';
                                             echo '</tr>';
                                             echo '</table>';
                                            echo '</div>';
                                        echo entrada(ladesc($df_rq['adreca']),'adreca','M',ladesc($df_rq['adreca']),$df_rq['adreca']['val'],false,'',5);
                                        echo '</div>';
                                        echo '</div>';
                                        // FCL fi FCL fi FC fi FC  fi FC  fi FC  fi FC  fi FC  fi FC  fi FC  fi FC  fi FC  fi FC 
                                        // LCL *** LCL *** LCL *** LCL *** LCL *** LCL *** LCL *** LCL ***
                                        echo '<div class="amplia" id="divlcl" style="margin-bottom:15px;display:yes;">';
                                        echo '<div class="row ptda-separa">';
                                            echo entrada(ladesc($df_rq['bultos']),'bultos','T','No.',$df_rq['bultos']['val'],true,'|RIGHT|',3,fa_input_select('tipobult',(($langles)?'angles':'tipobult'),'','',null,(($langles)?'angles':'tipobult'),'',true,4),6);
                                            echo entrada(ladesc($df_rq['kilos']),'kilos','T','KGs',$df_rq['kilos']['val'],true,'|RIGHT|',0,'',6);
                                            $volmesures = '<label><input onclick="veumides();" id="mesuressino" name="mesuressino" type="checkbox" value="1" '.(($df_rq['mesuressino']['val'])?'checked':'').'> '.ladesc($df_rq['mesuressino']).'</label>';
                                            echo entrada('CBM','cbmmax','T','m3',$df_rq['cbmmax']['val'],true,'|RIGHT|',0,$volmesures,6,'',3);
                                            // Mesures
                                            echo '<div class="amplia" id="commesura" style="display:none;margin:20px;">';
    //                                        echo '<div class="amplia" id="commesura" >';
                                                 echo html_input_hidden('nmides','0',true);
                                                 echo '<table id="taulamesura" border="1" class="taula12"><thead><tr style="font-size:0.8em;">';
                                                 echo '<th style="width: 16%;">Bult</th><th style="width: 12%">L</th><th style="width: 12%">W</th><th style="width: 12%">H</th><th style="width: 5%"><label data-toggle="tooltip" title="Remontable">R*</label></th><th style="width: 15%">CBM</th><th style="width: 5%;text-align:center;"><span onclick="mesmides();"><i class="fa fa-plus"></i></span></th>';
                                                 echo '</tr></thead>';
                                                 echo '<tr id="row_mides_">';
                                                 echo '<td><input onchange="calmides();" type="text" name="nbult1" placeholder="No"></dt>';
                                                 echo '<td><input onchange="calmides();" type="text" name="l1" pattern="[0-9]+([,\.][0-9]+)?" placeholder="Large"></td>';
                                                 echo '<td><input onchange="calmides();" type="text" name="w1" placeholder="Width"></td>';
                                                 echo '<td><input onchange="calmides();" type="text" name="h1" placeholder="Height"></td>';
                                                 echo '<td><input id="rm1" name="rm1" type="checkbox" value=""></td>';
                                                 echo '<td><input type="text" name="tot1" disabled value="0"></td>';
                                                 echo '<td onclick="borramides();" style="text-align:center;"><i class="fa fa-remove"></i></td>';
                                                 echo '</tr>';
                                                 echo '</table>';

                                                 echo '<table id="taularesult" border="0" class="taula12">';
                                                 echo '<tr id="row_mides_" style="font-size:0.8em;">';
                                                 echo '<td style="width: 50%"></dt>';
                                                 echo '<td style="width: 25%">TOTAL CBM</td>';
                                                 echo '<td style="width: 20%"><input type="text" name="totalcbm" disabled value="0"></td>';
                                                 echo '<td style="width: 5%;"></td>';
                                                 echo '</tr>';
                                                 echo '<tr style="padding-top:20px;"><td colspan="4" style="text-align:left;"><i>L / W / H (cm) - TOTAL (m<sup>3</sup>)</i>';
                                                 echo '<div style="float:right;padding-right:10px;"><span><button class="btn-warning btn-xs" id="cbm_valida" type="button" onclick="cbmvalida();">'.(($langles)?'Validate CBM':'Validar CBM').'</button></span><div>';
                                                 echo '</td></tr>';
                                                 echo '</table>';
                                            echo '</div>';
                                            // Fi Mesures

                                        echo '</div>';
                                        echo '</div>';
                                        //  LCL *** fi  LCL *** fi  LCL *** fi  LCL *** fi  LCL *** fi 
                                        
// function entrada($laetiqueta="",$elnom="texto",$tipus="",$explicacio="",$elvalor="",$obliga=false,$elcom="",$lallargada=3,$meshtmlinput='',$ncols=0,$mesclase='',$onclick=''){

                                        echo entrada(ladesc($df_rq['rollo']),'rollo','M',(($langles)?'Notes':'Notas'),$df_rq['rollo']['val'],false,'',8);
                                        
                                        echo '</div>';
                                        echo '</div>';
                                        echo '<div class="row">';
                                        echo '</div>';
                                        
                                        echo '<div class="col-md-4 text-center" style="padding:10px 0px 0px 0px;"><div><input type="submit" id="confirmar" name="comfirmar" class="btn btn-lg btn-primary btn-block" value="'.(($langles)?'Confirm':'Confirmar').'"></div>';
                                        echo '</div><div style="float:right;">';
                                            include 'skypechat.php';
                                        echo '</div>';
                                    echo '</form>';
                                echo '</div>';
                            echo '</div>';
                            ?>
                        </div>
                    </div>
                </div>
            </div>

        <?php 

            // <!-- Footer -->
            include 'footer.php';
            include_once 'htmljavascript.php';
            htmljavascript('','wow'); 
        ?>
        <script src="assets/js/bookingi.js"></script>;
    </body>
</html>