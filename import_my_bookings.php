<?php
    $amblog = 1;
    $ambcodusr = 1;
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
        lagrid_datatable("lcle","ptda_import.php",1); // nom de la base, php de execució x clic, selecció de registre 1/0

        actimpexp(); // mirem les partides d'import i export
        ?>
    </head>
    <body>
        <?php 
            // <!-- Top menu -->
            menutct();
            // -- Page Title -->
            pagetitle("Bookings : IMPORT ",nom_usroagent(),"My Bookings : IMPORT",nom_usroagent(),"bookings"); 
            if ($_SESSION['n_import'] == '0'){
                // No hi ha res
        ?>
            <div class="container">
                <div class="row" style="padding: 30px 0px 60px 0px;">
                    <div>
                        <h1><i class="glyphicon glyphicon-remove"></i></h1>
                        <div  style="padding: 5px 0px 30px 0px;"><h3><?php echo ($langles)?'There are not import parcels yet.':'A&uacute;n no hay partidas de importación.'; ?></h3></div>
                    </div>
                    <div>
                        <form role="form" action="import.php" method="post" novalidate="novalidate">
                            <button type="submit" class="w3-btn btn-primary btn-lg"><i class="fa fa-tasks"></i><span style="padding-left: 20px;"><?php echo ($langles)?'See our schedule':'Consulte nuestro Schedule'; ?></span></button>
                        </form>
                    </div>
                </div>
            </div>
        <?php
            }
            else{
        ?>
            <div class="container">
                <div class="row centered" style="padding: 10px 0px 20px 20px;">
                    <div class=" centered wow shake">
                        <form action="import.php" method="post" id="nou">
                            <button type="submit" name="nou" class="btn btn-primary" value="nou"><?php echo ($langles)?'New':'Nuevo'?> Booking</button>
                        </form>
                    </div>
                </div>
                <div class="row" style="padding: 0px 0px 50px 0px;">
                    <div class="table-responsive text-left">
                        <table id="lagrid" class="dataTables_wrapper" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th><?php echo(($langles)?'SHIPMENT':'PARTIDA'); ?></th>
                                    <th>POR</th>
                                    <th>BL</th>
                                    <th>CNTR</th>
                                    <th><?php echo(($langles)?'ORIGIN':'ORIGEN'); ?></th>
                                    <th><?php echo(($langles)?'VESSEL':'BARCO'); ?></th>
                                    <th>ETD</th>
                                    <th>ETA</th>
                                    <th><?php echo(($langles)?'BULKS':'BULTOS'); ?></th>
                                    <th>KGS</th>
                                    <th><?php echo(($langles)?'EST. UNSTUFF.':'PREV. VACIADO'); ?></th>
                                    <th><?php echo(($langles)?'UNSTUFFING':'VACIADO'); ?></th>
                                    <th><?php echo(($langles)?'SHIPMENT':'PARTIDA'); ?></th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th><?php echo(($langles)?'SHIPMENT':'PARTIDA'); ?></th>
                                    <th>POR</th>
                                    <th>BL</th>
                                    <th>CNTR</th>
                                    <th><?php echo(($langles)?'ORIGIN':'ORIGEN'); ?></th>
                                    <th><?php echo(($langles)?'VESSEL':'BARCO'); ?></th>
                                    <th>ETD</th>
                                    <th>ETA</th>
                                    <th><?php echo(($langles)?'BULKS':'BULTOS'); ?></th>
                                    <th>KGS</th>
                                    <th><?php echo(($langles)?'EST. UNSTUFF.':'PREV. VACIADO'); ?></th>
                                    <th><?php echo(($langles)?'UNSTUFFING':'VACIADO'); ?></th>
                                    <th><?php echo(($langles)?'SHIPMENT':'PARTIDA'); ?></th>
                                </tr>
                            </tfoot>
                            <tbody>
                            </tbody>
                        </table>        
                    </div>
                </div>
            </div>
        <?php 
            }
            // <!-- Footer -->
            include 'footer.php';
            include_once 'htmljavascript.php';
            htmljavascript('','wow'); 
        ?>
    </body>
</html>