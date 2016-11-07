<?php
    $GLOBALS['privada'] = 1;
    $amblog = 1;
    include_once 'sempre.php';
    include 'htmldoctipe.php';
?>
<html lang="<?php echo(($langles)?'en':'es');?>">
    <head>
        <?php
        $laref = retvar('siscon_param');
        // Meta
        include_once 'htmlmeta.php';
        htmlmeta('login');
        // CSS
        include_once 'htmlestils.php';
        htmlestils('',1,0,0,0,0,1); // nom de pantalla, wow, 0 slide, 0 popup, 0 google maps, Captcha, grid
        include_once 'lagrid_datatable.php';
        lagrid_datatable("agr_ptdas","ptda_export.php",1); // nom de la base, php de execució x clic, selecció de registre 1/0
        ?>
    </head>
    <body>
        <?php 
            // <!-- Top menu -->
            menutct();
            // -- Page Title -->
            pagetitle("Agrupacion de EXPORTACION",$laref,"EXPORT File",$laref,"schedule"); 
        ?>
<div class="container text-lext">
  <button type="button" class="btn btn-info pull-left" data-toggle="collapse" data-target="#hea0">Generral</button>
  <button type="button" class="btn btn-info pull-left" style="margin:0px 10px 0px 10px;" data-toggle="collapse" data-target="#hea1">Contenedores</button>
  <button type="button" class="btn btn-info pull-left" style="margin:0px 10px 0px 0px;"data-toggle="collapse" data-target="#hea2">Viaje</button>
  <button type="button" class="btn btn-info pull-left" data-toggle="collapse" data-target="#hea3">Cabecera</button>
</div>
<div class="container text-lext">
  <div id="hea0" class="collapse">
        general
  </div>
  <div id="hea1" class="collapse">
      detalles
  </div>
  <div id="hea2" class="collapse">
      CNTRS
  </div>
  <div id="hea3" class="collapse">
     CABECERA
  </div>
</div>
            <div class="container">
                <div class="row" style="padding: 0px 0px 50px 0px;">
                    <div class="table-responsive text-left">
                        <table id="lagrid" class="table table-hover" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th>C</th>
                                    <th>CLIENTE</th>
                                    <th>Bult.</th>
                                    <th>Tipo</th>
                                    <th>Mercancía</th>
                                    <th>IMO</th>
                                    <th>Kgs</th>
                                    <th>DPT CBM</th>
                                    <th>W/M</th>
                                    <th>FPOD</th>
                                    <th>Admítase</th>
                                    <th>DUA</th>
                                    <th>Partida</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>        
                    </div>
                </div>
            </div>
        <?php 
            // <!-- Footer -->
            include 'footer.php';
            include_once 'htmljavascript.php';
            htmljavascript('','wow'); 
        ?>
    </body>
</html>