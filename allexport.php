<?php
    $amblog = 0;
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
        include_once 'lagrid_datatable.php';
        lagrid_datatable("lcl","ptda_export.php",1); // nom de la base, php de execució x clic, selecció de registre 1/0
        ?>
    </head>
    <body>
        <?php 
            // <!-- Top menu -->
            menutct();
            // -- Page Title -->
            pagetitle('<a href="export.php">EXPORT SCHEDULE</a>','','<a href="export.php">EXPORT SCHEDULE</a>','',"schedule"); 
        ?>
        <div class="row">
        <div style="float:left;padding:15px;">
              <?php include 'skypechat.php'; ?>
        </div>
            <div id="perbuscar" style="padding-top:20px;">
                <input class="nicascr" type="text" placeholder="<?php echo (($langles)?'Search port':'Buscar Puerto');?>" style="background-color: lightgrey;" id="search-term" onkeypress="allimportexport(event)" />
                <input type="button" class="btn btn-primary btn-sm" id="controlefe" value="<?php echo (($langles)?'Search':'Buscar'); ?>" /></input>
            </div>
    
            <div id="bodyContainer" class="row col-xs-12 col-centered">
                <div class="container" style="margin-top:40px;margin-bottom:40px;text-align:center;">
                    <div class="row">
                      <div class="col-xs-12 col-sm-12 col-md-10 col-lg-10 col-centered lagrid-titol-grd">
                            <div class="row text-right" style="padding:15px;">
                                <span><a href="schepdf.php?ie=e&id=ALL&com=1" target="_blank"><img src="assets/img/pdf.png" alt="GENERATE PDF" /></a></span>
                                <span><a style="padding-left: 10px;" href="downsche.php?ie=e" target="_blank"><img src="assets/img/excel.png" alt="GENERATE EXCEL" /></a></span>
                            </div>

                          <div class="row">
                            <div class="col-xs-3 col-sm-2  lagrid-titol lagrid-port">DESTINATION</div>
                            <div class="col-xs-3 col-sm-3  lagrid-titol">VESSEL</div>
                            <div class="hidden-xs col-sm-1 lagrid-titol lagrid-voyno">VOY No.</div>
                            <div class="col-xs-1 col-sm-1 lagrid-titol">&nbsp;</div>
                            <div class="hidden-xs col-sm-1 lagrid-titol lagrid-date">CUT OFF</div>
                            <div class="col-xs-2 col-sm-1 lagrid-titol lagrid-date">ETD</div>
                            <div class="col-xs-2 col-sm-1 lagrid-titol lagrid-date">ETA</div>
                            <div class="hidden-xs col-sm-1 lagrid-titol lagrid-tt">TT</div>
                        </div>

                        <?php
                            $conec = conexioi();
                            if ($conec){
                                $pinici = new DateTime();
                                $pinici->sub(new DateInterval('P2D'));
                                $dinici = $pinici->format('Y-m-d');
                                $n = 0;
                                $quevol = 'SELECT * FROM scheweb WHERE ie="E" and (codpunt=codbase or codbase="") and (etseta >= "'.$dinici.'") ORDER BY descrip, etseta';
                                $fconstmp = mysqli_query($conec,$quevol );
                                $actport = '';
                                $pintaport = '';
                                while ($scheweb = mysqli_fetch_array($fconstmp)) {
                                    //echo $scheweb['nombarco'].'<br>';
                                    $n++;
                                    $c = (($n%2) == 0)?'':'2';
                                    echo '<div class="row">';
                                        $potfer = true;
                                        if ($actport != $scheweb['descrip']){
                                            include 'allexport_det.php';
                                            if ($actport){
                                                echo '</div>';
                                                echo '<div class="col-xs-11 col-sm-11 ralla_amunt_montse" style="padding:5px 10px 2px 0px;"></div>';
                                                echo '<div class="row">';
                                            }
                                            $actport = $scheweb['descrip'];
                                            $pintaport = $scheweb['descrip']; 
                                        }
                                        else{
                                            $pintaport = ''; 
                                        }
                                        // booking
                                        $avui = date_create(date('Y-m-d'));
                                        $clos = date_create($scheweb['closing']);
                                        $quepinta = ($avui >= $clos)?'&nbsp;<span style="font-size:14px;" class="fa fa-lock"> </span>':DTOC($scheweb['closing']);
                                        $potfer = ($avui <= $clos);
                                        echo '<div class="col-xs-3 col-sm-2 lagrid-nolink  lagrid-linea'.$c.' lagrid-desti-blanc text-left"><b>'.
                                                '<a href="sche-expo.php?puntse_punt='.$pintaport.'">'.$pintaport.'</a></b></div>';
                                        if ($potfer){
                                            echo '<a href="bookinge.php?punt='.$scheweb['descrip'].'&refsche='.$scheweb['unicweb'].'">';
                                        }
                                        echo '<div class="col-xs-3 col-sm-3 lagrid-linea'.$c.'">'.$scheweb['nombarco'].'</div>';
                                        echo '<div class="hidden-xs col-sm-1 lagrid-linea'.$c.' lagrid-voyno">'.(($scheweb['viaje'])?$scheweb['viaje']:'-').'</div>';
                                        if ($potfer){
                                            echo '<div class="col-xs-1 col-sm-1 lagrid-boto">Book</div>';
                                        }
                                        else{
                                            echo '<div class="col-xs-1 col-sm-1 lagrid-linea'.$c.' lagrid-noboto">&nbsp;</div>';
                                        }
                                        echo '<div class="hidden-xs col-sm-1 lagrid-linea'.$c.' lagrid-date">'.$quepinta.'</div>';
                                        echo '<div class="col-xs-2 col-sm-1 lagrid-linea'.$c.' lagrid-date">'.DTOC($scheweb['etseta']).'</div>';
                                        $xxd = trim(DTOC($scheweb['etseta2']));
                                        echo '<div class="col-xs-2 col-sm-1 lagrid-linea'.$c.' lagrid-date">'.(($xxd)?$xxd:'-').'</div>';
                                        echo '<div class="hidden-xs col-sm-1 lagrid-linea'.$c.' lagrid-tt">'.$scheweb['tt'].'</div>';
                                        if ($potfer){
                                            echo '</a>';
                                        }
                                    echo '</div>';

                                }
                                echo '<div class="row">';
                                include 'allexport_det.php';
                                                echo '<div class="col-xs-11 col-sm-11 ralla_amunt_montse" style="padding:5px 10px 2px 0px;"></div>';
                                                echo '<div class="row">';
                                echo '</div>';
                            }
                        ?>
                        <?php
                            $quediu = texteweb("SCHEDULEAPROXE", 0);
                            if ($quediu){
                                echo '<div class="text-left" style="padding-top:40px;"><p><i>'.$quediu.'</i></p></div>';
                            }
                        ?>

                      </div>
                    </div>
                </div>

            </div>
        </div>
        <!--define the table using the proper table tags, leaving the tbody tag empty -->
        <?php 
            // <!-- Footer -->
            include 'footer.php';
            include_once 'htmljavascript.php';
            htmljavascript('','wow'); 
        ?>
        <script src="assets/js/allimportexport.js"></script>;
    </body>
</html>