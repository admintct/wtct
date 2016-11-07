<?php
    $GLOBALS['amblog'] = 0;
    include_once 'sempre.php';
    include 'htmldoctipe.php';
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
            if ($port){
                $ctmp = trim($port);
                $port = tornacamp($conec, 'descrip', 'punts', 'descrip', $ctmp);
                if (empty($port)){
                    saltaa('export.php');
                }
            }
            else{
                saltaa('export.php');
            }
            $viaje = '';
            $elbarco = '';
            $eltel = retvar('telefon');if (empty($eltel)){$eltel = (isset($_SESSION['usr_telefon']))?$_SESSION['usr_telefon']:'';}
            $elpic = retvar('elpic'); if (empty($elpic)){ $elpic = (isset($_SESSION['usr_nomuser']))?$_SESSION['usr_nomuser']:'';}
            $emailbook = retvar('emailbook'); if (empty($emailbook)){ $emailbook = (isset($_SESSION['usr_email']))?$_SESSION['usr_email']:'';}
            $refsche = retvar('refsche');
            if (! empty($refsche)){
                // recuperem el viatge i la etseta
                $quevol = 'SELECT * FROM scheweb WHERE unicweb="'.$refsche.'"';
                $fconstmp = mysqli_query($conec,$quevol );
                if ($scheweb = mysqli_fetch_array($fconstmp)) {
                    $_REQUEST['elviaje'] = $scheweb['viaje'];
                    $_REQUEST['laets'] = $scheweb['etseta'];
                    $_REQUEST['elbarco'] = $scheweb['nombarco'];
                    $_REQUEST['cutoff'] = $scheweb['closing'];
                }
            }
            $df_lcl = array(
                'port' => array('tipo'=>'C','desc' => array('es'=>'FPOD','en'=>'FPOD'),'val'=>$port),
                'elbarco' => array('tipo'=>'C','desc' => array('es'=>'Barco','en'=>'Vessel'),'val'=>retvar('elbarco')),
                'laets' => array('tipo'=>'D','desc' => array('es'=>'ETS','en'=>'ETS'),'val'=>retvar('laets')),
                'cutoff' => array('tipo'=>'D','desc' => array('es'=>'Cut Off','en'=>'Cut Off'),'val'=>retvar('cutoff')),
                'elviaje' => array('tipo'=>'T','desc' => array('es'=>'Viaje','en'=>'Voyage'),'val'=>retvar('elviaje')),
                'lclfcl' => array('tipo'=>'RB','desc' => array('es'=>'Tipo','en'=>'Type'),'val'=>((retvar('lclfcl')<2)?1:2)),
                'oftct' => array('tipo'=>'C','desc' => array('es'=>'Oferta TCT','en'=>'SQ TCT'),'val'=>(retvar('oftct'))),
                'suref' => array('tipo'=>'C','desc' => array('es'=>'Su Ref.','en'=>'Your Ref.'),'val'=>(retvar('suref'))),
                'esagent' => array('tipo'=>'L','desc' => array('es'=>'','en'=>''),'val'=>(hies())?(($_SESSION['usr_codage'])?1:0):0),
                'empresa' => array('tipo'=>'C','desc' => array('es'=>'Empresa','en'=>'Company'),'val'=>((hies())?(($_SESSION['usr_codcli'])?$_SESSION['usr_nomcli']:$_SESSION['usr_nomage']):retvar('empresa'))),
                'adreca' => array('tipo'=>'M','desc' => array('es'=>'Direcci&oacute;n','en'=>'Address'),'val'=>(retvar('adreca'))),
                'nif' => array('tipo'=>'T','desc' => array('es'=>'NIF','en'=>'Fiscal ID'),'val'=>(retvar('nif'))),
                'telefon' => array('tipo'=>'T','desc' => array('es'=>'Phone','en'=>'Tel.'),'val'=>$eltel),
                'elpic' => array('tipo'=>'T','desc' => array('es'=>'PIC','en'=>'PIC'),'val'=>$elpic),
                'emailbook' => array('tipo'=>'T','desc' => array('es'=>'email','en'=>'email'),'val'=>$emailbook),
                'bloriexpr' => array('tipo'=>'C','desc' => array('es'=>'BL','en'=>'BL'),'val'=>(retvar('bloriexpr'))),
                'shipper' => array('tipo'=>'M','desc' => array('es'=>'Shipper','en'=>'Shipper'),'val'=>(retvar('shipper'))),
                'consignee' => array('tipo'=>'M','desc' => array('es'=>'Consignee','en'=>'Consignee'),'val'=>(retvar('consignee'))),
                'notify' => array('tipo'=>'M','desc' => array('es'=>'Notify','en'=>'Notify'),'val'=>(retvar('notify'))),
                'fechaentrega' => array('tipo'=>'D','desc' => array('es'=>'Entrega Almacén','en'=>'D. Warehouse'),'val'=>retvar('fechaentrega')),
                'bultos' => array('tipo'=>'N','desc' => array('es'=>'Bultos','en'=>'Bulks'),'val'=>retvar('bultos')),
                'tipobult' => array('tipo'=>'T','desc' => array('es'=>'Tipo de Bultos','en'=>'Kind of Bulks'),'val'=>retvar('tipobult')),
                'kilos' => array('tipo'=>'N','desc' => array('es'=>'Peso','en'=>'Weight'),'val'=>retvar('kilos')),
                'cbmmax' => array('tipo'=>'N','desc' => array('es'=>'CBM','en'=>'CBM'),'val'=>retvar('cbmmax')),
                'mesuressino' => array('tipo'=>'L','desc' => array('es'=>'Medidas','en'=>'Measures'),'val'=>isset($_REQUEST['mesuressino'])),
                'remontable' => array('tipo'=>'RB','desc' => array('es'=>'Remontable','en'=>'Stackable'),'val'=>((retvar('remontable')<2)?1:2)),
                'mercancia' => array('tipo'=>'T','desc' => array('es'=>'Mercanc&iacute;a','en'=>'Goods'),'val'=>retvar('mercancia')),
                'marcas' => array('tipo'=>'T','desc' => array('es'=>'Marcas','en'=>'Marks'),'val'=>retvar('marcas')),
                'hscode' => array('tipo'=>'T','desc' => array('es'=>'HS CODE','en'=>'HS CODE'),'val'=>retvar('hscode')),
                'volimo' => array('tipo'=>'L','desc' => array('es'=>'IMO','en'=>'IMO'),'val'=>isset($_REQUEST['volimo'])),
                'volrecull' => array('tipo'=>'L','desc' => array('es'=>'Solicitar Transporte','en'=>'Pickup'),'val'=>isset($_REQUEST['volrecull'])),
                'datarecull' => array('tipo'=>'D','desc' => array('es'=>'F. Recogida','en'=>'Pickup D.'),'val'=>retvar('datarecull')),
                'dirrecull' => array('tipo'=>'M','desc' => array('es'=>'Dir. Recogida','en'=>'Address'),'val'=>(retvar('dirrecull'))),
                'telrecull' => array('tipo'=>'T','desc' => array('es'=>'Tel.','en'=>'Tel.'),'val'=>retvar('telrecull')),
                'picrecull' => array('tipo'=>'T','desc' => array('es'=>'PIC','en'=>'PIC'),'val'=>retvar('picrecull')),
                'horarirecull' => array('tipo'=>'T','desc' => array('es'=>'Horario','en'=>'Working hours'),'val'=>retvar('horarirecull')),
                'refrecull' => array('tipo'=>'T','desc' => array('es'=>'Referencia','en'=>'Reference'),'val'=>retvar('refrecull')),
                'incoterm' => array('tipo'=>'T','desc' => array('es'=>'INCOTERM','en'=>'INCOTERM'),'val'=>retvar('incoterm')),
                'direntrega' => array('tipo'=>'M','desc' => array('es'=>'Dir. Entrega','en'=>'Del. Address'),'val'=>(retvar('direntrega'))),
                'insdespacho' => array('tipo'=>'T','desc' => array('es'=>'Ints. Despacho','en'=>'Customs Inst.'),'val'=>retvar('insdespacho')),
                'despachacli' => array('tipo'=>'RB','desc' => array('es'=>'Despacho','en'=>'Customs Clearance'),'val'=>((retvar('despachacli')<2)?1:2)),
                'asentamiento' => array('tipo'=>'RB','desc' => array('es'=>'Asentamiento','en'=>'Asentamiento'),'val'=>((retvar('asentamiento')<2)?1:2)),
                'rollo' => array('tipo'=>'M','desc' => array('es'=>'Notas','en'=>'Notes'),'val'=>(retvar('rollo'))),
                'rollocntr' => array('tipo'=>'M','desc' => array('es'=>'CNTRs','en'=>'CNTRs'),'val'=>null),
                'rollomides' => array('tipo'=>'M','desc' => array('es'=>'Medidas','en'=>'Measures'),'val'=>null),
                'codcli' => array('tipo'=>'M','desc' => array('es'=>'Cod. Cliente','en'=>'Cod. Client'),'val'=>((hies())?(($_SESSION['usr_codcli'])?$_SESSION['usr_codcli']:$_SESSION['usr_codage']):'')),
                'rolloimo' => array('tipo'=>'M','desc' => array('es'=>'IMOs','en'=>'IMOs'),'val'=>null),
                'insurance' => array('tipo'=>'L','desc' => array('es'=>'Seguro Mercancía','en'=>'Insurance'),'val'=>isset($_REQUEST['insurance'])),
                'envdocs' => array('tipo'=>'L','desc' => array('es'=>'Envío documentos destino','en'=>'Courier'),'val'=>isset($_REQUEST['envdocs'])),
                'documents' => array('tipo'=>'L','desc' => array('es'=>'Envío Documentación','en'=>'Documents'),'val'=>isset($_REQUEST['documents'])),
                'flag' => array('tipo'=>'L','desc' => array('es'=>'Bandera','en'=>'Flag'),'val'=>isset($_REQUEST['flag'])),
                'freight' => array('tipo'=>'L','desc' => array('es'=>'Flete','en'=>'Freight'),'val'=>isset($_REQUEST['freight'])),
                'blacklist' => array('tipo'=>'L','desc' => array('es'=>'Black List','en'=>'Black List'),'val'=>isset($_REQUEST['blacklist'])),
                'age' => array('tipo'=>'L','desc' => array('es'=>'Edad','en'=>'Age'),'val'=>isset($_REQUEST['age'])),
                'route' => array('tipo'=>'L','desc' => array('es'=>'Ruta','en'=>'Route'),'val'=>isset($_REQUEST['route'])),
            );
            $textecntr = '';
            $elscntrs = array();
            $textedimensio = '';
            $detmides = array();
            $texteimo = '';
            $detimos = array();
            //*****
        ?>
    </head>
    <body>
        <?php 
                $grava = (isset($_REQUEST['comfirmar']));
                if ($grava){
                        // Guardo Els CNTRs
                        if ($df_lcl['lclfcl']['val'] == '2'){
                            $ncntr = retvar('ncntr');
                            for ($i = 0;$i <= $ncntr; $i++) {
                                $n = $i+1;
                                array_push($elscntrs, array(retvar('ucntr'.$n),retvar('tipofcl'.$n)));
                                $textecntr .= $elscntrs[$i][0]." x ".$elscntrs[$i][1].$crlf;
                            }
                        }
                        // Guardo les mides
                        if ($df_lcl['mesuressino']['val']){
                            $nmides = retvar('nmides');
                            for ($i = 0;$i <= $nmides; $i++) {
                                $n = $i+1;
                                array_push($detmides, array(retvar('nbult'.$n),retvar('l'.$n),retvar('w'.$n),retvar('h'.$n),(isset($_REQUEST[('rm'.$n)]))?'1':'0'));
                                $textedimensio .= $detmides[$i][0]." ".ladesc($df_lcl['bultos'])." : ".$detmides[$i][1].' x '.$detmides[$i][2].' x '.
                                                $detmides[$i][3].(($detmides[$i][4])?' Remontable':'').$crlf;
                            }
                        }
                        // Guardo els IMOs
                        if ($df_lcl['volimo']['val']){
                            $nimos = retvar('nimos');
                            for ($i = 0;$i <= $nimos; $i++) {
                                $n = $i+1;
                                array_push($detimos, array(retvar('classe'.$n),retvar('onu'.$n),retvar('pg'.$n)));
                                $texteimo .= 'IMO : '.$detimos[$i][0].", ONU : ".$detimos[$i][1].' PG : '.$detimos[$i][2].$crlf;
                            }
                        }
                        // Ara ho grava
                        $df_lcl['rollocntr']['val'] = $textecntr;
                        $df_lcl['rollomides']['val'] = $textedimensio;
                        $df_lcl['rolloimo']['val'] = $texteimo;
                        $quevol = "INSERT INTO bookinge (`codi`) VALUES (NULL);";
                        $fcons = mysqli_query($conec,$quevol);
                        $codialta = $conec->insert_id;
                        // Guardar
                        $opera = fesupdate($df_lcl);
                        $quevol = 'UPDATE bookinge SET '.$opera.' WHERE codi='.$codialta; 
//echo '***'.$opera.'***';                        
                        $fcons = mysqli_query($conec,$quevol);
                        // Ara ho envia per email 
                        $_SESSION['missatge'] ='';
                        $tira = '';
                        guardaquefan("BOOKING EXPORT","BOOKING",$port,"REF: ".$codialta);
                        include_once 'bookinge_to_mail.php';
                        // Ara posa que ha fet el booking
                        // Ara torna als bookings de exportació
                        $_SESSION['missatge'] .= texteweb('GRACIAS_BOOKING_E','').'</br>'.$tira;
                        saltaa('export.php');
                }
            }
            
            
            // <!-- Top menu -->
            menutct();
            // -- Page Title -->
            
            pagetitle("Nuevo Booking de EXPORT",nom_usroagent(),"EXPORT new booking",nom_usroagent(),"bookings",'','export.php'); 
            if (empty($refsche)){
                // Si no hi ha schedule cal dir alguna cosa ...
                $quediutit = texteweb('NO_SCHE_EXP',1);
                $quediu = texteweb('NO_SCHE_EXP');
                echo '<div style="padding:15px 5px 0px 5px" class="col-xs-12 col-md-6 col-centered">';
                echo '<div class="panel panel-info"><div class="panel-heading">'.$quediutit.'</div>'.
                        '<div class="panel-body" style="text-align:left;">'.$quediu.'</div>'.
                        '</div>';
                echo '</div>';
            }
        ?>
            <div class="container">
                <div class="row" style="padding: 15px 0px 20px 0px;">
                    <div class="col-md-12">
                        <div id="elpanell" class="panel panel-primary">
                            <?php
                            
                            echo '<div class="panel-heading"><h5>'.(($langles)?'NEW EXPORT BOOKING':'NUEVO BOOKING EXPORTACION').'</h5></div>';
                                echo '<form role="form" id="bookinge" action="bookinge.php" method="POST" enctype="multipart/form-data" onsubmit="spinn()" data-fv-framework="bootstrap"
                                        data-fv-icon-valid="glyphicon glyphicon-ok"
                                        data-fv-icon-invalid="glyphicon glyphicon-remove"
                                        data-fv-icon-validating="glyphicon glyphicon-refresh">'; 
                                    echo '<div class="panel-body"><div class="row">';
                                        echo '<div class="container-fluid col-md-4">'; // Primera columna
                                        echo '<div class="row separa_titol"><b>'.(($langles)?'Service':'Servicio').'</b></div>';
                                        echo entrada((($langles)?'Origin':'Origen'),'','L','','<b>Barcelona</b>');
                                        echo html_input_hidden('punt',$df_lcl['port']['val']);
                                        echo html_input_hidden('laets',$df_lcl['codcli']['val']);
                                        echo html_input_hidden('cutoff',$df_lcl['cutoff']['val']);
                                        echo html_input_hidden('elviaje',$df_lcl['elviaje']['val']);
                                        echo html_input_hidden('elbarco',$df_lcl['elbarco']['val']);
                                        if (empty($refsche)){
                                            echo entrada('FPOD','','L','','<b>'.$port.'</b>');
                                            echo entrada((($langles)?'Estimated ETS':'ETS deseada'),'laets','D','',$df_lcl['laets']['val'],false,'',0,'',3);
                                        }
                                        else{
                                            $elboto = '<button class="btn-primary btn-xs" type="button" OnClick="brow(\'fpod\',\'#elviaje\',\'#punt\');">FPOD</button>';
                                            echo entrada($elboto,'','L','','<b id="puntz">'.$port.'</b>');
                                            $elboto = '<button class="btn-primary btn-xs" type="button" OnClick="brow(\'fpod-voy\',\'#punt\',\'\');">'.(($langles)?'Voyage':'Viaje').'</button>';
                                            echo entrada($elboto,'','L','','<b id="elviajez">'.$df_lcl['elviaje']['val'].'</b>');
                                            echo html_input_hidden('laets',$df_lcl['laets']['val']);
                                            if ($df_lcl['elbarco']['val']){
                                                echo entrada((($langles)?'Vesel':'Barco'),'','L','','<b id="nombarcoz">'.$df_lcl['elbarco']['val'].'</b>');
                                            }
                                            echo entrada('ETS','','L','','<b id="laetsz">'.DTOC($df_lcl['laets']['val']).'</b>');
                                            echo entrada('Cut Off','','L','','<b id="cutoffz">'.DTOC($df_lcl['cutoff']['val']).'</b>');
                                        }

                                        if (isset($_SESSION['usr_forwarder']) && $_SESSION['usr_forwarder']){
                                            echo entrada((($langles)?'TYPE':'TIPO'),'','L','','<b>LCL</b>');
                                        }
                                        else{
                                            echo entrada(ladesc($df_lcl['lclfcl']),'lclfcl','RB','',$df_lcl['lclfcl']['val'],false,'',3,fa_radio_button('lclfcl',array('LCL'=>1,'FCL'=>2),$df_lcl['lclfcl']['val'],'funlclfcl'),0);
                                        }
                                        if (isset($_SESSION['usr_codcli'])){
                                            $elboto = '<button class="btn-primary btn-xs" type="button" OnClick="brow(\'ofertas\',\''.$_SESSION['usr_codcli'].'\',\'#punt\');">'.(($langles)?'S.Q.':'Oferta').'</button>';
                                        }
                                        else{
                                            $elboto  = ($langles)?'S.Q.':'Oferta';
                                        }
                                        echo entrada($elboto,'oftct','T','Ref.',$df_lcl['oftct']['val'],false,'',0,'',5);
