<?php
    $GLOBALS['privada'] = 1;
    $amblog = 1;
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
        lagrid_datatable("agrupa","agr_export.php",1); // nom de la base, php de execució x clic, selecció de registre 1/0

        actimpexp(); // mirem les partides d'import i export
        ?>
    </head>
    <body>
        <?php 
            // <!-- Top menu -->
            menutct();
            // -- Page Title -->
            pagetitle("Agrupaciones de Exportación ".miratct(),'',"EXPORT Files ".miratct(),'',"schedule"); 
        ?>
            <div class="container">
                <div class="row" style="padding: 0px 0px 50px 0px;">
                    <div class="table-responsive text-left">
                        <table id="lagrid" class="table table-hover" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th>Ref.</th>
                                    <th>POD</th>
                                    <th>ETS</th>
                                    <th>ETA</th>
                                    <th>Tipo</th>
                                    <th>Barco</th>
                                    <th>Agente</th>
                                    <th>Ptdas.</th>
                                    <th>FCL</th>
                                    <th>Ptdas2</th>
                                    <th>Ptdas2</th>
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