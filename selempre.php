<?php
    $GLOBALS['privada'] = 1;
    include_once 'sempre.php';
    include 'htmldoctipe.php';
    // Cal saltar ?
    if (isset($_REQUEST['totes'])){
        $_SESSION['usr_codcli'] = 0;
        $_SESSION['usr_nomcli'] = "TODAS LAS EMPRESAS";
        actimpexp(); // mirem les partides d'import i export
        saltaa('index.php');
    }
    elseif (isset($_REQUEST['siscon_param'])){
        $_SESSION['usr_codcli'] = $_REQUEST['siscon_param'];
        $_SESSION['usr_nomcli'] = $_REQUEST['siscon_paramb'];
        $_SESSION['usr_codage'] = 0;
        $_SESSION['usr_nomage'] = "TODOS LOS AGENTES";
        actimpexp(); // mirem les partides d'import i export
        saltaa('index.php');
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
        lagrid_datatable("selempre","selempre.php",1); // nom de la base, php de execució x clic, selecció de registre 1/0
        ?>
    </head>
    <body>
        <?php 
            // <!-- Top menu -->
            menutct();
            // -- Page Title -->
            pagetitle("Selecci&oacute;n de empresa ".miratct(),$_SESSION['usr_nomcli'],"Selecci&oacute;n de empresa ".miratct(),$_SESSION['usr_nomcli'],"selempre"); 
        ?>
        <div class="container">
            <div class="row" style="padding: 20px 0px 20px 20px;">
                <div class="col-sm-2 table-responsive text-left col-centered">
                                    <form action="selempre.php" method="post" id="nou">
                                        <button type="submit" name="totes" class="btn btn-primary" value="totes">Mostrar todas</button>
                                    </form>
                </div>
                <div class="col-sm-8 table-responsive text-left col-centered">
                    <table id="lagrid" class="table table-hover" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th>C&oacute;digo</th>
                                <th>Cliente</th>
                                <th>Poblaci&oacute;n</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>C&oacute;digo</th>
                                <th>Cliente</th>
                                <th>Poblaci&oacute;n</th>
                            </tr>
                        </tfoot>
                        <tbody>
                        </tbody>
                    </table>        
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