//                                        echo entrada(ladesc($df_lcl['oftct']),'oftct','T','Ref.',$df_lcl['oftct']['val'],false,'',0,'<button type="button" OnClick="brow(\'ofertas\',\''.$_SESSION['usr_codcli'].'\',\'#punt\');"><i class="fa fa-list"></i> Sel.</button>',5);
                                        echo entrada((($langles)?'Your Ref.':'Su Ref.'),'suref','T','Ref.',$df_lcl['suref']['val']);
                                        // DATOS DE CONTACTO == DATOS DE CONTACTO ==DATOS DE CONTACTO ==DATOS DE CONTACTO ==DATOS DE CONTACTO ==
                                        echo '<div class="amplia">';
                                        echo '<div class="row separa_titol"><b>'.(($langles)?'Contact details':'Datos de Contacto').'</b></div>';
                                        if (! hies()){
                                            echo entrada(ladesc($df_lcl['empresa']),'empresa','T',ladesc($df_lcl['empresa']),$df_lcl['empresa']['val'],true);
                                            echo entrada(ladesc($df_lcl['adreca']),'adreca','M',ladesc($df_lcl['adreca']),$df_lcl['adreca']['val']);
                                            echo entrada(ladesc($df_lcl['nif']),'nif','T','NIF',$df_lcl['nif']['val'],false,'',0,'',4);
                                            echo entrada('Tel.','telefon','T','Tel.',$df_lcl['telefon']['val']);
                                            
                                        }
                                        echo entrada('PIC','elpic','T','Persona de Contacto',$df_lcl['elpic']['val'],true);
                                        echo entrada('email','emailbook','E','email de Contacto',$df_lcl['emailbook']['val'],true);
                                        echo '</div>';
                                        // INSTRUCCIONES === INSTRUCCIONES === INSTRUCCIONES === INSTRUCCIONES === INSTRUCCIONES ===
                                        echo '<div class="row separa_titol"><b>'.(($langles)?'Instructions':'Instrucciones').'</b></div>';
                                        $deftext = ($langles)?'Address & Contact':'Dirección & Contacto';
                                        echo entrada(ladesc($df_lcl['bloriexpr']),'bloriexpr','RB','',$df_lcl['bloriexpr']['val'],false,'',3,fa_radio_button('bloriexpr',array('ORIGINAL'=>1,'EXPRESS'=>2),$df_lcl['bloriexpr']['val']),0);
                                        echo entrada('Shipper','shipper','M',$deftext,$df_lcl['shipper']['val'],false,'',6);
                                        echo entrada('Consignee','consignee','M',$deftext,$df_lcl['consignee']['val'],false,'',6);
                                        echo entrada('Notify','notify','M',$deftext,$df_lcl['notify']['val'],false,'',4);

                                        echo '</div>';
                                        // Segona columna ** Segona columna ** Segona columna ** Segona columna ** Segona columna ** Segona columna **
                                        echo '<div class="col-md-4">'; 
                                        echo '<div class="row separa_titol"><b>'.(($langles)?'Commodity':'Mercanc&iacute;a').'</b></div>';
                                        echo entrada(ladesc($df_lcl['fechaentrega']),'fechaentrega','D','',$df_lcl['fechaentrega']['val'],false,'',0,'',3);
                                        // FCL *** FCL *** FCL *** FCL *** FCL *** FCL *** FCL *** FCL *** FCL *** FCL ***
                                        echo '<div class="amplia" id="divfcl" style="margin-bottom:15px;display:none;">';
                                        echo '<div class="row ptda-separa">';
                                            echo '<div class="col-xs-3 milabel text-right"><label>FCL</label></div>';
                                            echo '<div class="col-xs-9 milabel text-right">';
                                            
                                             echo html_input_hidden('ncntr','0',true);
                                             echo '<table id="taulafcl" border="1" class="taula12"><thead><tr>';
                                             echo '<th style="width: 40%">CNTRs</th><th style="width: 40%"></th><th style="width: 20%;text-align:center;"><span onclick="mescntr();"><i class="fa fa-plus"></i></span></th>';
                                             echo '</tr></thead>';
                                             echo '<tr id="row_fcl_">';
                                             echo '<td><input style="text-align:right;" type="text" name="ucntr1" placeholder="No"></td>';
                                             echo '<td style="color:rgba(16,63,117,1.00);">'.fa_input_select('','','','',array('   ','20 BOX','40 BOX','40 HC','20 RFR','20 OT','40 OT','20 FR','40 FR'),'tipofcl1','').'</td>';
                                             echo '<td onclick="borrafcl();" style="text-align:center;color:orangered;"><i class="fa fa-remove"></i></td>';
                                             echo '</tr>';
                                             echo '</table>';
                                            echo '</div>';
                                        echo '</div>';
                                        echo '</div>';
                                        //'<font color="#ff0000">*</font>'.
                                        // FCL fi FCL fi FC fi FC  fi FC  fi FC  fi FC  fi FC  fi FC  fi FC  fi FC  fi FC  fi FC 
                                        echo entrada(ladesc($df_lcl['bultos']),'bultos','T','No.',$df_lcl['bultos']['val'],true,'|RIGHT|',3,fa_input_select('tipobult',(($langles)?'angles':'tipobult'),'','',null,(($langles)?'angles':'tipobult'),'',true,4),6);
                                        echo entrada(ladesc($df_lcl['kilos']),'kilos','T','KGs',$df_lcl['kilos']['val'],true,'|RIGHT|',0,'',6);
                                        $volmesures = '<label><input onclick="veumides();" id="mesuressino" name="mesuressino" type="checkbox" value="1" '.(($df_lcl['mesuressino']['val'])?'checked':'').'> '.ladesc($df_lcl['mesuressino']).'</label>';
                                        echo entrada('CBM','cbmmax','T','m3',$df_lcl['cbmmax']['val'],true,'|RIGHT|',0,$volmesures,6,'',3);
                                        // Mesures
                                        echo '<div class="amplia" id="commesura" style="display:none;">';
