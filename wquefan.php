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
        elseif(isset($_REQUEST['okedit']) && ($_REQUEST['okedit'])){
            $conec = conexioi();
            if ($conec){
                if ($_REQUEST['codi'] === '0'){
                    $quevol = "INSERT INTO wusuaris (`codi`) VALUES (NULL);";
                    $fcons = mysqli_query($conec,$quevol);
                    $_REQUEST['codi'] = $conec->insert_id;
                }
                // Guardar
                $opera = 'usuari="'.$_REQUEST['usuari'].'", email="'.$_REQUEST['email'].'", nomuser="'.$_REQUEST['nomuser'].'", pass="'.$_REQUEST['pass'].'",'.
                        'codcli="'.$_REQUEST['codcli'].'", nomcli="'.addslashes($_REQUEST['nomcli']).'", telefon="'.$_REQUEST['telefon'].'", '.
                        'adreca="'.addslashes($_REQUEST['adreca']).'", rollo="'.addslashes($_REQUEST['rollo']).'", tct='.((isset($_REQUEST['tct']))?'1':'0').
                        ', forwarder='.((isset($_REQUEST['forwarder']))?'1':'0').
                        ', admin='.((isset($_REQUEST['admin']))?'1':'0').', clientoagent='.($_REQUEST['clientoagent']-1);
                $quevol = 'UPDATE wusuaris SET '.$opera.' WHERE codi='.$_REQUEST['codi']; 
                    $fcons = mysqli_query($conec,$quevol);
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
        lagrid_datatable("quefan","wquefan.php",1); // nom de la base, php de execució x clic, selecció de registre 1/0
        ?>
    </head>
    <body>
        <?php 
            // <!-- Top menu -->
            menutct();
            // -- Page Title -->
            pagetitle("ACTIVIDAD ".miratct(),"Actividad de la web","ACTIVIDAD ".miratct(),"Actividad de la web","usuaris"); 
        ?>
            <!-- GRID de la Taula -->
            <div class="container">
                <div class="row" style="padding: 20px 0px 20px 20px;">
                        <div class="table-responsive text-left">
                        <table id="lagrid" class="table table-hover" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th>C&oacute;digo</th>
                                    <th>IP</th>
                                    <th>FECHA</th>
                                    <th>PAGINA</th>
                                    <th>ACCION</th>
                                    <th>VALOR</th>
                                    <th>PARAMETROS</th>
                                </tr>
                            </thead>
                            <tfoot>
                                    <th>C&oacute;digo</th>
                                    <th>IP</th>
                                    <th>FECHA</th>
                                    <th>PAGINA</th>
                                    <th>ACCION</th>
                                    <th>VALOR</th>
                                    <th>PARAMETROS</th>
                            </tfoot>
                            <tbody>
                            </tbody>
                        </table>        
                    </div>
                </div>
            </div>
            <!-- Fi de la Grid -->
        <?php 
            // <!-- Footer -->
            include 'footer.php';
            include_once 'htmljavascript.php';
            htmljavascript('','wow'); 
        ?>
    </body>
</html>