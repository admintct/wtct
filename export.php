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
        lagrid_datatable("lcl","tmp.php",1); // nom de la base, php de execució x clic, selecció de registre 1/0
        ?>
    </head>
    <body>
        <?php 
            // <!-- Top menu -->
            menutct();
            // -- Page Title -->
            pagetitle('<a href="allexport.php">EXPORT Schedule</a>','<a href="import.php">ir al schedule de importación</a>','<a href="allexport.php">EXPORT Schedule</a>','<a href="import.php">go to import schedule</a>',"schedule"); 
        ?>
        <div class="container">
            <div class="row" style="padding: 20px 0px 20px 20px;">
                <?php
                    include_once 'schee.php';
                ?>
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