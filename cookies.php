<?php
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
        htmlestils('',1,0,0,0,0,0); // nom de pantalla, wow, 0 slide, 0 popup, 0 google maps
        ?>
    </head>
    <body>
        <?php 
            // <!-- Top menu -->
            menutct();
            // -- Page Title -->
            pagetitle("Pol&iacute;tica de COOKIES","","COOKIES Policy","","cookies"); 
        ?>
        <!-- LOGIN TEMPLATE -->
        <div class="container">
            <div class="container" style="margin:40px 0px 40px 0px">
                    <div class="row">
                        <div class="col-sm-11 col-md-11 col-centered  wow fadeIn">
                            <div class="text-justify">
                            <?php 
                                $lanota = texteweb("POLITICA_COOKIES", 0);
                                echo $lanota;
                            ?>
                            </div>
                        </div>
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