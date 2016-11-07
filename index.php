<?php
    $amblog = false;
    include_once 'sempre.php';
    include 'htmldoctipe.php';
?>
<html lang="<?php echo(($langles)?'en':'es');?>">
    <head>
        <?php
        // Meta
        include_once 'htmlmeta.php';
        htmlmeta('index');
        // CSS
        include_once 'htmlestils.php';
        htmlestils('',1,1,0,0); // nom de pantalla, wow, 0 slide, 0 popup, 0 google maps
        echo '<script src="assets/js/jquery.bootstrap.newsbox.min.js"></script>';
        echo '<link href="http://www.jqueryscript.net/css/jquerysctipttop.css" rel="stylesheet" type="text/css">';
        $hihaimport = false;
        $hihaexport = false;
        $conec = conexioi();
        if ($conec && isset($_SESSION['usr_codcli']) && $_SESSION['usr_codcli']){
            $hihaimport = tornacamp($conec, 'codcli', 'lcleviae', 'codcli', $_SESSION['usr_codcli'], '');
            $hihaexport = tornacamp($conec, 'codcli', 'lclagrupa', 'codcli', $_SESSION['usr_codcli'], '');
        }
        ?>
    </head>
    <body>
        <?php 
            // <!-- Top menu -->
            menutct();
            // -- Page Title -->
            pagetitle("Home",((hies())?nom_usroagent():'TCT SL'),"Home",((hies())?nom_usroagent():'TCT SL'),"index"); 
            if (hies()){
                ?>
                    <div class="container">
                        <div class="row">
                            <div style="padding:10px 20px 0px 0px;" class="col-md-3">
                                <div class="panel panel-default text-left">
                                    <div class="panel-heading"> <span class="glyphicon glyphicon-list-alt"></span> <b><?php echo ($langles)?'News':'Noticias'; ?></b></div>
                                    <div class="panel-body panelnews">
                                        <div class="row">
                                            <div class="col-xs-12 text-justify">
                                                <ul class="newsscroll">
                                                <?php
                                                    $n = 0;
                                                    $quevol = 'SELECT * FROM notiweb WHERE alscroll ORDER BY noticiaoflash DESC, data DESC';
                                                    if ($conec){
                                                        $fconstmp = mysqli_query($conec,$quevol );
                                                        while($news = mysqli_fetch_array($fconstmp)) {
                                                            $n++;
                                                            $elhref = ($news['noticiaoflash']=='1')?'noticia.php?ref='.$news['codi']:'flash.php?ref='.$news['codi'];
                                                            echo '<li class="news-item">'.  utf8_encode(trim(($langles)?$news['descripa']:$news['descrip'])).'</br><a href="'.$elhref.'">'.(($langles)?'Read more':'Leer noticia').'...</a></li>';
                                                        }
                                                    }
                                                ?>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php 
                                    echo '<div class="row">';
/*include_once 'datetosql.php';
echo datetosql('16/02').'---'.datetosql('16/02/2016').'***'; */
                                    if ($_SESSION['usr_tct']){
                                            echo '<p><a href="canvis.php">'.miratct().' Ver resumen de cambios en la web.</a></p>';
                                        }
                                    echo '</div>';
                                ?>
                                <div class="row">
                                    <div class="col-sm-11 col-centered">
                                    <?php 
                                        echo '<div style="padding-bottom:3px"><a href="cotiza.php"><button class="btn btn-large btn-block btn-warning" type="button"> <span style="padding-right:10px;font-size: 1.2em;"><i class="fa fa-euro"></i> </span>'.(($langles)?'QUOTATION Request':'Solicitar COTIZACIÓN').'</button></a></div>';
                                        echo '<div style="padding-bottom:5px"></div>';
                                        echo '<div style="padding-bottom:3px"><a href="allimport.php"><button class="btn btn-large btn-block btn-primary" type="button">'.(($langles)?'Complete IMPORT Schedule':'Schedule de IMPORT Completo').'</button></a></div>';
                                        echo '<div style="padding-bottom:3px"><a href="allexport.php"><button class="btn btn-large btn-block btn-primary" type="button">'.(($langles)?'Complete EXPORT Schedule':'Schedule de EXPORT Completo').'</button></a></div>';
                                        echo '<div style="padding-bottom:3px">&nbsp;</div>';
                                        echo '<div style="padding-bottom:3px"><a href="aboutus.php"><button class="btn btn-large btn-block btn-primary" type="button">'.(($langles)?'Working Time & Holidays':'Horarios & Festivos').'</button></a></div>';
                                        echo '<div style="padding-bottom:3px"><a href="links.php"><button class="btn btn-large btn-block btn-primary" type="button">'.(($langles)?'Links of interest':'Enlaces de interés').'</button></a></div>';
                                    ?>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-md-9" style="padding:10px 10px 10px 10px;">
                                <?php
                                    // BANNER
                                    $iniciofi = 1;
                                    include 'banner.php';
                                ?>
                                <div class="row amb_fons_blau wow fadeInLeft" style="padding:10px 10px 10px 10px;">
                                    <div class="col-sm-2 text-left">
                                        <div><h4><b>IMPORT</b></h4></div>
                                    </div>
                                    <div class="col-sm-2 esquerra">
                                        <form action="import.php" method="post" id="nou">
                                        <button type="submit" name="nou" class="btn-link btn" value="nou"><?php echo ($langles)?'New IMPORT Booking':'Nuevo Booking de IMPORTACION'; ?></button>
                                        </form>
                                    </div>
                                    <div class="col-sm-2"></div>
                                    <?php
                                        // import
                                        if ($conec){
                                            echo '<div class="row col-sm-12">';
                                            if ($_SESSION['usr_codcli'] || $_SESSION['usr_codage']){
                                                $n = 0;
                                                if (esagent()){
                                                    $quevol = 'SELECT * FROM lcleviae WHERE codage="'.$_SESSION['usr_codage'].'" and npart!=1 ORDER BY eta DESC LIMIT 4';
                                                }
                                                else{
                                                    $quevol = 'SELECT * FROM lcleviae WHERE codcli="'.$_SESSION['usr_codcli'].'" and npart!=1 ORDER BY eta DESC LIMIT 4';
                                                }
                                                $fconstmp = mysqli_query($conec,$quevol );
                                                while ($tmp = mysqli_fetch_array($fconstmp)){
                                                    $n++;
                                                    if ($n == '1'){
                                                        echo '<div class="col-xs-10 lagrid-titol-grd text-center" style="padding-left:15px;">
                                                                <div class="row">
                                                                    <div class="col-xs-2 lagrid-titol lagrid-port">BL</div>
                                                                    <div class="col-xs-2 lagrid-titol lagrid-port">'.(($langles)?'Origin':'Origen').'</div>
                                                                    <div class="col-xs-3 lagrid-titol">'.(($langles)?'Vessel':'Barco').'</div>
                                                                    <div class="col-xs-1 lagrid-titol">ETA</div>
                                                                    <div class="col-xs-1 lagrid-titol">'.(($langles)?'Bulks':'Bultos').'</div>
                                                                    <div class="col-xs-1 lagrid-titol">KGs</div>
                                                                    <div class="col-xs-1 lagrid-titol">CBM</div>
                                                                    <div class="col-xs-1 lagrid-titol">Ref. Cli.</div>
                                                                </div>';
                                                    }
                                                    $elhref = 'ptda_import.php?siscon_param='.$tmp['codi'];
                                                    echo '<div class="row">';
                                                    echo '<a href="'.$elhref.'">';
                                                    $c = (($n%2) == 0)?'':'2';
                                                    echo '<div class="col-xs-2 lagrid-linea'.$c.'"><b>'.$tmp['bl'].'&nbsp;</b></div>';
                                                    echo '<div class="col-xs-2 lagrid-linea'.$c.'">'.$tmp['descpol'].'</div>';
                                                    echo '<div class="col-xs-3 lagrid-linea'.$c.'">'.$tmp['nombarco'].'</div>';
                                                    echo '<div class="col-xs-1 lagrid-linea'.$c.'">'.DTOC($tmp['eta']).'</div>';
                                                    echo '<div class="col-xs-1 lagrid-linea'.$c.'">'.$tmp['bultos'].'</div>';
                                                    echo '<div class="col-xs-1 lagrid-linea'.$c.'">'.$tmp['pes'].'</div>';
                                                    echo '<div class="col-xs-1 lagrid-linea'.$c.'">'.$tmp['cbm'].'</div>';
                                                    echo '<div class="col-xs-1 lagrid-linea'.$c.'">'.(($tmp['refcli'])?$tmp['refcli']:'-').'&nbsp;</div>';
                                                    echo '</a>';
                                                    echo '</div>';
                                                }
                                                 if ($n > '0'){
                                                     echo '</div>';
                                                 }
                                                 else{
                                                    echo '<div class="text-left" style="padding:15px;">';
                                                        echo '<p>'.(($langles)?'No previous Bookings.':'No hay bookings anteriores.').'</p>';
                                                    echo '</div>';
                                                 }
                                            }
                                            else{
                                                echo '<div class="text-left" style="padding:15px;">';
                                                    if ($_SESSION['usr_tct']){
                                                        echo '<a href="selempre.php">'.miratct().' No se ha seleccionado ninguna empresa. Pulse aquí para seleccionar una.</a>';
                                                    }
                                                echo '</div>';
                                            }
                                            echo '</div>';
                                            // Pot consultar la resta ?
                                            if ($hihaimport || $_SESSION['usr_tct']){
                                                echo '<div class="row col-sm-12"><div class="col-sm-8"></div><div class="col-sm-2" style="padding-top:15px;">';
                                                    echo '<form action="import_my_bookings.php" method="post" id="nou">';
                                                    echo '<button type="submit" name="nou" class="btn-default btn btn-lg" value="nou">Consultar Todos</button>';
                                                    echo '</form>';
                                                echo '</div></div>';
                                            }
                                        }
                                    ?>
                                </div>
                                <div class="row" style="padding-top:15px;"></div>
                                <?php
                                if (!esagent()){
                                ?>
                                <div class="row amb_fons_blau wow fadeInRight" style="padding:10px 10px 10px 10px;">
                                    <div class="col-sm-2 text-left">
                                        <div><h4><b>EXPORT</b></h4></div>
                                    </div>
                                    <div class="col-sm-2 esquerra">
                                        <form action="export.php" method="post" id="nou">
                                        <button type="submit" name="nou" class="btn-link btn" value="nou"><?php echo ($langles)?'New EXPORT Booking':'Nuevo Booking de EXPORTACION'; ?></button>
                                        </form>
                                    </div>
                                    <div class="col-sm-2"></div>
                                    <?php
                                        // import
                                        if ($conec){
                                            echo '<div class="row col-sm-12">';
                                            if ($_SESSION['usr_codcli']){
                                                $n = 0;
                                                $quevol = 'SELECT * FROM lclagrupa WHERE codcli="'.$_SESSION['usr_codcli'].'" ORDER BY ets DESC LIMIT 4';
                                                $fconstmp = mysqli_query($conec,$quevol );
                                                while ($tmp = mysqli_fetch_array($fconstmp)){
                                                    $n++;
                                                    if ($n == '1'){
                                                        echo '<div class="col-xs-10 lagrid-titol-grd text-center" style="padding-left:15px;">
                                                                <div class="row">
                                                                    <div class="col-xs-2 lagrid-titol lagrid-port">BL</div>
                                                                    <div class="col-xs-2 lagrid-titol lagrid-port">'.(($langles)?'Destination':'Destino').'</div>
                                                                    <div class="col-xs-3 lagrid-titol">'.(($langles)?'Vessel':'Barco').'</div>
                                                                    <div class="col-xs-1 lagrid-titol">ETS</div>
                                                                    <div class="col-xs-1 lagrid-titol">'.(($langles)?'Bulks':'Bultos').'</div>
                                                                    <div class="col-xs-1 lagrid-titol">KGs</div>
                                                                    <div class="col-xs-1 lagrid-titol">CBM</div>
                                                                    <div class="col-xs-1 lagrid-titol">Ref. Cli.</div>
                                                                </div>';
                                                    }
                                                    $elhref = 'ptda_export.php?siscon_param='.$tmp['codi'];
                                                    echo '<div class="row">';
                                                    echo '<a href="'.$elhref.'">';
                                                    $c = (($n%2) == 0)?'':'2';
                                                    echo '<div class="col-xs-2 lagrid-linea'.$c.'"><b>'.$tmp['bl'].'&nbsp;</b></div>';
                                                    echo '<div class="col-xs-2 lagrid-linea'.$c.'">'.$tmp['descpunt'].'</div>';
                                                    echo '<div class="col-xs-3 lagrid-linea'.$c.'">'.$tmp['descbarco'].'</div>';
                                                    echo '<div class="col-xs-1 lagrid-linea'.$c.'">'.DTOC($tmp['ets']).'</div>';
                                                    echo '<div class="col-xs-1 lagrid-linea'.$c.'">'.$tmp['bultos'].'</div>';
                                                    echo '<div class="col-xs-1 lagrid-linea'.$c.'">'.$tmp['pes'].'</div>';
                                                    echo '<div class="col-xs-1 lagrid-linea'.$c.'">'.$tmp['cbm'].'</div>';
                                                    echo '<div class="col-xs-1 lagrid-linea'.$c.'">'.(($tmp['refcil'])?$tmp['refcil']:'-').'&nbsp;</div>';
                                                    echo '</a>';
                                                    echo '</div>';
                                                }
                                                 if ($n > '0'){
                                                     echo '</div>';
                                                 }
                                                 else{
                                                    echo '<div class="text-left" style="padding:15px;">';
                                                        echo '<p>'.(($langles)?'No previous Bookings.':'No hay bookings anteriores.').'</p>';
                                                    echo '</div>';
                                                 }
                                            }
                                            else{
                                                echo '<div class="text-left" style="padding:15px;">';
                                                    if ($_SESSION['usr_tct']){
                                                        echo '<a href="selempre.php">'.miratct().' No se ha seleccionado ninguna empresa. Pulse aquí para seleccionar una.</a>';
                                                    }
                                                echo '</div>';
                                            }
                                            echo '</div>';
                                            // Pot consultar la resta ?
                                            if ($hihaimport || $_SESSION['usr_tct']){
                                                echo '<div class="row col-sm-12"><div class="col-sm-8"></div><div class="col-sm-2" style="padding-top:15px;">';
                                                    echo '<form action="export_my_bookings.php" method="post" id="nou">';
                                                    echo '<button type="submit" name="nou" class="btn-default btn btn-lg" value="nou">Consultar Todos</button>';
                                                    echo '</form>';
                                                echo '</div></div>';
                                            }
                                        }
                                    ?>
                                </div>
                                <?php
                                } // fi de la condició si es agent
                                    $iniciofi=2;
                                    include 'banner.php';
                                    // BANNER
                                ?>

                                
                            </div>
                        </div>
                    </div>
                <?php
            }
            else{
                include_once 'slider.php';
                include_once 'presentacio.php';
            }
        ?>
        <div style="padding-bottom: 60px;"></div>
        <?php 
            // <!-- Footer -->
            include 'footer.php';
            include_once 'htmljavascript.php';
            htmljavascript('','wow');
        ?>
    </body>
</html>