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
            if ($port){
                $ctmp = trim($port);
                $port = tornacamp($conec, 'descrip', 'punts', 'descrip', $ctmp);
                if (empty($port)){
                    saltaa('import.php');
                }
            }
            else{
                saltaa('import.php');
            }
            $viaje = '';
            $elbarco = '';
            $elcutoff = '';
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
                    $_REQUEST['laeta'] = $scheweb['etseta2'];
                }
            }
            $laetsvol = retvar('laetsvol');
            $df_lcle = array(
                'fpod' => array('tipo'=>'C','desc' => array('es'=>'FPOD','en'=>'FPOD'),'val'=>retvar('fpod')),
                'port' => array('tipo'=>'C','desc' => array('es'=>'POL','en'=>'POL'),'val'=>$port),
                'elbarco' => array('tipo'=>'C','desc' => array('es'=>'Barco','en'=>'Vessel'),'val'=>retvar('elbarco')),
                'laets' => array('tipo'=>'D','desc' => array('es'=>'ETD','en'=>'ETD'),'val'=>(retvar('laets')?retvar('laets'):$laetsvol)),
                'laeta' => array('tipo'=>'D','desc' => array('es'=>'ETA','en'=>'ETA'),'val'=>retvar('laeta')),
                'cutoff' => array('tipo'=>'D','desc' => array('es'=>'Cut Off','en'=>'Cut Off'),'val'=>retvar('cutoff')),
                'elviaje' => array('tipo'=>'T','desc' => array('es'=>'Viaje','en'=>'Voyage'),'val'=>retvar('elviaje')),
                'lclfcl' => array('tipo'=>'RB','desc' => array('es'=>'Tipo','en'=>'Type'),'val'=>((retvar('lclfcl')<2)?1:2)),
                'oftct' => array('tipo'=>'C','desc' => array('es'=>'Oferta TCT','en'=>'SQ TCT'),'val'=>(retvar('oftct'))),
                'suref' => array('tipo'=>'C','desc' => array('es'=>'Su Ref.','en'=>'Your Ref.'),'val'=>(retvar('suref'))),
                'esagent' => array('tipo'=>'L','desc' => array('es'=>'','en'=>''),'val'=>(hies())?(($_SESSION['usr_codage'])?1:0):0),
                'empresa' => array('tipo'=>'C','desc' => array('es'=>'Empresa','en'=>'Company'),'val'=>((hies())?(($_SESSION['usr_codcli'])?$_SESSION['usr_nomcli']:$_SESSION['usr_nomage']):retvar('empresa'))),
                'adreca' => array('tipo'=>'M','desc' => array('es'=>'Direcci&oacute;n','en'=>'Address'),'val'=>(retvar('adreca'))),
                'nif' => array('tipo'=>'T','desc' => array('es'=>'NIF','en'=>'Fiscal ID'),'val'=>(retvar('nif'))),
                'telefon' => array('tipo'=>'T','desc' => array('es'=>'Tel.','en'=>'Phone'),'val'=>$eltel),
                'elpic' => array('tipo'=>'T','desc' => array('es'=>'PIC','en'=>'PIC'),'val'=>$elpic),
                'emailbook' => array('tipo'=>'T','desc' => array('es'=>'email','en'=>'email'),'val'=>$emailbook),
                'shipper' => array('tipo'=>'T','desc' => array('es'=>'Shipper','en'=>'Shipper'),'val'=>(retvar('shipper'))),
                'dirship' => array('tipo'=>'T','desc' => array('es'=>'Dirección','en'=>'Address'),'val'=>(retvar('dirship'))),
                'pobship' => array('tipo'=>'T','desc' => array('es'=>'Población','en'=>'City'),'val'=>(retvar('pobship'))),
                'zipship' => array('tipo'=>'T','desc' => array('es'=>'C.P.','en'=>'ZIP Code'),'val'=>(retvar('zipship'))),
                'paisship' => array('tipo'=>'T','desc' => array('es'=>'Pais','en'=>'Country'),'val'=>(retvar('paisship'))),
                'proship' => array('tipo'=>'T','desc' => array('es'=>'Provincia','en'=>'Province'),'val'=>(retvar('proship'))),
                'telship' => array('tipo'=>'T','desc' => array('es'=>'Tel.','en'=>'Phone'),'val'=>(retvar('telship'))),
                'mailship' => array('tipo'=>'T','desc' => array('es'=>'email','en'=>'email'),'val'=>(retvar('mailship'))),
                'picship' => array('tipo'=>'T','desc' => array('es'=>'PIC','en'=>'PIC'),'val'=>(retvar('picship'))),
                'consignee' => array('tipo'=>'T','desc' => array('es'=>'Consignee','en'=>'Consignee'),'val'=>(retvar('consignee'))),
                'dircons' => array('tipo'=>'T','desc' => array('es'=>'Dirección','en'=>'Address'),'val'=>(retvar('dircons'))),
                'pobcons' => array('tipo'=>'T','desc' => array('es'=>'Población','en'=>'City'),'val'=>(retvar('pobcons'))),
                'zipcons' => array('tipo'=>'T','desc' => array('es'=>'C.P.','en'=>'ZIP Code'),'val'=>(retvar('zipcons'))),
                'paiscons' => array('tipo'=>'T','desc' => array('es'=>'Pais','en'=>'Country'),'val'=>(retvar('paiscons'))),
                'procons' => array('tipo'=>'T','desc' => array('es'=>'Provincia','en'=>'Province'),'val'=>(retvar('procons'))),
                'telcons' => array('tipo'=>'T','desc' => array('es'=>'Tel.','en'=>'Phone'),'val'=>(retvar('telcons'))),
                'mailcons' => array('tipo'=>'T','desc' => array('es'=>'email','en'=>'email'),'val'=>(retvar('mailcons'))),
                'piccons' => array('tipo'=>'T','desc' => array('es'=>'PIC','en'=>'PIC'),'val'=>(retvar('piccons'))),
                'notify' => array('tipo'=>'T','desc' => array('es'=>'Notify','en'=>'Notify'),'val'=>(retvar('notify'))),
                'dirnoty' => array('tipo'=>'T','desc' => array('es'=>'Dirección','en'=>'Address'),'val'=>(retvar('dirnoty'))),
                'pobnoty' => array('tipo'=>'T','desc' => array('es'=>'Población','en'=>'City'),'val'=>(retvar('pobnoty'))),
                'zipnoty' => array('tipo'=>'T','desc' => array('es'=>'C.P.','en'=>'ZIP Code'),'val'=>(retvar('zipnoty'))),
                'paisnoty' => array('tipo'=>'T','desc' => array('es'=>'Pais','en'=>'Country'),'val'=>(retvar('paisnoty'))),
                'pronoty' => array('tipo'=>'T','desc' => array('es'=>'Provincia','en'=>'Province'),'val'=>(retvar('pronoty'))),
                'telnoty' => array('tipo'=>'T','desc' => array('es'=>'Tel.','en'=>'Phone'),'val'=>(retvar('telnoty'))),
                'mailnoty' => array('tipo'=>'T','desc' => array('es'=>'email','en'=>'email'),'val'=>(retvar('mailnoty'))),
                'picnoty' => array('tipo'=>'T','desc' => array('es'=>'PIC','en'=>'PIC'),'val'=>(retvar('picnoty'))),
                'fechaentrega' => array('tipo'=>'D','desc' => array('es'=>'Ready date','en'=>'Ready date'),'val'=>retvar('fechaentrega')),
                'bultos' => array('tipo'=>'N','desc' => array('es'=>'Bultos','en'=>'Bulks'),'val'=>retvar('bultos')),
                'tipobult' => array('tipo'=>'T','desc' => array('es'=>'Tipo de Bultos','en'=>'Kind of Bulks'),'val'=>retvar('tipobult')),
                'kilos' => array('tipo'=>'N','desc' => array('es'=>'Peso','en'=>'Weight'),'val'=>retvar('kilos')),
                'cbmmax' => array('tipo'=>'N','desc' => array('es'=>'CBM','en'=>'CBM'),'val'=>retvar('cbmmax')),
                'mesuressino' => array('tipo'=>'L','desc' => array('es'=>'Medidas','en'=>'Measures'),'val'=>isset($_REQUEST['mesuressino'])),
                'remontable' => array('tipo'=>'RB','desc' => array('es'=>'Remontable','en'=>'Stackable'),'val'=>((retvar('remontable')<2)?1:2)),
                'mercancia' => array('tipo'=>'T','desc' => array('es'=>'Mercanc&iacute;a','en'=>'Goods'),'val'=>retvar('mercancia')),
                'marcas' => array('tipo'=>'T','desc' => array('es'=>'Marcas','en'=>'Marks'),'val'=>retvar('marcas')),
                'volimo' => array('tipo'=>'L','desc' => array('es'=>'IMO','en'=>'IMO'),'val'=>isset($_REQUEST['volimo'])),
                'volentreg' => array('tipo'=>'L','desc' => array('es'=>'Solicitar Transporte','en'=>'Delivery'),'val'=>isset($_REQUEST['volentreg'])),
                'direntreg' => array('tipo'=>'M','desc' => array('es'=>'Dir. Entrega','en'=>'Address'),'val'=>(retvar('direntreg'))),
                'dataentrega' => array('tipo'=>'D','desc' => array('es'=>'F. Entrega','en'=>'Delivery D.'),'val'=>retvar('dataentrega')),
                'telentreg' => array('tipo'=>'T','desc' => array('es'=>'Phone','en'=>'Tel.'),'val'=>retvar('telentreg')),
                'picentreg' => array('tipo'=>'T','desc' => array('es'=>'PIC','en'=>'PIC'),'val'=>retvar('picentreg')),
                'horarientreg' => array('tipo'=>'T','desc' => array('es'=>'Horario','en'=>'Schedule'),'val'=>retvar('horarientreg')),
                'refentreg' => array('tipo'=>'T','desc' => array('es'=>'Ref.','en'=>'Ref.'),'val'=>retvar('refentreg')),
                'hscode' => array('tipo'=>'T','desc' => array('es'=>'HS CODE','en'=>'HS CODE'),'val'=>retvar('hscode')),
                'incoterm' => array('tipo'=>'T','desc' => array('es'=>'INCOTERM','en'=>'INCOTERM'),'val'=>retvar('incoterm')),
                'dirrecull' => array('tipo'=>'M','desc' => array('es'=>'Dir. Recogida','en'=>'Rec. Address'),'val'=>(retvar('dirrecull'))),
                'rollo' => array('tipo'=>'M','desc' => array('es'=>'Notas','en'=>'Notes'),'val'=>(retvar('rollo'))),
                'voldesglos' => array('tipo'=>'L','desc' => array('es'=>'Solicitar Desglose','en'=>'Breakdown\'s request'),'val'=>isset($_REQUEST['voldesglos'])),
                'rollodesglos' => array('tipo'=>'M','desc' => array('es'=>'Desglose','en'=>'Breakdown'),'val'=>(retvar('rollodesglos'))),
                'rollocntr' => array('tipo'=>'M','desc' => array('es'=>'CNTRs','en'=>'CNTRs'),'val'=>null),
                'rollomides' => array('tipo'=>'M','desc' => array('es'=>'Medidas','en'=>'Measures'),'val'=>null),
                'codcli' => array('tipo'=>'M','desc' => array('es'=>'Cod. Cliente','en'=>'Cod. Client'),'val'=>((hies())?(($_SESSION['usr_codcli'])?$_SESSION['usr_codcli']:$_SESSION['usr_codage']):'')),
                'rolloimo' => array('tipo'=>'M','desc' => array('es'=>'IMOs','en'=>'IMOs'),'val'=>null)
            );
            $textecntr = '';
            $elscntrs = array();
            $textedimensio = '';
            $detmides = array();
            $texteimo = '';
            $detimos = array();
            //*****
            $grava = (isset($_REQUEST['comfirmar']));
            if ($grava){
                    // Guardo Els CNTRs
                    if ($df_lcle['lclfcl']['val'] == '2'){
                        $ncntr = retvar('ncntr');
                        for ($i = 0;$i <= $ncntr; $i++) {
                            $n = $i+1;
                            array_push($elscntrs, array(retvar('ucntr'.$n),retvar('tipofcl'.$n)));
                            $textecntr .= $elscntrs[$i][0]." x ".$elscntrs[$i][1].$crlf;
                        }
                    }
                    // Guardo les mides
                    if ($df_lcle['mesuressino']['val']){
                        $nmides = retvar('nmides');
                        for ($i = 0;$i <= $nmides; $i++) {
                            $n = $i+1;
                            array_push($detmides, array(retvar('nbult'.$n),retvar('l'.$n),retvar('w'.$n),retvar('h'.$n),(isset($_REQUEST[('rm'.$n)]))?'1':'0'));
                            $textedimensio .= $detmides[$i][0]." ".ladesc($df_lcle['bultos'])." : ".$detmides[$i][1].' x '.$detmides[$i][2].' x '.
                                            $detmides[$i][3].(($detmides[$i][4])?' Remontable':'').$crlf;
                        }
                    }
                    // Guardo els IMOs
                    if ($df_lcle['volimo']['val']){
                        $nimos = retvar('nimos');
                        for ($i = 0;$i <= $nimos; $i++) {
                            $n = $i+1;
                            array_push($detimos, array(retvar('classe'.$n),retvar('onu'.$n),retvar('pg'.$n)));
                            $texteimo .= 'IMO : '.$detimos[$i][0].", ONU : ".$detimos[$i][1].' PG : '.$detimos[$i][2].$crlf;
                        }
                    }
                    // Ara ho grava
                    $df_lcle['rollocntr']['val'] = $textecntr;
                    $df_lcle['rollomides']['val'] = $textedimensio;
                    $df_lcle['rolloimo']['val'] = $texteimo;
                    $quevol = "INSERT INTO bookingi (`codi`) VALUES (NULL);";
                    $fcons = mysqli_query($conec,$quevol);
                    $codialta = $conec->insert_id;
                    // Guardo el shipper ?
                    include_once 'grava_shipper.php';
                    grava_shipper("S",$df_lcle['shipper']['val'],$df_lcle['dirship']['val'],$df_lcle['pobship']['val'],$df_lcle['zipship']['val']
                            ,$df_lcle['proship']['val'],$df_lcle['paisship']['val'],$df_lcle['telship']['val'],$df_lcle['mailship']['val']
                            ,$df_lcle['picship']['val']);
                    grava_shipper("C",$df_lcle['consignee']['val'],$df_lcle['dircons']['val'],$df_lcle['pobcons']['val'],$df_lcle['zipcons']['val']
                            ,$df_lcle['procons']['val'],$df_lcle['paiscons']['val'],$df_lcle['telcons']['val'],$df_lcle['mailcons']['val']
                            ,$df_lcle['piccons']['val']);
                    grava_shipper("C",$df_lcle['notify']['val'],$df_lcle['dirnoty']['val'],$df_lcle['pobnoty']['val'],$df_lcle['zipnoty']['val']
                            ,$df_lcle['pronoty']['val'],$df_lcle['paisnoty']['val'],$df_lcle['telnoty']['val'],$df_lcle['mailnoty']['val']
                            ,$df_lcle['picnoty']['val']);
                    // Guardar
                    $opera = fesupdate($df_lcle);
                    $quevol = 'UPDATE bookingi SET '.$opera.' WHERE codi='.$codialta; 
                    $fcons = mysqli_query($conec,$quevol);
                    // Ara ho envia per email 
                    $_SESSION['missatge'] ='';
                    $tira = '';
                    guardaquefan("BOOKING IMPORT","BOOKING",$port,"REF: ".$codialta);
                    include_once 'bookingi_to_mail.php';
                    // Ara posa que ha fet el booking
                    // Ara torna als bookings de importació
                    $_SESSION['missatge'] .= texteweb('GRACIAS_BOOKING_I','').'</br>'.$tira;
                    saltaa('import.php'); 
            }
        }
        ?>
    </head>
    <body>
        <?php 
            // <!-- Top menu -->
            menutct();
            // -- Page Title -->
            
            pagetitle("Nuevo Booking de IMPORT",nom_usroagent(),"IMPORT new booking",nom_usroagent(),"bookings",'','import.php'); 
            if (empty($refsche)){
                // Si no hi ha schedule cal dir alguna cosa ...
                $quediutit = texteweb('NO_SCHE_IMP',1);
                $quediu = texteweb('NO_SCHE_IMP');
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
                            
                            echo '<div class="panel-heading"><h5>'.(($langles)?'NEW IMPORT BOOKING':'NUEVO BOOKING IMPORTACION').'</h5></div>';
                                echo '<form role="form" id="bookingi" action="bookingi.php" method="POST" enctype="multipart/form-data" data-fv-framework="bootstrap"
                                        data-fv-icon-valid="glyphicon glyphicon-ok"
                                        data-fv-icon-invalid="glyphicon glyphicon-remove"
                                        data-fv-icon-validating="glyphicon glyphicon-refresh">'; 
                                    echo '<div class="panel-body"><div class="row">';
                                        echo '<div class="container-fluid col-md-4">'; // Primera columna
                                        echo '<div class="row separa_titol"><b>'.(($langles)?'Service':'Servicio').'</b></div>';
                                        echo entrada((($langles)?'Destination':'Destino'),'','L','','<b>Barcelona</b>');
                                        echo entrada('FPOD','fpod','SEL','fpod','',false,'',0,fa_input_select('','','',$df_lcle['fpod']['val'],array('BARCELONA','BILBAO','MADRID','VALENCIA'),'fpod','',false,4));
                                        echo entrada('POL','','L','','<b>'.$port.'</b>');
                                        echo html_input_hidden('punt',$df_lcle['port']['val']);
                                        echo html_input_hidden('laets',$df_lcle['laets']['val']);
                                        echo html_input_hidden('laeta',$df_lcle['laeta']['val']);
                                        echo html_input_hidden('cutoff',$df_lcle['cutoff']['val']);
                                        echo html_input_hidden('elbarco',$df_lcle['elbarco']['val']);
                                        echo html_input_hidden('elviaje',$df_lcle['elviaje']['val']);
                                        if (empty($refsche)){
                                            echo entrada('POL','','L','','<b>'.$port.'</b>');
                                            echo entrada((($langles)?'Estimated ETD':'ETD deseada'),'laetsvol','D','',$df_lcle['laets']['val'],false,'',0,'',3,'','','',0);
                                        }
                                        else{
                                            $elboto = '<button class="btn-primary btn-xs" type="button" OnClick="brow(\'pol\',\'#elviaje\',\'#punt\');">POL</button>';
                                            echo entrada($elboto,'','L','','<b id="puntz">'.$port.'</b>');
                                            $elboto = '<button class="btn-primary btn-xs" type="button" OnClick="brow(\'pol-voy\',\'#punt\',\'\');">'.(($langles)?'Voyage':'Viaje').'</button>';
                                            echo entrada($elboto,'','L','','<b id="elviajez">'.$df_lcle['elviaje']['val'].'</b>');
                                            if ($df_lcle['elbarco']['val']){
                                                echo entrada((($langles)?'Vesel':'Barco'),'','L','','<b id="nombarcoz">'.$df_lcle['elbarco']['val'].'</b>');
                                            }
                                            echo entrada('Cut Off','','L','','<b id="cutoffz">'.DTOC($df_lcle['cutoff']['val']).'</b>');
                                            echo entrada('ETD','','L','','<b id="laetsz">'.DTOC($df_lcle['laets']['val']).'</b>');
                                            echo html_input_hidden('laets',$df_lcle['laets']['val']);
                                            echo entrada('ETA','','L','','<b id="laetaz">'.DTOC($df_lcle['laeta']['val']).'</b>');
                                        }

                                        if (isset($_SESSION['usr_forwarder']) && $_SESSION['usr_forwarder']){
                                            echo entrada((($langles)?'TYPE':'TIPO'),'','L','','<b>LCL</b>');
                                        }
                                        else{
                                            echo entrada(ladesc($df_lcle['lclfcl']),'lclfcl','RB','',$df_lcle['lclfcl']['val'],false,'',3,fa_radio_button('lclfcl',array('LCL'=>1,'FCL'=>2),$df_lcle['lclfcl']['val'],'funlclfcl'),0);
                                        }
                                        if (isset($_SESSION['usr_codcli']) && $_SESSION['usr_codcli']){
                                            $elboto = '<button class="btn-primary btn-xs" type="button" OnClick="brow(\'ofe\',\''.$_SESSION['usr_codcli'].'\',\'#punt\');">'.(($langles)?'S.Q.':'Oferta').'</button>';
                                        }
                                        else{
                                            $elboto = (($langles)?'S.Q.':'Oferta');
                                        }
                                        echo entrada($elboto,'oftct','T','Ref.',$df_lcle['oftct']['val'],false,'',0,'',5);
                                        echo entrada((($langles)?'Your Ref.':'Su Ref.'),'suref','T','Ref.',$df_lcle['suref']['val']);
                                        // DATOS DE CONTACTO == DATOS DE CONTACTO ==DATOS DE CONTACTO ==DATOS DE CONTACTO ==DATOS DE CONTACTO ==
                                        echo '<div class="amplia">';
                                        echo '<div class="row separa_titol"><b>'.(($langles)?'Contact details':'Datos de Contacto').'</b></div>';
                                        if (! hies()){
                                            echo entrada(ladesc($df_lcle['empresa']),'empresa','T',ladesc($df_lcle['empresa']),$df_lcle['empresa']['val'],true);
                                            echo entrada(ladesc($df_lcle['adreca']),'adreca','M',ladesc($df_lcle['adreca']),$df_lcle['adreca']['val']);
                                            echo entrada(ladesc($df_lcle['nif']),'nif','T','NIF',$df_lcle['nif']['val'],false,'',0,'',4);
                                            echo entrada('Tel.','telefon','T','Tel.',$df_lcle['telefon']['val']);
                                            
                                        }
                                        echo entrada('PIC','elpic','T','Persona de Contacto',$df_lcle['elpic']['val'],true);
                                        echo entrada('email','emailbook','E','email de Contacto',$df_lcle['emailbook']['val'],true);
                                        echo '</div>';
                                        // INSTRUCCIONES === INSTRUCCIONES === INSTRUCCIONES === INSTRUCCIONES === INSTRUCCIONES ===
                                        echo '</div>';

                                        // Segona columna ** Segona columna ** Segona columna ** Segona columna ** Segona columna ** Segona columna **
                                        echo '<div class="col-md-4">'; 
                                        echo '<div class="row separa_titol"><b>'.(($langles)?'Commodity':'Mercanc&iacute;a').'</b></div>';
                                        echo entrada(ladesc($df_lcle['fechaentrega']),'fechaentrega','D','',$df_lcle['fechaentrega']['val'],false,'|DATECUSTOM|',0,'',3,'','','',1);
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
                                        // FCL fi FCL fi FC fi FC  fi FC  fi FC  fi FC  fi FC  fi FC  fi FC  fi FC  fi FC  fi FC 
                                        echo entrada(ladesc($df_lcle['bultos']),'bultos','T','No.',$df_lcle['bultos']['val'],true,'|RIGHT|',3,fa_input_select('tipobult',(($langles)?'angles':'tipobult'),'','',null,(($langles)?'angles':'tipobult'),'',true,4),6);
                                        echo entrada(ladesc($df_lcle['kilos']),'kilos','T','KGs',$df_lcle['kilos']['val'],true,'|RIGHT|',0,'',6);
                                        $volmesures = '<label><input onclick="veumides();" id="mesuressino" name="mesuressino" type="checkbox" value="1" '.(($df_lcle['mesuressino']['val'])?'checked':'').'> '.ladesc($df_lcle['mesuressino']).'</label>';
                                        echo entrada('CBM','cbmmax','T','m3',$df_lcle['cbmmax']['val'],true,'|RIGHT|',0,$volmesures,6,'',3);
                                        // Mesures
                                        echo '<div class="amplia" id="commesura" style="display:none;">';
//                                        echo '<div class="amplia" id="commesura" >';
                                             echo html_input_hidden('nmides','0',true);
                                             echo '<table id="taulamesura" border="1" class="taula12"><thead><tr>';
                                             echo '<th style="width: 16%">Bult</th><th style="width: 12%">L</th><th style="width: 12%">W</th><th style="width: 12%">H</th><th style="width: 5%"><label data-toggle="tooltip" title="Remontable">R*</label></th><th style="width: 15%">CBM</th><th style="width: 5%;text-align:center;"><span onclick="mesmides();"><i class="fa fa-plus"></i></span></th>';
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
                                        // Fi Mesures
                                        echo entrada(ladesc($df_lcle['remontable']),'remontable','RB','',$df_lcle['remontable']['val'],false,'',3,fa_radio_button('remontable',array((($langles)?'Yes':'Si')=>1,'No'=>2),$df_lcle['remontable']['val'],''),0);
                                        //echo entrada('<b>*'.ladesc($df_lcle['remontable']).'</b>','remontable','CK','',$df_lcle['remontable']['val'],false,'');
                                        echo entrada(ladesc($df_lcle['mercancia']),'mercancia','M',(($langles)?'Goods':'Mercanc&iacute;a'),$df_lcle['mercancia']['val'],true);
                                        echo entrada(ladesc($df_lcle['marcas']),'marcas','M',(($langles)?'Marks':'Marcas'),$df_lcle['marcas']['val'],false,'',5);
                                        echo entrada('HS Code','hscode','T','HS Code.',$df_lcle['hscode']['val']);
                                        echo entrada('<b style="color:orangered;">IMO</b>','volimo','CK','imo',$df_lcle['volimo']['val'],false,'|NOPRIMERA|',0,'',0,'','imosino();');
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
                                        // Fi Recollida
    ?>
    <?php
                                        echo '</div>';
                                        // Tercera columna // Tercera columna// Tercera columna// Tercera columna// Tercera columna
                                        echo '<div class="col-md-4">'; 
                                        echo '<div class="row separa_titol"><b>'.(($langles)?'Conditions':'Condiciones').'</b></div>';
                                        echo entrada('INCOTERM','incotern','SEL','incoterm','',false,'',0,fa_input_select('','','',$df_lcle['incoterm']['val'],array('','EXW','FCA','FAS','FOB','CPT','CIP','CFR','CIF','DAT','DAP','DDP'),'incoterm','cambiainco()',true,4));
                                        // Recolida
                                        echo '<div class="amplia" id="comrecull" style="display:none;">';
                                        echo entrada(ladesc($df_lcle['dirrecull']),'dirrecull','M','Dirección',$df_lcle['dirrecull']['val'],false,'',6);
                                        echo '</div>';
                                        // Fi Recollida
                                        // Entrega
                                        echo entrada(ladesc($df_lcle['volentreg']),'volentreg','CK','volentreg',$df_lcle['volentreg']['val'],false,'',0,'',0,'','entregsino();','<span style="font-size:28px;" class="fa fa-truck"></span>');
                                        
                                        echo '<div class="amplia" id="comentreg" style="display:none;">';
                                        echo entrada(ladesc($df_lcle['direntreg']),'direntreg','M','Dirección',$df_lcle['direntreg']['val'],false,'',3);
                                        echo entrada(ladesc($df_lcle['dataentrega']),'dataentrega','D','',$df_lcle['dataentrega']['val'],false,'|DATECUSTOM|',0,'',3,'','','',2);
                                        echo entrada('Tel.','telentreg','T','Tel.',$df_lcle['telentreg']['val']);
                                        echo entrada('PIC','picentreg','T','Persona de Contacto',$df_lcle['picentreg']['val']);
                                        echo entrada(ladesc($df_lcle['horarientreg']),'horarientreg','T',(($langles)?'Working hours':'Horario'),$df_lcle['horarientreg']['val']);
                                        echo entrada('Ref.','refentreg','T','Ref.',$df_lcle['refentreg']['val']);
                                        echo '</div>';
                                        // Fi Entrega
                                        
// function entrada($laetiqueta="",$elnom="texto",$tipus="",$explicacio="",$elvalor="",$obliga=false,$elcom="",$lallargada=3,$meshtmlinput='',$ncols=0,$mesclase='',$onclick=''){
                                        echo entrada(ladesc($df_lcle['rollo']),'rollo','M',(($langles)?'Notes':'Notas'),$df_lcle['rollo']['val'],false,'',8);

                                        // Desglos
                                        echo entrada(ladesc($df_lcle['voldesglos']),'voldesglos','CK','voldesglos',$df_lcle['voldesglos']['val'],false,'',0,'',0,'','desglossino();','');
                                        
                                        echo '<div class="amplia" id="comdesglos" style="display:none;">';
                                        echo entrada(ladesc($df_lcle['rollodesglos']),'rollodesglos','M','...',$df_lcle['rollodesglos']['val'],false,'',3);
                                        echo '</div>';
                                        // Fi Desglos
                                        // Si hi ha usuari registrat permetem pujar fitxers 
                                        if (hies()){
                                            echo html_input_hidden('nfitxers','0',true);
                                            echo '<div style="padding-top:20px">';
                                                echo '<table id="taulafitxers" border="1" class="taulafitxer"><thead><tr>';
                                                echo '<th>'.(($langles)?'FILES':'ARCHIVOS').'</th><th onclick="mesfitxer();" style="width: 10%;text-align:center;"><i style="color:cyan;" class="fa fa-plus"></i></th>';
                                                echo '</tr></thead>';
                                                echo '<tr id="row_fitxer_">';
                                                $elboto = '<input type="file" class="filestyle" data-classButton="btn btn-primary" data-input="false" data-classIcon="icon-plus" name="fitxer1">';
                                                echo '<td>'.$elboto;
                                                echo '<div style="padding:5px 0px 0px 0px;" class="text-right">';
                                                echo (($langles)?'Type: ':'Tipo: ').fa_input_select('calif','califweb',' tipus="PI" AND selcliweb ','',null,'calif1');
                                                echo '</div>';
                                                echo '</dt>';
                                                echo '<td onclick="borrafitxer();" style="text-align:center;"><i style="color:orangered;" class="fa fa-remove"></i></td>';

                                                echo '</tr></table>';
                                            echo '</div>';
                                        }
                                        // FI fitxers
                                        
                                        echo '</div>';
                                        echo '</div>';
                                        echo '<div class="row">';
                                        echo '</div>';
                                        echo '<div class="row">';
                                        echo '<div class="container-fluid col-md-4">'; // Primera columna
                                        // SHIPPPER
                                        echo '<div class="amplia" id="shipper">';
                                        if (isset($_SESSION['usr_codcli']) && $_SESSION['usr_codcli']){
                                            $elboto = '<button class="btn-primary btn-xs" type="button" OnClick="brow(\'shipper\',\''.$_SESSION['usr_codcli'].'\',\'S\');"><b>Shipper</b></button>';
                                        }
                                        else{
                                            $elboto = 'Shipper';
                                        }
                                        echo entrada($elboto,'shipper','T','Shipper',$df_lcle['shipper']['val'],false,'',0);
                                        echo entrada(ladesc($df_lcle['dirship']),'dirship','T',ladesc($df_lcle['dirship']),$df_lcle['dirship']['val'],false,'|APRETAT|');
                                        $elzip = '<div class="col-xs-3 milabel_dos"><label>'.(($langles)?'ZIP':'C.P.').'</label></div>'.
                                                '<input class="col-xs-9 miform-control miform-apretat" value="'.$df_lcle['zipship']['val'].'" placeholder="ZIP Code" name="zipship" type="text" autofocus="" autocomplete="off">';
                                        echo entrada(ladesc($df_lcle['pobship']),'pobship','T',ladesc($df_lcle['pobship']),$df_lcle['pobship']['val'],false,'|APRETAT|',0,$elzip,4);
                                        echo entrada(ladesc($df_lcle['proship']),'proship','T',ladesc($df_lcle['proship']),$df_lcle['proship']['val'],false,'|APRETAT|');
                                        echo entrada(ladesc($df_lcle['paisship']),'paisship','T',ladesc($df_lcle['paisship']),$df_lcle['paisship']['val'],false,'|APRETAT|');
                                        echo entrada(ladesc($df_lcle['telship']),'telship','T',ladesc($df_lcle['telship']),$df_lcle['telship']['val'],false,'|APRETAT|');
                                        echo entrada(ladesc($df_lcle['mailship']),'mailship','T',ladesc($df_lcle['mailship']),$df_lcle['mailship']['val'],false,'|APRETAT|');
                                        echo entrada(ladesc($df_lcle['picship']),'picship','T',ladesc($df_lcle['picship']),$df_lcle['picship']['val'],false,'|APRETAT|');
                                        echo '</div>';
                                        echo '</div>';

                                        echo '<div class="container-fluid col-md-4">'; // Segona columna
                                        echo '<div class="amplia" id="consignee">';
                                        if (isset($_SESSION['usr_codcli']) && $_SESSION['usr_codcli']){
                                            $elboto = '<button class="btn-primary btn-xs" type="button" OnClick="brow(\'consignee\',\''.$_SESSION['usr_codcli'].'\',\'C\');"><b>Consignee</b></button>';
                                        }
                                        else{
                                            $elboto = 'Consignee';
                                        }
                                        echo entrada($elboto,'consignee','T','Consignee',$df_lcle['consignee']['val'],false,'',0);
                                        echo entrada(ladesc($df_lcle['dircons']),'dircons','T',ladesc($df_lcle['dircons']),$df_lcle['dircons']['val'],false,'|APRETAT|');
                                        $elzip = '<div class="col-xs-3 milabel_dos"><label>'.(($langles)?'ZIP':'C.P.').'</label></div>'.
                                                '<input class="col-xs-9 miform-control miform-apretat" value="'.$df_lcle['zipcons']['val'].'" placeholder="ZIP Code" name="zipcons" type="text" autofocus="" autocomplete="off">';
                                        echo entrada(ladesc($df_lcle['pobship']),'pobcons','T',ladesc($df_lcle['pobcons']),$df_lcle['pobcons']['val'],false,'|APRETAT|',0,$elzip,4);
                                        echo entrada(ladesc($df_lcle['proship']),'procons','T',ladesc($df_lcle['procons']),$df_lcle['procons']['val'],false,'|APRETAT|');
                                        echo entrada(ladesc($df_lcle['paisship']),'paiscons','T',ladesc($df_lcle['paiscons']),$df_lcle['paiscons']['val'],false,'|APRETAT|');
                                        echo entrada(ladesc($df_lcle['telship']),'telcons','T',ladesc($df_lcle['telcons']),$df_lcle['telcons']['val'],false,'|APRETAT|');
                                        echo entrada(ladesc($df_lcle['mailship']),'mailcons','T',ladesc($df_lcle['mailcons']),$df_lcle['mailcons']['val'],false,'|APRETAT|');
                                        echo entrada(ladesc($df_lcle['picship']),'piccons','T',ladesc($df_lcle['piccons']),$df_lcle['piccons']['val'],false,'|APRETAT|');
                                        echo '</div>';
                                        echo '</div>';

                                        echo '<div class="container-fluid col-md-4">'; // Segona columna
                                        echo '<div class="amplia" id="notify">';
                                        if (isset($_SESSION['usr_codcli']) && $_SESSION['usr_codcli']){
                                            $elboto = '<button class="btn-primary btn-xs" type="button" OnClick="brow(\'notify\',\''.$_SESSION['usr_codcli'].'\',\'C\');"><b>Notify</b></button>';
                                        }
                                        else{
                                            $elboto = 'Notify';
                                        }
                                        echo entrada($elboto,'notify','T','Notify',$df_lcle['notify']['val'],false,'',0);
                                        echo entrada(ladesc($df_lcle['dirnoty']),'dirnoty','T',ladesc($df_lcle['dirnoty']),$df_lcle['dirnoty']['val'],false,'|APRETAT|');
                                        $elzip = '<div class="col-xs-3 milabel_dos"><label>'.(($langles)?'ZIP':'C.P.').'</label></div>'.
                                                '<input class="col-xs-9 miform-control miform-apretat" value="'.$df_lcle['zipnoty']['val'].'" placeholder="ZIP Code" name="zipnoty" type="text" autofocus="" autocomplete="off">';
                                        echo entrada(ladesc($df_lcle['pobnoty']),'pobnoty','T',ladesc($df_lcle['pobnoty']),$df_lcle['pobnoty']['val'],false,'|APRETAT|',0,$elzip,4);
                                        echo entrada(ladesc($df_lcle['pronoty']),'pronoty','T',ladesc($df_lcle['pronoty']),$df_lcle['pronoty']['val'],false,'|APRETAT|');
                                        echo entrada(ladesc($df_lcle['paisnoty']),'paisnoty','T',ladesc($df_lcle['paisnoty']),$df_lcle['paisnoty']['val'],false,'|APRETAT|');
                                        echo entrada(ladesc($df_lcle['telnoty']),'telnoty','T',ladesc($df_lcle['telnoty']),$df_lcle['telnoty']['val'],false,'|APRETAT|');
                                        echo entrada(ladesc($df_lcle['mailnoty']),'mailnoty','T',ladesc($df_lcle['mailnoty']),$df_lcle['mailnoty']['val'],false,'|APRETAT|');
                                        echo entrada(ladesc($df_lcle['picnoty']),'picnoty','T',ladesc($df_lcle['picnoty']),$df_lcle['picnoty']['val'],false,'|APRETAT|');

                                        echo '</div>';
                                        echo '</div>';

                                        
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