<?php
    include_once 'sempre.php';

$port = (isset($_REQUEST['puntsi_punt']) AND $_REQUEST['puntsi_punt'])?nohack($_REQUEST['puntsi_punt']):'';
$desde = (isset($_REQUEST['desde']) AND $_REQUEST['desde'])?nohack($_REQUEST['desde']):'';
$hasta = (isset($_REQUEST['hasta']) AND $_REQUEST['hasta'])?nohack($_REQUEST['hasta']):'';
$refsche = '';
// MIrem que el port sigui bo ...
$conec = conexioi();
if ($conec){
    if ($port){
        $ctmp = trim($port);
        $port = tornacamp($conec, 'descrip', 'punts', 'descrip', $ctmp);
        if (empty($port)){
            $port = tornacamp($conec, 'descrip', 'punts', 'descrip', strtoupper($ctmp));
            if (empty($port)){
                $port = tornacamp($conec, 'descrip', 'punts', 'descrip', strtoupper($ctmp).'%');
                if (empty($port)){
                    saltaa('import.php');
                }
            }
        }
    }
}
guardaquefan("BOOKING IMPORT","BUSCA BOOKING",$port);
// Pinto el Schedule ?  Faig el booking ?
$quevol = 'SELECT * FROM scheweb WHERE descrip="'.$port.'" AND ie="I" ORDER BY etseta';
$fconstmp = mysqli_query($conec,$quevol );
if ($fconstmp){
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
        lagrid_datatable("lcl","tmp.php",1); // nom de la base, php de execució x clic, selecció de registre 1/0
        ?>
    </head>
    <body>
        <?php 
            // <!-- Top menu -->
            menutct();
            // -- Page Title -->
            pagetitle('<a href="import.php">IMPORT Schedule</a>',"",'<a href="import.php">IMPORT Schedule</a>',"","left"); 
            $volvia = false;
        ?>
        <div class="container">
            <div style="float:left;">
                  <?php include 'skypechat.php'; ?>
            </div>
            <div class="row col-xs-12 col-centered">
                <div class="container" style="margin-top:60px;margin-bottom:80px;text-align:center;">
                    <div class="row col-centered">
                      <div class="col-xs-12 col-sm-12 col-md-11 col-lg-10 col-centered lagrid-titol-grd">
                        <div class="row text-right" style="padding:15px;">
                            <a href="schepdf.php?ie=i&id=<?php echo $port;?>&com=1" target="_blank"><img src="assets/img/pdf.png" alt="GENERATE PDF" /></a>
                        </div>
                        <div class="row">
                            <div class="col-xs-3 col-sm-2 col-md-2 lagrid-titol lagrid-port">ORIGIN</div>
                            <div class="col-xs-3 col-sm-2 col-md-2 l lagrid-titol">VESSEL</div>
                            <div class="hidden-xs col-sm-1 col-md-1 lagrid-titol lagrid-voyno">VOY.No</div>
                            <div class="col-xs-1 col-sm-1 col-md-1 lagrid-titol">&nbsp;</div>
                            <div class="hidden-xs col-sm-1 col-md-1 lagrid-titol lagrid-date">CUT OFF</div>
                            <?php 
                                    if ($scheweb = mysqli_fetch_array($fconstmp)) {
                                        if ($scheweb['etdbase']){
                                            echo '<div class="col-xs-1 col-sm-1 col-md-1 lagrid-titol lagrid-date">ETD '.$scheweb['descbase'].'</div>';
                                        }
                                        else{
                                            echo '<div class="col-xs-1 col-sm-1 col-md-1 lagrid-titol lagrid-date">ETD</div>';
                                            $volvia = true;
                                        }
                                    }
                            ?>
                            <div class="col-xs-1 col-sm-1 col-md-1 lagrid-titol lagrid-date">ETA</div>
                            <div class="hidden-xs col-sm-1 col-md-1 lagrid-titol lagrid-tt">TT</div>
                            <?php 
                                if ($volvia){
                                    echo '<div class="hidden-xs hidden-sm col-md-1 lagrid-titol lagrid-tt">VIA</div>';
                                }
                            ?>
                        </div>

                        <?php
                            $n = 0;
                            $fconstmp = mysqli_query($conec,$quevol );
                            while ($scheweb = mysqli_fetch_array($fconstmp)) {
                                //echo $scheweb['nombarco'].'<br>';
                                $n++;
                                $c = (($n%2) == 0)?'':'2';
                                echo '<div class="row">';
                                    $potfer = true;
                                    $avui = date_create(date('Y-m-d'));
                                    $clos = date_create($scheweb['closing']);
                                    $potfer = ($avui < $clos);
                                    $quepinta = ($potfer)?DTOC($scheweb['closing']):'&nbsp;<span style="font-size:14px;" class="fa fa-lock"> </span>';
                                    if ($potfer){
                                        echo '<a href="bookingi.php?punt='.$port.'&refsche='.$scheweb['unicweb'].'">';
                                    }
                                    echo '<div class="col-xs-3 col-sm-2 col-md-2 lagrid-linea'.$c.' lagrid-desti">'.$port.'</div>';
                                    echo '<div class="col-xs-3 col-sm-2 col-md-2 lagrid-linea'.$c.'">'.$scheweb['nombarco'].'</div>';
                                    echo '<div class="hidden-xs col-sm-1 col-md-1 lagrid-linea'.$c.' lagrid-voyno">'.(($scheweb['viaje'])?$scheweb['viaje']:'-').'</div>';
                                    if ($potfer){
                                        echo '<div class="col-xs-1 col-sm-1 col-md-1 lagrid-boto">Book</div>';
                                    }
                                    else{
                                        echo '<div class="col-xs-1 col-sm-1 col-md-1 lagrid-linea'.$c.' lagrid-noboto">&nbsp;</div>';
                                    }
                                    echo '<div class="hidden-xs col-sm-1 col-md-1 lagrid-linea'.$c.' lagrid-date">'.$quepinta.'</div>';
                                    echo '<div class="col-xs-1 col-sm-1 col-md-1 lagrid-linea'.$c.' lagrid-date">'.DTOC($scheweb['etseta']).'</div>';
                                    $xxd = trim(DTOC($scheweb['etseta2']));
                                    echo '<div class="col-xs-1 col-sm-1 col-md-1 lagrid-linea'.$c.' lagrid-date">'.(($xxd)?$xxd:'-').'</div>';
                                    echo '<div class="hidden-xs col-sm-1 col-md-1 lagrid-linea'.$c.' lagrid-tt">'.$scheweb['tt'].'</div>';
                                    if ($volvia){
                                        echo '<div class="hidden-xs hidden-sm col-md-1 lagrid-linea'.$c.' lagrid-tt">'.substr($scheweb['isobase'],2).'</div>';
                                    }
                                    if ($potfer){
                                        echo '</a>';
                                    }
                                echo '</div>';
                                
                            }
                            if($n == "0"){
                                 saltaa('bookingi.php?punt='.$port.'&refsche=');
                            }
                        ?>
                        <?php
                            $quediu = texteweb("SCHEDULEAPROXI", 0);
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
    </body>
</html>
<?php
}
else{
    saltaa('bookingi.php?punt='.$port.'&refsche='.$refsche);
}
include 'htmldoctipe.php';