//                                        echo '<div class="amplia" id="commesura" >';
                                             echo html_input_hidden('nmides','0',true);
                                             echo '<table id="taulamesura" border="1" class="taula12"><thead><tr>';
                                             echo '<th style="width: 16%">'.(($langles)?'Bulk':'Bult').'</th><th style="width: 12%">L</th><th style="width: 12%">W</th><th style="width: 12%">H</th><th style="width: 5%"><label data-toggle="tooltip" title="'.(($langles)?'Stackable':'Remontable').'">'.(($langles)?'S':'R').'*</label></th><th style="width: 15%">CBM</th><th style="width: 5%;text-align:center;"><span onclick="mesmides();"><i class="fa fa-plus"></i></span></th>';
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
                                             echo '<tr id="row_mides_">';
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
                                        // Fi Mesured
                                        echo entrada(ladesc($df_lcl['remontable']),'remontable','RB','',$df_lcl['remontable']['val'],false,'',3,fa_radio_button('remontable',array((($langles)?'Yes':'Si')=>1,'No'=>2),$df_lcl['remontable']['val'],''),0);
                                        //echo entrada('<b>*'.ladesc($df_lcl['remontable']).'</b>','remontable','CK','',$df_lcl['remontable']['val'],false,'');
                                        echo entrada(ladesc($df_lcl['mercancia']),'mercancia','M',(($langles)?'Goods':'Mercanc&iacute;a'),$df_lcl['mercancia']['val'],true);
                                        echo entrada(ladesc($df_lcl['marcas']),'marcas','M',(($langles)?'Marks':'Marcas'),$df_lcl['marcas']['val'],false,'',5);
                                        echo entrada('HS Code','hscode','T','HS Code.',$df_lcl['hscode']['val']);
                                        echo entrada('<b style="color:orangered;">IMO</b>','volimo','CK','imo',$df_lcl['volimo']['val'],false,'|NOPRIMERA|',0,'',0,'','imosino();');
                                        // Recollida
