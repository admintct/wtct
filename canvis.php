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
        htmlestils('',1,0,0,0,0,0); // nom de pantalla, wow, 0 slide, 0 popup, 0 google maps, Captcha, grid
        ?>
    </head>
    <body>
        <?php 
            // <!-- Top menu -->
            menutct();
            // -- Page Title -->
            pagetitle("Cambios en la web",'',"Cambios en la web",'',"schedule"); 
        ?>
            <div class="container">
                <div class="row">
                    <div class="col-md-8 col-centered">
                        <div class="row text-left" style="padding: 0px 0px 50px 0px; font-size:1.1em;">
                    <?php
                        $myFile = "canvis.txt";
                        $fh = fopen($myFile, 'r');
                        $theData = fread($fh, filesize($myFile));
                        fclose($fh);
                        $theData = str_replace('**** ','</br><h4><b>Fecha : ',$theData);
                        $theData = str_replace(' ****','</b></h4></br>',$theData);
                        echo '<p>'.str_replace(chr(13),'</p><p>',$theData);
                    ?>
                        </div>
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