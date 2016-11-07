<?php
    include_once 'sempre.php';
    include 'htmldoctipe.php';
    // Si cal borrar, editar o un nou ...
    $ara_edito = false;
    $es_nou = false;
    if (! empty($_REQUEST)){
        if (isset($_REQUEST['br']) && ($_REQUEST['br'])){
            // Borrar
            borra_reg("wusuaris","codi",$_REQUEST['br']);
            // $_SESSION['missatge'] = (($langles)?"Record has been deleted.":"Se ha elimimado el registro.");
            unset($_REQUEST['br']);
            unset($_POST['br']);
        }
        elseif((isset($_REQUEST['okedit']) && ($_REQUEST['okedit'])) || ((isset($_REQUEST['enviaactiu'])) && $_REQUEST['enviaactiu'])) {
            $conec = conexioi();
            if ($conec){
                if ($_REQUEST['codi'] === '0'){
                    $quevol = "INSERT INTO wusuaris (`codi`) VALUES (NULL);";
                    $fcons = mysqli_query($conec,$quevol);
                    $_REQUEST['codi'] = $conec->insert_id;
                }
                $_REQUEST['nomuser'] = str_replace('"', '\"', $_REQUEST['nomuser']);
                // Guardar
                $opera = 'usuari="'.$_REQUEST['usuari'].'", email="'.$_REQUEST['email'].'", nomuser="'.$_REQUEST['nomuser'].'", pass="'.$_REQUEST['pass'].'",'.
                        'codcli="'.$_REQUEST['codcli'].'", nomcli="'.addslashes($_REQUEST['nomcli']).'", telefon="'.$_REQUEST['telefon'].'", '.
                        'codage="'.$_REQUEST['codage'].'", nomage="'.addslashes($_REQUEST['nomage']).'", '.
                        'adreca="'.addslashes($_REQUEST['adreca']).'", rollo="'.addslashes($_REQUEST['rollo']).'", tct='.((isset($_REQUEST['tct']))?'1':'0').
                        ', forwarder='.((isset($_REQUEST['forwarder']))?'1':'0').
                        ', admin='.((isset($_REQUEST['admin']))?'1':'0').', clientoagent='.($_REQUEST['clientoagent']-1);
                $quevol = 'UPDATE wusuaris SET '.$opera.' WHERE codi='.retvar('codi'); 
                $fcons = mysqli_query($conec,$quevol);
                }
                if ((isset($_REQUEST['enviaactiu'])) && $_REQUEST['enviaactiu']){
                    if ($_REQUEST['codcli']){
                        // Cal enviar el email de confirmació
                        $tema = $_REQUEST['nomuser'].', '.texteweb("ACTIVA_USUARI", 1);
                        $cos = str_replace("%u%",$_REQUEST['usuari'],texteweb("ACTIVA_USUARI", 0)).'<p>&nbsp;</p><p>&nbsp;</p>';
                        include_once 'enviaemail.php';
                        if (enviaemail($_REQUEST['email'],$_REQUEST['nomuser'],$tema,$cos,html_entity_decode($cos),"",$GLOBALS['$email_web'],"TCT SL","TCT SL",$GLOBALS['$email_web'])){
                        }
                        else{
                            $quevol = 'UPDATE wusuaris SET timeactiva=now() WHERE codi='.$_REQUEST['codi']; 
                            $fcons = mysqli_query($conec,$quevol);
                            $_SESSION['missatge'] = "email enviado";                        
                            $_SESSION['missatge_literal'] = "AVISO";                        
                        }
                    }
                    else{
                        texok('No puede enviarse email de activación si no se detalla código de cliente !');
                    }
                    unset($_REQUEST['enviaactiu']);
                }
            $ara_edito = false;
            $es_nou = false;
        }
        elseif(isset($_REQUEST['nou']) && ($_REQUEST['nou'])){
            // Crear
            $camp = array('codi'=>0,'usuari' => "",'email' => "",'pass'=>"",'ip'=>"",'codcli'=>"",'nomcli'=>"",'nomuser'=>"",'tct'=>0,'admin'=>0,'rollo'=>"",'adreca'=>"",'telefon'=>"",'clientoagent'=>0,'forwarder'=>0);
            $ara_edito = true;
            $es_nou = true;
        }
        elseif (isset($_REQUEST['siscon_param']) && ($_REQUEST['siscon_param'])){
            // Editar
            $quevol = 'SELECT * FROM wusuaris WHERE codi='.nohack($_REQUEST['siscon_param']);
            $conec = conexioi();
            if ($conec){
                $fcons = mysqli_query($conec,$quevol);
                $camp = mysqli_fetch_array($fcons);
//                $conec->close();
            }
            if ($camp){$ara_edito = true;$es_nou = false;}
        }
    }
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
        include_once 'lagrid_datatable.php';
        lagrid_datatable("wusuaris","wusuaris.php",1); // nom de la base, php de execució x clic, selecció de registre 1/0
        ?>
    </head>
    <body>
        <?php 
            // <!-- Top menu -->
            menutct();
            // -- Page Title -->
            pagetitle("Usuarios ".miratct(),"gestión de usuarios","Usuarios ".miratct(),"gestión de usuarios","usuaris"); 
            if ($ara_edito){
        ?>
        <!-- EDIT de la Taula -->
        <div class="container" class="center-block" style="padding: 20px 0px 40px 0px;">
            <div>
            <form action="wusuaris.php" method="post" class="form-horizontal col-sm-10 formulari col-centered">
            <fieldset>
            <legend>Usuarios de la Web</legend>
                <div class="col-sm-6"  style="padding: 0px 40px 0px 10px;">
            <?php
                entrahide('codi',$camp['codi']);
                etiqueta("C&oacute;digo",(($camp['codi']>0)?$camp['codi']:'NUEVO'));
                if (! empty($camp['codi'])){
                    etiqueta("Usuario",$camp['usuari']);
                    entrahide('usuari',$camp['usuari']);
                }
                else{
                    entradeta("","usuari","Nuevo usuario","Nuevo usuario","",'glyphicon-user','T',true,' minlength="6" maxlength="15" ');                                                    
                }
                etiqueta("IP",$camp['ip']);
                entradeta("","pass","Password","Password","",'','P',true,' id="password" ',$camp['pass']);
                entradeta("L|","email","email","email","",'','T',true,' email="true" ',$camp['email']);
                // Nombre
                entradeta("","nomuser","Nombre del Usuario","Su nombre","",'','T',false,'',$camp['nomuser']);
                entradeta("","tct","TCT","TCT","",'','CK',false,'',$camp['tct']);
                entradeta("","admin","Administrador","Administrador","",'','CK',false,'',$camp['admin']);
            ?>
                </div>
                <div class="col-sm-6" style="padding: 0px 0 px 0px 0px;">

            <?php
                entradeta("","clientoagent","","","",'','RI',false,'',$camp['clientoagent'],4,array('Cliente','Agente','TCT'));
                entradeta("","forwarder","Forwarder","Forwarder","",'','CK',false,'',$camp['forwarder']);
                // Empresa
                entradeta("B|","codcli","C&oacute;digo de la Empresa","C&oacute;digo de la Empresa","clients_codi",'','T',false,"",$camp['codcli']);
                entradeta("B|","nomcli","Nombre de la Empresa","Nombre de la Empresa","clients_nomcli",'','T',false,"",$camp['nomcli']);
                echo '<div class="form-group">';
                echo '<button type="submit" name="enviaactiu" class="btn btn-info" value="Enviar Email">Enviar Email</button> <span style="padding-left:10px;"> <i>'.DTOC($camp['timeactiva']).'</i></span> ';
                echo '</div>';
                entradeta("B|","codage","C&oacute;digo del Agente","C&oacute;digo del Agente","agents_codi",'','T',false,"",$camp['codage']);
                entradeta("B|","nomage","Nombre del Agente","Nombre del Agente","agents_nom",'','T',false,"",$camp['nomage']);
                // Teléfono
                entradeta("","telefon","Tel&eacute;fono","Tel&eacute;fono","",'','T',false,"",$camp['telefon']);
                // Adreça
                entradeta("","adreca","Direcci&oacute;n","Direcci&oacute;n","",'','M',false,'',$camp['adreca'],3);
            ?>
                </div>
                <div>
                    <?php entradeta("","rollo","Notas","Notas","",'','M',false,'',$camp['rollo'],4); ?>
                    <p><a href="#" onClick="">* <?php echo(($langles)?'Mandatory':'Obligatorio'); ?>. </a><br></p>
                </div>
                <div>
                    <input type="submit" name="okedit" id="okedit" class="btn btn-lg btn-primary btn-block" value="<?php echo(($langles)?'Save':'Guardar'); ?>">
                </div>
            </fieldset>
            </form>
            </div>
        </div>
            <!-- Fi de la EDIT -->
        <?php
            }else{
        ?>
            <!-- GRID de la Taula -->
            <div class="container">
                <div class="row" style="padding: 20px 0px 20px 20px;">
                        <div class="row" style="padding: 0px 0px 10px 0px;">
                            <div class="row">
                                <div class="col-md-2 pull-left">
                                    <form action="wusuaris.php" method="post" id="nou">
                                        <button type="submit" name="nou" class="btn btn-primary" value="nou">Nuevo Usuario</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="table-responsive text-left">
                        <table id="lagrid" class="table table-hover" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th>C&oacute;digo</th>
                                    <th>C/A/TCT</th>
                                    <th>Usuario</th>
                                    <th>email</th>
                                    <th>Cod. Cl.</th>
                                    <th>Cliente</th>
                                    <th>Nombre</th>
                                    <th>TCT</th>
                                    <th>Admin</th>
                                    <th>Borrar</th>
                                </tr>
                            </thead>
                            <tfoot>
                                    <th>C&oacute;digo</th>
                                    <th>C/A/TCT</th>
                                    <th>Usuario</th>
                                    <th>email</th>
                                    <th>Cod. Cl.</th>
                                    <th>Cliente</th>
                                    <th>Nombre</th>
                                    <th>TCT</th>
                                    <th>Admin</th>
                                    <th>Borrar</th>
                            </tfoot>
                            <tbody>
                            </tbody>
                        </table>        
                    </div>
                </div>
            </div>
            <!-- Fi de la Grid -->
        <?php 
            }
            // <!-- Footer -->
            include 'footer.php';
            include_once 'htmljavascript.php';
            htmljavascript('','wow'); 
        ?>
        <script src="assets/js/wusuaris.js"></script>;
    </body>
</html>