//                                        echo '<div id="comimo" class="col-xs-12 milabel text-left" style="padding:5px;background-color:darkorange;white-space:nowrap;" >';
                                        echo '<div id="comimo" class="col-xs-12 milabel text-left" style="display:none;padding:5px;background-color:darkorange;white-space:nowrap;" >';
                                             echo html_input_hidden('nimos','0',true);
                                             echo '<table id="taulamimo" border="1" class="taula12"><thead><tr>';
                                             echo '<th style="width: 30%">'.(($langles)?'CLASS':'CLASE').'</th><th style="width: 30%">'.(($langles)?'UN':'ONU').'</th><th style="width: 30%">PG</th><th onclick="mesmimo();" style="width: 10%;text-align:center;"><i class="fa fa-plus"></i></th>';
                                             echo '</tr></thead>';
                                             echo '<tr id="row_imo_">';
                                             echo '<td><input type="text" name="classe1" placeholder="Classe"></dt>';
                                             echo '<td><input type="text" name="onu1" placeholder="ONU"></td>';
                                             echo '<td><input type="text" name="pg1" placeholder="PG"></td>';
                                             echo '<td onclick="borraimos();" style="text-align:center;"><i class="fa fa-remove"></i></td>';
                                             
                                             echo '</tr></table>';
                                        echo '</div>';
                                        echo '<div id="comimo2" style="display:none;padding:10px 0px 5px 0px;">';
                                            echo '<i><span>';
                                                $quevolp = 'SELECT codi, descrip, imosno FROM punts WHERE descrip="'.$port.'"';
                                                $fconstmpr = mysqli_query($conec,$quevolp);
                                                if ($xpunts = mysqli_fetch_array($fconstmpr)) {
                                                    if ($xpunts['imosno']){
                                                        echo '<b>IMOs '.(($langles)?'not accepted':'NO permitidos').' : </b><span id="imosno">'.$xpunts['imosno'].'</span>';
                                                    }
                                                    else{
                                                        echo '&nbsp;';
                                                    }
                                                }
                                            echo '</span></i>';
                                        echo '</div>';
                                        // Fi Recollida
                                        echo '<div class="row separa_titol"><b>'.(($langles)?'Conditions':'Condiciones').'</b></div>';
                                        echo entrada('INCOTERM','incotern','SEL','incoterm','',false,'',0,fa_input_select('','','',$df_lcl['incoterm']['val'],array('','EXW','FCA','FAS','FOB','CPT','CIP','CFR','CIF','DAT','DAP','DDP'),'incoterm','cambiainco()',true,4));
                                        // Entrega
                                        echo '<div class="amplia" id="comentrega" style="display:none;">';
                                        echo entrada(ladesc($df_lcl['direntrega']),'direntrega','M','Dirección',$df_lcl['direntrega']['val'],false,'',6);
                                        echo '</div>';
                                        // Fi Entrega
                                        
