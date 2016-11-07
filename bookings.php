<?php
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
        lagrid_datatable("lcl","ptda_export.php",1); // nom de la base, php de execució x clic, selecció de registre 1/0
        ?>
    </head>
    <body>
        <?php 
            // <!-- Top menu -->
            menutct();
            // -- Page Title -->
            pagetitle("Mis Bookings",nom_usroagent(),"My Bookings",nom_usroagent(),"bookings"); 
        ?>
        <div class="container" style="padding-left:5px !important; ">
            <div class="row" style="padding: 20px 0px 20px 0px;">
                <div class="col-xs-2 text-left">
                </div>
                <div class="col-md-10 text-right">
                    <div class="table-responsive text-left">
                        </table>        
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