// function entrada($laetiqueta="",$elnom="texto",$tipus="",$explicacio="",$elvalor="",$obliga=false,$elcom="",$lallargada=3,$meshtmlinput='',$ncols=0,$mesclase='',$onclick=''){
                                        echo entrada(ladesc($df_lcl['insdespacho']),'insdeapacho','SEL','insdespacho','',false,'',0,fa_input_select('','','',$df_lcl['insdespacho']['val'],array('','DUA','DAE','TRANSITO T1','T2L','D500'),'insdespacho','',false));
                                        echo entrada(ladesc($df_lcl['despachacli']),'despachacli','RB','',$df_lcl['despachacli']['val'],false,'',3,fa_radio_button('despachacli',array((($langles)?'Client':'Cliente')=>1,'TCT'=>2),$df_lcl['despachacli']['val'],''),0);
                                        if (! esagent()){
                                            echo entrada(ladesc($df_lcl['asentamiento']),'asentamiento','RB','',$df_lcl['asentamiento']['val'],false,'',3,fa_radio_button('asentamiento',array((($langles)?'Client':'Cliente')=>1,'TCT'=>2),$df_lcl['asentamiento']['val'],''),0);
                                        }
                                        echo entrada('<b>'.ladesc($df_lcl['insurance']).'</b>','insurance','CK','insurance',$df_lcl['insurance']['val'],false,'',0,'',0,'','recullsino();','');
                                        echo entrada('<b>'.ladesc($df_lcl['envdocs']).'</b>','envdocs','CK','envdocs',$df_lcl['envdocs']['val'],false,'',0,'',0,'','','');
                                        echo '<div class="row separa_titol"><b>'.(($langles)?'Certificate request :':'Solicitar Certificados :').'</b></div>';
                                                echo '<div class="col-xs-12 ptda_separa_after">';
                                                            echo '<div style="padding-top:5px;" class="col-xs-6 text-left">';
                                                                echo '<div><label><input id="documents" name="documents" type="checkbox" value="0"> '.(($langles)?'Documents':'Envío Documentación').'</label></div>';
                                                                echo '<div><label><input id="flag" name="flag" type="checkbox" value="0"> '.(($langles)?'Flag':'Bandera').'</label></div>';
                                                                echo '<div><label><input id="freight" name="freight" type="checkbox" value="0"> '.(($langles)?'Freight':'Flete').'</label></div>';
                                                            echo '</div>';
                                                            echo '<div style="padding-top:5px;" class="col-xs-4 text-left">';
                                                                echo '<div><label><input id="blacklist" name="blacklist" type="checkbox" value="0"> Black List</label></div>';
                                                                echo '<div><label><input id="age" name="age" type="checkbox" value="0"> '.(($langles)?'Age':'Edad').'</label></div>';
                                                                echo '<div><label><input id="route" name="route" type="checkbox" value="0"> '.(($langles)?'Route':'Ruta').'</label></div>';
                                                            echo '</div>';
                                                echo '</div>';

    ?>
    <?php
                                        echo '</div>';
                                        // Tercera columna // Tercera columna// Tercera columna// Tercera columna// Tercera columna
                                        echo '<div class="col-md-4">'; 
                                        echo entrada('<b>'.ladesc($df_lcl['volrecull']).'</b>','volrecull','CK','volrecull',$df_lcl['volrecull']['val'],false,'',0,'',0,'','recullsino();','<span style="font-size:28px;" class="fa fa-truck"></span>');
                                        // Recollida
                                        echo '<div style="margin-bottom:10px;" class="amplia" id="comrecull" style="display:none;">';
                                        echo entrada(ladesc($df_lcl['dirrecull']),'dirrecull','M','Dirección',$df_lcl['dirrecull']['val'],false,'',3);
                                        echo entrada(ladesc($df_lcl['datarecull']),'datarecull','D','',$df_lcl['datarecull']['val'],false,'|DATECUSTOM|',0,'',3,'','','',2);
                                        echo entrada('Tel.','telrecull','T','Tel.',$df_lcl['telrecull']['val']);
                                        echo entrada('PIC','picrecull','T','Persona de Contacto',$df_lcl['picrecull']['val']);
                                        echo entrada(ladesc($df_lcl['horarirecull']),'horarirecull','T',(($langles)?'Schedule':'Horario'),$df_lcl['horarirecull']['val']);
                                        echo entrada('Ref.','refrecull','T','Ref.',$df_lcl['refrecull']['val']);
                                        echo '</div>';
                                        // Fi Recollida
                                        // Si hi ha usuari registrat permetem pujar fitxers 
                                        if (hies()){
                                            echo html_input_hidden('nfitxers','0',true);
                                            echo '<div style="padding-top:20px">';
                                                echo '<table id="taulafitxers" border="1" class="taulafitxer"><thead><tr>';
                                                echo '<th style="width: 90%">'.(($langles)?'FILES':'ARCHIVOS').'</th><th onclick="mesfitxer();" style="width: 10%;text-align:center;"><i style="color:cyan;" class="fa fa-plus"></i></th>';
                                                echo '</tr></thead>';
                                                echo '<tr id="row_fitxer_">';
                                                $elboto = '<input type="file" class="filestyle" data-classButton="btn btn-primary" data-input="false" data-classIcon="icon-plus" name="fitxer1">';
                                                echo '<td>'.$elboto;
                                                echo '<div style="padding:5px 0px 0px 0px;" class="text-right">';
                                                echo (($langles)?'Type: ':'Tipo: ').fa_input_select('calif','califweb',' tipus="PE" AND selcliweb ','',null,'calif1');
                                                echo '</div>';
                                                echo '</dt>';
                                                echo '<td onclick="borrafitxer();" style="text-align:center;"><i style="color:orangered;" class="fa fa-remove"></i></td>';

                                                echo '</tr></table>';
                                            echo '</div>';
                                        }
                                        // FI fitxers
                                        echo '<div style="padding-top:12px;">';
                                        echo entrada(ladesc($df_lcl['rollo']),'rollo','M',(($langles)?'Notes':'Notas'),$df_lcl['rollo']['val'],false,'',8);
                                        echo '</div>';
                                        echo '</div>';
                                        echo '</div>';
                                        echo '<div class="col-md-4 text-center" style="padding:10px 0px 0px 0px;"><div><input type="submit" id="confirmar" name="comfirmar" class="btn btn-lg btn-primary btn-block" value="'.(($langles)?'Confirm':'Confirmar').'"></div>';
                                        echo '</div><div style="float:right;">';
                                            include 'skypechat.php';
                                        echo '</div>';
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
        <script src="assets/js/bookinge.js"></script>;
    </body>
</html>